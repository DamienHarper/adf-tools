<?php

declare(strict_types=1);

namespace DH\Adf\Node\Block;

use DH\Adf\Builder\MediaBuilder;
use DH\Adf\Node\BlockNode;
use DH\Adf\Node\Child\Media;
use JsonSerializable;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/nodes/mediaGroup
 */
class MediaGroup extends BlockNode implements JsonSerializable
{
    use MediaBuilder;

    protected string $type = 'mediaGroup';
    protected array $allowedContentTypes = [
        Media::class,
    ];
}
