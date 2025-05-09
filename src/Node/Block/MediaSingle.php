<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\MediaBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\Media;
use DH\Adf\Node\Node;
use InvalidArgumentException;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle
 */
class MediaSingle extends BlockNode implements JsonSerializable
{
    use MediaBuilder;

    public const LAYOUT_WRAP_LEFT = 'wrap-left';
    public const LAYOUT_CENTER = 'center';
    public const LAYOUT_WRAP_RIGHT = 'wrap-right';
    public const LAYOUT_WIDE = 'wide';
    public const LAYOUT_FULL_WIDTH = 'full-width';
    public const LAYOUT_ALIGN_START = 'align-start';
    public const LAYOUT_ALIGN_END = 'align-end';

    protected string $type = 'mediaSingle';
    protected array $allowedContentTypes = [
        Media::class,
    ];
    private string $layout;
    private ?float $width;

    public function __construct(string $layout, ?float $width = null, ?BlockNode $parent = null)
    {
        if (!\in_array($layout, [
            self::LAYOUT_WRAP_LEFT,
            self::LAYOUT_CENTER,
            self::LAYOUT_WRAP_RIGHT,
            self::LAYOUT_WIDE,
            self::LAYOUT_FULL_WIDTH,
            self::LAYOUT_ALIGN_START,
            self::LAYOUT_ALIGN_END,
        ], true)) {
            throw new InvalidArgumentException(sprintf('Invalid layout "%s"', $layout));
        }

        parent::__construct($parent);
        $this->layout = $layout;

        if (is_float($width))
            $width = round($width, 2);
        $this->width = $width;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['layout'], $data['attrs']);

        $node = new self($data['attrs']['layout'], $data['attrs']['width'] ?? null, $parent);

        // set content if defined
        if (\array_key_exists('content', $data)) {
            foreach ($data['content'] as $nodeData) {
                $class = Node::NODE_MAPPING[$nodeData['type']];
                $child = $class::load($nodeData, $node);

                $node->append($child);
            }
        }

        return $node;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        $attrs['layout'] = $this->layout;

        if (null !== $this->width) {
            $attrs['width'] = $this->width;
        }

        return $attrs;
    }
}
