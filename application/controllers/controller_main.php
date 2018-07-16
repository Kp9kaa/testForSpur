<?php
//Класс для создания главного меню
class Controller_Main extends Controller
{
	function action_index()
	{	
		$this->setView('main_view.php', 'template_view.php');
	}
}