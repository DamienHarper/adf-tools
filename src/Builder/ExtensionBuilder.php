<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Inline\Extension;

trait ExtensionBuilder
{
    public function extension(
        string $layout,
        string $extensionType,
        string $extensionKey,
        array $parameters,
        string $localId
    ): self {
        $mention = new Extension($layout, $extensionType, $extensionKey, $parameters, $localId);
        $this->append($mention);

        return $this;
    }
}
