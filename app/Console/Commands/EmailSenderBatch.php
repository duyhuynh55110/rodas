<?php

namespace App\Console\Commands;

// use App\Console\Services\RabbitMQService;

use App\Jobs\EmailSender;
use Illuminate\Console\Command;

class EmailSenderBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sender:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to send a mail to user used RabbitMQ';

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
        // php artisan queue:work --queue=rabbitmq
        EmailSender::dispatch(['id' => 5, 'name' => 'Demo add a message to rabbitmq queue', 'created_at' => new \DateTime()])->onQueue('rabbitmq');
    }
}
