<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;

class Extension extends InlineNode
{
    protected string $type = 'extension';
    private string $layout;
    private string $extensionType;
    private string $extensionKey;
    private array $parameters;
    private string $localId;

    public function __construct(
        string $layout,
        string $extensionType,
        string $extensionKey,
        array $parameters,
        string $localId
    ) {
        $this->layout = $layout;
        $this->extensionType = $extensionType;
        $this->extensionKey = $extensionKey;
        $this->parameters = $parameters;
        $this->localId = $localId;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['layout'] = $this->layout;
        $attrs['extensionType'] = $this->extensionType;
        $attrs['extensionKey'] = $this->extensionKey;
        if ($this->parameters) {
            $attrs['parameters'] = $this->parameters;
        }
        $attrs['localId'] = $this->localId;

        return $attrs;
    }
}
