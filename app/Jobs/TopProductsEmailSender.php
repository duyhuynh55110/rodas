<?php

namespace App\Jobs;

use App\Jobs\Services\BrandService;
use App\Jobs\Services\ProductService;
use App\Mail\TopProductsEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Throwable;

class TopProductsEmailSender implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $brandId
     * @return void
     */
    public function __construct(private string $email, private string $brandId)
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // services
        $productService = getClass(ProductService::class);
        $brandService = getClass(BrandService::class);

        // prepare data
        $brand = $brandService->findBrandById($this->brandId);
        $products = $productService->findTopProductsByBrand($this->brandId);

        // send email
        Mail::to($this->email)->send(new TopProductsEmail($brand, $products));
    }
}
