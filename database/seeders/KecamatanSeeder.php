<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $kecamatans = array(
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "MARIO RIWAWO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "LALABATA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "LILI RIAJA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "GANRA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "CITTA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "LILI RILAU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "DONRI DONRI",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "kabupaten" => "KABUPATEN SOPPENG",
                "nama" => "MARIO RIAWA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
        );

        Kecamatan::insert($kecamatans);
        $KEC = Role::create(['name' => 'KEC']);
        $KEC->givePermissionTo('KEC list');
        $KEC->givePermissionTo('KEC create');
        $KEC->givePermissionTo('KEC edit');
        $KEC->givePermissionTo('KEC delete');
        for ($i = 0; $i < count($kecamatans); $i++) {
            $kec_user = User::create(array(
                "name" => "kec_".$kecamatans[$i]['nama'],
                "username" => "user". fake()->unique()->randomNumber(),
                "email" => "kecamatan". $i ."@gmail.com",
                "email_verified_at" => NULL,
                "password" => bcrypt('12345678'),
                "lokasi"=> $kecamatans[$i]['nama'],
                "jabatan"=> "Korcab",
                "remember_token" => NULL,
                "created_at" => "2023-03-07 21:56:26",
                "updated_at" => "2023-03-07 21:56:26",
            ));
            $kec_user->assignRole($KEC);
        }
    }
}
