<?php
/**
 * Авторизации зарегистрированных пользователей
 * @author Vika
 *
 */
class Auth {
	
	public $emailLogin;
	protected $passwordLogin;
	public $errorLogin = '';
	
	
	/**
	 * Подключение функций, необходимых для проверки данных
	 */
	use Check;
	
	public function __construct() {
		
	
		if (isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])) {
						
			
			$db = new DataBase;
			
			/**
			 * Проверка данных, введенных пользователем
			 * @var mixed
			 */
			$this->emailLogin = $this->check_data_in($_POST['emailLogin']);
			$this->passwordLogin = $this->check_data_in($_POST['passwordLogin']);
			
			/**
			 * Подготовленный запрос: выборка из таблицы users пользователя
			 * с введенным логином (если существует)
			 */
			if ($result = $db->mysqli->prepare("SELECT * FROM `users`
												WHERE `email`=?					
												AND `active`=1
												LIMIT 1")) {
														
				$result->bind_param('s', $this->emailLogin);
				$result->execute();
				$result = $result->get_result();
				$row = $result->fetch_assoc();
			}
			
			/**
			 * Проверка введенного пароля на совпадение с паролем из БД
			 */
			if ($result->num_rows AND password_verify($this->passwordLogin, $row['password'])) {
	
				$_SESSION['user'] = $row;

				header('Location: /public/home/#close');
				die();
				
								
			} else {
				
				/**
				 * Сообщение об ошибке, если не существует пользователя с данным логином и паролем
				 * @var string
				 */
				$this->errorLogin = 'Нет пользователя с таким email и паролем';
				
			}
			
			$result->close();
			
			$db->mysqli->close();

		}
		
		/**
		 * Завершение сеанса работы пользователя
		 */
		if (isset($_GET['act']) && ($_GET['act'] == 'user_exit')) {
			
			unset($_SESSION['user']);
				
			header('Location: /public/home/');
			die();
		}
		
	}
	
	
}