<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\MediaGroup;

class MediaGroupExporter extends HtmlExporter
{
    public function __construct(MediaGroup $node)
    {
        parent::__construct($node);
        $this->tags = ['<div class="adf-mediagroup">', '</div>'];
    }
}
