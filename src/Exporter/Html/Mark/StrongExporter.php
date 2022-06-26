<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Mark;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Mark\Strong;

class StrongExporter extends HtmlExporter
{
    private string $text;

    public function __construct(Strong $node, string $text)
    {
        parent::__construct($node);
        $this->text = $text;
        $this->tags = ['<strong>', '</strong>'];
    }

    public function export(): string
    {
        return $this->tags[0].$this->text.$this->tags[1];
    }
}
