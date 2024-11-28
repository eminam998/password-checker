<?php

// app/Console/Commands/SeedUsers.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SeedUsers extends Command
{
    protected $signature = 'seed:users';
    protected $description = 'Seed users into the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        User::factory()->count(10)->create();

        $this->info('Users seeded successfully!');
    }
}


