<?php
class BaseEntity
{
	const DB_CONNECTION_SUCCESS = 0x0;
	const DB_CONNECTION_FAILD = 0x01;
	const DB_SQL_EXE_ERROR = 0x02;
	
	protected $connection;
	protected $errno = self::DB_CONNECTION_SUCCESS;
	
	protected function opendb()
	{
		$this->connection = DBConnFactory::instance();
		if($this->connection == false)
			$this->errno = self::DB_CONNECTION_FAILD;
	}
	
	protected function closedb()
	{
		if($this->connection)
		{
			$this->connection->close();
			$this->connection = false;
		}
	}

	protected function isUsedb()
	{
		return $this->connection == false ? false : true;
	}
	
	public function errno($errno = null)
	{
		if(!empty($errno))
			$this->errno = $errno;
		return $this->errno;
	}

	protected function query($sql)
	{
		$this->opendb();
		if($this->isUsedb() == false)
			return false;
		$res = $this->connection->query($sql);
		if ($this->connection->errno) {
			$this->errno = self::DB_SQL_EXE_ERROR;
			return false;
		}
		if($res){
			if(is_object($res)){
				$objs = array();
				$fields = $res->fetch_fields();
				while(($row = $res->fetch_array(MYSQLI_ASSOC)) == true){
					$dao = $this->newInstanceDao();
					foreach ($fields as $field) {
						$dao->{$field->name} = $row[$field->name];
// 						echo "$field->name : ".$row[$field->name]."</br>";
					}
					$obj = array_push($objs, $dao);
				}
				$res->close();
				return $objs;
			}else{
				$res = $this->connection->insert_id;
			}
		}
		
		return $res;
	}
		
	public function newInstanceDao()
	{
		return new stdClass();
	}
}

?>