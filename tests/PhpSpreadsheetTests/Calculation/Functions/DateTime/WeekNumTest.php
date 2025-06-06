<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\DateTime;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Week;
use PhpOffice\PhpSpreadsheet\Calculation\Exception as CalculationException;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheetTests\Calculation\Functions\FormulaArguments;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WeekNumTest extends TestCase
{
    private int $excelCalendar;

    protected function setUp(): void
    {
        parent::setUp();

        $this->excelCalendar = SharedDate::getExcelCalendar();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        SharedDate::setExcelCalendar($this->excelCalendar);
    }

    #[DataProvider('providerWEEKNUM')]
    public function testDirectCallToWEEKNUM(mixed $expectedResult, mixed ...$args): void
    {
        $result = Week::number(...$args);
        self::assertSame($expectedResult, $result);
    }

    #[DataProvider('providerWEEKNUM')]
    public function testWEEKNUMAsFormula(mixed $expectedResult, mixed ...$args): void
    {
        $arguments = new FormulaArguments(...$args);

        $calculation = Calculation::getInstance();
        $formula = "=WEEKNUM({$arguments})";

        $result = $calculation->_calculateFormulaValue($formula);
        self::assertSame($expectedResult, $result);
    }

    #[DataProvider('providerWEEKNUM')]
    public function testWEEKNUMInWorksheet(mixed $expectedResult, mixed ...$args): void
    {
        $arguments = new FormulaArguments(...$args);

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $argumentCells = $arguments->populateWorksheet($worksheet);
        $formula = "=WEEKNUM({$argumentCells})";

        $result = $worksheet->setCellValue('A1', $formula)
            ->getCell('A1')
            ->getCalculatedValue();
        self::assertSame($expectedResult, $result);

        $spreadsheet->disconnectWorksheets();
    }

    public static function providerWEEKNUM(): array
    {
        return require 'tests/data/Calculation/DateTime/WEEKNUM.php';
    }

    #[DataProvider('providerUnhappyWEEKNUM')]
    public function testWEEKNUMUnhappyPath(string $expectedException, mixed ...$args): void
    {
        $arguments = new FormulaArguments(...$args);

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $argumentCells = $arguments->populateWorksheet($worksheet);
        $formula = "=WEEKNUM({$argumentCells})";

        $this->expectException(CalculationException::class);
        $this->expectExceptionMessage($expectedException);
        $worksheet->setCellValue('A1', $formula)
            ->getCell('A1')
            ->getCalculatedValue();

        $spreadsheet->disconnectWorksheets();
    }

    public static function providerUnhappyWEEKNUM(): array
    {
        return [
            ['Formula Error: Wrong number of arguments for WEEKNUM() function'],
        ];
    }

    #[DataProvider('providerWEEKNUM1904')]
    public function testWEEKNUMWith1904Calendar(mixed $expectedResult, mixed ...$args): void
    {
        SharedDate::setExcelCalendar(SharedDate::CALENDAR_MAC_1904);

        $result = Week::number(...$args);
        self::assertSame($expectedResult, $result);
    }

    public static function providerWEEKNUM1904(): array
    {
        return require 'tests/data/Calculation/DateTime/WEEKNUM1904.php';
    }

    /** @param mixed[] $expectedResult */
    #[DataProvider('providerWeekNumArray')]
    public function testWeekNumArray(array $expectedResult, string $dateValues, string $methods): void
    {
        $calculation = Calculation::getInstance();

        $formula = "=WEEKNUM({$dateValues}, {$methods})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-14);
    }

    public static function providerWeekNumArray(): array
    {
        return [
            'row vector #1' => [[[1, 25, 29]], '{"2022-01-01", "2022-06-12", "2023-07-22"}', '1'],
            'column vector #1' => [[[1], [13], [26]], '{"2023-01-01"; "2023-04-01"; "2023-07-01"}', '1'],
            'matrix #1' => [[[1, 53], [1, 53]], '{"2021-01-01", "2021-12-31"; "2023-01-01", "2023-12-31"}', '1'],
            'row vector #2' => [[[25, 24]], '"2022-06-12"', '{1, 2}'],
            'column vector #2' => [[[13], [14]], '"2023-04-01"', '{1; 2}'],
            'matrix #2' => [[[53, 53], [53, 52]], '"2021-12-31"', '{1, 2; 16, 21}'],
        ];
    }
}
