<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;
use DH\Adf\Node\MarkNode;
use DH\Adf\Node\Node;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text
 */
class Text extends InlineNode
{
    protected string $type = 'text';
    private string $text;
    private array $marks = [];

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
        if ($this->marks) {
            $result['marks'] = $this->marks;
        }
        $result['text'] = $this->text;

        return $result;
    }

    public function getMarks(): array
    {
        return $this->marks;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['text']);

        $args = [];
        if (\array_key_exists('marks', $data)) {
            foreach ($data['marks'] as $nodeData) {
                $class = Node::NODE_MAPPING[$nodeData['type']];
                $node = $class::load($nodeData);
                \assert($node instanceof MarkNode);
                $args[] = $node;
            }
        }

        return new self($data['text'], ...$args);
    }

    public function getText(): string
    {
        return $this->text;
    }

    protected function addMark(MarkNode $mark): void
    {
        $this->marks[] = $mark;
    }
}
