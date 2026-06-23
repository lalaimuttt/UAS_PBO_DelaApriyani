<?php
// classes/KaryawanTetap.php

require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjanganKesehatan;
    private $opsiSahamId;

    public function __construct($data) {
        parent::__construct($data);
        $this->tunjanganKesehatan = $data['tunjangan_kesehatan'] ?? 0;
        $this->opsiSahamId = $data['opsi_saham_id'] ?? 'Tidak tersedia';
    }

    public function getTunjanganKesehatan() {
        return $this->tunjanganKesehatan;
    }

    public function getOpsiSahamId() {
        return $this->opsiSahamId;
    }

    // ✅ OVERRIDE: (hariKerja × gajiDasar) + tunjanganKesehatan
    public function hitungGajiBersih() {
        $tanggalMasuk = new DateTime($this->hari_kerja_masuk);
        $sekarang = new DateTime();
        $selisih = $tanggalMasuk->diff($sekarang);
        $hariKerja = $selisih->days;
        
        $gajiPokok = $hariKerja * $this->gaji_dasar_per_hari;
        return $gajiPokok + $this->tunjanganKesehatan;
    }

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

    // ✅ SELECT * FROM + WHERE khusus karyawan tetap
    public static function getAllData($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Tetap'";
        $result = $conn->query($query);
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = new self($row);
        }
        return $data;
    }
}
?>