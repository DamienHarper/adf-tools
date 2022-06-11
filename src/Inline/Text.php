<?php

declare(strict_types=1);

namespace DH\Adf\Inline;

use DH\Adf\InlineNode;
use DH\Adf\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text
 */
class Text extends InlineNode
{
    protected string $type = 'text';
    private string $text;

    public function __construct(string $text, MarkNode ...$marks)
    {
        $this->text = $text;

        foreach ($marks as $mark) {
            $this->addMark($mark);
        }
    }

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['text'] = $this->text;

        return $result;
    }
}
