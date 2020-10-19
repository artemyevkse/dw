<?


class Text
{
	public static function cutTo($text, $sTo)
	{
		return substr($text, 0, strrpos($text, $sTo));
	}
}