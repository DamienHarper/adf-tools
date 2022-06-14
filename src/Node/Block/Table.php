<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\TableRowBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\TableRow;
use DH\Adf\Node\Node;
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
    private ?string $localId;

    public function __construct(string $layout = 'default', bool $isNumberColumnEnabled = false, ?string $localId = null, ?BlockNode $parent = null)
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
        $this->localId = $localId;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['layout', 'isNumberColumnEnabled'], $data['attrs']);

        $node = new self($data['attrs']['layout'], (bool) $data['attrs']['isNumberColumnEnabled'], $data['attrs']['localId'] ?? null, $parent);

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

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['layout'] = $this->layout;
        $attrs['isNumberColumnEnabled'] = $this->isNumberColumnEnabled;

        if (null !== $this->localId) {
            $attrs['localId'] = $this->localId;
        }

        return $attrs;
    }
}
