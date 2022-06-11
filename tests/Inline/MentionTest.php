<?php

declare(strict_types=1);

use DH\Adf\Inline\Mention;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class MentionTest extends TestCase
{
    public function testInvalidAccessLevel(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new Mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', 'wow'))->toJson();
    }

    public function testInvalidUserType(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new Mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', null, 'wow'))->toJson();
    }

    public function testMention(): void
    {
        $block = new Mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador');
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'mention',
            'attrs' => [
                'id' => 'ABCDE-ABCDE-ABCDE-ABCDE',
                'text' => '@DarkVador',
            ],
        ]));
    }

    public function testMentionWithUserType(): void
    {
        $block = new Mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', null, Mention::USER_TYPE_APP);
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'mention',
            'attrs' => [
                'id' => 'ABCDE-ABCDE-ABCDE-ABCDE',
                'text' => '@DarkVador',
                'userType' => 'APP',
            ],
        ]));
    }

    public function testMentionWithAccessLevel(): void
    {
        $block = new Mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', Mention::ACCESS_LEVEL_APPLICATION);
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'mention',
            'attrs' => [
                'id' => 'ABCDE-ABCDE-ABCDE-ABCDE',
                'text' => '@DarkVador',
                'accessLevel' => 'APPLICATION',
            ],
        ]));
    }
}
