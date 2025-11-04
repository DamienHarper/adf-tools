<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Mark\Em;
use DH\Adf\Node\Mark\Link;
use DH\Adf\Node\Mark\Strike;
use DH\Adf\Node\Mark\Strong;
use DH\Adf\Node\Mark\Subsup;
use DH\Adf\Node\Mark\TextColor;
use DH\Adf\Node\Mark\Underline;
use DH\Adf\Node\Node;

trait TextBuilder
{
    public function text(string $text): self
    {
        $this->append(new Text($text));

        return $this;
    }

    public function em(string $text): self
    {
        $this->append(new Text($text, new Em()));

        return $this;
    }

    public function strong(string $text): self
    {
        $this->append(new Text($text, new Strong()));

        return $this;
    }

    public function underline(string $text): self
    {
        $this->append(new Text($text, new Underline()));

        return $this;
    }

    public function strike(string $text): self
    {
        $this->append(new Text($text, new Strike()));

        return $this;
    }

    public function sub(string $text): self
    {
        $this->append(new Text($text, new Subsup('sub')));

        return $this;
    }

    public function sup(string $text): self
    {
        $this->append(new Text($text, new Subsup('sup')));

        return $this;
    }

    public function color(string $text, string $color): self
    {
        $this->append(new Text($text, new TextColor($color)));

        return $this;
    }

    public function link(string $text, string $href, ?string $title = null): self
    {
        $this->append(new Text($text, new Link($href, $title)));

        return $this;
    }

    abstract public function append(Node ...$nodes): BlockNode;
}
