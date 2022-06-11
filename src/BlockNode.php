<?php

declare(strict_types=1);

namespace DH\Adf;

use InvalidArgumentException;

abstract class BlockNode extends Node
{
    protected array $allowedContentTypes = [];
    private array $content = [];

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['content'] = $this->content;

        return $result;
    }

    protected function append(Node $node): void
    {
        foreach ($this->allowedContentTypes as $type) {
            if ($node instanceof $type) {
                $this->content[] = $node;

                return;
            }
        }

        throw new InvalidArgumentException(sprintf('Invalid content type "%s" for block node "%s".', $node->type, $this->type));
    }
}
