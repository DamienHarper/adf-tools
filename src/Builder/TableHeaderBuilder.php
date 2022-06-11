<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Child\TableHeader;

trait TableHeaderBuilder
{
    use BuilderInterface;

    public function header(?string $background = null, ?int $colspan = null, ?int $rowspan = null, ?array $colwidth = null): TableHeader
    {
        $block = new TableHeader($background, $colspan, $rowspan, $colwidth, $this);
        $this->append($block);

        return $block;
    }
}
