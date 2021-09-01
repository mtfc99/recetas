<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
        'name'=>'Martin Cosso',
        'email'=>'correo1@correo.com',
        'password'=>Hash::make('12345678'),
        'url'=>'',
        'age'=>'22',
           ]);
       DB::table('users')->insert([
        'name'=>'Luis Vazquez',
        'email'=>'correo2@correo.com',
        'password'=>Hash::make('12345678'),
        'url'=>'',
        'age'=>'22'
       ]);
    }
}
