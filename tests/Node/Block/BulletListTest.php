<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\BulletList;
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
