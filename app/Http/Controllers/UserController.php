<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Views\View;
use App\Useful_funcs\Defeat;
use App\Useful_funcs\Redirect;

class UserController{

	// cabinet
	public function user_cabinet(){
		$template = 'user/index';
		View::view($template);
	}

	public function user_logout(){
		$url = "";
		setcookie('logged_user',"",time()-3600,"/");

		Redirect::redirect($url,"user_logout","Пользователь успешно вышел из системы");
	}

	// end cabinet


	 /**
     * Show the form for creating a new resource.
     */

	public function create_form(){

		$csrf_token = Defeat::csrf_defeat();

		$data = [
			'csrf_token'=>$csrf_token
		];
		$template = 'auth/register';
		View::view($template,$data);
	}


	 /**
     * Creating the data
     */

	public function create(){

		$errors = [];
		$_SESSION['create-user-success'] = "";

		$url_error = "register";
		$url_success = "";

		$name = $_POST['name'];
		$csrf_token = $_POST['csrf_token'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		//xss defeat
			$name = Defeat::xss_defeat($name);
		// 

		if(!preg_match("/^[a-zA-Z0-9_-]{4,}$/", $name)){
			$errors[] = "Никнейм должен содержать от 4 символов и состоять из латинских букв";
		}

		if(preg_match("/[a-zA-Z0-9]{6,}/",$password)){
			$password = password_hash($password, PASSWORD_DEFAULT);
		}
		else{
			$errors[] = "Легкий Пароль";
		}


		if($_SESSION['csrf_token']!==$csrf_token){
			$errors[] = "CSRF ATTACK";
		}




			$new_user = User::getInstance();
			$new_user->name = $name;
			$new_user->email = $email;
			$new_user->password = $password;

			
			if(!$errors){
				if($new_user->create()){
					$new_user->admin = 0;
					$json_user = json_encode($new_user);
					$success = "Пользователь был успешно создан";
					setcookie('logged_user',$json_user,time()+3600,"/");
					Redirect::redirect($url_success,'user_create_success',$success);
				}
				else{
					$errors[] = "Произошла ошибка при создание Пользователя";
					Redirect::redirect($url_error,'user_create_errors',$errors);
				}
			}
			else
			{
				$errors[] = "Произошла ошибка при создание Пользователя";
				Redirect::redirect($url_error,'user_create_errors',$errors);
			}	

	}


// endRegister

	 /**
     * Show the form for login
     */
	public function create_login_form(){
		$csrf_token = Defeat::csrf_defeat();

		$data = [
			'csrf_token'=>$csrf_token
		];
		$template = 'auth/login';
		View::view($template,$data);
	}

	 /**
     * Login method
     */
	public function login_check(){

		$errors = [];

		$email = $_POST['email'];
		$password = $_POST['password'];
		$csrf_token = $_POST['csrf_token'];

		$url_error = "login";

		if($_SESSION['csrf_token']!==$csrf_token){
			$errors[] = "CSRF ATTACK";
		}

		 $object = User::getInstance();
		 $user= $object->findAll()->where("email","=",$email)->get();
		 $user = $user[0];



		 if($user&&!$errors){
		 	 if(password_verify($password, $user->password)){
		 	 	if($user->isAdmin()){
				    $user->admin = 1;
				 }else
				 $user->admin = 0;

				 $json_user = json_encode($user);

			 	$success = "Успешная авторизация";
				setcookie('logged_user',$json_user,time()+3600,"/");
			 	Redirect::redirect("","login_success",$success);
			 }
			 else {
			 	$errors[] = "Неправильный пароль";
			 	Redirect::redirect($url_error,"login_error",$errors);
			 }
		 }
		 else{
		 	$errors[] = "Пользователь не найден";
		 	Redirect::redirect($url_error,"login_error",$errors);
		 }

	}



// Endlogin



}