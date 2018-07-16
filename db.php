<?php
	//Соединение с базой данных
	$dbhost = "localhost";
	$dbname = "test";
	$password = "";
	$username = "root";
	$db = new PDO("mysql:host=$dbhost; dbname=$dbname", $username, $password);
	//Условие на случай нажатия одной из трёх кнопок для вывода(TODO,DOING,DONE)
	if($_POST["name"] !== NULL){
		//Функция для вывода задач на экран с помощью ajax
		outputAll($db, $_POST["name"]);
	}
	//Условие на случай редактирования задачи
	if($_POST["id"] !== NULL){
		//Функция редактирования
		editTask($db, $_POST["preStatus"]);
	}elseif($_POST["task"] !== NULL){
		//Функция создания новой задачи
		setTask($db);
	}
	//Условие для вывода меню редактирования
	if($_POST["edit"] !== NULL){
		outputEditMenu($db, $_POST["edit"], $_POST["pagename"]);
	}
	//Функция вывода меню редактирования
	function outputEditMenu(&$dbv, $edit, $pagename){
		//Поиск задачи по его описанию
		$singles = get_by_task($dbv, $edit, $pagename);
		$singles = $singles->fetch(PDO::FETCH_ASSOC);
		//Комментарии в бд представлены в виде засериализованного массива 
		$comm = unserialize($singles["comm"]);
		//Вывод самой формы для редактирования (вышло не красиво как-то)
		print("<form method=\"POST\" class=\"AjaxForm\">
		Task: <br><input type=\"text\" name=\"task\" required value=".$singles["task"]."></input><br>
		<input type=\"radio\" name=\"status\" value=\"TODO\" checked>TODO <br>
		<input type=\"radio\" name=\"status\" value=\"DOING\">DOING <br>
		<input type=\"radio\" name=\"status\" value=\"DONE\">DONE <br>
		<input type=\"hidden\" name=\"id\" value=".$singles["id"].">
		<input type=\"hidden\" name=\"preStatus\" value=".$pagename.">
		Input Comment: <br><input type=\"text\" name=\"comm\"></input><br>
		<input type= \"submit\" value= \"Create\" id=\"editPost\"><br>
		</form>");
		//Вывод самих комментариев
		if($comm!=false){
			foreach ($comm as $key => $value) {
				echo $key+1,")",$value,"<br>";
			}
		}
	}
	//Функция вывода задач в зависимости от нажатой кнопки
	function outputAll(&$dbv, $pagename){
	    $sg = $dbv->query("SELECT * FROM $pagename ORDER BY datet DESC");
	    foreach ($sg as $single) : ?>
			<div class="list_theme">
				<h2><a href="#" class="show_popup" rel="editTask"><?php echo $single["task"]; ?></a></h2>
				<div><?php echo $single["datet"]; ?> 
					<span>Number of comments: <?php	if(unserialize($single["comm"])!=false){
						echo count(unserialize($single["comm"]));
					}else
				 		echo "0";
				 	?>
					</span>
				</div>
			</div>
		<?php endforeach;

	}
	//Функция получения конкретной задачи по описанию
	function get_by_task($dbv, $task, $name){
		$sg = $dbv->query("SELECT * FROM $name WHERE task='$task'");
		return $sg;
	}
	//Функция редактирования задачи
	function editTask(&$dbv, $pagename){
		try{
			$dbv->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$task = $_POST["task"];
			$status = $_POST["status"];
			$comm_POST = $_POST["comm"];
			$datet = date("Y-m-d H:i:s");
			$id = $_POST["id"];
			$sql = "SELECT * FROM $pagename WHERE id='$id'";
			$sg = $dbv->query($sql);
			$sg = $sg->fetch(PDO::FETCH_ASSOC);
			$comm = unserialize($sg["comm"]);
			$comm[] = $comm_POST;
			$comm = serialize($comm);
			//Обновление, если задача не переносится в другой список задач
			if($pagename === $status){
				$sql = "UPDATE $status SET
		 			task='$task', comm='$comm'
		 			WHERE id='$id'";
		 		$dbv->query($sql);
			}else{
				//При переносе в другой список задач, прошлая удаляется и создаётся новая
				$sql = "DELETE FROM `$pagename`
						WHERE id='$id'";
				$dbv->query($sql);
				$sql = "INSERT INTO $status(task,datet,comm)
						VALUES ('$task', '$datet','$comm')";
				$dbv->query($sql);	
			}
		}
		catch(PDOException $e)
	    {
	    	echo $sql . "<br>" . $e->getMessage();
	    }	
	}
	//Функция создания задачи
	function setTask(&$dbv){
		echo "Раз тебя наебали";
		$task = $_POST["task"];
		unset($_POST["task"]);
		$datet = date("Y-m-d H:i:s");
		$status = $_POST["status"];
		$sql = "INSERT INTO $status(task, datet, comm)
		     			VALUES ('$task', '$datet', '')";
		$dbv->query($sql);
		

	}	

