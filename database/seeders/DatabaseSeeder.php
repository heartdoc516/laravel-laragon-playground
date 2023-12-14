<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\ShopItem;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ShopItem::factory()->count(50)->create();
        Post::factory()->hasAttached(Tag::factory()->count(3))->count(10)->create();
    }
}
