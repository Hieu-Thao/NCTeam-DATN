<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportReminderMail;

class SendReportReminders extends Command
{
    protected $signature = 'send:report-reminders';
    protected $description = 'Gửi email nhắc nhở cho các thành viên về lịch báo cáo';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = now()->format('Y-m-d');
        $targetDate = now()->addDays(5)->format('Y-m-d');

        $reportSchedules = DB::table('lich_bao_cao')
            ->where('ngay_bao_cao', $targetDate)
            ->pluck('ma_lich');

        foreach ($reportSchedules as $reportSchedule) {
            $members = DB::table('thamdu')
                ->join('thanh_vien', 'thamdu.ma_thanh_vien', '=', 'thanh_vien.ma_thanh_vien')
                ->where('thamdu.ma_lich', $reportSchedule)
                ->select('thanh_vien.email')
                ->get();

            foreach ($members as $member) {
                Mail::to($member->email)->send(new ReportReminderMail($targetDate));
            }
        }

        $this->info('Email nhắc nhở đã được gửi.');
    }
}
