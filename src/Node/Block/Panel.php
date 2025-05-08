<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Builder\TaskListBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Node;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel
 */
class Panel extends BlockNode
{
    use BulletListBuilder;
    use HeadingBuilder;
    use OrderedListBuilder;
    use ParagraphBuilder;
    use TaskListBuilder;

    public const INFO = 'info';
    public const NOTE = 'note';
    public const WARNING = 'warning';
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    protected string $type = 'panel';
    protected array $allowedContentTypes = [
        BulletList::class,
        Heading::class,
        OrderedList::class,
        Paragraph::class,
        TaskList::class,
    ];
    private string $panelType;

    public function __construct(string $type = self::INFO, ?BlockNode $parent = null)
    {
        if (!\in_array($type, [
            self::INFO,
            self::NOTE,
            self::WARNING,
            self::SUCCESS,
            self::ERROR,
        ], true)) {
            throw new InvalidArgumentException('Invalid panel type');
        }

        parent::__construct($parent);
        $this->panelType = $type;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['panelType'], $data['attrs']);

        $node = new self($data['attrs']['panelType'], $parent);

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

    public function getPanelType(): string
    {
        return $this->panelType;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['panelType'] = $this->panelType;

        return $attrs;
    }
}
