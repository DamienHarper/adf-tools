<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\MediaSingle;

trait MediaSingleBuilder
{
    use BuilderInterface;

    public function mediaSingle(string $layout, ?int $width = null): MediaSingle
    {
        $block = new MediaSingle($layout, $width, $this);
        $this->append($block);

        return $block;
    }
}
