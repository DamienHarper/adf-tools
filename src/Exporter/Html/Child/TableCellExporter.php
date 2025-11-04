<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\TableCell;

class TableCellExporter extends HtmlExporter
{
    public function __construct(TableCell $node)
    {
        parent::__construct($node);

        $attributes = [];
        if (null !== $node->getBackground()) {
            $attributes[] = \sprintf('style="background-color: %s"', $node->getBackground());
        }
        if (null !== $node->getColspan()) {
            $attributes[] = \sprintf('colspan="%s"', $node->getColspan());
        }
        if (null !== $node->getRowspan()) {
            $attributes[] = \sprintf('rowspan="%s"', $node->getRowspan());
        }
        // TODO: support colwidth

        $this->tags = [
            \sprintf('<td%s>', implode(' ', $attributes)),
            '</td>',
        ];
    }
}
