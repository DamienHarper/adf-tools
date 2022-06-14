<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\MediaGroup;

trait MediaGroupBuilder
{
    use BuilderInterface;

    public function mediaGroup(): MediaGroup
    {
        $block = new MediaGroup($this);
        $this->append($block);

        return $block;
    }
}
