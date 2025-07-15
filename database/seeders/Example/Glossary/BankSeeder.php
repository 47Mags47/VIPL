<?php

namespace Database\Seeders\Example\Glossary;

use App\Models\Glossary\Bank;
use App\Models\Glossary\BankExporter;
use App\Models\Glossary\Contract;
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


        Bank::create([
            'number_code' => "900",
            'code' => 'БАНК' . "900",
            'name' => 'ПАО ' . "900" . ' Банк',
            'exporter_id' => BankExporter::byCode('other')->id,
            'contract_id' => $contract->id,
        ]);
    }
}
