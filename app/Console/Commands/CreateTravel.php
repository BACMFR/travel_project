<?php

namespace App\Console\Commands;

use App\Models\Travel;
use Illuminate\Console\Command;

class CreateTravel extends Command
{
    protected $signature = 'travel:create {slug} {name} {description} {number_of_days}';

    protected $description = 'Create a new Travel';

    public function handle()
    {
        $slug = $this->argument('slug');
        $name = $this->argument('name');
        $description = $this->argument('description');
        $number_of_days = $this->argument('number_of_days');

        $travel = Travel::create([
            'slug' => $slug,
            'name' => $name,
            'description' => $description,
            'number_of_days' => $number_of_days,
        ]);

        $this->info('Travel Created Successfully');
    }
}
