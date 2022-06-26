<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text
 */
class Status extends InlineNode
{
    public const COLOR_NEUTRAL = 'neutral';
    public const COLOR_GREEN = 'green';
    public const COLOR_PURPLE = 'purple';
    public const COLOR_BLUE = 'blue';
    public const COLOR_RED = 'red';
    public const COLOR_YELLOW = 'yellow';

    protected string $type = 'status';
    private string $text;
    private string $color;
    private ?string $localId;
    private ?string $style;

    public function __construct(string $text, string $color, ?string $localId = null, ?string $style = null)
    {
        if (!\in_array($color, [
            self::COLOR_NEUTRAL,
            self::COLOR_GREEN,
            self::COLOR_PURPLE,
            self::COLOR_BLUE,
            self::COLOR_RED,
            self::COLOR_YELLOW,
        ], true)) {
            throw new InvalidArgumentException('Invalid color');
        }

        $this->text = $text;
        $this->color = $color;
        $this->localId = $localId;
        $this->style = $style;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['text', 'color'], $data['attrs']);

        return new self(
            $data['attrs']['text'],
            $data['attrs']['color'],
            $data['attrs']['localId'] ?? null,
            $data['attrs']['style'] ?? null
        );
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getLocalId(): ?string
    {
        return $this->localId;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['text'] = $this->text;
        $attrs['color'] = $this->color;

        if (null !== $this->localId) {
            $attrs['localId'] = $this->localId;
        }
        if (null !== $this->style) {
            $attrs['style'] = $this->style;
        }

        return $attrs;
    }
}
