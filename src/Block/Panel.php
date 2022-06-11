<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\ParagraphBuilder;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/panel
 */
class Panel extends BlockNode
{
    use ParagraphBuilder;

    public const INFO = 'info';
    public const NOTE = 'note';
    public const WARNING = 'warning';
    public const SUCCESS = 'success';
    public const ERROR = 'error';

    protected string $type = 'panel';
    protected array $allowedContentTypes = [
        BulletList::class,
        Heading::class,
        OrderedList::class,
        Paragraph::class,
    ];
    private string $panelType;

    public function __construct(string $type = self::INFO, ?BlockNode $parent = null)
    {
        if (!\in_array($type, [
            self::INFO,
            self::NOTE,
            self::WARNING,
            self::SUCCESS,
            self::ERROR,
        ], true)) {
            throw new InvalidArgumentException('Invalid panel type');
        }

        parent::__construct($parent);
        $this->panelType = $type;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['panelType'] = $this->panelType;

        return $attrs;
    }
}
