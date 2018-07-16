$(document).ready(function(){
	//Вывод формы для создания задачи
	$('.show_popup').click(function() {
	    let popup_id = $('#' + $(this).attr("rel"));
	    $(popup_id).show();
	    $('.overlay_popup, .popup').show();
	})
	$('.overlay_popup').click(function() {
	    $('.overlay_popup, .popup, #addTask, #editTask').hide();
	})
	//Передача данных формы с помощью ajax для создания новой задачи 
	$('form').submit(function(){
		$.ajax({
			type: "POST",
			url: "db.php",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false
		});
	});
	//Вывод меня для редактирования
	$('.content').on('click', '.show_popup', function() {
		let temp = $(this).text();
		let pagename = $('.content').attr("id");
		$.ajax({
				type: "POST",
				url: "db.php",
	      		data: ({edit: temp, pagename: pagename}),
				success: function(html){
					$(".object2").html(html);

				}
			});
	    let popup_id = $('#' + $(this).attr("rel"));
	    $(popup_id).show();
	    $('.overlay_popup, .popup').show();
	})
	//Вывод задач для конкретного списка
	$('.list').click(function(){
		let data = $(this).attr("rel");
		$('.content').attr("id",data);
		$.ajax({
			type: "POST",
			url: "db.php",
      		data: ({name: data}),
			success: function(html){
				$(".content").html(html);

			}
		});
		return false;
	});
	//Передача данных формы для редактирования задачи
	$(document).on('submit', 'form.AjaxForm',function(){
		$.ajax({
			type: "POST",
			url: "db.php",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false
		});
	})
		
});