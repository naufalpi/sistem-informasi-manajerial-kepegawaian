<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       User::create([
            'name' => 'Naufal Akbar',
            'email' => 'naufal@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'Rido Setiawan',
            'email' => 'rido@gmail.com',
            'password' => bcrypt('123456')
        ]);


        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::create([
            'title' => 'Judul Pertama',
            'slug' => 'judul-pertama',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a. Alias, velit quam placeat blanditiis aut debitis numquam beatae. Porro dolor voluptas illum necessitatibus aspernatur veritatis quaerat, alias culpa in quibusdam. Accusamus molestiae maxime magnam perferendis dolorum iure voluptatum voluptate numquam, modi nemo possimus molestias dolorem, maiores minus earum quisquam, quae sequi cum consectetur. Aliquam distinctio facilis consequuntur delectus, itaque assumenda illo minus optio id necessitatibus quasi, magni fugiat quod. Sapiente nostrum, voluptatum esse sint ducimus doloremque dolores, et necessitatibus non illo adipisci repudiandae temporibus? Ea, sed molestiae sapiente dicta id doloremque, tenetur officia reprehenderit velit neque mollitia animi ipsa architecto ipsum soluta dolore tempora maiores, ut minima!',
            'category_id' => 1,
            'user_id' => 1
 
        ]);


        Post::create([
            'title' => 'Judul Kedua',
            'slug' => 'judul-kedua',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a. Alias, velit quam placeat blanditiis aut debitis numquam beatae. Porro dolor voluptas illum necessitatibus aspernatur veritatis quaerat, alias culpa in quibusdam. Accusamus molestiae maxime magnam perferendis dolorum iure voluptatum voluptate numquam, modi nemo possimus molestias dolorem, maiores minus earum quisquam, quae sequi cum consectetur. Aliquam distinctio facilis consequuntur delectus, itaque assumenda illo minus optio id necessitatibus quasi, magni fugiat quod. Sapiente nostrum, voluptatum esse sint ducimus doloremque dolores, et necessitatibus non illo adipisci repudiandae temporibus? Ea, sed molestiae sapiente dicta id doloremque, tenetur officia reprehenderit velit neque mollitia animi ipsa architecto ipsum soluta dolore tempora maiores, ut minima!',
            'category_id' => 1,
            'user_id' => 1

        ]);

        Post::create([
            'title' => 'Judul Ketiga',
            'slug' => 'judul-ketiga',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a. Alias, velit quam placeat blanditiis aut debitis numquam beatae. Porro dolor voluptas illum necessitatibus aspernatur veritatis quaerat, alias culpa in quibusdam. Accusamus molestiae maxime magnam perferendis dolorum iure voluptatum voluptate numquam, modi nemo possimus molestias dolorem, maiores minus earum quisquam, quae sequi cum consectetur. Aliquam distinctio facilis consequuntur delectus, itaque assumenda illo minus optio id necessitatibus quasi, magni fugiat quod. Sapiente nostrum, voluptatum esse sint ducimus doloremque dolores, et necessitatibus non illo adipisci repudiandae temporibus? Ea, sed molestiae sapiente dicta id doloremque, tenetur officia reprehenderit velit neque mollitia animi ipsa architecto ipsum soluta dolore tempora maiores, ut minima!',
            'category_id' => 2,
            'user_id' => 1

        ]);

        Post::create([
            'title' => 'Judul Keempat',
            'slug' => 'judul-keempat',
            'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a.',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit excepturi unde repudiandae eligendi neque tempore iusto, labore, dolorem aliquid minus voluptates a. Alias, velit quam placeat blanditiis aut debitis numquam beatae. Porro dolor voluptas illum necessitatibus aspernatur veritatis quaerat, alias culpa in quibusdam. Accusamus molestiae maxime magnam perferendis dolorum iure voluptatum voluptate numquam, modi nemo possimus molestias dolorem, maiores minus earum quisquam, quae sequi cum consectetur. Aliquam distinctio facilis consequuntur delectus, itaque assumenda illo minus optio id necessitatibus quasi, magni fugiat quod. Sapiente nostrum, voluptatum esse sint ducimus doloremque dolores, et necessitatibus non illo adipisci repudiandae temporibus? Ea, sed molestiae sapiente dicta id doloremque, tenetur officia reprehenderit velit neque mollitia animi ipsa architecto ipsum soluta dolore tempora maiores, ut minima!',
            'category_id' => 2,
            'user_id' => 2
 
        ]);



    }
}

