<?php

namespace App\Jobs;

use App\Mail\VendasMail;
use App\Models\Venda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VendasEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vendas, $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($vendas, $details)
    {
        $this->vendas   = $vendas;
        $this->details  = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new VendasMail($this->vendas);
        \Mail::to($this->details['email'])->send($email);
    }
}
