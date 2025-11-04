<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Expand;

class ExpandExporter extends HtmlExporter
{
    public function __construct(Expand $node)
    {
        parent::__construct($node);
        $this->tags = ['<details class="adf-expand"><summary class="adf-expand-title">'.$node->getTitle().'</summary><div class="adf-expand-body">', '</div></details>'];
    }
}
