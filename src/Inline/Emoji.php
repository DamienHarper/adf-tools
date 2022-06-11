<?php

declare(strict_types=1);

namespace DH\Adf\Inline;

use DH\Adf\InlineNode;

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

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['shortName'] = sprintf(':%s:', $this->shortName);

        if (null !== $this->id) {
            $attrs['id'] = $this->id;
        }
        if (null !== $this->text) {
            $attrs['fallback'] = $this->text;
        }

        return $attrs;
    }
}
