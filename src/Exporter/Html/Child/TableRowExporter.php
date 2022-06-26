<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\TableRow;

class TableRowExporter extends HtmlExporter
{
    public function __construct(TableRow $node)
    {
        parent::__construct($node);
        $this->tags = ['<tr>', '</tr>'];
    }
}
