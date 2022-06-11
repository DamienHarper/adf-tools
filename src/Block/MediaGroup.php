<?php

declare(strict_types=1);

namespace DH\Adf\Block;

use DH\Adf\BlockNode;
use DH\Adf\Builder\MediaBuilder;
use DH\Adf\Child\Media;
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
