<?php

declare(strict_types=1);

namespace DH\Adf;

abstract class InlineNode extends Node
{
    private array $marks = [];

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        if ($this->marks) {
            $result['marks'] = $this->marks;
        }

        return $result;
    }

    protected function addMark(MarkNode $mark): void
    {
        $this->marks[] = $mark;
    }
}
