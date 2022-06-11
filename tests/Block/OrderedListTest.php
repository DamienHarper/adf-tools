<?php

declare(strict_types=1);

namespace Block;

use DH\Adf\Block\OrderedList;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class OrderedListTest extends TestCase
{
    public function testEmptyBulletListWithoutOrder(): void
    {
        $doc = json_encode(new OrderedList());

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'orderedList',
            'content' => [],
        ]));
    }

    public function testEmptyBulletListWithOrder(): void
    {
        $doc = json_encode(new OrderedList(1));

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'orderedList',
            'content' => [],
            'attrs' => [
                'order' => 1,
            ],
        ]));
    }
}
