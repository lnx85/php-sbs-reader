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
 * @package    SBS
 * @author     Lorenzo Monaco <lnx85@lnxlabs.it>
 * @copyright  Copyright (c) 2016 Lorenzo Monaco (http://www.lnxlabs.it/)
 * @license    https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3
 * @filesource
 */
namespace SBS;

/**
 * Reader class is an implementation of SBS-1 Base Station protocol. It can
 * connect to a remote data provider and it can read data in SBS1 (BaseStation)
 * format.
 *
 * You have to extend the Reader class and implement your own event methods:
 *
 * <ul>
 *   <li>SBS\Reader::onConnect</li>
 *   <li>SBS\Reader::onDataReceive</li>
 *   <li>SBS\Reader::onMessage</li>
 *   <li>SBS\Reader::onError</li>
 * </ul>
 *
 * <pre><code>&lt;?php
 *
 * class MyReader extends \SBS\Reader {
 *
 *   public function onConnect($hostname, $port, $timeout) {
 *     printf('Reader connected to %s:%d', $hostname, $port);
 *     // your custom code here
 *   }
 *
 *   public function onDataReceive($data) {
 *     printf('Data received: array(%d)', count($data));
 *     // your custom code here
 *     return true;
 *   }
 *
 *   public function onMessage($message, $type, $transmission) {
 *     printf('New %s message received', $type);
 *     // your custom code here
 *   }
 *
 *   public function onError($errno, $error) {
 *     printf('Error %d: %s', $errno, $error);
 *     // your custom code here
 *   }
 *
 * }
 *
 * $reader = new MyReader('localhost', 30003);
 * if ($reader->connect()) {
 *   $reader->run();
 * }
 * </code></pre>
 *
 * @see SBS\Message
 * @see SBS\Message\AIR
 * @see SBS\Message\CLK
 * @see SBS\Message\ID
 * @see SBS\Message\MSG
 * @see SBS\Message\SEL
 * @see SBS\Message\STA
 *
 * @package SBS
 */
class Reader {

	/* **************************************************************************************************** */

	/**
	 * Source hostname (default value: 'localhost')
	 *
	 * @var string
	 * @access private
	 */
	private $hostname = 'localhost';

	/**
	 * Source port (default value: 30003)
	 *
	 * @var int
	 * @access private
	 */
	private $port = 30003;

	/**
	 * Connection timeout (default value: 30)
	 *
	 * @var int
	 * @access private
	 */
	private $timeout = 30;

	/**
	 * Connection socket (default value: null)
	 *
	 * @var socket
	 * @access private
	 */
	private $socket = null;

	/**
	 * Reader handlers
	 *
	 * @var array
	 * @access private
	 */
	private $handlers = [];

	/* **************************************************************************************************** */

	/**
	 * Create a new SBS\Reader.
	 *
	 * @access public
	 * @param string $hostname source hostname (default value: 'localhost')
	 * @param int $port source port (default value: 30003)
	 * @param int $timeout connection timeout (seconds, default value: 30)
	 * @return void
	 */
	public function __construct($hostname = 'localhost', $port = 30003, $timeout = 30) {
		$this->hostname = $hostname;
		$this->port = $port;
		$this->timeout = $timeout;
	}

	/* **************************************************************************************************** */

	/**
	 * Connect to source (dump1090).
	 *
	 * @access public
	 * @final
	 * @return mixed
	 */
	final public function connect() {
		if (false === ($this->socket = fsockopen($this->hostname, $this->port, $errno, $error, $this->timeout))) {
			$this->onError($errno, $error);
			return false;
		}
		$this->onConnect($this->hostname, $this->port, $this->timeout);
		return true;
	}

	/**
	 * Main reader loop.
	 *
	 * @access public
	 * @final
	 * @return void
	 */
	final public function run() {
		while (!feof($this->socket)) {
			$data = fgetcsv($this->socket, 1024);
			if (false !== $this->onDataReceive($data)) {
				if ($message = \SBS\Message::factory($data)) {
					$this->onMessage(
						// message received
						$message,
						// message type
						$message->getType(),
						// transmission type
						$message->is(\SBS\Message::MSG) ? $message->getTransmissionType() : false
					);
				}
			}
		}
	}

	/* **************************************************************************************************** */

	/**
	 * Event method called everytime the Reader connects to the remote source. You can check hostname,
	 * port and timeout settings used for the connection.
	 *
	 * @access public
	 * @param string $hostname connection hostname
	 * @param int $port connection port
	 * @param int $timeout connection timeout
	 * @return void
	 */
	public function onConnect($hostname, $port, $timeout) {
	}

	/**
	 * Event method called everytime the Reader receive some data. An array with the received data is
	 * passed to the method and you can test what values where received.
	 *
	 * If the method return false, the received data is not processed by the reader.
	 *
	 * @access public
	 * @param array $data received data
	 * @return bool
	 */
	public function onDataReceive($data) {
		return true;
	}

	/**
	 * Event method called everytime the Reader processed a Message. You get the entire \SBS\Message
	 * object, the message type and the transmission type (only on MSG messages).
	 *
	 * @access public
	 * @param \SBS\Message $message message received
	 * @param string $type message type (AIR, CLK, ID, MSG, SEL, STA)
	 * @param int $transmission transmission type (from 1 to 8 on MSG type, false otherwise)
	 * @return void
	 */
	public function onMessage($message, $type, $transmission) {
	}

	/**
	 * Event method called everytime an error occured. You get the error number and the error message.
	 *
	 * @access public
	 * @param int $errno error number
	 * @param string $error error message
	 * @return void
	 */
	public function onError($errno, $error) {
	}

	/* **************************************************************************************************** */

}