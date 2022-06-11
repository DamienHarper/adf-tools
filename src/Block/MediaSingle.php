<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\MediaBuilder;
use DH\Adf\Child\Media;
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
    private ?int $width;

    public function __construct(string $layout, ?int $width = null, ?BlockNode $parent = null)
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
        $this->width = $width;
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
