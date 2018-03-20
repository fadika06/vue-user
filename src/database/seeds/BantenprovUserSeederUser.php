<?php

/* Require */
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/* Models */
use Bantenprov\User\Models\Bantenprov\User\User;

class BantenprovUserSeederUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
        Model::unguard();

        $users = (object) [
            (object) [
                'name' => 'Administrator',
                'email' => 'admin@dev.bantenprov.com',
                'password' => '123456'
            ]
        ];

        foreach ($users as $user) {
            $model = User::updateOrCreate(
                [
                    'name' => $user->name,                
                    'email' => $user->email,
                    'password' => bcrypt($user->password),
                ]
            );
            $model->save();
        }
	}
}
