<?php

namespace App\Jobs;

use App\Models\KabkotaModel;
use App\Models\KecamatanModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncKecamatanJob implements ShouldQueue
{
     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        KabkotaModel::select('id', 'code')
            ->chunkById(50, function ($list) {

                $responses = Http::pool(fn ($pool) =>
                    $list->map(fn ($item) =>
                        $pool->as($item->id)
                            ->get(config('services.wilayah.base_uri') . '/districts/' . $item->code . '.json')
                    )
                );

                $rows = [];

                foreach ($responses as $id => $response) {
                    $parent = $list->firstWhere('id', $id);

                    if ($response->successful()) {
                        foreach ($response->json('data') as $item) {
                            $rows[] = [
                                'name_kecamatan' => $item['name'],
                                'code' => $item['code'],
                                'kabkota_id' => $parent->id,
                            ];
                        }
                    }
                }

                if ($rows) {
                    KecamatanModel::upsert($rows, ['code'], ['name_kecamatan', 'kabkota_id']);
                }
            });
    }
}
