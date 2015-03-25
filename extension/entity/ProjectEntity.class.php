<?php
class ProjectEntity extends BaseEntity
{

	public function tableSave($id, $tbl)
	{
		//return 'update t_project set t_tables="'.$tbl.'" where t_pkId='.$id;
		
		$all = $this->query('update t_project set t_tables="'.$tbl.'" where t_pkId='.$id);
		if($all === false)
			return false;
		return true;
	}
	public function insert($pjname,$year,$month,$day)
	{
		$all = $this->query('insert into t_project (t_projectName, t_year,t_month,t_day ,t_tables) values("'.$pjname.'",'.$year.','.$month.','.$day.',"[[\"项目\",\"责任科室\",\"责任人\",\"完成情况\"]]");');
		//echo 'insert into t_project (t_projectName, t_year,t_month,t_day) values("'.$pjname.'",'.$year.','.$month.','.$day.');';
		if($all === false)
			return false;
		return true;
	}
	
	public function update($id,$pjname,$year,$month,$day)
	{
		$all = $this->query('update t_project  set t_projectName ="'.$pjname.'" , t_year ='.$year.' ,'.
				't_month = '.$month.' ,t_day = '.$day.' where t_pkid='.$id);
		//echo 'insert into t_project (t_projectName, t_year,t_month,t_day) values("'.$pjname.'",'.$year.','.$month.','.$day.');';
		if($all === false)
			return false;
		return true;
	}
	public function del($id)
	{
		$all = $this->query('delete from t_project where t_pkid='.$id.';');
		//echo "delete from t_project where t_pkid=";
		if($all === false)
			return false;
		return true;
	}
	public function updateTitle($id, $title)
	{
		$all = $this->query('update t_project set t_projectName="'.$title.'" where t_pkid='.$id.';');
		//echo "delete from t_project where t_pkid=";
		if($all === false)
			return false;
		return true;
	}
	public function getAll()
	{
		$all = $this->query("SELECT * FROM t_project;");
		if($all === false)
			return false;
		if(count($all) == 0)
			return null;
		return $all;
	}
	
	public function get($id)
	{
		//return "SELECT * FROM t_project where t_pkId=".$id.";";
		$all = $this->query("SELECT * FROM t_project where t_pkId=".$id.";");
		if($all === false)
			return false;
		if(count($all) == 0)
			return null;
		return $all;
	}
	public function getByYear($year)
	{
		$all = $this->query("SELECT * FROM t_project where t_year=".$year.";");
		if($all === false)
			return false;
		if(count($all) == 0)
			return null;
		return $all;
	}
	public function getYears()
	{
		$all = $this->query("SELECT t_year FROM t_project group by t_year;");
		if($all === false)
			return false;
		if(count($all) == 0)
			return null;
		return $all;
	}
}

?>
