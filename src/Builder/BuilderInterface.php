<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Node;

trait BuilderInterface
{
    abstract public function append(Node ...$nodes): BlockNode;
}
