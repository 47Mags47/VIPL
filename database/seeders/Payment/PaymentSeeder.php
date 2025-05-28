<?php

namespace Database\Seeders\Payment;

use App\Models\Glossary\PaymentLaw;
use App\Models\Glossary\PaymentPeriodicity;
use App\Models\Glossary\PaymentSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        PaymentSource::create(['code' => '010', 'name' => 'Региональные бюджет']);
        PaymentSource::create(['code' => '100', 'name' => 'Федеральный бюджет']);

        PaymentLaw::create(['code' => '51-ОЗ',  'name' => 'Закон Кемеровской области от 25.04.2011 №51-ОЗ "О дополнительных мерах социальной поддержки семей, имеющих детей"',                                                                                                                                      'source_id' => PaymentSource::byCode('010')->id]);
        PaymentLaw::create(['code' => '73-ОЗ',  'name' => 'Закон Кемеровской области от 09.07.2012 № 73-ОЗ "О ежемесячной денежной выплате отдельным категориям семей в случае рождения (усыновления (удочерения) третьего ребенка или последующих детей"',                                                         'source_id' => PaymentSource::byCode('010')->id]);
        PaymentLaw::create(['code' => '8-ОЗ',   'name' => 'Закон Кемеровской области-Кузбасса от 14.01.99 № 8-ОЗ "О пенсиях Кузбасса"',                                                                                                                                                                             'source_id' => PaymentSource::byCode('010')->id]);
        PaymentLaw::create(['code' => '181-ФЗ', 'name' => 'Федеральный закон от 24 ноября 1995 г. № 181-ФЗ «О социальной защите инвалидов в Российской Федерации», из них: 1) инвалиды I, II, III группы 2) семьи, имеющие детей-инвалидов',                                                                        'source_id' => PaymentSource::byCode('100')->id]);
        PaymentLaw::create(['code' => '175-ФЗ', 'name' => 'Федеральный закон от 26 ноября 1998 г. № 175-ФЗ "О социальной защите граждан Российской Федерации, подвергшихся воздействию радиации вследствие аварии в 1957 году на производственном объединении "Маяк" и сбросов радиоактивных отходов в реку Теча"', 'source_id' => PaymentSource::byCode('100')->id]);

        PaymentPeriodicity::create(['code' => 'everyDay',         'name' => 'Каждый день',  'carbon' => '1 day']);
        PaymentPeriodicity::create(['code' => 'everyMonth',       'name' => 'Каждый месяц', 'carbon' => '1 month']);
        PaymentPeriodicity::create(['code' => 'everyYear',        'name' => 'Каждый год',   'carbon' => '1 year']);
    }
}
