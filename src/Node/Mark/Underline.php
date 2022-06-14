<?php

declare(strict_types=1);

namespace DH\Adf\Node\Mark;

use DH\Adf\Node\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/underline
 */
class Underline extends MarkNode
{
    protected string $type = 'underline';
}
