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

    public function append(Node ...$nodes): BlockNode
    {
        foreach ($nodes as $node) {
            if ($this->isAppendAllowed($node)) {
                $this->content[] = $node;
            } else {
                throw new InvalidArgumentException(
                    sprintf('Invalid content type "%s" for block node "%s".', $node->getType(), $this->getType())
                );
            }
        }

        return $this;
    }

    protected function isAppendAllowed(Node $node): bool
    {
        foreach ($this->allowedContentTypes as $allowedContentType) {
            if ($node instanceof $allowedContentType) {
                return true;
            }
        }

        return false;
    }
}
