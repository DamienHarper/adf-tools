<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Block;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Block\TaskList;

class TaskListExporter extends HtmlExporter
{
    public function __construct(TaskList $node)
    {
        parent::__construct($node);
        $this->tags = ['<ul class="adf-task-list" style="list-style-type: none">', '</ul>'];
    }
}
