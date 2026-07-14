<?php

namespace App\Jobs;

use App\Models\KecamatanModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SyncKelurahanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        KecamatanModel::select('id', 'code')
            ->chunkById(100, function ($list) {

                foreach ($list as $kecamatan) {
                    SyncKelurahanPerKecamatanJob::dispatch(
                        $kecamatan->id,
                        $kecamatan->code
                    );
                }
            });
    }
}
