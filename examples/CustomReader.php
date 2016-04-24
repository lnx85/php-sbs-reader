<?php
/**
 * PHP SBS Reader - https://github.com/lnx85/php-sbs-reader
 *
 * LICENSE
 *
 * This source file is subject to the GPLv3 license that is bundled
 * with this package in the file LICENSE
 *
 * If you do not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send and email to
 * license@lnxlabs.it so we can send you a copy immediatly.
 *
 * ALTERNATE LICENSING
 *
 * Commercial and OEM Licenses are available for an alternate
 * download of PHP SBS Reader: this is the appropriate option if
 * you are creating proprietary applications and you are not
 * prepared to distribute and share the source code of your
 * application under the GPLv3 license.
 *
 * @author     Lorenzo Monaco <lnx85@lnxlabs.it>
 * @copyright  Copyright (c) 2016 Lorenzo Monaco (http://www.lnxlabs.it/)
 * @license    https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3
 * @filesource
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set('Europe/London');

/** SBS Autoloader */
spl_autoload_register(function ($class) {
	$classFile = str_replace('\\', '/', $class).'.php';
	if (file_exists(__DIR__.'/../src/'.$classFile)) {
		require_once __DIR__.'/../src/'.$classFile;
	}
});

/** Define custom reader that extends \SBS\Reader */
class CustomReader extends \SBS\Reader {

	/** Overwrite default onConnect method */
	public function onConnect($hostname, $port, $timeout) {

		/** Print a message with connection data */
		printf('Reader connected to %s:%d', $hostname, $port);

	}

	/** Overwrite default onDataReceive method */
	public function onDataReceive($data) {

		/** Print a message with received data size */
		printf('Data received: array(%d)', count($data));

		/** Return true to continue message process */
		return true;

	}

	/** Overwrite default onMessage method */
	public function onMessage($message, $type, $transmission) {

		/** Print a message with received message type */
		printf('New %s message received', $type);

	}

	/** Overwrite default onError method */
	public function onError($errno, $error) {

		/** Print a message with error number and error message */
		printf('Error %d: %s', $errno, $error);

	}

}

/** Create a new CustomReader that connects to localhost:30003 */
$reader = new CustomReader('localhost', 30003);

/** Connect the reader */
if ($reader->connect()) {

	/** If connected, run main reader loop */
	$reader->run();

}
