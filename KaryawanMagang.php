<?php
// classes/KaryawanMagang.php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    // Properti tambahan khusus Karyawan Magang
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->uangSakuBulanan = $data['uang_saku_bulanan'] ?? 0;
        $this->sertifikatKampusMerdeka = $data['sertifikat_kampus_merdeka'] ?? 'Tidak tersedia';
    }

    // Getter untuk properti tambahan
    public function getUangSakuBulanan() {
        return $this->uangSakuBulanan;
    }

    public function getSertifikatKampusMerdeka() {
        return $this->sertifikatKampusMerdeka;
    }

    // Implementasi method abstract hitungGajiBersih()
    // Magang: Gaji Bersih = uang_saku_bulanan (langsung dari atribut)
    public function hitungGajiBersih() {
        return $this->uangSakuBulanan;
    }

    // Implementasi method abstract tampilkanProfilKaryawan()
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
}
?>