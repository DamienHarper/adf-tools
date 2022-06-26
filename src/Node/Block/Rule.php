<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Node\BlockNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule
 */
class Rule extends BlockNode implements JsonSerializable
{
    protected string $type = 'rule';

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        unset($result['content']);

        return $result;
    }
}
