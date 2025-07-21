<?php

namespace App\Exporters;

use App\Classes\XMLExporter;

class SberBankExporter extends XMLExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName('f8615' . substr($this->npp, 2, 3) . '.xml');
    }

    public function generate(): SberBankExporter
    {
        $this->writer->openMemory();
        $this->writer->startDocument('1.0', 'windows-1251');
        $this->writer->setIndent(true);

        $this->writer->startElement('СчетаПК');
        $this->writer->writeAttribute('ДатаФормирования',           now()->format('Y-m-d'));
        $this->writer->writeAttribute('НомерДоговора',              $this->bank->contract->number);
        $this->writer->writeAttribute('НаименованиеОрганизации',    sys_config('division.name'));
        $this->writer->writeAttribute('ИНН',                        sys_config('division.INN'));
        $this->writer->writeAttribute('РасчетныйСчетОрганизации',   sys_config('division.account'));
        $this->writer->writeAttribute('БИК',                        sys_config('division.BIK'));
        $this->writer->writeAttribute('ИдПервичногоДокумента',      substr($this->npp, 2, 3));
        $this->writer->writeAttribute('НомерРеестра',               substr($this->npp, 2, 3));
        $this->writer->writeAttribute('ДатаРеестра',                now()->format('Y-m-d'));

        $this->writer->startElement('ЗачислениеЗарплаты');
        foreach ($this->recipients as $npp => $recipient) {
            $this->writer->startElement('Сотрудник');
            $this->writer->writeAttribute('Нпп', $npp + 1);

            $this->writer->startElement('Фамилия');
            $this->writer->text((string) $recipient->last_name);
            $this->writer->endElement();

            $this->writer->startElement('Имя');
            $this->writer->text((string) $recipient->first_name);
            $this->writer->endElement();

            $this->writer->startElement('Отчество');
            $this->writer->text((string) $recipient->middle_name);
            $this->writer->endElement();

            $this->writer->startElement('ОтделениеБанка');
            $this->writer->text((string) 8615);
            $this->writer->endElement();

            $this->writer->startElement('ФилиалОтделенияБанка');
            $this->writer->text((string) 0);
            $this->writer->endElement();

            $this->writer->startElement('ЛицевойСчет');
            $this->writer->text((string) $recipient->account);
            $this->writer->endElement();

            $this->writer->startElement('Сумма');
            $this->writer->text(number_format($recipient->summ, 2, '.', ''));
            $this->writer->endElement();

            $this->writer->endElement();
        }
        $this->writer->endElement();

        $this->writer->startElement('ВидЗачисления');
        $this->writer->text((string) 2);
        $this->writer->endElement();

        $this->writer->startElement('ДатаПлатежногоПоручения');
        $this->writer->text((string) now()->format('Y-m-d'));
        $this->writer->endElement();

        $this->writer->startElement('КонтрольныеСуммы');
        $this->writer->startElement('КоличествоЗаписей');
        $this->writer->text((string) $this->recipients->count());
        $this->writer->endElement();

        $this->writer->startElement('СуммаИтого');
        $this->writer->text((string) number_format($this->recipients->sum('summ'), 2, '.', ''));
        $this->writer->endElement();
        $this->writer->endElement();

        $this->writer->endElement();

        $this->save();

        return $this;
    }
}
