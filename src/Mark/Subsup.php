<?php

declare(strict_types=1);

namespace DH\Adf\Mark;

use DH\Adf\MarkNode;

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

    protected function attrs(): array
    {
        return [
            'type' => $this->subType,
        ];
    }
}
