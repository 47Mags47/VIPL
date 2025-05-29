<?php

namespace Database\Seeders\Glossary;

use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\ContractSideType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        ContractSideType::create(['code' => 'division', 'name' => 'Организация']);
        ContractSideType::create(['code' => 'bank',     'name' => 'Банк']);

        BankExporter::create(['code' => 'other',        'name' => 'Остальные']);
        BankExporter::create(['code' => 'sber',         'name' => 'Сбер']);
        BankExporter::create(['code' => 'UralSib',      'name' => 'УралСиб']);
        BankExporter::create(['code' => 'RosSelhoz',    'name' => 'Россельхоз']);
        BankExporter::create(['code' => 'pochta',       'name' => 'Почта']);
        BankExporter::create(['code' => 'vtb',          'name' => 'ВТБ']);
        BankExporter::create(['code' => 'kbb',          'name' => 'КББ']);
        BankExporter::create(['code' => 'levobereg',    'name' => 'Левобережный']);
        BankExporter::create(['code' => 'alfa',         'name' => 'Альфа']);
        BankExporter::create(['code' => 'sovkom',       'name' => 'Совком']);

        Bank::create(['number_code' => '014',   'code' => 'Газпромбан',   'name' => 'АО "Газпромбанк"',                           'exporter_id' => BankExporter::byCode('other')->id]);
        Bank::create(['number_code' => '016',   'code' => 'Промсвязьб',   'name' => 'ПАО "Промсвязьбанк"',                        'exporter_id' => BankExporter::byCode('other')->id]);
        Bank::create(['number_code' => '022',   'code' => 'АТБ',          'name' => 'Азиатско Тихоокеанский Банк (ПАО)',          'exporter_id' => BankExporter::byCode('other')->id]);
        Bank::create(['number_code' => '002',   'code' => 'СБРФ8615',     'name' => 'ПАО "Сбербанк России"',                      'exporter_id' => BankExporter::byCode('sber')->id]);
        Bank::create(['number_code' => '010',   'code' => 'Сбер_Нерез',   'name' => 'ПАО "Сбербанк России" (нерезиденты)',        'exporter_id' => BankExporter::byCode('sber')->id]);
        Bank::create(['number_code' => '011',   'code' => 'Сбер_номин',   'name' => 'ПАО "Сбербанк России" (номинальные счета)',  'exporter_id' => BankExporter::byCode('sber')->id]);
        Bank::create(['number_code' => '013',   'code' => 'СБРФне8615',   'name' => 'ПАО "Сбербанк России" (не 8615)',            'exporter_id' => BankExporter::byCode('sber')->id]);
        Bank::create(['number_code' => '005',   'code' => 'Уралсиб',      'name' => 'ПАО "Банк Уралсиб"',                         'exporter_id' => BankExporter::byCode('UralSib')->id]);
        Bank::create(['number_code' => '007',   'code' => 'Уралс_карт',   'name' => 'ПАО "Банк Уралсиб" (карточка)',              'exporter_id' => BankExporter::byCode('UralSib')->id]);
        Bank::create(['number_code' => '006',   'code' => 'Россельхоз',   'name' => 'АО "Россельхозбанк"',                        'exporter_id' => BankExporter::byCode('RosSelhoz')->id]);
        Bank::create(['number_code' => '012',   'code' => 'Россельнер',   'name' => 'АО "Россельхозбанк" (нерезиденты)',          'exporter_id' => BankExporter::byCode('RosSelhoz')->id]);
        Bank::create(['number_code' => '015',   'code' => 'Почта  банк',  'name' => 'ПАО "Почта банк"',                           'exporter_id' => BankExporter::byCode('pochta')->id]);
        Bank::create(['number_code' => '017',   'code' => 'Банк ВТБ',     'name' => 'ПАО "Банк ВТБ"',                             'exporter_id' => BankExporter::byCode('vtb')->id]);
        Bank::create(['number_code' => '020',   'code' => 'КББ',          'name' => 'КузнецкБизнесБанк',                          'exporter_id' => BankExporter::byCode('kbb')->id]);
        Bank::create(['number_code' => '021',   'code' => 'ЛЕВОБЕРЕЖ',    'name' => 'ПАО БАНК "ЛЕВОБЕРЕЖНЫЙ"',                    'exporter_id' => BankExporter::byCode('levobereg')->id]);
        Bank::create(['number_code' => '023',   'code' => 'Альфа-Банк',   'name' => 'АО "Альфа-Банк"',                            'exporter_id' => BankExporter::byCode('alfa')->id]);
        Bank::create(['number_code' => '024',   'code' => 'Совкомбанк',   'name' => 'ПАО "Совкомбанк"',                           'exporter_id' => BankExporter::byCode('sovkom')->id]);

    }
}
