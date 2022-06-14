<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\BulletList;

trait BulletListBuilder
{
    use BuilderInterface;

    public function bulletlist(): BulletList
    {
        $block = new BulletList($this);
        $this->append($block);

        return $block;
    }
}
