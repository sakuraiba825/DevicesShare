-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-03-02 14:35:03
-- 服务器版本： 10.1.37-MariaDB
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `pass`) VALUES
(1, 'test', 'test');

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE `class` (
  `id` int(4) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`id`, `name`) VALUES
(1, '示波器'),
(2, '实验箱'),
(3, '开发板'),
(4, '其他');

-- --------------------------------------------------------

--
-- 表的结构 `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `me` varchar(255) NOT NULL COMMENT '本人',
  `linkman` varchar(255) NOT NULL COMMENT '联系人'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `contact`
--

INSERT INTO `contact` (`id`, `me`, `linkman`) VALUES
(1, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI');

-- --------------------------------------------------------

--
-- 表的结构 `fan`
--

CREATE TABLE `fan` (
  `id` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL COMMENT '昵称',
  `sex` tinyint(1) NOT NULL COMMENT '1是男性2是女性',
  `language` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `headimgurl` varchar(255) NOT NULL,
  `relname` varchar(20) NOT NULL COMMENT '真实姓名',
  `stuid` varchar(20) NOT NULL COMMENT '学号',
  `mobile` varchar(15) NOT NULL COMMENT '电话号码',
  `class` varchar(20) NOT NULL COMMENT '班级'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `fan`
--

INSERT INTO `fan` (`id`, `openid`, `nickname`, `sex`, `language`, `city`, `province`, `headimgurl`, `relname`, `stuid`, `mobile`, `class`) VALUES
(1, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '谢雨童鞋', 2, 'zh_CN', 'Qingyuan', 'Guangdong', 'http://thirdwx.qlogo.cn/mmopen/vi_32/gvfibNc3Bol6n2gNsW0UcwsZRJ3cvyFToTo77XH4nibdJiaZbmMCfibMOrvwMJzG7vFrSjfCEEMP2fWbkhJILTibUHQ/132', '', '', '15832205869', ''),
(2, 'oKLlQ1KKBsoYeD-l4uUJjxflE_XQ', '????胡雨婷????', 2, 'zh_CN', 'Hangzhou', 'Zhejiang', 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIOFsqJFueOuU8AD1AcufyggD2LHAaGhWJT5G40ibX75fB2OTQSZC8L0wG5uCAiah9xZ3YHHnNwW9Rg/132', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `good`
--

CREATE TABLE `good` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL COMMENT '设备名称',
  `model` varchar(40) NOT NULL COMMENT '设备型号',
  `detail` varchar(255) NOT NULL COMMENT '设备描述',
  `cid` tinyint(3) NOT NULL COMMENT '设备分类',
  `mid` varchar(255) NOT NULL COMMENT '设备主人openid',
  `mname` varchar(50) NOT NULL COMMENT '设备主人名称',
  `phone` varchar(15) NOT NULL COMMENT '联系电话',
  `address` varchar(100) NOT NULL COMMENT '联系地址',
  `account` varchar(40) NOT NULL COMMENT '远程账号',
  `password` varchar(40) NOT NULL COMMENT '远程密码',
  `addtime` varchar(20) NOT NULL COMMENT '增加设备时间',
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL COMMENT '正在借用设备的人的openid',
  `state` tinyint(1) NOT NULL COMMENT '0是空闲1是借用',
  `searchtime` int(8) NOT NULL COMMENT '搜索次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `good`
--

INSERT INTO `good` (`id`, `name`, `model`, `detail`, `cid`, `mid`, `mname`, `phone`, `address`, `account`, `password`, `addtime`, `img1`, `img2`, `img3`, `img4`, `img5`, `uid`, `state`, `searchtime`) VALUES
(1, '树莓派3b+', '3b+', '更强的CPU性能以及更强的无线（WiFi/BT，支持5G频段的WiF以及支持BT 4.2&BLE）连接功能', 3, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '', '15832205869', '', '', '', '2019-02-26 20:24:09', 'Uploads/goods/15511838490.jpeg', '', '', '', '', 'oKLlQ1KKBsoYeD-l4uUJjxflE_XQ', 1, 2),
(2, '美国TI 数字逻辑高速反相器 ', 'CD74ACT04E电路芯片', '直插 DIP-14', 4, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '', '15832205869', '', '1069885323', '551xkv', '2019-02-26 20:31:15', 'Uploads/goods/15511842750.jpeg', '', '', '', '', 'oKLlQ1KKBsoYeD-l4uUJjxflE_XQ', 1, 5),
(3, '小米米家智能摄像机', '米家智能摄像机云台版', '1080P 高清画质 微光全彩技术', 4, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '', '15832205869', '', '', '', '2019-02-28 21:44:35', 'Uploads/goods/15513614750.jpeg', '', '', '', '', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', 1, 6),
(4, '优利德数字示波器', ' UTD2025CL', '双模拟通道 110M带宽 ', 1, 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '', '15832205869', '', '', '', '2019-02-28 21:45:55', 'Uploads/goods/15513615550.jpeg', '', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- 表的结构 `judge`
--

CREATE TABLE `judge` (
  `id` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL COMMENT '点击者id',
  `goodtime` varchar(15) NOT NULL COMMENT '点赞时间',
  `badtime` varchar(15) NOT NULL COMMENT '批评时间',
  `rid` int(11) NOT NULL COMMENT '回复的id',
  `state` tinyint(1) NOT NULL COMMENT '0是点赞1是批评'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `judge`
--

INSERT INTO `judge` (`id`, `openid`, `goodtime`, `badtime`, `rid`, `state`) VALUES
(1, 'oKLlQ1KKBsoYeD-l4uUJjxflE_XQ', '2019-03-01 14:1', '', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `my` varchar(255) NOT NULL COMMENT '排队的人的openid',
  `gid` int(11) NOT NULL COMMENT '设备id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `topics_id` int(11) NOT NULL COMMENT '帖子的id',
  `content` text NOT NULL COMMENT '回复内容',
  `addtime` varchar(15) NOT NULL COMMENT '回复添加时间',
  `openid` varchar(255) NOT NULL COMMENT '回复者id',
  `nickname` varchar(50) NOT NULL COMMENT '回复者昵称',
  `headimgurl` varchar(255) NOT NULL COMMENT '回复者头像',
  `good` smallint(6) NOT NULL COMMENT '点赞数',
  `bad` smallint(6) NOT NULL COMMENT '批评数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`id`, `topics_id`, `content`, `addtime`, `openid`, `nickname`, `headimgurl`, `good`, `bad`) VALUES
(1, 5, '谢谢分享', '1551185535', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '谢雨童鞋', 'http://thirdwx.qlogo.cn/mmopen/vi_32/gvfibNc3Bol6n2gNsW0UcwsZRJ3cvyFToTo77XH4nibdJiaZbmMCfibMOrvwMJzG7vFrSjfCEEMP2fWbkhJILTibUHQ/132', 1, 0),
(2, 5, '谢谢', '1551185615', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '谢雨童鞋', 'http://thirdwx.qlogo.cn/mmopen/vi_32/gvfibNc3Bol6n2gNsW0UcwsZRJ3cvyFToTo77XH4nibdJiaZbmMCfibMOrvwMJzG7vFrSjfCEEMP2fWbkhJILTibUHQ/132', 0, 0),
(3, 5, 'thankyou', '1551186154', '', '', '', 0, 0),
(4, 5, 'thankyou', '1551186214', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `text`
--

CREATE TABLE `text` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` mediumtext NOT NULL COMMENT '内容',
  `addtime` varchar(15) NOT NULL COMMENT '添加时间',
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `img6` varchar(255) NOT NULL,
  `img7` varchar(255) NOT NULL,
  `img8` varchar(255) NOT NULL,
  `img9` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` mediumtext NOT NULL COMMENT '内容',
  `addtime` varchar(20) NOT NULL COMMENT '添加时间',
  `openid` varchar(255) NOT NULL COMMENT '作者的openid',
  `nickname` varchar(50) NOT NULL COMMENT '作者昵称',
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) NOT NULL,
  `img3` varchar(255) NOT NULL,
  `img4` varchar(255) NOT NULL,
  `img5` varchar(255) NOT NULL,
  `img6` varchar(255) NOT NULL,
  `img7` varchar(255) NOT NULL,
  `img8` varchar(255) NOT NULL,
  `img9` varchar(255) NOT NULL,
  `reply_count` smallint(6) NOT NULL COMMENT '回复数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `topic`
--

INSERT INTO `topic` (`id`, `title`, `content`, `addtime`, `openid`, `nickname`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `img9`, `reply_count`) VALUES
(4, '树莓派3B+评测——不被辜负的等待？', '树莓派3B+的定价依然是35美元，主要特性如下：\n\n1.4GHz 64位4核 ARM Cortex-A53 CPU\n双频 802.11ac 无线网卡和蓝牙 4.2\n更快的以太网（千兆以太网 over USB 2.0）\n1G LPDDR2\nPoE 支持（Power-over-Ethernet，with PoE HAT）\n改进 PXE 网络与 USB 大容量存储启动', '2019-02-26 20:26:25', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '谢雨童鞋', 'Uploads/topics/15511839850.jpeg', '', '', '', '', '', '', '', '', 0),
(5, 'D触发器', 'D触发器是一个具有记忆功能的，具有两个稳定状态的信息存储器件，是构成多种时序电路的最基本逻辑单元，也是数字逻辑电路中一种重要的单元电路。\n在数字系统和计算机中有着广泛的应用。触发器具有两个稳定状态，即\"0\"和\"1\"，在一定的外界信号作用下，可以从一个稳定状态翻转到另一个稳定状态。\n触发器有集成触发器和门电路组成的触发器。触发方式有电平触发和边沿触发两种。\nD触发器在时钟脉冲CP的前沿（正跳变0→1）发生翻转，触发器的次态取决于CP的脉冲上升沿到来之前D端的状态，即次态=D。因此，它具有置0、置1两种功能。由于在\nCP=1期间电路具有维持阻塞作用，所以在CP=1期间，D端的数据状态变化，不会影响触发器的输出状态。\nD触发器应用很广，可用做数字信号的寄存，移位寄存，分频和波形发生器等。\n', '2019-02-26 20:32:50', 'oKLlQ1AoMNtnyiPYUa7pWRohW5iI', '谢雨童鞋', 'Uploads/topics/15511843700.jpeg', '', '', '', '', '', '', '', '', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `fan`
--
ALTER TABLE `fan`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `fan`
--
ALTER TABLE `fan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `good`
--
ALTER TABLE `good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `text`
--
ALTER TABLE `text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
