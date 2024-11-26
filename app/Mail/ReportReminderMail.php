<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ngayBaoCao;

    public function __construct($ngayBaoCao)
    {
        $this->ngayBaoCao = $ngayBaoCao;
    }

    public function build()
    {
        return $this->view('emails.reportReminder')
            ->with([
                'ngayBaoCao' => $this->ngayBaoCao,
            ]);
    }
}
