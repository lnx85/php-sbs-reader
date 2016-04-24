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
 * ID Message class.
 *
 * @see \SBS\Message
 */
class ID extends \SBS\Message {

	/* **************************************************************************************************** */

	/**
	 * Callsign (default value: null)
	 *
	 * @var string
	 * @access private
	 */
	private $callsign = null;

	/* **************************************************************************************************** */

	/**
	 * Create a new SEL.
	 *
	 * @access public
	 * @param array $data
	 * @return void
	 */
	public function __construct($data) {
		parent::__construct($data);
		$this->callsign = array_shift($this->extra);
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
	}

	/* **************************************************************************************************** */

}
