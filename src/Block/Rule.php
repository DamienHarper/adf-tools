<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule
 */
class Rule extends BlockNode implements JsonSerializable
{
    protected string $type = 'rule';
    protected array $allowedContentTypes = [];
}
