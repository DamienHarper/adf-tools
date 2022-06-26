<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\InlineCard;

class InlineCardExporter extends HtmlExporter
{
    public function __construct(InlineCard $node)
    {
        parent::__construct($node);
        // TODO: finalize HTML construct
        $this->tags = ['<div class="adf-inline-card">', '</div>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof InlineCard);

        return $this->tags[0].$this->node->getUrl().$this->tags[1];
    }
}
