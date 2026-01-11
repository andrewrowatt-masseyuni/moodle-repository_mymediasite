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

/**
 * repository_mediasite plugin implementation
 *
 * Documentation: {@link https://moodledev.io/docs/apis/plugintypes/repository}
 *
 * @package    repository_mediasite
 * @copyright  2026 Andrew Rowatt <A.J.Rowatt@massey.ac.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/repository/lib.php');

/**
 * Repository repository_mediasite implementation
 *
 * @package    repository_mediasite
 * @copyright  2026 Andrew Rowatt <A.J.Rowatt@massey.ac.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class repository_mediasite extends repository {
    /**
     * Given a path, and perhaps a search, get a list of files.
     *
     * See details on {@link http://docs.moodle.org/dev/Repository_plugins}
     *
     * @param string $path this parameter can a folder name, or a identification of folder
     * @param string $page the page number of file list
     * @return array the list of files, including meta infomation, containing the following keys
     *           manage, url to manage url
     *           client_id
     *           login, login form
     *           repo_id, active repository id
     *           login_btn_action, the login button action
     *           login_btn_label, the login button label
     *           total, number of results
     *           perpage, items per page
     *           page
     *           pages, total pages
     *           issearchresult, is it a search result?
     *           list, file list
     *           path, current path and parent path
     */
    public function get_listing($path = '', $page = '') {
        if (!$page) {
            $page = 1;
        }

        $pageint = intval($page);
        $presentations = repository_mediasite\util::get_mediasite_presentations($pageint);

        return $presentations;
    }

    /**
     * file types supported by the plugin
     * @return array
     */
    public function supported_filetypes() {
        return ['video'];
    }

    /**
     * The plugin only return external links
     * @return int
     */
    public function supported_returntypes() {
        return FILE_EXTERNAL;
    }

    /**
     * Is this repository accessing private data?
     *
     * @return bool
     */
    public function contains_private_data() {
        return false;
    }


    /**
     * Add plugin settings input to Moodle form.
     * @param object $mform
     * @param string $classname
     */
    public static function type_config_form($mform, $classname = 'repository') {
        parent::type_config_form($mform, $classname);

        $basemediasiteurl = get_config('mediasite', 'basemediasiteurl');
        if (empty($basemediasiteurl)) {
            $basemediasiteurl = '';
        }

        $sfapikey = get_config('mediasite', 'sfapikey');
        if (empty($sfapikey)) {
            $sfapikey = '';
        }

        $authorization = get_config('mediasite', 'authorization');
        if (empty($authorization)) {
            $authorization = '';
        }

        $mform->addElement(
            'text',
            'basemediasiteurl',
            get_string('basemediasiteurl', 'repository_mediasite'),
            ['value' => $basemediasiteurl, 'size' => '40']
        );

        $mform->setType('basemediasiteurl', PARAM_RAW_TRIMMED);
        $mform->addRule('basemediasiteurl', get_string('required'), 'required', null, 'client');

        $mform->addElement(
            'text',
            'sfapikey',
            get_string('sfapikey', 'repository_mediasite'),
            ['value' => $sfapikey, 'size' => '40']
        );
        $mform->setType('sfapikey', PARAM_RAW_TRIMMED);
        $mform->addRule('sfapikey', get_string('required'), 'required', null, 'client');

        $mform->addElement(
            'text',
            'authorization',
            get_string('authorization', 'repository_mediasite'),
            ['value' => $authorization, 'size' => '40']
        );
        $mform->setType('authorization', PARAM_RAW_TRIMMED);
        $mform->addRule('authorization', get_string('required'), 'required', null, 'client');

        $mform->addElement('static', null, '', get_string('information', 'repository_mediasite'));
    }

    /**
     * Names of the plugin settings
     * @return array
     */
    public static function get_type_option_names() {
        return ['basemediasiteurl', 'sfapikey', 'authorization', 'pluginname'];
    }

    /**
     * Save options in config table.
     * @param array $options
     * @return boolean
     */
    public function set_option($options = []) {
        if (!empty($options['sfapikey'])) {
            set_config('sfapikey', trim($options['sfapikey']), 'mediasite');
        }
        if (!empty($options['authorization'])) {
            set_config('authorization', trim($options['authorization']), 'mediasite');
        }
        if (!empty($options['basemediasiteurl'])) {
            set_config('basemediasiteurl', trim($options['basemediasiteurl']), 'mediasite');
        }
        unset($options['sfapikey']);
        unset($options['authorization']);
        unset($options['basemediasiteurl']);
        return parent::set_option($options);
    }

    /**
     * Get options from config table.
     *
     * @param string $config
     * @return mixed
     */
    public function get_option($config = '') {
        if ($config === 'basemediasiteurl') {
            return trim(get_config('mediasite', 'basemediasiteurl'));
        } else {
            $options['basemediasiteurl'] = trim(get_config('mediasite', 'basemediasiteurl'));
        }

        if ($config === 'sfapikey') {
            return trim(get_config('mediasite', 'sfapikey'));
        } else {
            $options['sfapikey'] = trim(get_config('mediasite', 'sfapikey'));
        }
        if ($config === 'authorization') {
            return trim(get_config('mediasite', 'authorization'));
        } else {
            $options['authorization'] = trim(get_config('mediasite', 'authorization'));
        }

        return parent::get_option($config);
    }
}
