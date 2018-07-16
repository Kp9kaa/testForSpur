<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyForum</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="js/jquery-3.3.1.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<header>
		<div class="logo">
			<a href="#"><img class="graphiclogo" src="image/logo.png"></a>
		</div>
		<nav>
			<div class="topnav">
				<a href="/">Main</a>
				<a href="/task_list">Task list</a>
			</div>
		</nav>
	</header>
	<div class="main">
		<?php require_once 'application/views/'.$content_view; ?>
	</div>
	
</body>
</html>