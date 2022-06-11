<?php

declare(strict_types=1);

namespace DH\Adf\Mark;

use DH\Adf\MarkNode;

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

    protected function attrs(): array
    {
        return [
            'color' => $this->color,
        ];
    }
}
