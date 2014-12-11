@extends('layout.main')

@section('skripte')
<script>

$(document).ready(function($){
  


	function addToTable() {
		
		var title = document.getElementById("title");
		var content = document.getElementById("content");
		var todo_time = document.getElementById("todo_time");

		var table = document.getElementById("todo-table");
		
		var row = table.insertRow(-1);
		row.className = 'warning';
 		
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		
		var btn_remove = '<button class="btn btn-xs btn-success"><span class="glyphicon glyphicon-ok-sign"></span></button>';

		cell1.innerHTML = title.value;
		cell2.innerHTML = content.value;
		cell3.innerHTML = todo_time.value;
		cell4.innerHTML = btn_remove;

		title.value = "";
		content.value = "";
		todo_time.value = "";
	}

	function respondPolitely(msg) {

		$("#successStatus").fadeIn(100);

		var response = document.getElementById("successStatus");
		response.innerHTML = msg;

		$("#successStatus").delay(2000).fadeOut();
		$("#errorStatus").delay(1000).fadeOut();
	}

	function writeErrors(msg) {

		var message = JSON.parse(msg);
		var errors = document.getElementById("errorStatus");

		var response = "Molim obratite pažnju na slijedeće stvari:<br>";
		
		var title = ""; var content = ""; var todo_time = "";

		if(message.title) title = message.title + '<br>';
		if(message.content) content = message.content + '<br>';
		if(message.todo_time) todo_time = message.todo_time;
		response += title + content + todo_time; 
		errors.innerHTML = response;
		$("#errorStatus").delay(1000).fadeIn();
	}

	
	$('#ajax-post').on('submit', function() {

	
		$.post(
			$(this).prop('action'),
			{
				"_token" : $(this).find('input[name=_token]').val(),
				"title" : $('#title').val(),
				"content": $('#content').val(),
				"todo_time" : $('#todo_time').val()
			},
			function(data){
				//alert(data.msg);
				if(data.status == 'success')
				{
					addToTable();
					respondPolitely(data.msg);
				}
				else {
					writeErrors(data.msg);
				}
			},
			'json'
		);
		return false;
		
	});
});
</script>
@stop

@section('content')
	<div class="container">
		<div class="row">
			<h3>
			<b>
				 {{ $user->username }}
			</b>
			</h3>
		</div>
	</div>
	<div class="container">
		<div class="row"><p>
			@if($user->id == Auth::user()->id)
			<hr>
			<div class="well col-md-4">
				<h3><b>Dodaj zadatak na listu:</b></h3><hr>
				<form role="form" action="{{ URL::route('todo-create') }}" method="post" id="ajax-post">

				 	<div class="form-group">
				 		<label for="title">Naslov:</label>
						<input class="form-control" type="text" name="title" id="title" placeholder="Naslov"><br>
					</div>
					<div class="form-group">
						<label for="content">Opis:</label>
						<textarea  class="form-control" rows="3" name="content" id="content" form="ajax-post" placeholder="Opišite događaj"></textarea><br>
					</div>
					<div class="form-group">
						<label for="todo_time">Datum i vrijeme (nije obavezno):</label>
						<input class="form-control" type="datetime" id="todo_time" name="todo_time" placeholder="yyyy-MM-dd HH:mm:ss">
						<p><i><small>Ako datum i vrijeme ne budu upisani u navedenom formatu bit će postavljeni na 0. Format je: [yyyy-MM-dd HH:mm:ss]</small></i></p>
					</div>

					<input type="submit" class="btn btn-success" value="Dodaj" id="button">
					{{ Form::token()}}

					<!-- Error za ajax -->
					<div class="alert alert-success" role="alert" id="successStatus" style="display: none;"></div>
					<div class="alert alert-danger" role="alert" id="errorStatus" style="display: none;"></div>
				</form>
			</p></div>
			@endif
			<div class="col-md-8">
				<h3><b>To do:</b></h3><br>
				<table class="table table-bordered" style="table-layout: fixed;" id="todo-table">
					<tr class="warning">
						<th style="width: 20%"><b>Naslov:</b></th>
						<th style="width: 50%"><b>Opis:</b></th>
						<th style="width: 25%"><b>Vrijeme:</b></th>
						@if($user->id == Auth::user()->id)
						<th style="width: 5%"></th>
						@endif
					</tr>
					@foreach($user->todos as $todo)
					<tr class="warning" id="todoIdTr{{$todo->id}}">
						<td>{{$todo->title}}</td>
						<!-- U firefoxu ne radi scroll ((overflow:scroll|hidden;))) ...-->
						<td style="display:fixed;width:80px;">{{$todo->content}}</td>
						<td>{{$todo->todo_time}}</td>
						@if($user->id == Auth::user()->id)
						<td>
							<button class="btn btn-xs btn-danger" onClick="removeTodo({{$todo->id}},'{{ URL::route('todo-delete') }}')">
								<span class="glyphicon glyphicon-remove-sign"></span>
							</button>
						</td>
						@endif
					</tr>
				
					@endforeach
				</table>
			</div>
		</div>
	</div>
<script>
	function removeTodo(id, path) {

		$("#todoIdTr" + id).remove();

		$.post(
			path,
			{
				"id" : id
			},
			function(data){
				alert(data.msg);
			},
			'json'
		);
	}	
</script>
@stop