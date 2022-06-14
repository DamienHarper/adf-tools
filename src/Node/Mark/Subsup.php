<?php

declare(strict_types=1);

namespace DH\Adf\Node\Mark;

use DH\Adf\Node\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/subsup
 */
class Subsup extends MarkNode
{
    protected string $type = 'subsup';
    private string $subType = 'sup';

    public function __construct(string $subType = 'sup')
    {
        $this->subType = $subType;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['type'], $data['attrs']);

        return new self($data['attrs']['type'] ?? 'sup');
    }

    protected function attrs(): array
    {
        return [
            'type' => $this->subType,
        ];
    }
}
