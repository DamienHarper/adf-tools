<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\TableRowBuilder;
use DH\Adf\Child\TableRow;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table
 */
class Table extends BlockNode
{
    use TableRowBuilder;

    public const LAYOUT_DEFAULT = 'default';
    public const LAYOUT_FULL_WIDTH = 'full-width';
    public const LAYOUT_WIDE = 'wide';

    protected string $type = 'table';
    protected array $allowedContentTypes = [
        TableRow::class,
    ];
    private string $layout = 'default';
    private bool $isNumberColumnEnabled = false;

    public function __construct(string $layout = 'default', bool $isNumberColumnEnabled = false, ?BlockNode $parent = null)
    {
        if (!\in_array($layout, [
            self::LAYOUT_DEFAULT,
            self::LAYOUT_FULL_WIDTH,
            self::LAYOUT_WIDE,
        ], true)) {
            throw new InvalidArgumentException(sprintf('Invalid layout "%s"', $layout));
        }

        parent::__construct($parent);
        $this->layout = $layout;
        $this->isNumberColumnEnabled = $isNumberColumnEnabled;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['layout'] = $this->layout;
        $attrs['isNumberColumnEnabled'] = $this->isNumberColumnEnabled ? 'true' : 'false';

        return $attrs;
    }
}
