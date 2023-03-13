<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Relawan;
use App\Models\KelurahanDesa;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $kelurahan_desas = array(
            array(
                "id" => 1,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "GATTARENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 2,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "MARIO RIAJA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 3,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "WATU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 4,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "MARIO RITTENGNGA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 5,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "GOARIE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 6,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "BARAE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 7,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "MARIO RILAU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 8,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "TETTIKENGRARAE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 9,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "LABESSI",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 10,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "CONGKO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 11,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "WATUTOA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 12,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "GATTARENG TOA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 13,
                "kecamatan" => "MARIO RIWAWO",
                "nama" => "SOGA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 14,
                "kecamatan" => "LALABATA",
                "nama" => "UMPUNGENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 15,
                "kecamatan" => "LALABATA",
                "nama" => "LALABATA RILAU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 16,
                "kecamatan" => "LALABATA",
                "nama" => "BOTTO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 17,
                "kecamatan" => "LALABATA",
                "nama" => "LEMBA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 18,
                "kecamatan" => "LALABATA",
                "nama" => "BILA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 19,
                "kecamatan" => "LALABATA",
                "nama" => "MATTABULU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 20,
                "kecamatan" => "LALABATA",
                "nama" => "OMPO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 21,
                "kecamatan" => "LALABATA",
                "nama" => "LAPAJUNG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 22,
                "kecamatan" => "LALABATA",
                "nama" => "MACCILE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 23,
                "kecamatan" => "LALABATA",
                "nama" => "SALO KARAJA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 24,
                "kecamatan" => "LILI RIAJA",
                "nama" => "TIMUSU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 25,
                "kecamatan" => "LILI RIAJA",
                "nama" => "ROMPEGADING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 26,
                "kecamatan" => "LILI RIAJA",
                "nama" => "PATTOJO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 27,
                "kecamatan" => "LILI RIAJA",
                "nama" => "GALUNG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 28,
                "kecamatan" => "LILI RIAJA",
                "nama" => "JENNAE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 29,
                "kecamatan" => "LILI RIAJA",
                "nama" => "JAMPU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 30,
                "kecamatan" => "LILI RIAJA",
                "nama" => "BARANG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 31,
                "kecamatan" => "LILI RIAJA",
                "nama" => "APPANANG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 32,
                "kecamatan" => "GANRA",
                "nama" => "BELO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 33,
                "kecamatan" => "GANRA",
                "nama" => "GANRA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 34,
                "kecamatan" => "GANRA",
                "nama" => "ENREKENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 35,
                "kecamatan" => "GANRA",
                "nama" => "LOMPULLE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 36,
                "kecamatan" => "CITTA",
                "nama" => "KAMPIRI",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 37,
                "kecamatan" => "CITTA",
                "nama" => "CITTA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 38,
                "kecamatan" => "CITTA",
                "nama" => "LABAE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 39,
                "kecamatan" => "CITTA",
                "nama" => "TINCO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 40,
                "kecamatan" => "LILI RILAU",
                "nama" => "PAJALESANG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 41,
                "kecamatan" => "LILI RILAU",
                "nama" => "CABENGE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 42,
                "kecamatan" => "LILI RILAU",
                "nama" => "PAROTO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 43,
                "kecamatan" => "LILI RILAU",
                "nama" => "PALANGISENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 44,
                "kecamatan" => "LILI RILAU",
                "nama" => "TETEWATU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 45,
                "kecamatan" => "LILI RILAU",
                "nama" => "ABBANUANGE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 46,
                "kecamatan" => "LILI RILAU",
                "nama" => "PARENRING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 47,
                "kecamatan" => "LILI RILAU",
                "nama" => "UJUNG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 48,
                "kecamatan" => "LILI RILAU",
                "nama" => "MASING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 49,
                "kecamatan" => "LILI RILAU",
                "nama" => "BARINGENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 50,
                "kecamatan" => "LILI RILAU",
                "nama" => "KEBO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 51,
                "kecamatan" => "LILI RILAU",
                "nama" => "MACANRE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 52,
                "kecamatan" => "DONRI DONRI",
                "nama" => "PESSE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 53,
                "kecamatan" => "DONRI DONRI",
                "nama" => "PISING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 54,
                "kecamatan" => "DONRI DONRI",
                "nama" => "LABOKONG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 55,
                "kecamatan" => "DONRI DONRI",
                "nama" => "DONRI-DONRI",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 56,
                "kecamatan" => "DONRI DONRI",
                "nama" => "SERING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 57,
                "kecamatan" => "DONRI DONRI",
                "nama" => "LALABATA RIAJA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 58,
                "kecamatan" => "DONRI DONRI",
                "nama" => "TOTTONG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 59,
                "kecamatan" => "DONRI DONRI",
                "nama" => "LEWORENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 60,
                "kecamatan" => "DONRI DONRI",
                "nama" => "KESSING",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 61,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "PATAMPANUA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 62,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "PANINCONG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 63,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "TELLULIMPOE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 64,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "ATTANG SALO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 65,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "KACA",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 66,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "LIMPOMAJANG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 67,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "BATU-BATU",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 68,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "MANORANG SALO",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 69,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "LARINGGI",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 70,
                "kecamatan" => "MARIO RIAWA",
                "nama" => "BULUE",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
        );

        KelurahanDesa::insert($kelurahan_desas);
        // $KEL = Role::create(['name'=> 'KEL']);
        // $KEL->givePermissionTo('KEL list');
        // $KEL->givePermissionTo('KEL create');
        // $KEL->givePermissionTo('KEL edit');
        // $KEL->givePermissionTo('KEL delete');
        // for ($i=0; $i < count($kelurahan_desas); $i++) {
        //     $kel_user = User::create(array(
        //         "name" => "kel_".$kelurahan_desas[$i]['nama'],
        //         "username" => "user". fake()->unique()->randomNumber(),
        //         "email" => "kelurahan". $i ."@gmail.com",
        //         "email_verified_at" => NULL,
        //         "password"=> bcrypt('12345678'),
        //         "lokasi"=> $kelurahan_desas[$i]['nama'],
        //         "jabatan"=> "Relawan",
        //         "remember_token" => NULL,
        //         "created_at" => "2023-03-07 21:57:00",
        //         "updated_at" => "2023-03-07 21:57:00",
        //     ));
        //     $kel_user->assignRole($KEL);
        //     Relawan::create([
        //         'nama'=> fake()->name(),
        //         'no_hp'=> fake()->phoneNumber(),
        //         'alamat'=> fake()->address(),
        //         'user_id'=> $kel_user->id,
        //     ]);
        // }
    }
}
