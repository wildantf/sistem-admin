<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class PostSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $data = [
                'title' => $faker->sentence(rand(1, 5)),
                'slug' => $faker->slug(rand(1, 5)),
                'body' => $faker->paragraph(rand(5, 10)),
                'created_at' => Time::now(),
                'updated_at' => Time::now(),
            ];
            $this->db->table('posts')->insert($data);
        }

        // $this->db->query(
        //     "INSERT INTO posts (title, slug, body, created_at, updated_at) VALUES(:title:, :slug:, :body: ,:created_at:, :updated_at:)",
        //     $data
        // );

    }
}
