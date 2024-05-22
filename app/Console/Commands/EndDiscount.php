<?php

namespace App\Console\Commands;

use App\Models\ProductVariant;
use Illuminate\Console\Command;

class EndDiscount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:end-discount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = ProductVariant::where('active_discount', true)->where('discount_date', '<=', date('Y-m-d'))->get();
        foreach ($products as $product){
         $product->active_discount = false;
         $product->save();
        }
    }
}
