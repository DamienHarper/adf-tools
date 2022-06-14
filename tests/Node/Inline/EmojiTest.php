<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Inline;

use DH\Adf\Node\Inline\Emoji;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class EmojiTest extends TestCase
{
    public function testEmoji(): void
    {
        $block = new Emoji('smile');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'emoji',
            'attrs' => [
                'shortName' => ':smile:',
            ],
        ]));
    }
}
