<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\TaskItemBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\TaskItem;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList
 */
class TaskList extends BlockNode implements JsonSerializable
{
    use TaskItemBuilder;

    protected string $type = 'taskList';
    protected array $allowedContentTypes = [
        TaskItem::class,
    ];
}
