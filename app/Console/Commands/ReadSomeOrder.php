<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReadSomeOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Read:deliveredOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'can print delivered Order ';

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
     $OrderDelevary=DB::table('order')
            ->select('product_id', 'user_id','state_id')
            ->where('state_id', '2')
            ->get();
     echo $OrderDelevary;

    }
}
