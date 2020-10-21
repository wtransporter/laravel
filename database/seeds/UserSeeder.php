<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('abilities')->delete();
        DB::table('roles')->delete();

        $edit = Ability::create(['name' => 'edit_ticket', 'label' => 'Edit ticket']);
        $view = Ability::create(['name' => 'view_dashboard', 'label' => 'View Dashboard']);
        Ability::create(['name' => 'delete_ticket', 'label' => 'Delete ticket']);

        $role = Role::create(['name' => 'moderator', 'label' => 'Moderator']);
        $role->allowTo($edit->name);
        $role->allowTo($view->name);

        Role::create(['name' => 'editor', 'label' => 'Editor']);

        DB::table('users')->delete();

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678')
        ]);

        $user->assignRole('admin');

        User::create([
            'name' => 'Member',
            'email' => 'member@test.com',
            'password' => Hash::make('12345678')
        ]);
        
    }
}
