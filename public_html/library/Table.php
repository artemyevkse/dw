<?

class Table
{
	protected $_table_name = null;
	protected $_fields = array();
	
    public function query($sql)
    {
        return Database::$hDb->query($sql);
    }
	
	public function insert($array)
	{
		$sql = "INSERT INTO `" . $this->_table_name . "`";

		$columns = ''; $values = '';
		foreach ($array as $key => $value) {
			if ($columns != '') {
				$columns .= ',';
				$values .= ',';
			}
			$columns .= '`' . $key . '`';
			$values	.= "'" . $value . "'";
		}		
		$sql .= " (" . $columns . ") VALUES (" . $values . ");";

		return $this->query($sql) ? Database::$hDb->insert_id : false;
	}
	
	public function update($setArray, $whereArray)
	{
		$sql = "UPDATE `" . $this->_table_name . "`";

		$sql .= " SET ";
		$str = '';
		foreach ($setArray as $key => $value) {
			if ($str != '') {
				$str .= ',';
			}
			$str .= '`' . $key . '` = \'' . $value . '\'';
		}		
		$sql .= $str;
		
		$sql .= ' WHERE ';		
		$where_string = '';
		foreach ($whereArray as $key => $value) {
			if ($where_string != '') {
				$where_string .= ' AND ';
			}
			$where_string .= '`' . $key . '` = \'' . $value . '\'';
		}		
		$sql .= $where_string;

		return $this->query($sql);
	}
	
	public function save($data, $staticFields = false)
	{
		$sql = "UPDATE `" . $this->_table_name . "`";
		$sql .= " SET ";
		$str = '';
		foreach ($data as $key => $value) {
			if ($staticFields && !in_array($key, $this->_fields)) continue;

			if ($str != '') {
				$str .= ',';
			}

			$str .= '`' . $key . '` = ' . (is_null($value) ? 'null' : "'" . $value . "'");
		}		
		$sql .= $str;

		$sql .= ' WHERE `id`=' . $data['id'];

		return $this->query($sql);
	}

	public function fetchComplexAll()
    {
        $sql = 'SELECT * FROM `' . $this->_table_name. '`';

        $result = $this->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

	public function getAllByParams($arrays, $limit = null)
	{
		$sql = 'SELECT * FROM `' . $this->_table_name. '`';

		$sql .= ' WHERE ';		
		$where_string = '';
		foreach ($arrays as $key => $value) {
			if ($where_string != '') {
				$where_string .= ' AND ';
			}
			$where_string .= '`' . $key . '` = \'' . $value . '\'';
		}		
		$sql .= $where_string;

		if (!is_null($limit)) {
			$sql .= ' LIMIT ' . $limit;
		}
		
		$sqlResult = $this->query($sql);
		
		return $sqlResult ? $sqlResult->fetch_all(MYSQLI_ASSOC) : null;	
	}

	public function firstByParams($arrays)
	{
		$rows = $this->getAllByParams($arrays, 1);

        return (!is_null($rows)) ? $rows[0] : null;
	}

	public function fetchById($id)
	{
		return $this->firstByParams(array('id' => $id));
	}
}