<?


class UserService extends Service
{   
    public function getAllPersons()
    {
        return $this->_model->fetchComplexAll();
    }

	public function login($nickname, $password)
	{
		$user = $this->_model->firstByParams(array(
			'p_login' => $nickname,
			'p_password' => md5($password)
		));

		if (!is_null($user)) {
			$this->_uptime($user['id']);
		}

		return $user;
	}
	
	public function logout()
	{
		session_unset();
		session_destroy();
		session_write_close();
	}

	public function findByEmail($email)
	{
		return $this->_model->firstByParams(array(
			'p_email' => $email
		));
	}

	public function register($nickname, $email, $password, $name,
		$city, $country, $race = 1, $phone = null, $cryptPassword = true)
	{
		if ($result = $this->_model->insert(array(
			'p_login' => $nickname,
			'p_email' => $email,
			'p_password' => ($cryptPassword ? md5($password) : $password),
			'p_name' => $name,
			'p_city' => $city,
			'p_country' => $country,
			'p_race' => $race
			//'phone' => $phone
		))) {
			Mailer::send($email, 'Successfull registration!', 'Congratulation!');
		}

		return $result;
	}

	protected function _uptime($userId)
	{
		$this->_model->update(array(
			'p_date_online' => date('Y-m-d H:i:s', time())
		), array(
			'id' => $userId
		));
	}
}