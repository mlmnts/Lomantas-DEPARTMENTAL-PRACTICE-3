<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Bookstore Administrator',
            'username' => 'bookadmin',
            'email' => 'admin@bookstore.test',
            'password' => Hash::make('Admin@12345'),
            'is_admin' => true,
        ]);

        // 8 Filipino books: all 4 categories, both availability statuses
        $books = [
            ['Noli Me Tangere', 'José Rizal', 'Fiction', 350.00,
                'Rizal\'s classic novel about Crisostomo Ibarra, who returns from Europe and faces abuse and corruption under Spanish colonial rule.', 'Available'],
            ["Dekada '70", 'Lualhati Bautista', 'Fiction', 325.00,
                'A novel about a Filipino mother and her family during the martial law years of the 1970s.', 'Unavailable'],

            ['Rizal Without the Overcoat', 'Ambeth R. Ocampo', 'Nonfiction', 399.00,
                'A collection of essays that looks at the life of José Rizal in a lively and human way.', 'Available'],
            ['Memories of Philippine Kitchens', 'Amy Besa and Romy Dorotan', 'Nonfiction', 1250.00,
                'Stories and recipes about Filipino food and the families who cook it.', 'Unavailable'],

            ['History of the Filipino People', 'Teodoro A. Agoncillo', 'Academic', 899.00,
                'A widely used college textbook on Philippine history from early times to the modern era.', 'Available'],
            ['The Philippines: A Past Revisited', 'Renato Constantino', 'Academic', 750.00,
                'A history of the Philippines written from a Filipino point of view.', 'Unavailable'],

            ['Ang Alamat ng Pinya', 'Traditional Filipino folktale (retold)', "Children's Books", 150.00,
                'A folktale that explains how the pineapple got its many eyes.', 'Available'],
            ['Si Pagong at si Matsing', 'Traditional Filipino fable (retold)', "Children's Books", 150.00,
                'The classic fable about a turtle and a monkey who plant a banana tree.', 'Unavailable'],
        ];

        foreach ($books as [$title, $author, $category, $price, $desc, $status]) {
            Book::create([
                'user_id' => $admin->id, 'title' => $title, 'author' => $author,
                'category' => $category, 'unit_price' => $price,
                'description' => $desc, 'availability_status' => $status,
            ]);
        }
    }
}