<?php
class GroupEntity extends BaseEntity {
	private $db_table = "group";
	public function Add($name) {
		$all = $this->query ( "insert into `" . $this->db_table . "` (t_groupName) values" . "('$name');" );
		if ($all === false)
			return false;
		return true;
	}
	public function Del($id) {
		$all = $this->query ( "delete from `" . $this->db_table . "` where t_pkid=".$id );
		if ($all === false)
			return false;
		return true;
	}
	public function Update($id, $name)
	{
		$all = $this->query ( "update `" . $this->db_table . "` set t_groupName='".$name."' where t_pkid=".$id );
		if ($all === false)
			return false;
		return true;
	}
	public function GetAll() {
		$all = $this->query ( "select * from `".$this->db_table."`" );
		if ($all === false)
			return false;		
		return $all;
	}
}

?>