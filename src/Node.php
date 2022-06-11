<?php

declare(strict_types=1);

namespace DH\Adf;

use JsonSerializable;

abstract class Node implements JsonSerializable
{
    protected string $type;
    protected ?Node $parent;

    public function __construct(?self $parent = null)
    {
        $this->parent = $parent;
    }

    public function end(): ?self
    {
        return $this->parent;
    }

    public function toJson(): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR);
    }

    public function jsonSerialize(): array
    {
        $result = [
            'type' => $this->type,
        ];

        $attrs = $this->attrs();
        if (\count($attrs) > 0) {
            $result['attrs'] = $attrs;
        }

        return $result;
    }

    protected function attrs(): array
    {
        return [];
    }
}
