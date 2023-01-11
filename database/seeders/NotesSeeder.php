<?php

namespace Database\Seeders;

use App\Models\ProjectNotes;
use App\Models\TaskNotes;
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
        ProjectNotes::factory()->count(90)->create();
        TaskNotes::factory()->count(900)->create();
    }
}
