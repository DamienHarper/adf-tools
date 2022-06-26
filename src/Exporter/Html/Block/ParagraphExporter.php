<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Paragraph;

class ParagraphExporter extends HtmlExporter
{
    public function __construct(Paragraph $node)
    {
        parent::__construct($node);
        $this->tags = ['<p>', '</p>'];
    }
}
