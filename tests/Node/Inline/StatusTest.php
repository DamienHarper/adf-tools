<?php

declare(strict_types=1);

namespace DH\Adf\Tests\Node\Inline;

use DH\Adf\Node\Inline\Status;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class StatusTest extends TestCase
{
    public function testInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);

        $doc = (new Status('text', 'invalid_color'))->toJson();
    }
}
