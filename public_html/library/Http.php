<?

class Http
{

    public function __construct()
    {
		return $this;
	}
	
	static function redirect($url)
	{
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: ' . $url);

		exit;
	}

}