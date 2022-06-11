<?php

declare(strict_types=1);

namespace DH\Adf\Child;

use DH\Adf\BlockNode;
use DH\Adf\Builder\TableCellBuilder;
use DH\Adf\Builder\TableHeaderBuilder;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_row
 */
class TableRow extends BlockNode implements JsonSerializable
{
    use TableCellBuilder;
    use TableHeaderBuilder;

    protected string $type = 'tableRow';
    protected array $allowedContentTypes = [
        TableHeader::class,
        TableCell::class,
    ];
}
