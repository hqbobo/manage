<?php
class AuthManager
{

	public  $AuthArray = array(
			1 => array('dir'=>'/', 'LoginPage'=>'/login.html','allRequired'=>'1', 
					'isAdmin'=>1, 'isRequired' => 1, 'AuthPage' => 'loginAction.php'),
			2 => array('dir'=>'/', 'LoginPage'=>'/login.html','allRequired'=>'1',
					'isAdmin'=>1, 'isRequired' => 1, 'AuthPage' => 'adminLoginAction.php')

			);
	static public function getLoginPage()
	{
		return '/login.html';
	}
	public function AuthTest($url,$usrSession)
	{		
		if(isset($usrSession))
		{
			return true;
		}
		foreach($this->AuthArray as $Auth)
		{		
			if(strpos($url,$Auth['AuthPage']) !== FALSE)
			{
				return true;
			}

		}
		return  false;
		//Functions::redirect($this->AuthArray[1]['LoginPage']);
	}
}