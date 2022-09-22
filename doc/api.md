# API

## `DH\Adf\Node\Block\Document` class materializes the [root](https://developer.atlassian.com/cloud/jira/platform/apis/document/structure/) block node
Methods:
- `Document::blockquote()` appends a [blockquote](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote/) block node
- `Document::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `Document::codeblock()` appends a [codeBlock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
- `Document::expand()` appends a [expand]() node
- `Document::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `Document::mediaGroup()` appends a [mediaGroup](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup/) block node
- `Document::mediaSingle()` appends a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
- `Document::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `Document::panel()` appends a [panel](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel/) block node
- `Document::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `Document::rule()` appends a [rule](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule/) block node
- `Document::table()` appends a [table](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table/) block node
- `Document::load()` loads and parses an ADF JSON document
- `Document::end()` closes the current block and returns the parent element
- `Document::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\Blockquote` class materializes a [blockquote](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote/) block node
Methods:
- `Blockquote::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `Blockquote::load()` loads and parses an ADF JSON document
- `Blockquote::end()` closes the current block and returns the parent element
- `Blockquote::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\BulletList` class materializes a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
Methods:
- `BulletList::item()` appends a [listItem](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem/) child node
- `BulletList::load()` loads and parses an ADF JSON document
- `BulletList::end()` closes the current block and returns the parent element
- `BulletList::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\OrderedList` class materializes a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
Methods:
- `OrderedList::item()` appends a [listItem](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem/) child node
- `OrderedList::load()` loads and parses an ADF JSON document
- `OrderedList::end()` closes the current block and returns the parent element
- `OrderedList::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\CodeBlock` class materializes a [codeblock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
Methods:
- `CodeBlock::text()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) inline node
- `CodeBlock::color()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [color](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/color/) mark node
- `CodeBlock::em()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [em](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/em/) mark node
- `CodeBlock::link()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [link](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/link/) mark node
- `CodeBlock::strike()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [strike](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/strike/) mark node
- `CodeBlock::strong()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [strong](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/strong/) mark node
- `CodeBlock::sub()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [sub](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/sub/) mark node
- `CodeBlock::sup()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [sup](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/sup/) mark node
- `CodeBlock::underline()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [underline](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/underline/) mark node
- `CodeBlock::load()` loads and parses an ADF JSON document
- `CodeBlock::end()` closes the current block and returns the parent element
- `CodeBlock::toJson()` serializes the node as a JSON document
- `CodeBlock::getLanguage()` returns the codeblock's content language

## `DH\Adf\Node\Block\Expand` class materializes an expand node
Methods:
- `Expand::blockquote()` appends a [blockquote](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote/) block node
- `Expand::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `Expand::codeblock()` appends a [codeBlock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
- `Expand::expand()` appends a [expand]() block node
- `Expand::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `Expand::mediaGroup()` appends a [mediaGroup](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup/) block node
- `Expand::mediaSingle()` appends a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
- `Expand::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `Expand::panel()` appends a [panel](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel/) block node
- `Expand::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `Expand::rule()` appends a [rule](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule/) block node
- `Expand::table()` appends a [table](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table/) block node
- `Expand::load()` loads and parses an ADF JSON document
- `Expand::end()` closes the current block and returns the parent element
- `Expand::toJson()` serializes the node as a JSON document
- `Expand::getTitle()` returns the title of the expand node

## `DH\Adf\Node\Block\Heading` class materializes a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) node
Methods:
- `Heading::text()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) inline node
- `Heading::color()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [color](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/color/) mark node
- `Heading::em()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [em](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/em/) mark node
- `Heading::link()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [link](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/link/) mark node
- `Heading::strike()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [strike](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/strike/) mark node
- `Heading::strong()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [strong](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/strong/) mark node
- `Heading::sub()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [sub](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/sub/) mark node
- `Heading::sup()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [sup](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/sup/) mark node
- `Heading::underline()` appends a [text](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/text/) node with a [underline](https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/underline/) mark node
- `Heading::load()` loads and parses an ADF JSON document
- `Heading::end()` closes the current block and returns the parent element
- `Heading::toJson()` serializes the node as a JSON document
- `Heading::getLevel()` returns the heading's level

## `DH\Adf\Node\Block\MediaGroup` class materializes a [mediaGroup](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup/) block node
Methods:
- `MediaGroup::media()` appends a [media](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/media/) node
- `MediaGroup::load()` loads and parses an ADF JSON document
- `MediaGroup::end()` closes the current block and returns the parent element
- `MediaGroup::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\MediaSingle` class materializes a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
Methods:
- `MediaSingle::media()` appends a [media](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/media/) child node
- `MediaSingle::load()` loads and parses an ADF JSON document
- `MediaSingle::end()` closes the current block and returns the parent element
- `MediaSingle::toJson()` serializes the node as a JSON document
- `MediaSingle::getLayout()` returns the layout of the mediaSingle node
- `MediaSingle::getWidth()` returns the width of the mediaSingle node

## `DH\Adf\Node\Block\Panel` class materializes a [panel](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel/) block node
Methods:
- `Panel::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `Panel::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `Panel::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `Panel::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `Panel::load()` loads and parses an ADF JSON document
- `Panel::end()` closes the current block and returns the parent element
- `Panel::toJson()` serializes the node as a JSON document
- `Panel::getPanelType()` returns the type of the panel node

## `DH\Adf\Node\Block\Paragraph` class materializes a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
Methods:
- `Paragraph::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `Paragraph::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `Paragraph::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `Paragraph::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `Paragraph::load()` loads and parses an ADF JSON document
- `Paragraph::end()` closes the current block and returns the parent element
- `Paragraph::toJson()` serializes the node as a JSON document
- `Paragraph::getPanelType()` returns the type of the panel node

## `DH\Adf\Node\Block\Rule` class materializes a [rule](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule/) block node
Methods:
- `Rule::load()` loads and parses an ADF JSON document
- `Rule::end()` closes the current block and returns the parent element
- `Rule::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Block\Table` class materializes a [table](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table/) block node
Methods:
- `Table::row()` appends a [tableRow](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_row/) child node
- `Table::load()` loads and parses an ADF JSON document
- `Table::end()` closes the current block and returns the parent element
- `Table::toJson()` serializes the node as a JSON document
- `Table::getLayout()` returns the layout of the table node
- `Table::isNumberColumnEnabled()`

## `DH\Adf\Node\Child\TableRow` class materializes a [tableRow](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_row/) child node
Methods:
- `TableRow::cell()` appends a [tableCell](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_cell/) child node
- `TableRow::header()` appends a [tableHeader](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_header/) child node
- `TableRow::load()` loads and parses an ADF JSON document
- `TableRow::end()` closes the current block and returns the parent element
- `TableRow::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Child\TableHeader` class materializes a [tableHeader](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_header/) child node
Methods:
- `TableHeader::blockquote()` appends a [blockquote](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote/) block node
- `TableHeader::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `TableHeader::codeblock()` appends a [codeBlock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
- `TableHeader::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `TableHeader::mediaGroup()` appends a [mediaGroup](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup/) block node
- `TableHeader::mediaSingle()` appends a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
- `TableHeader::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `TableHeader::panel()` appends a [panel](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel/) block node
- `TableHeader::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `TableHeader::rule()` appends a [rule](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule/) block node
- `TableHeader::load()` loads and parses an ADF JSON document
- `TableHeader::end()` closes the current block and returns the parent element
- `TableHeader::toJson()` serializes the node as a JSON document
- `TableHeader::getBackground()` returns the background
- `TableHeader::getColwidth()` returns the column width
- `TableHeader::getColspan()` returns the colspan layout
- `TableHeader::getRowspan()` returns the rowspan layout

## `DH\Adf\Node\Child\TableCell` class materializes a [tableCell](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/table_cell/) child node
Methods:
- `TableCell::blockquote()` appends a [blockquote](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/blockquote/) block node
- `TableCell::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `TableCell::codeblock()` appends a [codeBlock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
- `TableCell::heading()` appends a [heading](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading/) block node
- `TableCell::mediaGroup()` appends a [mediaGroup](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup/) block node
- `TableCell::mediaSingle()` appends a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
- `TableCell::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `TableCell::panel()` appends a [panel](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel/) block node
- `TableCell::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `TableCell::rule()` appends a [rule](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/rule/) block node
- `TableCell::load()` loads and parses an ADF JSON document
- `TableCell::end()` closes the current block and returns the parent element
- `TableCell::toJson()` serializes the node as a JSON document
- `TableCell::getBackground()` returns the background
- `TableCell::getColwidth()` returns the column width
- `TableCell::getColspan()` returns the colspan layout
- `TableCell::getRowspan()` returns the rowspan layout

## `DH\Adf\Node\Child\ListItem` class materializes a [listItem](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/listItem/) child node
Methods:
- `ListItem::bulletlist()` appends a [bulletList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/bulletList/) block node
- `ListItem::orderedlist()` appends a [orderedList](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/orderedList/) block node
- `ListItem::paragraph()` appends a [paragraph](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/paragraph/) block node
- `ListItem::codeblock()` appends a [codeBlock](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock/) block node
- `ListItem::mediaSingle()` appends a [mediaSingle](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaSingle/) block node
- `ListItem::load()` loads and parses an ADF JSON document
- `ListItem::end()` closes the current block and returns the parent element
- `ListItem::toJson()` serializes the node as a JSON document

## `DH\Adf\Node\Child\Media` class materializes a [media](https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/media/) child node
Methods:
- `Media::load()` loads and parses an ADF JSON document
- `Media::end()` closes the current block and returns the parent element
- `Media::toJson()` serializes the node as a JSON document
- `Media::getCollection()` returns the collection of the media node
- `Media::getHeight()` returns the height of the media node
- `Media::getWidth()` returns the width of the media node
- `Media::getId()` returns the ID of the media node
- `Media::getMediaType()` returns the media type of the media node
- `Media::getOccurrenceKey()` 
