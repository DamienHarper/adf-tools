<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Hardbreak;

class HardbreakExporter extends HtmlExporter
{
    public function export(): string
    {
        \assert($this->node instanceof Hardbreak);

        return '<br/>';
    }
}
