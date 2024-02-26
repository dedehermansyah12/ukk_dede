-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2024 pada 16.12
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brary`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `cover` varchar(255) NOT NULL,
  `id_buku` varchar(25) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `thn_terbit` date NOT NULL,
  `jml_halaman` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `isi_buku` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`cover`, `id_buku`, `kategori`, `judul`, `pengarang`, `penerbit`, `thn_terbit`, `jml_halaman`, `deskripsi`, `isi_buku`) VALUES
('65cb02d225fdf.png', 'KB0004', 'novel', 'si juki', 'betta', 'betta', '2024-02-13', 100, 'jukii', 'Si Juki Komik Strip (Faza Meonk) (z-lib.org).pdf'),
('65cb037bcb884.png', 'KB0005', 'bisnis', 'dunia', 'betta', 'betta', '2024-02-13', 10, 'wkwk', 'Sejarah Dunia yang Disembunyikan (Jonathan Black) (z-lib.org).pdf'),
('65cb062613537.png', 'KB0008', 'filsafat', 'onepiece', 'betta', 'betta', '2024-02-13', 10, 'wwkwkw', '[Meganebuk] OP Vol.01.pdf'),
('65d60e1089e5f.png', 'KB0009', 'novel', 'onepiece vol.2', 'oda', 'gramed', '2024-02-19', 100, 'anime', '[Meganebuk] OP Vol.01.pdf'),
('65d96753b1f22.png', 'KB0010', 'filsafat', 'sebuah seni untuk bersifat bodoamat', 'dr.richart', 'gramedia', '2024-01-30', 10001, 'ilmu yang mengajarkan cara bodamat terhadap suatu hal', 'Sebuah Seni untuk Bersikap Bodo Amat (Mark Manson) (z-lib.org).pdf'),
('65d9674306d1c.png', 'KB0011', 'filsafat', 'rich dad poor dad', 'prof subita', 'gramedia', '2024-02-03', 200, 'how to be rich dad', 'Rich Dad Poor Dad (Robert T. Kiyosaki) (z-lib.org).pdf'),
('65db572ccb7d4.png', 'KB0012', 'anime', 'waspada rabies', 'dede', 'gramedia', '2024-02-25', 100, 'dede', 'waspada rabies.pdf'),
('65db57c431d35.png', 'KB0013', 'bisnis', 'komik sejarah dan nilai budaya ', 'oda', 'gramed', '2024-02-25', 120, 'adi', 'Komik sejarah dan nilai budaya vol 1.pdf'),
('65db5846d4ace.png', 'KB0014', 'filsafat', 'funtactik 400', 'adi', 'rama', '2024-02-25', 130, 'rama', 'Funtastic_400_Komik_Pendidikan.pdf'),
('65db58a53eb74.png', 'KB0015', 'novel', 'komik  keluarga', 'beta', 'adi', '2024-02-25', 140, 'adi', 'komik-keluarga.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori`) VALUES
('anime'),
('bisnis'),
('filsafat'),
('novel'),
('sains');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `nisn` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`nisn`, `nama`, `password`, `kelas`, `jurusan`, `alamat`) VALUES
(22, 'palpal', '2121', 'XI', 'Multi Media', 'bogor'),
(234, 'dede1', '123', 'XI', 'Rekayasa Perangkat Lunak', 's'),
(2024, 'bettaa', '2024', 'XI', 'Multi Media', 'sukatani'),
(2123, 'jeno', '000', 'XI', 'Multi Media', 'ppp'),
(5555, 'dede', '5555', 'X', 'BDP', 'sukatani'),
(101010, 'renjun', '098', 'XII', 'BDP', 'tapos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `nisn` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `harga` varchar(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_buku`, `nisn`, `id_user`, `tgl_pinjam`, `tgl_kembali`, `harga`, `status`) VALUES
(4, 'KB0011', 101010, 25, '2024-02-24', '2024-02-29', 'Lunas', 3),
(5, 'KB0011', 2123, 25, '2024-02-25', '2024-03-01', 'Lunas', 3),
(6, 'KB0010', 2123, 25, '2024-02-25', '2024-02-26', 'Lunas', 3),
(7, 'KB0009', 2123, 25, '2024-02-25', '2024-03-03', 'Lunas', 3),
(8, 'KB0004', 2123, 25, '2024-02-25', '2024-03-03', 'Lunas', 3),
(9, 'KB0011', 2123, 25, '2024-02-25', '2024-03-03', 'Rp. 6.300', 0),
(10, 'KB0004', 2123, 25, '2024-02-25', '2024-03-06', 'Rp. 8.000', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `sebagai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `telp`, `sebagai`) VALUES
(24, 'bettaa', '123', '08997658576', 'admin'),
(25, 'betta', '123', '086854778', 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nis` (`nisn`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `nisn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101011;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_buku` (`kategori`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `member` (`nisn`),
  ADD CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
