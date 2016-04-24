<?php

namespace SBS\Message;

/**
 * SEL Message class.
 */
class SEL extends \SBS\Message {

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
