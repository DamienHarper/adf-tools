<?php

declare(strict_types=1);

namespace DH\Adf\Node\Child;

use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\MediaSingleBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Node\Block\BulletList;
use DH\Adf\Node\Block\CodeBlock;
use DH\Adf\Node\Block\MediaSingle;
use DH\Adf\Node\Block\OrderedList;
use DH\Adf\Node\Block\Paragraph;
use DH\Adf\Node\BlockNode;
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
