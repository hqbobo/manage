<?php
class User extends BaseEntity
{
	private $db_table = "user";
	const GroupAdminLevel = 5;
	const RootAdminLevel = 9;
	public function Auth($usr, $pwd)
	{
		$all = $this->query("SELECT count(1) as count FROM ".$this->db_table.' where t_account="'.$usr.'" and t_pwd="'.$pwd.'";');
		
		if($all === false)
			return false;
		return $all[0]->count;
	}
	
	public function Get($usr)
	{
		$all = $this->query("SELECT * FROM ".$this->db_table.' where t_account="'.$usr.'";');
		if($all === false)
			return false;
		if(count($all) == 0)
			return  false;
		return $all[0];
	}

	public function GetAll()
	{
		$all = $this->query("select * from ".$this->db_table);
		if($all === false)
			return false;
		return $all;
	}
	public function GetByGroup($group)
	{
		$all = $this->query("select * from ".$this->db_table." where fk_t_group=".$group);
		if($all === false)
			return false;
		return $all;
	}
	public function GetAllWithOrder()
	{
		$all = $this->query("select u.pk_id, u.t_name ,ELT(INTERVAL(CONV(HEX(left(CONVERT(u.t_name USING gbk),1)),16,10),".
	"0xB0A1,0xB0C5,0xB2C1,0xB4EE,0xB6EA,0xB7A2,0xB8C1,0xB9FE,0xBBF7,".
	"0xBFA6,0xC0AC,0xC2E8,0xC4C3,0xC5B6,0xC5BE,0xC6DA,0xC8BB,0xC8F6,".
	"0xCBFA,0xCDDA,0xCEF4,0xD1B9,0xD4D1),".
	"'A','B','C','D','E','F','G','H','J','K','L','M','N','O','P',".
	"'Q','R','S','T','W','X','Y','Z') as PY , g.t_groupName from `".$this->db_table."` u , `group` g where g.t_pkId = u.fk_t_group order by PY");
		if($all === false)
			return false;
		return $all;
	}

	
	public function Add($acct,$pwd, $name, $group, $level)
	{
		$all = $this->query("insert into ".$this->db_table." (t_account, t_pwd, t_name, fk_t_group, t_level) values"
				."('$acct', '$pwd','$name', '$group', $level);");		
		if($all === false)
			return false;
		return true;
	}
	public function Del($id)
	{
		$all = $this->query("delete from ".$this->db_table." where pk_id=".$id);
		if($all === false)
			return false;
		return true;
	}
	public function Update($id,$level)
	{
		$all = $this->query("update ".$this->db_table." set t_level=".$level." where pk_id=".$id);
		if($all === false)
			return false;
		return true;
	}
	public function DuplicateAcct($acct)
	{
		$all = $this->query('select count(*) as `count` from '.$this->db_table.' where t_account="'.$acct.'"');
		if($all === false)
			return false;
		if($all[0]->count == 0)
			return true;
		else 
			return false;
	}
}

?>