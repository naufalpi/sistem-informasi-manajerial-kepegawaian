<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\Report;
use App\Models\Pendidikan;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'name' => 'Kepala Desa'
        ]);

        Jabatan::create([
            'name' => 'Sekretaris Desa'
        ]);

        Jabatan::create([
            'name' => 'Kasi Pemerintahan'
        ]);

        Jabatan::create([
            'name' => 'Kasi Kesejahteraan Rakyat'
        ]);

        Jabatan::create([
            'name' => 'Kasi Pelayanan'
        ]);

        Jabatan::create([
            'name' => 'Kaur Keuangan'
        ]);

        Jabatan::create([
            'name' => 'Kaur Perencanaan'
        ]);

        Jabatan::create([
            'name' => 'Kaur Tata Usaha & Umum'
        ]);

        Jabatan::create([
            'name' => 'Kadus 1'
        ]);

        Jabatan::create([
            'name' => 'Kadus 2'
        ]);

        Jabatan::create([
            'name' => 'Staff'
        ]);

        Pendidikan::create([
            'name' => 'SLTP'
        ]);

        Pendidikan::create([
            'name' => 'SLTA'
        ]);

        Pendidikan::create([
            'name' => 'S1'
        ]);

        Pendidikan::create([
            'name' => 'S2'
        ]);


        User::create([
            'jabatan_id' => mt_rand(1,11),
            'pendidikan_id' => mt_rand(1,4),
            'name' => 'Naufal Akbar',
            'username' => 'naufalpi',
            'nrp' => fake()->unique()->randomNumber(9, true),
            'tpt_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'alamat' => fake()->streetAddress(),
            'foto' => fake()->image(null, 640, 480),
            'email' => 'naufal@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345')
        ]);


        User::factory(11)->create();


        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
        
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        
        Report::factory(15)->create();

    }
}

