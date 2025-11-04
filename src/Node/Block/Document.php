<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\BlockquoteBuilder;
use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\ExpandBuilder;
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
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/structure/#root-block-node
 */
class Document extends BlockNode implements JsonSerializable
{
    use BlockquoteBuilder;
    use BulletListBuilder;
    use TaskListBuilder;
    use CodeblockBuilder;
    use HeadingBuilder;
    use MediaGroupBuilder;
    use MediaSingleBuilder;
    use OrderedListBuilder;
    use PanelBuilder;
    use ParagraphBuilder;
    use RuleBuilder;
    use TableBuilder;
    use ExpandBuilder;

    protected string $type = 'doc';
    protected array $allowedContentTypes = [
        Blockquote::class,
        BulletList::class,
        TaskList::class,
        CodeBlock::class,
        Heading::class,
        MediaGroup::class,
        MediaSingle::class,
        OrderedList::class,
        Panel::class,
        Paragraph::class,
        Rule::class,
        Table::class,
        Expand::class,
    ];
    private int $version = 1;

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['version'] = $this->version;

        return $result;
    }
}
