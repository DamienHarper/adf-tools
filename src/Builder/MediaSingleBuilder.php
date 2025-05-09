<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\MediaSingle;

trait MediaSingleBuilder
{
    use BuilderInterface;

    public function mediaSingle(string $layout, ?float $width = null): MediaSingle
    {
        $block = new MediaSingle($layout, $width, $this);
        $this->append($block);

        return $block;
    }
}
