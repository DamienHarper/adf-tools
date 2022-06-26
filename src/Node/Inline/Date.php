<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text
 */
class Date extends InlineNode
{
    protected string $type = 'date';
    private string $timestamp;

    public function __construct(string $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);

        return new self($data['attrs']['timestamp']);
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    protected function attrs(): array
    {
        return [
            'timestamp' => $this->timestamp,
        ];
    }
}
