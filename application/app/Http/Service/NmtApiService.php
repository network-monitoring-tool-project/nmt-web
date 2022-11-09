<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class NmtApiService
{

    public static function requestScan(string $apiToken): void
    {
        //FIXME (only for demo content)
        $dbId = intval(Random::generate(3, '0-9'));

        DB::table('scans')->insert([
            'id' => $dbId,
            'status' => 'ok',
            'timestamp' => sprintf('%s', now()),
        ]);

        $addresses = intval(Random::generate(1, '0-9'));

        for ($i = 0; $i <= $addresses; $i++) {
            DB::table('addresses')->insert([
                'ip' => '127.0.0.1',
                'mac' => Random::generate(15),
                'online' => Random::generate(1, '0-1'),
                'scan_id' => $dbId,
            ]);
        }
    }

}
