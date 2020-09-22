<?

class UserModel extends Table
{
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
