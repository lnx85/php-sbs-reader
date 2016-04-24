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
 * @package    SBS\Message
 * @author     Lorenzo Monaco <lnx85@lnxlabs.it>
 * @copyright  Copyright (c) 2016 Lorenzo Monaco (http://www.lnxlabs.it/)
 * @license    https://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3
 * @filesource
 */
namespace SBS\Message;

/**
 * MSG Message class.
 *
 * @see \SBS\Message
 */
class MSG extends \SBS\Message {

	/* **************************************************************************************************** */

	/**
	 * Callsign (default value: null)
	 *
	 * @var string
	 * @access private
	 */
	private $callsign = null;

	/**
	 * Altitude (default value: null)
	 *
	 * @var int
	 * @access private
	 */
	private $altitude = null;

	/**
	 * Ground speed (default value: null)
	 *
	 * @var int
	 * @access private
	 */
	private $groundSpeed = null;

	/**
	 * Track (default value: null)
	 *
	 * @var int
	 * @access private
	 */
	private $track = null;

	/**
	 * Latitude (default value: null)
	 *
	 * @var float
	 * @access private
	 */
	private $latitude = null;

	/**
	 * Longitude (default value: null)
	 *
	 * @var float
	 * @access private
	 */
	private $longitude = null;

	/**
	 * Vertical rate (default value: null)
	 *
	 * @var int
	 * @access private
	 */
	private $verticalRate = null;

	/**
	 * Squawk (default value: null)
	 *
	 * @var string
	 * @access private
	 */
	private $squawk = null;

	/**
	 * Alert flag, squawk has changed (default value: false)
	 *
	 * @var bool
	 * @access private
	 */
	private $alert = false;

	/**
	 * Emergency flag (default value: false)
	 *
	 * @var bool
	 * @access private
	 */
	private $emergency = false;

	/**
	 * SPI flag, transponder ident has been activated (default value: false)
	 *
	 * @var bool
	 * @access private
	 */
	private $spi = false;

	/**
	 * On ground flag, ground squat switch is active (default value: false)
	 *
	 * @var bool
	 * @access private
	 */
	private $onGround = false;

	/* **************************************************************************************************** */

	/**
	 * Create a new MSG.
	 *
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function __construct($data) {
		parent::__construct($data);
		$this->callsign       = array_shift($this->extra);
		$this->altitude       = intval(array_shift($this->extra));
		$this->groundSpeed    = intval(array_shift($this->extra));
		$this->track          = intval(array_shift($this->extra));
		$this->latitude       = floatval(array_shift($this->extra));
		$this->longitude      = floatval(array_shift($this->extra));
		$this->verticalRate   = intval(array_shift($this->extra));
		$this->squawk         = sprintf('%04d', intval(array_shift($this->extra)));
		$this->alert          = (1 == array_shift($this->extra));
		$this->emergency      = (1 == array_shift($this->extra));
		$this->spi            = (1 == array_shift($this->extra));
		$this->onGround       = (1 == array_shift($this->extra));
	}

	/* **************************************************************************************************** */

	/**
	 * Get callsign.
	 *
	 * @access public
	 * @return string
	 */
	public function getCallsign() {
		return $this->callsign;
	}

	/**
	 * Get altitude.
	 *
	 * @access public
	 * @return int
	 */
	public function getAltitude() {
		return $this->altitude;
	}

	/**
	 * Get ground speed.
	 *
	 * @access public
	 * @return int
	 */
	public function getGroundSpeed() {
		return $this->groundSpeed;
	}

	/**
	 * Get track.
	 *
	 * @access public
	 * @return int
	 */
	public function getTrack() {
		return $this->track;
	}

	/**
	 * Get latitude.
	 *
	 * @access public
	 * @return float
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * Get longitude.
	 *
	 * @access public
	 * @return float
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * Get vertical rate.
	 *
	 * @access public
	 * @return int
	 */
	public function getVerticalRate() {
		return $this->verticalRate;
	}

	/**
	 * Get squawk.
	 *
	 * @access public
	 * @return string
	 */
	public function getSquawk() {
		return $this->squawk;
	}

	/**
	 * Get alert flag, squawk has changed.
	 *
	 * @access public
	 * @return bool
	 */
	public function isAlert() {
		return $this->alert;
	}

	/**
	 * Get emergency flag.
	 *
	 * @access public
	 * @return bool
	 */
	public function isEmergency() {
		return $this->emergency;
	}

	/**
	 * Get SPI flag, transponder ident has been activated.
	 *
	 * @access public
	 * @return bool
	 */
	public function isSpi() {
		return $this->spi;
	}

	/**
	 * Get on ground flag, ground squat switch is active.
	 *
	 * @access public
	 * @return bool
	 */
	public function isOnGround() {
		return $this->onGround;
	}

	/* **************************************************************************************************** */

	/**
	 * Serialize object.
	 *
	 * @access public
	 * @return string
	 */
	public function serialize() {
		return serialize(
			unserialize(parent::serialize() + [
				'callsign'      => $this->getCallsign(),
				'altitude'      => $this->getAltitude(),
				'ground-speed'  => $this->getGroundSpeed(),
				'track'         => $this->getTrack(),
				'latitude'      => $this->getLatitude(),
				'longitude'     => $this->getLongitude(),
				'vertical-rate' => $this->getVerticalRate(),
				'squawk'        => $this->getSquawk(),
				'alert'         => $this->isAlert(),
				'emergency'     => $this->isEmergency(),
				'spi'           => $this->isSpi(),
				'on-ground'     => $this->isOnGround(),
			])
		);
	}

	/**
	 * Unserialize object.
	 *
	 * @access public
	 * @param string $serialized
	 * @return void
	 */
	public function unserialize($serialized) {
		parent::unserialize($serialized);
		$data = unserialize($serialized);
		$this->callsign       = $data['callsign'];
		$this->altitude       = $data['altitude'];
		$this->groundSpeed    = $data['ground-speed'];
		$this->track          = $data['track'];
		$this->latitude       = $data['latitude'];
		$this->longitude      = $data['longitude'];
		$this->verticalRate   = $data['vertical-rate'];
		$this->squawk         = $data['squawk'];
		$this->alert          = $data['alert'];
		$this->emergency      = $data['emergency'];
		$this->spi            = $data['spi'];
		$this->onGround       = $data['on-ground'];
	}

	/* **************************************************************************************************** */

}
