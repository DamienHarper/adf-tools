<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\Paragraph;

trait ParagraphBuilder
{
    use BuilderInterface;

    public function paragraph(): Paragraph
    {
        $block = new Paragraph($this);
        $this->append($block);

        return $block;
    }
}
