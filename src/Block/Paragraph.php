<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\InlineNodeBuilder;
use DH\Adf\Builder\TextBuilder;
use DH\Adf\InlineNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph
 */
class Paragraph extends BlockNode implements JsonSerializable
{
    use InlineNodeBuilder;
    use TextBuilder;

    protected string $type = 'paragraph';
    protected array $allowedContentTypes = [
        InlineNode::class,
    ];
}
