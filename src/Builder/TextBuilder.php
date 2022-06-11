<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Inline\Text;
use DH\Adf\Mark\Em;
use DH\Adf\Mark\Link;
use DH\Adf\Mark\Strike;
use DH\Adf\Mark\Strong;
use DH\Adf\Mark\Subsup;
use DH\Adf\Mark\TextColor;
use DH\Adf\Mark\Underline;
use DH\Adf\Node;

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

    abstract protected function append(Node $node): void;
}
