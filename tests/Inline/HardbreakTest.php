<?php

declare(strict_types=1);

use DH\Adf\Inline\Hardbreak;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class HardbreakTest extends TestCase
{
    public function testHardbreak(): void
    {
        $hardbreak = new Hardbreak();
        $doc = $hardbreak->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'hardBreak',
        ]));
    }
}
