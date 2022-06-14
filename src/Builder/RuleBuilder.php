<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\Rule;

trait RuleBuilder
{
    use BuilderInterface;

    public function rule(): Rule
    {
        $block = new Rule($this);
        $this->append($block);

        return $block;
    }
}
