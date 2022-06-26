<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\InlineNode;
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

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data);

        return new self($data['attrs']['url'] ?? null, $data['attrs']['data'] ?? null);
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function getUrl(): ?string
    {
        return $this->url;
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
