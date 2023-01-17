<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\TaskNote;
use Database\Factories\NoteFactory;
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
        Note::factory()->count(1000)->create();
    }
}
