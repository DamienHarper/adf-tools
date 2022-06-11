<?php

declare(strict_types=1);

namespace Block;

use DH\Adf\Block\Document;
use DH\Adf\Block\MediaSingle;
use DH\Adf\Block\Panel;
use DH\Adf\Block\Table;
use DH\Adf\Child\Media;
use DH\Adf\Inline\Mention;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class DocumentTest extends TestCase
{
    public function testEmptyDocument(): void
    {
        $document = new Document();

        $doc = json_encode($document);

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [],
        ]));
    }

    public function testDocumentWithEmptyParagraph(): void
    {
        $document = (new Document())
            ->paragraph()
            ->end()
        ;

        $doc = json_encode($document);

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [],
                ],
            ],
        ]));
    }

    public function testDocumentWithTextInParagraph(): void
    {
        $document = (new Document())
            ->paragraph()
            ->color('Luke, ', 'red')
            ->text('may ')
            ->em('the ')
            ->strong('force ')
            ->text('be ')
            ->underline('with ')
            ->strike('you! ')
            ->sub('Obi-Wan')
            ->sup('Kenobi')
            ->Link('Star Wars @ Wikipedia', 'https://wikipedia.org/wiki/Star_Wars')
            ->end()
        ;

        $doc = json_encode($document);

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Luke, ',
                            'marks' => [
                                [
                                    'type' => 'textColor',
                                    'attrs' => [
                                        'color' => 'red',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'may ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'the ',
                            'marks' => [
                                [
                                    'type' => 'em',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'force ',
                            'marks' => [
                                [
                                    'type' => 'strong',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'be ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'with ',
                            'marks' => [
                                [
                                    'type' => 'underline',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'you! ',
                            'marks' => [
                                [
                                    'type' => 'strike',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Obi-Wan',
                            'marks' => [
                                [
                                    'type' => 'subsup',
                                    'attrs' => [
                                        'type' => 'sub',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Kenobi',
                            'marks' => [
                                [
                                    'type' => 'subsup',
                                    'attrs' => [
                                        'type' => 'sup',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Star Wars @ Wikipedia',
                            'marks' => [
                                [
                                    'type' => 'link',
                                    'attrs' => [
                                        'href' => 'https://wikipedia.org/wiki/Star_Wars',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithMentionInParagraph(): void
    {
        $document = (new Document())
            ->paragraph()
            ->mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', Mention::ACCESS_LEVEL_APPLICATION)
            ->end()
        ;

        $doc = json_encode($document);

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'mention',
                            'attrs' => [
                                'id' => 'ABCDE-ABCDE-ABCDE-ABCDE',
                                'text' => '@DarkVador',
                                'accessLevel' => 'APPLICATION',
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithMultipleTextNodes(): void
    {
        $doc = (new Document())
            ->paragraph()
            ->text('Hello world')
            ->text('How are you')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Hello world',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'How are you',
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithBlockquote(): void
    {
        $doc = (new Document())
            ->blockquote()
            ->paragraph()
            ->text('quoted text')
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'blockquote',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'quoted text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithHeading(): void
    {
        $doc = (new Document())
            ->heading(3)
            ->text('heading text')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'heading',
                    'attrs' => [
                        'level' => 3,
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'heading text',
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithCodeblock(): void
    {
        $doc = (new Document())
            ->codeblock('php')
            ->text('var_dump($foo);')
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'codeBlock',
                    'attrs' => [
                        'language' => 'php',
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'var_dump($foo);',
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithBulletList(): void
    {
        $doc = (new Document())
            ->bulletlist()
            ->item()
            ->paragraph()
            ->text('item 1')
            ->end()
            ->end()
            ->item()
            ->paragraph()
            ->text('item 2')
            ->end()
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'bulletList',
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'item 1',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'item 2',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithOrderedList(): void
    {
        $doc = (new Document())
            ->orderedlist()
            ->item()
            ->paragraph()
            ->text('item 1')
            ->end()
            ->end()
            ->item()
            ->paragraph()
            ->text('item 2')
            ->end()
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'orderedList',
                    'attrs' => [
                        'order' => 1,
                    ],
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'item 1',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'item 2',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithPanel(): void
    {
        $doc = (new Document())
            ->panel(Panel::INFO)
            ->paragraph()
            ->text('panel text')
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'panel',
                    'attrs' => [
                        'panelType' => 'info',
                    ],
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'panel text',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithRule(): void
    {
        $doc = (new Document())
            ->rule()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'rule',
                    'content' => [],
                ],
            ],
        ]));
    }

    public function testDocumentWithMediaSingle(): void
    {
        $doc = (new Document())
            ->mediaSingle(MediaSingle::LAYOUT_WIDE)
            ->media('6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'mediaSingle',
                    'attrs' => [
                        'layout' => 'wide',
                    ],
                    'content' => [
                        [
                            'type' => 'media',
                            'attrs' => [
                                'id' => '6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5',
                                'type' => 'file',
                                'collection' => 'my project files',
                                'width' => 100,
                                'height' => 200,
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithMediaGroup(): void
    {
        $doc = (new Document())
            ->mediaGroup()
            ->media('6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->media('7a7c7f2c-dd7a-499c-bceb-6f32bfbf30c7', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->end()
            ->toJSON()
        ;

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'mediaGroup',
                    'content' => [
                        [
                            'type' => 'media',
                            'attrs' => [
                                'id' => '6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5',
                                'type' => 'file',
                                'collection' => 'my project files',
                                'width' => 100,
                                'height' => 200,
                            ],
                        ],
                        [
                            'type' => 'media',
                            'attrs' => [
                                'id' => '7a7c7f2c-dd7a-499c-bceb-6f32bfbf30c7',
                                'type' => 'file',
                                'collection' => 'my project files',
                                'width' => 100,
                                'height' => 200,
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }

    public function testDocumentWithTable(): void
    {
        $doc = (new Document())
            ->table(Table::LAYOUT_DEFAULT)
            ->row()
            ->header()
            ->paragraph()
            ->text('header 1')
            ->end()
            ->end()
            ->header()
            ->paragraph()
            ->text('header 2')
            ->end()
            ->end()
            ->end()
            ->row()
            ->cell()
            ->paragraph()
            ->text('cell 1')
            ->end()
            ->end()
            ->cell()
            ->paragraph()
            ->text('cell 2')
            ->end()
            ->end()
            ->end()
            ->end()
            ->toJSON()
        ;
        // dd($doc);

        self::assertJsonStringEqualsJsonString($doc, json_encode([
            'version' => 1,
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'table',
                    'attrs' => [
                        'isNumberColumnEnabled' => 'false',
                        'layout' => 'default',
                    ],
                    'content' => [
                        [
                            'type' => 'tableRow',
                            'content' => [
                                [
                                    'type' => 'tableHeader',
                                    'content' => [
                                        [
                                            'type' => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'header 1',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'tableHeader',
                                    'content' => [
                                        [
                                            'type' => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'header 2',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'tableRow',
                            'content' => [
                                [
                                    'type' => 'tableCell',
                                    'content' => [
                                        [
                                            'type' => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'cell 1',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    'type' => 'tableCell',
                                    'content' => [
                                        [
                                            'type' => 'paragraph',
                                            'content' => [
                                                [
                                                    'type' => 'text',
                                                    'text' => 'cell 2',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]));
    }
}
