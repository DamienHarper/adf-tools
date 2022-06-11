<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\Heading;

trait HeadingBuilder
{
    use BuilderInterface;

    public function heading(int $level): Heading
    {
        $block = new Heading($level, $this);
        $this->append($block);

        return $block;
    }
}
