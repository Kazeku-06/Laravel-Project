<?php

namespace Database\Seeders;



// use Pest\Support\Str;
// use Psy\Util\Str;
// use Pest\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        // Users (termasuk kamu)
        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'firstname' => 'Rizqi',
                'lastname' => 'Anggara',
                'username' => 'rizqianggara',
                'email' => 'rizqi@example.com',
                'password' => Hash::make('12345678'),
                'isadmin' => true,
            ],
            [
                'id' => Str::uuid(),
                'firstname' => 'Ayu',
                'lastname' => 'Permata',
                'username' => 'ayupermata',
                'email' => 'ayu@example.com',
                'password' => bcrypt('password'),
                'isadmin' => false,
            ],
        ]);

        // Authors
        DB::table('authors')->insert([
            [
                'author_id' => Str::uuid(),
                'author_name' => 'Tere Liye',
                'author_description' => 'Penulis novel terkenal di Indonesia.',
            ],
            [
                'author_id' => Str::uuid(),
                'author_name' => 'Dewi Lestari',
                'author_description' => 'Penulis buku filosofi dan spiritualitas.',
            ],
        ]);

        // Publishers
        DB::table('publishers')->insert([
            [
                'publisher_id' => Str::uuid(),
                'publisher_name' => 'Gramedia',
                'publisher_description' => 'Penerbit buku terbesar di Indonesia.',
            ],
            [
                'publisher_id' => Str::uuid(),
                'publisher_name' => 'Erlangga',
                'publisher_description' => 'Penerbit buku pelajaran dan akademik.',
            ],
        ]);

        // Shelfs
        DB::table('shelfs')->insert([
            [
                'shelf_id' => Str::uuid(),
                'shelf_name' => 'Rak A',
                'shelf_position' => 'Lantai 1 - Sebelah Kanan',
            ],
            [
                'shelf_id' => Str::uuid(),
                'shelf_name' => 'Rak B',
                'shelf_position' => 'Lantai 2 - Sebelah Kiri',
            ],
        ]);

        // Categories
        DB::table('categories')->insert([
            [
                'category_id' => Str::uuid(),
                'category_name' => 'Fiksi',
                'category_description' => 'Buku-buku cerita dan novel.',
            ],
            [
                'category_id' => Str::uuid(),
                'category_name' => 'Teknologi',
                'category_description' => 'Buku komputer, pemrograman, dan sains.',
            ],
        ]);
    }
}


