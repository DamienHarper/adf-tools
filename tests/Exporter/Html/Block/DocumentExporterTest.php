<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Exporter\Html\Block;

use DH\Adf\Exporter\Html\Block\DocumentExporter;
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
final class DocumentExporterTest extends TestCase
{
    public function testEmptyDocument(): void
    {
        $document = new Document();
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"></div>', $exporter->export());
    }

    public function testDocumentWithEmptyParagraph(): void
    {
        $document = (new Document())
            ->paragraph()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><p></p></div>', $exporter->export());
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
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><p><span style="color: red">Luke, </span>may <em>the </em><strong>force </strong>be <u>with </u><s>you! </s><sub>Obi-Wan</sub><sup>Kenobi</sup><a href="https://wikipedia.org/wiki/Star_Wars" title="">Star Wars @ Wikipedia</a></p></div>', $exporter->export());
    }

    public function testDocumentWithMentionInParagraph(): void
    {
        $document = (new Document())
            ->paragraph()
            ->mention('ABCDE-ABCDE-ABCDE-ABCDE', '@DarkVador', Mention::ACCESS_LEVEL_APPLICATION)
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><p><span class="adf-mention">@DarkVador</span></p></div>', $exporter->export());
    }

    public function testDocumentWithMultipleTextNodes(): void
    {
        $document = (new Document())
            ->paragraph()
            ->text('Hello world')
            ->text('How are you')
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><p>Hello worldHow are you</p></div>', $exporter->export());
    }

    public function testDocumentWithBlockquote(): void
    {
        $document = (new Document())
            ->blockquote()
            ->paragraph()
            ->text('quoted text')
            ->end()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><blockquote><p>quoted text</p></blockquote></div>', $exporter->export());
    }

    public function testDocumentWithHeading(): void
    {
        $document = (new Document())
            ->heading(3)
            ->text('heading text')
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><h3>heading text</h3></div>', $exporter->export());
    }

    public function testDocumentWithCodeblock(): void
    {
        $document = (new Document())
            ->codeblock('php')
            ->text('var_dump($foo);')
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><pre class="php">var_dump($foo);</pre></div>', $exporter->export());
    }

    public function testDocumentWithBulletList(): void
    {
        $document = (new Document())
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
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><ul><li><p>item 1</p></li><li><p>item 2</p></li></ul></div>', $exporter->export());
    }

    public function testDocumentWithOrderedList(): void
    {
        $document = (new Document())
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
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><ol><li><p>item 1</p></li><li><p>item 2</p></li></ol></div>', $exporter->export());
    }

    public function testDocumentWithTaskList(): void
    {
        $document = (new Document())
            ->tasklist()
            ->item(true)
            ->text('item 1')
            ->end()
            ->item(false)
            ->text('item 2')
            ->end()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><ul class="adf-task-list" style="list-style-type: none"><li><label><input class="adf-task-checkbox" type="checkbox" disabled >item 1</label></li><li><label><input class="adf-task-checkbox" type="checkbox" disabled checked>item 2</label></li></ul></div>', $exporter->export());
    }

    public function testDocumentWithPanel(): void
    {
        $document = (new Document())
            ->panel(Panel::INFO)
            ->paragraph()
            ->text('panel text')
            ->end()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><div class="adf-panel adf-panel-info"><div class="adf-panel-icon"><span role="img" aria-label="Panel info"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="presentation"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C9.34784 22 6.8043 20.9464 4.92893 19.0711C3.05357 17.1957 2 14.6522 2 12C2 9.34784 3.05357 6.8043 4.92893 4.92893C6.8043 3.05357 9.34784 2 12 2C14.6522 2 17.1957 3.05357 19.0711 4.92893C20.9464 6.8043 22 9.34784 22 12C22 14.6522 20.9464 17.1957 19.0711 19.0711C17.1957 20.9464 14.6522 22 12 22V22ZM12 11.375C11.6685 11.375 11.3505 11.5067 11.1161 11.7411C10.8817 11.9755 10.75 12.2935 10.75 12.625V15.75C10.75 16.0815 10.8817 16.3995 11.1161 16.6339C11.3505 16.8683 11.6685 17 12 17C12.3315 17 12.6495 16.8683 12.8839 16.6339C13.1183 16.3995 13.25 16.0815 13.25 15.75V12.625C13.25 12.2935 13.1183 11.9755 12.8839 11.7411C12.6495 11.5067 12.3315 11.375 12 11.375ZM12 9.96875C12.4558 9.96875 12.893 9.78767 13.2153 9.46534C13.5377 9.14301 13.7188 8.70584 13.7188 8.25C13.7188 7.79416 13.5377 7.35699 13.2153 7.03466C12.893 6.71233 12.4558 6.53125 12 6.53125C11.5442 6.53125 11.107 6.71233 10.7847 7.03466C10.4623 7.35699 10.2812 7.79416 10.2812 8.25C10.2812 8.70584 10.4623 9.14301 10.7847 9.46534C11.107 9.78767 11.5442 9.96875 12 9.96875Z" fill="currentColor"></path></svg></span></div><div class="adf-panel-content"><p>panel text</p></div></div></div>', $exporter->export());
    }

    public function testDocumentWithRule(): void
    {
        $document = (new Document())
            ->rule()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><hr/></div>', $exporter->export());
    }

    public function testDocumentWithMediaSingle(): void
    {
        $document = (new Document())
            ->mediaSingle(MediaSingle::LAYOUT_WIDE)
            ->media('6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><div class="adf-mediasingle"><div class="adf-media"><!--{"type":"media","attrs":{"id":"6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5","type":"file","collection":"my project files","width":100,"height":200}}--><p>Atlassian Media API is not publicly available at the moment.</p></div></div></div>', $exporter->export());
    }

    public function testDocumentWithMediaGroup(): void
    {
        $document = (new Document())
            ->mediaGroup()
            ->media('6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->media('7a7c7f2c-dd7a-499c-bceb-6f32bfbf30c7', Media::TYPE_FILE, 'my project files', 100, 200)
            ->end()
            ->end()
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><div class="adf-mediagroup"><div class="adf-media"><!--{"type":"media","attrs":{"id":"6e7c7f2c-dd7a-499c-bceb-6f32bfbf30b5","type":"file","collection":"my project files","width":100,"height":200}}--><p>Atlassian Media API is not publicly available at the moment.</p></div><div class="adf-media"><!--{"type":"media","attrs":{"id":"7a7c7f2c-dd7a-499c-bceb-6f32bfbf30c7","type":"file","collection":"my project files","width":100,"height":200}}--><p>Atlassian Media API is not publicly available at the moment.</p></div></div></div>', $exporter->export());
    }

    public function testDocumentWithTable(): void
    {
        $document = (new Document())
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
        ;
        $exporter = new DocumentExporter($document);

        self::assertSame('<div class="adf-container"><table class="adf-table-default"><tbody><tr><th><p>header 1</p></th><th><p>header 2</p></th></tr><tr><td><p>cell 1</p></td><td><p>cell 2</p></td></tr></tbody></table></div>', $exporter->export());
    }

    public function testLoad(): void
    {
        $json = <<<'TXT'
{"version":1,"type":"doc","content":[{"type":"heading","attrs":{"level":1},"content":[{"type":"text","text":"En-t\u00eate #1"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#008da6"}}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"textColor","attrs":{"color":"#6554c0"}}]},{"type":"text","text":" "},{"type":"text","text":"dolor","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#4c9aff"}}]},{"type":"text","text":" "},{"type":"text","text":"sit","marks":[{"type":"textColor","attrs":{"color":"#00b8d9"}}]},{"type":"text","text":" "},{"type":"text","text":"amet","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#ffc400"}}]}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"em"}]},{"type":"text","text":" "},{"type":"text","text":"dolor","marks":[{"type":"underline"}]},{"type":"text","text":" "},{"type":"text","text":"sit","marks":[{"type":"strike"}]},{"type":"text","text":" "},{"type":"text","text":"amet","marks":[{"type":"code"}]}]},{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"},{"type":"subsup","attrs":{"type":"sub"}}]},{"type":"text","text":" "},{"type":"text","text":"ipsum","marks":[{"type":"em"},{"type":"subsup","attrs":{"type":"sup"}}]}]},{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]},{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2.1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2.2"}]}]}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3"}]}]}]},{"type":"paragraph","content":[{"type":"text","text":"This is a link!","marks":[{"type":"link","attrs":{"href":"https://www.google.fr","title":"Google"}}]}]},{"type":"heading","attrs":{"level":2},"content":[{"type":"text","text":"En-t\u00eate #2"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3.1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 3.2"}]}]}]}]}]},{"type":"taskList","content":[{"type":"taskItem","content":[{"type":"text","text":"Test Task 1"}],"attrs":{"state":"TODO"}},{"type":"taskItem","content":[{"type":"text","text":"Test Task 2"}],"attrs":{"state":"DONE"}}]},{"type":"heading","attrs":{"level":3},"content":[{"type":"text","text":"En-t\u00eate #3"}]},{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum"}]},{"type":"paragraph","content":[{"type":"inlineCard","attrs":{"url":"https:\/\/github.com"}},{"type":"text","text":" "}]},{"type":"mediaSingle","attrs":{"layout":"align-start"},"content":[{"type":"media","attrs":{"id":"d7174b86-2fb7-4126-991d-0e2fc9f0dac7","type":"file","collection":"","width":483,"height":130}}]},{"type":"paragraph","content":[{"type":"text","text":"Yo "},{"type":"mention","attrs":{"id":"60196ed3cd564b0068440c33","text":"@Damien Harper","accessLevel":""}},{"type":"text","text":", tu peux check ce ticket please "},{"type":"emoji","attrs":{"shortName":":poop:","id":"1f4a9","text":"\ud83d\udca9"}},{"type":"text","text":" "}]},{"type":"table","attrs":{"isNumberColumnEnabled":false,"layout":"default","localId":"e77ccf12-2262-42ea-a9f2-979c14ff1efc"},"content":[{"type":"tableRow","content":[{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 1","marks":[{"type":"strong"}]}]}]},{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 2","marks":[{"type":"strong"}]}]}]},{"type":"tableHeader","content":[{"type":"paragraph","content":[{"type":"text","text":"Col 3","marks":[{"type":"strong"}]}]}]}]},{"type":"tableRow","content":[{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"lorem","marks":[{"type":"strong"}]}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"ipsum","marks":[{"type":"em"}]}]}]},{"type":"tableCell","content":[{"type":"bulletList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 1"}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item 2"}]}]}]}]}]},{"type":"tableRow","content":[{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"dolor"}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"sit"}]}]},{"type":"tableCell","content":[{"type":"paragraph","content":[{"type":"text","text":"amet","marks":[{"type":"strong"},{"type":"textColor","attrs":{"color":"#00b8d9"}},{"type":"underline"}]}]}]}]}]},{"type":"rule"},{"type":"codeBlock","attrs":{"language":"php"},"content":[{"type":"text","text":"<?php\n\ndeclare(strict_types=1);\n\nnamespace DH\\Adf\\Block;\n\nuse DH\\Adf\\BlockNode;\nuse DH\\Adf\\Builder\\BlockquoteBuilder;\nuse DH\\Adf\\Builder\\BulletListBuilder;\nuse DH\\Adf\\Builder\\CodeblockBuilder;\nuse DH\\Adf\\Builder\\HeadingBuilder;\nuse DH\\Adf\\Builder\\MediaGroupBuilder;\nuse DH\\Adf\\Builder\\MediaSingleBuilder;\nuse DH\\Adf\\Builder\\OrderedListBuilder;\nuse DH\\Adf\\Builder\\PanelBuilder;\nuse DH\\Adf\\Builder\\ParagraphBuilder;\nuse DH\\Adf\\Builder\\RuleBuilder;\nuse DH\\Adf\\Builder\\TableBuilder;\nuse DH\\Adf\\Builder\\TaskListBuilder;\nuse JsonSerializable;\n\n\/**\n * @see https:\/\/developer.atlassian.com\/cloud\/jira\/platform\/apis\/document\/structure\/#root-block-node\n *\/\nclass Document extends BlockNode implements JsonSerializable\n{\n    use BlockquoteBuilder;\n    use BulletListBuilder;\n    use CodeblockBuilder;\n    use HeadingBuilder;\n    use MediaGroupBuilder;\n    use MediaSingleBuilder;\n    use OrderedListBuilder;\n    use PanelBuilder;\n    use ParagraphBuilder;\n    use RuleBuilder;\n    use TableBuilder;\n    use TaskListBuilder;\n\n    protected string $type = 'doc';\n    protected array $allowedContentTypes = [\n        Blockquote::class,\n        BulletList::class,\n        CodeBlock::class,\n        Heading::class,\n        MediaGroup::class,\n        MediaSingle::class,\n        OrderedList::class,\n        Panel::class,\n        Paragraph::class,\n        Rule::class,\n        Table::class,\n        TaskList::class,\n    ];\n    private int $version = 1;\n\n    public function jsonSerialize(): array\n    {\n        $result = parent::jsonSerialize();\n        $result['version'] = $this->version;\n\n        return $result;\n    }\n}\n"}]},{"type":"panel","attrs":{"panelType":"info"},"content":[{"type":"paragraph","content":[{"type":"text","text":"Info news"}]},{"type":"orderedList","content":[{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item "},{"type":"text","text":"1","marks":[{"type":"strong"}]}]}]},{"type":"listItem","content":[{"type":"paragraph","content":[{"type":"text","text":"item "},{"type":"text","text":"2","marks":[{"type":"strong"}]}]}]}]}]},{"type":"panel","attrs":{"panelType":"warning"},"content":[{"type":"paragraph","content":[{"type":"text","text":"warning!"}]}]},{"type":"blockquote","content":[{"type":"paragraph","content":[{"type":"text","text":"lorem ipsum ","marks":[{"type":"em"}]}]},{"type":"paragraph","content":[{"type":"text","text":"dolor sit amet","marks":[{"type":"em"}]}]}]},{"type":"heading","attrs":{"level":1},"content":[{"type":"text","text":"En-t\u00eate #1 bis"}]},{"type":"paragraph","content":[{"type":"status","attrs":{"text":"In progress","color":"blue","localId":"05c0d929-8e76-4469-94f8-0762cc0216bf","style":""}},{"type":"text","text":" "},{"type":"status","attrs":{"text":"TODO","color":"neutral","localId":"9163f1e7-d30a-451b-90d3-eb43b505b38c","style":""}},{"type":"text","text":" "},{"type":"status","attrs":{"text":"Done","color":"green","localId":"bf2a0f38-c488-49ab-8faa-e749c6e37841","style":""}},{"type":"text","text":" "}]},{"type":"paragraph","content":[{"type":"date","attrs":{"timestamp":"1655424000000"}},{"type":"text","text":" "}]},{"type":"paragraph","content":[]},{"type":"expand","attrs":{"title":"Section masquable"},"content":[{"type":"paragraph","content":[{"type":"text","text":"Texte qui peut se cacher "},{"type":"emoji","attrs":{"shortName":":slight_smile:","id":"1f642","text":"\ud83d\ude42"}},{"type":"text","text":" "}]}]}]}
TXT;
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $document = Document::load($data);

        \assert($document instanceof Document);
        $exporter = new DocumentExporter($document);

        $expected = <<<'TXT'
<div class="adf-container"><h1>En-tête #1</h1><p><span style="color: #008da6"><strong>lorem</strong></span> <span style="color: #6554c0">ipsum</span> <span style="color: #4c9aff"><strong>dolor</strong></span> <span style="color: #00b8d9">sit</span> <span style="color: #ffc400"><strong>amet</strong></span></p><p><strong>lorem</strong> <em>ipsum</em> <u>dolor</u> <s>sit</s> <pre>amet</pre></p><p><sub><strong>lorem</strong></sub> <sup><em>ipsum</em></sup></p><ul><li><p>item 1</p></li><li><p>item 2</p><ul><li><p>item 2.1</p></li><li><p>item 2.2</p></li></ul></li><li><p>item 3</p></li></ul><p><a href="https://www.google.fr" title="Google">This is a link!</a></p><h2>En-tête #2</h2><p>lorem ipsum</p><ol><li><p>item 1</p></li><li><p>item 2</p></li><li><p>item 3</p><ol><li><p>item 3.1</p></li><li><p>item 3.2</p></li></ol></li></ol><ul class="adf-task-list" style="list-style-type: none"><li><label><input class="adf-task-checkbox" type="checkbox" disabled >Test Task 1</label></li><li><label><input class="adf-task-checkbox" type="checkbox" disabled checked>Test Task 2</label></li></ul><h3>En-tête #3</h3><p>lorem ipsum</p><p><div class="adf-inline-card">https://github.com</div> </p><div class="adf-mediasingle"><div class="adf-media"><!--{"type":"media","attrs":{"id":"d7174b86-2fb7-4126-991d-0e2fc9f0dac7","type":"file","collection":"","width":483,"height":130}}--><p>Atlassian Media API is not publicly available at the moment.</p></div></div><p>Yo <span class="adf-mention">@Damien Harper</span>, tu peux check ce ticket please <img class="adf-emoji" loading="lazy" src="https://pf-emoji-service--cdn.us-east-1.prod.public.atl-paas.net/standard/a51a7674-8d5d-4495-a2d2-a67c090f5c3b/64x64/1f4a9.png" alt=":poop:" width="20" height="20"> </p><table class="adf-table-default"><tbody><tr><th><p><strong>Col 1</strong></p></th><th><p><strong>Col 2</strong></p></th><th><p><strong>Col 3</strong></p></th></tr><tr><td><p><strong>lorem</strong></p></td><td><p><em>ipsum</em></p></td><td><ul><li><p>item 1</p></li><li><p>item 2</p></li></ul></td></tr><tr><td><p>dolor</p></td><td><p>sit</p></td><td><p><u><span style="color: #00b8d9"><strong>amet</strong></span></u></p></td></tr></tbody></table><hr/><pre class="php"><?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\BlockquoteBuilder;
use DH\Adf\Builder\BulletListBuilder;
use DH\Adf\Builder\CodeblockBuilder;
use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\MediaGroupBuilder;
use DH\Adf\Builder\MediaSingleBuilder;
use DH\Adf\Builder\OrderedListBuilder;
use DH\Adf\Builder\PanelBuilder;
use DH\Adf\Builder\ParagraphBuilder;
use DH\Adf\Builder\RuleBuilder;
use DH\Adf\Builder\TableBuilder;
use DH\Adf\Builder\TaskListBuilder;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/structure/#root-block-node
 */
class Document extends BlockNode implements JsonSerializable
{
    use BlockquoteBuilder;
    use BulletListBuilder;
    use CodeblockBuilder;
    use HeadingBuilder;
    use MediaGroupBuilder;
    use MediaSingleBuilder;
    use OrderedListBuilder;
    use PanelBuilder;
    use ParagraphBuilder;
    use RuleBuilder;
    use TableBuilder;
    use TaskListBuilder;

    protected string $type = 'doc';
    protected array $allowedContentTypes = [
        Blockquote::class,
        BulletList::class,
        CodeBlock::class,
        Heading::class,
        MediaGroup::class,
        MediaSingle::class,
        OrderedList::class,
        Panel::class,
        Paragraph::class,
        Rule::class,
        Table::class,
        TaskList::class,
    ];
    private int $version = 1;

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['version'] = $this->version;

        return $result;
    }
}
</pre><div class="adf-panel adf-panel-info"><div class="adf-panel-icon"><span role="img" aria-label="Panel info"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="presentation"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C9.34784 22 6.8043 20.9464 4.92893 19.0711C3.05357 17.1957 2 14.6522 2 12C2 9.34784 3.05357 6.8043 4.92893 4.92893C6.8043 3.05357 9.34784 2 12 2C14.6522 2 17.1957 3.05357 19.0711 4.92893C20.9464 6.8043 22 9.34784 22 12C22 14.6522 20.9464 17.1957 19.0711 19.0711C17.1957 20.9464 14.6522 22 12 22V22ZM12 11.375C11.6685 11.375 11.3505 11.5067 11.1161 11.7411C10.8817 11.9755 10.75 12.2935 10.75 12.625V15.75C10.75 16.0815 10.8817 16.3995 11.1161 16.6339C11.3505 16.8683 11.6685 17 12 17C12.3315 17 12.6495 16.8683 12.8839 16.6339C13.1183 16.3995 13.25 16.0815 13.25 15.75V12.625C13.25 12.2935 13.1183 11.9755 12.8839 11.7411C12.6495 11.5067 12.3315 11.375 12 11.375ZM12 9.96875C12.4558 9.96875 12.893 9.78767 13.2153 9.46534C13.5377 9.14301 13.7188 8.70584 13.7188 8.25C13.7188 7.79416 13.5377 7.35699 13.2153 7.03466C12.893 6.71233 12.4558 6.53125 12 6.53125C11.5442 6.53125 11.107 6.71233 10.7847 7.03466C10.4623 7.35699 10.2812 7.79416 10.2812 8.25C10.2812 8.70584 10.4623 9.14301 10.7847 9.46534C11.107 9.78767 11.5442 9.96875 12 9.96875Z" fill="currentColor"></path></svg></span></div><div class="adf-panel-content"><p>Info news</p><ol><li><p>item <strong>1</strong></p></li><li><p>item <strong>2</strong></p></li></ol></div></div><div class="adf-panel adf-panel-warning"><div class="adf-panel-icon"><span role="img" aria-label="Panel warning"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" role="presentation"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.4897 4.34592L21.8561 18.8611C21.9525 19.0288 22.0021 19.2181 21.9999 19.4101C21.9977 19.6021 21.9438 19.7903 21.8435 19.9559C21.7432 20.1215 21.6001 20.2588 21.4282 20.3542C21.2563 20.4497 21.0616 20.4999 20.8636 20.5H3.13707C2.93882 20.5 2.74401 20.4498 2.57196 20.3543C2.39992 20.2588 2.25663 20.1213 2.15631 19.9556C2.05598 19.7898 2.00212 19.6015 2.00006 19.4093C1.998 19.2171 2.04782 19.0278 2.14456 18.86L10.5121 4.34592C10.6602 4.08939 10.8762 3.87577 11.1377 3.72708C11.3993 3.57838 11.6971 3.5 12.0003 3.5C12.3036 3.5 12.6013 3.57838 12.8629 3.72708C13.1245 3.87577 13.3404 4.08939 13.4885 4.34592H13.4897ZM12.0003 7.82538C11.8232 7.82537 11.6482 7.86212 11.4869 7.93317C11.3257 8.00423 11.182 8.10793 11.0656 8.2373C10.9492 8.36668 10.8627 8.51872 10.8119 8.68321C10.7611 8.8477 10.7473 9.02083 10.7713 9.19093L11.3546 13.3416C11.3754 13.4933 11.4523 13.6326 11.5711 13.7334C11.6899 13.8343 11.8424 13.8899 12.0003 13.8899C12.1582 13.8899 12.3107 13.8343 12.4295 13.7334C12.5483 13.6326 12.6253 13.4933 12.6461 13.3416L13.2293 9.19093C13.2533 9.02083 13.2395 8.8477 13.1887 8.68321C13.138 8.51872 13.0515 8.36668 12.935 8.2373C12.8186 8.10793 12.6749 8.00423 12.5137 7.93317C12.3525 7.86212 12.1774 7.82537 12.0003 7.82538V7.82538ZM12.0003 17.3369C12.3395 17.3369 12.6649 17.2062 12.9047 16.9737C13.1446 16.7412 13.2793 16.4258 13.2793 16.0969C13.2793 15.7681 13.1446 15.4527 12.9047 15.2202C12.6649 14.9877 12.3395 14.857 12.0003 14.857C11.6611 14.857 11.3358 14.9877 11.0959 15.2202C10.8561 15.4527 10.7213 15.7681 10.7213 16.0969C10.7213 16.4258 10.8561 16.7412 11.0959 16.9737C11.3358 17.2062 11.6611 17.3369 12.0003 17.3369V17.3369Z" fill="currentColor"></path></svg></span></div><div class="adf-panel-content"><p>warning!</p></div></div><blockquote><p><em>lorem ipsum </em></p><p><em>dolor sit amet</em></p></blockquote><h1>En-tête #1 bis</h1><p><span class="adf-status adf-status-blue">In progress</span> <span class="adf-status adf-status-neutral">TODO</span> <span class="adf-status adf-status-green">Done</span> </p><p><span class="adf-date">2022-06-17</span> </p><p></p><div class="adf-expand"><div class="adf-expand-title">Section masquable</div><div class="adf-expand-body"><p>Texte qui peut se cacher <img class="adf-emoji" loading="lazy" src="https://pf-emoji-service--cdn.us-east-1.prod.public.atl-paas.net/standard/a51a7674-8d5d-4495-a2d2-a67c090f5c3b/64x64/1f642.png" alt=":slight_smile:" width="20" height="20"> </p></div></div></div>
TXT;

        self::assertSame($expected, $exporter->export());
    }
}
