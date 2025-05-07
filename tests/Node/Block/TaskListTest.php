<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\TaskList;
use DH\Adf\Node\Child\TaskItem;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TaskListTest extends TestCase
{
    public function testEmptyTaskList(): void
    {
        $doc = json_encode(new TaskList());

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'taskList',
            'content' => [],
        ]));
    }
}
