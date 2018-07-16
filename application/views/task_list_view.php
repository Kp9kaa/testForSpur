<div class="topnav" id="myTopnav">
	<a href="#" class="list" rel="todo">TODO</a>
	<a href="#" class="list" rel="doing">DOING</a>
	<a href="#" class="list" rel="done">DONE</a>
	<a href="#" class="show_popup" rel="addTask">Add task</a>
</div>
<div class="overlay_popup"></div>
<div class="popup">
	<div class="object" id="addTask">
		<form method="POST">
			Task: <br>
			<input type="text" name="task" required></input><br>
			<input type="radio" name="status" value="TODO" checked>TODO <br>
			<input type="radio" name="status" value="DOING">DOING <br>
			<input type="radio" name="status" value="DONE">DONE <br>
			<input type= "submit" value= "Create">
		</form>
	</div>
	<div class="object2" id="editTask">
		
	</div>
</div>
<div class="content">
	
</div>
