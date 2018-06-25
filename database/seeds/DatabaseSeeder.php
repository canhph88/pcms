<?php

use Illuminate\Database\Seeder;
use Modules\Author\Entities\Author;
use Modules\Book\Entities\Book;
use Modules\Genre\Entities\Genre;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //Seed the countries
        $this->call(CountriesSeeder::class);
        $this->command->info('Seeded the countries!');

        $this->createRoles();

        factory(App\User::class, 30)->create();
        // Populate books

        factory(Genre::class, 15)->create();

        // Populate books
        factory(Book::class, 100)->create();

        // Populate authors
        factory(Author::class, 15)->create();

        // Get all the roles attaching up to 3 random roles to each user
        $books = Book::all();

        // Populate the pivot table
        Author::all()->each(function ($author) use ($books) {
            $author->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Populate the pivot table
        Genre::all()->each(function ($genre) use ($books) {
            $genre->books()->attach(
                $books->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }

    public function createRoles() {

//        create roles
        $adminRole = new App\Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'Administrator'; // optional
        $adminRole->description  = 'User is the administrator'; // optional
        $adminRole->save();

        $contentRole = new App\Role();
        $contentRole->name         = 'content';
        $contentRole->display_name = 'Content Manager'; // optional
        $contentRole->description  = 'User is allowed to manage and edit books'; // optional
        $contentRole->save();

        $userRole = new App\Role();
        $userRole->name         = 'user';
        $userRole->display_name = 'CreateUserTable'; // optional
        $userRole->description  = 'User is allowed to view'; // optional
        $userRole->save();

//        create users
        $admin = new App\User();
        $admin->username = 'admin';
        $admin->name = 'admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($adminRole);

        $content = new App\User();
        $content->username = 'content';
        $content->name = 'Content Manager';
        $content->email = 'content@example.com';
        $content->password = bcrypt('password');
        $content->save();
        $content->roles()->attach($contentRole);

        $user = new App\User();
        $user->username = 'user';
        $user->name = 'Valid User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($userRole);

        $this->createPermissions();

        //apply permission to role
//        $adminRole->attachPermissions(array($createBook, $editBook, $deleteBook, $indexUser, $showUser, $createUser, $editUser, $deleteUser));
    }

    public function temp()
    {
        $role_admin = new App\Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Administrator User';
        $role_admin->save();
        $role_content = new App\Role();
        $role_content->name = 'content';
        $role_content->description = 'A Content Manager User';
        $role_content->save();
        $role_user = new App\Role();
        $role_user->name = 'user';
        $role_user->description = 'Valid User';
        $role_user->save();

        $role_admin = App\Role::where('name', 'admin')->first();
        $role_content  = App\Role::where('name', 'content')->first();
        $role_user  = App\Role::where('name', 'user')->first();

        $admin = new App\User();
        $admin->username = 'admin';
        $admin->name = 'admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $content = new App\User();
        $content->username = 'content';
        $content->name = 'Content Manager';
        $content->email = 'content@example.com';
        $content->password = bcrypt('password');
        $content->save();
        $content->roles()->attach($role_content);

        $user = new App\User();
        $user->username = 'CreateUserTable';
        $user->name = 'Valid User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($role_user);
    }

    /**
     * @return array
     */
    public function createPermissions()
    {
//        book permissions
        $indexBook = new App\Permission();
        $indexBook->name = 'book-index';
        $indexBook->display_name = 'Index Books'; // optional
        $indexBook->description = 'Index books'; // optional
        $indexBook->save();

        $showBook = new App\Permission();
        $showBook->name = 'book-show';
        $showBook->display_name = 'Show Books'; // optional
        $showBook->description = 'Show books'; // optional
        $showBook->save();

        $createBook = new App\Permission();
        $createBook->name = 'book-create';
        $createBook->display_name = 'Create Books'; // optional
        $createBook->description = 'create new books'; // optional
        $createBook->save();

        $editBook = new App\Permission();
        $editBook->name = 'book-edit';
        $editBook->display_name = 'Edit Books'; // optional
        $editBook->description = 'Edit existing books'; // optional
        $editBook->save();

        $deleteBook = new App\Permission();
        $deleteBook->name = 'book-delete';
        $deleteBook->display_name = 'Delete Books'; // optional
        $deleteBook->description = 'Delete books'; // optional
        $deleteBook->save();

//        author permissions
        $indexAuthor = new App\Permission();
        $indexAuthor->name = 'author-index';
        $indexAuthor->display_name = 'Index Authors'; // optional
        $indexAuthor->description = 'Index Authors'; // optional
        $indexAuthor->save();

        $showAuthor = new App\Permission();
        $showAuthor->name = 'author-show';
        $showAuthor->display_name = 'Show Authors'; // optional
        $showAuthor->description = 'Show Authors'; // optional
        $showAuthor->save();

        $createAuthor = new App\Permission();
        $createAuthor->name = 'author-create';
        $createAuthor->display_name = 'Create Authors'; // optional
        $createAuthor->description = 'create new authors'; // optional
        $createAuthor->save();

        $editAuthor = new App\Permission();
        $editAuthor->name = 'author-edit';
        $editAuthor->display_name = 'Edit authors'; // optional
        $editAuthor->description = 'Edit existing authors'; // optional
        $editAuthor->save();

        $deleteAuthor = new App\Permission();
        $deleteAuthor->name = 'author-delete';
        $deleteAuthor->display_name = 'Delete Authors'; // optional
        $deleteAuthor->description = 'Delete Authors'; // optional
        $deleteAuthor->save();

//        genre permissions
        $indexGenre = new App\Permission();
        $indexGenre->name = 'genre-index';
        $indexGenre->display_name = 'Index Genres'; // optional
        $indexGenre->description = 'Index Genres'; // optional
        $indexGenre->save();

        $showGenre = new App\Permission();
        $showGenre->name = 'genre-show';
        $showGenre->display_name = 'Show Genres'; // optional
        $showGenre->description = 'Show Genres'; // optional
        $showGenre->save();

        $createGenre = new App\Permission();
        $createGenre->name = 'genre-create';
        $createGenre->display_name = 'Create Genres'; // optional
        $createGenre->description = 'create new genres'; // optional
        $createGenre->save();

        $editGenre = new App\Permission();
        $editGenre->name = 'genre-edit';
        $editGenre->display_name = 'Edit genres'; // optional
        $editGenre->description = 'Edit existing genres'; // optional
        $editGenre->save();

        $deleteGenre = new App\Permission();
        $deleteGenre->name = 'genre-delete';
        $deleteGenre->display_name = 'Delete Genres'; // optional
        $deleteGenre->description = 'Delete Genres'; // optional
        $deleteGenre->save();

//        user permissions
        $indexUser = new App\Permission();
        $indexUser->name = 'user-index';
        $indexUser->display_name = 'Index Users'; // optional
        $indexUser->description = 'Index Users'; // optional
        $indexUser->save();

        $showUser = new App\Permission();
        $showUser->name = 'user-show';
        $showUser->display_name = 'Show Users'; // optional
        $showUser->description = 'Show Users'; // optional
        $showUser->save();

        $createUser = new App\Permission();
        $createUser->name = 'user-create';
        $createUser->display_name = 'Create Users'; // optional
        $createUser->description = 'create new users'; // optional
        $createUser->save();

        $editUser = new App\Permission();
        $editUser->name = 'user-edit';
        $editUser->display_name = 'Edit Books'; // optional
        $editUser->description = 'Edit existing books'; // optional
        $editUser->save();

        $deleteUser = new App\Permission();
        $deleteUser->name = 'user-delete';
        $deleteUser->display_name = 'Delete Books'; // optional
        $deleteUser->description = 'Delete books'; // optional
        $deleteUser->save();

        //role permissions
        $indexRole = new App\Permission();
        $indexRole->name = 'role-index';
        $indexRole->display_name = 'Index Roles'; // optional
        $indexRole->description = 'Index Roles'; // optional
        $indexRole->save();

        $showRole = new App\Permission();
        $showRole->name = 'role-show';
        $showRole->display_name = 'Show Roles'; // optional
        $showRole->description = 'Show Roles'; // optional
        $showRole->save();

        $createRole = new App\Permission();
        $createRole->name = 'role-create';
        $createRole->display_name = 'Create Roles'; // optional
        $createRole->description = 'create new Roles'; // optional
        $createRole->save();

        $editRole = new App\Permission();
        $editRole->name = 'role-edit';
        $editRole->display_name = 'Edit Roles'; // optional
        $editRole->description = 'Edit Existing Roles'; // optional
        $editRole->save();

        $deleteRole = new App\Permission();
        $deleteRole->name = 'role-delete';
        $deleteRole->display_name = 'Delete Roles'; // optional
        $deleteRole->description = 'Delete Roles'; // optional
        $deleteRole->save();

        $allRole = new App\Permission();
        $allRole->name = '*';
        $allRole->display_name = 'All Roles'; // optional
        $allRole->description = 'All Roles'; // optional
        $allRole->save();

        //assgign permissions to admin role
        $admin_Role = App\Role::where('name','admin')->first();
//        $admin_Role->attachPermission($allRole);
        $admin_Role->attachPermissions(array(
            $indexBook, $showBook, $createBook, $editBook, $deleteBook,
            $indexAuthor, $showAuthor, $createAuthor, $editAuthor, $deleteAuthor,
            $indexGenre, $showGenre, $createGenre, $editGenre, $deleteGenre,
            $indexUser, $showUser, $createUser, $editUser, $deleteUser,
            $indexRole, $showRole, $createRole, $editRole, $deleteRole,));

        //assgign permissions to content role
        $content_Role = App\Role::where('name','content')->first();
        $content_Role->attachPermissions(array(
            $indexBook, $showBook, $createBook, $editBook, $deleteBook,
            $indexAuthor, $showAuthor, $createAuthor, $editAuthor, $deleteAuthor,
            $indexGenre, $showGenre, $createGenre, $editGenre, $deleteGenre));

        //assgign permissions to user role
        $user_Role = App\Role::where('name','user')->first();
        $user_Role->attachPermissions(array(
            $indexBook, $showBook,
            $indexAuthor, $showAuthor,
            $indexGenre, $showGenre));
    }
}
