<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\CodeBlock;

class CodeBlockExporter extends HtmlExporter
{
    public function __construct(CodeBlock $node)
    {
        parent::__construct($node);
        $this->tags = ['<pre class="'.$node->getLanguage().'">', '</pre>'];
    }
}
