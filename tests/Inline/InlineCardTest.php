<?php

declare(strict_types=1);

use DH\Adf\Inline\InlineCard;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class InlineCardTest extends TestCase
{
    public function testInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new InlineCard())->toJson();
    }

    public function testInlineCard(): void
    {
        $block = new InlineCard('https://atlassian.com');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'inlineCard',
            'attrs' => [
                'url' => 'https://atlassian.com',
            ],
        ]));
    }

    public function testInlineCardWithData(): void
    {
        $block = new InlineCard(null, 'jsonld');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'inlineCard',
            'attrs' => [
                'data' => 'jsonld',
            ],
        ]));
    }
}
