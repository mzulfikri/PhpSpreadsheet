<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Financial;

use PHPUnit\Framework\Attributes\DataProvider;

class RriTest extends AllSetupTeardown
{
    /** @param mixed[] $args */
    #[DataProvider('providerRRI')]
    public function testRRI(mixed $expectedResult, array $args): void
    {
        $this->runTestCase('RRI', $expectedResult, $args);
    }

    public static function providerRRI(): array
    {
        return require 'tests/data/Calculation/Financial/RRI.php';
    }
}
