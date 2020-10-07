<?php
use App\Movie;
use Illuminate\Database\Seeder;

class MoviesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            "user_id" => 1,
            "nombre" => "Titanic 2",
            "description" => "as dasdasdasd ada",
            "year" => "2015",
           
        ]);
    }
}
