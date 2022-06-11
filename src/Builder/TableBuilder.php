<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\Table;

trait TableBuilder
{
    use BuilderInterface;

    public function table(string $layout, bool $isNumberColumnEnabled = false): Table
    {
        $block = new Table($layout, $isNumberColumnEnabled, $this);
        $this->append($block);

        return $block;
    }
}
