<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker, TypeSeeder $type_seeder): void
    {
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();
            $project->name = $faker->word(5, true);
            $project->description = $faker->text(200);
            $project->cover_image = $faker->imageUrl(600, 400, 'projects', true, $project->title, false, 'jpg');
            $project->slug = Str::of($project->name)->slug('-');
            $project->save();
        }
    }
}
