<?php

declare(strict_types=1);

namespace DH\Adf\Child;

use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_header
 */
class TableHeader extends TableCell implements JsonSerializable
{
    protected string $type = 'tableHeader';
}
