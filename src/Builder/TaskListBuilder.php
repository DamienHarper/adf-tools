<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Block\TaskList;

trait TaskListBuilder
{
    use BuilderInterface;

    public function tasklist(): TaskList
    {
        $block = new TaskList($this);
        $this->append($block);

        return $block;
    }
}
