<?php

class ValidationException extends \Exception
{
	protected $message = 'Validation failed. Please correct errors and try again.';
	protected $messages = array();
	
	public function setMessages(array $messages)
	{
		$this->messages = $messages;
	}
	
	public function getMessages()
	{
		return $this->messages;
	}
}