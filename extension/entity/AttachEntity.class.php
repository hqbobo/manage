<?php
class AttachEntity extends BaseEntity {
	private $db_table = "attach";
	public function Del($id)
	{
		$all = $this->query ( "delete from `".$this->db_table."` where t_pkId=".$id.";");
		if ($all === false)
			return false;
		return true;
	}
	public function GetById($id) {
		$all = $this->query ( "select * from `".$this->db_table."` where t_pkId=".$id );
		if ($all === false)
			return false;
		return $all[0];
	}
	public function GetByProject($id) {
		$all = $this->query ( "select * from `".$this->db_table."` where fk_projectId=".$id );
		if ($all === false)
			return false;
		return $all;
	}
	public function GetAll() {
		$all = $this->query ( "select * from `".$this->db_table."`" );
		if ($all === false)
			return false;		
		return $all;
	}
	public function Insert($url,$id, $filename, $uid)
	{
		$all = $this->query ( "insert into `".$this->db_table."` (url, fk_projectId,name,fk_user) values ('".$url."',".$id.", '".$filename."',".$uid.");");
		if ($all === false)
			return false;
		return true;
	}
}

?>