<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Reader\Xml;

use PhpOffice\PhpSpreadsheet\Reader\Xml;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PHPUnit\Framework\TestCase;

class XmlStyleCoverageTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerBorderStyle')]
    public function testBorderStyle(string $style, string $expectedResult): void
    {
        $styles = Xml::XmlMappings();
        /** @var string[] */
        $borders = $styles['borderStyle'];
        self::assertEquals($expectedResult, $borders[$style]);
    }

    public function testBorderStyleCoverage(): void
    {
        $styles = Xml::XmlMappings();
        /** @var mixed[] */
        $expected = $styles['borderStyle'];
        $covered = [];
        foreach ($expected as $key => $val) {
            $covered[$key] = 0;
        }
        $tests = $this->providerBorderStyle();
        foreach ($tests as $test) {
            /** @var string[] $test */
            $covered[$test[0]] = 1;
        }
        foreach ($covered as $key => $val) {
            self::assertEquals(1, $val, "Borderstyle $key not tested");
        }
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerfillType')]
    public function testFillType(string $style, string $expectedResult): void
    {
        $styles = Xml::xmlMappings();
        /** @var string[] */
        $borders = $styles['fillType'];
        self::assertEquals($expectedResult, $borders[$style]);
    }

    public function testFillTypeCoverage(): void
    {
        $styles = Xml::XmlMappings();
        /** @var string[] */
        $expected = $styles['fillType'];
        $covered = [];
        foreach ($expected as $key => $val) {
            $covered[$key] = 0;
        }
        $tests = $this->providerfillType();
        foreach ($tests as $test) {
            /** @var string[] $test */
            $covered[$test[0]] = 1;
        }
        foreach ($covered as $key => $val) {
            self::assertEquals(1, $val, "fillType $key not tested");
        }
    }

    public static function providerBorderStyle(): array
    {
        return [
            ['continuous', Border::BORDER_HAIR],
            ['dash', Border::BORDER_DASHED],
            ['dashdot', Border::BORDER_DASHDOT],
            ['dashdotdot', Border::BORDER_DASHDOTDOT],
            ['dot', Border::BORDER_DOTTED],
            ['double', Border::BORDER_DOUBLE],
            ['0continuous', Border::BORDER_HAIR],
            ['0dash', Border::BORDER_DASHED],
            ['0dashdot', Border::BORDER_DASHDOT],
            ['0dashdotdot', Border::BORDER_DASHDOTDOT],
            ['0dot', Border::BORDER_DOTTED],
            ['0double', Border::BORDER_DOUBLE],
            ['1continuous', Border::BORDER_THIN],
            ['1dash', Border::BORDER_DASHED],
            ['1dashdot', Border::BORDER_DASHDOT],
            ['1dashdotdot', Border::BORDER_DASHDOTDOT],
            ['1dot', Border::BORDER_DOTTED],
            ['1double', Border::BORDER_DOUBLE],
            ['2continuous', Border::BORDER_MEDIUM],
            ['2dash', Border::BORDER_MEDIUMDASHED],
            ['2dashdot', Border::BORDER_MEDIUMDASHDOT],
            ['2dashdotdot', Border::BORDER_MEDIUMDASHDOTDOT],
            ['2dot', Border::BORDER_DOTTED],
            ['2double', Border::BORDER_DOUBLE],
            ['3continuous', Border::BORDER_THICK],
            ['3dash', Border::BORDER_MEDIUMDASHED],
            ['3dashdot', Border::BORDER_MEDIUMDASHDOT],
            ['3dashdotdot', Border::BORDER_MEDIUMDASHDOTDOT],
            ['3dot', Border::BORDER_DOTTED],
            ['3double', Border::BORDER_DOUBLE],
        ];
    }

    public static function providerFillType(): array
    {
        return [
            ['solid', Fill::FILL_SOLID],
            ['gray75', Fill::FILL_PATTERN_DARKGRAY],
            ['gray50', Fill::FILL_PATTERN_MEDIUMGRAY],
            ['gray25', Fill::FILL_PATTERN_LIGHTGRAY],
            ['gray125', Fill::FILL_PATTERN_GRAY125],
            ['gray0625', Fill::FILL_PATTERN_GRAY0625],
            ['horzstripe', Fill::FILL_PATTERN_DARKHORIZONTAL],
            ['vertstripe', Fill::FILL_PATTERN_DARKVERTICAL],
            ['reversediagstripe', Fill::FILL_PATTERN_DARKUP],
            ['diagstripe', Fill::FILL_PATTERN_DARKDOWN],
            ['diagcross', Fill::FILL_PATTERN_DARKGRID],
            ['thickdiagcross', Fill::FILL_PATTERN_DARKTRELLIS],
            ['thinhorzstripe', Fill::FILL_PATTERN_LIGHTHORIZONTAL],
            ['thinvertstripe', Fill::FILL_PATTERN_LIGHTVERTICAL],
            ['thinreversediagstripe', Fill::FILL_PATTERN_LIGHTUP],
            ['thindiagstripe', Fill::FILL_PATTERN_LIGHTDOWN],
            ['thinhorzcross', Fill::FILL_PATTERN_LIGHTGRID],
            ['thindiagcross', Fill::FILL_PATTERN_LIGHTTRELLIS],
        ];
    }
}
