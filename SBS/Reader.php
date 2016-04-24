<?php

namespace SBS;

/**
 * SBS Reader class.
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
	 * @final
	 * @param string $hostname source hostname
	 * @param int $port source port
	 * @return void
	 */
	final public function __construct($hostname = 'localhost', $port = 30003, $timeout = 30) {
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
			if ($this->onDataReceive($data)) {
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
	 * Connection event.
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
	 * New data received.
	 *
	 * @access public
	 * @param array $data received data
	 * @return bool
	 */
	public function onDataReceive($data) {
		return true;
	}

	/**
	 * New message received
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
	 * New error generated.
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