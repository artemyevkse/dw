<?


class RegistrationForm extends Form
{
	protected function _execValidation($data)
	{
		if (!$this->validEmail($data['email'])) {
			$this->addError('Invalid email format');
		} else if ($this->_emailExists($data['email'])) {
			$this->addError('Email already exists!');
		}
		
		if (!$this->validName($data['name'])) {
			$this->addError('Only letters and white space allowed in name');
		}
	}

	protected function _emailExists($email)
	{
		$userService = new UserService();

		return $userService->findByEmail($email);
	}
}