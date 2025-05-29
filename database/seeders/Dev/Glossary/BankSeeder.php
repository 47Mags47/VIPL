<?php

namespace Database\Seeders\Dev\Glossary;

use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
use App\Models\Glossary\ContractSide;
use App\Models\Glossary\ContractSideType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $division_side = ContractSide::create([
            'name' => $faker->company(),
            'INN' => $faker->numerify('##########'),
            'account' => $faker->numerify('####################'),
            'BIK' => $faker->numerify('#########'),
            'type_id' => ContractSideType::byCode('division')->id,
        ]);

        $bank_side = ContractSide::create([
            'name' => $faker->company(),
            'INN' => $faker->numerify('##########'),
            'account' => $faker->numerify('####################'),
            'BIK' => $faker->numerify('#########'),
            'type_id' => ContractSideType::byCode('bank')->id,
        ]);

        $contract = Contract::create([
            'number' => '666',
            'signed_at' => now(),
            'division_side_id' => $division_side->id,
            'bank_side_id' => $bank_side->id
        ]);

        foreach (Bank::all() as $bank) {
            $bank->update(['contract_id' => $contract->id]);
        }

        foreach (range(900, 910) as $i) {
            Bank::firstOrCreate([
                'number_code' => str_pad("$i", 3, "0", STR_PAD_LEFT),
            ], [
                'code' => 'БАНК' . str_pad("$i", 3, "0", STR_PAD_LEFT),
                'name' => 'ПАО ' . str_pad("$i", 3, "0", STR_PAD_LEFT) . ' Банк',
                'exporter_id' => BankExporter::byCode('other')->id,
                'contract_id' => $contract->id,
            ]);
        }
    }
}
