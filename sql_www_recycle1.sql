-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-12-08 00:55:26
-- 服务器版本： 5.5.62-log
-- PHP 版本： 8.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `sql_www_recycle1`
--

-- --------------------------------------------------------

--
-- 表的结构 `goods_information`
--

CREATE TABLE `goods_information` (
  `goods_id` varchar(25) NOT NULL COMMENT '商品编号',
  `name` varchar(20) NOT NULL COMMENT '名称',
  `photo1` varchar(100) DEFAULT NULL COMMENT '图片1',
  `photo2` varchar(100) DEFAULT NULL COMMENT '图片2',
  `photo3` varchar(100) DEFAULT NULL COMMENT '图片3',
  `price` double NOT NULL COMMENT '价格',
  `inventory` int(11) NOT NULL COMMENT '库存',
  `size` varchar(100) DEFAULT NULL COMMENT '尺寸',
  `style` varchar(100) DEFAULT NULL COMMENT '款式',
  `catagory` varchar(25) NOT NULL COMMENT '分类',
  `goods_from` varchar(16) NOT NULL COMMENT '店铺'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `goods_information`
--

INSERT INTO `goods_information` (`goods_id`, `name`, `photo1`, `photo2`, `photo3`, `price`, `inventory`, `size`, `style`, `catagory`, `goods_from`) VALUES
('id_61c56d17ecff4', '橡皮糖', 'http://101.201.109.91/test/project/tmp_photo/pic_61c56dee2d162.png', 'http://101.201.109.91/test/project/tmp_photo/pic_61c56dee2d736.png', 'http://101.201.109.91/test/project/tmp_photo/pic_61c56dee2e157.png', 12, 20, '', '蓝色;s-t-y-l-e;红色', 'food', 'hyh');

-- --------------------------------------------------------

--
-- 表的结构 `gouwuche`
--

CREATE TABLE `gouwuche` (
  `username` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `style` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goods_id` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_cart_id` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `order_form`
--

CREATE TABLE `order_form` (
  `order_id` varchar(25) NOT NULL COMMENT '订单号',
  `goods_id` varchar(25) NOT NULL COMMENT '商品名称',
  `quantity` int(11) NOT NULL COMMENT '数量',
  `size` varchar(15) DEFAULT NULL COMMENT '尺寸',
  `style` varchar(15) DEFAULT NULL COMMENT '款式',
  `buy_username` varchar(16) NOT NULL COMMENT '买房用户名',
  `time` datetime NOT NULL COMMENT '下单时间',
  `status` int(11) DEFAULT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order_form`
--

INSERT INTO `order_form` (`order_id`, `goods_id`, `quantity`, `size`, `style`, `buy_username`, `time`, `status`, `address`, `tel`) VALUES
('dd_624968246c9d6', 'id_61c56d17ecff4', 2, '', '红色', '大大怪', '2022-04-03 17:25:56', 1, '1', '1');

-- --------------------------------------------------------

--
-- 表的结构 `recommend`
--

CREATE TABLE `recommend` (
  `reco` varchar(20) NOT NULL,
  `top_6_1` varchar(50) DEFAULT NULL COMMENT '今日热卖前6名',
  `top_6_2` varchar(50) DEFAULT NULL,
  `top_6_3` varchar(50) DEFAULT NULL,
  `top_6_4` varchar(50) DEFAULT NULL,
  `top_6_5` varchar(50) DEFAULT NULL,
  `top_6_6` varchar(50) DEFAULT NULL,
  `ad_screen_1` varchar(50) DEFAULT NULL COMMENT '广告大屏',
  `ad_screen_2` varchar(50) DEFAULT NULL,
  `ad_screen_3` varchar(50) DEFAULT NULL,
  `ad_screen_4` varchar(50) DEFAULT NULL,
  `ad_screen_5` varchar(50) DEFAULT NULL,
  `new_3_1` varchar(50) DEFAULT NULL COMMENT '新品',
  `new_3_2` varchar(50) DEFAULT NULL,
  `new_3_3` varchar(50) DEFAULT NULL,
  `bargain_1` varchar(50) DEFAULT NULL COMMENT '特价商品',
  `bargain_2` varchar(50) DEFAULT NULL,
  `bargain_3` varchar(50) DEFAULT NULL,
  `bargain_4` varchar(50) DEFAULT NULL,
  `bargain_5` varchar(50) DEFAULT NULL,
  `activity_1` varchar(50) DEFAULT NULL COMMENT '活动促销',
  `activity_2` varchar(50) DEFAULT NULL,
  `activity_3` varchar(50) DEFAULT NULL,
  `activity_4` varchar(50) DEFAULT NULL,
  `activity_5` varchar(50) DEFAULT NULL,
  `activity_6` varchar(50) DEFAULT NULL,
  `activity_7` varchar(50) DEFAULT NULL,
  `ad_middle` varchar(25) DEFAULT NULL COMMENT '广告（中部）',
  `brand_1` varchar(50) DEFAULT NULL COMMENT '品牌',
  `brand_2` varchar(50) DEFAULT NULL,
  `brand_3` varchar(50) DEFAULT NULL,
  `brand_4` varchar(50) DEFAULT NULL,
  `brand_5` varchar(50) DEFAULT NULL,
  `brand_6` varchar(50) DEFAULT NULL,
  `brand_7` varchar(50) DEFAULT NULL,
  `brand_8` varchar(50) DEFAULT NULL,
  `ad_bottom` varchar(25) DEFAULT NULL COMMENT '广告（底部）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `recommend`
--

INSERT INTO `recommend` (`reco`, `top_6_1`, `top_6_2`, `top_6_3`, `top_6_4`, `top_6_5`, `top_6_6`, `ad_screen_1`, `ad_screen_2`, `ad_screen_3`, `ad_screen_4`, `ad_screen_5`, `new_3_1`, `new_3_2`, `new_3_3`, `bargain_1`, `bargain_2`, `bargain_3`, `bargain_4`, `bargain_5`, `activity_1`, `activity_2`, `activity_3`, `activity_4`, `activity_5`, `activity_6`, `activity_7`, `ad_middle`, `brand_1`, `brand_2`, `brand_3`, `brand_4`, `brand_5`, `brand_6`, `brand_7`, `brand_8`, `ad_bottom`) VALUES
('reco', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `password` varchar(10) NOT NULL COMMENT '密码',
  `gender` varchar(2) NOT NULL COMMENT '性别',
  `tel` varchar(11) NOT NULL COMMENT '电话',
  `answer` varchar(20) NOT NULL COMMENT '密保答案',
  `photo` varchar(100) DEFAULT NULL COMMENT '头像',
  `identity` int(11) NOT NULL COMMENT '身份',
  `address` text,
  `addmission` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`, `gender`, `tel`, `answer`, `photo`, `identity`, `address`, `addmission`) VALUES
('root', '12345', '1', '1', '1', NULL, 0, NULL, NULL),
('大大怪', '1', '男', '15933003216', '大大怪', 'http://101.201.109.91/test/project/user_photo/user_61c572f834cb7.png', 2, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `goods_information`
--
ALTER TABLE `goods_information`
  ADD PRIMARY KEY (`goods_id`);

--
-- 表的索引 `gouwuche`
--
ALTER TABLE `gouwuche`
  ADD PRIMARY KEY (`shop_cart_id`);

--
-- 表的索引 `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`order_id`);

--
-- 表的索引 `recommend`
--
ALTER TABLE `recommend`
  ADD PRIMARY KEY (`reco`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
