<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gcu.edu.pk',
            'password' => bcrypt('admin'),
            'role' => 'super'
        ]);
        
        App\Profile::create([
            'about' => 'Iam the first admin',
            'avatar' => 'uploads/avatars/admin.jpg',
            'user_id' => $admin->id
        ]);
    }
}
