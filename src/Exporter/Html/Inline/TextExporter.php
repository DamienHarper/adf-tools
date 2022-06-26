<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Text;

class TextExporter extends HtmlExporter
{
    public function export(): string
    {
        \assert($this->node instanceof Text);
        $output = $this->node->getText();

        foreach ($this->node->getMarks() as $mark) {
            $class = self::NODE_MAPPING[$mark::class];
            $exporter = new $class($mark, $output);
            $output = $exporter->export();
        }

        return $output;
    }
}
