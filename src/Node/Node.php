<?php

declare(strict_types=1);

namespace DH\Adf\Node;

use DH\Adf\Node\Block\Blockquote;
use DH\Adf\Node\Block\BulletList;
use DH\Adf\Node\Block\CodeBlock;
use DH\Adf\Node\Block\Document;
use DH\Adf\Node\Block\Expand;
use DH\Adf\Node\Block\Heading;
use DH\Adf\Node\Block\MediaGroup;
use DH\Adf\Node\Block\MediaSingle;
use DH\Adf\Node\Block\OrderedList;
use DH\Adf\Node\Block\Panel;
use DH\Adf\Node\Block\Paragraph;
use DH\Adf\Node\Block\Rule;
use DH\Adf\Node\Block\Table;
use DH\Adf\Node\Block\TaskList;
use DH\Adf\Node\Child\ListItem;
use DH\Adf\Node\Child\Media;
use DH\Adf\Node\Child\TableCell;
use DH\Adf\Node\Child\TableHeader;
use DH\Adf\Node\Child\TableRow;
use DH\Adf\Node\Child\TaskItem;
use DH\Adf\Node\Inline\Date;
use DH\Adf\Node\Inline\Emoji;
use DH\Adf\Node\Inline\Hardbreak;
use DH\Adf\Node\Inline\InlineCard;
use DH\Adf\Node\Inline\Mention;
use DH\Adf\Node\Inline\Status;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Mark\Code;
use DH\Adf\Node\Mark\Em;
use DH\Adf\Node\Mark\Link;
use DH\Adf\Node\Mark\Strike;
use DH\Adf\Node\Mark\Strong;
use DH\Adf\Node\Mark\Subsup;
use DH\Adf\Node\Mark\TextColor;
use DH\Adf\Node\Mark\Underline;
use InvalidArgumentException;
use JsonSerializable;

/**
 * @see https://unpkg.com/@atlaskit/adf-schema@23.1.0/dist/json-schema/v1/full.json
 */
abstract class Node implements JsonSerializable
{
    public const NODE_MAPPING = [
        // block nodes
        'doc' => Document::class,
        'blockquote' => Blockquote::class,
        'bulletList' => BulletList::class,
        'taskList' => TaskList::class,
        'codeBlock' => CodeBlock::class,
        'heading' => Heading::class,
        'mediaGroup' => MediaGroup::class,
        'mediaSingle' => MediaSingle::class,
        'orderedList' => OrderedList::class,
        'panel' => Panel::class,
        'paragraph' => Paragraph::class,
        'rule' => Rule::class,
        'table' => Table::class,
        'expand' => Expand::class,

        // child nodes
        'listItem' => ListItem::class,
        'taskItem' => TaskItem::class,
        'tableCell' => TableCell::class,
        'tableHeader' => TableHeader::class,
        'tableRow' => TableRow::class,
        'media' => Media::class,
        'inlineCard' => InlineCard::class,

        // inline nodes
        'emoji' => Emoji::class,
        'hardBreak' => Hardbreak::class,
        'mention' => Mention::class,
        'text' => Text::class,
        'status' => Status::class,
        'date' => Date::class,

        // mark nodes
        'em' => Em::class,
        'strong' => Strong::class,
        'code' => Code::class,
        'strike' => Strike::class,
        'subsup' => Subsup::class,
        'underline' => Underline::class,
        'link' => Link::class,
        'textColor' => TextColor::class,
    ];

    protected string $type;
    protected ?Node $parent;

    public function __construct(?self $parent = null)
    {
        $this->parent = $parent;
    }

    public function end(): ?self
    {
        return $this->parent;
    }

    public function toJson(): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR);
    }

    public function jsonSerialize(): array
    {
        $result = [
            'type' => $this->type,
        ];

        $attrs = $this->attrs();
        if (\count($attrs) > 0) {
            $result['attrs'] = $attrs;
        }

        return $result;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data);

        if (static::class !== self::NODE_MAPPING[$data['type']]) {
            throw new InvalidArgumentException(sprintf('Invalid data for "%s" node type', $data['type']));
        }

        $class = self::NODE_MAPPING[$data['type']];
        $node = new $class();

        // set attributes if defined
        if (\array_key_exists('attrs', $data)) {
            foreach ($data['attrs'] as $key => $value) {
                $node->{$key} = $value;
            }
        }

        return $node;
    }

    protected function attrs(): array
    {
        return [];
    }

    protected static function checkRequiredKeys(array $keys, array $data): void
    {
        foreach ($keys as $key) {
            if (!\array_key_exists($key, $data)) {
                throw new InvalidArgumentException(sprintf('Missing "%s" key in node data.', $key));
            }
        }
    }

    protected static function checkNodeData(string $class, array $data, array $keys = []): void
    {
        self::checkRequiredKeys(array_merge(['type'], $keys), $data);

        if (static::class !== self::NODE_MAPPING[$data['type']]) {
            throw new InvalidArgumentException(sprintf('Invalid data for "%s" node type', $data['type']));
        }
    }
}
