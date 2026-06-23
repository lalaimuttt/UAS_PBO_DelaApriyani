<?php
// classes/KaryawanTetap.php

require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Properti tambahan khusus Karyawan Tetap
    private $tunjanganKesehatan;
    private $opsiSahamId;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->tunjanganKesehatan = $data['tunjangan_kesehatan'] ?? 0;
        $this->opsiSahamId = $data['opsi_saham_id'] ?? 'Tidak tersedia';
    }

    // Getter untuk properti tambahan
    public function getTunjanganKesehatan() {
        return $this->tunjanganKesehatan;
    }

    public function getOpsiSahamId() {
        return $this->opsiSahamId;
    }

    // Implementasi method abstract hitungGajiBersih()
    // Tetap: Gaji Bersih = (gaji_dasar_per_hari * 22 hari) + tunjanganKesehatan
    public function hitungGajiBersih() {
        $gajiPokok = $this->gaji_dasar_per_hari * 22; // 22 hari kerja
        return $gajiPokok + $this->tunjanganKesehatan;
    }

    // Implementasi method abstract tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        return [
            'id_karyawan' => $this->id_karyawan,
            'nama_karyawan' => $this->nama_karyawan,
            'departemen' => $this->departemen,
            'hari_kerja_masuk' => $this->hari_kerja_masuk,
            'gaji_dasar_per_hari' => $this->gaji_dasar_per_hari,
            'jenis_karyawan' => 'Tetap',
            'tunjangan_kesehatan' => $this->tunjanganKesehatan,
            'opsi_saham_id' => $this->opsiSahamId
        ];
    }
}
?>