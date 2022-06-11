<?php

declare(strict_types=1);

namespace DH\Adf\Child;

use DH\Adf\Block\Blockquote;
use DH\Adf\Block\BulletList;
use DH\Adf\Block\CodeBlock;
use DH\Adf\Block\Heading;
use DH\Adf\Block\MediaGroup;
use DH\Adf\Block\OrderedList;
use DH\Adf\Block\Panel;
use DH\Adf\Block\Paragraph;
use DH\Adf\Block\Rule;
use DH\Adf\BlockNode;
use DH\Adf\Builder\BlockquoteBuilder;
use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\MediaGroupBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\PanelBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Builder\RuleBuilder;
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
    use OrderedListBuilder;
    use PanelBuilder;
    use ParagraphBuilder;
    use RuleBuilder;

    protected string $type = 'tableCell';
    protected array $allowedContentTypes = [
        Blockquote::class,
        BulletList::class,
        CodeBlock::class,
        Heading::class,
        MediaGroup::class,
        OrderedList::class,
        Panel::class,
        Paragraph::class,
        Rule::class,
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
        if (null !== $this->colwidth && \is_array($this->colwidth)) {
            $attrs['colwidth'] = $this->colwidth;
        }

        return $attrs;
    }
}
