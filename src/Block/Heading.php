<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\HeadingBuilder;
use DH\Adf\Builder\TextBuilder;
use DH\Adf\InlineNode;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/heading
 */
class Heading extends BlockNode implements JsonSerializable
{
    use TextBuilder;
    use HeadingBuilder;

    protected string $type = 'heading';
    protected array $allowedContentTypes = [
        InlineNode::class,
    ];
    private int $level;

    public function __construct(int $language, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->level = $language;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['level'] = $this->level;

        return $attrs;
    }
}
