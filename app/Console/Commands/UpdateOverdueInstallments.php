<?php

namespace App\Console\Commands;

use App\Models\Installment;
use Illuminate\Console\Command;

class UpdateOverdueInstallments extends Command
{
    protected $signature = 'installments:update-overdue';
    protected $description = 'تحديث الأقساط التي تجاوزت تاريخ الاستحقاق إلى حالة "متأخرة"';

    public function handle()
    {
        $count = Installment::where('status', 'pending')
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);

        $this->info("تم تحديث {$count} قسط/أقساط إلى حالة متأخرة.");
    }
}