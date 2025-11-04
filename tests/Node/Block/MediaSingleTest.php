<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\MediaSingle;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class MediaSingleTest extends TestCase
{
    public function testInvalidPanelType(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new MediaSingle('wow'))->toJson();
    }

    public function testEmptyMediaSingle(): void
    {
        $doc = json_encode(new MediaSingle(MediaSingle::LAYOUT_WRAP_LEFT));

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'mediaSingle',
            'content' => [],
            'attrs' => [
                'layout' => 'wrap-left',
            ],
        ]));
    }

    public function testEmptyMediaSingleWithWidth(): void
    {
        $doc = json_encode(new MediaSingle(MediaSingle::LAYOUT_WRAP_LEFT, 80));

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'mediaSingle',
            'content' => [],
            'attrs' => [
                'layout' => 'wrap-left',
                'width' => 80,
            ],
        ]));
    }

    public function testWidthWithFloatValue(): void
    {
        $json = [
            'type' => 'mediaSingle',
            'content' => [],
            'attrs' => [
                'layout' => 'wrap-left',
                'width' => 80.5,
            ],
        ];

        $doc = MediaSingle::load($json);
        self::assertInstanceOf(MediaSingle::class, $doc);
    }
}
