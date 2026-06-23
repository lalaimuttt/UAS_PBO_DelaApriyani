<?php
// classes/KaryawanKontrak.php

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    // Properti tambahan khusus Karyawan Kontrak
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->durasiKontrakBulan = $data['durasi_kontrak_bulan'] ?? 0;
        $this->agensiPenyalur = $data['agensi_penyalur'] ?? 'Tidak tersedia';
    }

    // Getter untuk properti tambahan
    public function getDurasiKontrakBulan() {
        return $this->durasiKontrakBulan;
    }

    public function getAgensiPenyalur() {
        return $this->agensiPenyalur;
    }

    // Implementasi method abstract hitungGajiBersih()
    // Kontrak: Gaji Bersih = gaji_dasar_per_hari * 22 hari (tanpa tunjangan)
    public function hitungGajiBersih() {
        return $this->gaji_dasar_per_hari * 22; // 22 hari kerja
    }

    // Implementasi method abstract tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => 'Kontrak',
            'durasi_kontrak_bulan' => $this->durasiKontrakBulan,
            'agensi_penyalur' => $this->agensiPenyalur
        ];
    }
}
?>