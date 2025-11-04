<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Child\TaskItem;

trait TaskItemBuilder
{
    use BuilderInterface;

    public function item(bool $todo): TaskItem
    {
        $block = new TaskItem($todo, $this);
        $this->append($block);

        return $block;
    }
}
