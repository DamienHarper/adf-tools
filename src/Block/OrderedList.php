<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Child\ListItem;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList
 */
class OrderedList extends BlockNode implements JsonSerializable
{
    use OrderedListBuilder;

    protected string $type = 'orderedList';
    protected array $allowedContentTypes = [
        ListItem::class,
    ];
    private ?int $order;

    public function __construct(?int $order = null, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->order = $order;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        if (null !== $this->order) {
            $attrs['order'] = $this->order;
        }

        return $attrs;
    }
}
