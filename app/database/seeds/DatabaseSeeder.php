<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
    {
        DB::table('users')->delete();

        $f = Faker\Factory::create();
 
		for ($i = 0; $i < 30; $i++)
		{
		  $user = User::create(array(
		    'email' => $f->email,
			'username' => $f->userName,
			'password' => Hash::make('dddddd'),
			'active' => 1
		  ));

		  $rand = $f->numberBetween($min = 10, $max = 30);
		  for($j = 0; $j < $rand; $j++)
		  Todo::create(array(
		  	'title' =>  $f->word,
 			'content' => $f->sentence(4),
 			'todo_time' => $f->dateTime(),
 			'user_id' => $user->id
		  ));

		  $user = null;
		}

    }

}