-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 12:07 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_barang` varchar(99) NOT NULL,
  `modal` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `kode_barang`, `modal`, `harga`, `tgl`) VALUES
(1, 'dasd', '1123', 'adasd', '23123123', '0000-00-00'),
(2, 'eqwqwe', '12', '123', '12344', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `jenis_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `jenis_customer`, `alamat`, `no_tlp`) VALUES
(1, 'UMUM', 'No Access', '-----', '0');

-- --------------------------------------------------------

--
-- Table structure for table `customer_barang`
--

CREATE TABLE IF NOT EXISTS `customer_barang` (
`id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_faktur`
--

CREATE TABLE IF NOT EXISTS `detail_faktur` (
`id_detail_faktur` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `modal` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `detail_faktur`
--

INSERT INTO `detail_faktur` (`id_detail_faktur`, `id_faktur`, `id_barang`, `jumlah`, `total`, `modal`) VALUES
(1, 1, 1, 1, 23123123, 0),
(2, 1, 1, 2, 46246246, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_return`
--

CREATE TABLE IF NOT EXISTS `detail_return` (
`id` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_return` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE IF NOT EXISTS `faktur` (
`id_faktur` int(11) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `id_customer` int(6) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `status` int(11) NOT NULL,
  `diskon` double NOT NULL,
  `subtotal` double NOT NULL,
  `income` double NOT NULL,
  `laba` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`id_faktur`, `no_faktur`, `id_customer`, `tanggal`, `id_user`, `status`, `diskon`, `subtotal`, `income`, `laba`) VALUES
(1, '0041', 0, '2017-10-04', 0, 1, 0, 69369369, 69369369, 69369369);

-- --------------------------------------------------------

--
-- Table structure for table `return`
--

CREATE TABLE IF NOT EXISTS `return` (
`id_return` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE IF NOT EXISTS `tbl_login` (
`id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pasword` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `foto` varchar(90) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_user`, `username`, `pasword`, `level`, `status`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0, 'admin.jpg'),
(2, 'user', '81dc9bdb52d04dc20036dbd8313ed055', 2, 0, 'avatar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_barang`), ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `customer_barang`
--
ALTER TABLE `customer_barang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_faktur`
--
ALTER TABLE `detail_faktur`
 ADD PRIMARY KEY (`id_detail_faktur`);

--
-- Indexes for table `detail_return`
--
ALTER TABLE `detail_return`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
 ADD PRIMARY KEY (`id_faktur`), ADD UNIQUE KEY `no_faktur` (`no_faktur`);

--
-- Indexes for table `return`
--
ALTER TABLE `return`
 ADD PRIMARY KEY (`id_return`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_barang`
--
ALTER TABLE `customer_barang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_faktur`
--
ALTER TABLE `detail_faktur`
MODIFY `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_return`
--
ALTER TABLE `detail_return`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faktur`
--
ALTER TABLE `faktur`
MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `return`
--
ALTER TABLE `return`
MODIFY `id_return` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
