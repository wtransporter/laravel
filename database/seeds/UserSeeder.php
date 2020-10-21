<?php

use App\Post;
use App\Role;
use App\User;
use App\Ability;
use App\Category;
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

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->assignRole('moderator');

        factory(Category::class, 4)->create()->each(function ($category) use ($admin) {
            factory(Post::class, 3)->create(['user_id' => $admin->id])
                ->each(function ($post) use ($category) {
                    $post->categories()->sync($category);
                });
        });

        $member = User::create([
            'name' => 'Member',
            'email' => 'member@test.com',
            'password' => Hash::make('12345678')
        ]);
        
        Category::all()->each(function ($category) use ($member) {
            factory(Post::class, 3)->create(['user_id' => $member->id])
                ->each(function ($post) use ($category) {
                    $post->categories()->sync($category);
                });
        });

    }
}
