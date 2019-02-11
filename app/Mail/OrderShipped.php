<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $bookname;
    private $path;
    private $extension;
    private $admin;
    public $timeout = 300;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin="admin@wwzc.cc", $bookname, $extension, $path)
    {
        $this->bookname = $bookname;
        $this->path = $path;
        $this->extension = $extension;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // file_put_contents('66666666666666', '55555555556');
        // die;
        return $this->from($this->admin)
                    ->view('email')
                    ->subject('推送书籍：'.$this->bookname)
                    ->with(['bookname'=>$this->bookname])
                    ->attach($this->path, ['as' => "=?UTF-8?B?". base64_encode($this->bookname.'.'.$this->extension) . "?="]);
    }
}
