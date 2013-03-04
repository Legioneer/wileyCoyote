<?php

/**
 * Contact	
 * Represents a contact
 */ 
class Contact
{
	/**
	 *	Holds all data fields for a contact
	 */	
	protected $data = array(// protected is available in other classes unlike private,public is too much
		'id' => null,
		'firstName' => null,
		'lastName' => null,
		'phone' => null,
		'address' => null,
		'city' => null,
		'state' => null,
		'zip' => null,
	);
	
	/**
	 * Construct method	
	 * @param array $data an assiciative data array for contact
	 */
	public function __construct(array $data)// passingin an array of data to overlay on top of null values l.6
	{
		$data = array_merge($this->data, $data);
		$this->data = array_intersect_key($data, $this->data);//$this->data is control
	}
	
	public function save()
	{
		$this->validate();
		$this->write();
	}
	
	public function validate()
	{
		$valid = true;
		$messages = array();

		// validate firstName
		if (!isset($this->data['firstName'])) {
			$valid = false;
			$messages[] = 'First name is required.';
		}

		// validate lastName
		if (!isset($this->data['lastName'])) {
			$valid = false;
			$messages[] = 'Last name is required.';
		}
		
		if (!$valid) {
			$exception = new ValidationException();
			$exception->setMessages($messages);
			throw $exception;
		}
	}
	
	protected function write()
	{
		$database = Registry::getDatabase();
		if (isset($this->data['id'])) {
			$this->data = $database->update('contact', $this->data['id'], $this->data);
		} else {
			$this->data = $database->insert('contact', $this->data);
		}
	}

	/**
	 * Accessor Method items in data array	
	 * @param string $key
	 * @returns mixed value from data array
	 * @throws \Exception if the key does not exist in the data array
	 */
	public function __get($key)// $key value associated with above $data
	{
		if (array_key_exists($key, $this->data)){
			return $this->data[$key];
		}
		
		throw new \Exception("You typed the data key wrong or forgot to update the contact: '{$key}'");	
	}
	
	/**
	 *	Returns data array
	 */
	public function toArray()
	{
		return $this->data; // returns entire array
	}	
};

