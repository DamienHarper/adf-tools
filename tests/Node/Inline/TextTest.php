<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Inline;

use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Mark\Em;
use DH\Adf\Node\Mark\Strike;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TextTest extends TestCase
{
    public function testSupportsASingleMark(): void
    {
        $text = new Text('some text', new Em());
        $doc = $text->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'text',
            'text' => 'some text',
            'marks' => [
                [
                    'type' => 'em',
                ],
            ],
        ]));
    }

    public function testSupportsMultipleMarks(): void
    {
        $text = new Text('some text', new Em(), new Strike());
        $doc = $text->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'text',
            'text' => 'some text',
            'marks' => [
                [
                    'type' => 'em',
                ],
                [
                    'type' => 'strike',
                ],
            ],
        ]));
    }
}
