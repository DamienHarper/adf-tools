<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Blockquote;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class BlockquoteTest extends TestCase
{
    public function testEmptyBlockquote(): void
    {
        $doc = json_encode(new Blockquote());

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'blockquote',
            'content' => [],
        ]));
    }

    public function testBlockquoteWithText(): void
    {
        $doc = (new Blockquote())
            ->paragraph()
            ->text('This is a text inside a paragraph wrapped into a blockquote.')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'blockquote',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'This is a text inside a paragraph wrapped into a blockquote.',
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testBlockquoteWithEmoji(): void
    {
        $doc = (new Blockquote())
            ->paragraph()
            ->emoji('smile', '123', 'text')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'blockquote',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'emoji',
                            'attrs' => [
                                'shortName' => ':smile:',
                                'text' => 'text',
                                'id' => '123',
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }
}
