<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\BulletList;

class BulletListExporter extends HtmlExporter
{
    public function __construct(BulletList $node)
    {
        parent::__construct($node);
        $this->tags = ['<ul>', '</ul>'];
    }
}
