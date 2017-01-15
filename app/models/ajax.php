<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/app/core/DataBase.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/app/core/Check.php';
class Ajax {
	
	public $ajaxResult = [];
	
	protected $nameComment;
	protected $textComment;
	protected $emailComment;
			
	use Check;
		
	public function __construct() {
		
		$db = new DataBase();

		
		if (isset($_POST['name'], $_POST['comment'], $_POST['email']) ) {

			
			if (($_POST['name'] != '') && ($_POST['email'] != '') && ($_POST['comment'] != '')) {

				$this->nameComment = $this->check_data_in($_POST['name']);
				$this->textComment = $this->check_data_in($_POST['comment']);
				$this->emailComment = $this->check_data_in($_POST['email']);
			
				$result1 = $db->mysqli->prepare("INSERT INTO `comments` (`name`, `email`, `text`, `date`)
												VALUES (?,?,?,NOW())");
				$result1->bind_param('sss', $this->nameComment, $this->emailComment, $this->textComment);
				$result1->execute();
				$result1->close();
			
				$this->ajaxResult = [
						'name'     => $this->nameComment,
						'email'	   => $this->emailComment,
						'comment'  => $this->textComment,
						
				];
				echo json_encode($this->ajaxResult);
			}
			
		}
		
		$db->mysqli->close();
	}	
	
}

$ajax = new Ajax();
