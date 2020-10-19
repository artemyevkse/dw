<?


class UserModel extends Table
{
	protected $_table_name = 'persons';
	
	protected $_fields = array(
		'id',
		'p_login',
		'p_password',
		'p_email',
		'p_name',
		'p_city',
		'p_country',
		'p_race',
		'p_level',
		'p_experience',
		'c_id'
	);

    public function fetchComplexAll()
    {
        $sql = 'SELECT `persons`.*'
            . ', `clans`.`c_title`, `clans`.`c_slogan`'
            . ' FROM `persons`'
            . ' LEFT JOIN `clans` ON `clans`.`id` = `persons`.`c_id`;';

        $result = $this->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
