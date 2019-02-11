<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Mail\OrderShipped;
use Mail;
// use Illuminate\Support\Facades\DB;

class MailProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bookname;
    private $extension;
    private $path;
    private $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $bookname, $extension, $path)
    {
        $this->bookname = $bookname;
        $this->extension = $extension;
        $this->path = $path;
        $this->email = $email;
        \Illuminate\Support\Facades\DB::table('test')->insert(['test'=>'$this->email']);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // file_put_contents('66666666666666','999999');
        // echo 22222;
        \Illuminate\Support\Facades\DB::table('test')->insert(['test'=>'$this->email']);
        // Mail::to($this->email)->send(new OrderShipped($this->bookname, $this->extension, 'storage/upload/'.$this->path));
    }
}
