<?


class Service
{
	protected $_model = null;

	public function __construct()
	{
		if (strlen($serviceName = Text::cutTo(get_class($this), 'Service'))) {
			$serviceName .= 'Model';
			$this->_model = new $serviceName();
		}
	}

	public function findById($id)
	{
		return is_null($this->_model) ? null : $this->_model->fetchById($id);
	}
}