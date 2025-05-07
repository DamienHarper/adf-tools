<?php

declare(strict_types=1);

namespace DH\Adf\Exporter\Html\Child;

use DH\Adf\Exporter\Html\HtmlExporter;
use DH\Adf\Node\Child\TaskItem;

class TaskItemExporter extends HtmlExporter
{
    public function __construct(TaskItem $node)
    {
        $fill = $node->isOpen() ? '' : 'checked';
        parent::__construct($node);
        $this->tags = [
            '<li><label><input class="adf-task-checkbox" type="checkbox" disabled '.$fill.'>',
            '</label></li>'
        ];
    }
}
