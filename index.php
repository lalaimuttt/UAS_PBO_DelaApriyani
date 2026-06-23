<?php
// index.php - Dashboard Manajemen Karyawan

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/koneksi.php';
require_once 'classes/Karyawan.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanMagang.php';

$db = new Koneksi();
$conn = $db->getConnection();

// Ambil data dari masing-masing class menggunakan method getAllData()
$daftarTetap = KaryawanTetap::getAllData($conn);
$daftarKontrak = KaryawanKontrak::getAllData($conn);
$daftarMagang = KaryawanMagang::getAllData($conn);

$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manajemen Karyawan</title>
    <style>
        /* ===== RESET & BASE ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px;
            background: #1a0a0a;
            position: relative;
            overflow-x: hidden;
        }

        /* ===== BACKGROUND NAMA "DELA APRIYANI" ===== */
        body::before {
            content: "DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI DELA APRIYANI";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 80px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.03);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            z-index: -1;
            pointer-events: none;
            letter-spacing: 15px;
            line-height: 1.5;
            transform: rotate(-10deg) scale(1.3);
            white-space: pre-wrap;
            word-break: break-all;
            padding: 50px;
            text-shadow: 0 0 50px rgba(255, 182, 193, 0.05);
        }

        /* ===== BACKGROUND GRADASI PASTEL ===== */
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 50%, rgba(255, 182, 193, 0.10) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 50%, rgba(144, 238, 144, 0.08) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 80%, rgba(173, 216, 230, 0.08) 0%, transparent 50%);
            z-index: -1;
            pointer-events: none;
            animation: glowPulse 10s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.8; }
            50% { transform: scale(1.2) rotate(5deg); opacity: 1; }
        }

        /* ===== CONTAINER ===== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            padding: 30px 20px;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffb6c1, #98d8c8, #87ceeb);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
            letter-spacing: 2px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
            margin-top: 10px;
            letter-spacing: 5px;
        }

        .header .subtitle {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* ===== STATISTIK ===== */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-card .number {
            font-size: 2.5rem;
            font-weight: 700;
            display: block;
        }

        .stat-card .label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
            margin-top: 5px;
        }

        .stat-card.tetap {
            background: linear-gradient(135deg, rgba(152, 216, 200, 0.15), rgba(152, 216, 200, 0.05));
            border-color: rgba(152, 216, 200, 0.2);
        }
        .stat-card.tetap .number { color: #98d8c8; }

        .stat-card.kontrak {
            background: linear-gradient(135deg, rgba(255, 182, 193, 0.15), rgba(255, 182, 193, 0.05));
            border-color: rgba(255, 182, 193, 0.2);
        }
        .stat-card.kontrak .number { color: #ffb6c1; }

        .stat-card.magang {
            background: linear-gradient(135deg, rgba(135, 206, 235, 0.15), rgba(135, 206, 235, 0.05));
            border-color: rgba(135, 206, 235, 0.2);
        }
        .stat-card.magang .number { color: #87ceeb; }

        /* ===== SECTION KATEGORI ===== */
        .section {
            margin-bottom: 50px;
            padding: 25px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.02);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.05);
        }

        .section-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
        }

        .section-header .badge {
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .section-tetap .section-header h2 { color: #98d8c8; }
        .section-tetap .badge { background: rgba(152, 216, 200, 0.2); color: #98d8c8; }

        .section-kontrak .section-header h2 { color: #ffb6c1; }
        .section-kontrak .badge { background: rgba(255, 182, 193, 0.2); color: #ffb6c1; }

        .section-magang .section-header h2 { color: #87ceeb; }
        .section-magang .badge { background: rgba(135, 206, 235, 0.2); color: #87ceeb; }

        /* ===== GRID KARYAWAN ===== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        /* ===== CARD KARYAWAN ===== */
        .card {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 15px;
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .card .nama {
            font-size: 1.2rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 12px;
        }

        .card .nama .id {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.3);
            font-weight: 400;
            margin-left: 8px;
        }

        .card .info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 15px;
            margin: 12px 0;
        }

        .card .info-item {
            display: flex;
            flex-direction: column;
        }

        .card .info-item .label {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card .info-item .value {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .card .fasilitas {
            margin: 12px 0;
            padding: 12px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .card .fasilitas .label {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: block;
            margin-bottom: 5px;
        }

        .card .fasilitas .value {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .card .gaji {
            margin-top: 15px;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-weight: 700;
            font-size: 1.3rem;
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .card .gaji .label {
            display: block;
            font-size: 0.7rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }

        /* Warna gaji per kategori */
        .card-tetap .gaji {
            background: rgba(152, 216, 200, 0.10);
            border-color: rgba(152, 216, 200, 0.15);
            color: #98d8c8;
        }

        .card-kontrak .gaji {
            background: rgba(255, 182, 193, 0.10);
            border-color: rgba(255, 182, 193, 0.15);
            color: #ffb6c1;
        }

        .card-magang .gaji {
            background: rgba(135, 206, 235, 0.10);
            border-color: rgba(135, 206, 235, 0.15);
            color: #87ceeb;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.8rem;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .card .info {
                grid-template-columns: 1fr;
            }

            body::before {
                font-size: 40px;
                transform: rotate(-5deg) scale(1.2);
                letter-spacing: 8px;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.4rem;
            }

            .section-header h2 {
                font-size: 1.3rem;
            }

            .card {
                padding: 15px;
            }

            body::before {
                font-size: 25px;
                letter-spacing: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- ===== HEADER ===== -->
        <div class="header">
            <h1>🎀 Dashboard Manajemen Karyawan 🎀</h1>
            <p>PT. DELA APRIYANI GROUP</p>
            <span class="subtitle">Slip Gaji &amp; Informasi Karyawan</span>
        </div>

        <!-- ===== STATISTIK ===== -->
        <div class="stats">
            <div class="stat-card tetap">
                <span class="number"><?= count($daftarTetap) ?></span>
                <span class="label">👔 Karyawan Tetap</span>
            </div>
            <div class="stat-card kontrak">
                <span class="number"><?= count($daftarKontrak) ?></span>
                <span class="label">📄 Karyawan Kontrak</span>
            </div>
            <div class="stat-card magang">
                <span class="number"><?= count($daftarMagang) ?></span>
                <span class="label">🎓 Karyawan Magang</span>
            </div>
        </div>

        <!-- ===== KARYAWAN TETAP ===== -->
        <div class="section section-tetap section-tetap">
            <div class="section-header">
                <h2>👔 Karyawan Tetap</h2>
                <span class="badge"><?= count($daftarTetap) ?> orang</span>
            </div>
            <div class="grid">
                <?php foreach ($daftarTetap as $karyawan): ?>
                <?php $profil = $karyawan->tampilkanProfilKaryawan(); ?>
                <div class="card card-tetap">
                    <div class="nama">
                        <?= htmlspecialchars($profil['nama_karyawan']) ?>
                        <span class="id">#<?= $profil['id_karyawan'] ?></span>
                    </div>
                    <div class="info">
                        <div class="info-item">
                            <span class="label">Departemen</span>
                            <span class="value"><?= htmlspecialchars($profil['departemen']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Tanggal Masuk</span>
                            <span class="value"><?= date('d/m/Y', strtotime($profil['hari_kerja_masuk'])) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Gaji Dasar / Hari</span>
                            <span class="value">Rp <?= number_format($profil['gaji_dasar_per_hari'], 0, ',', '.') ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Status</span>
                            <span class="value" style="color: #98d8c8;">Tetap</span>
                        </div>
                    </div>
                    <div class="fasilitas">
                        <span class="label">🎁 Fasilitas</span>
                        <span class="value">💊 Tunjangan Kesehatan: Rp <?= number_format($profil['tunjangan_kesehatan'], 0, ',', '.') ?></span>
                        <br>
                        <span class="value">📈 Opsi Saham ID: <?= htmlspecialchars($profil['opsi_saham_id']) ?></span>
                    </div>
                    <div class="gaji">
                        <span class="label">💰 Gaji Bersih</span>
                        Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ===== KARYAWAN KONTRAK ===== -->
        <div class="section section-kontrak">
            <div class="section-header">
                <h2>📄 Karyawan Kontrak</h2>
                <span class="badge"><?= count($daftarKontrak) ?> orang</span>
            </div>
            <div class="grid">
                <?php foreach ($daftarKontrak as $karyawan): ?>
                <?php $profil = $karyawan->tampilkanProfilKaryawan(); ?>
                <div class="card card-kontrak">
                    <div class="nama">
                        <?= htmlspecialchars($profil['nama_karyawan']) ?>
                        <span class="id">#<?= $profil['id_karyawan'] ?></span>
                    </div>
                    <div class="info">
                        <div class="info-item">
                            <span class="label">Departemen</span>
                            <span class="value"><?= htmlspecialchars($profil['departemen']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Tanggal Masuk</span>
                            <span class="value"><?= date('d/m/Y', strtotime($profil['hari_kerja_masuk'])) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Gaji Dasar / Hari</span>
                            <span class="value">Rp <?= number_format($profil['gaji_dasar_per_hari'], 0, ',', '.') ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Status</span>
                            <span class="value" style="color: #ffb6c1;">Kontrak</span>
                        </div>
                    </div>
                    <div class="fasilitas">
                        <span class="label">📋 Informasi Kontrak</span>
                        <span class="value">📅 Durasi: <?= $profil['durasi_kontrak_bulan'] ?> bulan</span>
                        <br>
                        <span class="value">🏢 Agensi: <?= htmlspecialchars($profil['agensi_penyalur']) ?></span>
                    </div>
                    <div class="gaji">
                        <span class="label">💰 Gaji Bersih</span>
                        Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ===== KARYAWAN MAGANG ===== -->
        <div class="section section-magang">
            <div class="section-header">
                <h2>🎓 Karyawan Magang</h2>
                <span class="badge"><?= count($daftarMagang) ?> orang</span>
            </div>
            <div class="grid">
                <?php foreach ($daftarMagang as $karyawan): ?>
                <?php $profil = $karyawan->tampilkanProfilKaryawan(); ?>
                <div class="card card-magang">
                    <div class="nama">
                        <?= htmlspecialchars($profil['nama_karyawan']) ?>
                        <span class="id">#<?= $profil['id_karyawan'] ?></span>
                    </div>
                    <div class="info">
                        <div class="info-item">
                            <span class="label">Departemen</span>
                            <span class="value"><?= htmlspecialchars($profil['departemen']) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Tanggal Masuk</span>
                            <span class="value"><?= date('d/m/Y', strtotime($profil['hari_kerja_masuk'])) ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Gaji Dasar / Hari</span>
                            <span class="value">Rp <?= number_format($profil['gaji_dasar_per_hari'], 0, ',', '.') ?></span>
                        </div>
                        <div class="info-item">
                            <span class="label">Status</span>
                            <span class="value" style="color: #87ceeb;">Magang</span>
                        </div>
                    </div>
                    <div class="fasilitas">
                        <span class="label">🎓 Informasi Magang</span>
                        <span class="value">💵 Uang Saku: Rp <?= number_format($profil['uang_saku_bulanan'], 0, ',', '.') ?></span>
                        <br>
                        <span class="value">📜 Sertifikat: <?= htmlspecialchars($profil['sertifikat_kampus_merdeka']) ?></span>
                    </div>
                    <div class="gaji">
                        <span class="label">💰 Gaji Bersih</span>
                        Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ===== FOOTER ===== -->
        <div style="text-align: center; padding: 30px 0 10px; color: rgba(255,255,255,0.15); font-size: 0.8rem; letter-spacing: 3px; border-top: 1px solid rgba(255,255,255,0.03); margin-top: 20px;">
            © 2026 PT. DELA APRIYANI GROUP • Sistem Manajemen Karyawan
        </div>
    </div>
</body>
</html>