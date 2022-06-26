<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Exporter\Html\Block;

use DH\Adf\Exporter\Html\Block\BlockquoteExporter;
use DH\Adf\Node\Block\Blockquote;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class BlockquoteExporterTest extends TestCase
{
    public function testEmptyBlockquote(): void
    {
        $node = new Blockquote();
        $exporter = new BlockquoteExporter($node);

        self::assertSame('<blockquote></blockquote>', $exporter->export());
    }

    public function testBlockquoteWithText(): void
    {
        $node = (new Blockquote())
            ->paragraph()
            ->text('This is a text inside a paragraph wrapped into a blockquote.')
            ->end()
        ;
        $exporter = new BlockquoteExporter($node);

        self::assertSame('<blockquote><p>This is a text inside a paragraph wrapped into a blockquote.</p></blockquote>', $exporter->export());
    }

    public function testBlockquoteWithEmoji(): void
    {
        $node = (new Blockquote())
            ->paragraph()
            ->emoji('poop', '1f4a9', '\\ud83d\\udca9')
            ->end()
        ;
        $exporter = new BlockquoteExporter($node);

        self::assertSame('<blockquote><p><img class="adf-emoji" loading="lazy" src="https://pf-emoji-service--cdn.us-east-1.prod.public.atl-paas.net/standard/a51a7674-8d5d-4495-a2d2-a67c090f5c3b/64x64/1f4a9.png" alt=":poop:" width="20" height="20"></p></blockquote>', $exporter->export());
    }
}
