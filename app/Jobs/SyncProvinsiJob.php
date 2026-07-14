<?php

namespace App\Jobs;

use App\Models\ProvinsiModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable; 
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncProvinsiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $response = Http::get(config('services.wilayah.base_uri') . '/provinces.json');

        if (!$response->successful()) return;

        $rows = [];

        foreach ($response->json('data') as $item) {
            $rows[] = [
                'code' => $item['code'],
                'name_provinsi' => $item['name'],
            ];
        }

        ProvinsiModel::upsert($rows, ['code'], ['name_provinsi']);
    }
}
