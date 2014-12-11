<?php

class TodoController extends BaseController {

	public function postTodoCreate() {

		if(Session::token() !== Input::get('_token')){
			return Response::json(array(
				'msg' => 'Neovlašteni pokušaj slanja zahtjeva.'
			));
		}


		$validator = Validator::make(Input::all(), array(
			'title' => 'required',
			'content' => 'required',
			'todo_time' => 'required'
 		));

		// Todo lista errori
		/*
		public function ifHasErrors($validation) {
			$respond = "";
			if($validation->has('title')) 
				$respond = $valiation->first('title');
			if($validation->has('content'))
				$respond = $valiation->first('content');
			if($validation->has('todo_date'))
				$respond = $valiation->first('todo_date');

			return $respond;
		}*/

 		if($validator->fails()) {

 			return Response::json(array(
 				'status' => 'failed',
            	'msg' => $validator->messages()->toJson()
 			));
 		} else {
 			

 			$todo = Todo::create(array(
 				'title' =>  Input::get('title'),
 				'content' => Input::get('content'),
 				'todo_time' => Input::get('todo_time'),
 				'user_id' => Auth::user()->id
 			));


			return Response::json(array(
	            'status' => 'success',
	            'msg' => 'Dodali ste novi događaj.',
	        ));

 		}

 		
	}

	public function postTodoDelete() {
		$todo = Todo::find(Input::get('id'));
		$event = $todo->title;
		$todo->delete();

		return Response::json(array(
	            'status' => 'success',
	            'msg' => 'Izbrisan je ' . $event
	    ));
	}
}