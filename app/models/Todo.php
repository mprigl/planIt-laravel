<?php

class Todo extends Eloquent {

	protected $fillable = array('title','content','todo_time','user_id');

	protected $table = 'todos';

	public function user() {
		$this->belongsTo('User');
	}

}