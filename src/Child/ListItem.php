<?php

declare(strict_types=1);

namespace DH\Adf\Child;

use DH\Adf\Block\BulletList;
use DH\Adf\Block\CodeBlock;
use DH\Adf\Block\MediaSingle;
use DH\Adf\Block\OrderedList;
use DH\Adf\Block\Paragraph;
use DH\Adf\BlockNode;
use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\MediaSingleBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem
 */
class ListItem extends BlockNode implements JsonSerializable
{
    use BulletListBuilder;
    use CodeblockBuilder;
    use MediaSingleBuilder;
    use OrderedListBuilder;
    use ParagraphBuilder;

    protected string $type = 'listItem';
    protected array $allowedContentTypes = [
        BulletList::class,
        CodeBlock::class,
        MediaSingle::class,
        OrderedList::class,
        Paragraph::class,
    ];
}
