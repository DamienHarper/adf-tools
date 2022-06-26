<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\ListItem;

class ListItemExporter extends HtmlExporter
{
    public function __construct(ListItem $node)
    {
        parent::__construct($node);
        $this->tags = ['<li>', '</li>'];
    }
}
