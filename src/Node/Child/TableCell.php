<?php

declare(strict_types=1);

namespace DH\Adf\Node\Child;

use DH\Adf\Builder\BlockquoteBuilder;
use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\MediaGroupBuilder;
use DH\Adf\Builder\MediaSingleBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\PanelBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Builder\RuleBuilder;
use DH\Adf\Builder\TaskListBuilder;
use DH\Adf\Node\Block\Blockquote;
use DH\Adf\Node\Block\BulletList;
use DH\Adf\Node\Block\CodeBlock;
use DH\Adf\Node\Block\Heading;
use DH\Adf\Node\Block\MediaGroup;
use DH\Adf\Node\Block\MediaSingle;
use DH\Adf\Node\Block\OrderedList;
use DH\Adf\Node\Block\Panel;
use DH\Adf\Node\Block\Paragraph;
use DH\Adf\Node\Block\Rule;
use DH\Adf\Node\Block\Table;
use DH\Adf\Node\Block\TaskList;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Node;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_cell
 */
class TableCell extends BlockNode implements JsonSerializable
{
    use BlockquoteBuilder;
    use BulletListBuilder;
    use CodeblockBuilder;
    use HeadingBuilder;
    use MediaGroupBuilder;
    use MediaSingleBuilder;
    use OrderedListBuilder;
    use PanelBuilder;
    use ParagraphBuilder;
    use RuleBuilder;
    use TaskListBuilder;

    protected string $type = 'tableCell';
    protected array $allowedContentTypes = [
        Blockquote::class,
        BulletList::class,
        CodeBlock::class,
        Heading::class,
        MediaGroup::class,
        MediaSingle::class,
        OrderedList::class,
        Panel::class,
        Paragraph::class,
        Rule::class,
        TaskList::class,
    ];
    private ?string $background;
    private ?int $colspan;
    private ?int $rowspan;
    private ?array $colwidth;

    public function __construct(?string $background = null, ?int $colspan = null, ?int $rowspan = null, ?array $colwidth = null, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->background = $background;
        $this->colspan = $colspan;
        $this->rowspan = $rowspan;
        $this->colwidth = $colwidth;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data);

        $node = new self(
            $data['attrs']['background'] ?? null,
            $data['attrs']['colspan'] ?? null,
            $data['attrs']['rowspan'] ?? null,
            $data['attrs']['colwidth'] ?? null,
            $parent
        );

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

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function getColspan(): ?int
    {
        return $this->colspan;
    }

    public function getRowspan(): ?int
    {
        return $this->rowspan;
    }

    public function getColwidth(): ?array
    {
        return $this->colwidth;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        if ($this->background) {
            $attrs['background'] = $this->background;
        }
        if (null !== $this->colspan) {
            $attrs['colspan'] = $this->colspan;
        }
        if (null !== $this->rowspan) {
            $attrs['rowspan'] = $this->rowspan;
        }
        if (\is_array($this->colwidth)) {
            $attrs['colwidth'] = $this->colwidth;
        }

        return $attrs;
    }
}
