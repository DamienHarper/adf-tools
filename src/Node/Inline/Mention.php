<?php

declare(strict_types=1);

namespace DH\Adf\Node\Inline;

use DH\Adf\Node\BlockNode;
use DH\Adf\Node\InlineNode;
use InvalidArgumentException;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mention
 */
class Mention extends InlineNode
{
    public const ACCESS_LEVEL_NONE = 'NONE';
    public const ACCESS_LEVEL_SITE = 'SITE';
    public const ACCESS_LEVEL_APPLICATION = 'APPLICATION';
    public const ACCESS_LEVEL_CONTAINER = 'CONTAINER';

    public const USER_TYPE_DEFAULT = 'DEFAULT';
    public const USER_TYPE_SPECIAL = 'SPECIAL';
    public const USER_TYPE_APP = 'APP';

    protected string $type = 'mention';
    private string $id;
    private string $text;
    private ?string $accessLevel;
    private ?string $userType;

    public function __construct(string $id, string $text, ?string $accessLevel = null, ?string $userType = null)
    {
        if (null !== $accessLevel && !\in_array($accessLevel, [
            self::ACCESS_LEVEL_NONE,
            self::ACCESS_LEVEL_SITE,
            self::ACCESS_LEVEL_APPLICATION,
            self::ACCESS_LEVEL_CONTAINER,
            '',
        ], true)) {
            throw new InvalidArgumentException('Invalid access level');
        }

        if (null !== $userType && !\in_array($userType, [
            self::USER_TYPE_DEFAULT,
            self::USER_TYPE_SPECIAL,
            self::USER_TYPE_APP,
            //            '',
        ], true)) {
            throw new InvalidArgumentException('Invalid user type');
        }

        $this->id = $id;
        $this->text = $text;
        $this->accessLevel = $accessLevel;
        $this->userType = $userType;
    }

    public static function load(array $data, ?BlockNode $parent = null): self
    {
        self::checkNodeData(static::class, $data);
        self::checkRequiredKeys(['id', 'text'], $data['attrs']);

        return new self(
            $data['attrs']['id'],
            $data['attrs']['text'],
            $data['attrs']['accessLevel'] ?? null,
            $data['attrs']['userType'] ?? null
        );
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAccessLevel(): ?string
    {
        return $this->accessLevel;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    protected function attrs(): array
    {
        $attrs = parent::attrs();
        $attrs['id'] = $this->id;
        $attrs['text'] = $this->text;

        if (null !== $this->accessLevel) {
            $attrs['accessLevel'] = $this->accessLevel;
        }

        if (null !== $this->userType) {
            $attrs['userType'] = $this->userType;
        }

        return $attrs;
    }
}
