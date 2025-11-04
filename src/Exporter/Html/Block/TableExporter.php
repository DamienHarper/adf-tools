<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Table;

class TableExporter extends HtmlExporter
{
    public function __construct(Table $node)
    {
        parent::__construct($node);
        // TODO: implement numbered rows
        // TODO: implement width
        $this->tags = [sprintf('<table class="adf-table adf-table-%s"><tbody>', $node->getLayout()), '</tbody></table>'];
    }
}
