<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Inline;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Inline\Emoji;

class EmojiExporter extends HtmlExporter
{
    public function export(): string
    {
        \assert($this->node instanceof Emoji);

        return sprintf(
            '<img class="adf-emoji" loading="lazy" src="https://pf-emoji-service--cdn.us-east-1.prod.public.atl-paas.net/standard/a51a7674-8d5d-4495-a2d2-a67c090f5c3b/64x64/%s.png" alt=":%s:" width="20" height="20">',
            $this->node->getId(),
            $this->node->getShortName()
        );
    }
}
