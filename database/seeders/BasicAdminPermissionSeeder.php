<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class BasicAdminPermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',

            // Admin
            'Admin list',
            'Admin create',
            'Admin edit',
            'Admin delete',

            // Kabupaten
            'KAB list',
            'KAB create',
            'KAB edit',
            'KAB delete',

            //Kecamatan
            'KEC list',
            'KEC create',
            'KEC edit',
            'KEC delete',

            // Kelurahan
            'KEL list',
            'KEL create',
            'KEL edit',
            'KEL delete',

            // Desa
            'DESA list',
            'DESA create',
            'DESA edit',
            'DESA delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign existing permissions

        // Role 2
        // $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        // create demo users
        // $user = \App\Models\User::create([
        //     'name' => 'Admin',
        //     'username'=> 'wawan',
        //     'email' => 'superadmin@laraveltuts.com',
        //     'password'=> bcrypt('12345678'),
        // ]);
        // $user->assignRole($role3);

        // Admin
        $admin = Role::create(['name'=> 'Admin']);
        $admin->givePermissionTo('Admin list');
        $admin->givePermissionTo('Admin create');
        $admin->givePermissionTo('Admin edit');
        $admin->givePermissionTo('Admin delete');
        $admin_user = User::create(array(
            "name" => "Admin",
            "username" => "admin000",
            "email" => "admin@gmail.com",
            "password"=> bcrypt('12345678'),
        ));
        $admin_user->assignRole($admin);

        // Kabupaten
        // $KAB = Role::create(['name'=> 'KAB']);
        // $KAB->givePermissionTo('KAB list');
        // $KAB->givePermissionTo('KAB create');
        // $KAB->givePermissionTo('KAB edit');
        // $KAB->givePermissionTo('KAB delete');
        // $kab_user = User::insert(array(
        //     "name" => "korcabSoppeng",
        //     "username" => "korcabSoppeng",
        //     "email" => "korcabSoppeng@gmail.com",
        //     "email_verified_at" => NULL,
        //     "password"=> bcrypt('12345678'),
        //     "remember_token" => NULL,
        //     "created_at" => "2023-03-07 21:56:00",
        //     "updated_at" => "2023-03-07 21:56:00",
        // ));
        // $kab_user->assignRole($KAB);


        // Kecamatan
        // $KEC = Role::create(['name'=> 'KEC']);
        // $KEC->givePermissionTo('KEC list');
        // $KEC->givePermissionTo('KEC create');
        // $KEC->givePermissionTo('KEC edit');
        // $KEC->givePermissionTo('KEC delete');
        // $kec_user = User::create(array(
        //     "name" => "kecamatan",
        //     "username" => "kecamatan",
        //     "email" => "kecamatan@gmail.com",
        //     "email_verified_at" => NULL,
        //     "password"=> bcrypt('12345678'),
        //     "remember_token" => NULL,
        //     "created_at" => "2023-03-07 21:56:26",
        //     "updated_at" => "2023-03-07 21:56:26",
        // ));
        // $kec_user->assignRole($KEC);


        // Kelurahan
        // $KEL = Role::create(['name'=> 'KEL']);
        // $KEL->givePermissionTo('KEL list');
        // $KEL->givePermissionTo('KEL create');
        // $KEL->givePermissionTo('KEL edit');
        // $KEL->givePermissionTo('KEL delete');
        // $kel_user = User::create(array(
        //     "name" => "Kelurahan",
        //     "username" => "kelurahan",
        //     "email" => "kelurahan@gmail.com",
        //     "email_verified_at" => NULL,
        //     "password"=> bcrypt('12345678'),
        //     "remember_token" => NULL,
        //     "created_at" => "2023-03-07 21:57:00",
        //     "updated_at" => "2023-03-07 21:57:00",
        // ));
        // $kel_user->assignRole($KEL);

        // DESA
        $DESA = Role::create(['name'=> 'DESA']);
        $DESA->givePermissionTo('DESA list');
        $DESA->givePermissionTo('DESA create');
        $DESA->givePermissionTo('DESA edit');
        $DESA->givePermissionTo('DESA delete');
        $desa_user = User::create(array(
            "name" => "Desa",
            "username" => "Desa",
            "email" => "Desa@gmail.com",
            "email_verified_at" => NULL,
            "password"=> bcrypt('12345678'),
            "remember_token" => NULL,
            "created_at" => "2023-03-07 21:57:19",
            "updated_at" => "2023-03-07 21:57:19",
        ));
        $desa_user->assignRole($DESA);


    }
}
