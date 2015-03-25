<?php
class Project
{
	public function TableSave($id, $tbl)
	{
		$projectEntity = new ProjectEntity();
		return $projectEntity->tableSave( $id,$tbl);
	}
	public function Get($id)
	{
		$projectEntity = new ProjectEntity();
		return $projectEntity->get( $id);
	}
	public function PrameterCheck($pjname,$year,$month,$day)
	{
		if(strlen($pjname) > 256)
			return ErrorCode::E_PROEJCTNAME_TOO_LONG;
		if($month < 1 || $month > 12)
			return ErrorCode::E_MONTH;
		if($day < 1 || $day > 31)
			return ErrorCode::E_DAY;
		return ErrorCode::E_SUCCESS;
	}
	public function Del($id)
	{
		$projectEntity = new ProjectEntity();
		if($projectEntity->del($id) == true)
			return  ErrorCode::E_SUCCESS;
		else
			return ErrorCode::E_DB_ERR;
	}
	public function Insert($pjname,$year,$month,$day)
	{
		$projectEntity = new ProjectEntity();
		if($projectEntity->insert($pjname, $year, $month, $day) == true)
			return  ErrorCode::E_SUCCESS;
		else 
			return ErrorCode::E_DB_ERR;
	}
	public function Update($id, $pjname,$year,$month,$day)
	{
		$projectEntity = new ProjectEntity();
		if($projectEntity->update($id, $pjname, $year, $month, $day) == true)
			return  ErrorCode::E_SUCCESS;
		else
			return ErrorCode::E_DB_ERR;
	}
	public function GetAllProject()
	{
		$projectEntity = new ProjectEntity();
		$years = $projectEntity->getYears();
		$arr = array();
		//var_dump($projectEntity->getYears());
		if($years != false){
			foreach ($years as $year)
			{
				$year->data = $projectEntity->getByYear( $year->t_year);
				array_push($arr, $year);
				
			}
		}
		return $arr;
	}
	public function UpdateTitle($id, $title)
	{
		$projectEntity = new ProjectEntity();
		if($projectEntity->updateTitle($id,$title) == true)
			return  ErrorCode::E_SUCCESS;
		else
			return ErrorCode::E_DB_ERR;
	}
	public function GetProject($id)
	{
		$projectEntity = new ProjectEntity();
		return $projectEntity->get($id);
	}
}
?>