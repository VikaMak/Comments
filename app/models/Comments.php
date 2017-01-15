<?php
/**
 * Комментарии зарегистрированных пользователей
 * @author Vika
 *
 */
class Comments {
	
	public $comments = [];
	
	
	/**
	 * Подключение функций, необходимых для проверки данных
	 */
	use Check;
	
	public function __construct() {
		
		
		$db = new DataBase;					
		
			
		/**
		 * Выборка комментариев
		 */
		if ($result = $db->mysqli->query("SELECT * FROM `comments`
										  ORDER BY `date` DESC
										  ")) {
			
			while ($row_com = $result->fetch_assoc()) {
				
				$row_com['name'] = $this->check_data($row_com['name']);
				$row_com['email'] = $this->check_data($row_com['email']);
				$row_com['text'] = nl2br($this->check_data($row_com['text']));
				$this->comments[] = $row_com;
			}
		}
		
		$result->free();
		
		$db->mysqli->close();
		
	}
	
}