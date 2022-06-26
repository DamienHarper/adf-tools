<?php

declare(strict_types=1);

namespace DH\Adf\Node\Mark;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/link
 */
class Link extends MarkNode
{
    protected string $type = 'link';
    private string $href;
    private ?string $title;
    private ?string $id;
    private ?string $collection;
    private ?string $occurrenceKey;

    public function __construct(string $href, ?string $title = null, ?string $id = null, ?string $collection = null, ?string $occurrenceKey = null)
    {
        $this->href = $href;
        $this->title = $title;
        $this->id = $id;
        $this->collection = $collection;
        $this->occurrenceKey = $occurrenceKey;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data);
        self::checkRequiredKeys(['href'], $data['attrs']);

        return new self(
            $data['attrs']['href'],
            $data['attrs']['title'] ?? null,
            $data['attrs']['id'] ?? null,
            $data['attrs']['collection'] ?? null,
            $data['attrs']['occurrenceKey'] ?? null,
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getHref(): string
    {
        return $this->href;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function getOccurrenceKey(): ?string
    {
        return $this->occurrenceKey;
    }

    protected function attrs(): array
    {
        $attrs = [
            'href' => $this->href,
        ];

        if (null !== $this->title) {
            $attrs['title'] = $this->title;
        }

        if (null !== $this->id) {
            $attrs['id'] = $this->id;
        }

        if (null !== $this->collection) {
            $attrs['collection'] = $this->collection;
        }

        if (null !== $this->occurrenceKey) {
            $attrs['occurrenceKey'] = $this->occurrenceKey;
        }

        return $attrs;
    }
}
