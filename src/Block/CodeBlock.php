<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\TextBuilder;
use DH\Adf\Inline\Text;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/codeBlock
 */
class CodeBlock extends BlockNode implements JsonSerializable
{
    use TextBuilder;

    protected string $type = 'codeBlock';
    protected array $allowedContentTypes = [
        Text::class,
    ];
    private ?string $language;

    public function __construct(?string $language = null, ?BlockNode $parent = null)
    {
        parent::__construct($parent);
        $this->language = $language;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();

        if (null !== $this->language) {
            $attrs['language'] = $this->language;
        }

        return $attrs;
    }
}
