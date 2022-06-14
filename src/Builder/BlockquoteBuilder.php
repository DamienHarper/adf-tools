<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\Blockquote;

trait BlockquoteBuilder
{
    use BuilderInterface;

    public function blockquote(): Blockquote
    {
        $block = new Blockquote($this);
        $this->append($block);

        return $block;
    }
}
