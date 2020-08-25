/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50731
 Source Host           : localhost:3306
 Source Schema         : pruebatecnica

 Target Server Type    : MySQL
 Target Server Version : 50731
 File Encoding         : 65001

 Date: 25/08/2020 15:33:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articulo
-- ----------------------------
DROP TABLE IF EXISTS `articulo`;
CREATE TABLE `articulo`  (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idarticulo`) USING BTREE,
  UNIQUE INDEX `nombre_UNIQUE`(`nombre`) USING BTREE,
  INDEX `fk_articulo_categoria_idx`(`idcategoria`) USING BTREE,
  CONSTRAINT `fk_articulo_categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of articulo
-- ----------------------------
INSERT INTO `articulo` VALUES (1, 26, '1.1.1.1', 'Castrol 20w70', 16, NULL, 1);
INSERT INTO `articulo` VALUES (2, 26, '1.1.1.2', 'Valvoline 15w', 12, NULL, 1);
INSERT INTO `articulo` VALUES (3, 27, '1.1.2.1', 'Shell Heelix Ultra SN 5w30', 50, NULL, 1);
INSERT INTO `articulo` VALUES (4, 27, '1.1.2.2', 'Castrol 5w30', 20, NULL, 1);

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categorys` int(255) NULL DEFAULT NULL,
  `nivel` int(255) NULL DEFAULT NULL,
  `codigo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcategoria`) USING BTREE,
  UNIQUE INDEX `nombre_UNIQUE`(`nombre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (23, -1, 0, '1', 'Aceites', 1);
INSERT INTO `categoria` VALUES (24, 23, 1, '1.1', 'Motor', 1);
INSERT INTO `categoria` VALUES (25, 23, 1, '1.2', 'Caja', 1);
INSERT INTO `categoria` VALUES (26, 24, 2, '1.1.1', 'Minerales', 1);
INSERT INTO `categoria` VALUES (27, 24, 2, '1.1.2', 'Sintéticos', 1);
INSERT INTO `categoria` VALUES (28, 24, 2, '1.1.3', 'Semi-Sintético', 1);
INSERT INTO `categoria` VALUES (30, 25, 2, '1.2.1', 'Sinteticos Caja', 1);

SET FOREIGN_KEY_CHECKS = 1;
