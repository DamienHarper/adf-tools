<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Mention;

class MentionExporter extends HtmlExporter
{
    public function __construct(Mention $node)
    {
        parent::__construct($node);
        $this->tags = ['<span class="adf-mention">', '</span>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof Mention);

        return $this->tags[0].$this->node->getText().$this->tags[1];
    }
}
