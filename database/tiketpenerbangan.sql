/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tiketpenerbangan_update

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-13 13:11:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bandara
-- ----------------------------
DROP TABLE IF EXISTS `bandara`;
CREATE TABLE `bandara` (
  `id_bandara` varchar(5) NOT NULL,
  `nama_bandara` varchar(50) NOT NULL,
  `lokasi_bandara` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bandara`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bandara
-- ----------------------------
INSERT INTO `bandara` VALUES ('BTJ', 'Sultan Iskandar Muda', 'Aceh');
INSERT INTO `bandara` VALUES ('JOG', 'Adisutjipto', 'Yogyakarta');
INSERT INTO `bandara` VALUES ('MLG', 'Abdurrahman Saleh', 'Malang');
INSERT INTO `bandara` VALUES ('SUB', 'Juanda', 'Surabaya');
INSERT INTO `bandara` VALUES ('TRK', 'Juwata', 'Tarakan');
INSERT INTO `bandara` VALUES ('TTE', 'Sultan Babullah', 'Ternate');

-- ----------------------------
-- Table structure for jadwal_penerbangan
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_penerbangan`;
CREATE TABLE `jadwal_penerbangan` (
  `id_jadwal` int(5) NOT NULL AUTO_INCREMENT,
  `id_pesawat` varchar(5) NOT NULL,
  `id_bandara_asal` varchar(5) NOT NULL,
  `id_bandara_tujuan` varchar(5) NOT NULL,
  `tgl_jadwal` date NOT NULL,
  `jam_berangkat` time NOT NULL,
  `jam_sampai` time NOT NULL,
  `stok` int(3) NOT NULL,
  `tarif` int(11) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jadwal_penerbangan
-- ----------------------------
INSERT INTO `jadwal_penerbangan` VALUES ('1', 'A9323', 'JOG', 'MLG', '2020-09-08', '07:00:00', '10:00:00', '90', '1000000');
INSERT INTO `jadwal_penerbangan` VALUES ('2', 'L1233', 'MLG', 'TRK', '2020-09-02', '05:00:00', '07:00:00', '75', '500000');
INSERT INTO `jadwal_penerbangan` VALUES ('4', 'L1233', 'MLG', 'TTE', '2020-09-30', '00:30:00', '01:45:00', '23', '3400000');
INSERT INTO `jadwal_penerbangan` VALUES ('5', 'G3123', 'SUB', 'TTE', '2020-09-28', '00:00:00', '03:00:00', '74', '890000');
INSERT INTO `jadwal_penerbangan` VALUES ('6', 'L1233', 'TTE', 'TRK', '2020-09-16', '02:00:00', '05:00:00', '43', '2300000');
INSERT INTO `jadwal_penerbangan` VALUES ('7', 'G3123', 'BTJ', 'BTJ', '2020-10-01', '14:00:00', '16:00:00', '100', '750000');

-- ----------------------------
-- Table structure for msuser
-- ----------------------------
DROP TABLE IF EXISTS `msuser`;
CREATE TABLE `msuser` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of msuser
-- ----------------------------
INSERT INTO `msuser` VALUES ('1', 'Moch Arizal Fauzi', 'admin', 'admin', 'admin');
INSERT INTO `msuser` VALUES ('2', 'Moch Arizal Fauzi', 'ariz001nyxxx', 'owr216he890', 'user');
INSERT INTO `msuser` VALUES ('5', 'Moch Arizal Fauzi', 'ariz002nyxxx', 'owr216he890', 'user');

-- ----------------------------
-- Table structure for pesawat
-- ----------------------------
DROP TABLE IF EXISTS `pesawat`;
CREATE TABLE `pesawat` (
  `id_pesawat` varchar(5) NOT NULL,
  `nama_pesawat` varchar(25) NOT NULL,
  PRIMARY KEY (`id_pesawat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pesawat
-- ----------------------------
INSERT INTO `pesawat` VALUES ('A9323', 'Alucard');
INSERT INTO `pesawat` VALUES ('G3123', 'Garuda');
INSERT INTO `pesawat` VALUES ('L1233', 'Laksamana');
INSERT INTO `pesawat` VALUES ('R1355', 'Royal');
INSERT INTO `pesawat` VALUES ('S1343', 'Senior');

-- ----------------------------
-- Table structure for tborder
-- ----------------------------
DROP TABLE IF EXISTS `tborder`;
CREATE TABLE `tborder` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `jumlah_pesanan` int(11) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tborder
-- ----------------------------
