<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Extension;

class ExtensionExporter extends HtmlExporter
{
    public function export(): string
    {
        \assert($this->node instanceof Extension);

        return '<div class="adf-extension">The contents of the extension cannot be exported.</div>';
    }
}
