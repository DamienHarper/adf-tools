<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Child\TableCell;

trait TableCellBuilder
{
    use BuilderInterface;

    public function cell(?string $background = null, ?int $colspan = null, ?int $rowspan = null, ?array $colwidth = null): TableCell
    {
        $block = new TableCell($background, $colspan, $rowspan, $colwidth, $this);
        $this->append($block);

        return $block;
    }
}
