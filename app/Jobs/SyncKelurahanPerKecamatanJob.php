<?php

namespace App\Jobs;

use App\Models\KelurahanModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SyncKelurahanPerKecamatanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300; 
    public $tries = 3;

    protected $kecamatanId;
    protected $code;

    public function __construct($kecamatanId, $code)
    {
        $this->kecamatanId = $kecamatanId;
        $this->code = $code;
    }

    public function handle()
    {
        if (!Cache::add('sync_kelurahan_' . $this->code, true, 600)) {
            return;
        }

        try {
            $response = Http::timeout(10)
                ->retry(2, 100)
                ->get(config('services.wilayah.base_uri') . '/villages/' . $this->code . '.json');

            if (!$response->successful()) {
                Log::error("Gagal fetch kelurahan: {$this->code}");
                return;
            }

            $rows = [];

            foreach ($response->json('data') as $item) {
                $rows[] = [
                    'name_kelurahan' => $item['name'],
                    'code' => $item['code'],
                    'kecamatan_id' => $this->kecamatanId,
                ];
            }

            if (!empty($rows)) {
                KelurahanModel::upsert(
                    $rows,
                    ['code'],
                    ['name_kelurahan', 'kecamatan_id']
                );
            }

        } catch (\Throwable $e) {
            Log::error("Error sync kelurahan {$this->code}: " . $e->getMessage());
            throw $e;
        }
    }
}
