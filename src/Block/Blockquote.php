<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\ParagraphBuilder;
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
