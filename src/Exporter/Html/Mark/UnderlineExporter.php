<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Mark;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Mark\Underline;

class UnderlineExporter extends HtmlExporter
{
    private string $text;

    public function __construct(Underline $node, string $text)
    {
        parent::__construct($node);
        $this->text = $text;
        $this->tags = ['<u>', '</u>'];
    }

    public function export(): string
    {
        return $this->tags[0].$this->text.$this->tags[1];
    }
}
