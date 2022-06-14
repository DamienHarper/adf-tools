<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\ListItem;
use DH\Adf\Node\Node;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList
 */
class OrderedList extends BlockNode implements JsonSerializable
{
    use OrderedListBuilder;

    protected string $type = 'orderedList';
    protected array $allowedContentTypes = [
        ListItem::class,
    ];
    private ?int $order;

    public function __construct(?int $order = null, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->order = $order;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data);

        $node = new self($data['attrs']['order'] ?? null, $parent);

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

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        if (null !== $this->order) {
            $attrs['order'] = $this->order;
        }

        return $attrs;
    }
}
