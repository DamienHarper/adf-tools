<?php

declare(strict_types=1);

use DH\Adf\Mark\Subsup;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class SubsupTest extends TestCase
{
    public function testSub(): void
    {
        $block = new Subsup('sub');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'subsup',
            'attrs' => [
                'type' => 'sub',
            ],
        ]));
    }

    public function testSup(): void
    {
        $block = new Subsup('sup');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'subsup',
            'attrs' => [
                'type' => 'sup',
            ],
        ]));

        $block = new Subsup();
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'subsup',
            'attrs' => [
                'type' => 'sup',
            ],
        ]));
    }
}
