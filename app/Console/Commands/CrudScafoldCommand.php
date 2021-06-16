<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CrudScafoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:scafold {model}';

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

        $model = $this->argument('model');

        $model_snake_case = Str::snake($model);

        $this->info('Scafolding ' . $model_snake_case . ' to crud files ...');

        $this->generateModels($model);

        $this->generateViewScafolds($model_snake_case);

        return 0;
    }

    function generateModels($model){
        if ($model !== 0){
            $this->info('Generating model and migration ... ');
            Artisan::call('make:model ' . $model . ' -a');
            $this->info('Done generating model and migration ...');
        }
    }

    function generateViewScafolds($model_snake_case){

    }

    function generateServiceScafold($model){

    }

    function generateRouteScafold($model){

    }

    function regenerateController($model){

    }



}
