<?php

/**
 * Контроллеры, которые подключают необходимые модели и представления (с параметрами, переданными из модели)
 * @author Vika
 *
 */
class Home extends Controller {
	
	public function index() {
		
		$userReg = $this->model('Registration');
		$userActive = $this->model('Activation');
		$userAuth = $this->model('Auth');
		$userComment = $this->model('Comments');
		$this->view('home/index',[
								
								'2'		     =>$userComment ->comments,							
								'login'      =>$userReg		->login,
								'password'   =>$userReg		->password,
								'email'      =>$userReg		->email,
								'age'        =>$userReg		->age,
								'er_login' 	 =>$userReg		->errors['login'],
								'er_password'=>$userReg		->errors['password'],
								'er_email'   =>$userReg		->errors['email'],
								'info'		 =>$userActive	->info,
								'errorLogin' =>$userAuth	->errorLogin,
								'emailLogin' =>$userAuth	->emailLogin,
								


		]);
		
	}	
	
	public function activation() {
		
		$userActive = $this->model('Activation');
		$userAuth = $this->model('Auth');
		$userReg = $this->model('Registration');
		$this->view('home/activation', ['info'	     =>$userActive->info,
										'login'    	 =>$userReg	  ->login,
										'password'   =>$userReg   ->password,
										'email'      =>$userReg   ->email,
										'age'        =>$userReg   ->age,
										'er_login'   =>$userReg   ->errors['login'],
										'er_password'=>$userReg   ->errors['password'],
										'er_email'   =>$userReg   ->errors['email'],		
										'errorLogin' =>$userAuth  ->errorLogin,
										'emailLogin' =>$userAuth  ->emailLogin,
										]);

	}
		
}
