<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Node\BlockNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote
 */
class Blockquote extends BlockNode implements JsonSerializable
{
    use ParagraphBuilder;

    protected string $type = 'blockquote';
    protected array $allowedContentTypes = [
        Paragraph::class,
    ];
}
