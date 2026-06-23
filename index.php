<?php
// index.php - Dashboard Manajemen Karyawan (Versi Cerah)

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/koneksi.php';
require_once 'classes/Karyawan.php';
require_once 'classes/KaryawanTetap.php';
require_once 'classes/KaryawanKontrak.php';
require_once 'classes/KaryawanMagang.php';

$db = new Koneksi();
$conn = $db->getConnection();

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
            background: #f0f4f8;
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
            color: rgba(200, 180, 255, 0.06);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            z-index: 0;
            pointer-events: none;
            letter-spacing: 15px;
            line-height: 1.5;
            transform: rotate(-10deg) scale(1.3);
            white-space: pre-wrap;
            word-break: break-all;
            padding: 50px;
        }

        /* ===== BACKGROUND GRADASI PASTEL CERAH ===== */
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 20% 30%, rgba(255, 182, 193, 0.25) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 70%, rgba(144, 238, 144, 0.20) 0%, transparent 50%),
                        radial-gradient(ellipse at 50% 90%, rgba(173, 216, 230, 0.20) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
            animation: glowPulse 12s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.8; }
            50% { transform: scale(1.1) rotate(3deg); opacity: 1; }
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
            padding: 35px 20px;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.70);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(100, 100, 150, 0.08);
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #f8a4b8, #7ecfc0, #7fc9e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 2px;
        }

        .header p {
            color: #7a7a9a;
            font-size: 1.1rem;
            margin-top: 8px;
            letter-spacing: 5px;
            font-weight: 500;
        }

        .header .subtitle {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 25px;
            background: rgba(200, 180, 255, 0.15);
            border-radius: 20px;
            color: #8a7aaa;
            font-size: 0.85rem;
            border: 1px solid rgba(200, 180, 255, 0.15);
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
            border-radius: 18px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(100, 100, 150, 0.06);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(100, 100, 150, 0.12);
        }

        .stat-card .number {
            font-size: 2.8rem;
            font-weight: 700;
            display: block;
        }

        .stat-card .label {
            font-size: 0.9rem;
            color: #8a8aaa;
            margin-top: 5px;
            font-weight: 500;
        }

        .stat-card.tetap {
            background: linear-gradient(135deg, rgba(126, 207, 192, 0.20), rgba(126, 207, 192, 0.08));
            border-color: rgba(126, 207, 192, 0.30);
        }
        .stat-card.tetap .number { color: #5bb5a8; }

        .stat-card.kontrak {
            background: linear-gradient(135deg, rgba(248, 164, 184, 0.20), rgba(248, 164, 184, 0.08));
            border-color: rgba(248, 164, 184, 0.30);
        }
        .stat-card.kontrak .number { color: #e88a9e; }

        .stat-card.magang {
            background: linear-gradient(135deg, rgba(127, 201, 232, 0.20), rgba(127, 201, 232, 0.08));
            border-color: rgba(127, 201, 232, 0.30);
        }
        .stat-card.magang .number { color: #5aa9c9; }

        /* ===== SECTION KATEGORI ===== */
        .section {
            margin-bottom: 50px;
            padding: 25px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.40);
            box-shadow: 0 4px 20px rgba(100, 100, 150, 0.04);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(100, 100, 150, 0.08);
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

        .section-tetap .section-header h2 { color: #5bb5a8; }
        .section-tetap .badge { background: rgba(126, 207, 192, 0.20); color: #5bb5a8; }

        .section-kontrak .section-header h2 { color: #e88a9e; }
        .section-kontrak .badge { background: rgba(248, 164, 184, 0.20); color: #e88a9e; }

        .section-magang .section-header h2 { color: #5aa9c9; }
        .section-magang .badge { background: rgba(127, 201, 232, 0.20); color: #5aa9c9; }

        /* ===== GRID KARYAWAN ===== */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        /* ===== CARD KARYAWAN ===== */
        .card {
            background: rgba(255, 255, 255, 0.80);
            border-radius: 16px;
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 16px rgba(100, 100, 150, 0.05);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(100, 100, 150, 0.10);
            border-color: rgba(200, 180, 255, 0.2);
        }

        .card .nama {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2a2a4a;
            margin-bottom: 12px;
        }

        .card .nama .id {
            font-size: 0.75rem;
            color: #aaaac0;
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
            font-size: 0.65rem;
            color: #aaaac0;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .card .info-item .value {
            font-size: 0.95rem;
            color: #3a3a5a;
            font-weight: 500;
        }

        .card .fasilitas {
            margin: 12px 0;
            padding: 12px 14px;
            background: rgba(200, 180, 255, 0.06);
            border-radius: 10px;
            border: 1px solid rgba(200, 180, 255, 0.08);
        }

        .card .fasilitas .label {
            font-size: 0.65rem;
            color: #aaaac0;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }

        .card .fasilitas .value {
            font-size: 0.9rem;
            color: #4a4a6a;
        }

        .card .gaji {
            margin-top: 15px;
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            font-size: 1.3rem;
            border: 1px solid rgba(200, 180, 255, 0.10);
        }

        .card .gaji .label {
            display: block;
            font-size: 0.65rem;
            font-weight: 600;
            color: #aaaac0;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 3px;
        }

        /* Warna gaji per kategori - Lebih cerah */
        .card-tetap .gaji {
            background: rgba(126, 207, 192, 0.12);
            border-color: rgba(126, 207, 192, 0.20);
            color: #3a9a8a;
        }

        .card-kontrak .gaji {
            background: rgba(248, 164, 184, 0.12);
            border-color: rgba(248, 164, 184, 0.20);
            color: #d47a8e;
        }

        .card-magang .gaji {
            background: rgba(127, 201, 232, 0.12);
            border-color: rgba(127, 201, 232, 0.20);
            color: #3a8aaa;
        }

        .card .status-badge {
            display: inline-block;
            padding: 2px 12px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-tetap { background: rgba(126, 207, 192, 0.20); color: #3a9a8a; }
        .status-kontrak { background: rgba(248, 164, 184, 0.20); color: #d47a8e; }
        .status-magang { background: rgba(127, 201, 232, 0.20); color: #3a8aaa; }

        /* ===== FOOTER ===== */
        .footer {
            text-align: center;
            padding: 30px 0 10px;
            color: #cacae0;
            font-size: 0.8rem;
            letter-spacing: 3px;
            border-top: 1px solid rgba(100, 100, 150, 0.06);
            margin-top: 20px;
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
            <h1>🌸 Dashboard Manajemen Karyawan 🎀</h1>
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
        <div class="section section-tetap">
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
                            <span class="value"><span class="status-badge status-tetap">Tetap</span></span>
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
                            <span class="value"><span class="status-badge status-kontrak">Kontrak</span></span>
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
                            <span class="value"><span class="status-badge status-magang">Magang</span></span>
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
        <div class="footer">
            © 2026 PT. DELA APRIYANI GROUP • Sistem Manajemen Karyawan
        </div>
    </div>
</body>
</html>