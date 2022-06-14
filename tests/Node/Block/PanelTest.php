<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Panel;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class PanelTest extends TestCase
{
    public function testInvalidPanelType(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new Panel('wow'))->toJson();
    }

    public function testEmptyPanel(): void
    {
        $doc = (new Panel(Panel::INFO))->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'panel',
            'attrs' => [
                'panelType' => 'info',
            ],
            'content' => [],
        ]));
    }

    public function testPanelWithText(): void
    {
        $doc = (new Panel(Panel::INFO))
            ->paragraph()
            ->text('Here is a panel with some text.')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'panel',
            'attrs' => [
                'panelType' => 'info',
            ],
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Here is a panel with some text.',
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testPanelWithEmoji(): void
    {
        $doc = (new Panel(Panel::INFO))
            ->paragraph()
            ->emoji('smile', '123', 'text')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'panel',
            'attrs' => [
                'panelType' => 'info',
            ],
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'emoji',
                            'attrs' => [
                                'shortName' => ':smile:',
                                'id' => '123',
                                'text' => 'text',
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }
}
