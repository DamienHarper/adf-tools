<?php

declare(strict_types=1);

namespace DH\Adf\Node\Mark;

use DH\Adf\Node\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/textColor
 */
class TextColor extends MarkNode
{
    protected string $type = 'textColor';
    private string $color = 'black';

    public function __construct(string $color = 'black')
    {
        $this->color = $color;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['color'], $data['attrs']);

        return new self($data['attrs']['color'] ?? 'black');
    }

    public function getColor(): string
    {
        return $this->color;
    }

    protected function attrs(): array
    {
        return [
            'color' => $this->color,
        ];
    }
}
