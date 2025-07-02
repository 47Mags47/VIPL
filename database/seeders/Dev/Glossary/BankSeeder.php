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
        $contract = Contract::create([
            'number' => '666',
            'signed_at' => now(),
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
