<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\MediaSingle;

class MediaSingleExporter extends HtmlExporter
{
    public function __construct(MediaSingle $node)
    {
        parent::__construct($node);
        $this->tags = ['<div class="adf-mediasingle">', '</div>'];
    }
}
