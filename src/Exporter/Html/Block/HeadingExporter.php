<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Heading;

class HeadingExporter extends HtmlExporter
{
    public function __construct(Heading $node)
    {
        parent::__construct($node);
        $this->tags = [
            '<h'.$node->getLevel().'>',
            '</h'.$node->getLevel().'>',
        ];
    }
}
