<?php

declare(strict_types=1);

namespace DH\Adf\Node\Child;

use DH\Adf\Builder\TextBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Node;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem
 */
class TaskItem extends BlockNode implements JsonSerializable
{
    use TextBuilder;

    protected string $type = 'taskItem';
    protected array $allowedContentTypes = [
        Text::class,
    ];

    /** @var bool State of Task Item */
    private bool $todo;
    private ?string $localId;

    public function __construct(bool $todo, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->todo = $todo;
    }

    public static function load(array $data, ?BlockNode $parent = null): BlockNode
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['state'], $data['attrs']); // task item needs state key

        $todo = $data['attrs']['state'] == 'TODO';
        $node = new self($todo, $parent);

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

    public function isOpen(): bool
    {
        return $this->todo;
    }

    public function getLocalId(): ?string
    {
        return $this->localId;
    }
}
