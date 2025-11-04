<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\TaskItemBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\TaskItem;
use DH\Adf\Node\Node;
use JsonSerializable;

class TaskList extends BlockNode implements JsonSerializable
{
    use TaskItemBuilder;

    protected string $type = 'taskList';
    protected array $allowedContentTypes = [
        TaskItem::class,
    ];

    private ?string $localId;

    public static function load(array $data, ?BlockNode $parent = null): BlockNode
    {
        self::checkNodeData(static::class, $data);

        $node = new self($parent);

        $node->localId = $data['attrs']['localId'] ?? null;

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

    public function getLocalId(): ?string
    {
        return $this->localId;
    }
}
