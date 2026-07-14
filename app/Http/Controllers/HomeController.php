<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function generate()
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $code = '';
        for ($i = 0; $i < 4; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        Session::put('captcha_code', $code);

        $width = 180;
        $height = 70;
        $image = imagecreatetruecolor($width, $height);

        $white = imagecolorallocate($image, 255, 255, 255);
        $darkBlue = imagecolorallocate($image, 0, 0, 150);
        $lightGrayForGrid = imagecolorallocate($image, 235, 235, 235);

        imagefilledrectangle($image, 0, 0, $width, $height, $white);
        for ($i = 0; $i < $width; $i += 25) {
            imageline($image, $i, 0, $i, $height, $lightGrayForGrid);
        }
        for ($i = 0; $i < $height; $i += 20) {
            imageline($image, 0, $i, $width, $i, $lightGrayForGrid);
        }

        $fontPath = public_path('assets/fonts/Roboto-Bold.ttf');

        for ($i = 0; $i < strlen($code); $i++) {
            $fontSize = 32;
            $x = 15 + ($i * 40);
            $y = 50;
            $angle = rand(-10, 10);

            if (file_exists($fontPath)) {
                imagettftext($image, $fontSize, $angle, $x + 1, $y + 1, $darkBlue, $fontPath, $code[$i]);
                imagettftext($image, $fontSize, $angle, $x, $y, $darkBlue, $fontPath, $code[$i]);
            } else {
                imagestring($image, 5, $x, 25, $code[$i], $darkBlue);
            }
        }

        for ($i = 0; $i < 150; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $darkBlue);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        return response($imageData)->header('Content-Type', 'image/png');
    }

    public function dashboard(Request $request)
    {
        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'warga' => ['total' => 345, 'trend' => '+12 bulan ini'],
            'kk' => ['total' => 98, 'trend' => '+3 bulan ini'],
            'lansia' => ['total' => 42, 'percent' => '12% dari warga'],
            'jkn' => ['total' => 310, 'percent' => '90% tercover'],
            'keuangan' => ['saldo' => 12500000, 'pengeluaran_bulan_ini' => 1200000],
            'permohonan_surat' => 4,
            'bantuan_pemerintah' => 28, // Jumlah KK/Warga penerima
            'kegiatan_aktif' => [
                ['nama' => 'Kerja Bakti Pembersihan Selokan', 'tanggal' => '15 Juli 2026', 'status' => 'Persiapan'],
                ['nama' => 'Posyandu & Cek Kesehatan Lansia', 'tanggal' => '20 Juli 2026', 'status' => 'Terjadwal'],
            ],
            // Data Grafik Umur
            'chart_umur' => [
                'labels' => ['Balita (0-5)', 'Anak (6-12)', 'Remaja (13-17)', 'Dewasa (18-59)', 'Lansia (60+)'],
                'data' => [35, 45, 55, 168, 42]
            ],

            // Data Grafik Ekonomi
            'chart_ekonomi' => [
                'labels' => ['Menengah Keatas', 'Menengah', 'Rentan (Penerima Bantuan)'],
                'data' => [65, 220, 60]
            ],

            // Data Tren Kas 6 Bulan Terakhir
            'chart_kas' => [
                'labels' => ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                'data' => [1500000, 1450000, 1600000, 1200000, 1750000, 1250000]
            ]
        ];
        return view('admin.dashboard', $data);
    }
}
