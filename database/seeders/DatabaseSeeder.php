<?php

namespace Database\Seeders;

use App\Models\{Bidhaa, Mteja, Uuzaji, MauzoItem, AwamuMpango, Malipo};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Bidhaa (Products)
        $bidhaa = [
            ['jina' => 'Televisheni Samsung 55"',   'aina' => 'Televisheni',  'bei_ununuzi' => 450000,  'bei_uuzaji' => 550000,  'hisa' => 8],
            ['jina' => 'Jokofu LG 420L',             'aina' => 'Jokofu',       'bei_ununuzi' => 600000,  'bei_uuzaji' => 750000,  'hisa' => 5],
            ['jina' => 'Mashine ya Kufulia 7kg',     'aina' => 'Mashine',      'bei_ununuzi' => 350000,  'bei_uuzaji' => 430000,  'hisa' => 6],
            ['jina' => 'Kiyoyozi 1.5 HP',            'aina' => 'Kiyoyozi',     'bei_ununuzi' => 380000,  'bei_uuzaji' => 480000,  'hisa' => 4],
            ['jina' => 'Mfululizo wa Umeme (UPS)',   'aina' => 'UPS',          'bei_ununuzi' => 120000,  'bei_uuzaji' => 160000,  'hisa' => 12],
            ['jina' => 'Jiko la Umeme 4 Mpamba',     'aina' => 'Jiko',         'bei_ununuzi' => 150000,  'bei_uuzaji' => 195000,  'hisa' => 10],
            ['jina' => 'Kompyuta ndogo HP i5',       'aina' => 'Kompyuta',     'bei_ununuzi' => 500000,  'bei_uuzaji' => 620000,  'hisa' => 7],
            ['jina' => 'Simu Samsung A54',           'aina' => 'Simu',         'bei_ununuzi' => 280000,  'bei_uuzaji' => 350000,  'hisa' => 15],
            ['jina' => 'Feni ya Kuta 16"',           'aina' => 'Feni',         'bei_ununuzi' => 45000,   'bei_uuzaji' => 65000,   'hisa' => 20],
            ['jina' => 'Mfululizo wa Betri 200Ah',   'aina' => 'Betri',        'bei_ununuzi' => 200000,  'bei_uuzaji' => 260000,  'hisa' => 9],
            ['jina' => 'Stabalaiza 5KVA',            'aina' => 'Stabalaiza',   'bei_ununuzi' => 180000,  'bei_uuzaji' => 240000,  'hisa' => 6],
            ['jina' => 'Chombo cha Kukata Nyasi',    'aina' => 'Zana',         'bei_ununuzi' => 90000,   'bei_uuzaji' => 120000,  'hisa' => 3],
        ];
        foreach ($bidhaa as $b) Bidhaa::create($b);

        // Wateja (Customers)
        $wateja = [
            ['jina' => 'Ahmed Hassan',      'simu' => '+964 750 100 1001', 'anwani' => 'Baghdad, Al-Karada',    'sarafu_pendwa' => 'IQD'],
            ['jina' => 'Fatima Al-Ali',     'simu' => '+964 770 200 2002', 'anwani' => 'Baghdad, Al-Mansour',   'sarafu_pendwa' => 'IQD'],
            ['jina' => 'Omar Khalid',       'simu' => '+964 780 300 3003', 'anwani' => 'Basra, Al-Ashar',       'sarafu_pendwa' => 'IQD'],
            ['jina' => 'Sarah Johnson',     'simu' => '+1 555 400 4004',   'anwani' => 'Erbil, Ainkawa',        'sarafu_pendwa' => 'USD'],
            ['jina' => 'Mohammed Al-Rawi',  'simu' => '+964 790 500 5005', 'anwani' => 'Mosul',                 'sarafu_pendwa' => 'IQD'],
            ['jina' => 'David Smith',       'simu' => '+1 555 600 6006',   'anwani' => 'Baghdad, Green Zone',   'sarafu_pendwa' => 'USD'],
        ];
        $matejaModels = [];
        foreach ($wateja as $w) $matejaModels[] = Mteja::create($w);

        $bidhaaModels = Bidhaa::all();

        // Mauzo ya mfano
        // 1. Taslimu - IQD
        $u1 = Uuzaji::create([
            'nambari'     => 'ES-' . date('Ymd') . '-0001',
            'mteja_id'    => $matejaModels[0]->id,
            'aina_malipo' => 'taslimu',
            'sarafu'      => 'IQD',
            'jumla'       => 550000,
            'ilipwa'      => 550000,
            'salio'       => 0,
            'hali'        => 'kumalizika',
            'tarehe'      => now()->subDays(5)->format('Y-m-d'),
        ]);
        MauzoItem::create(['uuzaji_id' => $u1->id, 'bidhaa_id' => $bidhaaModels[0]->id, 'idadi' => 1, 'bei' => 550000, 'jumla' => 550000]);
        Bidhaa::find($bidhaaModels[0]->id)->decrement('hisa', 1);

        // 2. Deni - IQD
        $u2 = Uuzaji::create([
            'nambari'     => 'ES-' . date('Ymd') . '-0002',
            'mteja_id'    => $matejaModels[1]->id,
            'aina_malipo' => 'deni',
            'sarafu'      => 'IQD',
            'jumla'       => 750000,
            'ilipwa'      => 200000,
            'salio'       => 550000,
            'hali'        => 'wazi',
            'tarehe'      => now()->subDays(10)->format('Y-m-d'),
        ]);
        MauzoItem::create(['uuzaji_id' => $u2->id, 'bidhaa_id' => $bidhaaModels[1]->id, 'idadi' => 1, 'bei' => 750000, 'jumla' => 750000]);
        Malipo::create(['uuzaji_id' => $u2->id, 'kiasi' => 200000, 'sarafu' => 'IQD', 'tarehe' => now()->subDays(10)->format('Y-m-d')]);
        Bidhaa::find($bidhaaModels[1]->id)->decrement('hisa', 1);

        // 3. Awamu - IQD
        $u3 = Uuzaji::create([
            'nambari'     => 'ES-' . date('Ymd') . '-0003',
            'mteja_id'    => $matejaModels[2]->id,
            'aina_malipo' => 'awamu',
            'sarafu'      => 'IQD',
            'jumla'       => 1860000,
            'ilipwa'      => 310000,
            'salio'       => 1550000,
            'hali'        => 'wazi',
            'tarehe'      => now()->subDays(15)->format('Y-m-d'),
        ]);
        MauzoItem::create(['uuzaji_id' => $u3->id, 'bidhaa_id' => $bidhaaModels[3]->id, 'idadi' => 1, 'bei' => 480000, 'jumla' => 480000]);
        MauzoItem::create(['uuzaji_id' => $u3->id, 'bidhaa_id' => $bidhaaModels[2]->id, 'idadi' => 1, 'bei' => 430000, 'jumla' => 430000]);
        MauzoItem::create(['uuzaji_id' => $u3->id, 'bidhaa_id' => $bidhaaModels[4]->id, 'idadi' => 1, 'bei' => 160000, 'jumla' => 160000]);
        MauzoItem::create(['uuzaji_id' => $u3->id, 'bidhaa_id' => $bidhaaModels[8]->id, 'idadi' => 2, 'bei' => 65000, 'jumla' => 130000]);
        AwamuMpango::create([
            'uuzaji_id'        => $u3->id,
            'idadi_awamu'      => 6,
            'kiasi_kila_awamu' => 258333,
            'tarehe_mwanzo'    => now()->addDays(15)->format('Y-m-d'),
            'siku_baina'       => 30,
        ]);
        Malipo::create(['uuzaji_id' => $u3->id, 'kiasi' => 310000, 'sarafu' => 'IQD', 'tarehe' => now()->subDays(15)->format('Y-m-d'), 'maelezo' => 'Amana ya mwanzo']);
        Bidhaa::find($bidhaaModels[3]->id)->decrement('hisa', 1);
        Bidhaa::find($bidhaaModels[2]->id)->decrement('hisa', 1);
        Bidhaa::find($bidhaaModels[4]->id)->decrement('hisa', 1);
        Bidhaa::find($bidhaaModels[8]->id)->decrement('hisa', 2);

        // 4. Taslimu - USD
        $u4 = Uuzaji::create([
            'nambari'     => 'ES-' . date('Ymd') . '-0004',
            'mteja_id'    => $matejaModels[3]->id,
            'aina_malipo' => 'taslimu',
            'sarafu'      => 'USD',
            'jumla'       => 970.00,
            'ilipwa'      => 970.00,
            'salio'       => 0,
            'hali'        => 'kumalizika',
            'tarehe'      => now()->subDays(3)->format('Y-m-d'),
        ]);
        MauzoItem::create(['uuzaji_id' => $u4->id, 'bidhaa_id' => $bidhaaModels[6]->id, 'idadi' => 1, 'bei' => 620.00, 'jumla' => 620.00]);
        MauzoItem::create(['uuzaji_id' => $u4->id, 'bidhaa_id' => $bidhaaModels[7]->id, 'idadi' => 1, 'bei' => 350.00, 'jumla' => 350.00]);
        Bidhaa::find($bidhaaModels[6]->id)->decrement('hisa', 1);
        Bidhaa::find($bidhaaModels[7]->id)->decrement('hisa', 1);

        // 5. Deni - USD
        $u5 = Uuzaji::create([
            'nambari'     => 'ES-' . date('Ymd') . '-0005',
            'mteja_id'    => $matejaModels[5]->id,
            'aina_malipo' => 'deni',
            'sarafu'      => 'USD',
            'jumla'       => 480.00,
            'ilipwa'      => 100.00,
            'salio'       => 380.00,
            'hali'        => 'wazi',
            'tarehe'      => now()->subDays(7)->format('Y-m-d'),
        ]);
        MauzoItem::create(['uuzaji_id' => $u5->id, 'bidhaa_id' => $bidhaaModels[3]->id, 'idadi' => 1, 'bei' => 480.00, 'jumla' => 480.00]);
        Malipo::create(['uuzaji_id' => $u5->id, 'kiasi' => 100.00, 'sarafu' => 'USD', 'tarehe' => now()->subDays(7)->format('Y-m-d')]);
        Bidhaa::find($bidhaaModels[3]->id)->decrement('hisa', 1);
    }
}
