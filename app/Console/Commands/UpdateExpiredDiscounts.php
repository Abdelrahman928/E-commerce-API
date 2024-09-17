<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateExpiredDiscounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-expired-discounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset outdated discounts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::whereNotNull('discount_valid_until')
        ->where('discount_valid_until', '<=', Carbon::now())
        ->get();

        if($products->isEmpty()){
            $this->info('no outdated discounts found');
            return;
        }

        foreach ($products as $product) {
            $product->discount = null;
            $product->discount_valid_until = null;
            $product->save();
        }

        $this->info('Expired discounts updated successfully.');
    }
}

