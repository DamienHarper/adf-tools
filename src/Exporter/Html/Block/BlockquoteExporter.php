<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Blockquote;

class BlockquoteExporter extends HtmlExporter
{
    public function __construct(Blockquote $node)
    {
        parent::__construct($node);
        $this->tags = ['<blockquote>', '</blockquote>'];
    }
}
