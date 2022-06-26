<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Document;

class DocumentExporter extends HtmlExporter
{
    public function __construct(Document $node)
    {
        parent::__construct($node);
        $this->tags = ['<div class="adf-container">', '</div>'];
    }
}
