<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArsipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $kode_klasifikasi = fake()->numberBetween(600, 699);
        $tahun = fake()->numberBetween(1997, 2020);
        $no = fake()->numberBetween(1, 999);
        $no_arsip = "" . $kode_klasifikasi . "/" . $no . "/" . $tahun;
        return [
            'kode_klasifikasi' => $kode_klasifikasi,
            'jenis_arsip' => 'IMB',
            'deskripsi' => fake()->sentence(3) . "NO. ARSIP: " . $no_arsip,
            'tahun' => $tahun,
            'tingkat_perkembangan' => 'Pembuatan',
            'jumlah' => fake()->numberBetween(1, 10),
            'keterangan' => fake()->sentence(3),
            'lokasi_depot' => fake()->numberBetween(1, 3),
            'lokasi_rak' => fake()->numberBetween(1, 3),
            'no_box' => fake()->numberBetween(1000, 5000),
            'no_folder' => fake()->numberBetween(1000, 5000),
        ];
    }
}
