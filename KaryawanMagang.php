<?php
// classes/KaryawanMagang.php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    public function __construct($data) {
        parent::__construct($data);
        $this->uangSakuBulanan = $data['uang_saku_bulanan'] ?? 0;
        $this->sertifikatKampusMerdeka = $data['sertifikat_kampus_merdeka'] ?? 'Tidak tersedia';
    }

    public function getUangSakuBulanan() {
        return $this->uangSakuBulanan;
    }

    public function getSertifikatKampusMerdeka() {
        return $this->sertifikatKampusMerdeka;
    }

    // ✅ OVERRIDE: (hariKerja × gajiDasar) × 0.80
    public function hitungGajiBersih() {
        $tanggalMasuk = new DateTime($this->hari_kerja_masuk);
        $sekarang = new DateTime();
        $selisih = $tanggalMasuk->diff($sekarang);
        $hariKerja = $selisih->days;
        
        return ($hariKerja * $this->gaji_dasar_per_hari) * 0.80;
    }

    public function tampilkanProfilKaryawan() {
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => 'Magang',
            'uang_saku_bulanan' => $this->uangSakuBulanan,
            'sertifikat_kampus_merdeka' => $this->sertifikatKampusMerdeka
        ];
    }

    // ✅ SELECT * FROM + WHERE khusus karyawan magang
    public static function getAllData($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Magang'";
        $result = $conn->query($query);
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = new self($row);
        }
        return $data;
    }
}
?>