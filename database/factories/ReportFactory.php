<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['Selesai', 'Sedang berlangsung', 'Tertunda'];
        return [
            'kegiatan' => fake()->sentence(mt_rand(2,5)),
            'slug' => fake()->slug(),
            'tanggal' => fake()->date(),
            'keterangan' => fake()->paragraph(mt_rand(3,7)),
            'user_id' => mt_rand(1,3),
            'durasi' => fake()->time(),
            'status' => fake()->randomElement($status),
            'lokasi' => fake()->streetName()
        ];
    }
}
