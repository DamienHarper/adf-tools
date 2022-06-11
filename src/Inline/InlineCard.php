<?php

declare(strict_types=1);

namespace DH\Adf\Inline;

use DH\Adf\InlineNode;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/inlineCard
 */
class InlineCard extends InlineNode
{
    protected string $type = 'inlineCard';
    private ?string $data;
    private ?string $url;

    public function __construct(?string $url = null, ?string $data = null)
    {
        if (null === $data && null === $url) {
            throw new InvalidArgumentException('Either data or url must be set.');
        }

        // TODO: ensure data, if provided, is valid jsonld
        $this->data = $data;
        $this->url = $url;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        if (null !== $this->data) {
            $attrs['data'] = $this->data;
        }
        if (null !== $this->url) {
            $attrs['url'] = $this->url;
        }

        return $attrs;
    }
}
