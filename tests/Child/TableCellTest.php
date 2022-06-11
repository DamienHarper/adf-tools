<?php

declare(strict_types=1);

use DH\Adf\Child\TableCell;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TableCellTest extends TestCase
{
    public function testEmptyTableCell(): void
    {
        $block = new TableCell();
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'tableCell',
            'content' => [],
        ]));
    }

    public function testEmptyTableCellWithAttributes(): void
    {
        $block = new TableCell('white', 1, 2, [3, 4]);
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'tableCell',
            'content' => [],
            'attrs' => [
                'background' => 'white',
                'colspan' => 1,
                'rowspan' => 2,
                'colwidth' => [3, 4],
            ],
        ]));
    }

    public function testTableCellWithParagraph(): void
    {
        $block = (new TableCell())
            ->paragraph()
            ->text('Hello World')
            ->end()
        ;
        $doc = $block->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'tableCell',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Hello World',
                        ],
                    ],
                ],
            ],
        ]));
    }
}
