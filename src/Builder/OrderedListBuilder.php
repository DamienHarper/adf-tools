<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\OrderedList;

trait OrderedListBuilder
{
    use ListItemBuilder;

    public function orderedlist(int $order = 1): OrderedList
    {
        $block = new OrderedList(1, $this);
        $this->append($block);

        return $block;
    }
}
