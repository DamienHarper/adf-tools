<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Child\ListItem;

trait ListItemBuilder
{
    use BuilderInterface;

    public function item(): ListItem
    {
        $block = new ListItem($this);
        $this->append($block);

        return $block;
    }
}
