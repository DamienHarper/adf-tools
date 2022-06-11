<?php

declare(strict_types=1);

use DH\Adf\Mark\Link;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class LinkTest extends TestCase
{
    public function testLink(): void
    {
        $link = new Link('https://example.com');
        $doc = $link->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'link',
            'attrs' => [
                'href' => 'https://example.com',
            ],
        ]));
    }

    public function testWithTitle(): void
    {
        $link = new Link('https://example.com', 'a title');
        $doc = $link->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'link',
            'attrs' => [
                'href' => 'https://example.com',
                'title' => 'a title',
            ],
        ]));
    }

    public function testWithId(): void
    {
        $link = new Link('https://example.com', null, 'linkId');
        $doc = $link->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'link',
            'attrs' => [
                'href' => 'https://example.com',
                'id' => 'linkId',
            ],
        ]));
    }

    public function testWithCollection(): void
    {
        $link = new Link('https://example.com', null, null, 'linkCollectionId');
        $doc = $link->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'link',
            'attrs' => [
                'href' => 'https://example.com',
                'collection' => 'linkCollectionId',
            ],
        ]));
    }

    public function testWithOccurrenceKey(): void
    {
        $link = new Link('https://example.com', null, null, null, 'linkOccurrenceKey');
        $doc = $link->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'link',
            'attrs' => [
                'href' => 'https://example.com',
                'occurrenceKey' => 'linkOccurrenceKey',
            ],
        ]));
    }
}
