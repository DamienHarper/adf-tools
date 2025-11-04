<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\ExtensionBuilder;
use DH\Adf\Builder\InlineNodeBuilder;
use DH\Adf\Builder\TextBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Inline\InlineCard;
use DH\Adf\Node\InlineNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph
 */
class Paragraph extends BlockNode implements JsonSerializable
{
    use ExtensionBuilder;
    use InlineNodeBuilder;
    use TextBuilder;

    protected string $type = 'paragraph';
    protected array $allowedContentTypes = [
        InlineNode::class,
        InlineCard::class,
    ];
}
