<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Inline;

use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Inline\Extension;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class ExtensionTest extends TestCase
{
    public function testExtension(): void
    {
        $extension = new Extension(
            'default',
            'com.atlassian.confluence.macro.core',
            'toc',
            [
                'macroParams' => [
                    'minLevel' => [
                        'value' => '1',
                    ],
                    'maxLevel' => [
                        'value' => '3',
                    ],
                    'outline' => [
                        'value' => 'false',
                    ],
                    'type' => [
                        'value' => 'list',
                    ],
                    'printable' => [
                        'value' => 'false',
                    ],
                ],
            ],
            '123cad9c-95d8-49df-8b99-00886ba0af5d',
        );
        $doc = $extension->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'type' => 'extension',
            'attrs' => [
                "extensionKey" => "toc",
                "extensionType" => "com.atlassian.confluence.macro.core",
                "layout" => "default",
                "localId" => "123cad9c-95d8-49df-8b99-00886ba0af5d",
                "parameters" => [
                    "macroParams" => [
                        "maxLevel" => [
                            "value" => "3"
                        ],
                        "minLevel" => [
                            "value" => "1"
                        ],
                        "outline" => [
                            "value" => "false"
                        ],
                        "printable" => [
                            "value" => "false"
                        ],
                        "type" => [
                            "value" => "list"
                        ]
                    ]
                ],
            ],
        ]));
    }

    public function testExtensionToDocument(): void
    {
        $doc = (new Document())
            ->extension(
                'default',
                'com.atlassian.confluence.macro.core',
                'toc',
                [],
                '123cad9c-95d8-49df-8b99-00886ba0af5d',
            )
            ->toJson();

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'extension',
                    'attrs' => [
                        "extensionKey" => "toc",
                        "extensionType" => "com.atlassian.confluence.macro.core",
                        "layout" => "default",
                        "localId" => "123cad9c-95d8-49df-8b99-00886ba0af5d"
                    ],
                ],
            ],
        ]));
    }
}
