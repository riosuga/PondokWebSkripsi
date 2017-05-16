-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Mei 2017 pada 15.26
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arridho`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_bayanat`
--

CREATE TABLE `td_bayanat` (
  `id_bayanat` int(6) NOT NULL,
  `tgl_ujian` date NOT NULL,
  `id_santri_nilai` int(11) NOT NULL,
  `nomor` int(4) NOT NULL,
  `tgl_remed` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_bayanat`
--

INSERT INTO `td_bayanat` (`id_bayanat`, `tgl_ujian`, `id_santri_nilai`, `nomor`, `tgl_remed`) VALUES
(5, '2017-05-16', 5, 21, '0000-00-00'),
(7, '2017-05-16', 7, 71, '2017-05-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_guru`
--

CREATE TABLE `td_guru` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kelamin` enum('L','P') COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` longtext CHARACTER SET latin1,
  `no_hp` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_guru`
--

INSERT INTO `td_guru` (`id_guru`, `nip`, `nama`, `nama_ar`, `kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_hp`, `email`) VALUES
(4, '1701001', 'Hadi Wijaya', '-', 'L', 'Malang', '1978-05-11', 'Jl. Danau Bratan', '085781214696', 'hadi_wijaya@gmail.com'),
(5, '1701002', 'Sabar Riyadi', 'المريض', 'L', 'Pandeglang', '1989-03-02', 'Jl. Selamat Sentosa Nomor, 21', '081454687100', 'sabar_sabarNgetz@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_guru_kompentensi`
--

CREATE TABLE `td_guru_kompentensi` (
  `id_kompetensi` int(6) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_pelajaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_guru_kompentensi`
--

INSERT INTO `td_guru_kompentensi` (`id_kompetensi`, `id_guru`, `id_pelajaran`) VALUES
(1, 4, 1),
(2, 5, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_kelas_ta`
--

CREATE TABLE `td_kelas_ta` (
  `id_ta` int(11) NOT NULL,
  `tahun` year(4) DEFAULT NULL,
  `semester` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_kelas` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_kelas_ta`
--

INSERT INTO `td_kelas_ta` (`id_ta`, `tahun`, `semester`, `id_kelas`, `id_guru`) VALUES
(4, 2017, '1', '1', 4),
(5, 2017, '2', '1', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_santri`
--

CREATE TABLE `td_santri` (
  `id_santri` int(11) NOT NULL,
  `nis` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nisn` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `kelamin` enum('L','P') COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ar` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tempat_lahir` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_awal` date NOT NULL,
  `daerah` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `daerah_ar` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `nama_ayah` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_hp_ayah` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` longtext CHARACTER SET latin1,
  `no_hp_ibu` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_santri`
--

INSERT INTO `td_santri` (`id_santri`, `nis`, `nisn`, `nama`, `kelamin`, `nama_ar`, `tempat_lahir`, `tgl_lahir`, `tgl_awal`, `daerah`, `daerah_ar`, `tgl_akhir`, `nama_ayah`, `no_hp_ayah`, `nama_ibu`, `alamat`, `no_hp_ibu`) VALUES
(2, '1701001', '120020211', 'Nana Nurhaliza', 'P', 'ريو سوجاريو سوجاريو سوجا', 'Jakarta', '1998-01-02', '2017-05-10', 'DKI Jakarta', 'شرق جاوة', NULL, 'Sunaryo', '081114516719', 'Siti ', 'Jl.Kebagusan, no31', '085781214696'),
(3, '1701002', '120020212', 'Muhammad  Alfian', 'L', 'ريو سوجاريو سوجا', 'Bandung', '1998-03-16', '2017-05-10', 'Jawa Barat', 'شرق جاوة', NULL, 'Budi Kurniawan', '081114516722', 'Rina Azizah', 'jl.Anggrek no 44', '085781214666'),
(4, '1701003', '120020213', 'Rio Suga Catra Pratama', 'L', 'ريو سوجا', 'Jombang', '1998-04-18', '2017-05-10', 'Jawa Timur', 'شرق جاوة', NULL, 'Agung', '081114516441', 'Ratnadilla', 'jl. Oke Oce no 31, ', '085781214784');

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_santri_kelas`
--

CREATE TABLE `td_santri_kelas` (
  `id_santri_kelas` int(11) NOT NULL,
  `id_ta` int(11) DEFAULT NULL,
  `id_santri` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_santri_kelas`
--

INSERT INTO `td_santri_kelas` (`id_santri_kelas`, `id_ta`, `id_santri`) VALUES
(1, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_santri_nilai`
--

CREATE TABLE `td_santri_nilai` (
  `id_santri_nilai` int(11) NOT NULL,
  `id_santri_pelajaran` int(11) DEFAULT NULL,
  `id_nilai` int(3) DEFAULT NULL,
  `nilai_awal` float DEFAULT NULL,
  `nilai_remed` float DEFAULT NULL,
  `nilai_akhir` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_santri_nilai`
--

INSERT INTO `td_santri_nilai` (`id_santri_nilai`, `id_santri_pelajaran`, `id_nilai`, `nilai_awal`, `nilai_remed`, `nilai_akhir`) VALUES
(5, 5, 2, 80, 0, 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_santri_pelajaran`
--

CREATE TABLE `td_santri_pelajaran` (
  `id_santri_pelajaran` int(11) NOT NULL,
  `id_pelajaran` int(3) DEFAULT NULL,
  `id_santri_kelas` int(11) DEFAULT NULL,
  `id_guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `td_santri_pelajaran`
--

INSERT INTO `td_santri_pelajaran` (`id_santri_pelajaran`, `id_pelajaran`, `id_santri_kelas`, `id_guru`) VALUES
(5, 1, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `td_santri_rapot`
--

CREATE TABLE `td_santri_rapot` (
  `id_santri_rapot` int(11) NOT NULL DEFAULT '0',
  `id_santri_pelajaran` int(11) DEFAULT NULL,
  `nilai_awal` float DEFAULT NULL,
  `nilai_akhir` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_kelas`
--

CREATE TABLE `tr_kelas` (
  `id_kelas` int(4) NOT NULL,
  `nama_kelas` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kelas_ar` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `kapasitas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tr_kelas`
--

INSERT INTO `tr_kelas` (`id_kelas`, `nama_kelas`, `nama_kelas_ar`, `kapasitas`) VALUES
(1, 'Kelas A-1', '-', 35),
(2, 'Kelas A-2', '-', 35),
(3, 'Kelas A-3', '-', 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_kkm`
--

CREATE TABLE `tr_kkm` (
  `id_kkm` int(3) NOT NULL,
  `nilai` float NOT NULL,
  `id_ta` int(3) NOT NULL,
  `id_pelajaran` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tr_kkm`
--

INSERT INTO `tr_kkm` (`id_kkm`, `nilai`, `id_ta`, `id_pelajaran`) VALUES
(1, 75, 4, 1),
(2, 75, 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_nilai`
--

CREATE TABLE `tr_nilai` (
  `id_nilai` int(3) NOT NULL,
  `uraian` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uraian_ar` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bobot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `tr_nilai`
--

INSERT INTO `tr_nilai` (`id_nilai`, `uraian`, `uraian_ar`, `bobot`) VALUES
(2, 'Ulangan harian', '-', 15),
(3, 'Ujian Praktek', '-', 25),
(4, 'Ujian Semester', '-', 50),
(5, 'Ahlak', '-', 15),
(6, 'Remidi', '-', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pelajaran`
--

CREATE TABLE `tr_pelajaran` (
  `id_pelajaran` int(3) NOT NULL,
  `uraian` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `uraian_en` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uraian_ar` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tabel referensi daftar pelajaran';

--
-- Dumping data untuk tabel `tr_pelajaran`
--

INSERT INTO `tr_pelajaran` (`id_pelajaran`, `uraian`, `uraian_en`, `uraian_ar`) VALUES
(1, 'Fisika', 'Psyhic', 'Psyhic on Arab'),
(2, 'Matematika', 'Math', '-'),
(3, 'Mengaji', 'Reading Holy Quran', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_bayanat`
--
ALTER TABLE `td_bayanat`
  ADD PRIMARY KEY (`id_bayanat`);

--
-- Indexes for table `td_guru`
--
ALTER TABLE `td_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `td_guru_kompentensi`
--
ALTER TABLE `td_guru_kompentensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indexes for table `td_kelas_ta`
--
ALTER TABLE `td_kelas_ta`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `td_santri`
--
ALTER TABLE `td_santri`
  ADD PRIMARY KEY (`id_santri`);

--
-- Indexes for table `td_santri_kelas`
--
ALTER TABLE `td_santri_kelas`
  ADD PRIMARY KEY (`id_santri_kelas`);

--
-- Indexes for table `td_santri_nilai`
--
ALTER TABLE `td_santri_nilai`
  ADD PRIMARY KEY (`id_santri_nilai`);

--
-- Indexes for table `td_santri_pelajaran`
--
ALTER TABLE `td_santri_pelajaran`
  ADD PRIMARY KEY (`id_santri_pelajaran`);

--
-- Indexes for table `td_santri_rapot`
--
ALTER TABLE `td_santri_rapot`
  ADD PRIMARY KEY (`id_santri_rapot`);

--
-- Indexes for table `tr_kelas`
--
ALTER TABLE `tr_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tr_kkm`
--
ALTER TABLE `tr_kkm`
  ADD PRIMARY KEY (`id_kkm`);

--
-- Indexes for table `tr_nilai`
--
ALTER TABLE `tr_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tr_pelajaran`
--
ALTER TABLE `tr_pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_bayanat`
--
ALTER TABLE `td_bayanat`
  MODIFY `id_bayanat` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `td_guru`
--
ALTER TABLE `td_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `td_guru_kompentensi`
--
ALTER TABLE `td_guru_kompentensi`
  MODIFY `id_kompetensi` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `td_kelas_ta`
--
ALTER TABLE `td_kelas_ta`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `td_santri`
--
ALTER TABLE `td_santri`
  MODIFY `id_santri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `td_santri_kelas`
--
ALTER TABLE `td_santri_kelas`
  MODIFY `id_santri_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `td_santri_nilai`
--
ALTER TABLE `td_santri_nilai`
  MODIFY `id_santri_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `td_santri_pelajaran`
--
ALTER TABLE `td_santri_pelajaran`
  MODIFY `id_santri_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tr_kelas`
--
ALTER TABLE `tr_kelas`
  MODIFY `id_kelas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr_kkm`
--
ALTER TABLE `tr_kkm`
  MODIFY `id_kkm` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tr_nilai`
--
ALTER TABLE `tr_nilai`
  MODIFY `id_nilai` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tr_pelajaran`
--
ALTER TABLE `tr_pelajaran`
  MODIFY `id_pelajaran` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
