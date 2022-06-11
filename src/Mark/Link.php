<?php

declare(strict_types=1);

namespace DH\Adf\Mark;

use DH\Adf\MarkNode;

/**
 * @see https://developer.atlassian.com/cloud/jira/platform/apis/document/marks/link
 */
class Link extends MarkNode
{
    protected string $type = 'link';
    private string $href;
    private ?string $title;
    private ?string $id;
    private ?string $collection;
    private ?string $occurrenceKey;

    public function __construct(string $href, ?string $title = null, ?string $id = null, ?string $collection = null, ?string $occurrenceKey = null)
    {
        $this->href = $href;
        $this->title = $title;
        $this->id = $id;
        $this->collection = $collection;
        $this->occurrenceKey = $occurrenceKey;
    }

    protected function attrs(): array
    {
        $attrs = [
            'href' => $this->href,
        ];

        if (null !== $this->title) {
            $attrs['title'] = $this->title;
        }

        if (null !== $this->id) {
            $attrs['id'] = $this->id;
        }

        if (null !== $this->collection) {
            $attrs['collection'] = $this->collection;
        }

        if (null !== $this->occurrenceKey) {
            $attrs['occurrenceKey'] = $this->occurrenceKey;
        }

        return $attrs;
    }
}
