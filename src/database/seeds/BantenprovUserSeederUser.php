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
                'label' => 'User 1',
                'description' => 'User 1',
            ],
            (object) [
                'label' => 'User 2',
                'description' => 'User 2',
            ]
        ];

        foreach ($users as $user) {
            $model = User::updateOrCreate(
                [
                    'label' => $user->label,
                ],
                [
                    'description' => $user->description,
                ]
            );
            $model->save();
        }
	}
}
