<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

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
use DH\Adf\Builder\TableBuilder;
use DH\Adf\Builder\TaskListBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Node;
use JsonSerializable;

class Expand extends BlockNode implements JsonSerializable
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
    use TableBuilder;
    use TaskListBuilder;

    protected string $type = 'expand';
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
        Table::class,
        TaskList::class,
    ];

    private ?string $title;

    public function __construct(string $title, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->title = $title;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['title'], $data['attrs']);

        $node = new self($data['attrs']['title'], $parent);

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['title'] = $this->title;

        return $attrs;
    }
}
