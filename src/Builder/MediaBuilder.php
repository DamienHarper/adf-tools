<?php

declare(strict_types=1);

namespace DH\Adf\Builder;

use DH\Adf\Node\Child\Media;

trait MediaBuilder
{
    use BuilderInterface;

    public function media(string $id, string $mediaType, string $collection, ?float $width = null, ?float $height = null, ?string $occurrenceKey = null): Media
    {
        $block = new Media($id, $mediaType, $collection, $width, $height, $occurrenceKey, $this);
        $this->append($block);

        return $block;
    }
}
