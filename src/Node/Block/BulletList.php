<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\ListItemBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\ListItem;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList
 */
class BulletList extends BlockNode implements JsonSerializable
{
    use ListItemBuilder;

    protected string $type = 'bulletList';
    protected array $allowedContentTypes = [
        ListItem::class,
    ];
}
