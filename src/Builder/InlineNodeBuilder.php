<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Inline\Emoji;
use DH\Adf\Inline\Mention;
use DH\Adf\Node;

trait InlineNodeBuilder
{
    public function emoji(string $shortName, ?string $id = null, ?string $fallback = null): self
    {
        $emoji = new Emoji($shortName, $id, $fallback);
        $this->append($emoji);

        return $this;
    }

    public function mention(string $mentionId, string $text, ?string $accessLevel = null): self
    {
        $mention = new Mention($mentionId, $text, $accessLevel);
        $this->append($mention);

        return $this;
    }

    abstract protected function append(Node $node): void;
}
