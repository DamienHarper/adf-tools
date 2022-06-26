<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\Media;

class MediaExporter extends HtmlExporter
{
    public function __construct(Media $node)
    {
        parent::__construct($node);
        // TODO: finalize HTML construct/support other types of media, only IMG supported as of now
        $this->tags = ['<div class="adf-media"><!--'.$this->node->toJson().'--><p>Atlassian Media API is not publicly available at the moment.</p>', '</div>'];
//        $this->tags = ['<div class="adf-media"><!-- '.$this->node->toJson().' --><img src="blob:https://odandb.atlassian.net/'.$this->node->getId().'">', '</div>'];
    }
}
