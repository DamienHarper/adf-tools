<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\TextBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\InlineNode;
use DH\Adf\Node\Node;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading
 */
class Heading extends BlockNode implements JsonSerializable
{
    use TextBuilder;
    use HeadingBuilder;

    protected string $type = 'heading';
    protected array $allowedContentTypes = [
        InlineNode::class,
    ];
    private int $level;

    public function __construct(int $level, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->level = $level;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['level'], $data['attrs']);

        $node = new self($data['attrs']['level'], $parent);

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

    public function getLevel(): int
    {
        return $this->level;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['level'] = $this->level;

        return $attrs;
    }
}
