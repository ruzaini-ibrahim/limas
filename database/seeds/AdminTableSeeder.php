<?php

use Illuminate\Database\Seeder;

use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$password = 'P@ssw0rd';

        $data = [
        	'name' => 'SuperAdmin',
        	'email' => 'superadmin@limas.com.my',
        	'password' => Hash::make($password),
            'is_super' => true,
        ];

        Admin::create($data);
    }
}
