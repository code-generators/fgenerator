<?php

namespace LifeCode\Fgenerator\Generator;

use Illuminate\Console\Command;

class FgeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fgenerator:run {group} {module} {model} {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run fgenerator command';

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
     * @return mixed
     */
    public function handle()
    {
        app('fgenerator')->run(
            $this->argument('group'),
            $this->argument('module'),
            $this->argument('model'),
            $this->argument('type')
        );
    }
}
