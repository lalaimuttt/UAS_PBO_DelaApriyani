<?php
// classes/Karyawan.php - OOP Murni (Tanpa Getter/Setter)

abstract class Karyawan {
    // Properti terenkapsulasi (protected) - Hanya bisa diakses oleh class turunan
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;

    // Constructor
    public function __construct($data) {
        $this->id_karyawan = $data['id_karyawan'] ?? null;
        $this->nama_karyawan = $data['nama_karyawan'] ?? '';
        $this->departemen = $data['departemen'] ?? '';
        $this->hari_kerja_masuk = $data['hari_kerja_masuk'] ?? '';
        $this->gaji_dasar_per_hari = $data['gaji_dasar_per_hari'] ?? 0;
    }

    // Abstract methods (WAJIB diimplementasikan oleh subclass)
    abstract public function hitungGajiBersih();
    abstract public function tampilkanProfilKaryawan();
}
?>