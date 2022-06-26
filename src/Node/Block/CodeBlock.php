<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\TextBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Inline\Text;
use DH\Adf\Node\Node;
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

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data, ['attrs']);

        $node = new self($data['attrs']['language'] ?? null, $parent);

        // set content if defined
        if (\array_key_exists('content', $data)) {
            foreach ($data['content'] as $nodeData) {
                $class = Node::NODE_MAPPING[$nodeData['type']];
                $child = $class::load($nodeData, $node);

                $node->append($child);
            }
        }

        return $node;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
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
