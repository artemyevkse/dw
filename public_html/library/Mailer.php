<?

class Mailer
{
	const MAIL_HEADER_FROM_NAME = "Alina Viardo";
	const MAIL_HEADER_FROM_EMAIL = "noreply@alinaviardo.ru";

    public function __construct()
    {
		return $this;
	}
	
	static function send($email, $theme, $text)
	{
		mail($email, $theme, $text, $this::_mailHeaders());
	}

	static function _mailHeaders()
	{
		$from = $this::MAIL_HEADER_FROM_NAME . ' <' . $this::MAIL_HEADER_FROM_EMAIL . '>';

		$headers .= "Reply-To: " . $from . "\r\n"; 
		$headers .= "Return-Path: " . $from . "\r\n"; 
		$headers .= "From: " . $from . "\r\n";  
		$headers .= "Organization: " . $this::MAIL_HEADER_FROM_NAME . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$headers .= "X-Priority: 3\r\n";
		$headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

		return $headers;
	}

}