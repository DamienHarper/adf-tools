<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\CodeBlock;

trait CodeblockBuilder
{
    use BuilderInterface;

    public function codeblock(?string $language = null): CodeBlock
    {
        $block = new CodeBlock($language, $this);
        $this->append($block);

        return $block;
    }
}
