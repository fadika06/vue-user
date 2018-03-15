<?php

namespace Bantenprov\User\Console\Commands;

use Illuminate\Console\Command;

/**
 * The UserCommand class.
 *
 * @package Bantenprov\User
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\User package';

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
        $this->info('Welcome to command for Bantenprov\User package');
    }
}
