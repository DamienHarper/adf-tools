# Documentation

## Installation
Open a command console, enter your project directory and execute:

```bash
composer require damienharper/adf-tools
```

## Usage
An ADF document is a collection (tree structure) of nodes which can be of several types:
- Block nodes: containers of other nodes
- Child nodes: have to be assigned a block node as a parent
- Inline nodes: embedded into other nodes
- Mark nodes: always paired to text nodes to bring format/style

More details in [Official Atlassian Document Format](https://developer.atlassian.com/cloud/jira/platform/apis/document/structure/)


### Building an ADF document
Building an ADF document from PHP is done by instantiating and manipulating nodes.

Creating and manipulating nodes is made easy thanks to a fluent interface (see [API summary](api.md))

An ADF document has to have a root node at the top of the tree. 
This root node is materialized as an instance of `DH\Adf\Node\Block\Document`.

#### Examples

##### Creating a root node

```php
use DH\Adf\Node\Block\Document;

$document = new Document();
```


##### Simple paragraph

> <p>Hello world!</p>

```php
use DH\Adf\Node\Block\Document;

$document = (new Document())
    ->paragraph()               // adds a paragraph node (block node) / starts a paragraph branch
        ->text('Hello world!')  // adds a text node
    ->end()                     // closes the paragraph branch
;
```

##### Paragraph with formatted content

> <p><span style="color: red">Luke, </span>may <em>the </em><strong>force </strong>be <span style="text-decoration: underline">with</span><span style="text-decoration: line-through;"> you! </span><sub>Obi-Wan</sub><sup>Kenobi</sup> <a href="https://wikipedia.org/wiki/Star_Wars">Star Wars @ Wikipedia</a></p>

```php
use DH\Adf\Node\Block\Document;

$document = (new Document())
    ->paragraph()                   // adds a paragraph node (block node) / starts a paragraph branch
        ->color('Luke, ', 'red')    // adds a text node with a textColor mark node
        ->text('may ')              // adds a text node
        ->em('the ')                // adds a text node with an em (italic) mark node
        ->strong('force ')          // adds a text node with a strong (bold) mark node
        ->text('be ')               // adds a text node
        ->underline('with')         // adds a text node with an underline mark node
        ->strike(' you! ')          // adds a text node with a strike mark node
        ->sub('Obi-Wan')            // adds a text node with a sub mark node
        ->sup('Kenobi')             // adds a text node with a sup mark node
        ->Link('Star Wars @ Wikipedia', 'https://wikipedia.org/wiki/Star_Wars') // adds a link node
    ->end()                         // closes the paragraph branch
;
```

##### Simple list

> <ul><li><p>item 1</p></li><li><p>item 2</p></li></ul>

```php
use DH\Adf\Node\Block\Document;

$document = (new Document())
    ->bulletlist()                  // adds a bulletList node / starts a bulletList branch
        ->item()                    // adds an itemList node / starts an itemList
            ->paragraph()           // adds a paragraph node (block node) / starts a paragraph branch
                ->text('item 1')    // adds a text node
            ->end()                 // closes the paragraph branch
        ->end()                     // closes the itemList branch
        ->item()                    // adds an itemList node / starts an itemList
            ->paragraph()           // adds a paragraph node (block node) / starts a paragraph branch
                ->text('item 2')    // adds a text node
            ->end()                 // closes the paragraph branch
        ->end()                     // closes the itemList branch
    ->end()                         // closes the bulletList branch
;
```


### Loading an ADF JSON document

```php
use DH\Adf\Node\Block\Document;

$json = [
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
];

$document = Document::load($json);
```

The above sample is equivalent to:
```php
use DH\Adf\Node\Block\Document;

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
```


### JSON export
Every node provide a `toJson` method to serialize itself as a JSON document. 

```php
use DH\Adf\Node\Block\Document;

$json = (new Document())
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
    ->toJson()  // returns a JSON representation of the tree
;
```


### HTML export
ADF nodes are mapped to classes and those classes are mapped to exporter classes.

So for example:
- a root node is mapped to `DH\Adf\Node\Block\Document` class and its exporter class is `DH\Adf\Exporter\Html\Block\DocumentExporter`
- a paragraph node (block) is mapped to `DH\Adf\Node\Block\Paragraph` class and its exporter class is `DH\Adf\Exporter\Html\Block\ParagraphExporter`
- a text node (inline)  is mapped to `DH\Adf\Node\Inline\Text` class and its exporter class is `DH\Adf\Exporter\Html\Inline\TextExporter`
- etc.

Each node has a default HTML representation with CSS class to help further styling.

| Node type | Node class                      | Node exporter class                              | HTML opening tag                                                                                                                                                                      | HTML closing tag      | Comment                 |
|:----------|:--------------------------------|:-------------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|:----------------------|:------------------------|
| block     | `DH\Adf\Node\Block\Document`    | `DH\Adf\Exporter\Html\Block\DocumentExporter`    | `<div class="adf-container">`                                                                                                                                                         | `</div>`              |                         |
| block     | `DH\Adf\Node\Block\Blockquote`  | `DH\Adf\Exporter\Html\Block\BlockquoteExporter`  | `<blockquote>`                                                                                                                                                                        | `</blockquote>`       |                         |
| block     | `DH\Adf\Node\Block\BulletList`  | `DH\Adf\Exporter\Html\Block\BulletListExporter`  | `<ul>`                                                                                                                                                                                | `</ul>`               |                         |
| block     | `DH\Adf\Node\Block\TaskList`    | `DH\Adf\Exporter\Html\Block\TaskListExporter`    | `<ul class="adf-task-list" style="list-style-type: none">`                                                                                                                            | `</ul>`               |                         |
| block     | `DH\Adf\Node\Block\CodeBlock`   | `DH\Adf\Exporter\Html\Block\CodeBlockExporter`   | `<pre class="[LANGUAGE_NAME]">`                                                                                                                                                       | `</pre>`              |                         |
| block     | `DH\Adf\Node\Block\Heading`     | `DH\Adf\Exporter\Html\Block\HeadingExporter`     | `<h[HEADING_LEVEL]>`                                                                                                                                                                  | `</h[HEADING_LEVEL]>` |                         |
| block     | `DH\Adf\Node\Block\MediaGroup`  | `DH\Adf\Exporter\Html\Block\MediaGroupExporter`  | `<div class="adf-mediagroup">`                                                                                                                                                        | `</div>`              |                         |
| block     | `DH\Adf\Node\Block\MediaSingle` | `DH\Adf\Exporter\Html\Block\MediaSingleExporter` | `<div class="adf-mediasingle">`                                                                                                                                                       | `</div>`              |                         |
| block     | `DH\Adf\Node\Block\OrderedList` | `DH\Adf\Exporter\Html\Block\OrderedListExporter` | `<ol>`                                                                                                                                                                                | `</ol>`               |                         |
| block     | `DH\Adf\Node\Block\Panel`       | `DH\Adf\Exporter\Html\Block\PanelExporter`       | `<div class="adf-panel adf-panel-[PANEL_TYPE]"><div class="adf-panel-icon"><span role="img" aria-label="Panel [PANEL_TYPE]">[PANEL_ICON]</span></div><div class="adf-panel-content">` | `</div></div>`        |                         |
| block     | `DH\Adf\Node\Block\Paragraph`   | `DH\Adf\Exporter\Html\Block\ParagraphExporter`   | `<p>`                                                                                                                                                                                 | `</p>`                |                         |
| block     | `DH\Adf\Node\Block\Rule`        | `DH\Adf\Exporter\Html\Block\RuleExporter`        | `<hr/>`                                                                                                                                                                               |                       |                         |
| block     | `DH\Adf\Node\Block\Table`       | `DH\Adf\Exporter\Html\Block\TableExporter`       | `<table class="adf-table-[TABLE_LAYOUT]"><tbody>`                                                                                                                                     | `</tbody></table>`    |                         |
| block     | `DH\Adf\Node\Block\Expand`      | `DH\Adf\Exporter\Html\Block\ExpandExporter`      | `<details class="adf-expand"><summary class="adf-expand-title">[EXPAND_TITLE]</summary><div class="adf-expand-body">`                                                                 | `</div></details>`    |                         |
| child     | `DH\Adf\Node\Child\ListItem`    | `DH\Adf\Exporter\Html\Child\ListItemExporter`    | `<li>`                                                                                                                                                                                | `</li>`               |                         |
| child     | `DH\Adf\Node\Child\TaskItem`    | `DH\Adf\Exporter\Html\Child\TaskItemExporter`    | `<li><label><input class="adf-task-checkbox" type="checkbox" disabled [CHECKED]>`                                                                                                     | `</label></li>`       |                         |
| child     | `DH\Adf\Node\Child\TableCell`   | `DH\Adf\Exporter\Html\Child\TableCellExporter`   | `<td[style="background-color: CELL_BACKGROUND"][colspan="[CELL_COLSPAN]"][rowspan="[CELL_ROWSPAN]"]>`                                                                                 | `</td>`               |                         |
| child     | `DH\Adf\Node\Child\TableHeader` | `DH\Adf\Exporter\Html\Child\TableHeaderExporter` | `<th>`                                                                                                                                                                                | `</th>`               |                         |
| child     | `DH\Adf\Node\Child\TableRow`    | `DH\Adf\Exporter\Html\Child\TableRowExporter`    | `<tr>`                                                                                                                                                                                | `</tr>`               |                         |
| child     | `DH\Adf\Node\Child\Media`       | `DH\Adf\Exporter\Html\Child\MediaExporter`       | `<div class="adf-media">`                                                                                                                                                             | `</div>`              | Not yet fully supported |
| child     | `DH\Adf\Node\Child\InlineCard`  | `DH\Adf\Exporter\Html\Child\InlineCardExporter`  | `<div class="adf-inline-card">`                                                                                                                                                       | `</div>`              |                         |
| inline    | `DH\Adf\Node\Inline\Emoji`      | `DH\Adf\Exporter\Html\Inline\EmojiExporter`      | `<img class="adf-emoji" src="...">`                                                                                                                                                   |                       |                         |
| inline    | `DH\Adf\Node\Inline\Hardbreak`  | `DH\Adf\Exporter\Html\Inline\HardbreakExporter`  | `<br/>`                                                                                                                                                                               |                       |                         |
| inline    | `DH\Adf\Node\Inline\Mention`    | `DH\Adf\Exporter\Html\Inline\MentionExporter`    | `<span class="adf-mention">`                                                                                                                                                          | `</span>`             |                         |
| inline    | `DH\Adf\Node\Inline\Text`       | `DH\Adf\Exporter\Html\Inline\TextExporter`       |                                                                                                                                                                                       |                       |                         |
| inline    | `DH\Adf\Node\Inline\Status`     | `DH\Adf\Exporter\Html\Inline\StatusExporter`     | `<span class="adf-status adf-status-[STATUS_COLOR]">`                                                                                                                                 | `</span>`             |                         |
| inline    | `DH\Adf\Node\Inline\Date`       | `DH\Adf\Exporter\Html\Inline\DateExporter`       | `<span class="adf-date">`                                                                                                                                                             | `</span>`             |                         |
| mark      | `DH\Adf\Node\Mark\Em`           | `DH\Adf\Exporter\Html\Mark\EmExporter`           | `<em>`                                                                                                                                                                                | `</em>`               |                         |
| mark      | `DH\Adf\Node\Mark\Strong`       | `DH\Adf\Exporter\Html\Mark\StrongExporter`       | `<strong>`                                                                                                                                                                            | `</strong>`           |                         |
| mark      | `DH\Adf\Node\Mark\Code`         | `DH\Adf\Exporter\Html\Mark\CodeExporter`         | `<pre>`                                                                                                                                                                               | `</pre>`              |                         |
| mark      | `DH\Adf\Node\Mark\Strike`       | `DH\Adf\Exporter\Html\Mark\StrikeExporter`       | `<s>`                                                                                                                                                                                 | `</s>`                |                         |
| mark      | `DH\Adf\Node\Mark\Subsup`       | `DH\Adf\Exporter\Html\Mark\SubsupExporter`       | `<sub>` or `<sup>`                                                                                                                                                                    | `</sub>` or `</sup>`  |                         |
| mark      | `DH\Adf\Node\Mark\Underline`    | `DH\Adf\Exporter\Html\Mark\UnderlineExporter`    | `<u>`                                                                                                                                                                                 | `</u>`                |                         |
| mark      | `DH\Adf\Node\Mark\Link`         | `DH\Adf\Exporter\Html\Mark\LinkExporter`         | `<a href="[LINK_HREF]" title="[LINK_TITLE]">`                                                                                                                                         | `</a>`                |                         |
| mark      | `DH\Adf\Node\Mark\TextColor`    | `DH\Adf\Exporter\Html\Mark\TextColorExporter`    | `<span style="color: [TEXT_COLOR]">`                                                                                                                                                  | `</span>`             |                         |

#### Export example

```php
use DH\Adf\Exporter\Html\Block;
use DH\Adf\Node\Block\Document;

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
$html = $exporter->export();
```

#### Media Export

- converting media (attachments) to HTML is currently not supported
  - (will display as `Atlassian Media API is not publicly available at the moment.`)
  - you can fetch attachments via the Rest API separately ([GET Attachment](https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-attachments/#api-rest-api-3-attachment-content-id-get) or with the `attachment` key when [getting](https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issues/#api-rest-api-3-issue-issueidorkey-get) or [searching](https://developer.atlassian.com/cloud/jira/platform/rest/v3/api-group-issue-search/#api-rest-api-3-search-jql-get) issues)
- exporting media nodes is disabled by default
  - you can enable it by calling `includeMedia()` of the exporter:

    ```php
    $exporter = new DocumentExporter($document);
    $html = $exporter->includeMedia()->export();
    
    // or
    
    $exporter = new DocumentExporter($document);
    $exporter->includeMedia();
    $html = $exporter->export();
    ```

## Contributing

`adf-tools` is an open source project. Contributions made by the community are welcome.
Send us your ideas, code reviews, pull requests and feature requests to help us improve this project.

Do not forget to provide unit tests when contributing to this project.
To do so, follow instructions in this dedicated [README](contributing.md)
