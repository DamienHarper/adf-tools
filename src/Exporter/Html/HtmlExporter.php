<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html;

use DH\Adf\Exporter\ExporterInterface;
use DH\Adf\Exporter\Html\Block\BlockquoteExporter;
use DH\Adf\Exporter\Html\Block\BulletListExporter;
use DH\Adf\Exporter\Html\Block\CodeBlockExporter;
use DH\Adf\Exporter\Html\Block\DocumentExporter;
use DH\Adf\Exporter\Html\Block\ExpandExporter;
use DH\Adf\Exporter\Html\Block\HeadingExporter;
use DH\Adf\Exporter\Html\Block\MediaGroupExporter;
use DH\Adf\Exporter\Html\Block\MediaSingleExporter;
use DH\Adf\Exporter\Html\Block\OrderedListExporter;
use DH\Adf\Exporter\Html\Block\PanelExporter;
use DH\Adf\Exporter\Html\Block\ParagraphExporter;
use DH\Adf\Exporter\Html\Block\RuleExporter;
use DH\Adf\Exporter\Html\Block\TableExporter;
use DH\Adf\Exporter\Html\Block\TaskListExporter;
use DH\Adf\Exporter\Html\Child\ListItemExporter;
use DH\Adf\Exporter\Html\Child\MediaExporter;
use DH\Adf\Exporter\Html\Child\TableCellExporter;
use DH\Adf\Exporter\Html\Child\TableHeaderExporter;
use DH\Adf\Exporter\Html\Child\TableRowExporter;
use DH\Adf\Exporter\Html\Child\TaskItemExporter;
use DH\Adf\Exporter\Html\Inline\DateExporter;
use DH\Adf\Exporter\Html\Inline\EmojiExporter;
use DH\Adf\Exporter\Html\Inline\HardbreakExporter;
use DH\Adf\Exporter\Html\Inline\InlineCardExporter;
use DH\Adf\Exporter\Html\Inline\MentionExporter;
use DH\Adf\Exporter\Html\Inline\StatusExporter;
use DH\Adf\Exporter\Html\Inline\TextExporter;
use DH\Adf\Exporter\Html\Mark\CodeExporter;
use DH\Adf\Exporter\Html\Mark\EmExporter;
use DH\Adf\Exporter\Html\Mark\LinkExporter;
use DH\Adf\Exporter\Html\Mark\StrikeExporter;
use DH\Adf\Exporter\Html\Mark\StrongExporter;
use DH\Adf\Exporter\Html\Mark\SubsupExporter;
use DH\Adf\Exporter\Html\Mark\TextColorExporter;
use DH\Adf\Exporter\Html\Mark\UnderlineExporter;
use DH\Adf\Node\Block\Blockquote;
use DH\Adf\Node\Block\BulletList;
use DH\Adf\Node\Block\CodeBlock;
use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Block\Expand;
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
use DH\Adf\Node\Child\ListItem;
use DH\Adf\Node\Child\Media;
use DH\Adf\Node\Child\TableCell;
use DH\Adf\Node\Child\TableHeader;
use DH\Adf\Node\Child\TableRow;
use DH\Adf\Node\Child\TaskItem;
use DH\Adf\Node\Inline\Date;
use DH\Adf\Node\Inline\Emoji;
use DH\Adf\Node\Inline\Hardbreak;
use DH\Adf\Node\Inline\InlineCard;
use DH\Adf\Node\Inline\Mention;
use DH\Adf\Node\Inline\Status;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\InlineNode;
use DH\Adf\Node\Mark\Code;
use DH\Adf\Node\Mark\Em;
use DH\Adf\Node\Mark\Link;
use DH\Adf\Node\Mark\Strike;
use DH\Adf\Node\Mark\Strong;
use DH\Adf\Node\Mark\Subsup;
use DH\Adf\Node\Mark\TextColor;
use DH\Adf\Node\Mark\Underline;
use DH\Adf\Node\Node;

abstract class HtmlExporter implements ExporterInterface
{
    public const NODE_MAPPING = [
        // block nodes
        Document::class => DocumentExporter::class,
        Blockquote::class => BlockquoteExporter::class,
        BulletList::class => BulletListExporter::class,
        TaskList::class => TaskListExporter::class,
        CodeBlock::class => CodeBlockExporter::class,
        Heading::class => HeadingExporter::class,
        MediaGroup::class => MediaGroupExporter::class,
        MediaSingle::class => MediaSingleExporter::class,
        OrderedList::class => OrderedListExporter::class,
        Panel::class => PanelExporter::class,
        Paragraph::class => ParagraphExporter::class,
        Rule::class => RuleExporter::class,
        Table::class => TableExporter::class,
        Expand::class => ExpandExporter::class,

        // child nodes
        ListItem::class => ListItemExporter::class,
        TaskItem::class => TaskItemExporter::class,
        TableCell::class => TableCellExporter::class,
        TableHeader::class => TableHeaderExporter::class,
        TableRow::class => TableRowExporter::class,
        Media::class => MediaExporter::class,
        InlineCard::class => InlineCardExporter::class,

        // inline nodes
        Emoji::class => EmojiExporter::class,
        Hardbreak::class => HardbreakExporter::class,
        Mention::class => MentionExporter::class,
        Text::class => TextExporter::class,
        Status::class => StatusExporter::class,
        Date::class => DateExporter::class,

        // mark nodes
        Em::class => EmExporter::class,
        Strong::class => StrongExporter::class,
        Code::class => CodeExporter::class,
        Strike::class => StrikeExporter::class,
        Subsup::class => SubsupExporter::class,
        Underline::class => UnderlineExporter::class,
        Link::class => LinkExporter::class,
        TextColor::class => TextColorExporter::class,
    ];

    protected Node $node;
    protected array $tags = [];

    private bool $includeMedia = false;

    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    public function export(): string
    {
        // skip parsing media if includeMedia is false
        if (!$this->includeMedia && ($this->node instanceof MediaSingle || $this->node instanceof MediaGroup)) {
            return "";
        }

        $outputs = [];

        if ($this->node instanceof BlockNode) {
            // $node has children (content) => iterate over them
            foreach ($this->node->getContent() as $child) {
                $class = self::NODE_MAPPING[$child::class];
                $exporter = new $class($child);
                $outputs[] = $exporter->includeMedia($this->includeMedia)->export();
            }
        } elseif ($this->node instanceof InlineNode) {
            // $node doesn't have children but can have marks
            $class = self::NODE_MAPPING[$this->node::class];
            $exporter = new $class($this->node);
            $outputs[] = $exporter->export();
        }

        $output = implode('', $outputs);

        if (0 === \count($this->tags)) {
            // no wrapping tags
            return $output;
        }

        if (1 === \count($this->tags)) {
            // no closing tag
            return $this->tags[0] . $output;
        }

        // opening and closing tags
        return $this->tags[0] . $output . $this->tags[1];
    }

    /**
     * Enable output of Media Nodes
     * @param bool $incl If media should be included
     * @return $this
     */
    public function includeMedia(bool $incl = true): self {
        $this->includeMedia = $incl;
        return $this;
    }
}
