<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\ListItemBuilder;
use DH\Adf\Child\ListItem;
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
