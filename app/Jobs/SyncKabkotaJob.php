<?php

namespace App\Jobs;

use App\Models\KabkotaModel;
use App\Models\ProvinsiModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncKabkotaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public function handle()
    {
        ProvinsiModel::select('id', 'code')
            ->chunkById(50, function ($provinsiList) {

                $responses = Http::pool(
                    fn($pool) =>
                    $provinsiList->map(
                        fn($provinsi) =>
                        $pool->as($provinsi->id)
                            ->get(config('services.wilayah.base_uri') . '/regencies/' . $provinsi->code . '.json')
                    )
                );

                $rows = [];

                foreach ($responses as $id => $response) {
                    $provinsi = $provinsiList->firstWhere('id', $id);

                    if ($response->successful()) {
                        foreach ($response->json('data') as $item) {
                            $rows[] = [
                                'name_kabkota' => $item['name'],
                                'code' => $item['code'],
                                'provinsi_id' => $provinsi->id,
                            ];
                        }
                    }
                }

                if ($rows) {
                    KabkotaModel::upsert($rows, ['code'], ['name_kabkota', 'provinsi_id']);
                }
            });
    }
}
