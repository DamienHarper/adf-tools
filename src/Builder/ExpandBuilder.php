<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\Expand;

trait ExpandBuilder
{
    use BuilderInterface;

    public function expand(string $title): Expand
    {
        $block = new Expand($title, $this);
        $this->append($block);

        return $block;
    }
}
