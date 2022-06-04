<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $developer = Role::where('name', 'admin')->first();
        $user1 = new User();
        $user1->name = 'Jhon Tawner';
        $user1->email = 'admin@admin';
        $user1->password = bcrypt('12345678');
        $user1->save();
        $user1->roles()->attach($developer);
    }
}
