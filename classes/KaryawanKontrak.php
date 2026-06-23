<?php
// classes/KaryawanKontrak.php

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    public function __construct($data) {
        parent::__construct($data);
        $this->durasiKontrakBulan = $data['durasi_kontrak_bulan'] ?? 0;
        $this->agensiPenyalur = $data['agensi_penyalur'] ?? 'Tidak tersedia';
    }

    public function getDurasiKontrakBulan() {
        return $this->durasiKontrakBulan;
    }

    public function getAgensiPenyalur() {
        return $this->agensiPenyalur;
    }

    // ✅ OVERRIDE: hariKerja × gajiDasar (murni)
    public function hitungGajiBersih() {
        $tanggalMasuk = new DateTime($this->hari_kerja_masuk);
        $sekarang = new DateTime();
        $selisih = $tanggalMasuk->diff($sekarang);
        $hariKerja = $selisih->days;
        
        return $hariKerja * $this->gaji_dasar_per_hari;
    }

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

    // ✅ SELECT * FROM + WHERE khusus karyawan kontrak
    public static function getAllData($conn) {
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Kontrak'";
        $result = $conn->query($query);
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = new self($row);
        }
        return $data;
    }
}
?>