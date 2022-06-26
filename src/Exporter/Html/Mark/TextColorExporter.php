<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Mark;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Mark\TextColor;

class TextColorExporter extends HtmlExporter
{
    private string $text;

    public function __construct(TextColor $node, string $text)
    {
        parent::__construct($node);
        $this->text = $text;
        $this->tags = ['<span style="color: %s">', '</span>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof TextColor);

        return sprintf($this->tags[0], $this->node->getColor()).$this->text.$this->tags[1];
    }
}
