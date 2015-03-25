<?php
class TestEntity extends BaseEntity
{


	public function get()
	{
		$all = $this->query("SELECT * FROM ps_access ");
		if($all === false)
			return false;
		if(count($all) == 0)
			return null;
		return $all;
	}

}

?>
