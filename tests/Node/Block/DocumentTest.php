<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Block;

use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Block\MediaSingle;
use DH\Adf\Node\Block\Panel;
use DH\Adf\Node\Block\Table;
use DH\Adf\Node\Child\Media;
use DH\Adf\Node\Inline\Mention;
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
            ->table(Table::LAYOUT_CENTER)
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
                        'isNumberColumnEnabled' => false,
                        'layout' => 'center',
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

    public function testLoad(): void
    {
        $json = <<<'TXT'
{"version":1,"type":"doc","content":[{"type":"heading","attrs":{"level":1},"content":[{"type":"text","text":"En-t\u00eate #1"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#008da6"}}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"textColor","attrs":{"color":"#6554c0"}}]},{"type":"text","text":" "},{"type":"text","text":"dolor","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#4c9aff"}}]},{"type":"text","text":" "},{"type":"text","text":"sit","marks":[{"type":"textColor","attrs":{"color":"#00b8d9"}}]},{"type":"text","text":" "},{"type":"text","text":"amet","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#ffc400"}}]}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"em"}]},{"type":"text","text":" "},{"type":"text","text":"dolor","marks":[{"type":"underline"}]},{"type":"text","text":" "},{"type":"text","text":"sit","marks":[{"type":"strike"}]},{"type":"text","text":" "},{"type":"text","text":"amet","marks":[{"type":"code"}]}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"},{"type":"subsup","attrs":{"type":"sub"}}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"em"},{"type":"subsup","attrs":{"type":"sup"}}]}]},{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]},{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2.1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2.2"}]}]}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3"}]}]}]},{"type":"paragraph","content":[{"type":"text","text":"This is a link!","marks":[{"type":"link","attrs":{"href":"https://www.google.fr","title":"Google"}}]}]},{"type":"heading","attrs":{"level":2},"content":[{"type":"text","text":"En-t\u00eate #2"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3.1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3.2"}]}]}]}]}]},{"type":"heading","attrs":{"level":3},"content":[{"type":"text","text":"En-t\u00eate #3"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum"}]},{"type":"paragraph","content":[{"type":"inlineCard","attrs":{"url":"https:\/\/github.com"}},{"type":"text","text":" "}]},{"type":"mediaSingle","attrs":{"layout":"align-start"},"content":[{"type":"media","attrs":{"id":"d7174b86-2fb7-4126-991d-0e2fc9f0dac7","type":"file","collection":"","width":483,"height":130}}]},{"type":"paragraph","content":[{"type":"text","text":"Yo "},{"type":"mention","attrs":{"id":"60196ed3cd564b0068440c33","text":"@Damien Harper","accessLevel":""}},{"type":"text","text":", tu peux check ce ticket please "},{"type":"emoji","attrs":{"shortName":":poop:","id":"1f4a9","text":"\ud83d\udca9"}},{"type":"text","text":" "}]},{"type":"table","attrs":{"isNumberColumnEnabled":false,"layout":"center","localId":"e77ccf12-2262-42ea-a9f2-979c14ff1efc"},"content":[{"type":"tableRow","content":[{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 1","marks":[{"type":"strong"}]}]}]},{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 2","marks":[{"type":"strong"}]}]}]},{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 3","marks":[{"type":"strong"}]}]}]}]},{"type":"tableRow","content":[{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"}]}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"ipsum","marks":[{"type":"em"}]}]}]},{"type":"tableCell","content":[{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]}]}]}]}]},{"type":"tableRow","content":[{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"dolor"}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"sit"}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"amet","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#00b8d9"}},{"type":"underline"}]}]}]}]}]},{"type":"rule"},{"type":"codeBlock","attrs":{"language":"php"},"content":[{"type":"text","text":"<?php\n\ndeclare(strict_types=1);\n\nnamespace DH\\Adf\\Block;\n\nuse DH\\Adf\\BlockNode;\nuse DH\\Adf\\Builder\\BlockquoteBuilder;\nuse DH\\Adf\\Builder\\BulletListBuilder;\nuse DH\\Adf\\Builder\\CodeblockBuilder;\nuse DH\\Adf\\Builder\\HeadingBuilder;\nuse DH\\Adf\\Builder\\MediaGroupBuilder;\nuse DH\\Adf\\Builder\\MediaSingleBuilder;\nuse DH\\Adf\\Builder\\OrderedListBuilder;\nuse DH\\Adf\\Builder\\PanelBuilder;\nuse DH\\Adf\\Builder\\ParagraphBuilder;\nuse DH\\Adf\\Builder\\RuleBuilder;\nuse DH\\Adf\\Builder\\TableBuilder;\nuse JsonSerializable;\n\n\/**\n * @see https:\/\/developer.atlassian.com\/cloud\/jira\/platform\/apis\/document\/structure\/#root-block-node\n *\/\nclass Document extends BlockNode implements JsonSerializable\n{\n    use BlockquoteBuilder;\n    use BulletListBuilder;\n    use CodeblockBuilder;\n    use HeadingBuilder;\n    use MediaGroupBuilder;\n    use MediaSingleBuilder;\n    use OrderedListBuilder;\n    use PanelBuilder;\n    use ParagraphBuilder;\n    use RuleBuilder;\n    use TableBuilder;\n\n    protected string $type = 'doc';\n    protected array $allowedContentTypes = [\n        Blockquote::class,\n        BulletList::class,\n        CodeBlock::class,\n        Heading::class,\n        MediaGroup::class,\n        MediaSingle::class,\n        OrderedList::class,\n        Panel::class,\n        Paragraph::class,\n        Rule::class,\n        Table::class,\n    ];\n    private int $version = 1;\n\n    public function jsonSerialize(): array\n    {\n        $result = parent::jsonSerialize();\n        $result['version'] = $this->version;\n\n        return $result;\n    }\n}\n"}]},{"type":"panel","attrs":{"panelType":"info"},"content":[{"type":"paragraph","content":[{"type":"text","text":"Info news"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item "},{"type":"text","text":"1","marks":[{"type":"strong"}]}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item "},{"type":"text","text":"2","marks":[{"type":"strong"}]}]}]}]}]},{"type":"panel","attrs":{"panelType":"warning"},"content":[{"type":"paragraph","content":[{"type":"text","text":"warning!"}]}]},{"type":"blockquote","content":[{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum ","marks":[{"type":"em"}]}]},{"type":"paragraph","content":[{"type":"text","text":"dolor sit amet","marks":[{"type":"em"}]}]}]},{"type":"heading","attrs":{"level":1},"content":[{"type":"text","text":"En-t\u00eate #1 bis"}]},{"type":"paragraph","content":[{"type":"status","attrs":{"text":"In progress","color":"blue","localId":"05c0d929-8e76-4469-94f8-0762cc0216bf","style":""}},{"type":"text","text":" "},{"type":"status","attrs":{"text":"TODO","color":"neutral","localId":"9163f1e7-d30a-451b-90d3-eb43b505b38c","style":""}},{"type":"text","text":" "},{"type":"status","attrs":{"text":"Done","color":"green","localId":"bf2a0f38-c488-49ab-8faa-e749c6e37841","style":""}},{"type":"text","text":" "}]},{"type":"paragraph","content":[{"type":"date","attrs":{"timestamp":"1655424000000"}},{"type":"text","text":" "}]},{"type":"paragraph","content":[]},{"type":"expand","attrs":{"title":"Section masquable"},"content":[{"type":"paragraph","content":[{"type":"text","text":"Texte qui peut se cacher "},{"type":"emoji","attrs":{"shortName":":slight_smile:","id":"1f642","text":"\ud83d\ude42"}},{"type":"text","text":" "}]}]}]}
TXT;
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $doc = Document::load($data);

        self::assertJsonStringEqualsJsonString($json, $doc->toJson());
    }
}
