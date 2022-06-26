<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\TableHeader;

class TableHeaderExporter extends HtmlExporter
{
    public function __construct(TableHeader $node)
    {
        parent::__construct($node);
        $this->tags = ['<th>', '</th>'];
    }
}
