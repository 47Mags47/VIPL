<?php

namespace App\Exporters;

use App\Classes\XMLExporter;

class PochtaBankExporter extends XMLExporter
{
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->setFileName($this->event->date->format('Y') . '-ELVM-' . substr($this->npp, 0, 5) . '.xml');
    }

    public function generate(): PochtaBankExporter
    {
        $this->writer->openMemory();
        $this->writer->startDocument('1.0', 'windows-1251');
        $this->writer->setIndent(true);

        $this->writer->startElement('ФайлОСЗН');

        $this->writer->startElement('ВХОДЯЩАЯ_ОПИСЬ');

        $this->writer->startElement('ДатаСоставления');
        $this->writer->text((string) $this->event->date->format('d.m.Y'));
        $this->writer->endElement();

        $this->writer->startElement('НомерПлатежногоПоручения');
        $this->writer->endElement();

        $this->writer->startElement('ДатаПлатежногоПоручения');
        $this->writer->text((string) $this->event->date->format('d.m.Y'));
        $this->writer->endElement();

        $this->writer->startElement('ОбщаяСумма');
        $this->writer->text((string) number_format($this->recipients->sum('summ'), 2, '.', ''));
        $this->writer->endElement();

        $this->writer->startElement('ОбщееКоличествоПоручений');
        $this->writer->text((string) $this->recipients->count());
        $this->writer->endElement();

        $this->writer->startElement('ДопИнфоПоОписи');
        $this->writer->text('');
        $this->writer->endElement();

        $this->writer->endElement();


        $this->writer->startElement('СПИСОК_НА_ЗАЧИСЛЕНИЕ');
        foreach ($this->recipients as $recipient) {
            $this->writer->startElement('СведенияОполучателе');

            $this->writer->startElement('ФИО');
            $this->writer->startElement('Фамилия');
            $this->writer->text((string) $recipient->last_name);
            $this->writer->endElement();
            $this->writer->startElement('Имя');
            $this->writer->text((string) $recipient->first_name);
            $this->writer->endElement();
            $this->writer->startElement('Отчество');
            $this->writer->text((string) $recipient->middle_name);
            $this->writer->endElement();
            $this->writer->endElement();

            $this->writer->startElement('НомерСчета');
            $this->writer->text((string) $recipient->account);
            $this->writer->endElement();

            $this->writer->startElement('ДопИнфоПоПолучателю');
            $this->writer->text('');
            $this->writer->endElement();

            $this->writer->startElement('ВсеВыплаты');
            $this->writer->startElement('Выплата');

            $this->writer->startElement('СуммаКвыплате');
            $this->writer->text(number_format($recipient->summ, 2, '.', ''));
            $this->writer->endElement();

            $this->writer->startElement('ДатаНачалаПериода');
            $this->writer->text((string) $this->event->date->startOfMonth()->format('d.m.Y'));
            $this->writer->endElement();

            $this->writer->startElement('ДатаКонцаПериода');
            $this->writer->text((string) $this->event->date->endOfMonth()->format('d.m.Y'));
            $this->writer->endElement();

            $this->writer->startElement('ДатаКонцаПериода');
            $this->writer->text((string) $recipient->account);
            $this->writer->endElement();

            $this->writer->startElement('ДопИнфоПоВыплате');
            $this->writer->text('');
            $this->writer->endElement();

            $this->writer->endElement();
            $this->writer->endElement();

            $this->writer->endElement();
        }
        $this->writer->endElement();

        $this->writer->endElement();

        $this->save();

        return $this;
    }
}
