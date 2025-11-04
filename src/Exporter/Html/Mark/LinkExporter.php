<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Mark;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Mark\Link;

class LinkExporter extends HtmlExporter
{
    private string $text;

    public function __construct(Link $node, string $text)
    {
        parent::__construct($node);
        $this->text = $text;
        $this->tags = ['<a href="%s" title="%s">', '</a>'];
    }

    public function export(): string
    {
        \assert($this->node instanceof Link);

        return \sprintf($this->tags[0], $this->node->getHref(), $this->node->getTitle()).$this->text.$this->tags[1];
    }
}
