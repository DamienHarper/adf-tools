<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Status;

class StatusExporter extends HtmlExporter
{
    public function __construct(Status $node)
    {
        parent::__construct($node);
        $this->tags = [sprintf('<span class="adf-status adf-status-%s">', $node->getColor()), '</span>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof Status);

        return $this->tags[0].$this->node->getText().$this->tags[1];
    }
}
