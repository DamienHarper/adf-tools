<?php

declare(strict_types=1);

namespace DH\Adf\Node\Child;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Node;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/media
 */
class Media extends Node
{
    public const TYPE_FILE = 'file';
    public const TYPE_LINK = 'link';

    protected string $type = 'media';
    private string $id;
    private string $mediaType;
    private string $collection;
    private ?string $occurrenceKey;
    private ?float $width;
    private ?float $height;

    public function __construct(string $id, string $mediaType, string $collection, ?float $width = null, ?float $height = null, ?string $occurrenceKey = null, ?BlockNode $parent = null)
    {
        if (!\in_array($mediaType, [self::TYPE_FILE, self::TYPE_LINK], true)) {
            throw new InvalidArgumentException('Invalid media type');
        }

        parent::__construct($parent);
        $this->id = $id;
        $this->mediaType = $mediaType;
        $this->collection = $collection;
        $this->occurrenceKey = $occurrenceKey;

        if (is_float($width))
            $width = round($width, 2);
        $this->width = $width;

        if (is_float($height))
            $height = round($height, 2);
        $this->height = $height;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['id', 'type', 'collection'], $data['attrs']);

        return new self(
            $data['attrs']['id'],
            $data['attrs']['type'],
            $data['attrs']['collection'],
            $data['attrs']['width'] ?? null,
            $data['attrs']['height'] ?? null,
            $data['attrs']['occurrenceKey'] ?? null,
            $parent
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getMediaType(): string
    {
        return $this->mediaType;
    }

    public function getCollection(): string
    {
        return $this->collection;
    }

    public function getOccurrenceKey(): ?string
    {
        return $this->occurrenceKey;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        $attrs['id'] = $this->id;
        $attrs['type'] = $this->mediaType;
        $attrs['collection'] = $this->collection;

        if (null !== $this->occurrenceKey) {
            $attrs['occurrenceKey'] = $this->occurrenceKey;
        }

        if (null !== $this->width) {
            $attrs['width'] = $this->width;
        }

        if (null !== $this->height) {
            $attrs['height'] = $this->height;
        }

        return $attrs;
    }
}
