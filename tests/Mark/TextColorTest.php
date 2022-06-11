<?php

declare(strict_types=1);

use DH\Adf\Mark\TextColor;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TextColorTest extends TestCase
{
    public function testTextColor(): void
    {
        $block = new TextColor('black');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'textColor',
            'attrs' => [
                'color' => 'black',
            ],
        ]));

        $block = new TextColor('white');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'textColor',
            'attrs' => [
                'color' => 'white',
            ],
        ]));

        $block = new TextColor();
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'textColor',
            'attrs' => [
                'color' => 'black',
            ],
        ]));
    }
}
