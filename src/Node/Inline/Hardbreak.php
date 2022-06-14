<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/hardBreak
 */
class Hardbreak extends InlineNode
{
    protected string $type = 'hardBreak';
}
