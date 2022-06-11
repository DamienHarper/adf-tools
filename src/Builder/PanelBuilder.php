<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Block\Panel;

trait PanelBuilder
{
    use BuilderInterface;

    public function panel(string $type): Panel
    {
        $block = new Panel($type, $this);
        $this->append($block);

        return $block;
    }
}
