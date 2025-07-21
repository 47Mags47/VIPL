<?php

namespace App\Exporters;

use App\Classes\Exporter;

class VtbBankExporter extends Exporter
{
    private $f;

    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('Z_0000281997_' . $this->event->date->format('Ymd') . '_' . substr($this->npp, 3, 2) . '.txt');

        $this->f = $this->getFile();
    }

    private function writeStart(): VtbBankExporter
    {
        $tag = 'START';
        $date = $this->event->date->format('Ymd');
        $npp = substr($this->npp, 3, 2);
        $payment_type = 'CREDIT';
        $division_name = sys_config('division.name');

        $start_line = "$tag;$date;$npp;$payment_type;$division_name";
        fwrite($this->f, iconv('UTf-8', 'Windows-1251', $start_line));

        return $this;
    }

    private function writeContent(): VtbBankExporter
    {
        foreach ($this->recipients as $recipient) {
            fwrite($this->f, iconv('UTf-8', 'Windows-1251', "\n"));
            $account = (string) $recipient->account;
            $summ = (string) number_format($recipient->summ, 2, ',', '');
            $fio = $recipient->last_name . ' ' . $recipient->first_name . ' ' . $recipient->middle_name;
            $income_type = 2;
            $alert_type = 47;
            $content_line = "$account;$summ;$fio;;$income_type;;$alert_type";


            if (in_array($this->event->payment->code, ['040'])) {
                $income_type = 1;
                $alert_type = 3;
            }

            if (in_array($this->event->payment->code, ['070']))
                $income_type = 1;


            fwrite($this->f, iconv('UTf-8', 'Windows-1251', $content_line));
        }

        return $this;
    }

    private function writeEnd(): VtbBankExporter
    {
        $total_count = $this->recipients->count();
        $total_summ = number_format($this->recipients->sum('summ'), 2, ',', '');

        $end_line = "\nEND;$total_count;$total_summ;RUR";
        fwrite($this->f, iconv('UTf-8', 'Windows-1251', $end_line));

        return $this;
    }

    public function generate(): VtbBankExporter
    {
        $this
            ->writeStart()
            ->writeContent()
            ->writeEnd();

        return $this;
    }
}
