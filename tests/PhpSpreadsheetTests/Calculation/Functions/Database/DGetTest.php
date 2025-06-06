<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Database;

use PhpOffice\PhpSpreadsheet\Calculation\Database\DGet;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ExcelError;
use PHPUnit\Framework\Attributes\DataProvider;

class DGetTest extends SetupTeardownDatabases
{
    /**
     * @param mixed[] $database
     * @param mixed[][] $criteria
     */
    #[DataProvider('providerDGet')]
    public function testDirectCallToDGet(string|int $expectedResult, array $database, ?string $field, array $criteria): void
    {
        $result = DGet::evaluate($database, $field, $criteria);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-12);
    }

    /**
     * @param mixed[] $database
     * @param mixed[][] $criteria
     */
    #[DataProvider('providerDGet')]
    public function testDGetAsWorksheetFormula(string|int $expectedResult, array $database, ?string $field, array $criteria): void
    {
        $this->prepareWorksheetWithFormula('DGET', $database, $field, $criteria);

        $result = $this->getSheet()->getCell(self::RESULT_CELL)->getCalculatedValue();
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-12);
    }

    public static function providerDGet(): array
    {
        return [
            [
                ExcelError::NAN(),
                self::database1(),
                'Yield',
                [
                    ['Tree'],
                    ['=Apple'],
                    ['=Pear'],
                ],
            ],
            [
                10,
                self::database1(),
                'Yield',
                [
                    ['Tree', 'Height', 'Height'],
                    ['=Apple', '>10', '<16'],
                    ['=Pear', '>12', null],
                ],
            ],
            [
                188000,
                self::database2(),
                'Sales',
                [
                    ['Sales Rep.', 'Quarter'],
                    ['Tina', 4],
                ],
            ],
            [
                ExcelError::NAN(),
                self::database2(),
                'Sales',
                [
                    ['Area', 'Quarter'],
                    ['South', 4],
                ],
            ],
            'omitted field name' => [
                ExcelError::VALUE(),
                self::database1(),
                null,
                self::database1(),
            ],
        ];
    }
}
