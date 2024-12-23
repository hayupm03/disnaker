/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - disnaker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`disnaker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `disnaker`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_admin_user` (`id_user`),
  CONSTRAINT `fk_admin_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

/*Table structure for table `agenda_mediasi` */

DROP TABLE IF EXISTS `agenda_mediasi`;

CREATE TABLE `agenda_mediasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_mediasi` int(10) DEFAULT NULL,
  `nama_pihak1` varchar(255) DEFAULT NULL,
  `nama_pihak2` varchar(255) DEFAULT NULL,
  `nama_kasus` varchar(255) DEFAULT NULL,
  `nama_mediator` varchar(255) DEFAULT NULL,
  `tgl_mediasi` date DEFAULT NULL,
  `waktu_mediasi` varchar(255) DEFAULT NULL,
  `status` enum('disetujui','ditolak','diproses') DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `jenis_kasus` varchar(255) DEFAULT NULL,
  `deskripsi_kasus` varchar(255) DEFAULT NULL,
  `file_pdf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `agenda_mediasi` */

/*Table structure for table `mediator` */

DROP TABLE IF EXISTS `mediator`;

CREATE TABLE `mediator` (
  `id_mediator` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(10) DEFAULT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `bidang` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_mediator`),
  KEY `fk_mediator_user` (`id_users`),
  CONSTRAINT `fk_mediator_user` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `mediator` */

/*Table structure for table `pelapor` */

DROP TABLE IF EXISTS `pelapor`;

CREATE TABLE `pelapor` (
  `id_laporan` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `perusahaan` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_laporan`),
  KEY `fk_pelapor_user` (`id_user`),
  CONSTRAINT `fk_pelapor_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelapor` */

/*Table structure for table `pelaporan_mediasi` */

DROP TABLE IF EXISTS `pelaporan_mediasi`;

CREATE TABLE `pelaporan_mediasi` (
  `id_laporan` int(10) NOT NULL AUTO_INCREMENT,
  `id_agenda` int(10) DEFAULT NULL,
  `nama_pihak_satu` varchar(255) DEFAULT NULL,
  `nama_pihak_dua` varchar(255) DEFAULT NULL,
  `nama_mediator` varchar(255) DEFAULT NULL,
  `tgl_agenda` date DEFAULT NULL,
  `tgl_penutupan` date DEFAULT NULL,
  `jenis_kasus` varchar(255) DEFAULT NULL,
  `status` enum('selesai','gagal','dilanjut ke pengadilan') DEFAULT NULL,
  `hasil_mediasi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_laporan`),
  KEY `fk_pelaporan_mediasi_agenda` (`id_agenda`),
  CONSTRAINT `fk_pelaporan_mediasi_agenda` FOREIGN KEY (`id_agenda`) REFERENCES `agenda_mediasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelaporan_mediasi` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
