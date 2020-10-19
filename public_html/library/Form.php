<?


class Form
{
	protected $_errors = array();

	public function validation($data)
	{
		$this->_errors = array();

		$this->_execValidation($data);

		return count($this->_errors) == 0;
	}

	public function errors()
	{
		return $this->_errors;
	}

	public function addError($text)
	{
		$this->_errors[] = $text;
	}

	public function validName($name)
	{
		return preg_match('/^[a-zA-Zа-яА-Я\-\'\s]*$/u', $name);
	}

	public function validEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function validPhone($number, $digitCount = 11)
	{
		return preg_match("/^[\+]?[0-9]{1}( )?[\(]?[0-9]{3}[\)]?( )?[0-9\-]{7,9}$/", $number)
			&& (strlen($this->onlyDigits($number)) == $digitCount);
	}

	protected function _execValidation($data)
	{
	}

	static function onlyDigits($number)
	{
		$numberDigits = '';

		for ($i = 0; $i < strlen($number); $i++)
		{	
			$char = $number[$i];
			if ($char >= '0' && $char <= '9')
				$numberDigits .= $char;
		}

		return $numberDigits;
	}
}