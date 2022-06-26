<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\Rule;

class RuleExporter extends HtmlExporter
{
    public function __construct(Rule $node)
    {
        parent::__construct($node);
        $this->tags = ['<hr/>'];
    }
}
