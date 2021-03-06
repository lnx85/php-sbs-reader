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
 * Message class is the abstract representation of an SBS-1 Message. It describes general
 * message attributes.
 *
 * The \SBS\Message::factory static method builds a new Message class, depending on the
 * message type and it returns the related subclass of \SBS\Message.
 *
 * @abstract
 */
abstract class Message implements \Serializable {

	/* **************************************************************************************************** */

	/**
	 * AIR
	 *
	 * @const string
	 * @access public
	 */
	const AIR = 'AIR';

	/**
	 * CLK
	 *
	 * @const string
	 * @access public
	 */
	const CLK = 'CLK';

	/**
	 * ID
	 *
	 * @const string
	 * @access public
	 */
	const ID = 'ID';

	/**
	 * MSG
	 *
	 * @const string
	 * @access public
	 */
	const MSG = 'MSG';

	/**
	 * SEL
	 *
	 * @const string
	 * @access public
	 */
	const SEL = 'SEL';

	/**
	 * STA
	 *
	 * @const string
	 * @access public
	 */
	const STA = 'STA';

	/* **************************************************************************************************** */

	/**
	 * Transmission type (default value: null)
	 *
	 * @var int
	 * @access protected
	 */
	protected $transmissionType = null;

	/**
	 * Session ID (default value: null)
	 *
	 * @var int
	 * @access protected
	 */
	protected $sessionId = null;

	/**
	 * Aircraft ID (default value: null)
	 *
	 * @var int
	 * @access protected
	 */
	protected $aircraftId = null;

	/**
	 * Mode S hexadecimal identifier (default value: null)
	 *
	 * @var string
	 * @access protected
	 */
	protected $modeS = null;

	/**
	 * Flight record (default value: null)
	 *
	 * @var int
	 * @access protected
	 */
	protected $flight = null;

	/**
	 * Generated date/time (default value: null)
	 *
	 * @var \DateTime
	 * @access protected
	 */
	protected $generated = null;

	/**
	 * Logged date/time (default value: null)
	 *
	 * @var \DateTime
	 * @access protected
	 */
	protected $logged = null;

	/**
	 * Extra data (default value: null)
	 *
	 * @var array
	 * @access protected
	 */
	protected $extra = null;

	/* **************************************************************************************************** */

	/**
	 * Create a new SBS Message.
	 *
	 * @access protected
	 * @param mixed $data
	 * @return void
	 */
	protected function __construct($data) {
		$this->transmissionType   = intval(array_shift($data));
		$this->sessionId          = intval(array_shift($data));
		$this->aircraftId         = intval(array_shift($data));
		$this->modeS              = strtoupper(array_shift($data));
		$this->flight             = intval(array_shift($data));
		$this->generated          = \DateTime::createFromFormat('Y/m/d H:i:s.u', array_shift($data).' '.array_shift($data));
		$this->logged             = \DateTime::createFromFormat('Y/m/d H:i:s.u', array_shift($data).' '.array_shift($data));
		$this->extra              = $data;
	}

	/* **************************************************************************************************** */

	/**
	 * Get message type.
	 *
	 * @access public
	 * @return string
	 */
	public function getType() {
		$reflectionClass = new \ReflectionClass($this);
		return constant('self::'.$reflectionClass->getShortName());
	}

	/**
	 * Check message type.
	 *
	 * @access public
	 * @param string $type
	 * @return bool
	 */
	public function is($type) {
		return ($this->getType() === $type);
	}

	/* **************************************************************************************************** */

	/**
	 * Get transmission type.
	 *
	 * @access public
	 * @return int
	 */
	public function getTransmissionType() {
		return $this->transmissionType;
	}

	/**
	 * Get session identifier.
	 *
	 * @access public
	 * @return int
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * Get aircraft identifier.
	 *
	 * @access public
	 * @return int
	 */
	public function getAircraftId() {
		return $this->aircraftId;
	}

	/**
	 * Get Mode S identifier.
	 *
	 * @access public
	 * @return void
	 */
	public function getModeS() {
		return $this->modeS;
	}

	/**
	 * Get flight.
	 *
	 * @access public
	 * @return int
	 */
	public function getFlight() {
		return $this->flight;
	}

	/**
	 * Get message generation date/time.
	 *
	 * @access public
	 * @return \DateTime
	 */
	public function getGenerated() {
		return $this->generated;
	}

	/**
	 * Get message logged date/time.
	 *
	 * @access public
	 * @return \DateTime
	 */
	public function getLogged() {
		return $this->logged;
	}

	/* **************************************************************************************************** */

	/**
	 * Create a new SBS Message.
	 *
	 * @access public
	 * @static
	 * @param array $data message data
	 * @return mixed
	 */
	public static function factory($data) {
		$messageType = strtoupper(array_shift($data));
		$reflectionClass = new \ReflectionClass(__CLASS__.'\\'.$messageType);
		if ($reflectionClass->isSubclassOf(__CLASS__)) {
			return $reflectionClass->newInstance($data);
		}
		return false;
	}

	/* **************************************************************************************************** */

	/**
	 * Serialize object.
	 *
	 * @access public
	 * @return string
	 */
	public function serialize() {
		return serialize([
			'message-type'       => $this->getType(),
			'transmission-type'  => $this->getTransmissionType(),
			'session-id'         => $this->getSessionId(),
			'aircraft-id'        => $this->getAircraftId(),
			'mode-s'             => $this->getModeS(),
			'flight'             => $this->getFlight(),
			'generated'          => $this->getGenerated()->format('Y/m/d H:i:s.u'),
			'logged'             => $this->getLogged()->format('Y/m/d H:i:s.u'),
		]);
	}

	/**
	 * Unserialize object.
	 *
	 * @access public
	 * @param string $serialized
	 * @return void
	 */
	public function unserialize($serialized) {
		$data = unserialize($serialized);
		$this->transmissionType   = $data['transmission-type'];
		$this->sessionId          = $data['session-id'];
		$this->aircraftId         = $data['aircraft-id'];
		$this->modeS              = $data['mode-s'];
		$this->flight             = $data['flight'];
		$this->generated          = \DateTime::createFromFormat('Y/m/d H:i:s.u', $data['generated']);
		$this->logged             = \DateTime::createFromFormat('Y/m/d H:i:s.u', $data['logged']);
	}

	/* **************************************************************************************************** */
}
