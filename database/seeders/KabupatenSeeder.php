<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\DataSurvey;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $kabupatens = array(
            array(
                "nama" => "KABUPATEN SOPPENG",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
        );
        Kabupaten::insert($kabupatens);
        $KAB = Role::create(['name' => 'KAB']);
        $KAB->givePermissionTo('KAB list');
        $KAB->givePermissionTo('KAB create');
        $KAB->givePermissionTo('KAB edit');
        $KAB->givePermissionTo('KAB delete');
        $kab_user = User::create(array(
            "name" => "korcabSoppeng",
            "username" => "korcabSoppeng",
            "email" => "korcabSoppeng@gmail.com",
            "email_verified_at" => NULL,
            "password" => bcrypt('12345678'),
            "lokasi" => "KABUPATEN SOPPENG",
            "jabatan" => "KorKab",
            "remember_token" => NULL,
            "created_at" => "2023-03-07 21:56:00",
            "updated_at" => "2023-03-07 21:56:00",
        ));
        $kab_user->assignRole($KAB);
    }
}
