<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\OrderedList;

class OrderedListExporter extends HtmlExporter
{
    public function __construct(OrderedList $node)
    {
        parent::__construct($node);
        $this->tags = ['<ol>', '</ol>'];
    }
}
