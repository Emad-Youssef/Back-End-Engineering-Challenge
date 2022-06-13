<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\admin::create([
            'name' => 'youssef',
            'email' => 'admin@app.com',
            'type' => 'super_admin',
            'password' => bcrypt('123456'),
        ]);

        $user->attachRole('super_admin');
    }
}
