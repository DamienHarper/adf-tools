<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\Table;

trait TableBuilder
{
    use BuilderInterface;

    public function table(string $layout, bool $isNumberColumnEnabled = false, ?int $width = null, ?string $localId = null): Table
    {
        $block = new Table($layout, $isNumberColumnEnabled, $width, $localId, $this);
        $this->append($block);

        return $block;
    }
}
