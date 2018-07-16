<?php
	class View
	{
		// $template_view - это общий для всех страниц вид
		//$content_view - это вид для конкретной страницы
		
		function generate($content_view, $template_view)
		{
			
			require_once 'application/views/'.$template_view;
		}
	}