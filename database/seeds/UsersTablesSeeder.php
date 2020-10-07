<?php
use App\User;
use Illuminate\Database\Seeder;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "first_name" => "Armando",
            "last_name" => "Aliaga Saldaña",
            "birth_date" => "1987-01-12",
            "email" => "armank_17@hotmail.com",
            "password" => bcrypt("armandoaAliaga@"),
        ]);
    }
}
