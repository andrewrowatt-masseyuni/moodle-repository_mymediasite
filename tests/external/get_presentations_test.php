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

namespace repository_mediasite\external;

/**
 * Tests for get_presentations external function
 *
 * @package    repository_mediasite
 * @category   test
 * @copyright  2026 Andrew Rowatt <A.J.Rowatt@massey.ac.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \repository_mediasite\external\get_presentations
 */
final class get_presentations_test extends \advanced_testcase {
    /**
     * Test that the return structure includes thumbnailurl field
     *
     * @covers \repository_mediasite\external\get_presentations::execute_returns
     */
    public function test_return_structure_includes_thumbnailurl(): void {
        $returns = get_presentations::execute_returns();

        // Get the list structure from the single structure.
        $liststructure = $returns->keys['list']->content;

        // Verify that the structure has a thumbnail field.
        $this->assertArrayHasKey('thumbnail', $liststructure->keys);

        // Verify that thumbnail is optional.
        $thumbnailfield = $liststructure->keys['thumbnail'];
        $this->assertEquals(VALUE_OPTIONAL, $thumbnailfield->required);

        // Verify it's a URL parameter type.
        $this->assertEquals(PARAM_URL, $thumbnailfield->type);
    }

    /**
     * Test that the return structure includes manage field
     *
     * @covers \repository_mediasite\external\get_presentations::execute_returns
     */
    public function test_return_structure_includes_manage(): void {
        $returns = get_presentations::execute_returns();

        // Verify that the structure has a manage field.
        $this->assertArrayHasKey('manage', $returns->keys);

        // Verify that manage is optional.
        $managefield = $returns->keys['manage'];
        $this->assertEquals(VALUE_OPTIONAL, $managefield->required);

        // Verify it's a URL parameter type.
        $this->assertEquals(PARAM_URL, $managefield->type);
    }
}
