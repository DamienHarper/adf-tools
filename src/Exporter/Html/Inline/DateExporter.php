<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DateTimeImmutable;
use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Date;

class DateExporter extends HtmlExporter
{
    public function __construct(Date $node)
    {
        parent::__construct($node);
        $this->tags = ['<span class="adf-date">', '</span>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof Date);

        $timestamp = (int) $this->node->getTimestamp();
        $date = (new DateTimeImmutable())->setTimestamp($timestamp / 1000);

        return $this->tags[0].$date->format('Y-m-d').$this->tags[1];
    }
}
