<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\CodeBlock;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class CodeBlockTest extends TestCase
{
    public function testCodeblockWithLanguage(): void
    {
        $codeblock = (new CodeBlock('python'))->text('import antigravity');
        $doc = $codeblock->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'codeBlock',
            'attrs' => [
                'language' => 'python',
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'import antigravity',
                ],
            ],
        ]));
    }

    public function testCodeblockWithoutLanguage(): void
    {
        $codeblock = (new CodeBlock())->text('import antigravity');
        $doc = $codeblock->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'codeBlock',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'import antigravity',
                ],
            ],
        ]));
    }
}
