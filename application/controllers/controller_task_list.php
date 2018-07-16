<?php
//Класс для работы со страницей задач
class Controller_task_list extends Controller
{

	function action_index()
	{	

		$this->setView('task_list_view.php', 'template_view.php');
	}
}