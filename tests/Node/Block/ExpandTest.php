<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Document;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class ExpandTest extends TestCase
{
    public function testDocumentWithExpand(): void
    {
        $expand = (new Document())->expand('You must unlearn what you have learned.');
        $doc = $expand->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'expand',
            'attrs' => [
                'title' => 'You must unlearn what you have learned.',
            ],
            'content' => [],
        ]));
    }
}
