<?php

namespace App\Console\Commands;

use App\Jobs\TopProductsEmailSender;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EmailTopProductsData extends Command
{
    /**
     * The name of batch
     *
     * @var string
     */
    protected $batchName = 'email:product';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:product
                            {--brand_id=: brand\'s id you want to get products list}
                            {--email=: email address }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a product email to user; add data to RabbitMQ queue';

    /**
     * Create a new command instance.
     *
     * @param  ProductService  $productService
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * User's input email from option
     */
    private string $email;

    /**
     * User's brand_id email from option
     */
    private string $brandId;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->logging('batch is start');

        $this->email = $this->option('email');
        $this->brandId = $this->option('brand_id');

        // log inputs
        $this->logging('---Options---');
        $this->logging("email: {$this->email}; brand_id: {$this->brandId};");

        $validator = $this->validate();

        // validate input is valid
        if ($validator->fails()) {
            $this->logging(json_encode($validator->errors()), 'error');

            return 0;
        }

        // dispatch to RabbitMQ queue
        TopProductsEmailSender::dispatch($this->email, $this->brandId)->onQueue('rabbitmq');

        return 0;
    }

    /**
     * Write log
     *
     * @return void
     */
    private function logging(string $context, $type = 'info')
    {
        Log::{$type}('[command '.$this->batchName.'] '.$context);

        // write error message to console
        if ($type == 'error') {
            $this->error($context);
        }
    }

    /**
     * Validate option is valid
     *
     * @return \Illuminate\Validation\Validator
     */
    private function validate()
    {
        $this->logging('---Validate---');

        return Validator::make(
            [
                'brand_id' => $this->option('brand_id'),
                'email' => $this->option('email'),
            ],
            [
                'brand_id' => 'required|integer|exists:brands,id',
                'email' => 'required|email',
            ]
        );
    }
}
