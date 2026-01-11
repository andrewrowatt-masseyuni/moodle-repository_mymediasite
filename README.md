[![Moodle Plugin CI](https://github.com/andrewrowatt-masseyuni/moodle-repository_mediasite/actions/workflows/moodle-ci.yml/badge.svg)](https://github.com/andrewrowatt-masseyuni/moodle-repository_mediasite/actions/workflows/moodle-ci.yml)
# Mediasite Repository

A Moodle repository plugin that enables integration with Mediasite video platform, allowing users to browse and embed Mediasite content directly within Moodle.

## Description

The Mediasite Repository plugin provides seamless integration between Moodle and Mediasite video content management systems. This repository plugin allows instructors and content creators to browse, search, and embed Mediasite videos and presentations directly into their Moodle courses. Users can access Mediasite content through the add link file picker interface when adding resources or activities to their courses, making it easy to incorporate rich media content into the learning experience.

**Note**: This plugin uses the Mediasite API. You will require credentials from your Mediasite host or provider.

## Installing via uploaded ZIP file

1.  Log in to your Moodle site as an admin and go to *Site administration \> Plugins \> Install plugins*.
2.  Upload the ZIP file with the plugin code. You should only be prompted to add extra details if your plugin type is not automatically detected.
3.  Check the plugin validation report and finish the installation.

## Installing manually

The plugin can be also installed by putting the contents of this directory to

```
{your/moodle/dirroot}/repository/mediasite
```

Afterwards, log in to your Moodle site as an admin and go to *Site administration \> Notifications* to complete the installation.

Alternatively, you can run

```
$ php admin/cli/upgrade.php
```

to complete the installation from the command line.

## License

Copyright 2026 Andrew Rowatt [A.J.Rowatt@massey.ac.nz](mailto:A.J.Rowatt@massey.ac.nz)

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.

