-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 04:48 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmj`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `alamat`, `nohp`, `jabatan`, `email`, `password`, `foto`) VALUES
(15, 'Ica', 'Padang', '-', 'Owner', 'ee', 'ee', '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengunjung`
--

CREATE TABLE `detail_pengunjung` (
  `id_detail_pengunjung` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `pendidikan` varchar(25) NOT NULL,
  `id_produk` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pengunjung`
--

INSERT INTO `detail_pengunjung` (`id_detail_pengunjung`, `id_pengunjung`, `nama`, `alamat`, `no_hp`, `pendidikan`, `id_produk`) VALUES
(17, '12', 'Ahmad joni', 'wfsaf', '2134124', 'SD', ''),
(18, '12', 'Ahmad', 'disana', '32-4', 'TK', ''),
(19, '14', 'eHen', 'disana', '083123', 'TK', ''),
(20, '14', 'asd', 'asd', '4234', 'TK', ''),
(21, '14', 'vbdgf', 'bcxb', '34532', 'TK', ''),
(22, '3', 'czxc', 'xzczx', 'cxzczx', 'TK', ''),
(23, '3', 'wrfsefds', 'sdfsdfds', 'fsdfsd', 'TK', '');

-- --------------------------------------------------------

--
-- Table structure for table `item_tukar_poin`
--

CREATE TABLE `item_tukar_poin` (
  `id_item_tukar_poin` int(25) NOT NULL,
  `nama_item_tukar_poin` varchar(25) NOT NULL,
  `gambar` text NOT NULL,
  `keterangan` text NOT NULL,
  `poin` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_tukar_poin`
--

INSERT INTO `item_tukar_poin` (`id_item_tukar_poin`, `nama_item_tukar_poin`, `gambar`, `keterangan`, `poin`) VALUES
(1, 'Garliccheese dan free coc', '', 'Free Garliccheese dan free coca-cola 1lt', 25),
(2, 'Free Pizza MeatLovers uku', '', 'Free Pizza MeatLovers ukuran besar tanpa pinggiran\r\n', 30),
(3, 'Free Pizza apa saja ukura', '', 'Free Pizza apa saja ukuran besar pakai pinggiran \r\n', 35),
(4, 'Free BIXBOX', '', 'Free BIXBOX\r\n', 40),
(5, 'Free TRIPLE BOX', '', 'Free TRIPLE BOX\r\n', 45);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_detail_pengunjung` varchar(5) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `qty` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `nohp`, `password`) VALUES
(1, 'Ahmad', 'maransi', '081212121212', '11'),
(5, 'Wesman', 'psdnpn', 'kndcvkn', '123'),
(6, 'Ucok', 'abc@gmail.com', '098', '123'),
(7, 'Septo', 'septo@gmail.com', '018123', '');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan_keranjang`
--

CREATE TABLE `pelanggan_keranjang` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id_pengunjung` int(11) NOT NULL,
  `nama_kelompok` varchar(25) NOT NULL,
  `tgl_kunjungan` date NOT NULL DEFAULT current_timestamp(),
  `jam_kunjungan` varchar(25) NOT NULL,
  `pj` varchar(25) NOT NULL,
  `nohp_pj` varchar(25) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id_pengunjung`, `nama_kelompok`, `tgl_kunjungan`, `jam_kunjungan`, `pj`, `nohp_pj`, `id_pelanggan`, `kategori`, `status`) VALUES
(3, 'kelompok ini', '2022-06-06', '', '', '', '5', 'Kelompok', 'Booking'),
(12, 'khvjkh', '2022-05-13', '04:27', '', '', '5', 'Kelompok', 'Booking'),
(13, '', '2022-06-09', '04:31', '', '', '1', 'Pribadi', 'Booking'),
(14, 'Kelompok A', '2022-06-14', '16:50', '', '', '6', 'Kelompok', 'Selesai'),
(15, '', '2022-06-23', '07:02', '', '', '1', 'Pribadi', 'Selesai'),
(16, '', '2022-06-23', '07:07', '', '', '7', 'Pribadi', 'Selesai'),
(17, '', '2022-06-23', '07:08', '', '', '1', 'Pribadi', 'Selesai'),
(18, '', '2022-06-23', '07:09', '', '', '7', 'Pribadi', 'Selesai'),
(19, '', '2022-06-23', '07:10', '', '', '1', 'Pribadi', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_detail_pengunjung` varchar(5) NOT NULL,
  `id_produk` varchar(5) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pengunjung`, `id_detail_pengunjung`, `id_produk`, `qty`, `waktu_pesan`, `status`) VALUES
(48, '12', '18', '1', '3', '2022-06-18 00:32:43', ''),
(49, '12', '18', '2', '1', '2022-06-08 00:32:43', ''),
(51, '12', '17', '2', '6', '2022-06-01 00:32:43', ''),
(54, '14', '21', '1', '2', '2022-06-18 00:32:43', ''),
(55, '14', '21', '3', '1', '2022-06-18 00:32:43', ''),
(67, '13', '', '1', '2', '2022-06-23 03:11:52', 'Diproses'),
(68, '13', '', '2', '2', '2022-06-23 03:12:49', 'Diproses'),
(69, '13', '', '1', '2', '2022-06-23 03:32:50', 'Diproses'),
(70, '13', '', '1', '2', '2022-06-23 03:36:48', 'Diproses'),
(71, '3', '22', '1', '2', '2022-06-23 03:38:51', 'Diproses'),
(72, '3', '22', '1', '3', '2022-06-23 03:38:54', 'Diproses'),
(73, '3', '23', '1', '2', '2022-06-23 03:55:19', 'Diproses'),
(74, '3', '23', '1', '2', '2022-06-23 04:00:40', 'Diproses'),
(75, '15', '', '1', '1', '2022-06-23 05:02:44', 'Selesai'),
(76, '16', '', '1', '83', '2022-06-23 05:07:23', 'Diproses'),
(77, '17', '', '2', '1', '2022-06-23 05:08:22', ''),
(78, '18', '', '3', '3', '2022-06-23 05:09:41', 'Diproses'),
(79, '19', '', '2', '1', '2022-06-23 05:10:17', 'Selesai'),
(80, '16', '', '1', '6', '2022-07-02 00:15:48', 'Diproses'),
(81, '16', '', '1', '3', '2022-07-02 02:34:58', 'Diproses'),
(82, '19', '', '3', '2', '2022-07-02 02:39:33', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pmj`
--

CREATE TABLE `pmj` (
  `id` int(3) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pmj`
--

INSERT INTO `pmj` (`id`, `nama`, `alamat`, `nohp`, `jabatan`, `email`, `password`, `foto`) VALUES
(4, 'Ucok', 'Padang', '0811111', 'Kasir', '1111', '1111', '220510040820.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(25) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `harga` int(12) NOT NULL,
  `gambar` text NOT NULL,
  `harga_per` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `kategori_produk` varchar(25) NOT NULL,
  `poin` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `gambar`, `harga_per`, `keterangan`, `kategori_produk`, `poin`) VALUES
(1, 'PMJ +', 50000, 'phd.jpg', 'item', 'sd', 'Pizza', 10),
(2, 'PMJ BASIC ', 40000, 'phd.jpg', 'item', '', 'Paket PMJ 2', 10),
(3, 'Limi Pizza ', 249000, 'phd.jpg', 'item', 'Pizza ukuran 1 meter', 'Makanan', 10),
(4, 'My Box ', 35000, 'phd.jpg', 'item', 'Pizza dan Appataizer(paket hemat)', 'Makanan', 10),
(5, 'Triple Box', 275000, 'phd.jpg', 'item', 'Pizza ukuran medium, pizza manis dan tambahan Appataizer', 'Makanan', 10),
(6, 'Bix Box', 220000, 'phd.jpg', 'item', 'Pizza ukuran medium atau besar dan ditambah dengan Appataizer', 'Makanan', 10),
(7, 'Double Box', 166000, 'phd.jpg', 'item', 'Tanpa pinggiran ', 'Makanan', 10),
(8, 'Double Box +', 202000, 'phd.jpg', 'item', 'Pakai pinggiran ukuran medium ', 'Makanan', 10),
(9, 'Double Box ++', 270000, 'phd.jpg', 'item', 'Pakai pinggiran ukuran besar', 'Makanan', 10),
(10, 'Tuna Aglio Olio', 57000, 'phd.jpg', 'item', 'Spaghetti dan ikan tuna', 'Pasta ', 10),
(11, 'Black Pepper Chiken Fettu', 59000, 'phd.jpg', 'item', 'Fettucini dengan saus Black Pepper', 'Pasta ', 10),
(12, 'Oriental Chiken Spaghetti', 59000, 'phd.jpg', 'item', 'Spaghetti dengan saus Oriental chiken', 'Pasta ', 10),
(13, 'Creamy Beef/Chiken Fettuc', 59000, 'phd.jpg', 'item', 'Fettucini dengan saus creamy', 'Pasta ', 10),
(14, 'Beef Spaghetti', 57000, 'phd.jpg', 'item', 'Spaghetti dengan saus Meat Sauce', 'Pasta ', 10),
(15, 'Beef Lasagna', 61000, 'phd.jpg', 'item', 'Daging giling ditambah keju dan sauce', 'Pasta ', 10),
(16, 'Winter Punch ', 33000, 'phd.jpg', 'item', 'Minuman segar dengan buah lcyhee', 'Minuman', 10),
(17, 'Lcyhee Breeze', 33000, 'phd.jpg', 'item', 'Minuman segar yang ditambah lime dan buah lcyhee', 'Minuman', 10),
(18, 'Mixberry', 31000, 'phd.jpg', 'item', 'Minuman yang ditambah soda dan sirup blubbery', 'Minuman', 10),
(19, 'Topical Punch', 33000, 'phd.jpg', 'item', 'Minuman segar dengan berbagai macam buah', 'Minuman', 10),
(20, 'Orange Lcyhee Sparkle', 31000, 'phd.jpg', 'item', 'Minuman segar ditambah dengan orange juice', 'Minuman', 10),
(21, 'Blue Ocean', 31000, 'phd.jpg', 'item', 'Minuman yang ditambah dengan sirup blubbery', 'Minuman', 10),
(22, 'Watermelon ', 38000, 'phd.jpg', 'item', 'Juice dengan potongan buah semangka yang segar', 'Juice', 10),
(23, 'Melon ', 38000, 'phd.jpg', 'item', 'Juice dengan potongan buah melon yang segar', 'Juice', 10),
(24, 'Strawberry Orange', 38000, 'phd.jpg', 'item', 'Juice dengan potongan buah strawberry ', 'Juice', 10),
(25, 'Melon Peach', 38000, 'phd.jpg', 'item', 'Juice dengan potongan buah melon dan peach', 'Juice', 10),
(26, 'Avocado', 38000, 'phd.jpg', 'item', 'Juice dengan avocado yang segar', 'Juice', 10),
(27, 'Strawbery Watermelon', 38000, 'phd.jpg', 'item', 'Juice dengan potongan buah strawberry dan semangka ', 'Juice', 10),
(28, 'Green Tea Yakult', 29000, 'phd.jpg', 'item', 'Minuman green tea dengan yakult', 'Minuman', 10),
(29, 'Lchyee Spring', 29000, 'phd.jpg', 'item', 'Minuman segar dengan tambahan yakult dan buah lchyee', 'Minuman', 10),
(30, 'Toffe Coffe', 31000, 'phd.jpg', 'item', 'Minuman segar yang ditambah coffe', 'Minuman', 10),
(31, 'Green Tea', 29000, 'phd.jpg', 'item', 'Minuman yang ditambah dengan bubuk green tea', 'Minuman', 10),
(32, 'Mocha Float', 29000, 'phd.jpg', 'item', '', 'Minuman', 10),
(33, 'Chocolate Blast', 29000, 'phd.jpg', 'item', 'Minuman yang ditambah bubuk milo dan ice cream', 'Minuman', 10),
(34, 'Chocolate Milkshake', 29000, 'phd.jpg', 'item', 'Minuman dengan ice cream coklat', 'Minuman', 10),
(35, 'Vanila Milkshake', 29000, 'phd.jpg', 'item', 'Minuman dengan ice cream vanilla', 'Minuman', 10),
(36, 'Strawberry Milkshake', 29000, 'phd.jpg', 'item', 'Minuman dengan ice cream Strawberry', 'Minuman', 10),
(37, 'Aqua ', 14000, 'phd.jpg', 'item', 'Air putih mineral', 'Minuman', 10),
(38, 'Salad ', 42000, 'phd.jpg', 'item', 'Potongan beberapa sayur dan buah ', 'Salad', 10),
(39, 'Soup', 19000, 'phd.jpg', 'item', 'Soup cream dengan potongan daging ', 'Soup', 10),
(40, 'Salad dan Soup ', 51000, 'phd.jpg', 'item', '', 'Soup dan Salad', 10),
(41, 'New Orleans Chicken Wings', 43000, 'phd.jpg', 'item', 'Paha dan sayap ayam', 'Makanan', 10),
(42, 'Cheese Martabak Pizza ', 37000, 'phd.jpg', 'item', 'Pizza manis ditmbah dengan keju diatas', 'Pizza', 10),
(43, 'Chiken Royale', 41000, 'phd.jpg', 'item', '', 'Makanan', 10),
(44, 'Garlic Cheese Bread', 28000, 'phd.jpg', 'item', 'Roti panggang keju dan bawang putih', 'Makanan', 10),
(45, 'Cheese Rolls', 34000, 'phd.jpg', 'item', '', 'Makanan', 10),
(46, 'Choco Puff', 30000, 'phd.jpg', 'item', 'Makanan yang manis dengan sauce coklat', 'Makanan', 10),
(47, 'Puff Pastry Mushroom Crea', 30000, 'phd.jpg', 'item', 'Soup cream yang ditambah potongan jamur', 'Makanan', 10),
(48, 'Baked Chiken Chunks', 42000, 'phd.jpg', 'item', '', 'Makanan', 10),
(49, 'Nacho Cheese', 34000, 'phd.jpg', 'item', '', 'Makanan', 10),
(50, 'Sausage Pastry Roll', 34000, 'phd.jpg', 'item', '', 'Makanan', 10),
(51, 'Potato Wedges', 27000, 'phd.jpg', 'item', '', 'Makanan', 10),
(52, 'Deluxe Chiken Brushetta', 28000, 'phd.jpg', 'item', 'Roti yang ditambah potongan ayam', 'Makanan', 10),
(53, 'Deluxe Beef Brushetta', 28000, 'phd.jpg', 'item', 'Roti yang ditambah dengan potongan daging', 'Makanan', 10),
(54, 'Garlic Bread', 24000, 'phd.jpg', 'item', 'Roti yang di panggang dengan bawang putih', 'Makanan', 10),
(55, 'Pizza Pepperoni, Veggie G', 47000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil tanpa pingiran', 'Pizza', 10),
(56, 'Pizza Pepperoni, Veggie G', 59000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil pakai pinggiran Stuffed Crust(keju/sosis)', 'Pizza', 10),
(57, 'Pizza Pepperoni, Veggie G', 62000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil cheesybites ', 'Pizza', 10),
(58, 'Pizza Pepperoni, Veggie G', 101000, 'phd.jpg', 'item', 'Ukuran pizza yang medium tanpa pinggiran', 'Pizza', 10),
(59, 'Pizza Pepperoni, Veggie G', 119000, 'phd.jpg', 'item', 'Ukuran pizza yang medium pakai pinggira Stuffed Crust(Keju/sosis)', 'Pizza', 10),
(60, 'Pizza Pepperoni, Veggie G', 122000, 'phd.jpg', 'item', 'Ukuran pizza yang medium pakai pinggiran chessybites', 'Pizza', 10),
(61, 'Pizza Pepperoni, Veggie G', 141000, 'phd.jpg', 'item', 'Ukuran pizza yang besar tanpa pinggiran', 'Pizza', 10),
(62, 'Pizza Pepperoni, Veggie G', 210000, 'phd.jpg', 'item', 'Ukuran pizza yang besar pakai pinggiran Stuffed Crust(Keju/sosis)', 'Pizza', 10),
(63, 'Pizza Pepperoni, Veggie G', 173000, 'phd.jpg', 'item', 'Ukuran pizza yang besar pakai pinggiran cheesybites', 'Pizza', 10),
(64, 'Pizza Cheese Burger, Fran', 47000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil tanpa pinggiran ', 'Pizza', 10),
(65, 'Pizza Cheese Burger, Fran', 59000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil pakai pinggiran Stuffed Crust(keju/sosis)', 'Pizza', 10),
(66, 'Pizza Cheese Burger, Fran', 62000, 'phd.jpg', 'item', 'Ukuran pizza yang kecil pakai pinggran chessybites', 'Pizza', 10),
(67, 'Pizza Cheese Burger, Fran', 103000, 'phd.jpg', 'item', 'Ukuran pizza yang medium tanpa pinggiran', 'Pizza', 10),
(68, 'Pizza Cheese Burger, Fran', 121000, 'phd.jpg', 'item', 'Ukuran pizza yang medium pakai pinggiran Stuffed Crust(keju/sosis)', 'Pizza', 10),
(69, 'Pizza Cheese Burger, Fran', 124000, 'phd.jpg', 'item', 'Ukuran pizza yang medium pakai pinggiran chessybites', 'Pizza', 10),
(70, 'Pizza Cheese Burger, Fran', 143000, 'phd.jpg', 'item', 'Ukuran pizza yang besar tanpa pinggiran', 'Pizza', 10),
(71, 'Pizza Cheese Burger, Fran', 168000, 'phd.jpg', 'item', 'Ukuran pizza yang besar pakai pinggiran Stuffed Crust(Keju/sosis)', 'Pizza', 10),
(72, 'Pizza Cheese Burger, Fran', 175000, 'phd.jpg', 'item', 'Ukuran pizza yang besar pakai pinggiran cheesybites', 'Pizza', 10),
(73, 'Pokat matah', 400000, '220726060356.jpg', 'Kg', 'asasj', 'Juice', 0),
(74, 'asdas', 4078, '220726060419.png', 'zfasf', 'asdas', 'Juice', 0),
(75, 'czxcz', 34234, '220726060450.png', '32', 'xczxc', 'Juice', 4),
(76, 'Spageti', 40000, '', 'Qty', 'sljvbds', 'Pasta', 555);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_bantu`
--

CREATE TABLE `tabel_bantu` (
  `id` int(11) NOT NULL,
  `ukuran_kertas_item` int(11) NOT NULL,
  `wa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_bantu`
--

INSERT INTO `tabel_bantu` (`id`, `ukuran_kertas_item`, `wa`) VALUES
(1, 13, '081212121212');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_poin`
--

CREATE TABLE `transaksi_poin` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengunjung` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `tgl_kunjungan` varchar(25) NOT NULL,
  `jam_kunjungan` varchar(25) NOT NULL,
  `jumlah_belanja` int(12) NOT NULL,
  `poin` int(5) NOT NULL,
  `status_poin` varchar(15) NOT NULL,
  `id_item_tukar_poin` varchar(5) NOT NULL,
  `qty` int(3) NOT NULL,
  `tgl_transaksi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_poin`
--

INSERT INTO `transaksi_poin` (`id_transaksi`, `id_pengunjung`, `id_pelanggan`, `tgl_kunjungan`, `jam_kunjungan`, `jumlah_belanja`, `poin`, `status_poin`, `id_item_tukar_poin`, `qty`, `tgl_transaksi`) VALUES
(7, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:17:44'),
(8, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:17:49'),
(9, '', '5', '', '', 0, 0, '-', '5', 1, '2022-06-13 03:18:45'),
(10, '', '5', '', '', 0, 0, '-', '6', 3, '2022-06-13 03:19:25'),
(18, '', '6', '', '', 0, 0, '-', '5', 1, '2022-06-14 16:59:01'),
(30, '13', '1', '2022-06-09', '04:31', 34, 1300000, '+', '', 0, '2022-06-23 05:36:50'),
(36, '3', '5', '2022-06-06', '', 1350000, 36, '+', '', 0, '2022-06-23 06:01:47'),
(37, '12', '5', '2022-05-13', '04:27', 1850000, 47, '+', '', 0, '2022-06-23 06:06:34'),
(47, '14', '6', '2022-06-14', '16:50', 340000, 14, '+', '', 0, '2022-07-02 04:31:55'),
(50, '15', '1', '2022-06-23', '07:02', 150000, 4, '+', '', 0, '2022-07-02 04:34:43'),
(51, '16', '7', '2022-06-23', '07:07', 0, 0, '+', '', 0, '2022-07-02 04:35:04'),
(52, '17', '1', '2022-06-23', '07:08', 0, 0, '+', '', 0, '2022-07-02 04:36:49'),
(53, '18', '7', '2022-06-23', '07:09', 0, 0, '+', '', 0, '2022-07-02 04:37:11'),
(54, '19', '1', '2022-06-23', '07:10', 0, 0, '+', '', 0, '2022-07-02 04:40:08'),
(55, '', '1', '', '', 0, 0, '-', '12', 6, '2022-07-28 10:34:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pengunjung`
--
ALTER TABLE `detail_pengunjung`
  ADD PRIMARY KEY (`id_detail_pengunjung`);

--
-- Indexes for table `item_tukar_poin`
--
ALTER TABLE `item_tukar_poin`
  ADD PRIMARY KEY (`id_item_tukar_poin`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pelanggan_keranjang`
--
ALTER TABLE `pelanggan_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id_pengunjung`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `pmj`
--
ALTER TABLE `pmj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tabel_bantu`
--
ALTER TABLE `tabel_bantu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_poin`
--
ALTER TABLE `transaksi_poin`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `detail_pengunjung`
--
ALTER TABLE `detail_pengunjung`
  MODIFY `id_detail_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `item_tukar_poin`
--
ALTER TABLE `item_tukar_poin`
  MODIFY `id_item_tukar_poin` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan_keranjang`
--
ALTER TABLE `pelanggan_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id_pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `pmj`
--
ALTER TABLE `pmj`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tabel_bantu`
--
ALTER TABLE `tabel_bantu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_poin`
--
ALTER TABLE `transaksi_poin`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
