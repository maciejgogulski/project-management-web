<?php

namespace Database\Seeders;

use App\Models\ProjectNote;
use App\Models\TaskNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectNote::factory()->count(90)->create();
        TaskNote::factory()->count(900)->create();
    }
}
