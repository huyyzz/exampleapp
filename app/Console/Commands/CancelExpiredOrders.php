<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel unpaid orders older than 15 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredOrders = Order::where('status', 'Pending')
            ->where('isOnlinePaid', true)
            ->where('isPaid', false)
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->update(['status' => 'Cancelled']);

        $this->info("Expired orders cancelled successfully.");
    }
}
