<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\InlineNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/emoji
 */
class Emoji extends InlineNode
{
    protected string $type = 'emoji';
    private string $shortName;
    private ?string $id;
    private ?string $text;

    public function __construct(string $shortName, ?string $id = null, ?string $text = null)
    {
        $this->shortName = $shortName;
        $this->id = $id;
        $this->text = $text;
    }

    public static function load(array $data): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);
        self::checkRequiredKeys(['shortName'], $data['attrs']);

        return new self(trim($data['attrs']['shortName'], ' \t\n\r\0\x0B:'), $data['attrs']['id'] ?? null, $data['attrs']['text'] ?? null);
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['shortName'] = sprintf(':%s:', $this->shortName);

        if (null !== $this->id) {
            $attrs['id'] = $this->id;
        }
        if (null !== $this->text) {
            $attrs['text'] = $this->text;
        }

        return $attrs;
    }
}
