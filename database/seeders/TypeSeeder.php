<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Easy', 'Not so easy', 'Quite expensive', 'Difficult', 'Unsafe', 'Unapproachable', 'Amazing'];

        foreach ($types as $typ) {
            $type = new Type();
            $type->level = $typ;
            $type->slug = Str::of($type->level)->slug('-');;
            $type->save();
        }
    }
}
