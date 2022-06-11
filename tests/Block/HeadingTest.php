<?php

declare(strict_types=1);

namespace Block;

use DH\Adf\Block\Heading;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class HeadingTest extends TestCase
{
    public function testHeadingWithText(): void
    {
        $heading = (new Heading(2))->text('heading text');
        $doc = $heading->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'heading',
            'attrs' => [
                'level' => 2,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'heading text',
                ],
            ],
        ]));
    }
}
