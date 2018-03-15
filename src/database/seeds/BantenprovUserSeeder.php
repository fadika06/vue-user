<?php

use Illuminate\Database\Seeder;

class BantenprovUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(BantenprovUserSeederUser::class);
    }
}
