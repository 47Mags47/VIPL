<?php

namespace App\Exporters;

use App\Classes\Exporter;
use Illuminate\Support\Facades\Storage;

class UralSibBankExporter extends Exporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('55557460' . substr($this->npp, 0, 3) . '.I' . substr($this->npp, 3, 2));
    }

    public function save(): UralSibBankExporter
    {
        $row_count = $this->recipients->count();
        $total_summ = $this->recipients->sum('summ');

        $f = fopen($this->getFullPath(), 'w');

        $info_line = str_pad($row_count, 5, ' ', STR_PAD_LEFT) . '5555746' . str_pad(number_format($total_summ, 2, '.', ''), 15, ' ', STR_PAD_LEFT) . 'z';
        fwrite($f, iconv('UTf-8', 'CP866', $info_line));

        foreach ($this->recipients as $i => $recipient) {
            $recipient_line = implode('', [
                "\n",
                mb_str_pad($recipient->last_name, 20, ' '),
                mb_str_pad($recipient->first_name, 20, ' '),
                mb_str_pad($recipient->middle_name, 20, ' '),
                str_pad($recipient->account, 20, ' '),
                str_pad((string) number_format($recipient->summ, 2, '.', ''), 12, ' ', STR_PAD_LEFT),
                "10        0.002"
            ]);
            fwrite($f, iconv('UTf-8', 'CP866', $recipient_line));
        }

        return $this;
    }
}
