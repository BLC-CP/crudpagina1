-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 02:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud1halaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_departamentu`
--

CREATE TABLE `tb_departamentu` (
  `id_departamentu` int(11) NOT NULL,
  `nrn_departamentu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_departamentu`
--

INSERT INTO `tb_departamentu` (`id_departamentu`, `nrn_departamentu`) VALUES
(1, 'Teknika Informatika'),
(2, 'Gestaun Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tb_estudante`
--

CREATE TABLE `tb_estudante` (
  `nre` int(10) NOT NULL,
  `nrn` varchar(255) NOT NULL,
  `sexo` enum('Mane','Feto') NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_departamentu` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_estudante`
--

INSERT INTO `tb_estudante` (`nre`, `nrn`, `sexo`, `email`, `id_departamentu`, `foto`) VALUES
(1, 'Brito', 'Mane', 'brito@gmail.com', 1, 'download.png'),
(2, 'Adriana', 'Feto', 'adriana@gmail.com', 2, 'Screenshot 2023-08-10 101350.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_departamentu`
--
ALTER TABLE `tb_departamentu`
  ADD PRIMARY KEY (`id_departamentu`);

--
-- Indexes for table `tb_estudante`
--
ALTER TABLE `tb_estudante`
  ADD PRIMARY KEY (`nre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_departamentu`
--
ALTER TABLE `tb_departamentu`
  MODIFY `id_departamentu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
