<?php

declare(strict_types=1);

namespace DH\Adf\Node;

use InvalidArgumentException;

abstract class BlockNode extends Node
{
    protected array $allowedContentTypes = [];
    protected array $content = [];

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['content'] = $this->content;

        return $result;
    }

    public static function load(array $data, ?self $parent = null): self
    {
        self::checkNodeData(static::class, $data);

        $class = Node::NODE_MAPPING[$data['type']];
        $node = new $class($parent);
        \assert($node instanceof self);

        // set attributes if defined
        if (\array_key_exists('attrs', $data)) {
            foreach ($data['attrs'] as $key => $value) {
                $node->{$key} = $value;
            }
        }

        // set content if defined
        if (\array_key_exists('content', $data)) {
            foreach ($data['content'] as $nodeData) {
                // ignore undefined node types
                if (!isset(Node::NODE_MAPPING[$nodeData['type']])) {
                    continue;
                }

                $class = Node::NODE_MAPPING[$nodeData['type']];
                $child = $class::load($nodeData, $node);

                $node->append($child);
            }
        }

        return $node;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    protected function append(Node $node): void
    {
        foreach ($this->allowedContentTypes as $type) {
            if ($node instanceof $type) {
                $this->content[] = $node;

                return;
            }
        }

        throw new InvalidArgumentException(sprintf('Invalid content type "%s" for block node "%s".', $node->type, $this->type));
    }
}
