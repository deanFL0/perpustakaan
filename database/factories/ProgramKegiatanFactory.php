<?php

namespace Database\Factories;
use App\Models\ProgramKegiatan;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramKegiatan>
 */
class ProgramKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ProgramKegiatan::class;

    public function definition(): array
    {
        return [
            'nama_program' => $this->faker->name,
            'status' => $this->faker->name,
            'tanggal_mulai' => $this->faker->date,
            'tanggal_selesai' => $this->faker->date,
        ];
    }
}
