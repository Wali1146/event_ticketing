<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter the name of the repository');
        $file = app_path('Repositories/' . $name . 'Repository.php');
        if (file_exists($file)) {
            $this->error('Repository already exists');
            return;
        }
        $source = file_get_contents(base_path('stubs/repository.php'));
        $stub = str_replace('{{name}}', $name, $source);
        file_put_contents($stub, $file);
        $this->info('Repository created successfully');
    }
}
