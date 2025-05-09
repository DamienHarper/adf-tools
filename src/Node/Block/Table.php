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

    public const LAYOUT_START = 'align-start';
    public const LAYOUT_CENTER = 'center';

    protected string $type = 'table';
    protected array $allowedContentTypes = [
        TableRow::class,
    ];
    private string $layout = 'default';
    private bool $isNumberColumnEnabled = false;
    private ?string $localId;
    private ?int $width = null;

    public function __construct(string $layout = 'align-start', bool $isNumberColumnEnabled = false, ?int $width = null, ?string $localId = null, ?BlockNode $parent = null)
    {
        if (!\in_array($layout, [
            self::LAYOUT_START,
            self::LAYOUT_CENTER,
        ], true)) {
            throw new InvalidArgumentException(sprintf('Invalid layout "%s"', $layout));
        }

        parent::__construct($parent);
        $this->layout = $layout;
        $this->isNumberColumnEnabled = $isNumberColumnEnabled;
        $this->localId = $localId;

        if ($width !== null)
            $width = abs($width);
        $this->width = $width;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['layout', 'isNumberColumnEnabled'], $data['attrs']);

        $node = new self($data['attrs']['layout'], (bool) $data['attrs']['isNumberColumnEnabled'], $data['attrs']['width'] ?? null, $data['attrs']['localId'] ?? null, $parent);

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

    public function isNumberColumnEnabled(): bool
    {
        return $this->isNumberColumnEnabled;
    }

    public function getLocalId(): ?string
    {
        return $this->localId;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['layout'] = $this->layout;
        $attrs['isNumberColumnEnabled'] = $this->isNumberColumnEnabled;

        if (null !== $this->localId) {
            $attrs['localId'] = $this->localId;
        }

        if (null !== $this->width) {
            $attrs['width'] = $this->width;
        }

        return $attrs;
    }
}
