<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permission for karyawan features
        Permission::create(['name' => 'karyawans.create']);
        Permission::create(['name' => 'karyawans.read']);
        Permission::create(['name' => 'karyawans.update']);
        Permission::create(['name' => 'karyawans.delete']);

        // Permission for kelas features
        Permission::create(['name' => 'kelas.create']);
        Permission::create(['name' => 'kelas.read']);
        Permission::create(['name' => 'kelas.update']);
        Permission::create(['name' => 'kelas.delete']);

        // Permission for sub-kelas features
        Permission::create(['name' => 'sub-kelas.create']);
        Permission::create(['name' => 'sub-kelas.read']);
        Permission::create(['name' => 'sub-kelas.update']);
        Permission::create(['name' => 'sub-kelas.delete']);

        // Permission for kegiatans features
        Permission::create(['name' => 'kegiatans.create']);
        Permission::create(['name' => 'kegiatans.read']);
        Permission::create(['name' => 'kegiatans.update']);
        Permission::create(['name' => 'kegiatans.delete']);

        // Permission for jadwals features
        Permission::create(['name' => 'jadwals.create']);
        Permission::create(['name' => 'jadwals.read']);
        Permission::create(['name' => 'jadwals.update']);
        Permission::create(['name' => 'jadwals.delete']);

        // Permission for ruangs features
        Permission::create(['name' => 'ruangs.create']);
        Permission::create(['name' => 'ruangs.read']);
        Permission::create(['name' => 'ruangs.update']);
        Permission::create(['name' => 'ruangs.delete']);

        // Permission for diskons features
        Permission::create(['name' => 'diskons.create']);
        Permission::create(['name' => 'diskons.read']);
        Permission::create(['name' => 'diskons.update']);
        Permission::create(['name' => 'diskons.delete']);

        // Permission for partners features
        Permission::create(['name' => 'partners.create']);
        Permission::create(['name' => 'partners.read']);
        Permission::create(['name' => 'partners.update']);
        Permission::create(['name' => 'partners.delete']);

        // Permission for inventories features
        Permission::create(['name' => 'inventories.create']);
        Permission::create(['name' => 'inventories.read']);
        Permission::create(['name' => 'inventories.update']);
        Permission::create(['name' => 'inventories.delete']);

        // Permission for galleries features
        Permission::create(['name' => 'galleries.create']);
        Permission::create(['name' => 'galleries.read']);
        Permission::create(['name' => 'galleries.update']);
        Permission::create(['name' => 'galleries.delete']);

        // Permission for customers features
        Permission::create(['name' => 'customers.create']);
        Permission::create(['name' => 'customers.read']);
        Permission::create(['name' => 'customers.update']);
        Permission::create(['name' => 'customers.delete']);

        // Permission for merchandises features
        Permission::create(['name' => 'merchandises.create']);
        Permission::create(['name' => 'merchandises.read']);
        Permission::create(['name' => 'merchandises.update']);
        Permission::create(['name' => 'merchandises.delete']);

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $supervisor = Role::create(['name' => 'supervisor']);
        $administrasi = Role::create(['name' => 'administrasi']);
        $asisten_studio = Role::create(['name' => 'asisten-studio']);
        $teacher = Role::create(['name' => 'teacher']);
        $customer = Role::create(['name' => 'customer']);

        $supervisor->givePermissionTo('karyawans.create', 'karyawans.read', 'karyawans.update', 'karyawans.delete');
        $supervisor->givePermissionTo('kelas.create', 'kelas.read', 'kelas.update', 'kelas.delete');
        $supervisor->givePermissionTo('sub-kelas.create', 'sub-kelas.read', 'sub-kelas.update', 'sub-kelas.delete');
        $supervisor->givePermissionTo('kegiatans.create', 'kegiatans.read', 'kegiatans.update', 'kegiatans.delete');
        $supervisor->givePermissionTo('ruangs.create', 'ruangs.read', 'ruangs.update', 'ruangs.delete');
        $supervisor->givePermissionTo('jadwals.create', 'jadwals.read', 'jadwals.update', 'jadwals.delete');
        $supervisor->givePermissionTo('diskons.create', 'diskons.read', 'diskons.update', 'diskons.delete');
        $supervisor->givePermissionTo('partners.create', 'partners.read', 'partners.update', 'partners.delete');

        $administrasi->givePermissionTo('inventories.create', 'inventories.read', 'inventories.update', 'inventories.delete');
        $administrasi->givePermissionTo('galleries.create', 'galleries.read', 'galleries.update', 'galleries.delete');
        $administrasi->givePermissionTo('customers.create', 'customers.read', 'customers.update', 'customers.delete');
        $administrasi->givePermissionTo('merchandises.create', 'merchandises.read', 'merchandises.update', 'merchandises.delete');
    }
}
