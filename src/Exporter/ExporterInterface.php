<?php

declare(strict_types=1);

namespace DH\Adf\Exporter;

interface ExporterInterface
{
    public function export(): string;
}
