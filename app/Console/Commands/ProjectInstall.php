<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SOS\QueryHelper\Facade\QueryHelperFacade;

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
    protected $description = 'installing all the project dependencies';

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
        $this->info('<fg=yellow>We are installing every thing for you, do not forget to follow syrian open source on github.</>');
        system('php artisan backpack:install');
        $this->info('<fg=green>Backpack package has installed successfully</>');
        system('php artisan vendor:publish --tag=blueprint-config');
        system('php artisan blueprint:build');
        $this->info('<fg=green>blueprint package has installed successfully</>');
        $this->truncateAllTables();
        $this->info('<fg=green>all tables are truncated</>');
        system('php artisan db:seed');
        $this->info('<fg=green>Database seeded successfully</>');
        system('php artisan storage:link');
        $this->info('<fg=green>Storage linked successfully</>');

    }

    private function truncateAllTables()
    {
        QueryHelperFacade::deleteInstance()
            ->setAllTablesFromDatabase()
            ->truncateMultiTables()
            ->executeWithoutPrepare();
    }
}
