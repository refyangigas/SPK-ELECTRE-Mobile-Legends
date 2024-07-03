<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alternatif;
use App\Models\BobotKriteria;
use App\Models\DetailAlternatif;
use App\Models\GameplayType;
use App\Models\Kriteria;
use App\Models\Role;
use App\Models\Subkriteria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Admin', 'Pengguna'
        ];

        foreach ($data as $value) {
            Role::insert([
                'nama_role' => $value
            ]);
        }

        User::factory()->create([
            'username'          => 'Admin',
            'password'          => Hash::make('admin'),
            'id_role'          => 1,
        ]);

        User::factory()->create([
            'username'          => 'User',
            'password'          => Hash::make('user'),
            'id_role'          => 2,
        ]);

        $types = ['Team Fight', 'Pick Off', 'Split Push'];
        foreach ($types as $type) {
            GameplayType::create([
                'nama' => $type
            ]);
        }

        $kriteria = [
            ['nama' => 'Durability', 'keterangan' => 'Daya Tahan'],
            ['nama' => 'Offense', 'keterangan' => 'Kekuatan Serangan'],
            ['nama' => 'Control Effect', 'keterangan' => 'Efek Penghenti Gerakan'],
            ['nama' => 'Movement Speed', 'keterangan' => 'Kecepatan Rotasi'],
        ];

        foreach ($kriteria as $k) {
            Kriteria::create([
                'nama' => $k['nama'],
                'keterangan' => $k['keterangan']
            ]);
        }

        $bobotKriteriaData = [
            [1, 1, 4], [2, 1, 4], [3, 1, 4], [4, 1, 2],
            [1, 2, 3], [2, 2, 6], [3, 2, 5], [4, 2, 4],
            [1, 3, 4], [2, 3, 6], [3, 3, 3], [4, 3, 5],
        ];

        foreach ($bobotKriteriaData as $bobot) {
            $id_kriteria = $bobot[0];
            $id_gameplay = $bobot[1];
            $bobot = $bobot[2];

            BobotKriteria::create([
                'id_kriteria' => $id_kriteria,
                'id_gameplay' => $id_gameplay,
                'bobot' => $bobot,
            ]);
        }

        $kriteriaData = [
            1 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            2 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            3 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            4 => [
                ['subkriteria' => 'Sangat lambat Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat lambat', 'nilai' => 2],
                ['subkriteria' => 'Lambat', 'nilai' => 3],
                ['subkriteria' => 'Cukup lambat', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup cepat', 'nilai' => 6],
                ['subkriteria' => 'Cepat', 'nilai' => 7],
                ['subkriteria' => 'Sangat cepat', 'nilai' => 8],
                ['subkriteria' => 'Sangat cepat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat cepat Sekali', 'nilai' => 10],
            ]
        ];

        foreach ($kriteriaData as $kriteriaId => $subkriterias) {
            foreach ($subkriterias as $subkriteria) {
                Subkriteria::create([
                    'id_kriteria' => $kriteriaId,
                    'subkriteria' => $subkriteria['subkriteria'],
                    'nilai' => $subkriteria['nilai']
                ]);
            }
        }

        $alternatifData = [
            ['nama' => 'Claude', 'foto' => '', 'role' => 'Marksman', 'laning' => 'Gold Lane'],
            ['nama' => 'Melissa', 'foto' => '', 'role' => 'Marksman', 'laning' => 'Gold Lane'],
            ['nama' => 'Brody', 'foto' => '', 'role' => 'Marksman', 'laning' => 'Gold Lane'],
            ['nama' => 'Beatrix', 'foto' => '', 'role' => 'Marksman', 'laning' => 'Gold Lane'],
            ['nama' => 'Popol And Kupa', 'foto' => '', 'role' => 'Marksman', 'laning' => 'Gold Lane'],
            ['nama' => 'Valentina', 'foto' => '', 'role' => 'Mage', 'laning' => 'Mid Lane'],
            ['nama' => 'Faramis', 'foto' => '', 'role' => 'Mage', 'laning' => 'Mid Lane'],
            ['nama' => 'Pharsa', 'foto' => '', 'role' => 'Mage', 'laning' => 'Mid Lane'],
            ['nama' => 'Kadita', 'foto' => '', 'role' => 'Mage', 'laning' => 'Mid Lane'],
            ['nama' => 'Novaria', 'foto' => '', 'role' => 'Mage', 'laning' => 'Mid Lane'],
            ['nama' => 'Terizla', 'foto' => '', 'role' => 'Fighter', 'laning' => 'EXP Lane'],
            ['nama' => 'Yu Zhong', 'foto' => '', 'role' => 'Fighter', 'laning' => 'EXP Lane'],
            ['nama' => 'Lapu - Lapu', 'foto' => '', 'role' => 'Fighter', 'laning' => 'EXP Lane'],
            ['nama' => 'Paquito', 'foto' => '', 'role' => 'Fighter', 'laning' => 'EXP Lane'],
            ['nama' => 'Masha', 'foto' => '', 'role' => 'Fighter', 'laning' => 'EXP Lane'],
            ['nama' => 'Khufra', 'foto' => '', 'role' => 'Tank', 'laning' => 'Roam'],
            ['nama' => 'Mathilda', 'foto' => '', 'role' => 'Support', 'laning' => 'Roam'],
            ['nama' => 'Minotaur', 'foto' => '', 'role' => 'Tank', 'laning' => 'Roam'],
            ['nama' => 'Diggie', 'foto' => '', 'role' => 'Support', 'laning' => 'Roam'],
            ['nama' => 'Grock', 'foto' => '', 'role' => 'Tank', 'laning' => 'Roam'],
            ['nama' => 'Fanny', 'foto' => '', 'role' => 'Assassin', 'laning' => 'Jungle'],
            ['nama' => 'Barats', 'foto' => '', 'role' => 'Tank', 'laning' => 'Jungle'],
            ['nama' => 'Lancelot', 'foto' => '', 'role' => 'Assassin', 'laning' => 'Jungle'],
            ['nama' => 'Nolan', 'foto' => '', 'role' => 'Assassin', 'laning' => 'Jungle'],
            ['nama' => 'Ling', 'foto' => '', 'role' => 'Assassin', 'laning' => 'Jungle'],
        ];

        foreach ($alternatifData as $a) {
            Alternatif::create([
                'id_users' => 1,
                'nama' => $a['nama'],
                'foto' => $a['foto'],
                'role' => $a['role'],
                'laning' => $a['laning']
            ]);
        }

        $detailAlternatifData = [
            [1, 1, 3], [1, 2, 16], [1, 3, 21], [1, 4, 31],
            [2, 1, 2], [2, 2, 19], [2, 3, 24], [2, 4, 33],
            [3, 1, 4], [3, 2, 17], [3, 3, 25], [3, 4, 35],
            [4, 1, 3], [4, 2, 18], [4, 3, 21], [4, 4, 35],
            [5, 1, 3], [5, 2, 15], [5, 3, 27], [5, 4, 34],
            [6, 1, 5], [6, 2, 19], [6, 3, 28], [6, 4, 31],
            [7, 1, 4], [7, 2, 16], [7, 3, 21], [7, 4, 35],
            [8, 1, 2], [8, 2, 19], [8, 3, 25], [8, 4, 31],
            [9, 1, 4], [9, 2, 18], [9, 3, 28], [9, 4, 31],
            [10, 1, 3], [10, 2, 19], [10, 3, 23], [10, 4, 31],
            [11, 1, 9], [11, 2, 13], [11, 3, 30], [11, 4, 38],
            [12, 1, 7], [12, 2, 14], [12, 3, 27], [12, 4, 35],
            [13, 1, 8], [13, 2, 14], [13, 3, 24], [13, 4, 37],
            [14, 1, 6], [14, 2, 15], [14, 3, 24], [14, 4, 37],
            [15, 1, 5], [15, 2, 17], [15, 3, 23], [15, 4, 34],
            [16, 1, 9], [16, 2, 12], [16, 3, 30], [16, 4, 38],
            [17, 1, 8], [17, 2, 12], [17, 3, 24], [17, 4, 34],
            [18, 1, 10], [18, 2, 11], [18, 3, 28], [18, 4, 37],
            [19, 1, 4], [19, 2, 14], [19, 3, 22], [19, 4, 34],
            [20, 1, 9], [20, 2, 14], [20, 3, 28], [20, 4, 37],
            [21, 1, 6], [21, 2, 17], [21, 3, 21], [21, 4, 39],
            [22, 1, 10], [22, 2, 13], [22, 3, 29], [22, 4, 40],
            [23, 1, 4], [23, 2, 15], [23, 3, 21], [23, 4, 37],
            [24, 1, 3], [24, 2, 16], [24, 3, 22], [24, 4, 37],
            [25, 1, 5], [25, 2, 16], [25, 3, 23], [25, 4, 37],
        ];

        foreach ($detailAlternatifData as $detail) {
            $id_alternatif = $detail[0];
            $id_kriteria = $detail[1];
            $id_subkriteria = $detail[2];

            DetailAlternatif::create([
                'id_alternatif' => $id_alternatif,
                'id_kriteria' => $id_kriteria,
                'id_subkriteria' => $id_subkriteria,
            ]);
        }
    }
}