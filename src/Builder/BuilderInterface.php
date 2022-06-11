<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node;

trait BuilderInterface
{
    abstract protected function append(Node $node): void;
}
