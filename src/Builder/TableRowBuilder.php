<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Child\TableRow;

trait TableRowBuilder
{
    use BuilderInterface;

    public function row(): TableRow
    {
        $block = new TableRow($this);
        $this->append($block);

        return $block;
    }
}
