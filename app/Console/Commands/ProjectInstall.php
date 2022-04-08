<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jci:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        system('php artisan backpack:install');
        $this->info('Backpack package has installed successfully');
        system('php artisan vendor:publish --tag=blueprint-config');
        $this->info('blueprint package has installed successfully');
        $this->info('php artisan db:seed');
        $this->info('Database seeded successfully');

    }
}
