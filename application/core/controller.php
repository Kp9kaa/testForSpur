<?php
	//Основной класс контроллер от которого будут наследоваться остальные контроллеры

	class Controller {
		//Две приватные переменные, для работы с видом и моделью(модели может и не быть)
		private $model;
		private $view;
		
		function __construct()
		{
			$this->view = new View();
		}
		//функция для задания вида
		function setView($content_view, $template_view){
			$this->view->generate($content_view, $template_view);
		}
		//абстрактная функция, которая должна быть реализована в дочернем классе
		function action_index(){
			
		}
	}