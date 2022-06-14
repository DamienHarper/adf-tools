<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Node\InlineNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule
 */
class Rule extends InlineNode implements JsonSerializable
{
    protected string $type = 'rule';
}
