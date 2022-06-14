<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Inline\Emoji;
use DH\Adf\Node\Inline\Mention;
use DH\Adf\Node\Node;

trait InlineNodeBuilder
{
    public function emoji(string $shortName, ?string $id = null, ?string $text = null): self
    {
        $emoji = new Emoji($shortName, $id, $text);
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
