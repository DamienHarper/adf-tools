<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Table;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class TableTest extends TestCase
{
    public function testInvalidPanelType(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new Table('wow'))->toJson();
    }

    public function testEmptyTable(): void
    {
        $doc = json_encode(new Table(Table::LAYOUT_DEFAULT));

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'table',
            'content' => [],
            'attrs' => [
                'layout' => 'default',
                'isNumberColumnEnabled' => false,
            ],
        ]));
    }

    public function testEmptyTableWithNumberedRows(): void
    {
        $doc = json_encode(new Table(Table::LAYOUT_DEFAULT, true));

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'table',
            'content' => [],
            'attrs' => [
                'layout' => 'default',
                'isNumberColumnEnabled' => true,
            ],
        ]));
    }
}
