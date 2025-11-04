<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Block\Panel;
use DH\Adf\Node\Block\Paragraph;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Mark\Em;
use DH\Adf\Node\Mark\Link;
use DH\Adf\Node\Mark\Strike;
use DH\Adf\Node\Mark\Strong;
use DH\Adf\Node\Mark\Subsup;
use DH\Adf\Node\Mark\TextColor;
use DH\Adf\Node\Mark\Underline;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class DirectAppendTest extends TestCase
{
    public function testDocumentWithEmptyParagraph(): void
    {
        $document = (new Document())
            ->append(
                new Paragraph()
            )
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
            ->append(
                (new Paragraph())
                    ->append(
                        new Text('Luke, ', new TextColor('red')),
                        new Text('may '),
                        new Text('the ', new Em()),
                        new Text('force ', new Strong()),
                        new Text('be '),
                        new Text('with ', new Underline()),
                        new Text('you! ', new Strike()),
                        new Text('Obi-Wan', new Subsup('sub')),
                        new Text('Kenobi', new Subsup('sup')),
                        new Text('Star Wars @ Wikipedia', new Link('https://wikipedia.org/wiki/Star_Wars'))
                    ),
            )
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

    public function testIllegalAppend(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid content type "panel" for block node "paragraph".');

        (new Document())
            ->append(
                (new Paragraph())
                    ->append(new Panel())
            )
        ;
    }
}
