<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Report;
use App\Models\Jabatan;
use App\Models\Category;
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
        // Jabatan::create([
        //     'name' => 'Kepala Desa'
        // ]);

        // Jabatan::create([
        //     'name' => 'Sekretaris Desa'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kasi Pemerintahan'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kasi Kesejahteraan Rakyat'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kasi Pelayanan'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kaur Keuangan'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kaur Perencanaan'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kaur Tata Usaha & Umum'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kadus 1'
        // ]);

        // Jabatan::create([
        //     'name' => 'Kadus 2'
        // ]);

        // Jabatan::create([
        //     'name' => 'Staff'
        // ]);

        // Pendidikan::create([
        //     'name' => 'SLTP'
        // ]);

        // Pendidikan::create([
        //     'name' => 'SLTA'
        // ]);

        // Pendidikan::create([
        //     'name' => 'S1'
        // ]);

        // Pendidikan::create([
        //     'name' => 'S2'
        // ]);


        User::create([
            'jabatan_id' => '1',
            'pendidikan_id' => '3',
            'name' => 'Naufal Akbar',
            'username' => 'naufalpi',
            'nrp' => fake()->unique()->randomNumber(9, true),
            'tpt_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'alamat' => fake()->streetAddress(),
            'email' => 'naufal@gmail.com',
            'no_hp' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345')
        ]);

        User::create([
            'jabatan_id' => '2',
            'pendidikan_id' =>'3',
            'name' => 'Annisa Nabila',
            'username' => 'anisana',
            'nrp' => fake()->unique()->randomNumber(9, true),
            'tpt_lahir' => fake()->city(),
            'tgl_lahir' => fake()->date(),
            'alamat' => fake()->streetAddress(),
            'email' => 'anisa@gmail.com',
            'no_hp' => fake()->phoneNumber(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345')
        ]);

        


        User::factory(9)->create();


        
        // Report::factory(15)->create();

        // Cuti::create([
        //     'user_id' => '1',
        //     'tgl_mulai' => fake()->date(),
        //     'tgl_selesai' => fake()->date(),
        //     'jenis_cuti' => 'Sakit',
        //     'alasan' => fake()->paragraph()
        // ]);
        // Cuti::create([
        //     'user_id' => '2',
        //     'tgl_mulai' => fake()->date(),
        //     'tgl_selesai' => fake()->date(),
        //     'jenis_cuti' => 'Sakit',
        //     'alasan' => fake()->paragraph()
        // ]);
        // Cuti::create([
        //     'user_id' => '1',
        //     'tgl_mulai' => fake()->date(),
        //     'tgl_selesai' => fake()->date(),
        //     'jenis_cuti' => 'Cuti Tahunan',
        //     'alasan' => fake()->paragraph()
        // ]);
        // Cuti::create([
        //     'user_id' => '5',
        //     'tgl_mulai' => fake()->date(),
        //     'tgl_selesai' => fake()->date(),
        //     'jenis_cuti' => 'Melahirkan',
        //     'alasan' => fake()->paragraph()
        // ]);


      

    }
}

