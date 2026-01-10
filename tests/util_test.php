<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace repository_mymediasite;

/**
 * Tests for util class
 *
 * @package    repository_mymediasite
 * @category   test
 * @copyright  2026 Andrew Rowatt <A.J.Rowatt@massey.ac.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \repository_mymediasite\util
 */
final class util_test extends \advanced_testcase {

    /**
     * Test duration formatting through reflection
     *
     * @covers \repository_mymediasite\util::format_duration
     * @dataProvider duration_formatting_provider
     */
    public function test_duration_formatting($milliseconds, $expected): void {
        // Use reflection to test the private method.
        $reflection = new \ReflectionClass(util::class);
        $method = $reflection->getMethod('format_duration');
        $method->setAccessible(true);

        $result = $method->invoke(null, $milliseconds);
        $this->assertEquals($expected, $result);
    }

    /**
     * Data provider for duration formatting tests
     *
     * @return array Test cases with milliseconds and expected formatted output
     */
    public static function duration_formatting_provider(): array {
        return [
            'Zero duration' => [0, ''],
            'Negative duration' => [-1000, ''],
            '30 seconds' => [30933, '30 Seconds'],
            '4 minutes 35 seconds' => [275000, '4 Minutes 35 Seconds'],
            '1 hour 8 minutes 55 seconds' => [4135000, '1 Hour 8 Minutes 55 Seconds'],
            '1 second' => [1000, '1 Second'],
            '1 minute' => [60000, '1 Minute'],
            '1 hour' => [3600000, '1 Hour'],
            '2 hours 30 minutes 45 seconds' => [9045000, '2 Hours 30 Minutes 45 Seconds'],
            'Exact hour' => [7200000, '2 Hours'],
            'Exact minutes' => [300000, '5 Minutes'],
        ];
    }
}
