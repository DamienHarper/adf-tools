<?php

declare(strict_types=1);

namespace Block;

use DH\Adf\Block\BulletList;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class BulletListTest extends TestCase
{
    public function testEmptyBulletList(): void
    {
        $doc = json_encode(new BulletList());

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'bulletList',
            'content' => [],
        ]));
    }
}
