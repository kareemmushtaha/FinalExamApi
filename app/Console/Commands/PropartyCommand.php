<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\models\order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PropartyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Order:delivered';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Can update status order';

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
        $updateOrder = DB::table('order')
            ->where('state_id', '1')
            ->update([
                'state_id' => '2',
            ]);
        if ($updateOrder == True) {
            echo "update order status  successfully";

        } else {
            echo 'not found any order (every order are their delivered status ) ';
        }
    }

}
