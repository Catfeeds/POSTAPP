-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-10-24 17:13:21
-- 服务器版本： 5.6.34-log
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `njzhsq`
--

-- --------------------------------------------------------

--
-- 表的结构 `ims_account`
--

CREATE TABLE IF NOT EXISTS `ims_account` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `hash` varchar(8) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `isconnect` tinyint(4) NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_account`
--

INSERT INTO `ims_account` (`acid`, `uniacid`, `hash`, `type`, `isconnect`, `isdeleted`) VALUES
(1, 1, 'uRr8qvQV', 1, 0, 1),
(2, 2, 'mu86IzF4', 1, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_account_wechats`
--

CREATE TABLE IF NOT EXISTS `ims_account_wechats` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(255) NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `country` varchar(10) NOT NULL,
  `province` varchar(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `subscribeurl` varchar(120) NOT NULL,
  `auth_refresh_token` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_account_wechats`
--

INSERT INTO `ims_account_wechats` (`acid`, `uniacid`, `token`, `encodingaeskey`, `level`, `name`, `account`, `original`, `signature`, `country`, `province`, `city`, `username`, `password`, `lastupdate`, `key`, `secret`, `styleid`, `subscribeurl`, `auth_refresh_token`) VALUES
(1, 1, 'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', '', 1, 'we7team', '', '', '', '', '', '', '', '', 0, '', '', 1, '', ''),
(2, 2, 't5DdWD5hhWjdYaYW2y2LhAYlE6yh0h0N', 'TnneLH38TX13LHhnH4ZfL3h212Tnl62z71Q47HXNh44', 4, '福城物业', '', 'gh_0c2d3a9066f5', '', '', '', '', '', '', 0, 'wx8936fa867f2e8043', '499b44f4e049cecabe20d1db61dfea12', 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_account_wxapp`
--

CREATE TABLE IF NOT EXISTS `ims_account_wxapp` (
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `token` varchar(32) NOT NULL,
  `encodingaeskey` varchar(43) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `account` varchar(30) NOT NULL,
  `original` varchar(50) NOT NULL,
  `key` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `appdomain` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_article_category`
--

CREATE TABLE IF NOT EXISTS `ims_article_category` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_article_news`
--

CREATE TABLE IF NOT EXISTS `ims_article_news` (
  `id` int(10) unsigned NOT NULL,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_article_notice`
--

CREATE TABLE IF NOT EXISTS `ims_article_notice` (
  `id` int(10) unsigned NOT NULL,
  `cateid` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_show_home` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_article_unread_notice`
--

CREATE TABLE IF NOT EXISTS `ims_article_unread_notice` (
  `id` int(10) unsigned NOT NULL,
  `notice_id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `is_new` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_basic_reply`
--

CREATE TABLE IF NOT EXISTS `ims_basic_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_business`
--

CREATE TABLE IF NOT EXISTS `ims_business` (
  `id` int(10) unsigned NOT NULL,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `lng` varchar(10) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `industry1` varchar(10) NOT NULL,
  `industry2` varchar(10) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_attachment`
--

CREATE TABLE IF NOT EXISTS `ims_core_attachment` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_core_attachment`
--

INSERT INTO `ims_core_attachment` (`id`, `uniacid`, `uid`, `filename`, `attachment`, `type`, `createtime`) VALUES
(1, 1, 1, 'Lighthouse.jpg', 'images/1/2017/08/Lc7yKr61K57SY79886C15S88A758D7.jpg', 1, 1502186076),
(2, 2, 1, '微信图片_20170809111825.jpg', 'images/2/2017/08/nHZXZahNKhtBasPhXH29G2e2KKb2nj.jpg', 1, 1502248703),
(3, 2, 1, '微信图片_20170809111825.jpg', 'images/2/2017/08/feo0D10o04e56Yhv51oE06IHEA15V6.jpg', 1, 1502263176),
(4, 2, 1, 'Desert.jpg', 'images/2/2017/08/K0obox9z5xAA1DAUyFRLjRyU60rUUr.jpg', 1, 1502263226),
(5, 2, 1, 'Koala.jpg', 'images/2/2017/08/K5vvluqlK646n58l7E65L778BPTO8e.jpg', 1, 1502263233),
(6, 2, 1, 'Hydrangeas.jpg', 'images/2/2017/08/pNKhIZunGR2hh2xNNr5h2i2z0H9xHR.jpg', 1, 1502263741),
(7, 2, 1, 'Jellyfish.jpg', 'images/2/2017/08/H7Bw3bXSbBL1CG13Fbed37Ou5Wckp8.jpg', 1, 1502263742),
(8, 2, 1, 'Koala.jpg', 'images/2/2017/08/RIhEd6hrfGMg6F54qR350YBfz5R46G.jpg', 1, 1502263742),
(9, 2, 1, 'Penguins.jpg', 'images/2/2017/08/tBVBqi7SBBxccsxbuv4q9PCYrIvZsR.jpg', 1, 1502264007),
(10, 2, 1, 'Desert.jpg', 'images/2/2017/08/saAG8H6qQZ0HoUmQ6Gu48gqHX8dHAK.jpg', 1, 1502265257),
(11, 2, 1, 'Desert.jpg', 'images/2/2017/08/VfU3pz9OwMGVpV9F9Pv3WMMCMUn9gn.jpg', 1, 1502265290),
(12, 2, 1, 'Chrysanthemum.jpg', 'images/2/2017/08/v2aXhAUw7KJkVqv2wqKwuew2ZhKWxq.jpg', 1, 1502265324),
(13, 2, 1, 'Tulips.jpg', 'images/2/2017/08/Eepjw1PJyWzBoSjJybwpPppeEEJGeP.jpg', 1, 1502265447),
(14, 2, 1, 'Jellyfish.jpg', 'images/2/2017/08/Qo7bb46EMCbH64XTQEX6q674EWx914.jpg', 1, 1502265473),
(15, 2, 1, 'Lighthouse.jpg', 'images/2/2017/08/L955f22ktf1Fdv2vd4t2q9ftNhtH6F.jpg', 1, 1502265486),
(16, 2, 1, 'Koala.jpg', 'images/2/2017/08/r3m61w0wYtc1wU7guf15y232nyP7cW.jpg', 1, 1502266142),
(17, 2, 1, 'Jellyfish.jpg', 'images/2/2017/08/VNpEnOWbM2WA55n02B0AzpeWdZhcEa.jpg', 1, 1502266212),
(18, 2, 1, 'Penguins.jpg', 'images/2/2017/08/dDttp3VzmQUo4luRt3tNtDl4V21uL5.jpg', 1, 1502266239),
(19, 2, 1, 'Hydrangeas.jpg', 'images/2/2017/08/xBRV6vbbbDlXSejsbdfM1CBV4L1LXB.jpg', 1, 1502266256),
(20, 2, 1, 'Tulips.jpg', 'images/2/2017/08/qS02iiO2mmyni0ysJ9JGHNOOHjfG9N.jpg', 1, 1502266256),
(21, 2, 1, 'Penguins.jpg', 'images/2/2017/08/JhmJLXLDRDKFPkEJLLQqpxqDQZZ3Mp.jpg', 1, 1502266256),
(22, 2, 1, 'Desert.jpg', 'images/2/2017/08/h2g8799k9552kxtdoND7Yo9eKD7rx5.jpg', 1, 1502266274),
(23, 2, 1, 'Hydrangeas.jpg', 'images/2/2017/08/gzQpn4nnoP2BO8nPnNb24gNpGPNq4V.jpg', 1, 1502266275),
(24, 2, 1, 'Penguins.jpg', 'images/2/2017/08/JDdfJI8JMFR1A3iIErIsI0D8SpJ6E6.jpg', 1, 1502266275),
(25, 2, 1, 'Tulips.jpg', 'images/2/2017/08/zil62VUzBg6utyAypyY6yXY2Ay3xBr.jpg', 1, 1502266277),
(26, 2, 1, 'Penguins.jpg', 'images/2/2017/08/RTiPZrh7IUZPzD3B0B0gigI4Pb47kh.jpg', 1, 1502269700),
(27, 2, 1, 'Penguins.jpg', 'images/2/2017/08/suKs96Kc6Kk0496iSuIHxEQIfKK6xe.jpg', 1, 1502269801),
(28, 2, 1, 'Koala.jpg', 'images/2/2017/08/Fx1KkX66FrCg3NuHxlNUD1K6UrDTzn.jpg', 1, 1502269894),
(29, 2, 1, 'Penguins.jpg', 'images/2/2017/08/lkQKOQkkKtA7MNa45rRKa4mOnnOrB9.jpg', 1, 1502270459),
(30, 2, 1, 'Lighthouse.jpg', 'images/2/2017/08/vHJ2lJ242Sfv4H4fn6SvLfJxn2hF53.jpg', 1, 1502270474),
(31, 2, 1, 'Penguins.jpg', 'images/2/2017/08/S991Lo9L3CkRzY1oyoSlih7kp69xCo.jpg', 1, 1502270474),
(32, 2, 1, 'Tulips.jpg', 'images/2/2017/08/y2K0I13gko0ok8oLZKAA3ak002orU2.jpg', 1, 1502270474),
(33, 2, 1, 'Hydrangeas.jpg', 'images/2/2017/08/DXAcB0qa0AA0cAa0RazAcQC6Y6aYx8.jpg', 1, 1502332935),
(34, 2, 1, 'Koala.jpg', 'images/2/2017/08/THSslhlNJQsOgtqxSqQgbUxlTxoqsu.jpg', 1, 1502332984),
(35, 2, 1, 'Penguins.jpg', 'images/2/2017/08/rnfN4siTpGguUGu2NfE3tguN3ungiU.jpg', 1, 1502333052),
(36, 2, 1, 'Penguins.jpg', 'images/2/2017/08/c7JX7XtG8LrnFx73NVJq43lTZqJtqh.jpg', 1, 1502333222),
(37, 2, 1, 'Penguins.jpg', 'images/2/2017/08/uKK60kXXKjexJ9XJ2rKXW26K6i6mmr.jpg', 1, 1502333246),
(38, 2, 1, 'gKM0Ic6fIc8oEIOcT8B6oOgeIez660.png', 'images/2/2017/08/KnNmMun9k35nL7boc1BQlCmn3K57l8.png', 1, 1502414199),
(39, 2, 1, 'H23x73AmxH39DSXVnH43GVV1vchxz7.png', 'images/2/2017/08/RzJfJJM3zIW2mKFw2XZIK3c2fjf2JP.png', 1, 1502414224),
(40, 2, 1, 'iRKw5oT1vru5xM5R2oTYVZCxJRiMwM.jpg', 'images/2/2017/08/dtt20egz10vWl02XZ59DMOaoa011rd.jpg', 1, 1502414252),
(41, 2, 1, 'RDs3TtC67qJ2VjVTcr7Ndv4mzv66Pv.png', 'images/2/2017/08/R6198MpM1e6dEFU98zD3U8Dzc16YAd.png', 1, 1502414287),
(42, 2, 1, 'Sz156H350RZ5uy09Ae3u0oaYE16XY3.png', 'images/2/2017/08/kV155PW3GCC23E4mv5hteHM2H2CzEh.png', 1, 1502414361),
(43, 2, 1, 'Wc00S0VbBvOGvUow0GIWL4bXB44TD3.png', 'images/2/2017/08/c8KbIi8bNnIK0lNQmZnB6nABMZssIL.png', 1, 1502414384),
(44, 2, 1, '090405711.png', 'images/2/2017/08/C5R8t1rXdP8DTrW8xvXdcb5rWbxtCp.png', 1, 1502414730),
(45, 2, 1, '063041581.jpg', 'images/2/2017/08/O0IlhM6Himh68l95yc9ZMZD60bPCI9.jpg', 1, 1502414770),
(46, 2, 1, '072047101.png', 'images/2/2017/08/gwFi6dZNIDWws762i2l6diA144Ll3D.png', 1, 1502414784),
(47, 2, 1, 'bA5F6QL7FI2po432AYg57J77MJJJJp.jpg', 'images/2/2017/08/S9PdLl24ptTrTKllgfpp6llOL9kK8D.jpg', 1, 1502416122),
(48, 2, 1, 'H96zMmjk6ZrJHm8K6Kk87HVKgjnGTI.jpg', 'images/2/2017/08/sUsosKo1oujLukyEgSPEikl1p5kwYJ.jpg', 1, 1502416132),
(49, 2, 1, 'bA5F6QL7FI2po432AYg57J77MJJJJp.jpg', 'images/2/2017/08/O7kafu1F9A3oa7g7FNf2o2aZ8qFO78.jpg', 1, 1502416132),
(50, 2, 1, 'IS2cYLDys6uT94ZV9yjSvvLt5jJStT.jpg', 'images/2/2017/08/HnLkTUuuNZLDklWaLRK3nDNDTlKZll.jpg', 1, 1502417259),
(51, 2, 1, 'IS2cYLDys6uT94ZV9yjSvvLt5jJStT.jpg', 'images/2/2017/08/jZPMpC9fuCR3tJRcEP3cqqMFC3rput.jpg', 1, 1502417266),
(52, 2, 1, 'l6sRsIIf062Nr2SRXPRrpDFazAh926.jpg', 'images/2/2017/08/C4n4040EeH08FEizGVe2048F4G4348.jpg', 1, 1502417289),
(53, 2, 1, 'timg3.jpg', 'images/2/2017/09/JJ4kcTJ1KT1Jc2c7Kc1rKJ52O0x05X.jpg', 1, 1504526199),
(54, 2, 1, 'timg.jpg', 'images/2/2017/09/Ff664rFLlevF6F6F8DA66ccw6vA3dc.jpg', 1, 1504526207),
(55, 2, 1, 'timg2.jpg', 'images/2/2017/09/otOiQfXoStnyNuZ5ZINTFQqnISm9PC.jpg', 1, 1504526214),
(56, 2, 1, 'timg.jpg', 'images/2/2017/09/AkWJ6lR0ii0bIJ0KEj6B8c10iW7108.jpg', 1, 1504526306),
(57, 2, 1, '6c0b840b679e17d1c3bd1b.jpg', 'images/2/2017/09/LDCFZ40LF9oo4TX9zXFlh498ajxgLo.jpg', 1, 1504526428),
(58, 2, 1, 'v79iemYIyEMMUmeImIYIziL7yieE77', 'images/2/2017/09/v79iemYIyEMMUmeImIYIziL7yieE77.jpg', 1, 1504526428),
(59, 2, 1, 'timg?image&quality=80&size=b9999_10000&sec=1504536535769&di=893f81e605e3b30ab5eeefae955d3fb1&imgtype=0&src=http%3A%2F%2Fimg3sz.centainfo.com%2Fimages%2F20170610%2F051241_bab6948c-2cef-4f15-98b9-c050dbed1abc_450x320_w.jpg', 'images/2/2017/09/iPnD5v9jCBowJBdab6aJ2wWSvPd2Wc.gif', 1, 1504526494),
(60, 2, 1, 'XIiVWIuw22NXVZ0VFXx1iy1K215xbI', 'images/2/2017/09/XIiVWIuw22NXVZ0VFXx1iy1K215xbI.gif', 1, 1504526495),
(61, 2, 1, '051241_bab6948c-2cef-4f15-98b9-c050dbed1abc_450x320_w.jpg', 'images/2/2017/09/fh7wyE7zohd4iY2oiwLI4zElwp470l.jpg', 1, 1504526570),
(62, 2, 1, 'Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj', 'images/2/2017/09/Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj.jpg', 1, 1504526571);

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_cache`
--

CREATE TABLE IF NOT EXISTS `ims_core_cache` (
  `key` varchar(50) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_core_cache`
--

INSERT INTO `ims_core_cache` (`key`, `value`) VALUES
('userbasefields', 'a:45:{s:7:"uniacid";s:17:"同一公众号id";s:7:"groupid";s:8:"分组id";s:7:"credit1";s:6:"积分";s:7:"credit2";s:6:"余额";s:7:"credit3";s:19:"预留积分类型3";s:7:"credit4";s:19:"预留积分类型4";s:7:"credit5";s:19:"预留积分类型5";s:7:"credit6";s:19:"预留积分类型6";s:10:"createtime";s:12:"加入时间";s:6:"mobile";s:12:"手机号码";s:5:"email";s:12:"电子邮箱";s:8:"realname";s:12:"真实姓名";s:8:"nickname";s:6:"昵称";s:6:"avatar";s:6:"头像";s:2:"qq";s:5:"QQ号";s:6:"gender";s:6:"性别";s:5:"birth";s:6:"生日";s:13:"constellation";s:6:"星座";s:6:"zodiac";s:6:"生肖";s:9:"telephone";s:12:"固定电话";s:6:"idcard";s:12:"证件号码";s:9:"studentid";s:6:"学号";s:5:"grade";s:6:"班级";s:7:"address";s:6:"地址";s:7:"zipcode";s:6:"邮编";s:11:"nationality";s:6:"国籍";s:6:"reside";s:9:"居住地";s:14:"graduateschool";s:12:"毕业学校";s:7:"company";s:6:"公司";s:9:"education";s:6:"学历";s:10:"occupation";s:6:"职业";s:8:"position";s:6:"职位";s:7:"revenue";s:9:"年收入";s:15:"affectivestatus";s:12:"情感状态";s:10:"lookingfor";s:13:" 交友目的";s:9:"bloodtype";s:6:"血型";s:6:"height";s:6:"身高";s:6:"weight";s:6:"体重";s:6:"alipay";s:15:"支付宝帐号";s:3:"msn";s:3:"MSN";s:6:"taobao";s:12:"阿里旺旺";s:4:"site";s:6:"主页";s:3:"bio";s:12:"自我介绍";s:8:"interest";s:12:"兴趣爱好";s:8:"password";s:6:"密码";}'),
('usersfields', 'a:46:{s:8:"realname";s:12:"真实姓名";s:8:"nickname";s:6:"昵称";s:6:"avatar";s:6:"头像";s:2:"qq";s:5:"QQ号";s:6:"mobile";s:12:"手机号码";s:3:"vip";s:9:"VIP级别";s:6:"gender";s:6:"性别";s:9:"birthyear";s:12:"出生生日";s:13:"constellation";s:6:"星座";s:6:"zodiac";s:6:"生肖";s:9:"telephone";s:12:"固定电话";s:6:"idcard";s:12:"证件号码";s:9:"studentid";s:6:"学号";s:5:"grade";s:6:"班级";s:7:"address";s:12:"邮寄地址";s:7:"zipcode";s:6:"邮编";s:11:"nationality";s:6:"国籍";s:14:"resideprovince";s:12:"居住地址";s:14:"graduateschool";s:12:"毕业学校";s:7:"company";s:6:"公司";s:9:"education";s:6:"学历";s:10:"occupation";s:6:"职业";s:8:"position";s:6:"职位";s:7:"revenue";s:9:"年收入";s:15:"affectivestatus";s:12:"情感状态";s:10:"lookingfor";s:13:" 交友目的";s:9:"bloodtype";s:6:"血型";s:6:"height";s:6:"身高";s:6:"weight";s:6:"体重";s:6:"alipay";s:15:"支付宝帐号";s:3:"msn";s:3:"MSN";s:5:"email";s:12:"电子邮箱";s:6:"taobao";s:12:"阿里旺旺";s:4:"site";s:6:"主页";s:3:"bio";s:12:"自我介绍";s:8:"interest";s:12:"兴趣爱好";s:7:"uniacid";s:17:"同一公众号id";s:7:"groupid";s:8:"分组id";s:7:"credit1";s:6:"积分";s:7:"credit2";s:6:"余额";s:7:"credit3";s:19:"预留积分类型3";s:7:"credit4";s:19:"预留积分类型4";s:7:"credit5";s:19:"预留积分类型5";s:7:"credit6";s:19:"预留积分类型6";s:10:"createtime";s:12:"加入时间";s:8:"password";s:12:"用户密码";}'),
('setting', 'a:11:{s:9:"copyright";a:2:{s:6:"status";s:1:"0";s:6:"reason";s:15:"备份数据库";}s:18:"module_receive_ban";a:1:{s:14:"feng_community";s:14:"feng_community";}s:8:"authmode";i:1;s:5:"close";a:2:{s:6:"status";s:1:"0";s:6:"reason";s:0:"";}s:8:"register";a:4:{s:4:"open";i:1;s:6:"verify";i:0;s:4:"code";i:1;s:7:"groupid";i:1;}s:4:"site";a:6:{s:3:"key";s:5:"99202";s:5:"token";s:32:"b37028cd06062ddb1aefe69b4a5c4be5";s:3:"url";s:21:"http://wuye.iot-gj.cn";s:7:"version";s:3:"1.0";s:6:"family";s:1:"v";s:15:"profile_perfect";b:1;}s:7:"cloudip";a:2:{s:2:"ip";s:12:"42.56.76.104";s:6:"expire";i:1508837229;}s:10:"module_ban";a:0:{}s:14:"module_upgrade";a:0:{}s:8:"sms.info";a:3:{s:3:"key";s:5:"99202";s:8:"sms_sign";a:0:{}s:9:"sms_count";i:0;}s:8:"platform";a:5:{s:5:"token";s:32:"itKThGnTgGk9gzszSFshShcJhkkgs5tC";s:14:"encodingaeskey";s:43:"hOq7yAkNrYfPAfqCKYFpofP66N26PkCPFAabY6f7pny";s:9:"appsecret";s:0:"";s:5:"appid";s:0:"";s:9:"authstate";i:1;}}'),
('unisetting:2', 'a:23:{s:7:"uniacid";s:1:"2";s:8:"passport";s:0:"";s:5:"oauth";a:2:{s:7:"account";s:1:"2";s:4:"host";s:0:"";}s:11:"jsauth_acid";s:1:"0";s:2:"uc";s:0:"";s:6:"notify";s:0:"";s:11:"creditnames";a:2:{s:7:"credit1";a:2:{s:5:"title";s:6:"积分";s:7:"enabled";i:1;}s:7:"credit2";a:2:{s:5:"title";s:6:"余额";s:7:"enabled";i:1;}}s:15:"creditbehaviors";a:2:{s:8:"activity";s:7:"credit1";s:8:"currency";s:7:"credit2";}s:7:"welcome";s:0:"";s:7:"default";s:0:"";s:15:"default_message";s:0:"";s:7:"payment";a:3:{s:6:"alipay";a:1:{s:6:"switch";b:1;}s:6:"credit";a:1:{s:6:"switch";b:1;}s:8:"delivery";a:1:{s:6:"switch";b:1;}}s:4:"stat";s:0:"";s:12:"default_site";s:1:"2";s:4:"sync";s:1:"1";s:8:"recharge";s:0:"";s:9:"tplnotice";s:0:"";s:10:"grouplevel";s:1:"0";s:8:"mcplugin";s:0:"";s:15:"exchange_enable";s:1:"0";s:11:"coupon_type";s:1:"0";s:7:"menuset";s:0:"";s:10:"statistics";s:0:"";}'),
('uniaccount:2', 'a:34:{s:4:"acid";s:1:"2";s:7:"uniacid";s:1:"2";s:5:"token";s:32:"t5DdWD5hhWjdYaYW2y2LhAYlE6yh0h0N";s:14:"encodingaeskey";s:43:"TnneLH38TX13LHhnH4ZfL3h212Tnl62z71Q47HXNh44";s:5:"level";s:1:"4";s:4:"name";s:12:"福城物业";s:7:"account";s:0:"";s:8:"original";s:15:"gh_0c2d3a9066f5";s:9:"signature";s:0:"";s:7:"country";s:0:"";s:8:"province";s:0:"";s:4:"city";s:0:"";s:8:"username";s:0:"";s:8:"password";s:0:"";s:10:"lastupdate";s:1:"0";s:3:"key";s:18:"wx8936fa867f2e8043";s:6:"secret";s:32:"499b44f4e049cecabe20d1db61dfea12";s:7:"styleid";s:1:"0";s:12:"subscribeurl";s:0:"";s:18:"auth_refresh_token";s:0:"";s:4:"type";s:1:"1";s:9:"isconnect";s:1:"1";s:9:"isdeleted";s:1:"0";s:3:"uid";N;s:9:"starttime";N;s:7:"endtime";N;s:6:"groups";a:1:{i:2;a:5:{s:7:"groupid";s:1:"2";s:7:"uniacid";s:1:"2";s:5:"title";s:15:"默认会员组";s:6:"credit";s:1:"0";s:9:"isdefault";s:1:"1";}}s:7:"setting";a:23:{s:7:"uniacid";s:1:"2";s:8:"passport";s:0:"";s:5:"oauth";a:2:{s:7:"account";s:1:"2";s:4:"host";s:0:"";}s:11:"jsauth_acid";s:1:"0";s:2:"uc";s:0:"";s:6:"notify";s:0:"";s:11:"creditnames";a:2:{s:7:"credit1";a:2:{s:5:"title";s:6:"积分";s:7:"enabled";i:1;}s:7:"credit2";a:2:{s:5:"title";s:6:"余额";s:7:"enabled";i:1;}}s:15:"creditbehaviors";a:2:{s:8:"activity";s:7:"credit1";s:8:"currency";s:7:"credit2";}s:7:"welcome";s:0:"";s:7:"default";s:0:"";s:15:"default_message";s:0:"";s:7:"payment";a:3:{s:6:"alipay";a:1:{s:6:"switch";b:1;}s:6:"credit";a:1:{s:6:"switch";b:1;}s:8:"delivery";a:1:{s:6:"switch";b:1;}}s:4:"stat";s:0:"";s:12:"default_site";s:1:"2";s:4:"sync";s:1:"1";s:8:"recharge";s:0:"";s:9:"tplnotice";s:0:"";s:10:"grouplevel";s:1:"0";s:8:"mcplugin";s:0:"";s:15:"exchange_enable";s:1:"0";s:11:"coupon_type";s:1:"0";s:7:"menuset";s:0:"";s:10:"statistics";s:0:"";}s:10:"grouplevel";s:1:"0";s:4:"logo";s:62:"http://wuye.iot-gj.cn/attachment/headimg_2.jpg?time=1508743513";s:6:"qrcode";s:61:"http://wuye.iot-gj.cn/attachment/qrcode_2.jpg?time=1508743513";s:9:"switchurl";s:51:"./index.php?c=account&a=display&do=switch&uniacid=2";s:3:"sms";i:0;s:7:"setmeal";a:5:{s:3:"uid";i:-1;s:8:"username";s:9:"创始人";s:9:"timelimit";s:9:"未设置";s:7:"groupid";s:2:"-1";s:9:"groupname";s:12:"所有服务";}}'),
('upgrade', 'a:3:{s:7:"upgrade";b:0;s:4:"data";a:11:{s:6:"family";s:1:"v";s:7:"version";s:3:"1.0";s:7:"release";s:12:"201710190002";s:5:"state";b:0;s:7:"message";b:0;s:7:"schemas";a:0:{}s:5:"files";a:0:{}s:7:"scripts";b:0;s:5:"token";s:32:"1dbfae913c1d72c37deb84846b1709c3";s:4:"task";i:10;s:7:"upgrade";b:0;}s:10:"lastupdate";i:1508833631;}'),
('system_frame', 'a:8:{s:7:"account";a:7:{s:5:"title";s:9:"公众号";s:4:"icon";s:18:"wi wi-white-collar";s:3:"url";s:41:"./index.php?c=home&a=welcome&do=platform&";s:7:"section";a:4:{s:13:"platform_plus";a:2:{s:5:"title";s:12:"增强功能";s:4:"menu";a:6:{s:14:"platform_reply";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"自动回复";s:3:"url";s:31:"./index.php?c=platform&a=reply&";s:15:"permission_name";s:14:"platform_reply";s:4:"icon";s:11:"wi wi-reply";s:12:"displayorder";i:6;s:2:"id";N;s:14:"sub_permission";a:0:{}}s:13:"platform_menu";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"自定义菜单";s:3:"url";s:30:"./index.php?c=platform&a=menu&";s:15:"permission_name";s:13:"platform_menu";s:4:"icon";s:16:"wi wi-custommenu";s:12:"displayorder";i:5;s:2:"id";N;s:14:"sub_permission";N;}s:11:"platform_qr";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:22:"二维码/转化链接";s:3:"url";s:28:"./index.php?c=platform&a=qr&";s:15:"permission_name";s:11:"platform_qr";s:4:"icon";s:12:"wi wi-qrcode";s:12:"displayorder";i:4;s:2:"id";N;s:14:"sub_permission";a:0:{}}s:18:"platform_mass_task";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"定时群发";s:3:"url";s:30:"./index.php?c=platform&a=mass&";s:15:"permission_name";s:18:"platform_mass_task";s:4:"icon";s:13:"wi wi-crontab";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:17:"platform_material";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:16:"素材/编辑器";s:3:"url";s:34:"./index.php?c=platform&a=material&";s:15:"permission_name";s:17:"platform_material";s:4:"icon";s:12:"wi wi-redact";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:13:"platform_site";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:16:"微官网-文章";s:3:"url";s:38:"./index.php?c=site&a=multi&do=display&";s:15:"permission_name";s:13:"platform_site";s:4:"icon";s:10:"wi wi-home";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";a:0:{}}}}s:15:"platform_module";a:3:{s:5:"title";s:12:"应用模块";s:4:"menu";a:0:{}s:10:"is_display";b:1;}s:2:"mc";a:2:{s:5:"title";s:6:"粉丝";s:4:"menu";a:2:{s:7:"mc_fans";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"粉丝管理";s:3:"url";s:24:"./index.php?c=mc&a=fans&";s:15:"permission_name";s:7:"mc_fans";s:4:"icon";s:16:"wi wi-fansmanage";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:9:"mc_member";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"会员管理";s:3:"url";s:26:"./index.php?c=mc&a=member&";s:15:"permission_name";s:9:"mc_member";s:4:"icon";s:10:"wi wi-fans";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:7:"profile";a:2:{s:5:"title";s:6:"配置";s:4:"menu";a:2:{s:7:"profile";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"参数配置";s:3:"url";s:33:"./index.php?c=profile&a=passport&";s:15:"permission_name";s:15:"profile_setting";s:4:"icon";s:23:"wi wi-parameter-setting";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:7:"payment";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"支付参数";s:3:"url";s:32:"./index.php?c=profile&a=payment&";s:15:"permission_name";s:19:"profile_pay_setting";s:4:"icon";s:17:"wi wi-pay-setting";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}}s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:1;}s:5:"wxapp";a:7:{s:5:"title";s:9:"小程序";s:4:"icon";s:19:"wi wi-small-routine";s:3:"url";s:38:"./index.php?c=wxapp&a=display&do=home&";s:7:"section";a:3:{s:14:"wxapp_entrance";a:3:{s:5:"title";s:15:"小程序入口";s:4:"menu";a:1:{s:20:"module_entrance_link";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"入口页面";s:3:"url";s:36:"./index.php?c=wxapp&a=entrance-link&";s:15:"permission_name";s:19:"wxapp_entrance_link";s:4:"icon";s:18:"wi wi-data-synchro";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}s:10:"is_display";b:1;}s:12:"wxapp_module";a:3:{s:5:"title";s:6:"应用";s:4:"menu";a:0:{}s:10:"is_display";b:1;}s:20:"platform_manage_menu";a:2:{s:5:"title";s:6:"管理";s:4:"menu";a:3:{s:11:"module_link";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"数据同步";s:3:"url";s:42:"./index.php?c=wxapp&a=module-link-uniacid&";s:15:"permission_name";s:25:"wxapp_module_link_uniacid";s:4:"icon";s:18:"wi wi-data-synchro";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:13:"wxapp_profile";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"支付参数";s:3:"url";s:30:"./index.php?c=wxapp&a=payment&";s:15:"permission_name";s:13:"wxapp_payment";s:4:"icon";s:16:"wi wi-appsetting";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:14:"front_download";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:18:"上传微信审核";s:3:"url";s:37:"./index.php?c=wxapp&a=front-download&";s:15:"permission_name";s:20:"wxapp_front_download";s:4:"icon";s:13:"wi wi-examine";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}}s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:2;}s:6:"module";a:7:{s:5:"title";s:6:"应用";s:4:"icon";s:11:"wi wi-apply";s:3:"url";s:31:"./index.php?c=module&a=display&";s:7:"section";a:0:{}s:10:"is_display";b:1;s:9:"is_system";b:1;s:12:"displayorder";i:3;}s:6:"system";a:7:{s:5:"title";s:12:"系统管理";s:4:"icon";s:13:"wi wi-setting";s:3:"url";s:39:"./index.php?c=home&a=welcome&do=system&";s:7:"section";a:6:{s:10:"wxplatform";a:2:{s:5:"title";s:9:"公众号";s:4:"menu";a:4:{s:14:"system_account";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:16:" 微信公众号";s:3:"url";s:45:"./index.php?c=account&a=manage&account_type=1";s:15:"permission_name";s:14:"system_account";s:4:"icon";s:12:"wi wi-wechat";s:12:"displayorder";i:4;s:2:"id";N;s:14:"sub_permission";a:6:{i:0;a:2:{s:5:"title";s:21:"公众号管理设置";s:15:"permission_name";s:21:"system_account_manage";}i:1;a:2:{s:5:"title";s:15:"添加公众号";s:15:"permission_name";s:19:"system_account_post";}i:2;a:2:{s:5:"title";s:15:"公众号停用";s:15:"permission_name";s:19:"system_account_stop";}i:3;a:2:{s:5:"title";s:18:"公众号回收站";s:15:"permission_name";s:22:"system_account_recycle";}i:4;a:2:{s:5:"title";s:15:"公众号删除";s:15:"permission_name";s:21:"system_account_delete";}i:5;a:2:{s:5:"title";s:15:"公众号恢复";s:15:"permission_name";s:22:"system_account_recover";}}}s:13:"system_module";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"公众号应用";s:3:"url";s:51:"./index.php?c=module&a=manage-system&account_type=1";s:15:"permission_name";s:13:"system_module";s:4:"icon";s:14:"wi wi-wx-apply";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:15:"system_template";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"微官网模板";s:3:"url";s:32:"./index.php?c=system&a=template&";s:15:"permission_name";s:15:"system_template";s:4:"icon";s:17:"wi wi-wx-template";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:15:"system_platform";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:19:" 微信开放平台";s:3:"url";s:32:"./index.php?c=system&a=platform&";s:15:"permission_name";s:15:"system_platform";s:4:"icon";s:20:"wi wi-exploitsetting";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:6:"module";a:2:{s:5:"title";s:9:"小程序";s:4:"menu";a:2:{s:12:"system_wxapp";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"微信小程序";s:3:"url";s:45:"./index.php?c=account&a=manage&account_type=4";s:15:"permission_name";s:12:"system_wxapp";s:4:"icon";s:11:"wi wi-wxapp";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";a:6:{i:0;a:2:{s:5:"title";s:21:"小程序管理设置";s:15:"permission_name";s:19:"system_wxapp_manage";}i:1;a:2:{s:5:"title";s:15:"添加小程序";s:15:"permission_name";s:17:"system_wxapp_post";}i:2;a:2:{s:5:"title";s:15:"小程序停用";s:15:"permission_name";s:17:"system_wxapp_stop";}i:3;a:2:{s:5:"title";s:18:"小程序回收站";s:15:"permission_name";s:20:"system_wxapp_recycle";}i:4;a:2:{s:5:"title";s:15:"小程序删除";s:15:"permission_name";s:19:"system_wxapp_delete";}i:5;a:2:{s:5:"title";s:15:"小程序恢复";s:15:"permission_name";s:20:"system_wxapp_recover";}}}s:19:"system_module_wxapp";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"小程序应用";s:3:"url";s:51:"./index.php?c=module&a=manage-system&account_type=4";s:15:"permission_name";s:19:"system_module_wxapp";s:4:"icon";s:17:"wi wi-wxapp-apply";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:4:"user";a:2:{s:5:"title";s:13:"帐户/用户";s:4:"menu";a:2:{s:9:"system_my";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"我的帐户";s:3:"url";s:29:"./index.php?c=user&a=profile&";s:15:"permission_name";s:9:"system_my";s:4:"icon";s:10:"wi wi-user";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:11:"system_user";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"用户管理";s:3:"url";s:29:"./index.php?c=user&a=display&";s:15:"permission_name";s:11:"system_user";s:4:"icon";s:16:"wi wi-user-group";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";a:7:{i:0;a:2:{s:5:"title";s:12:"编辑用户";s:15:"permission_name";s:16:"system_user_post";}i:1;a:2:{s:5:"title";s:12:"审核用户";s:15:"permission_name";s:17:"system_user_check";}i:2;a:2:{s:5:"title";s:12:"店员管理";s:15:"permission_name";s:17:"system_user_clerk";}i:3;a:2:{s:5:"title";s:15:"用户回收站";s:15:"permission_name";s:19:"system_user_recycle";}i:4;a:2:{s:5:"title";s:18:"用户属性设置";s:15:"permission_name";s:18:"system_user_fields";}i:5;a:2:{s:5:"title";s:31:"用户属性设置-编辑字段";s:15:"permission_name";s:23:"system_user_fields_post";}i:6;a:2:{s:5:"title";s:18:"用户注册设置";s:15:"permission_name";s:23:"system_user_registerset";}}}}}s:10:"permission";a:2:{s:5:"title";s:12:"权限管理";s:4:"menu";a:2:{s:19:"system_module_group";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"应用权限组";s:3:"url";s:29:"./index.php?c=module&a=group&";s:15:"permission_name";s:19:"system_module_group";s:4:"icon";s:21:"wi wi-appjurisdiction";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";a:3:{i:0;a:2:{s:5:"title";s:21:"添加应用权限组";s:15:"permission_name";s:23:"system_module_group_add";}i:1;a:2:{s:5:"title";s:21:"编辑应用权限组";s:15:"permission_name";s:24:"system_module_group_post";}i:2;a:2:{s:5:"title";s:21:"删除应用权限组";s:15:"permission_name";s:23:"system_module_group_del";}}}s:17:"system_user_group";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"用户权限组";s:3:"url";s:27:"./index.php?c=user&a=group&";s:15:"permission_name";s:17:"system_user_group";s:4:"icon";s:22:"wi wi-userjurisdiction";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";a:3:{i:0;a:2:{s:5:"title";s:15:"添加用户组";s:15:"permission_name";s:21:"system_user_group_add";}i:1;a:2:{s:5:"title";s:15:"编辑用户组";s:15:"permission_name";s:22:"system_user_group_post";}i:2;a:2:{s:5:"title";s:15:"删除用户组";s:15:"permission_name";s:21:"system_user_group_del";}}}}}s:7:"article";a:2:{s:5:"title";s:13:"文章/公告";s:4:"menu";a:2:{s:14:"system_article";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"文章管理";s:3:"url";s:29:"./index.php?c=article&a=news&";s:15:"permission_name";s:19:"system_article_news";s:4:"icon";s:13:"wi wi-article";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:21:"system_article_notice";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"公告管理";s:3:"url";s:31:"./index.php?c=article&a=notice&";s:15:"permission_name";s:21:"system_article_notice";s:4:"icon";s:12:"wi wi-notice";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:5:"cache";a:2:{s:5:"title";s:6:"缓存";s:4:"menu";a:1:{s:26:"system_setting_updatecache";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"更新缓存";s:3:"url";s:35:"./index.php?c=system&a=updatecache&";s:15:"permission_name";s:26:"system_setting_updatecache";s:4:"icon";s:12:"wi wi-update";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}}s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:4;}s:4:"site";a:8:{s:5:"title";s:12:"站点管理";s:4:"icon";s:17:"wi wi-system-site";s:3:"url";s:30:"./index.php?c=cloud&a=upgrade&";s:7:"section";a:4:{s:5:"cloud";a:2:{s:5:"title";s:9:"云服务";s:4:"menu";a:4:{s:14:"system_profile";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"系统升级";s:3:"url";s:30:"./index.php?c=cloud&a=upgrade&";s:15:"permission_name";s:20:"system_cloud_upgrade";s:4:"icon";s:11:"wi wi-cache";s:12:"displayorder";i:4;s:2:"id";N;s:14:"sub_permission";N;}s:21:"system_cloud_register";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"注册站点";s:3:"url";s:30:"./index.php?c=cloud&a=profile&";s:15:"permission_name";s:21:"system_cloud_register";s:4:"icon";s:18:"wi wi-registersite";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:21:"system_cloud_diagnose";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"云服务诊断";s:3:"url";s:31:"./index.php?c=cloud&a=diagnose&";s:15:"permission_name";s:21:"system_cloud_diagnose";s:4:"icon";s:14:"wi wi-diagnose";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:16:"system_cloud_sms";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"短信管理";s:3:"url";s:26:"./index.php?c=cloud&a=sms&";s:15:"permission_name";s:16:"system_cloud_sms";s:4:"icon";s:13:"wi wi-message";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:7:"setting";a:2:{s:5:"title";s:6:"设置";s:4:"menu";a:6:{s:19:"system_setting_site";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"站点设置";s:3:"url";s:28:"./index.php?c=system&a=site&";s:15:"permission_name";s:19:"system_setting_site";s:4:"icon";s:18:"wi wi-site-setting";s:12:"displayorder";i:6;s:2:"id";N;s:14:"sub_permission";N;}s:19:"system_setting_menu";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"菜单设置";s:3:"url";s:28:"./index.php?c=system&a=menu&";s:15:"permission_name";s:19:"system_setting_menu";s:4:"icon";s:18:"wi wi-menu-setting";s:12:"displayorder";i:5;s:2:"id";N;s:14:"sub_permission";N;}s:25:"system_setting_attachment";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"附件设置";s:3:"url";s:34:"./index.php?c=system&a=attachment&";s:15:"permission_name";s:25:"system_setting_attachment";s:4:"icon";s:16:"wi wi-attachment";s:12:"displayorder";i:4;s:2:"id";N;s:14:"sub_permission";N;}s:25:"system_setting_systeminfo";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"系统信息";s:3:"url";s:34:"./index.php?c=system&a=systeminfo&";s:15:"permission_name";s:25:"system_setting_systeminfo";s:4:"icon";s:17:"wi wi-system-info";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:19:"system_setting_logs";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"查看日志";s:3:"url";s:28:"./index.php?c=system&a=logs&";s:15:"permission_name";s:19:"system_setting_logs";s:4:"icon";s:9:"wi wi-log";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:26:"system_setting_ipwhitelist";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:11:"IP白名单";s:3:"url";s:35:"./index.php?c=system&a=ipwhitelist&";s:15:"permission_name";s:26:"system_setting_ipwhitelist";s:4:"icon";s:8:"wi wi-ip";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:7:"utility";a:2:{s:5:"title";s:12:"常用工具";s:4:"menu";a:5:{s:24:"system_utility_filecheck";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:18:"系统文件校验";s:3:"url";s:33:"./index.php?c=system&a=filecheck&";s:15:"permission_name";s:24:"system_utility_filecheck";s:4:"icon";s:10:"wi wi-file";s:12:"displayorder";i:5;s:2:"id";N;s:14:"sub_permission";N;}s:23:"system_utility_optimize";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"性能优化";s:3:"url";s:32:"./index.php?c=system&a=optimize&";s:15:"permission_name";s:23:"system_utility_optimize";s:4:"icon";s:14:"wi wi-optimize";s:12:"displayorder";i:4;s:2:"id";N;s:14:"sub_permission";N;}s:23:"system_utility_database";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:9:"数据库";s:3:"url";s:32:"./index.php?c=system&a=database&";s:15:"permission_name";s:23:"system_utility_database";s:4:"icon";s:9:"wi wi-sql";s:12:"displayorder";i:3;s:2:"id";N;s:14:"sub_permission";N;}s:19:"system_utility_scan";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"木马查杀";s:3:"url";s:28:"./index.php?c=system&a=scan&";s:15:"permission_name";s:19:"system_utility_scan";s:4:"icon";s:12:"wi wi-safety";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:18:"system_utility_bom";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:15:"检测文件BOM";s:3:"url";s:27:"./index.php?c=system&a=bom&";s:15:"permission_name";s:18:"system_utility_bom";s:4:"icon";s:9:"wi wi-bom";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}s:9:"workorder";a:2:{s:5:"title";s:12:"工单系统";s:4:"menu";a:1:{s:16:"system_workorder";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:12:"工单系统";s:3:"url";s:44:"./index.php?c=system&a=workorder&do=display&";s:15:"permission_name";s:16:"system_workorder";s:4:"icon";s:17:"wi wi-system-work";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}}s:7:"founder";b:1;s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:5;}s:13:"advertisement";a:8:{s:5:"title";s:12:"广告联盟";s:4:"icon";s:12:"wi wi-advert";s:3:"url";s:47:"./index.php?c=advertisement&a=content-provider&";s:7:"section";a:1:{s:13:"advertisement";a:2:{s:5:"title";s:18:"常用系统工具";s:4:"menu";a:2:{s:30:"advertisement-content-provider";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:9:"流量主";s:3:"url";s:63:"./index.php?c=advertisement&a=content-provider&do=account_list&";s:15:"permission_name";s:25:"advertisement_content-use";s:4:"icon";s:10:"wi wi-flow";s:12:"displayorder";i:2;s:2:"id";N;s:14:"sub_permission";N;}s:28:"advertisement-content-create";a:9:{s:9:"is_system";i:1;s:10:"is_display";i:1;s:5:"title";s:9:"广告主";s:3:"url";s:67:"./index.php?c=advertisement&a=content-provider&do=content_provider&";s:15:"permission_name";s:28:"advertisement_content-create";s:4:"icon";s:13:"wi wi-adgroup";s:12:"displayorder";i:1;s:2:"id";N;s:14:"sub_permission";N;}}}}s:7:"founder";b:1;s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:6;}s:9:"appmarket";a:9:{s:5:"title";s:12:"应用市场";s:4:"icon";s:12:"wi wi-market";s:3:"url";s:15:"http://s.we7.cc";s:7:"section";a:0:{}s:5:"blank";b:1;s:7:"founder";b:1;s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:7;}s:4:"help";a:8:{s:5:"title";s:12:"帮助系统";s:4:"icon";s:12:"wi wi-market";s:3:"url";s:29:"./index.php?c=help&a=display&";s:7:"section";a:0:{}s:5:"blank";b:0;s:9:"is_system";b:1;s:10:"is_display";b:1;s:12:"displayorder";i:8;}}'),
('we7:2:site_store_buy_modules', 'a:0:{}'),
('we7:lastaccount:m9idM', 'a:1:{s:7:"account";i:2;}'),
('we7:user_modules:1', 'a:12:{i:0;s:14:"feng_community";i:1;s:6:"wxcard";i:2;s:5:"chats";i:3;s:5:"voice";i:4;s:5:"video";i:5;s:6:"images";i:6;s:6:"custom";i:7;s:8:"recharge";i:8;s:7:"userapi";i:9;s:5:"music";i:10;s:4:"news";i:11;s:5:"basic";}'),
('we7:unimodules:2:', 'a:12:{s:5:"basic";a:1:{s:4:"name";s:5:"basic";}s:4:"news";a:1:{s:4:"name";s:4:"news";}s:5:"music";a:1:{s:4:"name";s:5:"music";}s:7:"userapi";a:1:{s:4:"name";s:7:"userapi";}s:8:"recharge";a:1:{s:4:"name";s:8:"recharge";}s:6:"custom";a:1:{s:4:"name";s:6:"custom";}s:6:"images";a:1:{s:4:"name";s:6:"images";}s:5:"video";a:1:{s:4:"name";s:5:"video";}s:5:"voice";a:1:{s:4:"name";s:5:"voice";}s:5:"chats";a:1:{s:4:"name";s:5:"chats";}s:6:"wxcard";a:1:{s:4:"name";s:6:"wxcard";}s:14:"feng_community";a:1:{s:4:"name";s:14:"feng_community";}}'),
('we7:module_info:basic', 'a:25:{s:3:"mid";s:1:"1";s:4:"name";s:5:"basic";s:4:"type";s:6:"system";s:5:"title";s:18:"基本文字回复";s:7:"version";s:3:"1.0";s:7:"ability";s:24:"和您进行简单对话";s:11:"description";s:201:"一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:56:"http://wuye.iot-gj.cn/addons/basic/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:news', 'a:25:{s:3:"mid";s:1:"2";s:4:"name";s:4:"news";s:4:"type";s:6:"system";s:5:"title";s:24:"基本混合图文回复";s:7:"version";s:3:"1.0";s:7:"ability";s:33:"为你提供生动的图文资讯";s:11:"description";s:272:"一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:55:"http://wuye.iot-gj.cn/addons/news/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:music', 'a:25:{s:3:"mid";s:1:"3";s:4:"name";s:5:"music";s:4:"type";s:6:"system";s:5:"title";s:18:"基本音乐回复";s:7:"version";s:3:"1.0";s:7:"ability";s:39:"提供语音、音乐等音频类回复";s:11:"description";s:183:"在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:56:"http://wuye.iot-gj.cn/addons/music/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:userapi', 'a:25:{s:3:"mid";s:1:"4";s:4:"name";s:7:"userapi";s:4:"type";s:6:"system";s:5:"title";s:21:"自定义接口回复";s:7:"version";s:3:"1.1";s:7:"ability";s:33:"更方便的第三方接口设置";s:11:"description";s:141:"自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:58:"http://wuye.iot-gj.cn/addons/userapi/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:recharge', 'a:25:{s:3:"mid";s:1:"5";s:4:"name";s:8:"recharge";s:4:"type";s:6:"system";s:5:"title";s:24:"会员中心充值模块";s:7:"version";s:3:"1.0";s:7:"ability";s:24:"提供会员充值功能";s:11:"description";s:0:"";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"0";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:59:"http://wuye.iot-gj.cn/addons/recharge/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:custom', 'a:25:{s:3:"mid";s:1:"6";s:4:"name";s:6:"custom";s:4:"type";s:6:"system";s:5:"title";s:15:"多客服转接";s:7:"version";s:5:"1.0.0";s:7:"ability";s:36:"用来接入腾讯的多客服系统";s:11:"description";s:0:"";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:17:"http://bbs.we7.cc";s:8:"settings";s:1:"0";s:10:"subscribes";a:0:{}s:7:"handles";a:6:{i:0;s:5:"image";i:1;s:5:"voice";i:2;s:5:"video";i:3;s:8:"location";i:4;s:4:"link";i:5;s:4:"text";}s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:57:"http://wuye.iot-gj.cn/addons/custom/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:images', 'a:25:{s:3:"mid";s:1:"7";s:4:"name";s:6:"images";s:4:"type";s:6:"system";s:5:"title";s:18:"基本图片回复";s:7:"version";s:3:"1.0";s:7:"ability";s:18:"提供图片回复";s:11:"description";s:132:"在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:57:"http://wuye.iot-gj.cn/addons/images/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:video', 'a:25:{s:3:"mid";s:1:"8";s:4:"name";s:5:"video";s:4:"type";s:6:"system";s:5:"title";s:18:"基本视频回复";s:7:"version";s:3:"1.0";s:7:"ability";s:18:"提供图片回复";s:11:"description";s:132:"在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:56:"http://wuye.iot-gj.cn/addons/video/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:voice', 'a:25:{s:3:"mid";s:1:"9";s:4:"name";s:5:"voice";s:4:"type";s:6:"system";s:5:"title";s:18:"基本语音回复";s:7:"version";s:3:"1.0";s:7:"ability";s:18:"提供语音回复";s:11:"description";s:132:"在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:56:"http://wuye.iot-gj.cn/addons/voice/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:chats', 'a:25:{s:3:"mid";s:2:"10";s:4:"name";s:5:"chats";s:4:"type";s:6:"system";s:5:"title";s:18:"发送客服消息";s:7:"version";s:3:"1.0";s:7:"ability";s:77:"公众号可以在粉丝最后发送消息的48小时内无限制发送消息";s:11:"description";s:0:"";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"0";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:56:"http://wuye.iot-gj.cn/addons/chats/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:module_info:wxcard', 'a:25:{s:3:"mid";s:2:"11";s:4:"name";s:6:"wxcard";s:4:"type";s:6:"system";s:5:"title";s:18:"微信卡券回复";s:7:"version";s:3:"1.0";s:7:"ability";s:18:"微信卡券回复";s:11:"description";s:18:"微信卡券回复";s:6:"author";s:13:"WeEngine Team";s:3:"url";s:18:"http://www.we7.cc/";s:8:"settings";s:1:"0";s:10:"subscribes";s:0:"";s:7:"handles";s:0:"";s:12:"isrulefields";s:1:"1";s:8:"issystem";s:1:"1";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:0:"";s:13:"title_initial";s:0:"";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:57:"http://wuye.iot-gj.cn/addons/wxcard/icon.jpg?v=1508743514";s:11:"main_module";b:0;s:11:"plugin_list";a:0:{}s:11:"is_relation";b:0;}'),
('we7:unimodules:2:1', 'a:12:{s:5:"basic";a:1:{s:4:"name";s:5:"basic";}s:4:"news";a:1:{s:4:"name";s:4:"news";}s:5:"music";a:1:{s:4:"name";s:5:"music";}s:7:"userapi";a:1:{s:4:"name";s:7:"userapi";}s:8:"recharge";a:1:{s:4:"name";s:8:"recharge";}s:6:"custom";a:1:{s:4:"name";s:6:"custom";}s:6:"images";a:1:{s:4:"name";s:6:"images";}s:5:"video";a:1:{s:4:"name";s:5:"video";}s:5:"voice";a:1:{s:4:"name";s:5:"voice";}s:5:"chats";a:1:{s:4:"name";s:5:"chats";}s:6:"wxcard";a:1:{s:4:"name";s:6:"wxcard";}s:14:"feng_community";a:1:{s:4:"name";s:14:"feng_community";}}'),
('we7:lastaccount:dZM66', 'a:1:{s:7:"account";i:2;}'),
('accesstoken:2', 'a:2:{s:5:"token";s:138:"edlFFGiKsgt3GpuVPmyKQM9aDbbXrw5LbS8RxEEWKpaNYC1tvIutiY6csfP6daZuyDh_R_wYN-uPJ3RxEBGaq_VvdU3wxC-MPLdRYt89o5KMSCGtSvt6krxhorqP9zr2DDKfABAXXE";s:6:"expire";i:1508838180;}'),
('unicount:2', 's:1:"1";'),
('stat:todaylock:2', 'a:1:{s:6:"expire";i:1508830697;}'),
('we7:lastaccount:xB5OM', 'a:1:{s:7:"account";i:2;}'),
('we7:module_info:feng_community', 'a:25:{s:3:"mid";s:2:"12";s:4:"name";s:14:"feng_community";s:4:"type";s:8:"business";s:5:"title";s:9:"微小区";s:7:"version";s:9:"9.2.8.3.0";s:7:"ability";s:9:"微小区";s:11:"description";s:9:"微小区";s:6:"author";s:12:"蓝牛科技";s:3:"url";s:9:"we7xq.com";s:8:"settings";s:1:"0";s:10:"subscribes";a:0:{}s:7:"handles";a:0:{}s:12:"isrulefields";s:1:"0";s:8:"issystem";s:1:"0";s:6:"target";s:1:"0";s:6:"iscard";s:1:"0";s:11:"permissions";s:2:"N;";s:13:"title_initial";s:1:"W";s:13:"wxapp_support";s:1:"1";s:11:"app_support";s:1:"2";s:9:"isdisplay";i:1;s:4:"logo";s:65:"http://wuye.iot-gj.cn/addons/feng_community/icon.jpg?v=1508830096";s:11:"main_module";b:0;s:11:"plugin_list";a:3:{i:0;s:25:"feng_community_plugin_adv";i:1;s:26:"feng_community_plugin_lift";i:2;s:30:"feng_community_plugin_chinaums";}s:11:"is_relation";b:0;}'),
('we7:all_cloud_upgrade_module:', 'a:2:{s:6:"expire";i:1508831894;s:4:"data";a:0:{}}'),
('we7:module:all_uninstall', 'a:2:{s:6:"expire";i:1508837222;s:4:"data";a:4:{s:13:"cloud_m_count";i:1;s:7:"modules";a:2:{s:7:"recycle";a:0:{}s:11:"uninstalled";a:1:{s:3:"app";a:1:{s:10:"we7_coupon";a:9:{s:4:"from";s:5:"cloud";s:4:"name";s:10:"we7_coupon";s:7:"version";s:3:"5.2";s:5:"title";s:12:"系统卡券";s:5:"thumb";s:70:"//cdn.w7.cc/images/2016/12/09/1481254171584a251b870ac_suOvk0vhuC35.png";s:13:"wxapp_support";i:1;s:11:"app_support";s:1:"2";s:11:"main_module";s:0:"";s:15:"upgrade_support";b:0;}}}}s:9:"app_count";i:1;s:11:"wxapp_count";i:0;}}'),
('cloud:ad:uniaccount:list', 'a:2:{s:6:"expire";i:1508745068;s:7:"setting";a:0:{}}'),
('defaultgroupid:2', 's:1:"2";'),
('we7:memberinfo:15', 'a:52:{s:3:"uid";s:2:"15";s:7:"uniacid";s:1:"2";s:6:"mobile";s:11:"13724303493";s:5:"email";s:39:"60a7a2fcd524b6241665b12af0a25342@we7.cc";s:8:"password";s:32:"a0b511c4fab2ca84ec9851ea1a0f4522";s:4:"salt";s:8:"OreRCUcd";s:7:"groupid";s:1:"2";s:7:"credit1";d:0;s:7:"credit2";d:0;s:7:"credit3";d:0;s:7:"credit4";d:0;s:7:"credit5";d:0;s:7:"credit6";d:0;s:10:"createtime";s:10:"1504682127";s:8:"realname";s:9:"段利华";s:8:"nickname";s:3:"华";s:6:"avatar";s:143:"http://wx.qlogo.cn/mmopen/PiajxSqBRaEKiaLDIHJic1mRCmxyF6bftktiaQNHZysBCviawbTsYPs6TqDDLeROtQQ47KbIVpoKJmpPu9ETlRyicWGeWgYwTJSbEKqTRoupvQzAM/132";s:2:"qq";s:0:"";s:3:"vip";s:1:"0";s:6:"gender";s:1:"0";s:9:"birthyear";s:1:"0";s:10:"birthmonth";s:1:"0";s:8:"birthday";s:1:"0";s:13:"constellation";s:0:"";s:6:"zodiac";s:0:"";s:9:"telephone";s:0:"";s:6:"idcard";s:0:"";s:9:"studentid";s:0:"";s:5:"grade";s:0:"";s:7:"address";s:0:"";s:7:"zipcode";s:0:"";s:11:"nationality";s:0:"";s:14:"resideprovince";s:0:"";s:10:"residecity";s:0:"";s:10:"residedist";s:0:"";s:14:"graduateschool";s:0:"";s:7:"company";s:0:"";s:9:"education";s:0:"";s:10:"occupation";s:0:"";s:8:"position";s:0:"";s:7:"revenue";s:0:"";s:15:"affectivestatus";s:0:"";s:10:"lookingfor";s:0:"";s:9:"bloodtype";s:0:"";s:6:"height";s:0:"";s:6:"weight";s:0:"";s:6:"alipay";s:0:"";s:3:"msn";s:0:"";s:6:"taobao";s:0:"";s:4:"site";s:0:"";s:3:"bio";s:0:"";s:8:"interest";s:0:"";}'),
('module_receive_enable', 'a:0:{}'),
('jsticket:2', 'a:2:{s:6:"ticket";s:86:"kgt8ON7yVITDhtdwci0qeW-STSPw54pgdqkA5YsTloyqjJdRnNbbq3xiB5iT0slz0rIEwcJYxYxAQAVSJgPFvw";s:6:"expire";i:1508838180;}'),
('we7:lastaccount:zcfEy', 'a:1:{s:7:"account";i:2;}');

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_cron`
--

CREATE TABLE IF NOT EXISTS `ims_core_cron` (
  `id` int(10) unsigned NOT NULL,
  `cloudid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `lastruntime` int(10) unsigned NOT NULL,
  `nextruntime` int(10) unsigned NOT NULL,
  `weekday` tinyint(3) NOT NULL,
  `day` tinyint(3) NOT NULL,
  `hour` tinyint(3) NOT NULL,
  `minute` varchar(255) NOT NULL,
  `extra` varchar(5000) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_cron_record`
--

CREATE TABLE IF NOT EXISTS `ims_core_cron_record` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `note` varchar(500) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_menu`
--

CREATE TABLE IF NOT EXISTS `ims_core_menu` (
  `id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `url` varchar(255) NOT NULL,
  `append_title` varchar(30) NOT NULL,
  `append_url` varchar(255) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `is_display` tinyint(3) unsigned NOT NULL,
  `is_system` tinyint(3) unsigned NOT NULL,
  `permission_name` varchar(50) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_paylog`
--

CREATE TABLE IF NOT EXISTS `ims_core_paylog` (
  `plid` bigint(11) unsigned NOT NULL,
  `type` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `acid` int(10) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `tid` varchar(128) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) unsigned NOT NULL,
  `card_type` tinyint(3) unsigned NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `card_fee` decimal(10,2) unsigned NOT NULL,
  `encrypt_code` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_core_paylog`
--

INSERT INTO `ims_core_paylog` (`plid`, `type`, `uniacid`, `acid`, `openid`, `uniontid`, `tid`, `fee`, `status`, `module`, `tag`, `is_usecard`, `card_type`, `card_id`, `card_fee`, `encrypt_code`) VALUES
(1, '', 2, 2, '1', '', '20170809161248889688', '10.00', 0, 'feng_community', '', 0, 0, '', '10.00', ''),
(2, 'alipay', 2, 2, '1', '2017080916134200001242851520', '20170809161385924499', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(3, '', 2, 2, '1', '', '20170809172182828242', '1.00', 0, 'feng_community', '', 0, 0, '', '1.00', ''),
(4, 'alipay', 2, 2, '1', '2017080917401400001276700856', '20170809174062234425', '100.00', 0, 'feng_community', '', 0, 0, '0', '100.00', ''),
(5, 'alipay', 2, 2, '1', '2017080917432000001222682498', '20170809174321788884', '100.00', 0, 'feng_community', '', 0, 0, '0', '100.00', ''),
(6, '', 2, 2, '1', '', '20170809175368048361', '10.00', 0, 'feng_community', '', 0, 0, '', '10.00', ''),
(7, 'alipay', 2, 2, '2', '2017080918130300001296047247', '20170809181291312308', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(8, '', 2, 2, '1', '', '20170809184062219762', '1.00', 0, 'feng_community', '', 0, 0, '', '1.00', ''),
(9, 'credit', 2, 2, '1', '2017080918421800001219142672', '20170809184268843810', '1.00', 1, 'feng_community', '', 0, 0, '0', '1.00', ''),
(10, '', 2, 2, 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '', '20170809184222766629', '100.00', 0, 'feng_community', '', 0, 0, '', '100.00', ''),
(11, 'credit', 2, 2, 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '2017080918430100001292312124', '20170809184226921402', '100.00', 1, 'feng_community', '', 0, 0, '0', '100.00', ''),
(12, 'credit', 2, 2, '1', '2017080918440300001288126766', '20170809184448066432', '10.00', 1, 'feng_community', '', 0, 0, '0', '10.00', ''),
(13, 'credit', 2, 2, '1', '2017081010502000001288853204', '20170810104943680846', '10.00', 1, 'feng_community', '', 0, 0, '0', '10.00', ''),
(14, 'delivery', 2, 2, '2', '2017101210032200001280878668', '20171012100381282129', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(15, 'alipay', 2, 2, '37', '2017101221454000001288848184', '20171012214593449449', '21.00', 0, 'feng_community', '', 0, 0, '0', '21.00', ''),
(16, 'credit', 2, 2, '38', '2017101223131400001287222286', '20171012231295410917', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(17, '', 2, 2, '38', '', '20171012231363282784', '12.00', 0, 'feng_community', '', 0, 0, '', '12.00', ''),
(18, 'alipay', 2, 2, '37', '2017101223483600001293586276', '20171012234865288031', '21.00', 0, 'feng_community', '', 0, 0, '0', '21.00', ''),
(19, 'credit', 2, 2, '38', '2017101223485100001224263831', '20171012234884763864', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(20, 'delivery', 2, 2, '37', '2017101223491400001243384639', '20171012234948623265', '12.00', 0, 'feng_community', '', 0, 0, '0', '12.00', ''),
(21, 'alipay', 2, 2, '38', '2017101223491100001252736246', '20171012234924743542', '10.00', 0, 'feng_community', '', 0, 0, '0', '10.00', ''),
(22, '', 2, 2, '38', '', '20171012234908528638', '21.00', 0, 'feng_community', '', 0, 0, '', '21.00', ''),
(23, 'credit', 2, 2, '1', '2017102417092500001248678442', '20171024170902884838', '12.00', 1, 'feng_community', '', 0, 0, '0', '12.00', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_performance`
--

CREATE TABLE IF NOT EXISTS `ims_core_performance` (
  `id` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL,
  `runtime` varchar(10) NOT NULL,
  `runurl` varchar(512) NOT NULL,
  `runsql` varchar(512) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_queue`
--

CREATE TABLE IF NOT EXISTS `ims_core_queue` (
  `qid` bigint(20) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `message` varchar(2000) NOT NULL,
  `params` varchar(1000) NOT NULL,
  `keyword` varchar(1000) NOT NULL,
  `response` varchar(2000) NOT NULL,
  `module` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_refundlog`
--

CREATE TABLE IF NOT EXISTS `ims_core_refundlog` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `refund_uniontid` varchar(64) NOT NULL,
  `reason` varchar(80) NOT NULL,
  `uniontid` varchar(64) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_resource`
--

CREATE TABLE IF NOT EXISTS `ims_core_resource` (
  `mid` int(11) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `trunk` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `dateline` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_sendsms_log`
--

CREATE TABLE IF NOT EXISTS `ims_core_sendsms_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `createtime` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_sessions`
--

CREATE TABLE IF NOT EXISTS `ims_core_sessions` (
  `sid` char(32) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `data` varchar(5000) NOT NULL,
  `expiretime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_core_sessions`
--

INSERT INTO `ims_core_sessions` (`sid`, `uniacid`, `openid`, `data`, `expiretime`) VALUES
('839cb8ab1c49988545c6546309f1d53c', 2, 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', 'openid|s:28:"oNjw9wqWBsgRd7zoXDyh6GdK6Qjc";', 1508838892),
('05d9408ee5c5953858e0bde58472b869', 2, '120.204.17.73', 'acid|s:1:"2";uniacid|i:2;token|a:1:{s:4:"nkeV";i:1508836133;}dest_url|s:106:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26do%3Dannouncement%26m%3Dfeng_community";', 1508839733),
('98c645916157bc2c3e5943532afca34d', 2, '117.185.27.114', 'acid|s:1:"2";uniacid|i:2;token|a:1:{s:4:"MtnD";i:1508836161;}dest_url|s:125:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26op%3Ddetail%26do%3Dshopping%26m%3Dfeng_community%26id%3D5";', 1508839761),
('ac91c8cb92e3e7309b570542acce5086', 2, '116.1.75.180', 'acid|s:1:"2";uniacid|i:2;token|a:6:{s:4:"tFbN";i:1508833100;s:4:"Yx5V";i:1508833100;s:4:"bRgB";i:1508833102;s:4:"n763";i:1508833104;s:4:"d8l8";i:1508833104;s:4:"kvSv";i:1508833105;}dest_url|s:129:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26do%3Dregister%26m%3Dfeng_community%26wxref%3Dmp.weixin.qq.com";oauth_openid|s:28:"oNjw9wqWBsgRd7zoXDyh6GdK6Qjc";oauth_acid|s:1:"2";openid|s:28:"oNjw9wqWBsgRd7zoXDyh6GdK6Qjc";uid|s:1:"1";', 1508836705),
('930b78710af901363d8d49960d8c081f', 2, '101.226.89.121', 'acid|s:1:"2";uniacid|i:2;token|a:1:{s:4:"d87W";i:1508836341;}dest_url|s:106:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26do%3Dannouncement%26m%3Dfeng_community";', 1508839941),
('325d446eb53dd2b2647d112dd78b1fbe', 2, '101.226.33.218', 'acid|s:1:"2";uniacid|i:2;token|a:1:{s:4:"gQm4";i:1508836385;}dest_url|s:128:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26op%3Dpay%26orderid%3D44%26do%3Dshopping%26m%3Dfeng_community";', 1508839985),
('a7a3779a34a6c7348148a9ebfd4817b9', 2, '101.226.33.226', 'acid|s:1:"2";uniacid|i:2;token|a:1:{s:4:"kC2Q";i:1508836398;}dest_url|s:407:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dmc%26a%3Dcash%26do%3Dcredit%26notify%3Dyes%26params%3DeyJ0aWQiOiIyMDE3MTAyNDE3MDkwMjg4NDgzOCIsInVzZXIiOiJvTmp3OXdxV0JzZ1JkN3pvWER5aDZHZEs2UWpjIiwiZmVlIjoiMTIuMDAiLCJvcmRlcnNuIjoiMjAxNzEwMjQxNzA5MDI4ODQ4MzgiLCJ2aXJ0dWFsIjpmYWxzZSwibW9kdWxlIjoiZmVuZ19jb21tdW5pdHkiLCJ0aXRsZSI6Ilx1NTc1YVx1Njc5YyIsInVzZXJpZCI6IjEifQ%253D%253D%26code%3D%26coupon_id%3D";', 1508839998),
('4b24080ee9400e409b8ad595a3cac1ff', 2, '116.1.75.180', 'acid|s:1:"2";uniacid|i:2;token|a:6:{s:4:"WMak";i:1508836171;s:4:"zAde";i:1508836175;s:4:"mevA";i:1508836178;s:4:"n22m";i:1508836179;s:4:"kJdE";i:1508836182;s:4:"Bh5P";i:1508836183;}dest_url|s:75:"http%3A%2F%2Fwuye.iot-gj.cn%2Fapp%2Findex.php%3Fi%3D2%26c%3Dentry%26eid%3D1";oauth_openid|s:28:"oNjw9wqWBsgRd7zoXDyh6GdK6Qjc";oauth_acid|s:1:"2";openid|s:28:"oNjw9wqWBsgRd7zoXDyh6GdK6Qjc";uid|s:1:"1";', 1508839783);

-- --------------------------------------------------------

--
-- 表的结构 `ims_core_settings`
--

CREATE TABLE IF NOT EXISTS `ims_core_settings` (
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_core_settings`
--

INSERT INTO `ims_core_settings` (`key`, `value`) VALUES
('copyright', 'a:2:{s:6:"status";s:1:"0";s:6:"reason";s:15:"备份数据库";}'),
('module_receive_ban', 'a:1:{s:14:"feng_community";s:14:"feng_community";}'),
('authmode', 'i:1;'),
('close', 'a:2:{s:6:"status";s:1:"0";s:6:"reason";s:0:"";}'),
('register', 'a:4:{s:4:"open";i:1;s:6:"verify";i:0;s:4:"code";i:1;s:7:"groupid";i:1;}'),
('site', 'a:6:{s:3:"key";s:5:"99202";s:5:"token";s:32:"b37028cd06062ddb1aefe69b4a5c4be5";s:3:"url";s:21:"http://wuye.iot-gj.cn";s:7:"version";s:3:"1.0";s:6:"family";s:1:"v";s:15:"profile_perfect";b:1;}'),
('cloudip', 'a:2:{s:2:"ip";s:12:"42.56.76.104";s:6:"expire";i:1508837229;}'),
('module_ban', 'a:0:{}'),
('module_upgrade', 'a:0:{}'),
('sms.info', 'a:3:{s:3:"key";s:5:"99202";s:8:"sms_sign";a:0:{}s:9:"sms_count";i:0;}'),
('platform', 'a:5:{s:5:"token";s:32:"itKThGnTgGk9gzszSFshShcJhkkgs5tC";s:14:"encodingaeskey";s:43:"hOq7yAkNrYfPAfqCKYFpofP66N26PkCPFAabY6f7pny";s:9:"appsecret";s:0:"";s:5:"appid";s:0:"";s:9:"authstate";i:1;}');

-- --------------------------------------------------------

--
-- 表的结构 `ims_coupon_location`
--

CREATE TABLE IF NOT EXISTS `ims_coupon_location` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `business_name` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(15) NOT NULL,
  `district` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `photo_list` varchar(10000) NOT NULL,
  `avg_price` int(10) unsigned NOT NULL,
  `open_time` varchar(50) NOT NULL,
  `recommend` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `introduction` varchar(255) NOT NULL,
  `offset_type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_cover_reply`
--

CREATE TABLE IF NOT EXISTS `ims_cover_reply` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `do` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_cover_reply`
--

INSERT INTO `ims_cover_reply` (`id`, `uniacid`, `multiid`, `rid`, `module`, `do`, `title`, `description`, `thumb`, `url`) VALUES
(1, 1, 0, 7, 'mc', '', '进入个人中心', '', '', './index.php?c=mc&a=home&i=1'),
(2, 1, 1, 8, 'site', '', '进入首页', '', '', './index.php?c=home&i=1&t=1'),
(3, 2, 0, 9, 'feng_community', 'home', '嘉洲富苑', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/K5vvluqlK646n58l7E65L778BPTO8e.jpg', './index.php?i=2&c=entry&do=home&m=feng_community'),
(4, 2, 0, 10, 'feng_community', 'home', '嘉洲富苑', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/09/Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj.jpg', './index.php?i=2&c=entry&regionid=1&do=home&m=feng_community'),
(5, 2, 0, 11, 'feng_community', 'business', '多多母婴', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/rnfN4siTpGguUGu2NfE3tguN3ungiU.jpg', './index.php?i=2&c=entry&op=detail&id=1&do=business&m=feng_community');

-- --------------------------------------------------------

--
-- 表的结构 `ims_custom_reply`
--

CREATE TABLE IF NOT EXISTS `ims_custom_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `start1` int(10) NOT NULL,
  `end1` int(10) NOT NULL,
  `start2` int(10) NOT NULL,
  `end2` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_images_reply`
--

CREATE TABLE IF NOT EXISTS `ims_images_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_cash_record`
--

CREATE TABLE IF NOT EXISTS `ims_mc_cash_record` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `fee` decimal(10,2) unsigned NOT NULL,
  `final_fee` decimal(10,2) unsigned NOT NULL,
  `credit1` int(10) unsigned NOT NULL,
  `credit1_fee` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `cash` decimal(10,2) unsigned NOT NULL,
  `return_cash` decimal(10,2) unsigned NOT NULL,
  `final_cash` decimal(10,2) unsigned NOT NULL,
  `remark` varchar(255) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `trade_type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_chats_record`
--

CREATE TABLE IF NOT EXISTS `ims_mc_chats_record` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `flag` tinyint(3) unsigned NOT NULL,
  `openid` varchar(32) NOT NULL,
  `msgtype` varchar(15) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_chats_record`
--

INSERT INTO `ims_mc_chats_record` (`id`, `uniacid`, `acid`, `flag`, `openid`, `msgtype`, `content`, `createtime`) VALUES
(1, 2, 0, 1, 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', 'text', 'a:1:{s:7:"content";s:9:"asdfasdfa";}', 1502248110);

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_credits_recharge`
--

CREATE TABLE IF NOT EXISTS `ims_mc_credits_recharge` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `tid` varchar(64) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `fee` varchar(10) NOT NULL,
  `type` varchar(15) NOT NULL,
  `tag` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `backtype` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_credits_record`
--

CREATE TABLE IF NOT EXISTS `ims_mc_credits_record` (
  `id` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `credittype` varchar(10) NOT NULL,
  `num` decimal(10,2) NOT NULL,
  `operator` int(10) unsigned NOT NULL,
  `module` varchar(30) NOT NULL,
  `clerk_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `clerk_type` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_credits_record`
--

INSERT INTO `ims_mc_credits_record` (`id`, `uid`, `uniacid`, `credittype`, `num`, `operator`, `module`, `clerk_id`, `store_id`, `clerk_type`, `createtime`, `remark`) VALUES
(1, 1, 2, 'credit2', '10000.00', 1, 'system', 1, 0, 2, 1502275324, '系统后台: 添加10000元'),
(2, 1, 2, 'credit2', '-1.00', 1, '', 0, 0, 1, 1502275338, '消费credit2:1'),
(3, 1, 2, 'credit2', '-100.00', 1, '', 0, 0, 1, 1502275381, '消费credit2:100'),
(4, 1, 2, 'credit2', '-10.00', 1, '', 0, 0, 1, 1502275443, '消费credit2:10'),
(5, 1, 2, 'credit2', '-10.00', 1, '', 0, 0, 1, 1502333420, '消费credit2:10'),
(6, 1, 2, 'credit2', '-12.00', 1, '', 0, 0, 1, 1508836178, '消费credit2:12');

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_fans_groups`
--

CREATE TABLE IF NOT EXISTS `ims_mc_fans_groups` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groups` varchar(10000) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_fans_groups`
--

INSERT INTO `ims_mc_fans_groups` (`id`, `uniacid`, `acid`, `groups`) VALUES
(1, 2, 2, 'a:1:{i:2;a:3:{s:2:"id";i:2;s:4:"name";s:9:"星标组";s:5:"count";i:0;}}');

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_fans_tag_mapping`
--

CREATE TABLE IF NOT EXISTS `ims_mc_fans_tag_mapping` (
  `id` int(11) unsigned NOT NULL,
  `fanid` int(11) unsigned NOT NULL,
  `tagid` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_groups`
--

CREATE TABLE IF NOT EXISTS `ims_mc_groups` (
  `groupid` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `credit` int(10) unsigned NOT NULL,
  `isdefault` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_groups`
--

INSERT INTO `ims_mc_groups` (`groupid`, `uniacid`, `title`, `credit`, `isdefault`) VALUES
(1, 1, '默认会员组', 0, 1),
(2, 2, '默认会员组', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_handsel`
--

CREATE TABLE IF NOT EXISTS `ims_mc_handsel` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `touid` int(10) unsigned NOT NULL,
  `fromuid` varchar(32) NOT NULL,
  `module` varchar(30) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `action` varchar(20) NOT NULL,
  `credit_value` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_mapping_fans`
--

CREATE TABLE IF NOT EXISTS `ims_mc_mapping_fans` (
  `fanid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `groupid` varchar(30) NOT NULL,
  `salt` char(8) NOT NULL,
  `follow` tinyint(1) unsigned NOT NULL,
  `followtime` int(10) unsigned NOT NULL,
  `unfollowtime` int(10) unsigned NOT NULL,
  `tag` varchar(1000) NOT NULL,
  `updatetime` int(10) unsigned DEFAULT NULL,
  `unionid` varchar(64) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_mapping_fans`
--

INSERT INTO `ims_mc_mapping_fans` (`fanid`, `acid`, `uniacid`, `uid`, `openid`, `nickname`, `groupid`, `salt`, `follow`, `followtime`, `unfollowtime`, `tag`, `updatetime`, `unionid`) VALUES
(1, 2, 2, 1, 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '龙', '', 'q911S9kc', 1, 1502247963, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cVdCc2dSZDd6b1hEeWg2R2RLNlFqYyI7czo4OiJuaWNrbmFtZSI7czozOiLpvpkiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuahguaelyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWoxRHdMVE1ka2hRNk1yRWlheTlxSmNMNUg5Q0d4b2VLU3lhRVpmaWJ6RmFlaWFKdG9EYXgwdzNDaG1nbzNBTEJoZ05vbmpQRzlvUWJkTkF3Sm5hZXNtSnVsVS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAyMjQ3OTYzO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1503542499, ''),
(2, 2, 2, 2, 'oNjw9wqOZStEvbG6suK3aaeJO2wI', '专注微信开发20年', '', 'Zw56p8wW', 1, 1501734252, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cU9aU3RFdmJHNnN1SzNhYWVKTzJ3SSI7czo4OiJuaWNrbmFtZSI7czoyMzoi5LiT5rOo5b6u5L+h5byA5Y+RMjDlubQiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuaIkOmDvSI7czo4OiJwcm92aW5jZSI7czo2OiLlm5vlt50iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDakpuOVdBRm1PQVM4WVMyamJyaWJ4Z1NuZWVHRzFOaWJxYklRUExCVWZYRWdMbHBMeEhzYmNWZnVKdWNrNGtJbGFvZzNBOE5wdmRxNEEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMTczNDI1MjtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1503542499, ''),
(3, 2, 2, 3, 'oNjw9wiHUT24ks-VP5her_QYjGJY', '波波夫', '', 'u3Ulw9i1', 1, 1501732534, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aUhVVDI0a3MtVlA1aGVyX1FZakdKWSI7czo4OiJuaWNrbmFtZSI7czo5OiLms6Lms6LlpKsiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuaIkOmDvSI7czo4OiJwcm92aW5jZSI7czo2OiLlm5vlt50iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDNThsa01oeFV0Rm9sWHlOMmVJMjZpYk5nblVId1luWE5JOGhSeEVJbUJVdnd4UDBpYTIyZlN6WlBYVjBoWlE0S0ROQzdPajJsekI0RzBsaWFpYTY3RmRPR0xPcjhONktJYWlhSjAvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMTczMjUzNDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1503563997, ''),
(4, 2, 2, 4, 'oNjw9wsoed-77tdXpJoqpMkFWsdk', '周刚', '', 'h23X1mWJ', 1, 1501732581, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c29lZC03N3RkWHBKb3FwTWtGV3NkayI7czo4OiJuaWNrbmFtZSI7czo2OiLlkajliJoiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPUDkwRERiQXltVFVDVG5JQmNXUTBRQzdXcHIzSWRmVFV2TkU0Njl1YUlYUkxXY2JWakJkVnFCSGFpYnNhWUh0M0EwUWJuTWhpYUQ0RmJPa3J3aDBWaWFhRi8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxNzMyNTgxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504242615, ''),
(5, 2, 2, 0, 'oNjw9ws7xwK9ukeHBotQtbuxyBzM', 'a玲子', '', 'Yn36n6D4', 1, 1501197194, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3czd4d0s5dWtlSEJvdFF0YnV4eUJ6TSI7czo4OiJuaWNrbmFtZSI7czoyMzoiYfCfjLjnjrLlrZDwn46A8J+SsPCfkosiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IumAmuW3niI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0J1eVNjbHJrQkQ0MGlicHlqaGlhaGRiaWI3elFrSmYzTnlVWnppYnlqZHNNTTR2akxjZFluNzZReFVmRkNPWWxrTHAxeWVCSkpraWJiVjdIc1MycVRMMFh1ZDBwY1JpYkJRbm5XdS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxMTk3MTk0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504680645, ''),
(6, 2, 2, 36, 'oNjw9wnOiw4bj-OibdIRKgdUIU5g', '无处诉说的痛', '', 'sxRaCvLL', 1, 1501595704, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bk9pdzRiai1PaWJkSVJLZ2RVSVU1ZyI7czo4OiJuaWNrbmFtZSI7czoxODoi5peg5aSE6K+J6K+055qE55ebIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmnJ3pmLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5YyX5LqsIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi8wdElRUHc4SENyTVFlUXdUWm1Zb25nWElwZW4yaG9COEVpYzNhdWRSVXlyaDRjOEl5TmFjbGNKSWMwME91Rjdza3RzWkppYmtCZmlidU1pYVY3ZmgyblhwdFppYVBUT29JeEJsZS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAxNTk1NzA0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504681500, ''),
(7, 2, 2, 0, 'oNjw9wlxBBl2NpAIzPehQby7gZso', '大山阻拦', '', 'CjseeZgU', 1, 1501746199, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bHhCQmwyTnBBSXpQZWhRYnk3Z1pzbyI7czo4OiJuaWNrbmFtZSI7czoxMjoi5aSn5bGx6Zi75oumIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLotLXpmLMiO3M6ODoicHJvdmluY2UiO3M6Njoi6LS15beeIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyODoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFhpYzhCamVIcFJDMW95bFU1QXRIWG52cmpuOGVZVkJLYUs5akpLTnRvbWM4d0VpYXFFNmRXNGFXQ21qeGljcDQwMDVhZnI1S0hKbE03T0NZRFlkRUhFNkcxLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDE3NDYxOTk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504681500, ''),
(8, 2, 2, 0, 'oNjw9wi19-C_7_Jz0NIdzQs4acis', '杜小情', '', 'J241Xq7z', 1, 1501733489, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aTE5LUNfN19KejBOSWR6UXM0YWNpcyI7czo4OiJuaWNrbmFtZSI7czo5OiLmnZzlsI/mg4UiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWHB3aWNaSk1qenlrcTZRamtLdXJoQWN1elY0eEtWdU56aWF3UG13dTBKYmljbHl4WGo0MExQdDhQNmNtSXFaWEllU3FoOWNxMG5Hb1JzbElLaWFwbEJoaGxuLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDE3MzM0ODk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504707717, ''),
(9, 2, 2, 5, 'oNjw9winTARR9vMCTbiDAzGq6jbU', 'Catanlina', '', 'F2MjsoXH', 1, 1503454769, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aW5UQVJSOXZNQ1RiaURBekdxNmpiVSI7czo4OiJuaWNrbmFtZSI7czo5OiJDYXRhbmxpbmEiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czo5OiLlronpgZPlsJQiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2FqTlZkcUhaTExDSG9pY04wY1VpYWNJbXZpYTNxZFQxTnBwZEhRU05seFYyRUdjd3hzNHBVcGFYd1QyMk4zcFJVUWlhT3ppYUJjU1ozdW5qQzQwd29hcW5nakEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzQ1NDc2OTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1504707717, ''),
(10, 2, 2, 6, 'oNjw9wrtMOEERWt6PxFBrRPIQBcg', '吴泽民', '', 'Pu77T60Y', 1, 1503541170, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cnRNT0VFUld0NlB4RkJyUlBJUUJjZyI7czo4OiJuaWNrbmFtZSI7czo5OiLlkLTms73msJEiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0J1eVNjbHJrQkQ2U0J2QVNvdFVNc21aY1JvTTJnZnR0OFpHa2xGdFZVNnhwN0NkU3hjeDdIVnpOVVNEd2tkYVl0T1E2bUxhWDR5Q1lCaWNzbTRDZ1dMaWFJWjJ5TXpxdGhCLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDM1NDExNzA7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504788347, ''),
(11, 2, 2, 7, 'oNjw9wooFsPkakB_3R3OQIz9J10Q', '庄海宏', '', 'jNTHWCqY', 0, 1503542506, 1508246477, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b29Gc1BrYWtCXzNSM09RSXo5SjEwUSI7czo4OiJuaWNrbmFtZSI7czo5OiLluoTmtbflro8iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTE2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhFNlJUNTVHUkxCYUhlZTZhYnFUR2NJblFtd0V4ZG5reUVZN2hVVGs1SGNZVHJNMEp3ZzZQNGlhSkp1cXNJQjFUaWF3Z202bEhKdkl6MEEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzU0MjUwNjtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1504788347, ''),
(13, 2, 2, 9, 'oNjw9wr5byzVbkSSx2TJTYYp4-y4', '小石孑', '', 'iURZQroo', 1, 1503564030, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cjVieXpWYmtTU3gyVEpUWVlwNC15NCI7czo4OiJuaWNrbmFtZSI7czo5OiLlsI/nn7PlrZEiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVWYyOThNQVdKUjRzaWNuVE5aaWJpYTdpYm1pYmRkZHE4dzR2WGduWmJNSWY1S2hLQTZQV0Q1VDg2MnJKQVRVdEJPcXkxMk1haElkcDZWRGs2RGlhTGs0TGNGQ1ovMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwMzU2NDAzMDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1504788347, ''),
(12, 2, 2, 8, 'oNjw9wmlIOrwpMwOsZhkKR0gvvPs', '简单', '', 'PyOeZqZ3', 1, 1503542534, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWxJT3J3cE13T3NaaGtLUjBndnZQcyI7czo4OiJuaWNrbmFtZSI7czo2OiLnroDljZUiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnNnUENkRHU3TTZyN1lZWXN1RWliaWNpY2FORXowQXJNSnEwRDhxaWNZNmZ5a0JTdUlLRWVlOHpoblBkTld2SmlhUVhEZHAyVmxDZjlGSFVJSy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTAzNTQyNTM0O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504788347, ''),
(14, 2, 2, 10, 'oNjw9wsR1LySJXLVsdy5XhiLnMzw', '鋆', '', 'f9umkG20', 1, 1504242665, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c1IxTHlTSlhMVnNkeTVYaGlMbk16dyI7czo4OiJuaWNrbmFtZSI7czozOiLpi4YiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3cyaHJVSU5LNkwyNzJRTHh4TXV3RldEZkhQdERlQXZQWlNVTlVpYkthNmliVjhXNDRVZkIwZU5ESEQ0bldOZmtiUGlhaWJ3Q2xkY29JNlBHaGNoSWljSDlWdTJHcGdOdW5nNjN0LzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQyNDI2NjU7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504788347, ''),
(15, 2, 2, 12, 'oNjw9woZ5wvXjyLqEK17wVsvYJLU', '天涯客', '', 'jPQz3Qpx', 1, 1504680668, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b1o1d3ZYanlMcUVLMTd3VnN2WUpMVSI7czo4OiJuaWNrbmFtZSI7czo5OiLlpKnmtq/lrqIiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lkM0pvQ1UxWng5RVJHejlPbFJRYmRlMVJ3RnlUcERrazg2d1NlR0xuMVNZNTFCZWI1TklqTWVsdkdDSmpodHRRaWNHUFJTZXRpY2dYbi8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0NjgwNjY4O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504788347, ''),
(16, 2, 2, 14, 'oNjw9wib4rWXgYgeFDu_Wi_ZizSQ', '吴华德', '', 'TVMTZZvM', 1, 1504682086, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWI0cldYZ1lnZUZEdV9XaV9aaXpTUSI7czo4OiJuaWNrbmFtZSI7czo5OiLlkLTljY7lvrciO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTM2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1h1NGliaWJTVDdZM1BISzlqbGJWSmlhWEt6Wmljc1lESGliaWJjRjBMaWNXRlhNbm1GdjVpYTE0OHRIczVMTHFFeVlzcDRHYmRJN3dNQ1JpY3BWRVhpYkR0dGlhMWhMV0E4UnVpY0J1TUo3by8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0NjgyMDg2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1504788347, ''),
(18, 2, 2, 16, 'oNjw9wrNcZI4KeFtns3TszYBmgUo', '周峰-南京智慧社区-njzhsq.com', '', 'n7h97189', 0, 1504740964, 1504777674, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3ck5jWkk0S2VGdG5zM1RzellCbWdVbyI7czo4OiJuaWNrbmFtZSI7czozNjoi5ZGo5bOwLeWNl+S6rOaZuuaFp+ekvuWMui1uanpoc3EuY29tIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czoxNToi5YyX5biV6buY5pav6aG/IjtzOjg6InByb3ZpbmNlIjtzOjEyOiLljJfpg6jlnLDljLoiO3M6NzoiY291bnRyeSI7czoxMjoi5r6z5aSn5Yip5LqaIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjExNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9QaWFqeFNxQlJhRUtkVExua1BKdDl4Q2Y0RG1VcEZpYXFsT0p3ZE5zTnFLMlhzRldVSGQ2YkpETzR2SUUyTVlKSTFkYTVLQU13UTZEUERPZ0drUTk1YkNRLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ3NDA5NjQ7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504777629, ''),
(17, 2, 2, 15, 'oNjw9wsCO53_LRoiYXQYyqMZr6lo', '华', '', 'CYz47oXX', 1, 1504682127, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c0NPNTNfTFJvaVlYUVl5cU1acjZsbyI7czo4OiJuaWNrbmFtZSI7czozOiLljY4iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTQxOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1BpYWp4U3FCUmFFS2lhTERJSEppYzFtUkNteHlGNmJmdGt0aWFRTkhaeXNCQ3ZpYXdiVHNZUHM2VHFERExlUk90UVE0N0tiSVZwb0tKbXBQdTlFVGxSeWljV0dlV2dZd1RKU2JFS3FUUm91cHZRekFNLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ2ODIxMjc7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504842957, ''),
(20, 2, 2, 18, 'oNjw9wkB0gSLtZ0f5W-8AkzQ4Cyg', '五福临門', '', 'RAF87P2X', 1, 1504774926, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3a0IwZ1NMdFowZjVXLThBa3pRNEN5ZyI7czo4OiJuaWNrbmFtZSI7czoxMjoi5LqU56aP5Li06ZaAIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9iWllpYnlJaWNPOHFoZXNKYmljOHBkUGZpYmFPaWFtbGM0S3dDSzZiRmpkMmR6OEJPVmc5TWlhZnJXaE1vaDdGblJXWHR2WHE0SjBZMzhpYlVMZDd1UkxqZE9keFhIYmQxeE9HQ3BULzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ3NzQ5MjY7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504843083, ''),
(19, 2, 2, 17, 'oNjw9wr3xWO4wEUJfgoK7kBmCzAU', '多面人东东', '', 'LbQXTTEn', 1, 1504742077, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cjN4V080d0VVSmZnb0s3a0JtQ3pBVSI7czo4OiJuaWNrbmFtZSI7czoxNToi5aSa6Z2i5Lq65Lic5LicIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLlhoXmsZ8iO3M6ODoicHJvdmluY2UiO3M6Njoi5Zub5bedIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNzoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMjQyZHl6U1lTT1pqTlR4eko4dGFLTnE1S1BOdFdpY3ExeTcxMklsNGprMXpOZzY3YnhVUllBRk1ZSEFlMGtCcjJwaWFBVHpVRmliUDZnYVU0MUNZc3VaTVIvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDc0MjA3NztzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1504843020, ''),
(21, 2, 2, 19, 'oNjw9wnsemkRyBdHKep_D9Vu-F3o', '周玉軍', '', 'z1IaczHh', 1, 1504836125, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bnNlbWtSeUJkSEtlcF9EOVZ1LUYzbyI7czo4OiJuaWNrbmFtZSI7czo5OiLlkajnjonou40iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWFgwZXdsdWpGMW5ET3NQR2ZhbWZPU3p0aGxDaWE5VFlFRjBGMFlXVzRnc284bWliTlBZNDJHbDdTTG54SkFKMXlsRUIxdEEwaWFadHJpYmZ5b0tCc0diUVlMLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4MzYxMjU7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504843146, ''),
(28, 2, 2, 26, 'oNjw9wuK099swcZEwX-6YPz4Vzdg', '黄小平', '', 'FcWCckW9', 1, 1504842989, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dUswOTlzd2NaRXdYLTZZUHo0VnpkZyI7czo4OiJuaWNrbmFtZSI7czo5OiLpu4TlsI/lubMiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVjJlaWFaZjJES2pDNmliN0NzdGliblplUlVVdjU5eUdwSmIyR0FvZTFoS2cyMUV1UzlqNmdLYm9nUnF0VHFCdkxpYjE3elhKYktQMjZkVTZmYWFDUGNZUFhsLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NDI5ODk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1505448074, ''),
(22, 2, 2, 20, 'oNjw9wlGmS6BbB5-Tm5EX1BQFlq4', '薰衣草', '', 'ZvShB59b', 1, 1504837899, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bEdtUzZCYkI1LVRtNUVYMUJRRmxxNCI7czo4OiJuaWNrbmFtZSI7czo5OiLolrDooaPojYkiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnN1d0NaOFhGMzE2YjlrUHNxVTlWSUZnb0RaU0VIR3VpYXRJdm9xRldMelBCc0VuU3Zoa0t4Smt3OElqWWFRdkF6RFZ6alRVYXZKSHRiLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4Mzc4OTk7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504843650, ''),
(23, 2, 2, 21, 'oNjw9wtUwuYUXvqgicsKCs15UERQ', '施', '', 'PZdchbxf', 1, 1504837962, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dFV3dVlVWHZxZ2ljc0tDczE1VUVSUSI7czo4OiJuaWNrbmFtZSI7czozOiLmlr0iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMyOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL1h1NGliaWJTVDdZM1BISzlqbGJWSmlhWEowekdraHEyVWEyVHZhbWljUjVycWJVYnpHTXRCMTNYaWM3Q3kyTDljWjlpYWliZmFiamZwNFd2VVhVY2E4VDgwWjNHQ3hHcklpYnk0a3dTLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4Mzc5NjI7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504849005, ''),
(24, 2, 2, 22, 'oNjw9wsZI1wztA78UiFblid6aM9Y', '青', '', 'X1ATCCay', 1, 1504838344, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c1pJMXd6dEE3OFVpRmJsaWQ2YU05WSI7czo4OiJuaWNrbmFtZSI7czozOiLpnZIiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWFUxNUxKVEhkbkh1S3N2bWpVc1ZTbWdCRER5WHR6M21qMHpreUd1ZmRvZjA4b0lhWExieEdLWDNnUGh5NTl6WGNXQzk5WEJ3ZGRmMUdseVl3aGliT2xNLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4MzgzNDQ7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1504851148, ''),
(25, 2, 2, 23, 'oNjw9woMXlqbwlCNoK06It-Fwt_4', '张世佐', '', 'FgZ90Jga', 1, 1504840061, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3b01YbHFid2xDTm9LMDZJdC1Gd3RfNCI7czo4OiJuaWNrbmFtZSI7czo5OiLlvKDkuJbkvZAiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWozbmNGeEQyM1JGalU5dVdkb1lLT2liVnowUkxGRnVuSXduWUpSUzFmeTRoUkQ4dDM5d2ZBMkU3T2liRDE4VElMRW1pYXdWWjhaWkE0aWNFM1A3QXdOM3BESU4vMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MDA2MTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1504851148, ''),
(26, 2, 2, 24, 'oNjw9wihpctdPBhtD0yU_6yf34WA', '益，文武勇仁信', '', 'vvN5UEU4', 1, 1504841790, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWhwY3RkUEJodEQweVVfNnlmMzRXQSI7czo4OiJuaWNrbmFtZSI7czoyMToi55uK77yM5paH5q2m5YuH5LuB5L+hIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czowOiIiO3M6ODoicHJvdmluY2UiO3M6MDoiIjtzOjc6ImNvdW50cnkiO3M6MDoiIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEzMDoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9vNDk2NFRSNW0xTjZjZkZrYnUyeG53bXY0bzdXZDB2R3h5V0QzS1FWVGFQNkV6emlicjhROVFyU3lCN3hnRWVOR2lhbHVNMTVUaWJnM2liRWlhN2tlREpwTzFGTWtHQnVDaWJyMjEvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MTc5MDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1505117859, ''),
(29, 2, 2, 27, 'oNjw9wuURuITTn2OoxXhx63POH7w', '90、刘斯金', '', 'xY7MMeYY', 1, 1504843075, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dVVSdUlUVG4yT294WGh4NjNQT0g3dyI7czo4OiJuaWNrbmFtZSI7czoxNDoiOTDjgIHliJjmlq/ph5EiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuWunOaYpSI7czo4OiJwcm92aW5jZSI7czo2OiLmsZ/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JOTHBiZFF5R3FkQW82V1I3VURwODFpYTE2VmF3T3VNamV0alFuQ285MEhFWUtYbEh0Q1pTbmNqTTRFT0JlZFlXdmpFUDFHY29OWjBaUGxpY3poVGljaEZiay8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzMDc1O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1505580079, ''),
(27, 2, 2, 25, 'oNjw9wqBwdIFv_ojqe4XnX1YPUrA', '心无挂碍', '', 'Ft5SSPB5', 1, 1504841820, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cUJ3ZElGdl9vanFlNFhuWDFZUFVyQSI7czo4OiJuaWNrbmFtZSI7czoxMjoi5b+D5peg5oyC56KNIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMmg5SzRodWRCUXJRalMyTkJtS083N3h5c3NuZU14R1c0NW1LeElzMXpReGc0S3k0NDY4dEJJa1BKQ3hDY3NpYk1FVURZcDVxRWxpYzRqZDR4WXVwdFNTTy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQxODIwO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1505448074, ''),
(30, 2, 2, 28, 'oNjw9wgobmanOe9siyw4v6PlzvRI', '不特别但唯一', '', 'qlZh6M6b', 1, 1504843091, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z29ibWFuT2U5c2l5dzR2NlBsenZSSSI7czo4OiJuaWNrbmFtZSI7czoxODoi5LiN54m55Yir5L2G5ZSv5LiAIjtzOjM6InNleCI7aToyO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFdCaWNIaWJyR0FIYkZ5VEhEakFRbEFURHM5QXlQMmJ5dHdTblNaQUJyb0xHamliZHQwbDJOSXhmcldoNEduVEx2blBVSlg1OWE5YTFEWDQxYUtZV2dycGliei8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzMDkxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1506345330, ''),
(31, 2, 2, 29, 'oNjw9wg_PO44msxBiNJR_fPZi8wU', 'King', '', 'RcMhBJJA', 1, 1504843194, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z19QTzQ0bXN4QmlOSlJfZlBaaTh3VSI7czo4OiJuaWNrbmFtZSI7czo0OiJLaW5nIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNzoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9pY0Qyc2oxTXptWFhBNkdiTXpVT0t5U1VZVmczS0Nxb2RmM1ZOVmhaNU0zVXJtT09UV1FZbXZpYkxxRjFRSGlidm05Y3JUSng4Qk9EcmJCYUtYV092dFVtTGx2czdKUHhNeDYvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg0MzE5NDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1506345330, ''),
(32, 2, 2, 30, 'oNjw9wipgBFKipHYOEolznGlPRq0', '杜君丽', '', 'gzlUSLeq', 1, 1504843692, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aXBnQkZLaXBIWU9Fb2x6bkdsUFJxMCI7czo4OiJuaWNrbmFtZSI7czo5OiLmnZzlkJvkuL0iO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuW5v+W3niI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVjR1WXppY3l2WWFGNWhtOTdJSDR2SlZGUkxWMXkxVkdEZzltUVF2QnphTVlaOXczOG8yaWM3Z0p4aWI3MGh3Mkg1VGpQbnJpY05yWXUyVjZBS1l6aWNwbXBVYS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODQzNjkyO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1506345330, ''),
(33, 2, 2, 31, 'oNjw9wt3qdTIbQzTVzMFpci2-qik', '玲珑', '', 'PjmZJ33j', 1, 1504849063, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dDNxZFRJYlF6VFZ6TUZwY2kyLXFpayI7czo4OiJuaWNrbmFtZSI7czo2OiLnjrLnj5EiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuW5v+W3niI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YVUJ3RkQ1ZHNLS3g2T25IS3AzbUdJeEozaE5xaWFkV2VOcHRHdWdOemFIR3JEcU9LbVgxRWRwcE5wTk1IZTVlMVlvSzBFMkVtYUFWcjZkMHBrV1VjMXFuLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NDkwNjM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1506345330, ''),
(34, 2, 2, 32, 'oNjw9wpcXWPyS2Mbql8MAUJltYw8', '胡', '', 'YkZc1RDo', 1, 1504851902, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cGNYV1B5UzJNYnFsOE1BVUpsdFl3OCI7czo4OiJuaWNrbmFtZSI7czozOiLog6EiO3M6Mzoic2V4IjtpOjA7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjA6IiI7czo4OiJwcm92aW5jZSI7czowOiIiO3M6NzoiY291bnRyeSI7czowOiIiO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTMwOiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWoyZmdPdnJ5cmliaGw4b3gwUFF0TlBpYlUyM0NqbkRYSEM3TldQOVBJYnFCanhiWDdLM0ZpYjNBaWFpYlFuMkNZeDl3NkZHY0RSVGthOWYzOGRrdDVSTG1QNmlieC8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA0ODUxOTAyO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1506345330, ''),
(37, 2, 2, 35, 'oNjw9wvY0SSNOC1UNR2J-G3K-gW8', '心灵驿站：周付林', '', 'Oo2et21h', 1, 1505146477, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dlkwU1NOT0MxVU5SMkotRzNLLWdXOCI7czo4OiJuaWNrbmFtZSI7czo2Njoi5b+D54G16am/56uZ77yaICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg5ZGo5LuY5p6XIjtzOjM6InNleCI7aTowO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czowOiIiO3M6ODoicHJvdmluY2UiO3M6MDoiIjtzOjc6ImNvdW50cnkiO3M6MDoiIjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9EbVQ3SnY2M3FqMUp4VGtTWEZXZUFEMU1aVXFGdDJJVG9oYlFtbDJEVlVOeThDaWJzMElwM3BmcUZCNXU2cTdvOXdpY2hIdmxrcXd5OHBiMFRROVNNWTBPbzRjZDZqb0tqUS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1MTQ2NDc3O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508830729, ''),
(35, 2, 2, 33, 'oNjw9wna-JuWdDqOa4FewAGQW4CA', 'ALEIER', '', 'g455r0P4', 1, 1504856054, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bmEtSnVXZERxT2E0RmV3QUdRVzRDQSI7czo4OiJuaWNrbmFtZSI7czo4OiJBIExFSSBFUiI7czozOiJzZXgiO2k6MjtzOjg6Imxhbmd1YWdlIjtzOjU6InpoX0NOIjtzOjQ6ImNpdHkiO3M6Njoi5rex5ZyzIjtzOjg6InByb3ZpbmNlIjtzOjY6IuW5v+S4nCI7czo3OiJjb3VudHJ5IjtzOjY6IuS4reWbvSI7czoxMDoiaGVhZGltZ3VybCI7czoxMTc6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vcksxbnNUbENEOEZtTGZsNHdMVFFlcnd2R3JrOTVCejNzY1lpYlN6SWZVdU5RaWNJTEhQSmdOSlFzRkhOZFlHeDB6elVDUlNpYWJuRHVWQkpNVEdQS3o5S2cvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNDg1NjA1NDtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1508830729, ''),
(36, 2, 2, 34, 'oNjw9whhmG9OodRiQNUiQPtbUhyc', '静静', '', 'Kmhmm085', 0, 1504858443, 1504858858, 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aGhtRzlPb2RSaVFOVWlRUHRiVWh5YyI7czo4OiJuaWNrbmFtZSI7czo2OiLpnZnpnZkiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuacnemYsyI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI5OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPZUc1cmEyazlzclk1eEpZaGljbGFGZmtOMDNDR0pTejJKSUpQNmtwWURDUGhlUVdCMDI4VDFueUE1UUxlRkdZVHpYTW1PeWlhaWNMREFrR3dGa1hIWkZNWS8xMzIiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDQ4NTg0NDM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e31zOjY6ImF2YXRhciI7czoxMjk6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vMHRJUVB3OEhDck9lRzVyYTJrOXNyWTV4SlloaWNsYUZma04wM0NHSlN6MkpJSlA2a3BZRENQaGVRV0IwMjhUMW55QTVRTGVGR1lUelhNbU95aWFpY0xEQWtHd0ZrWEhaRk1ZLzEzMiI7fQ==', NULL, ''),
(38, 2, 2, 37, 'oNjw9wgT3PmexxhTKxz_hz2pG44U', '叶赛', '', 'PMzZ6jfy', 1, 1505574721, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3Z1QzUG1leHhoVEt4el9oejJwRzQ0VSI7czo4OiJuaWNrbmFtZSI7czo2OiLlj7botZsiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI0OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuLzB0SVFQdzhIQ3JPZUc1cmEyazlzclVDRFliTFl0UzNacklHbFNVQzBBYWNjc3IzeTUwVVpSclBKVjBXM25qblg5RkNadWF0cEI3QTE4ZU9qV21EQXRaY3VoakJjSG00Ri8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1NTc0NzIxO3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508830729, ''),
(40, 2, 2, 39, 'oNjw9wqzHNUYHWvFcavv8IQ2oaIE', '简质生活', '', 'mp2bXQQ4', 1, 1505978746, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3cXpITlVZSFd2RmNhdnY4SVEyb2FJRSI7czo4OiJuaWNrbmFtZSI7czoxMjoi566A6LSo55Sf5rS7IjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjE0MToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9RM2F1SGd6d3pNN1J3TERxYmtoUnl0VkZKRFFubFFkUlh6dXhYa3R2blBRdXZNajlWWGlhZmplU2ljWm5oS2pPVG9EaWM0MnV0RE5MUnNFVGRGUkVUUDNpY0pBalRyaHd6TmFUQlNoNXpwaWNzU2ljUS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1OTc4NzQ2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508830729, ''),
(39, 2, 2, 38, 'oNjw9wrTnkinoSkdRx7nsRYBKxZQ', '海星之梦', '', 'O6202nmQ', 0, 1505577518, 1508668424, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3clRua2lub1NrZFJ4N25zUllCS3haUSI7czo4OiJuaWNrbmFtZSI7czoxMjoi5rW35pif5LmL5qKmIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyOToiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi9vVmpQMGFYWXA3UGhsaWE4YUo5aWFSVktUbzVsRmljVHBDTjNMb1pqZU03bjNtckgxNmxhNHhwS3ZDRG54VkVLaG90Vk0yQlRlUHFLaWFwYVcwbDY5N0YwMEl0cGliS0VWREFzdS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA1NTc3NTE4O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508666083, ''),
(41, 2, 2, 40, 'oNjw9wudU1CEemzjLgdikVeYy1Zs', '韦宜', '', 'MuY44SAZ', 1, 1506484043, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dWRVMUNFZW16akxnZGlrVmVZeTFacyI7czo4OiJuaWNrbmFtZSI7czo2OiLpn6blrpwiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iuays+axoCI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3JLMW5zVGxDRDhHTVU0c2xxNU9pYnNpYWdiTUFOQTBaTENKV21Uc2ZqZG5ZNFJJeHhqalhlOHY2cmZpY0I1SzNnczBsemlhRDd0Wno5NzJ4TDVmZThVbXJwTEV2d0Jhd1NOUkgvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjQ4NDA0MztzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1508830729, ''),
(47, 2, 2, 46, 'oNjw9wiax-OX32qvPinz639NGDME', '简单快乐王学英', '', 'G4o1H1LI', 1, 1508231546, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3aWF4LU9YMzJxdlBpbno2MzlOR0RNRSI7czo4OiJuaWNrbmFtZSI7czoyMToi566A5Y2V5b+r5LmQ546L5a2m6IuxIjtzOjM6InNleCI7aToxO3M6ODoibGFuZ3VhZ2UiO3M6NToiemhfQ04iO3M6NDoiY2l0eSI7czo2OiLmt7HlnLMiO3M6ODoicHJvdmluY2UiO3M6Njoi5bm/5LicIjtzOjc6ImNvdW50cnkiO3M6Njoi5Lit5Zu9IjtzOjEwOiJoZWFkaW1ndXJsIjtzOjEyNjoiaHR0cDovL3d4LnFsb2dvLmNuL21tb3Blbi8wdElRUHc4SENyTnhGdmhTZjcyQkRBc2FMYW1kTDR3NTc3WHVqYlNOdHF3dHVqZUpacUlmcE9sVklNbkR0SlJOOXIxUzU3NjBKMjJpYnRDdnhZWWliUVBaSnVIbDNUejhIWS8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA4MjMxNTQ2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508830729, ''),
(42, 2, 2, 41, 'oNjw9wswvtoVJb3Rd3CmZ2YRgV6Y', '雨江', '', 'SogMiKyr', 1, 1506484248, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3c3d2dG9WSmIzUmQzQ21aMllSZ1Y2WSI7czo4OiJuaWNrbmFtZSI7czo2OiLpm6jmsZ8iO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuWNl+WugSI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI4OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWHJrS2NXQUpDMURkd1hoUmpsMXRNZUlGOUM2a1loRDhoQnZ5SXlPaWNKaWJDMkNlRkMwWWxvdlZ6dnhwelVNQ0lpYllhZENTSW1CRFpCZGNRdTlwNXplbHcvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjQ4NDI0ODtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1508830729, ''),
(43, 2, 2, 42, 'oNjw9wujimSesPD6LJA-ESkKPL_g', '河池网展【负责人秦Mr】', '', 'DYkiniZS', 1, 1506485053, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3dWppbVNlc1BENkxKQS1FU2tLUExfZyI7czo4OiJuaWNrbmFtZSI7czozMjoi5rKz5rGg572R5bGV44CQ6LSf6LSj5Lq656emTXLjgJEiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iuays+axoCI7czo4OiJwcm92aW5jZSI7czo2OiLlub/opb8iO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI2OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL0RtVDdKdjYzcWowMzlKTGliM05sMW41eVJLelMyaWMxYUx2SkJEQlhJNlBXWmpkSjBjM2JFQmU2N0pocWdITUY4WlVsV2xWSUlVc2VzZXk4NDNMMndDSWZCZ2NNRVE0ajRhLzAiO3M6MTQ6InN1YnNjcmliZV90aW1lIjtpOjE1MDY0ODUwNTM7czo2OiJyZW1hcmsiO3M6MDoiIjtzOjc6Imdyb3VwaWQiO2k6MDtzOjEwOiJ0YWdpZF9saXN0IjthOjA6e319', 1508830729, ''),
(44, 2, 2, 43, 'oNjw9wnJEd8jrJykb2pSqwpuRbrQ', '黄钰喹', '', 'Jo5FO155', 1, 1506562539, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bkpFZDhqckp5a2IycFNxd3B1UmJyUSI7czo4OiJuaWNrbmFtZSI7czo5OiLpu4TpkrDllrkiO3M6Mzoic2V4IjtpOjE7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6Iua3seWcsyI7czo4OiJwcm92aW5jZSI7czo2OiLlub/kuJwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL3cyaHJVSU5LNkwzQ2tHQ1NQQW81ZUdzblVwUW5DeEhnTmliQXZzdzc0QTNTaWJleFRSdDR2Rmo2Y3J3b29kV2xtRFNZVkxkb0V1Umg1T25BRWliNE9FS0kzakVqQnZuNTVKcy8wIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA2NTYyNTM5O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9fQ==', 1508830729, ''),
(45, 2, 2, 44, 'oNjw9wmhe-9UYD9FcKi1kT0v3KpI', 'KK', '', 'y44R2S1S', 1, 1506563045, 0, 'YToxMzp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWhlLTlVWUQ5RmNLaTFrVDB2M0twSSI7czo4OiJuaWNrbmFtZSI7czoyOiJLSyI7czozOiJzZXgiO2k6MTtzOjg6Imxhbmd1YWdlIjtzOjU6InpoX0NOIjtzOjQ6ImNpdHkiO3M6Njoi5rex5ZyzIjtzOjg6InByb3ZpbmNlIjtzOjY6IuW5v+S4nCI7czo3OiJjb3VudHJ5IjtzOjY6IuS4reWbvSI7czoxMDoiaGVhZGltZ3VybCI7czoxMjk6Imh0dHA6Ly93eC5xbG9nby5jbi9tbW9wZW4vaWNEMnNqMU16bVhYQTZHYk16VU9LeVNsNEV3OU1DNUZqcDFoZGYwaWFOQWczSUNrVU43QkJ3QmliZHppYkFUdDZHZlUyaWF4azRCYnVnc3BhRnFZelBiQmdlV0FSZTZRT2ZJb1cvMCI7czoxNDoic3Vic2NyaWJlX3RpbWUiO2k6MTUwNjU2MzA0NTtzOjY6InJlbWFyayI7czowOiIiO3M6NzoiZ3JvdXBpZCI7aTowO3M6MTA6InRhZ2lkX2xpc3QiO2E6MDp7fX0=', 1508830729, ''),
(46, 2, 2, 45, 'oNjw9wmjrakAO-8zA9Ke2fpxSYZQ', 'huijiutian1001', '', 'U84443E5', 0, 1507009766, 1507009779, 'YToxNDp7czo5OiJzdWJzY3JpYmUiO2k6MTtzOjY6Im9wZW5pZCI7czoyODoib05qdzl3bWpyYWtBTy04ekE5S2UyZnB4U1laUSI7czo4OiJuaWNrbmFtZSI7czoxNDoiaHVpaml1dGlhbjEwMDEiO3M6Mzoic2V4IjtpOjI7czo4OiJsYW5ndWFnZSI7czo1OiJ6aF9DTiI7czo0OiJjaXR5IjtzOjY6IuacnemYsyI7czo4OiJwcm92aW5jZSI7czo2OiLljJfkuqwiO3M6NzoiY291bnRyeSI7czo2OiLkuK3lm70iO3M6MTA6ImhlYWRpbWd1cmwiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lXemw0azY0bjFmM1BnVjFadFNWSEJLb1J4MzR6TnJocGxkMVdFbEtHUmVNQXoyQW9zT1N4UXJwYUFzWEFJbjVwZG1YZ0pLaFZFQ3UvMTMyIjtzOjE0OiJzdWJzY3JpYmVfdGltZSI7aToxNTA3MDA5NzY2O3M6NjoicmVtYXJrIjtzOjA6IiI7czo3OiJncm91cGlkIjtpOjA7czoxMDoidGFnaWRfbGlzdCI7YTowOnt9czo2OiJhdmF0YXIiO3M6MTI3OiJodHRwOi8vd3gucWxvZ28uY24vbW1vcGVuL2ljRDJzajFNem1YWEE2R2JNelVPS3lXemw0azY0bjFmM1BnVjFadFNWSEJLb1J4MzR6TnJocGxkMVdFbEtHUmVNQXoyQW9zT1N4UXJwYUFzWEFJbjVwZG1YZ0pLaFZFQ3UvMTMyIjt9', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_mapping_ucenter`
--

CREATE TABLE IF NOT EXISTS `ims_mc_mapping_ucenter` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `centeruid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_mass_record`
--

CREATE TABLE IF NOT EXISTS `ims_mc_mass_record` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `fansnum` int(10) unsigned NOT NULL,
  `msgtype` varchar(10) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `group` int(10) NOT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `media_id` varchar(100) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `cron_id` int(10) unsigned NOT NULL,
  `sendtime` int(10) unsigned NOT NULL,
  `finalsendtime` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_members`
--

CREATE TABLE IF NOT EXISTS `ims_mc_members` (
  `uid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(8) NOT NULL,
  `groupid` int(11) NOT NULL,
  `credit1` decimal(10,2) unsigned NOT NULL,
  `credit2` decimal(10,2) unsigned NOT NULL,
  `credit3` decimal(10,2) unsigned NOT NULL,
  `credit4` decimal(10,2) unsigned NOT NULL,
  `credit5` decimal(10,2) unsigned NOT NULL,
  `credit6` decimal(10,2) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_members`
--

INSERT INTO `ims_mc_members` (`uid`, `uniacid`, `mobile`, `email`, `password`, `salt`, `groupid`, `credit1`, `credit2`, `credit3`, `credit4`, `credit5`, `credit6`, `createtime`, `realname`, `nickname`, `avatar`, `qq`, `vip`, `gender`, `birthyear`, `birthmonth`, `birthday`, `constellation`, `zodiac`, `telephone`, `idcard`, `studentid`, `grade`, `address`, `zipcode`, `nationality`, `resideprovince`, `residecity`, `residedist`, `graduateschool`, `company`, `education`, `occupation`, `position`, `revenue`, `affectivestatus`, `lookingfor`, `bloodtype`, `height`, `weight`, `alipay`, `msn`, `taobao`, `site`, `bio`, `interest`) VALUES
(1, 2, '15240694132', 'fdb7b2824b9d173764acb579653d70a4@we7.cc', '89ca75a742af0f2a2f4c76e29930fba7', 'BgBOJpSS', 2, '0.00', '9867.00', '0.00', '0.00', '0.00', '0.00', 1507773288, '庞金龙', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 2, '18577384028', '38ccf0390f052253322706e550ae8913@we7.cc', '5a6d416bef8d8b7810a0bb6bd9a716fe', 'XUo6lvZe', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1507773332, '祖脉罗', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 2, '18018777751', '86fd54160882e764aa9d9592786edb92@we7.cc', 'fea83e74f17742bde998fc7d0fc69454', 'dbBFb5vQ', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1502270740, '刘波', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 2, '13554717055', 'd7b96e21d912f927720f722ea3f26310@we7.cc', '53315d47652278f4e382caa8819b480a', 'TjID5ef4', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1502349686, '周刚', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 2, '', '1d4e0b78c8d337c6fa64258e96d21b76@we7.cc', 'd66326397e3bd60c696fe4e4ae6ff56e', 'z1Ob6vKs', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1503454770, '', 'Catanlina', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCHoicN0cUiacImvia3qdT1NppdHQSNlxV2EGcwxs4pUpaXwT22N3pRUQiaOziaBcSZ3unjC40woaqngjA/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 2, '', '2dd7897e325458f40e366510eb948035@we7.cc', 'f89159433327bb078bce2b4c34233aea', 'M20Ma0X7', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1503541171, '', '吴泽民', 'http://wx.qlogo.cn/mmopen/BuySclrkBD6SBvASotUMsmZcRoM2gftt8ZGklFtVU6xp7CdSxcx7HVzNUSDwkdaYtOQ6mLaX4yCYBicsm4CgWLiaIZ2yMzqthB/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 2, '', 'f65cbe5126c8c47e2f96482570bf806a@we7.cc', '900a19e2ef3d79228b34fb91360bc857', 'b7rHYn7Z', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1503542506, '', '庄海宏', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8E6RT55GRLBaHee6abqTGcInQmwExdnkyEY7hUTk5HcYTrM0Jwg6P4iaJJuqsIB1Tiawgm6lHJvIz0A/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 2, '', '27a920bb980d33dac76f7b2fcfe6999a@we7.cc', '6f6433da5eb06bc5559f07daf82947d7', 'pvyuO0Ii', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1503542535, '', '简单', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsgPCdDu7M6r7YYYsuEibicicaNEz0ArMJq0D358mr496XiastUVLthPCQfgmrDJYyWF5p3sdpm7zz3Xic/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 2, '', '7610dac5ad71ea70032b284cc56c1be7@we7.cc', '30669afc0ec8ca07da03f176ae9b538c', 'JJ7j3IJL', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1503564031, '', '小石孑', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXUf298MAWJR4sicnTNZibia7ibmibdddq8w4vXgnZbMIf5KhKA6PWD5T862rJATUtBOqy12MahIdp6VDk6DiaLk4LcFCZ/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 2, '', '16fb13bcec716d65f5a2a8ffebc4586d@we7.cc', '12e63f18405e8608a34769e1e1946d0b', 'x283FfVR', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504242665, '', '鋆', 'http://wx.qlogo.cn/mmopen/w2hrUINK6L272QLxxMuwFWDfHPtDeAvPZSUNUibKa6ibV8W44UfB0eNDHD4nWNfkbPiaibwCldcoI6PGhchIicH9Vu2GpgNung63t/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 2, '13554717088', '', '', 'xb52SnP2', 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504526816, '周刚', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 2, '18980408001', '0a0a5c3318f1da9e42ad861d8b289bc5@we7.cc', '129a3051ab9c3f966f32e1608049fbc4', 'GQShRbqB', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504680668, '天涯客', '天涯客', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKyd3JoCU1Zx9ERGz9OlRQbde1RwFyTpDkk86wSeGLn1SY51Beb5NIjMelvGCJjhttQicGPRSeticgXn/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 2, '13540491005', '', '', 'Oon8aANb', 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504680938, '天涯客', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 2, '13692203997', '0c95ef2047bf6690e01e7619d7bd7464@we7.cc', '8a5bbc178a41f02a19fc62fbef5316d5', 'KU4bVfDH', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504682087, '吴华德', '吴华德', 'http://wx.qlogo.cn/mmopen/Xu4ibibST7Y3PHK9jlbVJiaXKzZicsYDHibibcF0LicWFXMnmFv5ia148tHs5LLqEyYsp4GbdI7wMCRicpVEXibDttia1hLWA8RuicBuMJ7o/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 2, '13724303493', '60a7a2fcd524b6241665b12af0a25342@we7.cc', 'a0b511c4fab2ca84ec9851ea1a0f4522', 'OreRCUcd', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504682127, '段利华', '华', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKiaLDIHJic1mRCmxyF6bftktiaQNHZysBCviawbTsYPs6TqDDLeROtQQ47KbIVpoKJmpPu9ETlRyicWGeWgYwTJSbEKqTRoupvQzAM/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 2, '17715272440', 'e128a2582c5ea697e03aa0560c850ffc@we7.cc', 'ead6661cd9c0496d616fa27879839673', 'b668dqiq', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504740964, '周峰', '周峰-南京智慧社区-njzhsq.com', 'http://wx.qlogo.cn/mmopen/PiajxSqBRaEKdTLnkPJt9xCf4DmUpFiaqlOJwdNsNqK2XsFWUHd6bJDO4vIE2MYJI1da5KAMwQ6DPDOgGkQ95bCQ/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(17, 2, '18244914511', 'f88b0b85d5499897ff2e6e4bddf15154@we7.cc', 'd9cc2b0513cf4fa68ce7a752223e49e1', 'jLbH4SlS', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504742077, '钟卫东', '多面人东东', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj242dyzSYSOZjNTxzJ8taKNq5KPNtWicq1y712Il4jk1zNg67bxURYAFMYHAe0kBr2piaATzUFibP6gaU41CYsuZMR/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(18, 2, '13530368684', '4ba0c35a36861dde7be1042ed7353c36@we7.cc', 'dc7b14732a7bb2c8ba9308275c9d7e08', 'SmXOll2N', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504774927, '詹文明', '五福临門', 'http://wx.qlogo.cn/mmopen/bZYibyIicO8qhesJbic8pdPfibaOiamlc4KwCK6bFjd2dz8BOVg9MiafrWhMoh7FnRWXtvXq4J0Y38ibULd7uRLjdOdxXHbd1xOGCpT/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(19, 2, '13714288680', 'a48bd90f3bf7d9766f6ada30cfab52a2@we7.cc', '18c521c589732a4109340d196e1775f7', 'W82CAMMM', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504836126, '周玉军', '周玉軍', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXX0ewlujF1nDOsPGfamfOSzthlCia9TYEF0F0YWW4gso8mibNPY42Gl7SLnxJAJ1ylEB1tA0iaZtribfyoKBsGbQYL/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(20, 2, '13902919898', '375c8adaf009a848f8fa580afda31253@we7.cc', '8d2e4532fed90f6ca81fd883242baf7c', 'Lc27u72v', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504837899, '蔡飞', '薰衣草', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsuwCZ8XF316b9kPsqU9VIFgoDZSEHGuiatIvoqFWLzPBsEnSvhkKxJkw8IjYaQvAzDVzjTUavJHtb/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(21, 2, '15007557816', '3bad7aff52f570d90254c98869eb1fe6@we7.cc', '91c67f8cb92e6f9333fc982e866e2660', 'ynA1Z7nC', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504837963, '施思华', '施', 'http://wx.qlogo.cn/mmopen/Xu4ibibST7Y3PHK9jlbVJiaXJ0zGkhq2Ua2TvamicR5rqbUbzGMtB13Xic7Cy2L9cZ9iaibfabjfp4WvUXUca8T80Z3GCxGrIiby4kwS/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(22, 2, '13662664188', '7f87c6e8f2dc348cbac54a909a317a32@we7.cc', '1f08476f311cd9a82c1a96587ad0d927', 'U6Ll87jX', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504838345, '何小青', '青', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXU15LJTHdnHuKsvmjUsVSmgBDDyXtz3mj0zkyGufdof08oIaXLbxGKX3gPhy59zXcWC99XBwddf1GlyYwhibOlM/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(23, 2, '13798495355', 'a616afa3b39b4e3e5d0a20270ebd5e87@we7.cc', '4826bfc8c04dac3f6a88f8f0bc8b1af0', 'tfNB8z9g', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504840062, '张世佐', '张世佐', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj3ncFxD23RFjU9uWdoYKOibVz0RLFFunIwnYJRS1fy4hRD8t39wfA2E7OibD18TILEmiawVZ8ZZA4icE3P7AwN3pDIN/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(24, 2, '', '2974297059cf71bb6ff72de92b264ee9@we7.cc', '90655d669beab48f5b2bce12ab5fdbdb', 'z3u2mMOm', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504841790, '', '益，文武勇仁信', 'http://wx.qlogo.cn/mmopen/o4964TR5m1N6cfFkbu2xnwmv4o7Wd0vGxyWD3KQVTaP6Ezzibr8Q9QrSyB7xgEeNGialuM15Tibg3ibEia7keDJpO1FMkGBuCibr21/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(25, 2, '13923887685', '457277ddd7cb8976fd3455e8602b9146@we7.cc', 'edf3e835647c829a49c86f5518fbde07', 'MjCjJMAN', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504841821, '邓承力', '心无挂碍', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj2h9K4hudBQrQjS2NBmKO77xyssneMxGW45mKxIs1zQxiaemicNl0jqSE9624tKicSmSef5UiaOo5P9spYoic8FVXL5j/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(26, 2, '13544115623', '9818703538ad15be1e706b10f08d3227@we7.cc', '57d0632c8bce02672af16ab5e99d7eda', 'hg38HsmB', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504842990, '黄小平', '黄小平', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXV2eiaZf2DKjC6ib7CstibnZeRUUv59yGpJb2GAoe1hKg21EuS9j6gKbogRqtTqBvLib17zXJbKP26dU6faaCPcYPXl/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 2, '', '80473bc0a8617a25415aaf4fdfa5392c@we7.cc', 'f60b7ea6756243b0e329dbfa378f7b49', 'M6BwIcc0', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504843075, '', '90、刘斯金', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrNLpbdQyGqdAo6WR7UDp81ia16VawOuMjetjQnCo90HEYKXlHtCZSncjM4EOBedYWvjEP1GcoNZ0ZPliczhTichFbk/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(28, 2, '', '50ba1f7b029371f5ead81b80d6f52a44@we7.cc', 'c8b92456a578631cc415022f0c3f0b8a', 'FyLb5lb8', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504843092, '', '不特别但唯一', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrPxftiaoKB15plKgaicTkBjWUfc4IzaAm7u6zicibmErLgLvQ6HWuEjCFtNDjicGmXtGCsdhe8uwFOlbzdYNllCXeQqK/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 2, '', 'bd87127b849021ab9aed67ec9a1c96ed@we7.cc', 'c12629c9f870671bac06f3c9f91860aa', 'pCeJHeQe', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504843194, '', 'King', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKySUYVg3KCqodf3VNVhZ5M3UrmOOTWQYmvibLqF1QHibvm9crTJx8BODrbBaKXWOvtUmLlvs7JPxMx6/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(30, 2, '', 'a4d2e98ad8c76b96c5eb11f33a64df5c@we7.cc', '25c610801a2665f19dc93c55155dfd50', 'LW0gbRRh', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504843693, '', '杜君丽', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXV4uYzicyvYaF5hm97IH4vJVFRLV1y1VGDg9mQQvBzaMYZ9w38o2ic7gJxib70hw2H5TjPnricNrYu2V6AKYzicpmpUa/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(31, 2, '', 'e891fc7341f36a6749652ba1bb4e0807@we7.cc', 'd2d853be8f7e0ca4b9c9ef91b17fd30d', 'ISFvCdcQ', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504849064, '', '玲珑', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXUBwFD5dsKKx6OnHKp3mGIxJ3hNqiadWeNptGugNzaHGrDqOKmX1EdppNpNMHe5e1YoK0E2EmaAVr6d0pkWUc1qn/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 2, '', '46f29c18a3c089e73356319eac5ca101@we7.cc', 'e2ee2c741975e9d4caf262ed48d5c2e5', 'jPBTn35u', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504851903, '', '胡', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj2fgOvryribhl8ox0PQtNPibU23CjnDXHC7NWP9PIbqBjxbX7K3Fib3AiaibQn2CYx9w6FGcDRTka9f38dkt5RLmP6ibx/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(33, 2, '', '257a5beefdbdabb6d41fb68a457046ef@we7.cc', '2c9d44788ab36bd0b96d5b4b0f7ed7ed', 's9YiWuYs', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504856055, '', 'ALEIER', 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLDa3FlEJrnQSo4xeicRwr8ugU4fdTT62uI4FsN4cSbeicS5obfxULlsGd7yKtO7akexZQTyvwsyrMUQ/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, 2, '', '928c3e84ab3377d5f0771e161393f5c1@we7.cc', '90e72b60470852ac6678b3655a118e53', 'OBNNhfX2', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1504858285, '', '静静', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srY5xJYhiclaFfkN03CGJSz2JIJP6kpYDCPheQWB028T1nyA5QLeFGYTzXMmOyiaicLDAkGwFkXHZFMY/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 2, '', '0223febdbe1f7c598341ef39bb55f029@we7.cc', '7303baf38c8d44b1c8029cfc486dae5a', 'XX7xEbeZ', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1505146477, '', '心灵驿站：周付林', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj1JxTkSXFWeAD1MZUqFt2ITohbQml2DVUNy8Cibs0Ip3pfqFB5u6q7o9wichHvlkqwy8pb0TQ9SMY0Oo4cd6joKjQ/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(36, 2, '', 'a434b7824282275e7c79c497f4b1c0d9@we7.cc', '820a1740ec6df3944b03a3cc2c797710', 'IczMR3wB', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1505197495, '', '', '', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 2, '15555555555', '9f13d98f39863afa9ba9b4953dbf03f9@we7.cc', 'ca821f950b2bbfceac9191fc5e6c59e8', 'wlES91SL', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1507815841, '李先生', '叶赛', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrOeG5ra2k9srUCDYbLYtS3ZrIGlSUC0Aaccsr3y50UZRrPJV0W3njnX9FCZuatpB7A18eOjWmDAtZcuhjBcHm4F/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 2, '18098972608', 'b5735e46edb2a445d3cafc08172efd10@we7.cc', '73adb2de68339b3eba79e7a44fa76718', 'Ml88DrCR', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1507820631, '沈剑', '海星之梦', 'http://wx.qlogo.cn/mmopen/oVjP0aXYp7Phlia8aJ9iaRVKTo5lFicTpCN3LoZjeM7n3mrH16la4xpKvCDnxVEKhotVM2BTePqKiapaW0l697F00ItpibKEVDAsu/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 2, '', 'c441036f49b6a5900231ad319224ef11@we7.cc', '4f3dda978f012fd6abf35fd587e1f8d9', 'nl1lq4by', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1505978746, '', 'Simple简质生活', 'http://wx.qlogo.cn/mmopen/Q3auHgzwzM7RwLDqbkhRytVFJDQnlQdRXzuxXktvnPQuvMj9VXiafjeSicZnhKjOToDic42utDNLRsETdFRETP3icJAjTrhwzNaTBSh5zpicsSicQ/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 2, '', '4b4e25732857f944c9e68082823504d2@we7.cc', '3b73a3c850734969ad3859cc2a9959ab', 'Cn1mN555', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1506484043, '', '韦宜', 'http://wx.qlogo.cn/mmopen/rK1nsTlCD8GMU4slq5OibsiagbMANA0ZLCJWmTsfjdnY4RIxxjjXe8v6rficB5K3gs0lziaD7tZz972xL5fe8UmrpLEvwBawSNRH/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 2, '', 'c6ca2adaf5d547b5913cec002aefdf3d@we7.cc', 'd6c5b80d15a316171f1b824b279f0598', 'xAG7lnua', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1506484249, '', '雨江', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXrkKcWAJC1DdwXhRjl1tMeIF9C6kYhD8hBvyIyOicJibC2CeFC0YlovVzvxpzUMCIibYadCSImBDZBdcQu9p5zelw/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(42, 2, '', 'fa427995977fa5df42f9fee26ff8127d@we7.cc', '896d12537e6e615033a3ed9a019f5d15', 'fvc8Qs2Z', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1506485054, '', '河池网展【负责人秦Mr】', 'http://wx.qlogo.cn/mmopen/DmT7Jv63qj039JLib3Nl1n5yRKzS2ic1aLvJBDBXI6PWZjdJ0c3bEBe67JhqgHMF8ZUlWlVIIUsesey843L2wCIfBgcMEQ4j4a/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 2, '13612999152', 'c2834d2d3a919032ee77e6e496e0041f@we7.cc', 'a98d794470d9a7c0d68e5d8e908eb07d', 'd77efCeF', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1506562798, '黄玉奎', '黄钰喹', 'http://wx.qlogo.cn/mmopen/w2hrUINK6L3CkGCSPAo5eGsnUpQnCxHgNibAvsw74A3SibexTRt4vFj6crwoodWlmDSYVLdoEuRh5OnAEib4OEKI3jEjBvn55Js/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(44, 2, '13692186370', 'f8608b739d055de12ea25a1f7443e306@we7.cc', 'f0cb6ec4e98fc2cfa38a17ead252c401', 'TcLr1PCm', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1506563148, '张爱军', 'KK', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKySl4Ew9MC5Fjp1hdf0iaNAg3ICkUN7BBwBibdzibATt6GfU2iaxk4BbugspaFqYzPbBgeWARe6QOfIoW/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 2, '', 'e23041a2fdd2a17e0e05770ab925f1ab@we7.cc', '5d23db1c76d201256bd4f697d5191aba', 'tCxRbC9n', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1507009767, '', 'huijiutian1001', 'http://wx.qlogo.cn/mmopen/icD2sj1MzmXXA6GbMzUOKyWzl4k64n1f3PgV1ZtSVHBKoRx34zNrhpld1WElKGReMAz2AosOSxQrpaAsXAIn5pdmXgJKhVECu/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 2, '', '7fef100109ae1d4aa5147d4c4b91c082@we7.cc', 'f72eb9145f789f299ec61b39e5381f8d', 'Zu1WUB48', 2, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 1508231547, '', '简单快乐王学英', 'http://wx.qlogo.cn/mmopen/0tIQPw8HCrNxFvhSf72BDAsaLamdL4w577XujbSNtqwtujeJZqIfpOlVIMnDtJRN9r1S5760J22ibtCvxYYibQPZJuHl3Tz8HY/132', '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_member_address`
--

CREATE TABLE IF NOT EXISTS `ims_mc_member_address` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(50) unsigned NOT NULL,
  `username` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(32) NOT NULL,
  `district` varchar(32) NOT NULL,
  `address` varchar(512) NOT NULL,
  `isdefault` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_member_fields`
--

CREATE TABLE IF NOT EXISTS `ims_mc_member_fields` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `fieldid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `displayorder` smallint(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_mc_member_fields`
--

INSERT INTO `ims_mc_member_fields` (`id`, `uniacid`, `fieldid`, `title`, `available`, `displayorder`) VALUES
(1, 2, 1, '真实姓名', 1, 0),
(2, 2, 2, '昵称', 1, 1),
(3, 2, 3, '头像', 1, 1),
(4, 2, 4, 'QQ号', 1, 0),
(5, 2, 5, '手机号码', 1, 0),
(6, 2, 6, 'VIP级别', 1, 0),
(7, 2, 7, '性别', 1, 0),
(8, 2, 8, '出生生日', 1, 0),
(9, 2, 9, '星座', 1, 0),
(10, 2, 10, '生肖', 1, 0),
(11, 2, 11, '固定电话', 1, 0),
(12, 2, 12, '证件号码', 1, 0),
(13, 2, 13, '学号', 1, 0),
(14, 2, 14, '班级', 1, 0),
(15, 2, 15, '邮寄地址', 1, 0),
(16, 2, 16, '邮编', 1, 0),
(17, 2, 17, '国籍', 1, 0),
(18, 2, 18, '居住地址', 1, 0),
(19, 2, 19, '毕业学校', 1, 0),
(20, 2, 20, '公司', 1, 0),
(21, 2, 21, '学历', 1, 0),
(22, 2, 22, '职业', 1, 0),
(23, 2, 23, '职位', 1, 0),
(24, 2, 24, '年收入', 1, 0),
(25, 2, 25, '情感状态', 1, 0),
(26, 2, 26, ' 交友目的', 1, 0),
(27, 2, 27, '血型', 1, 0),
(28, 2, 28, '身高', 1, 0),
(29, 2, 29, '体重', 1, 0),
(30, 2, 30, '支付宝帐号', 1, 0),
(31, 2, 31, 'MSN', 1, 0),
(32, 2, 32, '电子邮箱', 1, 0),
(33, 2, 33, '阿里旺旺', 1, 0),
(34, 2, 34, '主页', 1, 0),
(35, 2, 35, '自我介绍', 1, 0),
(36, 2, 36, '兴趣爱好', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_member_property`
--

CREATE TABLE IF NOT EXISTS `ims_mc_member_property` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `property` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mc_oauth_fans`
--

CREATE TABLE IF NOT EXISTS `ims_mc_oauth_fans` (
  `id` int(10) unsigned NOT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_menu_event`
--

CREATE TABLE IF NOT EXISTS `ims_menu_event` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `picmd5` varchar(32) NOT NULL,
  `openid` varchar(128) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_mobilenumber`
--

CREATE TABLE IF NOT EXISTS `ims_mobilenumber` (
  `id` int(11) NOT NULL,
  `rid` int(10) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `dateline` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_modules`
--

CREATE TABLE IF NOT EXISTS `ims_modules` (
  `mid` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `version` varchar(15) NOT NULL,
  `ability` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `settings` tinyint(1) NOT NULL,
  `subscribes` varchar(500) NOT NULL,
  `handles` varchar(500) NOT NULL,
  `isrulefields` tinyint(1) NOT NULL,
  `issystem` tinyint(1) unsigned NOT NULL,
  `target` int(10) unsigned NOT NULL,
  `iscard` tinyint(3) unsigned NOT NULL,
  `permissions` varchar(5000) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `wxapp_support` tinyint(1) NOT NULL,
  `app_support` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_modules`
--

INSERT INTO `ims_modules` (`mid`, `name`, `type`, `title`, `version`, `ability`, `description`, `author`, `url`, `settings`, `subscribes`, `handles`, `isrulefields`, `issystem`, `target`, `iscard`, `permissions`, `title_initial`, `wxapp_support`, `app_support`) VALUES
(1, 'basic', 'system', '基本文字回复', '1.0', '和您进行简单对话', '一问一答得简单对话. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的回复内容.', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(2, 'news', 'system', '基本混合图文回复', '1.0', '为你提供生动的图文资讯', '一问一答得简单对话, 但是回复内容包括图片文字等更生动的媒体内容. 当访客的对话语句中包含指定关键字, 或对话语句完全等于特定关键字, 或符合某些特定的格式时. 系统自动应答设定好的图文回复内容.', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(3, 'music', 'system', '基本音乐回复', '1.0', '提供语音、音乐等音频类回复', '在回复规则中可选择具有语音、音乐等音频类的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝，实现一问一答得简单对话。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(4, 'userapi', 'system', '自定义接口回复', '1.1', '更方便的第三方接口设置', '自定义接口又称第三方接口，可以让开发者更方便的接入微擎系统，高效的与微信公众平台进行对接整合。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(5, 'recharge', 'system', '会员中心充值模块', '1.0', '提供会员充值功能', '', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 0, 1, 0, 0, '', '', 1, 2),
(6, 'custom', 'system', '多客服转接', '1.0.0', '用来接入腾讯的多客服系统', '', 'WeEngine Team', 'http://bbs.we7.cc', 0, 'a:0:{}', 'a:6:{i:0;s:5:"image";i:1;s:5:"voice";i:2;s:5:"video";i:3;s:8:"location";i:4;s:4:"link";i:5;s:4:"text";}', 1, 1, 0, 0, '', '', 1, 2),
(7, 'images', 'system', '基本图片回复', '1.0', '提供图片回复', '在回复规则中可选择具有图片的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝图片。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(8, 'video', 'system', '基本视频回复', '1.0', '提供图片回复', '在回复规则中可选择具有视频的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝视频。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(9, 'voice', 'system', '基本语音回复', '1.0', '提供语音回复', '在回复规则中可选择具有语音的回复内容，并根据用户所设置的特定关键字精准的返回给粉丝语音。', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(10, 'chats', 'system', '发送客服消息', '1.0', '公众号可以在粉丝最后发送消息的48小时内无限制发送消息', '', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 0, 1, 0, 0, '', '', 1, 2),
(11, 'wxcard', 'system', '微信卡券回复', '1.0', '微信卡券回复', '微信卡券回复', 'WeEngine Team', 'http://www.we7.cc/', 0, '', '', 1, 1, 0, 0, '', '', 1, 2),
(12, 'feng_community', 'business', '微小区', '9.2.8.3.0', '微小区', '微小区', '蓝牛科技', 'we7xq.com', 0, 'a:0:{}', 'a:0:{}', 0, 0, 0, 0, 'N;', 'W', 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ims_modules_bindings`
--

CREATE TABLE IF NOT EXISTS `ims_modules_bindings` (
  `eid` int(11) NOT NULL,
  `module` varchar(100) NOT NULL,
  `entry` varchar(10) NOT NULL,
  `call` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `do` varchar(30) NOT NULL,
  `state` varchar(200) NOT NULL,
  `direct` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `displayorder` tinyint(255) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_modules_bindings`
--

INSERT INTO `ims_modules_bindings` (`eid`, `module`, `entry`, `call`, `title`, `do`, `state`, `direct`, `url`, `icon`, `displayorder`) VALUES
(1, 'feng_community', 'cover', '', '主页入口', 'home', '', 0, '', '', 0),
(2, 'feng_community', 'cover', '', '小区通知入口', 'announcement', '', 0, '', '', 0),
(3, 'feng_community', 'cover', '', '小区活动入口', 'activity', '', 0, '', '', 0),
(4, 'feng_community', 'cover', '', '周边商家入口', 'business', '', 0, '', '', 0),
(5, 'feng_community', 'cover', '', '二手市场入口', 'fled', '', 0, '', '', 0),
(6, 'feng_community', 'cover', '', '物业缴费入口', 'cost', '', 0, '', '', 0),
(7, 'feng_community', 'cover', '', '小区家政入口', 'homemaking', '', 0, '', '', 0),
(8, 'feng_community', 'cover', '', '房屋租赁入口', 'houselease', '', 0, '', '', 0),
(9, 'feng_community', 'cover', '', '手机开门入口', 'opendoor', '', 0, '', '', 0),
(10, 'feng_community', 'cover', '', '便民号码入口', 'phone', '', 0, '', '', 0),
(11, 'feng_community', 'cover', '', '小区建议入口', 'report', '', 0, '', '', 0),
(12, 'feng_community', 'cover', '', '小区报修入口', 'repair', '', 0, '', '', 0),
(13, 'feng_community', 'cover', '', '便民查询入口', 'search', '', 0, '', '', 0),
(14, 'feng_community', 'cover', '', '小区拼车入口', 'car', '', 0, '', '', 0),
(15, 'feng_community', 'cover', '', '小区超市入口', 'shopping', '', 0, '', '', 0),
(16, 'feng_community', 'cover', '', '个人中心入口', 'member', '', 0, '', '', 0),
(17, 'feng_community', 'cover', '', '手机端管理入口', 'xqsys', '', 0, '', '', 0),
(18, 'feng_community', 'menu', '', '管理中心', 'manage', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_modules_plugin`
--

CREATE TABLE IF NOT EXISTS `ims_modules_plugin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `main_module` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_modules_plugin`
--

INSERT INTO `ims_modules_plugin` (`id`, `name`, `main_module`) VALUES
(1, 'feng_community_plugin_adv', 'feng_community'),
(2, 'feng_community_plugin_lift', 'feng_community'),
(3, 'feng_community_plugin_adv', 'feng_community'),
(4, 'feng_community_plugin_lift', 'feng_community'),
(5, 'feng_community_plugin_adv', 'feng_community'),
(6, 'feng_community_plugin_lift', 'feng_community'),
(7, 'feng_community_plugin_adv', 'feng_community'),
(8, 'feng_community_plugin_lift', 'feng_community'),
(9, 'feng_community_plugin_adv', 'feng_community'),
(10, 'feng_community_plugin_lift', 'feng_community'),
(11, 'feng_community_plugin_adv', 'feng_community'),
(12, 'feng_community_plugin_lift', 'feng_community'),
(13, 'feng_community_plugin_adv', 'feng_community'),
(14, 'feng_community_plugin_lift', 'feng_community'),
(15, 'feng_community_plugin_adv', 'feng_community'),
(16, 'feng_community_plugin_lift', 'feng_community'),
(17, 'feng_community_plugin_adv', 'feng_community'),
(18, 'feng_community_plugin_lift', 'feng_community'),
(19, 'feng_community_plugin_adv', 'feng_community'),
(20, 'feng_community_plugin_lift', 'feng_community'),
(21, 'feng_community_plugin_adv', 'feng_community'),
(22, 'feng_community_plugin_lift', 'feng_community'),
(23, 'feng_community_plugin_adv', 'feng_community'),
(24, 'feng_community_plugin_lift', 'feng_community'),
(25, 'feng_community_plugin_adv', 'feng_community'),
(26, 'feng_community_plugin_lift', 'feng_community'),
(27, 'feng_community_plugin_adv', 'feng_community'),
(28, 'feng_community_plugin_lift', 'feng_community'),
(29, 'feng_community_plugin_adv', 'feng_community'),
(30, 'feng_community_plugin_lift', 'feng_community'),
(31, 'feng_community_plugin_adv', 'feng_community'),
(32, 'feng_community_plugin_lift', 'feng_community'),
(33, 'feng_community_plugin_adv', 'feng_community'),
(34, 'feng_community_plugin_lift', 'feng_community'),
(35, 'feng_community_plugin_adv', 'feng_community'),
(36, 'feng_community_plugin_lift', 'feng_community'),
(37, 'feng_community_plugin_adv', 'feng_community'),
(38, 'feng_community_plugin_lift', 'feng_community'),
(39, 'feng_community_plugin_adv', 'feng_community'),
(40, 'feng_community_plugin_lift', 'feng_community'),
(41, 'feng_community_plugin_adv', 'feng_community'),
(42, 'feng_community_plugin_lift', 'feng_community'),
(43, 'feng_community_plugin_adv', 'feng_community'),
(44, 'feng_community_plugin_lift', 'feng_community'),
(45, 'feng_community_plugin_adv', 'feng_community'),
(46, 'feng_community_plugin_lift', 'feng_community'),
(47, 'feng_community_plugin_adv', 'feng_community'),
(48, 'feng_community_plugin_lift', 'feng_community'),
(49, 'feng_community_plugin_adv', 'feng_community'),
(50, 'feng_community_plugin_lift', 'feng_community'),
(51, 'feng_community_plugin_adv', 'feng_community'),
(52, 'feng_community_plugin_lift', 'feng_community'),
(53, 'feng_community_plugin_adv', 'feng_community'),
(54, 'feng_community_plugin_lift', 'feng_community'),
(55, 'feng_community_plugin_adv', 'feng_community'),
(56, 'feng_community_plugin_lift', 'feng_community'),
(57, 'feng_community_plugin_adv', 'feng_community'),
(58, 'feng_community_plugin_lift', 'feng_community'),
(59, 'feng_community_plugin_adv', 'feng_community'),
(60, 'feng_community_plugin_lift', 'feng_community'),
(61, 'feng_community_plugin_adv', 'feng_community'),
(62, 'feng_community_plugin_lift', 'feng_community'),
(63, 'feng_community_plugin_adv', 'feng_community'),
(64, 'feng_community_plugin_lift', 'feng_community'),
(65, 'feng_community_plugin_adv', 'feng_community'),
(66, 'feng_community_plugin_lift', 'feng_community'),
(67, 'feng_community_plugin_adv', 'feng_community'),
(68, 'feng_community_plugin_lift', 'feng_community'),
(69, 'feng_community_plugin_adv', 'feng_community'),
(70, 'feng_community_plugin_lift', 'feng_community'),
(71, 'feng_community_plugin_adv', 'feng_community'),
(72, 'feng_community_plugin_lift', 'feng_community'),
(73, 'feng_community_plugin_adv', 'feng_community'),
(74, 'feng_community_plugin_lift', 'feng_community'),
(75, 'feng_community_plugin_adv', 'feng_community'),
(76, 'feng_community_plugin_lift', 'feng_community'),
(77, 'feng_community_plugin_chinaums', 'feng_community'),
(78, 'feng_community_plugin_chinaums', 'feng_community'),
(79, 'feng_community_plugin_chinaums', 'feng_community'),
(80, 'feng_community_plugin_chinaums', 'feng_community'),
(81, 'feng_community_plugin_chinaums', 'feng_community');

-- --------------------------------------------------------

--
-- 表的结构 `ims_modules_recycle`
--

CREATE TABLE IF NOT EXISTS `ims_modules_recycle` (
  `id` int(10) NOT NULL,
  `modulename` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_music_reply`
--

CREATE TABLE IF NOT EXISTS `ims_music_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `hqurl` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_news_reply`
--

CREATE TABLE IF NOT EXISTS `ims_news_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `parent_id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumb` varchar(500) NOT NULL,
  `content` mediumtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `media_id` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_profile_fields`
--

CREATE TABLE IF NOT EXISTS `ims_profile_fields` (
  `id` int(10) unsigned NOT NULL,
  `field` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `displayorder` smallint(6) NOT NULL,
  `required` tinyint(1) NOT NULL,
  `unchangeable` tinyint(1) NOT NULL,
  `showinregister` tinyint(1) NOT NULL,
  `field_length` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_profile_fields`
--

INSERT INTO `ims_profile_fields` (`id`, `field`, `available`, `title`, `description`, `displayorder`, `required`, `unchangeable`, `showinregister`, `field_length`) VALUES
(1, 'realname', 1, '真实姓名', '', 0, 1, 1, 1, 0),
(2, 'nickname', 1, '昵称', '', 1, 1, 0, 1, 0),
(3, 'avatar', 1, '头像', '', 1, 0, 0, 0, 0),
(4, 'qq', 1, 'QQ号', '', 0, 0, 0, 1, 0),
(5, 'mobile', 1, '手机号码', '', 0, 0, 0, 0, 0),
(6, 'vip', 1, 'VIP级别', '', 0, 0, 0, 0, 0),
(7, 'gender', 1, '性别', '', 0, 0, 0, 0, 0),
(8, 'birthyear', 1, '出生生日', '', 0, 0, 0, 0, 0),
(9, 'constellation', 1, '星座', '', 0, 0, 0, 0, 0),
(10, 'zodiac', 1, '生肖', '', 0, 0, 0, 0, 0),
(11, 'telephone', 1, '固定电话', '', 0, 0, 0, 0, 0),
(12, 'idcard', 1, '证件号码', '', 0, 0, 0, 0, 0),
(13, 'studentid', 1, '学号', '', 0, 0, 0, 0, 0),
(14, 'grade', 1, '班级', '', 0, 0, 0, 0, 0),
(15, 'address', 1, '邮寄地址', '', 0, 0, 0, 0, 0),
(16, 'zipcode', 1, '邮编', '', 0, 0, 0, 0, 0),
(17, 'nationality', 1, '国籍', '', 0, 0, 0, 0, 0),
(18, 'resideprovince', 1, '居住地址', '', 0, 0, 0, 0, 0),
(19, 'graduateschool', 1, '毕业学校', '', 0, 0, 0, 0, 0),
(20, 'company', 1, '公司', '', 0, 0, 0, 0, 0),
(21, 'education', 1, '学历', '', 0, 0, 0, 0, 0),
(22, 'occupation', 1, '职业', '', 0, 0, 0, 0, 0),
(23, 'position', 1, '职位', '', 0, 0, 0, 0, 0),
(24, 'revenue', 1, '年收入', '', 0, 0, 0, 0, 0),
(25, 'affectivestatus', 1, '情感状态', '', 0, 0, 0, 0, 0),
(26, 'lookingfor', 1, ' 交友目的', '', 0, 0, 0, 0, 0),
(27, 'bloodtype', 1, '血型', '', 0, 0, 0, 0, 0),
(28, 'height', 1, '身高', '', 0, 0, 0, 0, 0),
(29, 'weight', 1, '体重', '', 0, 0, 0, 0, 0),
(30, 'alipay', 1, '支付宝帐号', '', 0, 0, 0, 0, 0),
(31, 'msn', 1, 'MSN', '', 0, 0, 0, 0, 0),
(32, 'email', 1, '电子邮箱', '', 0, 0, 0, 0, 0),
(33, 'taobao', 1, '阿里旺旺', '', 0, 0, 0, 0, 0),
(34, 'site', 1, '主页', '', 0, 0, 0, 0, 0),
(35, 'bio', 1, '自我介绍', '', 0, 0, 0, 0, 0),
(36, 'interest', 1, '兴趣爱好', '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_qrcode`
--

CREATE TABLE IF NOT EXISTS `ims_qrcode` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `extra` int(10) unsigned NOT NULL,
  `qrcid` bigint(20) NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `model` tinyint(1) unsigned NOT NULL,
  `ticket` varchar(250) NOT NULL,
  `url` varchar(256) NOT NULL,
  `expire` int(10) unsigned NOT NULL,
  `subnum` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_qrcode_stat`
--

CREATE TABLE IF NOT EXISTS `ims_qrcode_stat` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `qid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `qrcid` bigint(20) unsigned NOT NULL,
  `scene_str` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_rule`
--

CREATE TABLE IF NOT EXISTS `ims_rule` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `containtype` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_rule`
--

INSERT INTO `ims_rule` (`id`, `uniacid`, `name`, `module`, `displayorder`, `status`, `containtype`) VALUES
(1, 0, '城市天气', 'userapi', 255, 1, ''),
(2, 0, '百度百科', 'userapi', 255, 1, ''),
(3, 0, '即时翻译', 'userapi', 255, 1, ''),
(4, 0, '今日老黄历', 'userapi', 255, 1, ''),
(5, 0, '看新闻', 'userapi', 255, 1, ''),
(6, 0, '快递查询', 'userapi', 255, 1, ''),
(7, 1, '个人中心入口设置', 'cover', 0, 1, ''),
(8, 1, '微擎团队入口设置', 'cover', 0, 1, ''),
(9, 2, '主页入口', 'cover', 0, 1, ''),
(10, 2, '嘉洲富苑', 'cover', 0, 1, ''),
(11, 2, '多多母婴', 'cover', 0, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_rule_keyword`
--

CREATE TABLE IF NOT EXISTS `ims_rule_keyword` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `content` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_rule_keyword`
--

INSERT INTO `ims_rule_keyword` (`id`, `rid`, `uniacid`, `module`, `content`, `type`, `displayorder`, `status`) VALUES
(1, 1, 0, 'userapi', '^.+天气$', 3, 255, 1),
(2, 2, 0, 'userapi', '^百科.+$', 3, 255, 1),
(3, 2, 0, 'userapi', '^定义.+$', 3, 255, 1),
(4, 3, 0, 'userapi', '^@.+$', 3, 255, 1),
(5, 4, 0, 'userapi', '日历', 1, 255, 1),
(6, 4, 0, 'userapi', '万年历', 1, 255, 1),
(7, 4, 0, 'userapi', '黄历', 1, 255, 1),
(8, 4, 0, 'userapi', '几号', 1, 255, 1),
(9, 5, 0, 'userapi', '新闻', 1, 255, 1),
(10, 6, 0, 'userapi', '^(申通|圆通|中通|汇通|韵达|顺丰|EMS) *[a-z0-9]{1,}$', 3, 255, 1),
(11, 7, 1, 'cover', '个人中心', 1, 0, 1),
(12, 8, 1, 'cover', '首页', 1, 0, 1),
(16, 9, 2, 'cover', '高新信息产业园', 1, 0, 1),
(14, 10, 2, 'cover', '嘉洲富苑', 1, 0, 1),
(15, 11, 2, 'cover', 'd1', 1, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_article`
--

CREATE TABLE IF NOT EXISTS `ims_site_article` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `iscommend` tinyint(1) NOT NULL,
  `ishot` tinyint(1) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL,
  `ccate` int(10) unsigned NOT NULL,
  `template` varchar(300) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `incontent` tinyint(1) NOT NULL,
  `source` varchar(255) NOT NULL,
  `author` varchar(50) NOT NULL,
  `displayorder` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `click` int(10) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `credit` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_category`
--

CREATE TABLE IF NOT EXISTS `ims_site_category` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `icon` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `linkurl` varchar(500) NOT NULL,
  `ishomepage` tinyint(1) NOT NULL,
  `icontype` tinyint(1) unsigned NOT NULL,
  `css` varchar(500) NOT NULL,
  `multiid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_multi`
--

CREATE TABLE IF NOT EXISTS `ims_site_multi` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `site_info` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `bindhost` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_site_multi`
--

INSERT INTO `ims_site_multi` (`id`, `uniacid`, `title`, `styleid`, `site_info`, `status`, `bindhost`) VALUES
(1, 1, '微擎团队', 1, '', 1, ''),
(2, 2, '福城物业', 2, '', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_nav`
--

CREATE TABLE IF NOT EXISTS `ims_site_nav` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `section` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `displayorder` smallint(5) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `position` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(500) NOT NULL,
  `css` varchar(1000) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `categoryid` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_page`
--

CREATE TABLE IF NOT EXISTS `ims_site_page` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `params` longtext NOT NULL,
  `html` longtext NOT NULL,
  `multipage` longtext NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `goodnum` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_slide`
--

CREATE TABLE IF NOT EXISTS `ims_site_slide` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `displayorder` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_store_goods`
--

CREATE TABLE IF NOT EXISTS `ims_site_store_goods` (
  `id` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL,
  `title` varchar(100) NOT NULL,
  `module` varchar(50) NOT NULL,
  `account_num` int(10) NOT NULL,
  `wxapp_num` int(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `slide` varchar(1000) NOT NULL,
  `category_id` int(10) NOT NULL,
  `title_initial` varchar(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `synopsis` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `module_group` int(10) NOT NULL,
  `api_num` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_store_order`
--

CREATE TABLE IF NOT EXISTS `ims_site_store_order` (
  `id` int(10) unsigned NOT NULL,
  `orderid` varchar(28) NOT NULL,
  `goodsid` int(10) NOT NULL,
  `duration` int(10) NOT NULL,
  `buyer` varchar(50) NOT NULL,
  `buyerid` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `changeprice` tinyint(1) NOT NULL,
  `createtime` int(10) NOT NULL,
  `uniacid` int(10) NOT NULL,
  `endtime` int(15) NOT NULL,
  `wxapp` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_styles`
--

CREATE TABLE IF NOT EXISTS `ims_site_styles` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_site_styles`
--

INSERT INTO `ims_site_styles` (`id`, `uniacid`, `templateid`, `name`) VALUES
(1, 1, 1, '微站默认模板_gC5C'),
(2, 2, 1, '微站默认模板_iwMA');

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_styles_vars`
--

CREATE TABLE IF NOT EXISTS `ims_site_styles_vars` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `templateid` int(10) unsigned NOT NULL,
  `styleid` int(10) unsigned NOT NULL,
  `variable` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_site_templates`
--

CREATE TABLE IF NOT EXISTS `ims_site_templates` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `version` varchar(64) NOT NULL,
  `description` varchar(500) NOT NULL,
  `author` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `sections` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_site_templates`
--

INSERT INTO `ims_site_templates` (`id`, `name`, `title`, `version`, `description`, `author`, `url`, `type`, `sections`) VALUES
(1, 'default', '微站默认模板', '', '由微擎提供默认微站模板套系', '微擎团队', 'http://we7.cc', '1', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_stat_fans`
--

CREATE TABLE IF NOT EXISTS `ims_stat_fans` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `new` int(10) unsigned NOT NULL,
  `cancel` int(10) unsigned NOT NULL,
  `cumulate` int(10) NOT NULL,
  `date` varchar(8) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_stat_fans`
--

INSERT INTO `ims_stat_fans` (`id`, `uniacid`, `new`, `cancel`, `cumulate`, `date`) VALUES
(1, 1, 0, 0, 0, '20170806'),
(2, 1, 0, 0, 0, '20170805'),
(3, 1, 0, 0, 0, '20170804'),
(4, 1, 0, 0, 0, '20170803'),
(5, 1, 0, 0, 0, '20170802'),
(6, 1, 0, 0, 0, '20170801'),
(7, 1, 0, 0, 0, '20170731'),
(8, 1, 0, 0, 0, '20170807'),
(9, 1, 0, 0, 0, '20170808'),
(10, 2, 1, 0, 8, '20170809'),
(11, 2, 0, 0, 7, '20170808'),
(12, 2, 0, 0, 7, '20170807'),
(13, 2, 0, 0, 7, '20170806'),
(14, 2, 0, 0, 7, '20170805'),
(15, 2, 1, 1, 7, '20170804'),
(16, 2, 5, 0, 7, '20170803'),
(17, 2, 0, 0, 2, '20170802'),
(18, 2, 0, 0, 8, '20170810'),
(19, 2, 0, 0, 8, '20170813'),
(20, 2, 0, 0, 8, '20170812'),
(21, 2, 0, 0, 8, '20170811'),
(22, 2, 0, 0, 8, '20170814'),
(23, 2, 0, 0, 8, '20170815'),
(24, 2, 0, 0, 8, '20170816'),
(25, 2, 0, 0, 8, '20170817'),
(26, 2, 0, 0, 8, '20170818'),
(27, 2, 0, 0, 8, '20170820'),
(28, 2, 0, 0, 8, '20170819'),
(29, 2, 0, 0, 8, '20170821'),
(30, 2, 1, 0, 9, '20170823'),
(31, 2, 0, 0, 8, '20170822'),
(32, 2, 5, 0, 14, '20170824'),
(33, 2, 0, 1, 13, '20170825'),
(34, 2, 0, 1, 13, '20170825'),
(35, 2, 0, 0, 13, '20170827'),
(36, 2, 0, 0, 13, '20170826'),
(37, 2, 0, 0, 13, '20170828'),
(38, 2, 0, 0, 13, '20170829'),
(39, 2, 0, 0, 13, '20170830'),
(40, 2, 0, 0, 13, '20170831'),
(41, 2, 1, 0, 14, '20170901'),
(42, 2, 0, 0, 14, '20170903'),
(43, 2, 0, 0, 14, '20170902'),
(44, 2, 0, 0, 14, '20170904'),
(45, 2, 0, 0, 14, '20170905'),
(46, 2, 0, 0, 14, '20170905'),
(47, 2, 3, 0, 17, '20170906'),
(48, 2, 3, 1, 19, '20170907'),
(49, 2, 16, 1, 34, '20170908'),
(50, 2, 0, 0, 34, '20170910'),
(51, 2, 0, 0, 34, '20170909'),
(52, 2, 1, 1, 35, '20170912'),
(53, 2, 0, 0, 35, '20170914'),
(54, 2, 0, 0, 35, '20170913'),
(55, 2, 1, 0, 35, '20170911'),
(56, 2, 2, 0, 37, '20170916'),
(57, 2, 0, 0, 35, '20170915'),
(58, 2, 1, 0, 0, '20170921'),
(59, 2, 3, 0, 0, '20170927'),
(60, 2, 2, 0, 0, '20170928'),
(61, 2, 1, 1, 43, '20171003'),
(62, 2, 0, 0, 43, '20171005'),
(63, 2, 0, 0, 43, '20171004'),
(64, 2, 0, 0, 43, '20171002'),
(65, 2, 0, 0, 43, '20171001'),
(66, 2, 0, 0, 43, '20170930'),
(67, 2, 0, 0, 43, '20170929'),
(68, 2, 0, 0, 43, '20171006'),
(69, 2, 0, 0, 43, '20171011'),
(70, 2, 0, 0, 43, '20171010'),
(71, 2, 0, 0, 43, '20171009'),
(72, 2, 0, 0, 43, '20171008'),
(73, 2, 0, 0, 43, '20171007'),
(74, 2, 0, 0, 43, '20171012'),
(75, 2, 0, 0, 43, '20171015'),
(76, 2, 0, 0, 43, '20171014'),
(77, 2, 0, 0, 43, '20171013'),
(78, 2, 1, 1, 43, '20171017'),
(79, 2, 0, 0, 43, '20171016'),
(80, 2, 0, 0, 43, '20171021'),
(81, 2, 0, 0, 43, '20171020'),
(82, 2, 0, 0, 43, '20171019'),
(83, 2, 0, 0, 43, '20171018'),
(84, 2, 0, 1, 42, '20171022'),
(85, 2, 0, 0, 42, '20171023');

-- --------------------------------------------------------

--
-- 表的结构 `ims_stat_keyword`
--

CREATE TABLE IF NOT EXISTS `ims_stat_keyword` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` varchar(10) NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_stat_msg_history`
--

CREATE TABLE IF NOT EXISTS `ims_stat_msg_history` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `kid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `type` varchar(10) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_stat_rule`
--

CREATE TABLE IF NOT EXISTS `ims_stat_rule` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `hit` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_stat_visit`
--

CREATE TABLE IF NOT EXISTS `ims_stat_visit` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `module` varchar(100) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_account`
--

CREATE TABLE IF NOT EXISTS `ims_uni_account` (
  `uniacid` int(10) unsigned NOT NULL,
  `groupid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `default_acid` int(10) unsigned NOT NULL,
  `rank` int(10) DEFAULT NULL,
  `title_initial` varchar(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_account`
--

INSERT INTO `ims_uni_account` (`uniacid`, `groupid`, `name`, `description`, `default_acid`, `rank`, `title_initial`) VALUES
(1, -1, '微擎团队', '一个朝气蓬勃的团队', 1, 1, 'W'),
(2, 0, '福城物业', '', 2, 3, 'F');

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_account_group`
--

CREATE TABLE IF NOT EXISTS `ims_uni_account_group` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `groupid` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_account_group`
--

INSERT INTO `ims_uni_account_group` (`id`, `uniacid`, `groupid`) VALUES
(1, 2, -1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_account_menus`
--

CREATE TABLE IF NOT EXISTS `ims_uni_account_menus` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `menuid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `group_id` int(10) NOT NULL,
  `client_platform_type` tinyint(3) unsigned NOT NULL,
  `area` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `isdeleted` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_account_menus`
--

INSERT INTO `ims_uni_account_menus` (`id`, `uniacid`, `menuid`, `type`, `title`, `sex`, `group_id`, `client_platform_type`, `area`, `data`, `status`, `createtime`, `isdeleted`) VALUES
(1, 2, 0, 1, '基本服务', 0, -1, 0, '', 'YToxOntzOjY6ImJ1dHRvbiI7YTozOntpOjA7YToyOntzOjQ6Im5hbWUiO3M6MTI6IueJqeS4mueuoeeQhiI7czoxMDoic3ViX2J1dHRvbiI7YTo1OntpOjA7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWwj+WMuuS4u+mhtSI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MSI7fWk6MTthOjM6e3M6NDoibmFtZSI7czoxMjoi5omL5py65byA6ZeoIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD05Ijt9aToyO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLniankuJrnvLTotLkiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTYiO31pOjM7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuaKpeS6i+aKpeS/riI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU0OiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MTIiO31pOjQ7YTozOntzOjQ6Im5hbWUiO3M6MTI6IueJqeS4mueuoeeQhiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjU0OiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MTciO319fWk6MTthOjI6e3M6NDoibmFtZSI7czoxMjoi5pm66IO95YGc6L2mIjtzOjEwOiJzdWJfYnV0dG9uIjthOjU6e2k6MDthOjM6e3M6NDoibmFtZSI7czoxMjoi6L2m5L2N5p+l6K+iIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xIjt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLmn6XnnIvotLnnlKgiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTEiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWcqOe6v+e8tOi0uSI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9MSI7fWk6MzthOjM6e3M6NDoibmFtZSI7czoxMjoi5pyI5Y2h57ut56efIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xIjt9aTo0O2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLovabovobnrqHnkIYiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTEiO319fWk6MjthOjI6e3M6NDoibmFtZSI7czoxMjoi55Sf5rS7566h5a62IjtzOjEwOiJzdWJfYnV0dG9uIjthOjU6e2k6MDthOjM6e3M6NDoibmFtZSI7czoxMjoi5a625pS/5pyN5YqhIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD03Ijt9aToxO2E6Mzp7czo0OiJuYW1lIjtzOjEyOiLmiL/lsYvnp5/otYEiO3M6NDoidHlwZSI7czo0OiJ2aWV3IjtzOjM6InVybCI7czo1MzoiaHR0cDovL3d1eWUuaW90LWdqLmNuL2FwcC9pbmRleC5waHA/aT0yJmM9ZW50cnkmZWlkPTgiO31pOjI7YTozOntzOjQ6Im5hbWUiO3M6MTI6IuWRqOi+ueWVhuWutiI7czo0OiJ0eXBlIjtzOjQ6InZpZXciO3M6MzoidXJsIjtzOjUzOiJodHRwOi8vd3V5ZS5pb3QtZ2ouY24vYXBwL2luZGV4LnBocD9pPTImYz1lbnRyeSZlaWQ9NCI7fWk6MzthOjM6e3M6NDoibmFtZSI7czoxMjoi5bCP5Yy66LaF5biCIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xNSI7fWk6NDthOjM6e3M6NDoibmFtZSI7czoxMjoi5ou86L2m5pyN5YqhIjtzOjQ6InR5cGUiO3M6NDoidmlldyI7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly93dXllLmlvdC1nai5jbi9hcHAvaW5kZXgucGhwP2k9MiZjPWVudHJ5JmVpZD0xNCI7fX19fX0=', 1, 1504924581, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_account_modules`
--

CREATE TABLE IF NOT EXISTS `ims_uni_account_modules` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `module` varchar(50) NOT NULL,
  `enabled` tinyint(1) unsigned NOT NULL,
  `settings` text NOT NULL,
  `shortcut` tinyint(1) unsigned NOT NULL,
  `displayorder` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_account_users`
--

CREATE TABLE IF NOT EXISTS `ims_uni_account_users` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `role` varchar(255) NOT NULL,
  `rank` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_account_users`
--

INSERT INTO `ims_uni_account_users` (`id`, `uniacid`, `uid`, `role`, `rank`) VALUES
(1, 2, 2, 'clerk', 0),
(2, 2, 3, 'operator', 0),
(3, 2, 4, 'operator', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_group`
--

CREATE TABLE IF NOT EXISTS `ims_uni_group` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `modules` varchar(15000) NOT NULL,
  `templates` varchar(5000) NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_group`
--

INSERT INTO `ims_uni_group` (`id`, `name`, `modules`, `templates`, `uniacid`, `owner_uid`) VALUES
(1, '体验套餐服务', 'a:1:{i:0;s:14:"feng_community";}', 'N;', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_settings`
--

CREATE TABLE IF NOT EXISTS `ims_uni_settings` (
  `uniacid` int(10) unsigned NOT NULL,
  `passport` varchar(200) NOT NULL,
  `oauth` varchar(100) NOT NULL,
  `jsauth_acid` int(10) unsigned NOT NULL,
  `uc` varchar(500) NOT NULL,
  `notify` varchar(2000) NOT NULL,
  `creditnames` varchar(500) NOT NULL,
  `creditbehaviors` varchar(500) NOT NULL,
  `welcome` varchar(60) NOT NULL,
  `default` varchar(60) NOT NULL,
  `default_message` varchar(2000) NOT NULL,
  `payment` text NOT NULL,
  `stat` varchar(300) NOT NULL,
  `default_site` int(10) unsigned DEFAULT NULL,
  `sync` tinyint(3) unsigned NOT NULL,
  `recharge` varchar(500) NOT NULL,
  `tplnotice` varchar(1000) NOT NULL,
  `grouplevel` tinyint(3) unsigned NOT NULL,
  `mcplugin` varchar(500) NOT NULL,
  `exchange_enable` tinyint(3) unsigned NOT NULL,
  `coupon_type` tinyint(3) unsigned NOT NULL,
  `menuset` text NOT NULL,
  `statistics` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_uni_settings`
--

INSERT INTO `ims_uni_settings` (`uniacid`, `passport`, `oauth`, `jsauth_acid`, `uc`, `notify`, `creditnames`, `creditbehaviors`, `welcome`, `default`, `default_message`, `payment`, `stat`, `default_site`, `sync`, `recharge`, `tplnotice`, `grouplevel`, `mcplugin`, `exchange_enable`, `coupon_type`, `menuset`, `statistics`) VALUES
(1, 'a:3:{s:8:"focusreg";i:0;s:4:"item";s:5:"email";s:4:"type";s:8:"password";}', 'a:2:{s:6:"status";s:1:"0";s:7:"account";s:1:"0";}', 0, 'a:1:{s:6:"status";i:0;}', 'a:1:{s:3:"sms";a:2:{s:7:"balance";i:0;s:9:"signature";s:0:"";}}', 'a:5:{s:7:"credit1";a:2:{s:5:"title";s:6:"积分";s:7:"enabled";i:1;}s:7:"credit2";a:2:{s:5:"title";s:6:"余额";s:7:"enabled";i:1;}s:7:"credit3";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}s:7:"credit4";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}s:7:"credit5";a:2:{s:5:"title";s:0:"";s:7:"enabled";i:0;}}', 'a:2:{s:8:"activity";s:7:"credit1";s:8:"currency";s:7:"credit2";}', '', '', '', 'a:4:{s:6:"credit";a:1:{s:6:"switch";b:0;}s:6:"alipay";a:4:{s:6:"switch";b:0;s:7:"account";s:0:"";s:7:"partner";s:0:"";s:6:"secret";s:0:"";}s:6:"wechat";a:5:{s:6:"switch";b:0;s:7:"account";b:0;s:7:"signkey";s:0:"";s:7:"partner";s:0:"";s:3:"key";s:0:"";}s:8:"delivery";a:1:{s:6:"switch";b:0;}}', '', 1, 0, '', '', 0, '', 0, 0, '', ''),
(2, '', 'a:2:{s:7:"account";s:1:"2";s:4:"host";s:0:"";}', 0, '', '', 'a:2:{s:7:"credit1";a:2:{s:5:"title";s:6:"积分";s:7:"enabled";i:1;}s:7:"credit2";a:2:{s:5:"title";s:6:"余额";s:7:"enabled";i:1;}}', 'a:2:{s:8:"activity";s:7:"credit1";s:8:"currency";s:7:"credit2";}', '', '', '', 'a:3:{s:6:"alipay";a:1:{s:6:"switch";b:1;}s:6:"credit";a:1:{s:6:"switch";b:1;}s:8:"delivery";a:1:{s:6:"switch";b:1;}}', '', 2, 1, '', '', 0, '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_uni_verifycode`
--

CREATE TABLE IF NOT EXISTS `ims_uni_verifycode` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `receiver` varchar(50) NOT NULL,
  `verifycode` varchar(6) NOT NULL,
  `total` tinyint(3) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_userapi_cache`
--

CREATE TABLE IF NOT EXISTS `ims_userapi_cache` (
  `id` int(10) unsigned NOT NULL,
  `key` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_userapi_reply`
--

CREATE TABLE IF NOT EXISTS `ims_userapi_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `description` varchar(300) NOT NULL,
  `apiurl` varchar(300) NOT NULL,
  `token` varchar(32) NOT NULL,
  `default_text` varchar(100) NOT NULL,
  `cachetime` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_userapi_reply`
--

INSERT INTO `ims_userapi_reply` (`id`, `rid`, `description`, `apiurl`, `token`, `default_text`, `cachetime`) VALUES
(1, 1, '"城市名+天气", 如: "北京天气"', 'weather.php', '', '', 0),
(2, 2, '"百科+查询内容" 或 "定义+查询内容", 如: "百科姚明", "定义自行车"', 'baike.php', '', '', 0),
(3, 3, '"@查询内容(中文或英文)"', 'translate.php', '', '', 0),
(4, 4, '"日历", "万年历", "黄历"或"几号"', 'calendar.php', '', '', 0),
(5, 5, '"新闻"', 'news.php', '', '', 0),
(6, 6, '"快递+单号", 如: "申通1200041125"', 'express.php', '', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_users`
--

CREATE TABLE IF NOT EXISTS `ims_users` (
  `uid` int(10) unsigned NOT NULL,
  `groupid` int(10) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `joindate` int(10) unsigned NOT NULL,
  `joinip` varchar(15) NOT NULL,
  `lastvisit` int(10) unsigned NOT NULL,
  `lastip` varchar(15) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL,
  `founder_groupid` tinyint(4) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_users`
--

INSERT INTO `ims_users` (`uid`, `groupid`, `username`, `password`, `salt`, `type`, `status`, `joindate`, `joinip`, `lastvisit`, `lastip`, `remark`, `starttime`, `endtime`, `owner_uid`, `founder_groupid`) VALUES
(1, 0, 'admin', 'abd3539bc8ebae4d999258b9226fb4c447a0fdae', 'fb6fdf17', 1, 0, 1502070134, '', 1508833622, '116.1.75.180', '', 0, 0, 0, 1),
(2, 0, 'wuye', '8cbe48a87b33be00922a0a7953a678be2cad2785', 'bUvKdEPu', 3, 2, 1504924983, '116.1.4.48', 1508666054, '116.1.116.243', '', 0, 0, 0, 0),
(3, 1, '15880089917', '8904b28f22ec4f0b6745b491bea7280a77b182eb', 'x1j316Ff', 1, 2, 1504925606, '116.1.4.48', 1505117524, '14.25.62.207', '', 0, 0, 0, 0),
(4, 1, '13540491005', 'ee4ce55478a8e12a352d2a8b56feeb6ad5761e59', 'U9Jq2M09', 1, 2, 1504945881, '14.20.91.248', 1505117919, '14.25.62.207', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_failed_login`
--

CREATE TABLE IF NOT EXISTS `ims_users_failed_login` (
  `id` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `username` varchar(32) NOT NULL,
  `count` tinyint(1) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_founder_group`
--

CREATE TABLE IF NOT EXISTS `ims_users_founder_group` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_group`
--

CREATE TABLE IF NOT EXISTS `ims_users_group` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `package` varchar(5000) NOT NULL,
  `maxaccount` int(10) unsigned NOT NULL,
  `maxsubaccount` int(10) unsigned NOT NULL,
  `timelimit` int(10) unsigned NOT NULL,
  `maxwxapp` int(10) unsigned NOT NULL,
  `owner_uid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_invitation`
--

CREATE TABLE IF NOT EXISTS `ims_users_invitation` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(64) NOT NULL,
  `fromuid` int(10) unsigned NOT NULL,
  `inviteuid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_permission`
--

CREATE TABLE IF NOT EXISTS `ims_users_permission` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` varchar(100) NOT NULL,
  `permission` varchar(10000) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_users_permission`
--

INSERT INTO `ims_users_permission` (`id`, `uniacid`, `uid`, `type`, `permission`, `url`) VALUES
(1, 2, 2, 'feng_community', 'feng_community_permissions|feng_community_cover_home|feng_community_cover_announcement|feng_community_cover_activity|feng_community_cover_business|feng_community_cover_fled|feng_community_cover_cost|feng_community_cover_homemaking|feng_community_cover_houselease|feng_community_cover_opendoor|feng_community_cover_phone|feng_community_cover_report|feng_community_cover_repair|feng_community_cover_search|feng_community_cover_car|feng_community_cover_shopping|feng_community_cover_member|feng_community_cover_xqsys|feng_community_menu_manage', ''),
(2, 2, 3, 'feng_community', 'all', ''),
(3, 2, 4, 'feng_community', 'all', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_users_profile`
--

CREATE TABLE IF NOT EXISTS `ims_users_profile` (
  `id` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `edittime` int(10) NOT NULL,
  `realname` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `fakeid` varchar(30) NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthyear` smallint(6) unsigned NOT NULL,
  `birthmonth` tinyint(3) unsigned NOT NULL,
  `birthday` tinyint(3) unsigned NOT NULL,
  `constellation` varchar(10) NOT NULL,
  `zodiac` varchar(5) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idcard` varchar(30) NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `resideprovince` varchar(30) NOT NULL,
  `residecity` varchar(30) NOT NULL,
  `residedist` varchar(30) NOT NULL,
  `graduateschool` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `education` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `position` varchar(30) NOT NULL,
  `revenue` varchar(10) NOT NULL,
  `affectivestatus` varchar(30) NOT NULL,
  `lookingfor` varchar(255) NOT NULL,
  `bloodtype` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `alipay` varchar(30) NOT NULL,
  `msn` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `taobao` varchar(30) NOT NULL,
  `site` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `interest` text NOT NULL,
  `workerid` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_video_reply`
--

CREATE TABLE IF NOT EXISTS `ims_video_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_voice_reply`
--

CREATE TABLE IF NOT EXISTS `ims_voice_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `mediaid` varchar(255) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_wechat_attachment`
--

CREATE TABLE IF NOT EXISTS `ims_wechat_attachment` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `acid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `media_id` varchar(255) NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `type` varchar(15) NOT NULL,
  `model` varchar(25) NOT NULL,
  `tag` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_wechat_news`
--

CREATE TABLE IF NOT EXISTS `ims_wechat_news` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned DEFAULT NULL,
  `attach_id` int(10) unsigned NOT NULL,
  `thumb_media_id` varchar(60) NOT NULL,
  `thumb_url` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(30) NOT NULL,
  `digest` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content_source_url` varchar(200) NOT NULL,
  `show_cover_pic` tinyint(3) unsigned NOT NULL,
  `url` varchar(200) NOT NULL,
  `displayorder` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_wxapp_general_analysis`
--

CREATE TABLE IF NOT EXISTS `ims_wxapp_general_analysis` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `session_cnt` int(10) NOT NULL,
  `visit_pv` int(10) NOT NULL,
  `visit_uv` int(10) NOT NULL,
  `visit_uv_new` int(10) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `stay_time_uv` varchar(10) NOT NULL,
  `stay_time_session` varchar(10) NOT NULL,
  `visit_depth` varchar(10) NOT NULL,
  `ref_date` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_wxapp_versions`
--

CREATE TABLE IF NOT EXISTS `ims_wxapp_versions` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `multiid` int(10) unsigned NOT NULL,
  `version` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `modules` varchar(1000) NOT NULL,
  `design_method` tinyint(1) NOT NULL,
  `template` int(10) NOT NULL,
  `quickmenu` varchar(2500) NOT NULL,
  `createtime` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_wxcard_reply`
--

CREATE TABLE IF NOT EXISTS `ims_wxcard_reply` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `title` varchar(30) NOT NULL,
  `card_id` varchar(50) NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `brand_name` varchar(30) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `success` varchar(255) NOT NULL,
  `error` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_activity`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_activity` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `enddate` int(11) NOT NULL,
  `picurl` varchar(1000) NOT NULL,
  `number` int(11) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `status` int(1) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小区活动表';

--
-- 转存表中的数据 `ims_xcommunity_activity`
--

INSERT INTO `ims_xcommunity_activity` (`id`, `uniacid`, `title`, `starttime`, `endtime`, `enddate`, `picurl`, `number`, `content`, `status`, `price`, `createtime`, `uid`, `province`, `city`, `dist`) VALUES
(1, 2, '高新信息产业园活动', 1502208000, 1502380800, 1502356836, 'images/2/2017/08/lkQKOQkkKtA7MNa45rRKa4mOnnOrB9.jpg', 1, '<p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/vHJ2lJ242Sfv4H4fn6SvLfJxn2hF53.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/S991Lo9L3CkRzY1oyoSlih7kp69xCo.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/y2K0I13gko0ok8oLZKAA3ak002orU2.jpg" width="100%" style=""/></p><p><br/></p>', 1, '1.00', 1502270482, 1, '广西壮族自治区', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_activity_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_activity_region` (
  `id` int(10) unsigned NOT NULL,
  `activityid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小区活动副表';

--
-- 转存表中的数据 `ims_xcommunity_activity_region`
--

INSERT INTO `ims_xcommunity_activity_region` (`id`, `activityid`, `regionid`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_alipayment`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_alipayment` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `type` int(1) NOT NULL COMMENT '新增类型',
  `userid` int(11) NOT NULL COMMENT '存小区id或者操作员id',
  `account` varchar(50) NOT NULL,
  `partner` varchar(50) NOT NULL,
  `secret` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付宝配置';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_announcement`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_announcement` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `title` varchar(255) NOT NULL COMMENT '通知标题',
  `reason` text NOT NULL COMMENT '通知内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL COMMENT '改成发布类别，1首页公告，2小区公告，3员工内部通知',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `dist` varchar(50) NOT NULL COMMENT '区',
  `remark` varchar(100) NOT NULL,
  `enable` int(1) NOT NULL,
  `pic` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_announcement`
--

INSERT INTO `ims_xcommunity_announcement` (`id`, `uniacid`, `title`, `reason`, `createtime`, `status`, `uid`, `province`, `city`, `dist`, `remark`, `enable`, `pic`) VALUES
(1, 2, '高新信息产业园的业主注意了', '<p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/pNKhIZunGR2hh2xNNr5h2i2z0H9xHR.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/H7Bw3bXSbBL1CG13Fbed37Ou5Wckp8.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/RIhEd6hrfGMg6F54qR350YBfz5R46G.jpg" width="100%" style=""/></p><p><br/></p>', 1502263758, 2, 1, '广西壮族自治区', '桂林市', '', '', 2, NULL),
(2, 2, '2017年第17号台风古超或将明天生成台风', '<p><strong>2017年第17号台风<span style="color: rgb(229, 51, 51);">古超</span>，英文名：<span style="color: rgb(229, 51, 51);">Guchol，编号1717</span>，名称来源于密克罗尼西亚，含义：姜黄(一种香料)</strong></p><p style="white-space: normal;">　　推荐阅读：<a href="http://sz.bendibao.com/news/201794/796519.htm" target="_blank">2017年未生成台风命名表</a>←（点我阅读）</p><p>　【今年第16号台风“玛娃”停止编号】</p><p>　　今年第16号台风“玛娃”减弱后的热带低压今天（4日）上午继续减弱，目前已很难确定其环流中心，中央气象台于今天上午10点钟对其停止编号。但受其残留云系影响，今天广东中部和东北部沿海、福建东南部、湖南南部等地的部分地区有大到暴雨，其中广东中部局地有大暴雨（100～140毫米）</p><p style="text-align: center;"><img width="550" alt="2017年第17号台风古超最新消息 或将明天生成台风" src="http://imgbdb2.bendibao.com/szbdb/20179/04/2017904154302_48432.png"/></p><p>　【热带低压在菲律宾以东洋面生成】</p><p>　　菲律宾以东洋面的热带低压已于今天上午8点钟在西北太平洋洋面上生成，其中心位于菲律宾马尼拉东偏北方大约810公里的洋面上，就是北纬16.4度、东经128.3度，中心附近最大风力7级（15米/秒），中心最低气压1002百帕。</p><p>　　预计，该热带低压将以每小时10公里左右的速度向西偏北方向移动，强度逐渐加强，并有可能于未来24小时内发展为今年第17号台风，尔后逐渐向台湾东南洋面靠近。</p><p><span style="white-space: normal;">　　</span>上述提到的热带低压不出意外应该就是今年的第17号台风古超了。下面我们来看看古超的实时路径图吧！</p><p><span style="white-space: normal;">　　</span>【实时路径图】</p><p style="text-align: center;"><img width="550" alt="2017年第17号台风古超最新消息 或将明天生成台风" src="http://imgbdb2.bendibao.com/szbdb/20179/04/2017904154140_59696.png"/></p><p><span style="white-space: normal;">　　</span>目前古超离我们还有很远，大家不用担心，深圳本地宝会持续为您关注台风的最新信息！</p><p></p>', 1504527460, 1, 1, '广东省', '深圳市', '福田区', '', 1, NULL),
(3, 2, '教师节快乐', '祝所有的教师业主节日快乐', 1504947194, 2, 4, '', '', '', '', 1, 'images/bl150494719458917.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_announcement_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_announcement_region` (
  `id` int(10) unsigned NOT NULL,
  `aid` int(11) unsigned NOT NULL COMMENT '公告id',
  `regionid` int(11) NOT NULL COMMENT '小区id'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_announcement_region`
--

INSERT INTO `ims_xcommunity_announcement_region` (`id`, `aid`, `regionid`) VALUES
(1, 1, 1),
(3, 2, 1),
(4, 3, 1),
(5, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_bind_door`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_bind_door` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `regionid` int(11) NOT NULL COMMENT '小区id',
  `uid` int(11) NOT NULL COMMENT '业主id',
  `deviceid` text NOT NULL COMMENT '开门绑定'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='开门绑定';

--
-- 转存表中的数据 `ims_xcommunity_bind_door`
--

INSERT INTO `ims_xcommunity_bind_door` (`id`, `uniacid`, `regionid`, `uid`, `deviceid`) VALUES
(2, 2, 1, 1, ''),
(3, 2, 1, 11, ''),
(4, 2, 1, 12, ''),
(5, 2, 1, 14, ''),
(6, 2, 1, 15, ''),
(7, 2, 1, 17, ''),
(8, 2, 1, 16, ''),
(9, 2, 1, 18, ''),
(10, 2, 1, 4, ''),
(11, 2, 1, 23, ''),
(12, 2, 1, 22, ''),
(13, 2, 1, 21, ''),
(14, 2, 1, 20, ''),
(15, 2, 1, 19, ''),
(16, 2, 1, 26, ''),
(17, 2, 1, 25, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_bind_door_device`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_bind_door_device` (
  `id` int(10) unsigned NOT NULL,
  `doorid` int(10) unsigned NOT NULL,
  `deviceid` int(11) NOT NULL COMMENT '设备id'
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_bind_door_device`
--

INSERT INTO `ims_xcommunity_bind_door_device` (`id`, `doorid`, `deviceid`) VALUES
(3, 2, 2),
(4, 3, 3),
(9, 4, 3),
(8, 5, 3),
(7, 6, 3),
(10, 7, 3),
(18, 9, 3),
(13, 10, 3),
(14, 11, 3),
(15, 12, 3),
(16, 13, 3),
(17, 14, 3),
(19, 15, 3),
(20, 16, 3),
(21, 17, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_building`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_building` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `regionid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `num` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_building_device`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_building_device` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL,
  `regionid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `device_code` varchar(100) NOT NULL,
  `device_gprs` varchar(50) NOT NULL COMMENT 'gprs卡号,新增',
  `type` int(1) NOT NULL,
  `uid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  `openurl` varchar(100) NOT NULL,
  `lng` varchar(30) DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_building_device`
--

INSERT INTO `ims_xcommunity_building_device` (`id`, `uniacid`, `displayorder`, `regionid`, `title`, `unit`, `device_code`, `device_gprs`, `type`, `uid`, `createtime`, `openurl`, `lng`, `lat`) VALUES
(2, 2, 0, 1, '1栋', '1', 'M000584', '898602B8191651229187106488863', 2, 1, 1503711433, '', '', ''),
(3, 2, 0, 1, '测试', '', 'M866050032997981', '', 2, 1, 1503537196, '', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_carpool`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_carpool` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `seat` int(2) unsigned NOT NULL,
  `sprice` int(10) unsigned NOT NULL,
  `contact` varchar(50) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `uid` int(11) unsigned NOT NULL COMMENT '业主id',
  `start_position` varchar(100) NOT NULL,
  `end_position` varchar(100) NOT NULL,
  `gotime` varchar(10) NOT NULL,
  `backtime` varchar(10) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL,
  `type` int(11) NOT NULL COMMENT '类型,1司机，2乘客',
  `black` int(1) NOT NULL,
  `enable` tinyint(1) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_carpool`
--

INSERT INTO `ims_xcommunity_carpool` (`id`, `uniacid`, `title`, `seat`, `sprice`, `contact`, `mobile`, `uid`, `start_position`, `end_position`, `gotime`, `backtime`, `createtime`, `regionid`, `type`, `black`, `enable`) VALUES
(1, 2, '明天早上去北站', 1, 20, '庞金龙', '15240694132', 1, '北极广场', '桂林北站', '2017-08-10', '2017-08-11', 1502273593, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_cart`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_cart` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `marketprice` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_cart`
--

INSERT INTO `ims_xcommunity_cart` (`id`, `uniacid`, `regionid`, `goodsid`, `uid`, `total`, `marketprice`) VALUES
(2, 2, 1, 4, 2, 1, '21.00'),
(3, 2, 1, 5, 2, 2, '12.00'),
(4, 2, 1, 2, 2, 1, '10.00'),
(5, 2, 1, 2, 38, 1, '10.00');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_car_images`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_car_images` (
  `id` int(11) unsigned NOT NULL,
  `carid` int(11) NOT NULL COMMENT '二手id',
  `thumbid` int(11) NOT NULL COMMENT '图片id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片关联表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_category`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_category` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned DEFAULT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text NOT NULL,
  `gtime` varchar(50) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned DEFAULT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_category`
--

INSERT INTO `ims_xcommunity_category` (`id`, `uniacid`, `parentid`, `name`, `price`, `description`, `gtime`, `thumb`, `displayorder`, `enabled`, `type`, `regionid`, `url`) VALUES
(1, 2, 0, '公共设施保修', '0.00', '公共设施保修', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/tBVBqi7SBBxccsxbuv4q9PCYrIvZsR.jpg', 0, 1, 2, NULL, ''),
(2, 2, NULL, '干洗', '10.00', '干洗', '1', '', 0, 1, 1, NULL, ''),
(3, 2, 0, '食品', '0.00', '食品食品', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/r3m61w0wYtc1wU7guf15y232nyP7cW.jpg', 0, 1, 5, NULL, ''),
(4, 2, 3, '肉类', '0.00', '肉类肉类肉类', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/VNpEnOWbM2WA55n02B0AzpeWdZhcEa.jpg', 0, 1, 5, NULL, ''),
(5, 2, 0, '管理意见', '0.00', '管理意见管理意见', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/RTiPZrh7IUZPzD3B0B0gigI4Pb47kh.jpg', 0, 1, 3, NULL, ''),
(7, 2, NULL, '物业费|水费|排污费|垃圾费|停车费', '0.00', '', '', '', 0, 1, 7, 1, ''),
(8, 2, NULL, '家电', '0.00', '', '', '', 0, 1, 4, NULL, ''),
(9, 2, NULL, '数码', '0.00', '', '', '', 0, 1, 4, NULL, ''),
(10, 2, NULL, '日用百货', '0.00', '', '', '', 0, 1, 4, NULL, ''),
(11, 2, NULL, '家居', '0.00', '', '', '', 0, 1, 4, NULL, ''),
(12, 2, 0, '母婴', '0.00', '母婴母婴', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/DXAcB0qa0AA0cAa0RazAcQC6Y6aYx8.jpg', 0, 1, 6, NULL, ''),
(13, 2, 12, '奶粉', '0.00', '母婴母婴母婴', '', 'http://wuye.iot-gj.cn/attachment/images/2/2017/08/THSslhlNJQsOgtqxSqQgbUxlTxoqsu.jpg', 0, 1, 6, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_company`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_company` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_cost`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_cost` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL,
  `costtime` varchar(30) NOT NULL,
  `enable` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_cost`
--

INSERT INTO `ims_xcommunity_cost` (`id`, `uniacid`, `createtime`, `regionid`, `costtime`, `enable`, `status`) VALUES
(3, 2, 1502271273, 1, '2017-08-09至2017-08-09', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_cost_list`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_cost_list` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `username` varchar(30) NOT NULL,
  `homenumber` varchar(30) NOT NULL,
  `costtime` varchar(30) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `status` varchar(3) NOT NULL,
  `paytype` tinyint(1) unsigned NOT NULL,
  `transid` varchar(30) NOT NULL DEFAULT '0',
  `fee` text NOT NULL,
  `area` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `credit1` int(10) unsigned NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_cost_list`
--

INSERT INTO `ims_xcommunity_cost_list` (`id`, `uniacid`, `regionid`, `cid`, `mobile`, `username`, `homenumber`, `costtime`, `createtime`, `status`, `paytype`, `transid`, `fee`, `area`, `remark`, `credit1`, `address`, `total`) VALUES
(9, 2, 1, 3, '15240694132', '庞金龙', '1栋1单元203室', '2017-7-1至2017-8-2', 1502271273, '1', 0, '0', '10.00|20.00|30.00|40.00', '100', '', 0, '11203', '100.00');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_coupon_order`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_coupon_order` (
  `id` int(10) unsigned NOT NULL,
  `orderid` int(11) NOT NULL,
  `couponsn` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `createtime` int(11) NOT NULL,
  `usetime` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_coupon_order`
--

INSERT INTO `ims_xcommunity_coupon_order` (`id`, `orderid`, `couponsn`, `status`, `createtime`, `usetime`, `user`, `ip`) VALUES
(1, 34, 81086865, 1, 1502333420, 0, NULL, NULL),
(2, 34, 81000643, 2, 1502333421, 1507874822, 'admin', '116.1.4.60');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_department`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_department` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_department`
--

INSERT INTO `ims_xcommunity_department` (`id`, `uniacid`, `pid`, `title`, `createtime`, `uid`) VALUES
(1, 2, 1, '维修部', 1502266997, 0),
(2, 2, 1, '财务部', 1504945704, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_dp`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_dp` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL,
  `sjname` varchar(30) NOT NULL,
  `picurl` varchar(1000) NOT NULL,
  `contactname` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `qq` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `shopdesc` varchar(500) NOT NULL,
  `businesstime` varchar(50) NOT NULL,
  `businessurl` varchar(100) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lng` varchar(20) NOT NULL,
  `parent` int(11) NOT NULL,
  `child` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `area` varchar(50) NOT NULL,
  `instruction` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_dp`
--

INSERT INTO `ims_xcommunity_dp` (`id`, `uniacid`, `uid`, `sjname`, `picurl`, `contactname`, `mobile`, `phone`, `qq`, `province`, `city`, `dist`, `address`, `shopdesc`, `businesstime`, `businessurl`, `createtime`, `lat`, `lng`, `parent`, `child`, `rid`, `displayorder`, `price`, `area`, `instruction`) VALUES
(1, 2, 1, '多多母婴', 'images/2/2017/08/rnfN4siTpGguUGu2NfE3tguN3ungiU.jpg', '龙', '15240694132', '15240694132', 521013225, '广西壮族自治区', '桂林市', '叠彩区', '东二环路与朝阳路交叉口东200米', '<p>东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米</p>', '8:00-20:00', '', 1502333095, '25.273515', '110.342121', 12, 13, 11, 0, 100, '正阳步行街', '东二环路与朝阳路交叉口东200米');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_fled`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_fled` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL COMMENT '业主id',
  `addressid` int(11) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `rolex` varchar(30) NOT NULL,
  `category` int(11) NOT NULL,
  `zprice` int(10) NOT NULL,
  `realname` varchar(18) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `description` varchar(100) NOT NULL,
  `regionid` int(10) NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `black` int(1) NOT NULL,
  `enable` tinyint(1) unsigned NOT NULL,
  `yprice` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_fled`
--

INSERT INTO `ims_xcommunity_fled` (`id`, `uniacid`, `uid`, `addressid`, `title`, `rolex`, `category`, `zprice`, `realname`, `mobile`, `description`, `regionid`, `createtime`, `status`, `black`, `enable`, `yprice`) VALUES
(1, 2, 1, 2, '全新电视机', '全新', 8, 2586, '', '', 'know无卡嗯啦', 1, 1502273922, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_fled_images`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_fled_images` (
  `id` int(11) unsigned NOT NULL,
  `fledid` int(11) NOT NULL COMMENT '二手id',
  `thumbid` int(11) NOT NULL COMMENT '图片id'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图片关联表';

--
-- 转存表中的数据 `ims_xcommunity_fled_images`
--

INSERT INTO `ims_xcommunity_fled_images` (`id`, `fledid`, `thumbid`) VALUES
(1, 1, 5);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_goods`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_goods` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL DEFAULT '0',
  `child` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `thumb_url` text,
  `unit` varchar(5) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `description` text NOT NULL,
  `instruction` varchar(50) NOT NULL,
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` int(10) NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `credit` int(11) DEFAULT '0',
  `isrecommand` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0' COMMENT '1超市，2商家',
  `dpid` int(11) DEFAULT '0',
  `sold` int(11) DEFAULT '0',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_goods`
--

INSERT INTO `ims_xcommunity_goods` (`id`, `uniacid`, `pcate`, `child`, `status`, `sort`, `displayorder`, `title`, `thumb`, `thumb_url`, `unit`, `content`, `description`, `instruction`, `marketprice`, `productprice`, `total`, `createtime`, `credit`, `isrecommand`, `type`, `dpid`, `sold`, `uid`, `starttime`, `endtime`, `province`, `city`, `dist`) VALUES
(2, 2, 3, 4, 1, 0, 0, '企鹅肉', 'images/2/2017/08/C4n4040EeH08FEizGVe2048F4G4348.jpg', 'images/2/2017/08/xBRV6vbbbDlXSejsbdfM1CBV4L1LXB.jpg,images/2/2017/08/qS02iiO2mmyni0ysJ9JGHNOOHjfG9N.jpg,images/2/2017/08/JhmJLXLDRDKFPkEJLLQqpxqDQZZ3Mp.jpg', '包', '<p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/h2g8799k9552kxtdoND7Yo9eKD7rx5.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/gzQpn4nnoP2BO8nPnNb24gNpGPNq4V.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/JDdfJI8JMFR1A3iIErIsI0D8SpJ6E6.jpg" width="100%" style=""/></p><p><img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/zil62VUzBg6utyAypyY6yXY2Ay3xBr.jpg" width="100%" style=""/></p><p><br/></p>', '', '', '10.00', '10.00', 11, 1502266284, 0, 1, 1, 0, 0, 1, 0, 0, '广西壮族自治区', '', ''),
(3, 2, 0, 0, 1, 0, 0, '嘉洲富苑', 'images/2/2017/08/c7JX7XtG8LrnFx73NVJq43lTZqJtqh.jpg', NULL, '', '<p>东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米<img src="http://wuye.iot-gj.cn/attachment/images/2/2017/08/uKK60kXXKjexJ9XJ2rKXW26K6i6mmr.jpg" width="100%" alt="images/2/2017/08/uKK60kXXKjexJ9XJ2rKXW26K6i6mmr.jpg"/></p>', '<p>东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米东二环路与朝阳路交叉口东200米</p>', '东二环路与朝阳路交叉口东200米', '10.00', '20.00', 100, 1502333248, 0, 1, 2, 1, 0, 1, 1502294400, 1502380799, '', '', ''),
(4, 2, 3, 4, 1, 0, 2, '饼干', 'images/2/2017/08/S9PdLl24ptTrTKllgfpp6llOL9kK8D.jpg', 'images/2/2017/08/sUsosKo1oujLukyEgSPEikl1p5kwYJ.jpg,images/2/2017/08/O7kafu1F9A3oa7g7FNf2o2aZ8qFO78.jpg', '包', '', '', '', '21.00', '32.00', 29, 1502416148, 0, 1, 1, 0, 0, 1, 0, 0, '广西壮族自治区', '', ''),
(5, 2, 3, 4, 1, 0, 3, '坚果', 'images/2/2017/08/HnLkTUuuNZLDklWaLRK3nDNDTlKZll.jpg', 'images/2/2017/08/jZPMpC9fuCR3tJRcEP3cqqMFC3rput.jpg', '包', '', '', '', '12.00', '22.00', 30, 1502417277, 0, 1, 1, 0, 0, 1, 0, 0, '广西壮族自治区', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_goods_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_goods_region` (
  `id` int(10) unsigned NOT NULL,
  `gid` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_goods_region`
--

INSERT INTO `ims_xcommunity_goods_region` (`id`, `gid`, `regionid`) VALUES
(5, 2, 1),
(3, 4, 1),
(4, 5, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_home`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_home` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `sort` varchar(30) NOT NULL,
  `status` int(1) NOT NULL,
  `displayorder` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_home`
--

INSERT INTO `ims_xcommunity_home` (`id`, `uniacid`, `sort`, `status`, `displayorder`) VALUES
(1, 2, 'adv', 1, 0),
(2, 2, 'notice', 1, 1),
(3, 2, 'nav', 1, 2),
(4, 2, 'cube', 1, 3),
(5, 2, 'banner', 1, 4),
(6, 2, 'goods', 1, 5);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_homemaking`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_homemaking` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `addressid` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL COMMENT '会员id',
  `regionid` int(10) unsigned NOT NULL,
  `category` int(11) NOT NULL,
  `servicetime` varchar(30) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` int(10) unsigned NOT NULL COMMENT '处理状态',
  `remark` text NOT NULL COMMENT '备注',
  `createtime` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_homemaking`
--

INSERT INTO `ims_xcommunity_homemaking` (`id`, `uniacid`, `addressid`, `uid`, `regionid`, `category`, `servicetime`, `content`, `status`, `remark`, `createtime`) VALUES
(1, 2, 2, 1, 1, 2, '2017-08-09 17:50', 'adfadfdsfdafadsfasdf', 0, '', 1502272267);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_houselease`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_houselease` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `uid` int(11) unsigned NOT NULL COMMENT '业主id',
  `regionid` int(10) unsigned NOT NULL COMMENT '小区id',
  `category` int(11) NOT NULL COMMENT '分类',
  `way` varchar(20) NOT NULL,
  `model_room` int(11) NOT NULL,
  `model_hall` int(11) NOT NULL,
  `model_toilet` int(11) NOT NULL,
  `model_area` varchar(15) NOT NULL,
  `floor_layer` int(11) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `fitment` varchar(40) NOT NULL,
  `house` varchar(40) NOT NULL,
  `allocation` varchar(500) NOT NULL,
  `price_way` varchar(30) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `checktime` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `realname` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `enable` tinyint(1) unsigned NOT NULL COMMENT '审核',
  `displayorder` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_houselease`
--

INSERT INTO `ims_xcommunity_houselease` (`id`, `uniacid`, `uid`, `regionid`, `category`, `way`, `model_room`, `model_hall`, `model_toilet`, `model_area`, `floor_layer`, `floor_number`, `fitment`, `house`, `allocation`, `price_way`, `price`, `checktime`, `title`, `realname`, `mobile`, `content`, `status`, `createtime`, `enable`, `displayorder`) VALUES
(1, 2, 1, 1, 1, '整套出租', 3, 1, 1, '100', 2, 10, '中等装修', '普通住宅', ' 床铺,暖气,电视,空调,冰箱,家具,煤气,洗衣机,热水器', '押一付二', 1000, '2017-08-31', '出租', '', '', '出租', 0, 1502264744, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_houselease_images`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_houselease_images` (
  `id` int(11) unsigned NOT NULL,
  `houseid` int(11) NOT NULL COMMENT '房屋租赁id',
  `thumbid` int(11) NOT NULL COMMENT '图片id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='图片关联表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_images`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_images` (
  `id` int(11) NOT NULL,
  `src` varchar(255) DEFAULT NULL,
  `file` longtext
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_images`
--

INSERT INTO `ims_xcommunity_images` (`id`, `src`, `file`) VALUES
(1, 'images/bl150226397842006.jpg', NULL),
(2, 'images/bl150226411427941.jpg', NULL),
(3, 'images/bl150226474413890.jpg', NULL),
(4, 'images/bl150226973745061.jpg', NULL),
(5, 'images/bl150227386948185.jpg', NULL),
(6, 'images/bl150227392190760.jpg', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `regionid` int(10) unsigned NOT NULL COMMENT '小区id',
  `remark` varchar(1000) NOT NULL COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL COMMENT '是否审核通过',
  `enable` tinyint(1) unsigned NOT NULL COMMENT '判断是否在线',
  `open_status` tinyint(1) unsigned NOT NULL COMMENT '是否拥有开门权限',
  `createtime` int(10) unsigned NOT NULL COMMENT '时间',
  `uid` int(11) unsigned NOT NULL COMMENT '系统会员id,新增',
  `license` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='小区会员表';

--
-- 转存表中的数据 `ims_xcommunity_member`
--

INSERT INTO `ims_xcommunity_member` (`id`, `uniacid`, `regionid`, `remark`, `status`, `enable`, `open_status`, `createtime`, `uid`, `license`) VALUES
(28, 2, 1, '', 1, 1, 1, 1507773288, 1, NULL),
(3, 2, 1, '', 1, 1, 1, 1502770359, 3, NULL),
(13, 2, 1, '', 1, 1, 0, 1504740988, 16, NULL),
(9, 2, 1, '', 1, 1, 1, 1504681140, 4, NULL),
(10, 2, 1, '', 1, 1, 1, 1504682250, 14, NULL),
(15, 2, 1, '', 1, 1, 1, 1504774622, 12, NULL),
(16, 2, 1, '', 1, 1, 1, 1504776963, 17, NULL),
(17, 2, 1, '', 1, 1, 1, 1504777062, 15, NULL),
(18, 2, 1, '', 1, 1, 1, 1504782817, 18, NULL),
(19, 2, 1, '', 1, 1, 1, 1504836816, 19, NULL),
(20, 2, 1, '', 1, 1, 1, 1504837960, 20, NULL),
(21, 2, 1, '', 1, 1, 1, 1504838008, 21, NULL),
(22, 2, 1, '', 1, 1, 1, 1504838404, 22, NULL),
(23, 2, 1, '', 1, 1, 1, 1504840125, 23, NULL),
(24, 2, 1, '', 1, 1, 1, 1504841984, 25, NULL),
(25, 2, 1, '', 1, 1, 1, 1504843177, 26, NULL),
(26, 2, 1, '', 1, 1, 0, 1506562664, 43, NULL),
(27, 2, 1, '', 1, 1, 0, 1506563148, 44, NULL),
(29, 2, 1, '', 1, 1, 0, 1507773332, 2, NULL),
(30, 2, 1, '', 1, 1, 0, 1507815841, 37, NULL),
(31, 2, 1, '', 1, 1, 0, 1507820631, 38, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_address`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_address` (
  `id` int(10) unsigned NOT NULL,
  `memberid` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL COMMENT '时间',
  `area` varchar(50) NOT NULL COMMENT '区',
  `build` varchar(255) NOT NULL COMMENT '楼栋',
  `unit` varchar(50) DEFAULT NULL,
  `room` varchar(255) NOT NULL COMMENT '房号',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `license` varchar(50) NOT NULL,
  `code` int(10) unsigned NOT NULL,
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '身份，房主，家属，租户',
  `enable` int(10) unsigned NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `regionid` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='地址表';

--
-- 转存表中的数据 `ims_xcommunity_member_address`
--

INSERT INTO `ims_xcommunity_member_address` (`id`, `memberid`, `createtime`, `area`, `build`, `unit`, `room`, `address`, `license`, `code`, `status`, `enable`, `uniacid`, `uid`, `regionid`) VALUES
(4, 3, 1502770359, '0', '1', '1', '02', '1栋1单元02室', '', 0, 1, 0, 2, 3, 1),
(6, 13, 1504753585, '2', '2', '1', '209', '22栋1单元209室', '', 0, 1, 1, 2, 16, 1),
(27, 28, 1507773288, '南', '2', '1', '285', '南2栋1单元285室', '', 0, 1, 1, 2, 1, 1),
(8, 15, 1504774622, '3', '3', '1', '1', '33栋1单元1室', '', 0, 1, 1, 2, 12, 1),
(9, 16, 1504776963, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 0, 2, 17, 1),
(10, 17, 1504777062, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 15, 1),
(11, 16, 1504777133, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 17, 1),
(12, 3, 1504779260, '10', '3', '1', '1', '103栋1单元1室', '', 0, 1, 1, 2, 3, 1),
(13, 18, 1504782817, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 18, 1),
(14, 18, 1504783032, '11', '11', '1', '1', '1111栋1单元1室', '', 0, 1, 0, 2, 18, 1),
(15, 9, 1504785922, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 4, 1),
(16, 19, 1504836816, '1', '2', '1', '401', '12栋1单元401室', '', 0, 1, 1, 2, 19, 1),
(17, 20, 1504837960, '3', '3', '1', '1', '33栋1单元1室', '', 0, 1, 1, 2, 20, 1),
(18, 21, 1504838008, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 21, 1),
(19, 22, 1504838404, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 22, 1),
(20, 23, 1504840125, '3', '3', '1', '1', '33栋1单元1室', '', 0, 1, 1, 2, 23, 1),
(21, 24, 1504841984, '11', '10', '1', '008', '1110栋1单元008室', '', 0, 1, 1, 2, 25, 1),
(22, 10, 1504843095, '1', '1', '1', '1', '11栋1单元1室', '', 0, 1, 1, 2, 14, 1),
(23, 25, 1504843177, '1', '|1', '1', '1', '1|1栋1单元1室', '', 0, 1, 1, 2, 26, 1),
(24, 26, 1506562664, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 0, 2, 43, 1),
(25, 26, 1506562798, '10', '10', '1', '1', '1010栋1单元1室', '', 0, 1, 1, 2, 43, 1),
(26, 27, 1506563148, '嘉洲富苑', '101011', '1', '1', '嘉洲富苑101011栋1单元1室', '', 0, 1, 1, 2, 44, 1),
(28, 29, 1507773332, 'A', '1', '1', '105', 'A1栋1单元105室', '', 0, 1, 1, 2, 2, 1),
(29, 30, 1507815841, '福成小区', '1', '1', '101', '福成小区1栋1单元101室', '', 0, 1, 1, 2, 37, 1),
(30, 31, 1507820631, '来', '1', '1', '1', '来1栋1单元1室', '', 0, 1, 1, 2, 38, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_bind`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_bind` (
  `id` int(10) unsigned NOT NULL,
  `memberid` int(10) unsigned NOT NULL DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL COMMENT '时间',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '身份，房主，家属，租户',
  `enable` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '1默认，0未在线',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `addressid` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COMMENT='新增';

--
-- 转存表中的数据 `ims_xcommunity_member_bind`
--

INSERT INTO `ims_xcommunity_member_bind` (`id`, `memberid`, `createtime`, `status`, `enable`, `uniacid`, `addressid`) VALUES
(2, 3, 1502770359, 1, 0, 2, 4),
(3, 13, 1504753585, 1, 1, 2, 6),
(4, 28, 1507773288, 1, 1, 2, 27),
(5, 15, 1504774622, 1, 1, 2, 8),
(6, 16, 1504776963, 1, 0, 2, 9),
(7, 17, 1504777062, 1, 1, 2, 10),
(8, 16, 1504777133, 1, 1, 2, 11),
(9, 3, 1504779260, 1, 1, 2, 12),
(10, 18, 1504782817, 1, 1, 2, 13),
(11, 18, 1504783032, 1, 0, 2, 14),
(12, 9, 1504785922, 1, 1, 2, 15),
(13, 19, 1504836816, 1, 1, 2, 16),
(14, 20, 1504837960, 1, 1, 2, 17),
(15, 21, 1504838008, 1, 1, 2, 18),
(16, 22, 1504838404, 1, 1, 2, 19),
(17, 23, 1504840125, 1, 1, 2, 20),
(18, 24, 1504841984, 1, 1, 2, 21),
(19, 10, 1504843095, 1, 1, 2, 22),
(20, 25, 1504843177, 1, 1, 2, 23),
(21, 26, 1506562664, 1, 0, 2, 24),
(22, 26, 1506562798, 1, 1, 2, 25),
(23, 27, 1506563148, 1, 1, 2, 26),
(24, 29, 1507773332, 1, 1, 2, 28),
(25, 30, 1507815841, 1, 1, 2, 29),
(26, 31, 1507820631, 1, 1, 2, 30),
(27, 3, 1502770359, 1, 0, 2, 4),
(28, 13, 1504753585, 1, 1, 2, 6),
(29, 28, 1507773288, 1, 1, 2, 27),
(30, 15, 1504774622, 1, 1, 2, 8),
(31, 16, 1504776963, 1, 0, 2, 9),
(32, 17, 1504777062, 1, 1, 2, 10),
(33, 16, 1504777133, 1, 1, 2, 11),
(34, 3, 1504779260, 1, 1, 2, 12),
(35, 18, 1504782817, 1, 1, 2, 13),
(36, 18, 1504783032, 1, 0, 2, 14),
(37, 9, 1504785922, 1, 1, 2, 15),
(38, 19, 1504836816, 1, 1, 2, 16),
(39, 20, 1504837960, 1, 1, 2, 17),
(40, 21, 1504838008, 1, 1, 2, 18),
(41, 22, 1504838404, 1, 1, 2, 19),
(42, 23, 1504840125, 1, 1, 2, 20),
(43, 24, 1504841984, 1, 1, 2, 21),
(44, 10, 1504843095, 1, 1, 2, 22),
(45, 25, 1504843177, 1, 1, 2, 23),
(46, 26, 1506562664, 1, 0, 2, 24),
(47, 26, 1506562798, 1, 1, 2, 25),
(48, 27, 1506563148, 1, 1, 2, 26),
(49, 29, 1507773332, 1, 1, 2, 28),
(50, 30, 1507815841, 1, 1, 2, 29),
(51, 31, 1507820631, 1, 1, 2, 30),
(52, 3, 1502770359, 1, 0, 2, 4),
(53, 13, 1504753585, 1, 1, 2, 6),
(54, 28, 1507773288, 1, 1, 2, 27),
(55, 15, 1504774622, 1, 1, 2, 8),
(56, 16, 1504776963, 1, 0, 2, 9),
(57, 17, 1504777062, 1, 1, 2, 10),
(58, 16, 1504777133, 1, 1, 2, 11),
(59, 3, 1504779260, 1, 1, 2, 12),
(60, 18, 1504782817, 1, 1, 2, 13),
(61, 18, 1504783032, 1, 0, 2, 14),
(62, 9, 1504785922, 1, 1, 2, 15),
(63, 19, 1504836816, 1, 1, 2, 16),
(64, 20, 1504837960, 1, 1, 2, 17),
(65, 21, 1504838008, 1, 1, 2, 18),
(66, 22, 1504838404, 1, 1, 2, 19),
(67, 23, 1504840125, 1, 1, 2, 20),
(68, 24, 1504841984, 1, 1, 2, 21),
(69, 10, 1504843095, 1, 1, 2, 22),
(70, 25, 1504843177, 1, 1, 2, 23),
(71, 26, 1506562664, 1, 0, 2, 24),
(72, 26, 1506562798, 1, 1, 2, 25),
(73, 27, 1506563148, 1, 1, 2, 26),
(74, 29, 1507773332, 1, 1, 2, 28),
(75, 30, 1507815841, 1, 1, 2, 29),
(76, 31, 1507820631, 1, 1, 2, 30),
(77, 3, 1502770359, 1, 0, 2, 4),
(78, 13, 1504753585, 1, 1, 2, 6),
(79, 28, 1507773288, 1, 1, 2, 27),
(80, 15, 1504774622, 1, 1, 2, 8),
(81, 16, 1504776963, 1, 0, 2, 9),
(82, 17, 1504777062, 1, 1, 2, 10),
(83, 16, 1504777133, 1, 1, 2, 11),
(84, 3, 1504779260, 1, 1, 2, 12),
(85, 18, 1504782817, 1, 1, 2, 13),
(86, 18, 1504783032, 1, 0, 2, 14),
(87, 9, 1504785922, 1, 1, 2, 15),
(88, 19, 1504836816, 1, 1, 2, 16),
(89, 20, 1504837960, 1, 1, 2, 17),
(90, 21, 1504838008, 1, 1, 2, 18),
(91, 22, 1504838404, 1, 1, 2, 19),
(92, 23, 1504840125, 1, 1, 2, 20),
(93, 24, 1504841984, 1, 1, 2, 21),
(94, 10, 1504843095, 1, 1, 2, 22),
(95, 25, 1504843177, 1, 1, 2, 23),
(96, 26, 1506562664, 1, 0, 2, 24),
(97, 26, 1506562798, 1, 1, 2, 25),
(98, 27, 1506563148, 1, 1, 2, 26),
(99, 29, 1507773332, 1, 1, 2, 28),
(100, 30, 1507815841, 1, 1, 2, 29),
(101, 31, 1507820631, 1, 1, 2, 30);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_family`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_family` (
  `id` int(10) unsigned NOT NULL,
  `from_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邀请人id',
  `to_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '被邀请人id',
  `addressid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '邀请地址id',
  `logid` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='地址表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL,
  `realname` varchar(50) NOT NULL DEFAULT '0' COMMENT '姓名',
  `mobile` varchar(14) NOT NULL DEFAULT '0',
  `addressid` int(10) unsigned NOT NULL COMMENT '地址id',
  `status` int(1) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='临时存放';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_room`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_room` (
  `id` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL COMMENT '新增小区id',
  `createtime` int(10) unsigned NOT NULL COMMENT '时间',
  `area` varchar(50) NOT NULL COMMENT '区',
  `build` varchar(255) NOT NULL COMMENT '楼栋',
  `unit` varchar(255) NOT NULL COMMENT '单元',
  `room` varchar(255) NOT NULL COMMENT '房号',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `code` int(10) unsigned NOT NULL,
  `square` varchar(20) NOT NULL,
  `enable` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '1已绑定，0未绑定',
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `memberid` int(11) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='房号表';

--
-- 转存表中的数据 `ims_xcommunity_member_room`
--

INSERT INTO `ims_xcommunity_member_room` (`id`, `regionid`, `createtime`, `area`, `build`, `unit`, `room`, `address`, `code`, `square`, `enable`, `uniacid`, `memberid`, `license`, `status`) VALUES
(4, 0, 1502770359, '0', '1', '1', '02', '1栋1单元02室', 0, '', 0, 0, NULL, NULL, NULL),
(6, 0, 1504753585, '2', '2', '1', '209', '22栋1单元209室', 0, '', 1, 2, NULL, NULL, NULL),
(27, 0, 1507773288, '南', '2', '1', '285', '南2栋1单元285室', 0, '', 1, 2, NULL, NULL, NULL),
(8, 0, 1504774622, '3', '3', '1', '1', '33栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(9, 0, 1504776963, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 0, 2, NULL, NULL, NULL),
(10, 0, 1504777062, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(11, 0, 1504777133, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(12, 0, 1504779260, '10', '3', '1', '1', '103栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(13, 0, 1504782817, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(14, 0, 1504783032, '11', '11', '1', '1', '1111栋1单元1室', 0, '', 0, 2, NULL, NULL, NULL),
(15, 0, 1504785922, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(16, 0, 1504836816, '1', '2', '1', '401', '12栋1单元401室', 0, '', 1, 2, NULL, NULL, NULL),
(17, 0, 1504837960, '3', '3', '1', '1', '33栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(18, 0, 1504838008, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(19, 0, 1504838404, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(20, 0, 1504840125, '3', '3', '1', '1', '33栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(21, 0, 1504841984, '11', '10', '1', '008', '1110栋1单元008室', 0, '', 1, 2, NULL, NULL, NULL),
(22, 0, 1504843095, '1', '1', '1', '1', '11栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(23, 0, 1504843177, '1', '|1', '1', '1', '1|1栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(24, 0, 1506562664, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 0, 2, NULL, NULL, NULL),
(25, 0, 1506562798, '10', '10', '1', '1', '1010栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(26, 0, 1506563148, '嘉洲富苑', '101011', '1', '1', '嘉洲富苑101011栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL),
(28, 0, 1507773332, 'A', '1', '1', '105', 'A1栋1单元105室', 0, '', 1, 2, NULL, NULL, NULL),
(29, 0, 1507815841, '福成小区', '1', '1', '101', '福成小区1栋1单元101室', 0, '', 1, 2, NULL, NULL, NULL),
(30, 0, 1507820631, '来', '1', '1', '1', '来1栋1单元1室', 0, '', 1, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_member_visit_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_member_visit_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL COMMENT '会员uid',
  `regionid` int(11) NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='访客';

--
-- 转存表中的数据 `ims_xcommunity_member_visit_log`
--

INSERT INTO `ims_xcommunity_member_visit_log` (`id`, `uniacid`, `uid`, `regionid`, `createtime`) VALUES
(1, 2, 1, 1, 1508832469),
(2, 2, 1, 1, 1508832470),
(3, 2, 1, 1, 1508832470),
(4, 2, 1, 1, 1508832472),
(5, 2, 1, 1, 1508832472),
(6, 2, 1, 1, 1508832487),
(7, 2, 1, 1, 1508832487),
(8, 2, 1, 1, 1508832490),
(9, 2, 1, 1, 1508832492),
(10, 2, 1, 1, 1508832492),
(11, 2, 1, 1, 1508832493),
(12, 2, 1, 1, 1508832500),
(13, 2, 1, 1, 1508832500),
(14, 2, 1, 1, 1508832503),
(15, 2, 1, 1, 1508832504),
(16, 2, 1, 1, 1508832522),
(17, 2, 1, 1, 1508832522),
(18, 2, 1, 1, 1508832522),
(19, 2, 1, 1, 1508832522),
(20, 2, 1, 1, 1508832524),
(21, 2, 1, 1, 1508832524),
(22, 2, 1, 1, 1508832524),
(23, 2, 1, 1, 1508832524),
(24, 2, 1, 1, 1508832524),
(25, 2, 1, 1, 1508832525),
(26, 2, 1, 1, 1508832525),
(27, 2, 1, 1, 1508832525),
(28, 2, 1, 1, 1508832525),
(29, 2, 1, 1, 1508832525),
(30, 2, 1, 1, 1508832525),
(31, 2, 1, 1, 1508832525),
(32, 2, 1, 1, 1508832525),
(33, 2, 1, 1, 1508832526),
(34, 2, 1, 1, 1508832526),
(35, 2, 1, 1, 1508832526),
(36, 2, 1, 1, 1508832526),
(37, 2, 1, 1, 1508832526),
(38, 2, 1, 1, 1508832526),
(39, 2, 1, 1, 1508832539),
(40, 2, 1, 1, 1508832540),
(41, 2, 1, 1, 1508833096),
(42, 2, 1, 1, 1508833097),
(43, 2, 1, 1, 1508833100),
(44, 2, 1, 1, 1508833100),
(45, 2, 1, 1, 1508833100),
(46, 2, 1, 1, 1508833102),
(47, 2, 1, 1, 1508833104),
(48, 2, 1, 1, 1508833104),
(49, 2, 1, 1, 1508833104),
(50, 2, 1, 1, 1508833105),
(51, 2, 1, 1, 1508833487),
(52, 2, 1, 1, 1508833493),
(53, 2, 1, 1, 1508835292),
(54, 2, 1, 1, 1508835293),
(55, 2, 1, 1, 1508836123),
(56, 2, 1, 1, 1508836124),
(57, 2, 1, 1, 1508836124),
(58, 2, 1, 1, 1508836126),
(59, 2, 1, 1, 1508836130),
(60, 2, 1, 1, 1508836131),
(61, 2, 1, 1, 1508836134),
(62, 2, 1, 1, 1508836135),
(63, 2, 1, 1, 1508836135),
(64, 2, 1, 1, 1508836139),
(65, 2, 1, 1, 1508836140),
(66, 2, 1, 1, 1508836148),
(67, 2, 1, 1, 1508836149),
(68, 2, 1, 1, 1508836149),
(69, 2, 1, 1, 1508836151),
(70, 2, 1, 1, 1508836155),
(71, 2, 1, 1, 1508836157),
(72, 2, 1, 1, 1508836157),
(73, 2, 1, 1, 1508836169),
(74, 2, 1, 1, 1508836171),
(75, 2, 1, 1, 1508836175),
(76, 2, 1, 1, 1508836182),
(77, 2, 1, 1, 1508836183);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_memo`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_memo` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `title` varchar(255) NOT NULL COMMENT '通知标题',
  `reason` text NOT NULL COMMENT '通知内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `xqtype` tinyint(1) NOT NULL COMMENT '1物业通知，2外部通知',
  `uid` int(11) NOT NULL COMMENT '操作员id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_memo_company`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_memo_company` (
  `id` int(10) unsigned NOT NULL,
  `memoid` int(11) unsigned NOT NULL COMMENT '公告id',
  `companyid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_menu`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_menu` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `pcate` int(10) NOT NULL COMMENT '上一级分类',
  `cate` int(10) DEFAULT '0',
  `title` varchar(30) NOT NULL COMMENT '菜单名称',
  `url` varchar(255) NOT NULL COMMENT '菜单链接',
  `do` varchar(20) NOT NULL COMMENT '菜单动作',
  `method` varchar(20) NOT NULL COMMENT '菜单方法',
  `status` int(1) NOT NULL COMMENT '1显示，2不显示',
  `displayorder` int(11) NOT NULL COMMENT '菜单排序',
  `icon` varchar(50) NOT NULL COMMENT '小图标'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COMMENT='后台菜单表';

--
-- 转存表中的数据 `ims_xcommunity_menu`
--

INSERT INTO `ims_xcommunity_menu` (`id`, `uniacid`, `pcate`, `cate`, `title`, `url`, `do`, `method`, `status`, `displayorder`, `icon`) VALUES
(1, 0, 0, 0, '基本设置', './index.php?c=site&a=entry&do=setting&method=setting&m=feng_community', 'setting', 'setting', 1, 1, 'fa fa-cog'),
(2, 0, 0, 0, '页面管理', './index.php?c=site&a=entry&do=manage&method=manage&m=feng_community', 'manage', 'manage', 1, 2, 'fa fa-columns'),
(3, 0, 0, 0, '物业服务', './index.php?c=site&a=entry&do=fun&method=fun&m=feng_community', 'fun', 'fun', 1, 3, 'fa fa-life-ring'),
(4, 0, 0, 0, '收费管理', './index.php?c=site&a=entry&do=xqcost&method=xqcost&m=', 'xqcost', 'xqcost', 1, 4, 'fa fa-money'),
(5, 0, 0, 0, '小区超市', './index.php?c=site&a=entry&do=shop&method=shop&m=feng_community', 'shop', 'shop', 1, 4, 'fa fa-shopping-cart'),
(6, 0, 0, 0, '小区商家', './index.php?c=site&a=entry&do=seller&method=seller&m=feng_community', 'seller', 'seller', 1, 5, 'fa fa-truck'),
(7, 0, 0, 0, '财务中心', './index.php?c=site&a=entry&do=xqdata&method=xqdata&m=feng_community', 'xqdata', 'xqdata', 1, 6, 'fa fa-database'),
(8, 0, 0, 0, '报表统计', './index.php?c=site&a=entry&do=xqdata&method=xqdata&m=feng_community', 'xqdata', 'xqdata', 1, 7, 'fa fa-line-chart'),
(9, 0, 0, 0, '扩展功能', './index.php?c=site&a=entry&do=xqstaff&method=xqstaff&m=feng_community', 'xqstaff', 'xqstaff', 1, 8, 'fa fa-folder-open'),
(10, 0, 0, 0, '员工管理', './index.php?c=site&a=entry&do=xqstaff&method=xqstaff&m=feng_community', 'xqstaff', 'xqstaff', 1, 9, 'fa fa-sitemap'),
(11, 0, 0, 0, '系统管理', './index.php?c=site&a=entry&do=system&method=system&m=feng_community', 'system', 'system', 1, 11, 'fa fa-cloud'),
(12, 0, 2, 0, '首页公告', './index.php?c=site&a=entry&do=sysnotice&m=feng_community', 'sysnotice', 'manage', 1, 11, ''),
(13, 0, 2, 0, '首页幻灯', './index.php?c=site&a=entry&op=list&do=slide&m=feng_community', 'slide', 'manage', 1, 12, ''),
(14, 0, 2, 0, '首页导航', './index.php?c=site&a=entry&op=list&do=nav&m=feng_community', 'nav', 'manage', 1, 13, ''),
(15, 0, 2, 0, '首页广告', './index.php?c=site&a=entry&op=list&do=banner&m=feng_community', 'banner', 'manage', 1, 14, ''),
(16, 0, 2, 0, '魔方推荐', './index.php?c=site&a=entry&do=cube&m=feng_community', 'cube', 'manage', 1, 15, ''),
(17, 0, 2, 0, '商品推荐', './index.php?c=site&a=entry&do=recommand&m=feng_community', 'recommand', 'manage', 1, 16, ''),
(18, 0, 2, 0, '主页排版', './index.php?c=site&a=entry&do=xqsort&m=feng_community', 'xqsort', 'manage', 1, 17, ''),
(19, 0, 2, 0, '页面风格', './index.php?c=site&a=entry&op=list&do=style&m=feng_community', 'style', 'manage', 1, 17, ''),
(20, 0, 2, 0, '入口链接', './index.php?c=site&a=entry&do=xqurl&m=feng_community', 'xqurl', 'manage', 1, 17, ''),
(21, 0, 2, 0, '底部菜单', './index.php?c=site&a=entry&do=footmenu&m=feng_community', 'footmenu', 'manage', 1, 17, ''),
(22, 0, 1, 0, '基础设置', './index.php?c=site&a=entry&op=set&do=set&m=feng_community', 'setset', 'setting', 1, 18, ''),
(23, 0, 1, 0, '平台设置', './index.php?c=site&a=entry&op=sys&do=set&m=feng_community', 'setsys', 'setting', 1, 19, ''),
(24, 0, 1, 0, '分享设置', './index.php?c=site&a=entry&op=xqshare&do=set&m=feng_community', 'setxqshare', 'setting', 1, 20, ''),
(25, 0, 1, 0, '短信接口', './index.php?c=site&a=entry&do=sms&m=feng_community', 'sms', 'setting', 1, 23, ''),
(26, 0, 1, 0, '打印机接口', './index.php?c=site&a=entry&op=list&do=print&m=feng_community', 'print', 'setting', 1, 24, ''),
(27, 0, 1, 0, '模板消息库', './index.php?c=site&a=entry&do=tpl&m=feng_community', 'tpl', 'setting', 1, 25, ''),
(28, 0, 1, 0, '全网通设置', './index.php?c=site&a=entry&op=qwt&do=set&m=feng_community', 'setqwt', 'setting', 1, 26, ''),
(29, 0, 1, 0, '统一小区设置', './index.php?c=site&a=entry&op=xqset&do=set&m=feng_community', 'setxqset', 'setting', 1, 27, ''),
(30, 0, 1, 0, '注册字段配置', './index.php?c=site&a=entry&op=field&do=set&m=feng_community', 'setfield', 'setting', 1, 28, ''),
(31, 0, 1, 0, '支付方式设置', './index.php?c=site&a=entry&do=pay&m=feng_community', 'pay', 'setting', 1, 29, ''),
(32, 0, 1, 0, '独立支付接口', './index.php?c=site&a=entry&do=payapi&m=feng_community', 'payapi', 'setting', 1, 30, ''),
(33, 0, 3, 0, '物业管理', './index.php?c=site&a=entry&op=list&do=property&m=feng_community', 'property', 'fun', 1, 31, ''),
(34, 0, 3, 0, '小区管理', './index.php?c=site&a=entry&op=list&do=region&m=feng_community', 'region', 'fun', 1, 31, ''),
(35, 0, 3, 0, '住户管理', './index.php?c=site&a=entry&op=list&do=member&m=feng_community', 'member', 'fun', 1, 34, ''),
(36, 0, 3, 0, '房屋管理', './index.php?c=site&a=entry&op=list&do=room&m=feng_community', 'room', 'fun', 1, 33, ''),
(37, 0, 3, 0, '小区公告', './index.php?c=site&a=entry&op=list&do=announcement&m=feng_community', 'announcement', 'fun', 1, 35, ''),
(38, 0, 3, 0, '小区报修', './index.php?c=site&a=entry&op=list&do=repair&m=feng_community', 'repair', 'fun', 1, 36, ''),
(39, 0, 3, 0, '意见建议', './index.php?c=site&a=entry&op=list&do=report&m=feng_community', 'report', 'fun', 1, 37, ''),
(40, 0, 9, 0, '家政服务', './index.php?c=site&a=entry&op=list&do=homemaking&m=feng_community', 'homemaking', 'fun', 1, 38, ''),
(41, 0, 9, 0, '租赁服务', './index.php?c=site&a=entry&op=list&do=houselease&m=feng_community', 'houselease', 'fun', 1, 39, ''),
(42, 0, 4, 0, '费用管理', './index.php?c=site&a=entry&op=list&do=cost&m=feng_community', 'cost', 'xqcost', 1, 40, ''),
(43, 0, 9, 0, '小区活动', './index.php?c=site&a=entry&op=list&do=activity&m=feng_community', 'activity', 'fun', 1, 41, ''),
(44, 0, 9, 0, '便民查询', './index.php?c=site&a=entry&op=list&do=search&m=feng_community', 'search', 'fun', 1, 42, ''),
(45, 0, 9, 0, '便民号码', './index.php?c=site&a=entry&op=list&do=phone&m=feng_community', 'phone', 'fun', 1, 43, ''),
(46, 0, 9, 0, '二手市场', './index.php?c=site&a=entry&op=list&do=fled&m=feng_community', 'fled', 'fun', 1, 44, ''),
(47, 0, 9, 0, '小区拼车', './index.php?c=site&a=entry&op=list&do=car&m=feng_community', 'car', 'fun', 1, 45, ''),
(48, 0, 9, 0, '广告管理', './index.php?c=site&a=entry&do=adv&m=feng_community', 'adv', 'fun', 1, 21, ''),
(49, 0, 9, 0, '智能门禁', './index.php?c=site&a=entry&op=list&do=guard&m=feng_community', 'guard', 'fun', 1, 34, ''),
(50, 0, 9, 0, '黑名单管理', './index.php?c=site&a=entry&op=list&do=black&m=feng_community', 'black', 'fun', 1, 46, ''),
(51, 0, 3, 0, '二维码管理', './index.php?c=site&a=entry&op=list&do=qr&m=feng_community', 'qr', 'fun', 1, 47, ''),
(52, 0, 5, 0, '商品分类', './index.php?c=site&a=entry&op=list&do=category&type=5&m=feng_community', 'category', 'shop', 1, 48, ''),
(53, 0, 5, 0, '商品管理', './index.php?c=site&a=entry&op=goods&do=shopping&m=feng_community', 'shoppinggoods', 'shop', 1, 49, ''),
(54, 0, 5, 0, '订单管理', './index.php?c=site&a=entry&op=order&do=shopping&m=feng_community', 'shoppingorder', 'shop', 1, 50, ''),
(55, 0, 6, 0, '店铺分类', './index.php?c=site&a=entry&op=list&type=6&do=category&m=feng_community', 'category', 'seller', 1, 51, ''),
(56, 0, 6, 0, '店铺管理', './index.php?c=site&a=entry&op=dp&do=business&m=feng_community', 'businessdp', 'seller', 1, 52, ''),
(57, 0, 6, 0, '商品管理', './index.php?c=site&a=entry&op=goods&do=business&m=feng_community', 'businessgoods', 'seller', 1, 53, ''),
(58, 0, 6, 0, '券号核销', './index.php?c=site&a=entry&op=coupon&do=business&m=feng_community', 'businesscoupon', 'seller', 1, 55, ''),
(59, 0, 6, 0, '订单管理', './index.php?c=site&a=entry&op=order&do=business&m=feng_community', 'businessorder', 'seller', 1, 54, ''),
(60, 0, 7, 0, '提现审核', './index.php?c=site&a=entry&op=list&do=cash&m=feng_community', 'cashlist', 'cash', 1, 55, ''),
(61, 0, 8, 0, '报修统计', './index.php?c=site&a=entry&op=repair&do=data&m=feng_community', 'datarepair', 'xqdata', 1, 56, ''),
(62, 0, 8, 0, '投诉统计', './index.php?c=site&a=entry&op=report&do=data&m=feng_community', 'datareport', 'xqdata', 1, 56, ''),
(63, 0, 8, 0, '住户统计', './index.php?c=site&a=entry&op=member&do=data&m=feng_community', 'datamember', 'xqdata', 1, 56, ''),
(64, 0, 8, 0, '开门统计', './index.php?c=site&a=entry&op=open&do=data&m=feng_community', 'dataopen', 'xqdata', 1, 56, ''),
(65, 0, 8, 0, '短信统计', './index.php?c=site&a=entry&op=sms&do=data&m=feng_community', 'datasms', 'xqdata', 1, 56, ''),
(66, 0, 8, 0, '微信统计', './index.php?c=site&a=entry&op=wechat&do=data&m=feng_community', 'datawechat', 'xqdata', 1, 56, ''),
(67, 0, 8, 0, '缴费订单统计', './index.php?c=site&a=entry&op=cost&do=data&m=feng_community', 'datacost', 'xqdata', 1, 56, ''),
(68, 0, 8, 0, '商家订单统计', './index.php?c=site&a=entry&op=business&do=data&m=feng_community', 'databusiness', 'xqdata', 1, 56, ''),
(69, 0, 8, 0, '超市订单统计', './index.php?c=site&a=entry&op=shop&do=data&m=feng_community', 'datashop', 'xqdata', 1, 56, ''),
(70, 0, 10, 0, '部门管理', './index.php?c=site&a=entry&op=branch&do=staff&m=feng_community', 'staffbranch', 'xqstaff', 1, 57, ''),
(71, 0, 10, 0, '通讯录', './index.php?c=site&a=entry&op=mail&do=staff&m=feng_community', 'staffmail', 'xqstaff', 1, 58, ''),
(72, 0, 10, 0, '外部人员', './index.php?c=site&a=entry&p=company&op=worker&do=staff&m=feng_community', 'staffworker', 'xqstaff', 1, 58, ''),
(73, 0, 10, 0, '权限设置', './index.php?c=site&a=entry&op=perm&do=staff&m=feng_community', 'staffperm', 'xqstaff', 1, 59, ''),
(74, 0, 10, 0, '通知设置', './index.php?c=site&a=entry&op=notice&do=staff&m=feng_community', 'staffnotice', 'xqstaff', 1, 60, ''),
(75, 0, 10, 0, '内部公告', './index.php?c=site&a=entry&op=memo&do=staff&m=feng_community', 'staffmemo', 'xqstaff', 1, 60, ''),
(76, 0, 10, 0, '打印机设置', './index.php?c=site&a=entry&op=print&do=staff&m=feng_community', 'staffprint', 'xqstaff', 1, 61, ''),
(77, 0, 11, 0, '数据修复', './index.php?c=site&a=entry&do=updatedata&m=feng_community', 'systemupdate', 'system', 1, 64, ''),
(78, 0, 11, 0, '菜单管理', './index.php?c=site&a=entry&do=menu&m=feng_community', 'systemmenu', 'system', 1, 65, ''),
(79, 0, 11, 0, '系统授权', './index.php?c=site&a=entry&op=display&do=system&m=feng_community', 'systemdisplay', 'system', 1, 67, ''),
(80, 0, 11, 0, '系统更新', './index.php?c=site&a=entry&op=upgrade&do=system&m=feng_community', 'systemupgrade', 'system', 1, 68, ''),
(81, 0, 11, 0, '操作日志', './index.php?c=site&a=entry&do=xqlog&m=feng_community', 'systemxqlog', 'system', 1, 68, ''),
(82, 0, 11, 0, '小区应用组', './index.php?c=site&a=entry&do=group&m=feng_community', 'systemgroup', 'system', 1, 69, ''),
(83, 0, 1, 25, '基本配置', './index.php?c=site&a=entry&do=sms&m=feng_community', '', '', 1, 70, ''),
(84, 0, 1, 25, '乐信通接口', './index.php?c=site&a=entry&do=sms&op=wwt&m=feng_community', '', '', 1, 72, ''),
(85, 0, 1, 25, '聚合接口', './index.php?c=site&a=entry&do=sms&op=jh&m=feng_community', '', '', 1, 71, ''),
(86, 0, 1, 26, '基本配置', './index.php?c=site&a=entry&op=list&do=print&m=feng_community', '', '', 1, 73, ''),
(87, 0, 1, 26, '云联接口', './index.php?c=site&a=entry&op=yl&do=print&m=feng_community', '', '', 1, 74, ''),
(88, 0, 1, 26, '飞印接口', './index.php?c=site&a=entry&op=fy&do=print&m=feng_community', '', '', 1, 75, ''),
(89, 0, 1, 32, '配置', './index.php?c=site&a=entry&do=payapi&m=feng_community', '', '', 1, 76, ''),
(90, 0, 1, 32, '支付宝', './index.php?c=site&a=entry&do=payapi&op=alipay&m=feng_community', '', '', 1, 77, ''),
(91, 0, 1, 32, '微信支付', './index.php?c=site&a=entry&do=payapi&op=wechat&m=feng_community', '', '', 1, 78, ''),
(92, 0, 1, 32, '服务商支付', './index.php?c=site&a=entry&do=payapi&op=service&m=feng_community', '', '', 1, 79, ''),
(94, 0, 4, 42, '费用类型', './index.php?c=site&a=entry&do=cost&op=category&m=feng_community', '', '', 1, 80, ''),
(95, 0, 4, 42, '费用列表', './index.php?c=site&a=entry&op=list&do=cost&m=feng_community', '', '', 1, 81, ''),
(96, 0, 4, 42, '费用数据', './index.php?c=site&a=entry&op=detail&do=cost&m=feng_community', '', '', 1, 82, ''),
(97, 0, 4, 40, '服务项目', './index.php?c=site&a=entry&op=category&do=homemaking&m=feng_community', '', '', 1, 83, ''),
(98, 0, 4, 40, '信息管理', './index.php?c=site&a=entry&op=list&do=homemaking&m=feng_community', '', '', 1, 83, ''),
(99, 0, 4, 40, '接收员管理', './index.php?c=site&a=entry&op=manage&do=homemaking&m=feng_community', '', '', 1, 83, ''),
(100, 0, 4, 38, '服务分类', './index.php?c=site&a=entry&op=list&type=2&do=category&m=feng_community', '', '', 1, 83, ''),
(101, 0, 4, 38, '信息管理', './index.php?c=site&a=entry&op=list&do=repair&m=feng_community', '', '', 1, 83, ''),
(102, 0, 4, 38, '接收员管理', './index.php?c=site&a=entry&op=manage&do=repair&m=feng_community', '', '', 1, 83, ''),
(103, 0, 4, 39, '服务分类', './index.php?c=site&a=entry&op=list&type=3&do=category&m=feng_community', '', '', 1, 83, ''),
(104, 0, 4, 39, '信息管理', './index.php?c=site&a=entry&op=list&do=report&m=feng_community', '', '', 1, 83, ''),
(105, 0, 4, 39, '接收员管理', './index.php?c=site&a=entry&op=manage&do=report&m=feng_community', '', '', 1, 83, ''),
(106, 0, 9, 46, '服务分类', './index.php?c=site&a=entry&op=category&do=fled&m=feng_community', '', '', 1, 83, ''),
(107, 0, 9, 46, '信息管理', './index.php?c=site&a=entry&op=list&do=fled&m=feng_community', '', '', 1, 83, ''),
(108, 0, 10, 72, '公司管理', './index.php?c=site&a=entry&p=company&op=worker&do=staff&m=feng_community', '', '', 1, 83, ''),
(109, 0, 10, 72, '人员管理', './index.php?c=site&a=entry&p=list&op=worker&do=staff&m=feng_community', '', '', 1, 83, ''),
(110, 0, 11, 82, '用户组管理', './index.php?c=site&a=entry&op=list&do=group&m=feng_community', '', '', 1, 83, ''),
(111, 0, 11, 82, '用户管理', './index.php?c=site&a=entry&op=user&do=group&m=feng_community', '', '', 1, 83, ''),
(112, 0, 4, 42, '订单管理', './index.php?c=site&a=entry&op=order&do=cost&m=feng_community', '', '', 1, 82, ''),
(113, 0, 3, 0, '车位管理', './index.php?c=site&a=entry&op=list&do=parking&m=feng_community', 'parking', 'fun', 1, 33, ''),
(114, 0, 3, 0, '车辆管理', './index.php?c=site&a=entry&op=list&do=xqcar&m=feng_community', 'xqcar', 'fun', 1, 33, ''),
(115, 0, 9, 0, '智慧停车', './index.php?c=site&a=entry&op=list&do=zhpark&m=feng_community', 'zhpark', 'fun', 1, 34, ''),
(116, 0, 9, 115, '基本设置', './index.php?c=site&a=entry&op=set&do=zhpark&m=feng_community', '', '', 1, 82, ''),
(117, 0, 9, 115, '停车场配置', './index.php?c=site&a=entry&op=setting&do=zhpark&m=feng_community', '', '', 1, 82, ''),
(118, 0, 9, 115, '停车场管理', './index.php?c=site&a=entry&op=parking&do=zhpark&m=feng_community', '', '', 1, 82, ''),
(119, 0, 9, 115, '月租车管理', './index.php?c=site&a=entry&op=manage&do=zhpark&m=feng_community', '', '', 1, 82, ''),
(120, 0, 9, 115, '车辆延期记录', './index.php?c=site&a=entry&op=record&do=zhpark&m=feng_community', '', '', 1, 82, ''),
(121, 0, 2, 0, '应用入口', './index.php?c=site&a=entry&do=cover&m=feng_community', '', '', 1, 18, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_nav`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_nav` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `displayorder` int(10) NOT NULL COMMENT '排序',
  `pcate` int(10) NOT NULL COMMENT '一级分类id',
  `title` varchar(30) NOT NULL COMMENT '标题',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `status` int(1) NOT NULL COMMENT '移动端展示',
  `icon` varchar(50) NOT NULL COMMENT '图标',
  `bgcolor` varchar(20) NOT NULL COMMENT '背景颜色',
  `do` varchar(20) NOT NULL COMMENT '动作',
  `thumb` varchar(255) NOT NULL COMMENT '图片',
  `view` int(1) NOT NULL COMMENT '游客查看'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='移动端菜单表';

--
-- 转存表中的数据 `ims_xcommunity_nav`
--

INSERT INTO `ims_xcommunity_nav` (`id`, `uniacid`, `displayorder`, `pcate`, `title`, `url`, `status`, `icon`, `bgcolor`, `do`, `thumb`, `view`) VALUES
(1, 2, 0, 0, '物业服务', '', 1, '', '', '', '', 0),
(2, 2, 0, 1, '小区公告', 'app/index.php?i=2&c=entry&do=announcement&m=feng_community', 1, 'glyphicon glyphicon-bullhorn', '#95bd38', 'announcement', 'addons/feng_community/template/mobile/default/static/images/notice.png', 0),
(3, 2, 0, 1, '小区报修', 'app/index.php?i=2&c=entry&do=repair&m=feng_community', 1, 'glyphicon glyphicon-wrench', '#3c87c8', 'repair', 'addons/feng_community/template/mobile/default/static/images/repair.png', 0),
(4, 2, 0, 1, '意见建议', 'app/index.php?i=2&c=entry&do=report&m=feng_community', 1, 'fa fa-legal', '#dd4b2b', 'report', 'addons/feng_community/template/mobile/default/static/images/report.png', 0),
(5, 2, 0, 1, '缴物业费', 'app/index.php?i=2&c=entry&do=cost&m=feng_community', 1, 'glyphicon glyphicon-send', '#3c87c8', 'cost', 'addons/feng_community/template/mobile/default/static/images/cost.png', 0),
(6, 2, 0, 1, '便民号码', 'app/index.php?i=2&c=entry&do=phone&m=feng_community', 1, 'glyphicon glyphicon-earphone', '#ab5e90', 'phone', 'addons/feng_community/template/mobile/default/static/images/phone.png', 0),
(7, 2, 0, 1, '常用查询', 'app/index.php?i=2&c=entry&do=search&m=feng_community', 1, 'glyphicon glyphicon-search', '#ec9510', 'search', 'addons/feng_community/template/mobile/default/static/images/chaxun.png', 0),
(8, 2, 0, 1, '手机开门', 'app/index.php?i=2&c=entry&do=opendoor&m=feng_community', 1, 'glyphicon glyphicon-search', '#ec9510', 'opendoor', 'addons/feng_community/template/mobile/default/static/images/open.png', 0),
(9, 2, 0, 1, '生活缴费', 'https://payapp.weixin.qq.com/life/index?showwxpaytitle=1#wechat_redirect', 1, 'glyphicon glyphicon-search', '#ec9510', 'life', 'addons/feng_community/template/mobile/default/static/images/life.png', 0),
(10, 2, 0, 0, '小区互动', '', 1, '', '', '', '', 0),
(11, 2, 0, 10, '小区活动', 'app/index.php?i=2&c=entry&do=activity&m=feng_community', 1, 'glyphicon glyphicon-tasks', '#65944e', 'activity', 'addons/feng_community/template/mobile/default/static/images/huodong.png', 0),
(12, 2, 0, 10, '二手市场', 'app/index.php?i=2&c=entry&do=fled&m=feng_community', 1, 'fa fa-exchange', '#666699', 'fled', 'addons/feng_community/template/mobile/default/static/images/ershou.png', 0),
(13, 2, 0, 10, '小区家政', 'app/index.php?i=2&c=entry&do=homemaking&m=feng_community', 1, 'glyphicon glyphicon-leaf', '#95bd38', 'homemaking', 'addons/feng_community/template/mobile/default/static/images/jiazheng.png', 0),
(14, 2, 0, 10, '房屋租赁', 'app/index.php?i=2&c=entry&do=houselease&m=feng_community', 1, 'fa fa-info', '#38bfc8', 'houselease', 'addons/feng_community/template/mobile/default/static/images/zuning.png', 0),
(15, 2, 0, 10, '小区拼车', 'app/index.php?i=2&c=entry&do=car&m=feng_community', 1, 'fa fa-truck', '#7f6000', 'car', 'addons/feng_community/template/mobile/default/static/images/pingche.png', 0),
(16, 2, 0, 0, '生活服务', '', 1, '', '', '', '', 0),
(17, 2, 0, 16, '周边商家', 'app/index.php?i=2&c=entry&do=business&op=list&m=feng_community', 1, 'glyphicon glyphicon-shopping-cart', '#65944e', 'business', 'addons/feng_community/template/mobile/default/static/images/zhoubian.png', 0),
(18, 2, 0, 16, '生活超市', 'app/index.php?i=2&c=entry&do=shopping&op=list&m=feng_community', 1, 'glyphicon glyphicon-shopping-cart', '#65944e', 'shopping', 'addons/feng_community/template/mobile/default/static/images/chaoshi.png', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_nav_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_nav_region` (
  `id` int(11) NOT NULL,
  `nid` int(11) NOT NULL COMMENT '菜单id',
  `regionid` int(11) NOT NULL COMMENT '小区id'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_nav_region`
--

INSERT INTO `ims_xcommunity_nav_region` (`id`, `nid`, `regionid`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1),
(4, 5, 1),
(5, 6, 1),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1),
(9, 11, 1),
(10, 12, 1),
(11, 13, 1),
(12, 14, 1),
(13, 15, 1),
(14, 17, 1),
(15, 18, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_notice`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_notice` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `fansopenid` varchar(50) NOT NULL COMMENT '废弃',
  `type` int(1) NOT NULL,
  `enable` int(1) NOT NULL COMMENT '1报修，2建议',
  `uid` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `staffid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='小区通知管理';

--
-- 转存表中的数据 `ims_xcommunity_notice`
--

INSERT INTO `ims_xcommunity_notice` (`id`, `uniacid`, `fansopenid`, `type`, `enable`, `uid`, `province`, `city`, `dist`, `staffid`) VALUES
(3, 2, '', 1, 1, 1, '广西壮族自治区', '', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_notice_category`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_notice_category` (
  `id` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='通知关联分类';

--
-- 转存表中的数据 `ims_xcommunity_notice_category`
--

INSERT INTO `ims_xcommunity_notice_category` (`id`, `nid`, `cid`) VALUES
(3, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_notice_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_notice_region` (
  `id` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='通知关联小区';

--
-- 转存表中的数据 `ims_xcommunity_notice_region`
--

INSERT INTO `ims_xcommunity_notice_region` (`id`, `nid`, `regionid`) VALUES
(3, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_opendoor_data`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_opendoor_data` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `regionid` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `createtime` int(11) NOT NULL,
  `opentime` int(11) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='访客二维码记录';

--
-- 转存表中的数据 `ims_xcommunity_opendoor_data`
--

INSERT INTO `ims_xcommunity_opendoor_data` (`id`, `uniacid`, `regionid`, `uid`, `createtime`, `opentime`, `type`) VALUES
(2, 2, 1, 1, 1503711456, 1, 2),
(3, 2, 1, 3, 1503728182, 10, 2),
(4, 2, 1, 3, 1505115384, 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_open_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_open_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `regionid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `addressid` int(10) unsigned NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=376 DEFAULT CHARSET=utf8 COMMENT='开门记录';

--
-- 转存表中的数据 `ims_xcommunity_open_log`
--

INSERT INTO `ims_xcommunity_open_log` (`id`, `uniacid`, `regionid`, `type`, `uid`, `addressid`, `createtime`) VALUES
(2, 2, 1, '测试', 1, 0, 1503394303),
(3, 2, 1, '测试', 1, 0, 1503394324),
(4, 2, 1, '测试', 1, 0, 1503394370),
(5, 2, 1, '测试', 1, 0, 1503394484),
(6, 2, 1, '测试', 1, 0, 1503394496),
(7, 2, 1, '测试', 1, 0, 1503394910),
(8, 2, 1, '测试', 1, 0, 1503395228),
(9, 2, 1, '测试', 1, 0, 1503395370),
(10, 2, 1, '测试', 1, 0, 1503395445),
(11, 2, 1, '测试', 1, 0, 1503395475),
(12, 2, 1, '测试', 1, 0, 1503395533),
(13, 2, 1, '测试', 1, 0, 1503395581),
(14, 2, 1, '测试', 1, 0, 1503395599),
(15, 2, 1, '测试', 1, 0, 1503395631),
(16, 2, 1, '测试', 1, 0, 1503395947),
(17, 2, 1, '测试', 1, 0, 1503396044),
(18, 2, 1, '测试', 1, 0, 1503396057),
(19, 2, 1, '测试', 1, 0, 1503396091),
(20, 2, 1, '测试', 1, 0, 1503396103),
(21, 2, 1, '测试', 1, 0, 1503396110),
(22, 2, 1, '测试', 1, 0, 1503396356),
(23, 2, 1, '测试', 1, 0, 1503396424),
(24, 2, 1, '测试', 1, 0, 1503396646),
(25, 2, 1, '测试', 1, 0, 1503396836),
(26, 2, 1, '测试', 1, 0, 1503396888),
(27, 2, 1, '测试', 1, 0, 1503397198),
(28, 2, 1, '测试', 1, 0, 1503397264),
(29, 2, 1, '测试', 1, 0, 1503397452),
(30, 2, 1, '测试', 1, 0, 1503397554),
(31, 2, 1, '测试', 1, 0, 1503397559),
(32, 2, 1, '测试', 1, 0, 1503398034),
(33, 2, 1, '测试', 1, 0, 1503398060),
(34, 2, 1, '测试', 1, 0, 1503398358),
(35, 2, 1, '测试', 1, 0, 1503398451),
(36, 2, 1, '测试', 1, 0, 1503398466),
(37, 2, 1, '测试', 1, 0, 1503398583),
(38, 2, 1, '测试', 1, 0, 1503398599),
(39, 2, 1, '测试', 1, 0, 1503398607),
(40, 2, 1, '测试', 1, 0, 1503450141),
(41, 2, 1, '测试', 1, 0, 1503450176),
(42, 2, 1, '测试', 1, 0, 1503450195),
(43, 2, 1, '测试', 1, 0, 1503450231),
(44, 2, 1, '测试', 1, 0, 1503450241),
(45, 2, 1, '测试', 1, 0, 1503450248),
(46, 2, 1, '测试', 1, 0, 1503450328),
(47, 2, 1, '测试', 1, 0, 1503450341),
(48, 2, 1, '测试', 1, 0, 1503450358),
(49, 2, 1, '测试', 1, 0, 1503450390),
(50, 2, 1, '测试', 1, 0, 1503450537),
(51, 2, 1, '测试', 1, 0, 1503450553),
(52, 2, 1, '测试', 1, 0, 1503450561),
(53, 2, 1, '测试', 1, 0, 1503450886),
(54, 2, 1, '测试', 1, 0, 1503450917),
(55, 2, 1, '测试', 1, 0, 1503450936),
(56, 2, 1, '测试', 1, 0, 1503451115),
(57, 2, 1, '测试', 1, 0, 1503451117),
(58, 2, 1, '测试', 1, 0, 1503451120),
(59, 2, 1, '测试', 1, 0, 1503451121),
(60, 2, 1, '测试', 1, 0, 1503451122),
(61, 2, 1, '测试', 1, 0, 1503451127),
(62, 2, 1, '测试', 1, 0, 1503451212),
(63, 2, 1, '测试', 1, 0, 1503451277),
(64, 2, 1, '测试', 1, 0, 1503451749),
(65, 2, 1, '测试', 1, 0, 1503451753),
(66, 2, 1, '测试', 1, 0, 1503451759),
(67, 2, 1, '测试', 1, 0, 1503451763),
(68, 2, 1, '测试', 1, 0, 1503451782),
(69, 2, 1, '测试', 1, 0, 1503451989),
(70, 2, 1, '测试', 1, 0, 1503451993),
(71, 2, 1, '测试', 1, 0, 1503452001),
(72, 2, 1, '测试', 1, 0, 1503452054),
(73, 2, 1, '测试', 1, 0, 1503452127),
(74, 2, 1, '测试', 1, 0, 1503452340),
(75, 2, 1, '测试', 1, 0, 1503452540),
(76, 2, 1, '测试', 1, 0, 1503452544),
(77, 2, 1, '测试', 1, 0, 1503453201),
(78, 2, 1, '测试', 1, 0, 1503453231),
(79, 2, 1, '测试', 1, 0, 1503453233),
(80, 2, 1, '测试', 1, 0, 1503453235),
(81, 2, 1, '测试', 1, 0, 1503453236),
(82, 2, 1, '测试', 1, 0, 1503453238),
(83, 2, 1, '测试', 1, 0, 1503453238),
(84, 2, 1, '测试', 1, 0, 1503453291),
(85, 2, 1, '测试', 1, 0, 1503453302),
(86, 2, 1, '测试', 1, 0, 1503453359),
(87, 2, 1, '测试', 1, 0, 1503453403),
(88, 2, 1, '测试', 1, 0, 1503453491),
(89, 2, 1, '测试', 1, 0, 1503453494),
(90, 2, 1, '测试', 1, 0, 1503453495),
(91, 2, 1, '测试', 1, 0, 1503453496),
(92, 2, 1, '测试', 1, 0, 1503453496),
(93, 2, 1, '测试', 1, 0, 1503453496),
(94, 2, 1, '测试', 1, 0, 1503453497),
(95, 2, 1, '测试', 1, 0, 1503453497),
(96, 2, 1, '测试', 1, 0, 1503453497),
(97, 2, 1, '测试', 1, 0, 1503453498),
(98, 2, 1, '测试', 1, 0, 1503453498),
(99, 2, 1, '测试', 1, 0, 1503453498),
(100, 2, 1, '测试', 1, 0, 1503453500),
(101, 2, 1, '测试', 1, 0, 1503453501),
(102, 2, 1, '测试', 1, 0, 1503453502),
(103, 2, 1, '测试', 1, 0, 1503453558),
(104, 2, 1, '测试', 1, 0, 1503453579),
(105, 2, 1, '测试', 1, 0, 1503453617),
(106, 2, 1, '测试', 1, 0, 1503453633),
(107, 2, 1, '测试', 1, 0, 1503453845),
(108, 2, 1, '测试', 1, 0, 1503453894),
(109, 2, 1, '测试', 1, 0, 1503453900),
(110, 2, 1, '测试', 1, 0, 1503453904),
(111, 2, 1, '测试', 1, 0, 1503453908),
(112, 2, 1, '测试', 1, 0, 1503453986),
(113, 2, 1, '测试', 1, 0, 1503453992),
(114, 2, 1, '测试', 1, 0, 1503454004),
(115, 2, 1, '测试', 1, 0, 1503454011),
(116, 2, 1, '测试', 1, 0, 1503454030),
(117, 2, 1, '测试', 1, 0, 1503454064),
(118, 2, 1, '测试', 1, 0, 1503454133),
(119, 2, 1, '测试', 1, 0, 1503454165),
(120, 2, 1, '测试', 1, 0, 1503454175),
(121, 2, 1, '测试', 1, 0, 1503454233),
(122, 2, 1, '测试', 2, 0, 1503454294),
(123, 2, 1, '测试', 1, 0, 1503454328),
(124, 2, 1, '测试', 1, 0, 1503454334),
(125, 2, 1, '测试', 2, 0, 1503454457),
(126, 2, 1, '测试', 1, 0, 1503454581),
(127, 2, 1, '测试1', 1, 0, 1503455068),
(128, 2, 1, '测试1', 1, 0, 1503455075),
(129, 2, 1, '测试1', 1, 0, 1503455115),
(130, 2, 1, '测试1', 1, 0, 1503455163),
(131, 2, 1, '测试1', 1, 0, 1503455175),
(132, 2, 1, '测试1', 1, 0, 1503455312),
(133, 2, 1, '测试1', 1, 0, 1503455336),
(134, 2, 1, '测试1', 1, 0, 1503455401),
(135, 2, 1, '测试1', 1, 0, 1503455432),
(136, 2, 1, '测试1', 1, 0, 1503455576),
(137, 2, 1, '测试1', 1, 0, 1503455583),
(138, 2, 1, '测试1', 1, 0, 1503455588),
(139, 2, 1, '测试1', 1, 0, 1503455593),
(140, 2, 1, '测试1', 1, 0, 1503455600),
(141, 2, 1, '测试1', 1, 0, 1503455640),
(142, 2, 1, '测试1', 1, 0, 1503456123),
(143, 2, 1, '一栋一单元1', 1, 0, 1503456366),
(144, 2, 1, '1栋1', 1, 0, 1503458245),
(145, 2, 1, '1栋1', 1, 0, 1503458286),
(146, 2, 1, '1栋1', 1, 0, 1503458328),
(147, 2, 1, '测试', 3, 0, 1503480929),
(148, 2, 1, '1栋1', 1, 0, 1503481167),
(149, 2, 1, '1栋1', 3, 0, 1503481314),
(150, 2, 1, '测试', 1, 0, 1503482244),
(151, 2, 1, '1栋1', 1, 0, 1503482254),
(152, 2, 1, '测试', 3, 0, 1503482262),
(153, 2, 1, '1栋1', 1, 0, 1503482298),
(154, 2, 1, '1栋1', 1, 0, 1503482298),
(155, 2, 1, '1栋1', 1, 0, 1503482298),
(156, 2, 1, '1栋1', 1, 0, 1503482298),
(157, 2, 1, '1栋1', 1, 0, 1503482298),
(158, 2, 1, '1栋1', 1, 0, 1503482298),
(159, 2, 1, '1栋1', 1, 0, 1503482299),
(160, 2, 1, '1栋1', 1, 0, 1503482299),
(161, 2, 1, '1栋1', 1, 0, 1503482300),
(162, 2, 1, '1栋1', 1, 0, 1503482300),
(163, 2, 1, '1栋1', 1, 0, 1503482300),
(164, 2, 1, '1栋1', 1, 0, 1503482300),
(165, 2, 1, '1栋1', 1, 0, 1503482301),
(166, 2, 1, '1栋1', 1, 0, 1503482301),
(167, 2, 1, '测试', 3, 0, 1503482304),
(168, 2, 1, '测试', 3, 0, 1503487117),
(169, 2, 1, '测试', 3, 0, 1503487136),
(170, 2, 1, '测试', 3, 0, 1503487160),
(171, 2, 1, '测试', 3, 0, 1503487205),
(172, 2, 1, '测试', 3, 0, 1503487215),
(173, 2, 1, '测试', 3, 0, 1503504675),
(174, 2, 1, '测试', 3, 0, 1503505133),
(175, 2, 1, '测试', 3, 0, 1503506940),
(176, 2, 1, '测试', 3, 0, 1503535237),
(177, 2, 1, '1栋1', 1, 0, 1503541815),
(178, 2, 1, '测试', 3, 0, 1503589131),
(179, 2, 1, '测试', 3, 0, 1503589342),
(180, 2, 1, '测试', 3, 0, 1503591258),
(181, 2, 1, '测试', 3, 0, 1503619440),
(182, 2, 1, '1栋1', 3, 0, 1503619469),
(183, 2, 1, '测试', 1, 0, 1503623244),
(184, 2, 1, '1栋1', 1, 0, 1503623251),
(185, 2, 1, '1栋1', 1, 0, 1503623470),
(186, 2, 1, '1栋1', 1, 0, 1503623491),
(187, 2, 1, '1栋1', 1, 0, 1503623497),
(188, 2, 1, '1栋1', 1, 0, 1503635506),
(189, 2, 1, '测试', 1, 0, 1503635511),
(190, 2, 1, '1栋1', 1, 0, 1503635516),
(191, 2, 1, '1栋1', 1, 0, 1503635528),
(192, 2, 1, '1栋1', 1, 0, 1503635534),
(193, 2, 1, '1栋1', 1, 0, 1503635550),
(194, 2, 1, '测试', 1, 0, 1503635555),
(195, 2, 1, '测试', 3, 0, 1503637091),
(196, 2, 1, '测试', 3, 0, 1503646711),
(197, 2, 1, '测试', 1, 0, 1503646903),
(198, 2, 1, '1栋1', 1, 0, 1503646905),
(199, 2, 1, '1栋1', 1, 0, 1503646914),
(200, 2, 1, '1栋1', 1, 0, 1503646920),
(201, 2, 1, '1栋1', 1, 0, 1503646924),
(202, 2, 1, '1栋1', 1, 0, 1503646931),
(203, 2, 1, '1栋1', 1, 0, 1503711475),
(204, 2, 1, '1栋1', 1, 0, 1503716914),
(205, 2, 1, '1栋1', 1, 0, 1503716925),
(206, 2, 1, '1栋1', 1, 0, 1503717083),
(207, 2, 1, '1栋1', 1, 0, 1503717231),
(208, 2, 1, '测试', 3, 0, 1503728148),
(209, 2, 1, '测试', 3, 0, 1503728206),
(210, 2, 1, '测试', 3, 0, 1503728222),
(211, 2, 1, '测试', 3, 0, 1503730738),
(212, 2, 1, '测试', 3, 0, 1503756527),
(213, 2, 1, '1栋1', 1, 0, 1503888676),
(214, 2, 1, '1栋1', 1, 0, 1503889986),
(215, 2, 1, '1栋1', 1, 0, 1503889995),
(216, 2, 1, '1栋1', 1, 0, 1503890001),
(217, 2, 1, '1栋1', 1, 0, 1503890002),
(218, 2, 1, '1栋1', 1, 0, 1503890003),
(219, 2, 1, '1栋1', 1, 0, 1503890004),
(220, 2, 1, '1栋1', 1, 0, 1503890004),
(221, 2, 1, '1栋1', 1, 0, 1503890004),
(222, 2, 1, '1栋1', 1, 0, 1503890004),
(223, 2, 1, '1栋1', 1, 0, 1503890004),
(224, 2, 1, '1栋1', 1, 0, 1503890004),
(225, 2, 1, '1栋1', 1, 0, 1503890005),
(226, 2, 1, '1栋1', 1, 0, 1503890005),
(227, 2, 1, '1栋1', 1, 0, 1503890005),
(228, 2, 1, '1栋1', 1, 0, 1503890005),
(229, 2, 1, '1栋1', 1, 0, 1503890005),
(230, 2, 1, '1栋1', 1, 0, 1503890005),
(231, 2, 1, '1栋1', 1, 0, 1503890006),
(232, 2, 1, '1栋1', 1, 0, 1503890006),
(233, 2, 1, '1栋1', 1, 0, 1503890006),
(234, 2, 1, '1栋1', 1, 0, 1503890006),
(235, 2, 1, '1栋1', 1, 0, 1503890006),
(236, 2, 1, '1栋1', 1, 0, 1503890006),
(237, 2, 1, '1栋1', 1, 0, 1503890006),
(238, 2, 1, '1栋1', 1, 0, 1503890007),
(239, 2, 1, '1栋1', 1, 0, 1503890007),
(240, 2, 1, '1栋1', 1, 0, 1503890007),
(241, 2, 1, '1栋1', 1, 0, 1503890007),
(242, 2, 1, '1栋1', 1, 0, 1503890007),
(243, 2, 1, '1栋1', 1, 0, 1503890007),
(244, 2, 1, '1栋1', 1, 0, 1503890009),
(245, 2, 1, '1栋1', 1, 0, 1503965979),
(246, 2, 1, '1栋1', 1, 0, 1503965986),
(247, 2, 1, '测试', 3, 0, 1504167833),
(248, 2, 1, '测试', 3, 0, 1504233036),
(249, 2, 1, '测试', 3, 0, 1504344813),
(250, 2, 1, '测试', 3, 0, 1504495160),
(251, 2, 1, '测试', 3, 0, 1504495168),
(252, 2, 1, '测试', 3, 0, 1504524511),
(253, 2, 1, '1栋1', 1, 0, 1504597437),
(254, 2, 1, '1栋1', 1, 0, 1504597626),
(255, 2, 1, '测试', 3, 0, 1504679542),
(256, 2, 1, '测试', 3, 0, 1504679552),
(257, 2, 1, '测试', 3, 0, 1504679568),
(258, 2, 1, '测试', 3, 0, 1504681745),
(259, 2, 1, '测试', 3, 0, 1504681772),
(260, 2, 1, '1栋1', 3, 0, 1504682376),
(261, 2, 1, '1栋1', 3, 0, 1504682382),
(262, 2, 1, '1栋1', 3, 0, 1504682387),
(263, 2, 1, '1栋1', 3, 0, 1504682396),
(264, 2, 1, '1栋1', 3, 0, 1504682404),
(265, 2, 1, '测试', 3, 0, 1504685197),
(266, 2, 1, '1栋1', 17, 0, 1504777508),
(267, 2, 1, '1栋1', 15, 0, 1504777552),
(268, 2, 1, '测试', 1, 0, 1504777558),
(269, 2, 1, '1栋1', 1, 0, 1504777566),
(270, 2, 1, '1栋1', 15, 0, 1504777571),
(271, 2, 1, '1栋1', 15, 0, 1504777630),
(272, 2, 1, '1栋1', 15, 0, 1504777636),
(273, 2, 1, '1栋1', 17, 0, 1504778787),
(274, 2, 1, '测试', 12, 0, 1504778986),
(275, 2, 1, '测试', 12, 0, 1504779000),
(276, 2, 1, '测试', 3, 0, 1504779266),
(277, 2, 1, '1栋1', 15, 0, 1504782716),
(278, 2, 1, '1栋1', 15, 0, 1504782728),
(279, 2, 1, '测试', 15, 0, 1504782986),
(280, 2, 1, '1栋1', 4, 0, 1504786654),
(281, 2, 1, '测试', 4, 0, 1504786666),
(282, 2, 1, '测试', 4, 0, 1504786671),
(283, 2, 1, '1栋1', 4, 0, 1504786676),
(284, 2, 1, '测试', 3, 0, 1504835744),
(285, 2, 1, '测试', 4, 0, 1504835885),
(286, 2, 1, '1栋1', 15, 0, 1504836035),
(287, 2, 1, '1栋1', 15, 0, 1504836044),
(288, 2, 1, '1栋1', 15, 0, 1504836055),
(289, 2, 1, '1栋1', 15, 0, 1504836061),
(290, 2, 1, '1栋1', 15, 0, 1504836070),
(291, 2, 1, '1栋1', 15, 0, 1504836074),
(292, 2, 1, '测试', 15, 0, 1504836102),
(293, 2, 1, '测试', 15, 0, 1504836113),
(294, 2, 1, '测试', 15, 0, 1504836120),
(295, 2, 1, '测试', 15, 0, 1504836129),
(296, 2, 1, '测试', 15, 0, 1504836432),
(297, 2, 1, '测试', 15, 0, 1504836437),
(298, 2, 1, '测试', 15, 0, 1504837265),
(299, 2, 1, '测试', 15, 0, 1504837274),
(300, 2, 1, '测试', 15, 0, 1504837282),
(301, 2, 1, '测试', 15, 0, 1504837316),
(302, 2, 1, '测试', 15, 0, 1504837328),
(303, 2, 1, '测试', 15, 0, 1504837337),
(304, 2, 1, '测试', 15, 0, 1504838037),
(305, 2, 1, '测试', 15, 0, 1504838079),
(306, 2, 1, '1栋1', 15, 0, 1504838098),
(307, 2, 1, '测试', 15, 0, 1504838103),
(308, 2, 1, '测试', 15, 0, 1504838143),
(309, 2, 1, '测试', 15, 0, 1504838155),
(310, 2, 1, '测试', 3, 0, 1504838367),
(311, 2, 1, '1栋1', 15, 0, 1504838520),
(312, 2, 1, '测试', 17, 0, 1504839672),
(313, 2, 1, '测试', 17, 0, 1504839703),
(314, 2, 1, '1栋1', 17, 0, 1504839717),
(315, 2, 1, '1栋1', 17, 0, 1504839735),
(316, 2, 1, '测试', 3, 0, 1504841527),
(317, 2, 1, '1栋1', 14, 0, 1504843114),
(318, 2, 1, '1栋1', 14, 0, 1504843136),
(319, 2, 1, '测试', 22, 0, 1504845491),
(320, 2, 1, '测试', 22, 0, 1504845497),
(321, 2, 1, '测试', 22, 0, 1504845503),
(322, 2, 1, '测试', 21, 0, 1504855348),
(323, 2, 1, '测试', 21, 0, 1504855352),
(324, 2, 1, '测试', 15, 0, 1505115812),
(325, 2, 1, '测试', 15, 0, 1505115837),
(326, 2, 1, '测试', 3, 0, 1505129356),
(327, 2, 1, '测试', 3, 0, 1505129369),
(328, 2, 1, '1栋1', 14, 0, 1505208287),
(329, 2, 1, '1栋1', 14, 0, 1505208305),
(330, 2, 1, '1栋1', 14, 0, 1505208312),
(331, 2, 1, '1栋1', 14, 0, 1505208319),
(332, 2, 1, '测试', 14, 0, 1505208324),
(333, 2, 1, '测试', 14, 0, 1505208356),
(334, 2, 1, '1栋1', 14, 0, 1505208365),
(335, 2, 1, '1栋1', 14, 0, 1505208370),
(336, 2, 1, '1栋1', 14, 0, 1505208373),
(337, 2, 1, '测试', 14, 0, 1505208378),
(338, 2, 1, '1栋1', 14, 0, 1505208399),
(339, 2, 1, '1栋1', 14, 0, 1505208405),
(340, 2, 1, '测试', 14, 0, 1505208412),
(341, 2, 1, '1栋1', 14, 0, 1505208432),
(342, 2, 1, '1栋1', 14, 0, 1505208444),
(343, 2, 1, '1栋1', 14, 0, 1505208448),
(344, 2, 1, '测试', 3, 0, 1505291012),
(345, 2, 1, '1栋1', 1, 0, 1505869488),
(346, 2, 1, '测试', 1, 0, 1505869494),
(347, 2, 1, '测试', 15, 0, 1505895710),
(348, 2, 1, '测试', 14, 0, 1506412674),
(349, 2, 1, '1栋1', 14, 0, 1506412687),
(350, 2, 1, '测试', 14, 0, 1506412695),
(351, 2, 1, '1栋1', 14, 0, 1506412709),
(352, 2, 1, '测试', 14, 0, 1506412711),
(353, 2, 1, '测试', 15, 0, 1506562405),
(354, 2, 1, '测试', 15, 0, 1506562413),
(355, 2, 1, '测试', 15, 0, 1506562419),
(356, 2, 1, '测试', 15, 0, 1506563285),
(357, 2, 1, '测试', 15, 0, 1506563399),
(358, 2, 1, '测试', 3, 0, 1507368684),
(359, 2, 1, '测试', 3, 0, 1507368699),
(360, 2, 1, '测试', 3, 0, 1507368731),
(361, 2, 1, '测试', 15, 0, 1507704994),
(362, 2, 1, '测试', 15, 0, 1507705010),
(363, 2, 1, '测试', 15, 0, 1507705016),
(364, 2, 1, '测试', 1, 0, 1507874713),
(365, 2, 1, '1栋1', 1, 0, 1507874733),
(366, 2, 1, '1栋1', 1, 0, 1507874982),
(367, 2, 1, '1栋1', 17, 0, 1508111561),
(368, 2, 1, '1栋1', 17, 0, 1508111568),
(369, 2, 1, '测试', 15, 0, 1508223777),
(370, 2, 1, '测试', 15, 0, 1508223784),
(371, 2, 1, '测试', 15, 0, 1508396859),
(372, 2, 1, '测试', 15, 0, 1508396912),
(373, 2, 1, '测试', 15, 0, 1508807662),
(374, 2, 1, '测试', 1, 0, 1508832490),
(375, 2, 1, '1栋1', 1, 0, 1508832493);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_order`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_order` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `ordersn` varchar(20) NOT NULL,
  `addressid` int(10) unsigned NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `paytype` tinyint(1) unsigned NOT NULL,
  `transid` varchar(30) NOT NULL DEFAULT '0',
  `goodstype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL,
  `regionid` int(11) unsigned NOT NULL,
  `type` varchar(10) NOT NULL,
  `uid` int(11) unsigned NOT NULL COMMENT '会员id',
  `delivery` varchar(50) DEFAULT NULL,
  `credit` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_order`
--

INSERT INTO `ims_xcommunity_order` (`id`, `uniacid`, `ordersn`, `addressid`, `price`, `status`, `paytype`, `transid`, `goodstype`, `remark`, `createtime`, `regionid`, `type`, `uid`, `delivery`, `credit`) VALUES
(25, 2, '20170809161248889688', 2, '10.00', 0, 0, '0', 1, '', 1502266347, 1, 'shopping', 1, NULL, NULL),
(26, 2, '20170809161385924499', 2, '10.00', 0, 0, '0', 1, '', 1502266415, 1, 'shopping', 1, NULL, NULL),
(27, 2, '20170809172182828242', 0, '1.00', 0, 0, '0', 1, '', 1502270512, 1, 'activity', 1, NULL, NULL),
(28, 2, '20170809184226921402', 2, '100.00', 1, 1, '0', 1, '', 1502275382, 1, 'pfree', 1, NULL, NULL),
(29, 2, '20170809175368048361', 2, '10.00', 0, 0, '0', 1, '', 1502272400, 1, 'shopping', 1, NULL, NULL),
(30, 2, '20170809181291312308', 3, '10.00', 0, 0, '0', 1, '', 1502273572, 1, 'shopping', 2, NULL, NULL),
(31, 2, '20170809184062219762', 0, '1.00', 0, 0, '0', 1, '', 1502275245, 1, 'activity', 1, NULL, NULL),
(32, 2, '20170809184268843810', 0, '1.00', 1, 1, '0', 1, '', 1502275336, 1, 'activity', 1, NULL, NULL),
(33, 2, '20170809184448066432', 2, '10.00', 3, 1, '0', 1, '', 1502275441, 1, 'shopping', 1, NULL, NULL),
(34, 2, '20170810104943680846', 2, '10.00', 1, 1, '0', 1, '', 1502333399, 1, 'business', 1, NULL, NULL),
(35, 2, '20171012100381282129', 28, '10.00', 0, 3, '0', 1, '', 1507773796, 1, 'shopping', 2, '', NULL),
(36, 2, '20171012214593449449', 29, '21.00', 0, 0, '0', 1, '', 1507815927, 1, 'shopping', 37, '', NULL),
(37, 2, '20171012231295410917', 30, '10.00', 0, 0, '0', 1, '', 1507821177, 1, 'shopping', 38, '', NULL),
(38, 2, '20171012231363282784', 30, '12.00', 0, 0, '0', 1, '', 1507821223, 1, 'shopping', 38, '', NULL),
(39, 2, '20171012234865288031', 29, '21.00', 0, 0, '0', 1, '', 1507823311, 1, 'shopping', 37, '', NULL),
(40, 2, '20171012234884763864', 30, '10.00', 0, 0, '0', 1, '', 1507823323, 1, 'shopping', 38, '', NULL),
(41, 2, '20171012234948623265', 29, '12.00', 0, 3, '0', 1, '', 1507823346, 1, 'shopping', 37, '', NULL),
(42, 2, '20171012234924743542', 30, '10.00', 0, 0, '0', 1, '', 1507823348, 1, 'shopping', 38, '', NULL),
(43, 2, '20171012234908528638', 30, '21.00', 0, 0, '0', 1, '', 1507823374, 1, 'shopping', 38, '', NULL),
(44, 2, '20171024170902884838', 27, '12.00', 1, 1, '0', 1, '', 1508836157, 1, 'shopping', 1, '', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_order_goods`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_order_goods` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL,
  `goodsid` int(10) unsigned NOT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(10) unsigned NOT NULL DEFAULT '1',
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_order_goods`
--

INSERT INTO `ims_xcommunity_order_goods` (`id`, `uniacid`, `orderid`, `goodsid`, `price`, `total`, `createtime`) VALUES
(25, 2, 25, 2, '10.00', 1, 1502266347),
(26, 2, 26, 2, '10.00', 1, 1502266415),
(27, 0, 27, 1, '1.00', 1, 1502270512),
(28, 2, 28, 9, '100.00', 0, 1502271612),
(29, 2, 29, 2, '10.00', 1, 1502272400),
(30, 2, 30, 2, '10.00', 1, 1502273572),
(31, 0, 31, 1, '1.00', 1, 1502275245),
(32, 0, 32, 1, '1.00', 1, 1502275336),
(33, 2, 33, 2, '10.00', 1, 1502275441),
(34, 2, 34, 3, '10.00', 1, 1502333399),
(35, 2, 35, 2, '10.00', 1, 1507773796),
(36, 2, 36, 4, '21.00', 1, 1507815927),
(37, 2, 37, 2, '10.00', 1, 1507821177),
(38, 2, 38, 5, '12.00', 1, 1507821223),
(39, 2, 39, 4, '21.00', 1, 1507823311),
(40, 2, 40, 2, '10.00', 1, 1507823323),
(41, 2, 41, 5, '12.00', 1, 1507823346),
(42, 2, 42, 2, '10.00', 1, 1507823348),
(43, 2, 43, 4, '21.00', 1, 1507823374),
(44, 2, 44, 5, '12.00', 1, 1508836157);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_parking`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_parking` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL,
  `place_num` varchar(30) NOT NULL,
  `area` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  `remark` text NOT NULL,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='车位';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_pay`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_pay` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `type` int(1) NOT NULL COMMENT '类型',
  `wechat` int(1) NOT NULL COMMENT '微信支付,新增',
  `alipay` int(1) NOT NULL COMMENT '支付宝,新增',
  `balance` int(1) NOT NULL COMMENT '余额,新增',
  `delivery` int(1) NOT NULL COMMENT '货到付款,新增'
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='支付配置';

--
-- 转存表中的数据 `ims_xcommunity_pay`
--

INSERT INTO `ims_xcommunity_pay` (`id`, `uniacid`, `type`, `wechat`, `alipay`, `balance`, `delivery`) VALUES
(25, 2, 1, 1, 1, 1, 1),
(26, 2, 2, 1, 1, 1, 0),
(27, 2, 3, 1, 1, 1, 0),
(28, 2, 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_pay_api`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_pay_api` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `pay` text NOT NULL,
  `type` int(1) NOT NULL,
  `paytype` int(1) NOT NULL,
  `userid` int(10) unsigned NOT NULL COMMENT '绑定商家id'
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_phone`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_phone` (
  `id` int(11) unsigned NOT NULL,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `phone` varchar(50) NOT NULL COMMENT '电话',
  `content` varchar(50) NOT NULL COMMENT '内容',
  `thumb` text NOT NULL COMMENT '图片',
  `displayorder` int(10) NOT NULL COMMENT '排序',
  `uid` int(10) NOT NULL COMMENT '操作员id',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `dist` varchar(50) NOT NULL COMMENT '区'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='便民号码';

--
-- 转存表中的数据 `ims_xcommunity_phone`
--

INSERT INTO `ims_xcommunity_phone` (`id`, `uniacid`, `phone`, `content`, `thumb`, `displayorder`, `uid`, `province`, `city`, `dist`) VALUES
(1, 2, '15240694132', '15240694132', 'images/2/2017/08/Fx1KkX66FrCg3NuHxlNUD1K6UrDTzn.jpg', 0, 1, '广西壮族自治区', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_phone_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_phone_region` (
  `id` int(11) unsigned NOT NULL,
  `phoneid` int(11) unsigned NOT NULL COMMENT '便民号码id',
  `regionid` int(11) NOT NULL COMMENT '小区id'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='便民号码附表';

--
-- 转存表中的数据 `ims_xcommunity_phone_region`
--

INSERT INTO `ims_xcommunity_phone_region` (`id`, `phoneid`, `regionid`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_plugin`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_plugin` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL COMMENT '插件名称',
  `module` varchar(50) NOT NULL,
  `do` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='插件';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_print`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_print` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `uid` int(11) NOT NULL,
  `api_key` varchar(50) NOT NULL,
  `deviceNo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_property`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_property` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `uid` int(10) unsigned NOT NULL COMMENT '操作员id',
  `title` varchar(255) NOT NULL COMMENT '物业名称',
  `thumb` varchar(255) NOT NULL COMMENT '图片路径,新增',
  `content` text NOT NULL COMMENT '内容',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
  `telphone` varchar(13) NOT NULL COMMENT '电话',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `dist` varchar(50) NOT NULL COMMENT '区'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_property`
--

INSERT INTO `ims_xcommunity_property` (`id`, `uniacid`, `uid`, `title`, `thumb`, `content`, `createtime`, `telphone`, `province`, `city`, `dist`) VALUES
(1, 2, 1, '福城物业公司', 'images/2/2017/08/feo0D10o04e56Yhv51oE06IHEA15V6.jpg', '<p><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span><span style="color: rgb(37, 36, 36); font-family: 微软雅黑,;" microsoft="">物业介绍</span></p>', 1504525795, '1234567', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_rank`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_rank` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `type` int(1) unsigned NOT NULL,
  `content` varchar(2000) NOT NULL,
  `rankid` int(11) DEFAULT '0',
  `rank` int(11) DEFAULT '0',
  `uid` int(11) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='店铺评价';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_reading_member`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_reading_member` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `aid` int(10) unsigned NOT NULL COMMENT '公告id',
  `regionid` int(10) unsigned NOT NULL,
  `uid` int(11) NOT NULL COMMENT '业主id'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='阅读通知记录表';

--
-- 转存表中的数据 `ims_xcommunity_reading_member`
--

INSERT INTO `ims_xcommunity_reading_member` (`id`, `uniacid`, `aid`, `regionid`, `uid`) VALUES
(1, 2, 1, 1, 1),
(2, 2, 1, 1, 2),
(3, 2, 2, 1, 1),
(4, 2, 2, 1, 3),
(5, 2, 2, 1, 2),
(6, 2, 2, 1, 14),
(7, 2, 2, 1, 4),
(8, 2, 2, 1, 15),
(9, 2, 2, 1, 17),
(10, 2, 2, 1, 12),
(11, 2, 2, 1, 18),
(12, 2, 2, 1, 19),
(13, 2, 2, 1, 21),
(14, 2, 2, 1, 22),
(15, 2, 2, 1, 25),
(16, 2, 3, 1, 3),
(17, 2, 2, 1, 43),
(18, 2, 2, 1, 44),
(19, 2, 3, 1, 44),
(20, 2, 3, 1, 38);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_region` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL COMMENT '公众号id',
  `title` varchar(50) NOT NULL COMMENT '小区名称',
  `linkmen` varchar(50) NOT NULL COMMENT '联系人',
  `linkway` varchar(50) NOT NULL COMMENT '联系电话',
  `lng` varchar(10) NOT NULL COMMENT '坐标',
  `lat` varchar(10) NOT NULL COMMENT '坐标',
  `address` varchar(50) NOT NULL COMMENT '地址',
  `url` varchar(100) NOT NULL COMMENT 'url',
  `thumb` text NOT NULL COMMENT '小区图片路径',
  `pic` text NOT NULL COMMENT '图文图片',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `dist` varchar(50) NOT NULL COMMENT '区',
  `qq` varchar(15) NOT NULL COMMENT 'QQ',
  `rid` int(11) NOT NULL COMMENT '触发规则id',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `commission` float NOT NULL COMMENT '分成',
  `keyword` varchar(100) NOT NULL COMMENT '关键字',
  `pid` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1显示，2隐藏'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='小区信息表';

--
-- 转存表中的数据 `ims_xcommunity_region`
--

INSERT INTO `ims_xcommunity_region` (`id`, `uniacid`, `title`, `linkmen`, `linkway`, `lng`, `lat`, `address`, `url`, `thumb`, `pic`, `province`, `city`, `dist`, `qq`, `rid`, `uid`, `commission`, `keyword`, `pid`, `status`) VALUES
(1, 2, '嘉洲富苑', '龙', '15240694132', '114.052447', '22.531477', '深圳市福田区新洲二街292号', '', 'images/2/2017/09/v79iemYIyEMMUmeImIYIziL7yieE77.jpg', 'images/2/2017/09/Ec4dMjmceD4Jlm3jjLVHgT4COL4cEj.jpg', '广东省', '深圳市', '福田区', '521013225', 10, 1, 0, '嘉洲富苑', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_report`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_report` (
  `id` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `addressid` int(11) unsigned NOT NULL,
  `uniacid` int(11) unsigned NOT NULL COMMENT '公众号id',
  `regionid` int(10) unsigned NOT NULL COMMENT '小区id',
  `type` tinyint(1) NOT NULL COMMENT '类型',
  `cid` int(11) NOT NULL COMMENT '类目',
  `content` varchar(255) NOT NULL COMMENT '信息内容',
  `createtime` int(11) unsigned NOT NULL COMMENT '时间',
  `status` tinyint(1) unsigned NOT NULL COMMENT '处理状态',
  `enable` tinyint(1) unsigned NOT NULL COMMENT '是否审核'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='报修建议表';

--
-- 转存表中的数据 `ims_xcommunity_report`
--

INSERT INTO `ims_xcommunity_report` (`id`, `uid`, `addressid`, `uniacid`, `regionid`, `type`, `cid`, `content`, `createtime`, `status`, `enable`) VALUES
(1, 1, 2, 2, 1, 1, 1, '公共设施保修', 1502264114, 2, 0),
(2, 1, 2, 2, 1, 2, 5, '摸摸哦哦弄咯懂', 1502269765, 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_report_images`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_report_images` (
  `id` int(11) unsigned NOT NULL,
  `reportid` int(11) NOT NULL COMMENT '报修建议id',
  `thumbid` int(11) NOT NULL COMMENT '图片id'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_report_images`
--

INSERT INTO `ims_xcommunity_report_images` (`id`, `reportid`, `thumbid`) VALUES
(1, 2, 4);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_report_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_report_log` (
  `id` int(11) unsigned NOT NULL,
  `reportid` int(11) NOT NULL COMMENT '报修建议id',
  `content` text NOT NULL COMMENT '回复信息',
  `uid` int(11) NOT NULL COMMENT '处理人uid',
  `createtime` int(11) unsigned NOT NULL COMMENT '时间',
  `dealing` varchar(20) NOT NULL COMMENT '后台处理人',
  `mobile` varchar(20) NOT NULL,
  `images` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='报修建议处理表';

--
-- 转存表中的数据 `ims_xcommunity_report_log`
--

INSERT INTO `ims_xcommunity_report_log` (`id`, `reportid`, `content`, `uid`, `createtime`, `dealing`, `mobile`, `images`) VALUES
(1, 2, '收费阿斯蒂芬', 1, 1502269815, '阿道夫', '15240694132', 'images/2/2017/08/suKs96Kc6Kk0496iSuIHxEQIfKK6xe.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_res`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_res` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL COMMENT '业主id',
  `truename` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `num` int(2) unsigned NOT NULL,
  `aid` int(11) unsigned NOT NULL,
  `createtime` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='报名表';

--
-- 转存表中的数据 `ims_xcommunity_res`
--

INSERT INTO `ims_xcommunity_res` (`id`, `uniacid`, `uid`, `truename`, `mobile`, `num`, `aid`, `createtime`, `status`) VALUES
(1, 2, 1, '', '', 1, 1, 1502275336, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_search`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_search` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `sname` varchar(30) NOT NULL,
  `surl` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `icon` varchar(1000) NOT NULL,
  `uid` int(10) NOT NULL COMMENT '操作员id',
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_search_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_search_region` (
  `id` int(10) unsigned NOT NULL,
  `sid` int(10) unsigned NOT NULL COMMENT '便民查询id',
  `regionid` int(11) NOT NULL COMMENT '小区id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='便民查询副表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_send_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_send_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `sendid` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1公告,2房号',
  `cid` int(1) NOT NULL COMMENT '1微信2短信'
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='发送记录';

--
-- 转存表中的数据 `ims_xcommunity_send_log`
--

INSERT INTO `ims_xcommunity_send_log` (`id`, `uniacid`, `sendid`, `status`, `uid`, `type`, `cid`) VALUES
(1, 2, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 2, 1, 1),
(3, 2, 1, 1, 3, 1, 1),
(4, 2, 3, 2, 14, 1, 1),
(5, 2, 3, 2, 3, 1, 1),
(6, 2, 3, 2, 18, 1, 1),
(7, 2, 3, 2, 20, 1, 1),
(8, 2, 3, 2, 19, 1, 1),
(9, 2, 3, 2, 23, 1, 1),
(10, 2, 3, 2, 12, 1, 1),
(11, 2, 3, 2, 25, 1, 1),
(12, 2, 3, 2, 2, 1, 1),
(13, 2, 3, 2, 1, 1, 1),
(14, 2, 3, 2, 17, 1, 1),
(15, 2, 3, 2, 16, 1, 1),
(16, 2, 3, 2, 15, 1, 1),
(17, 2, 3, 2, 4, 1, 1),
(18, 2, 3, 2, 22, 1, 1),
(19, 2, 3, 2, 21, 1, 1),
(20, 2, 3, 2, 26, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_service_data`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_service_data` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL,
  `sub_mch_id` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '存小区id或者操作员id'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商户配置';

--
-- 转存表中的数据 `ims_xcommunity_service_data`
--

INSERT INTO `ims_xcommunity_service_data` (`id`, `uniacid`, `type`, `sub_mch_id`, `uid`, `userid`) VALUES
(2, 2, 2, '456131', 1, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_setting`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_setting` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `regionid` int(11) NOT NULL,
  `value` text NOT NULL,
  `xqkey` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='小区设置,独立支付接口基础设置,模板消息配置,独立小区配置,注册字段';

--
-- 转存表中的数据 `ims_xcommunity_setting`
--

INSERT INTO `ims_xcommunity_setting` (`id`, `uniacid`, `regionid`, `value`, `xqkey`) VALUES
(1, 1, 0, '1', 'p55'),
(2, 1, 0, '1', 'p38'),
(3, 1, 0, '栋', 'p39'),
(4, 1, 0, '1', 'p40'),
(5, 1, 0, '单元', 'p41'),
(6, 1, 0, '1', 'p42'),
(7, 1, 0, '室', 'p43'),
(8, 1, 0, '1', 'p52'),
(9, 2, 0, '1', 'p55'),
(10, 2, 0, '1', 'p38'),
(11, 2, 0, '栋', 'p39'),
(12, 2, 0, '1', 'p40'),
(13, 2, 0, '单元', 'p41'),
(14, 2, 0, '1', 'p42'),
(15, 2, 0, '室', 'p43'),
(16, 2, 0, '1', 't1'),
(17, 2, 0, '1', 't3'),
(18, 2, 0, '1', 't7'),
(19, 2, 0, '1', 't5'),
(20, 2, 0, '1', 't9'),
(21, 2, 0, '1', 't11'),
(22, 2, 0, '1', 't13'),
(23, 2, 0, '1', 't15'),
(24, 2, 0, '1', 't17'),
(25, 2, 0, '1', 't19'),
(26, 2, 0, '', 't2'),
(27, 2, 0, '', 't4'),
(28, 2, 0, '', 't8'),
(29, 2, 0, '', 't6'),
(30, 2, 0, '', 't10'),
(31, 2, 0, '', 't12'),
(32, 2, 0, '', 't14'),
(33, 2, 0, '', 't16'),
(34, 2, 0, '', 't18'),
(35, 2, 0, '', 't20'),
(36, 2, 1, '1', 'x17'),
(37, 2, 0, '0', 'p66'),
(38, 2, 0, '', 'p67'),
(39, 2, 0, '福城智慧社区', 'p74'),
(40, 2, 0, '牵手网络科技 2012-2017 版权所有', 'p68'),
(41, 2, 0, '', 'p69'),
(42, 2, 0, '', 'p47'),
(43, 2, 0, '', 'p48'),
(44, 2, 0, '', 'p50'),
(45, 2, 0, '', 'p51'),
(46, 2, 0, '', 'p49'),
(47, 2, 0, '1', 'p36'),
(48, 2, 0, '1', 'f2'),
(49, 2, 0, '1', 'f3'),
(50, 2, 0, '1', 'f4'),
(51, 2, 1, '0', 'x15'),
(52, 2, 1, '', 'x12'),
(53, 2, 0, '1', 'b4'),
(54, 2, 0, '1', 'b8'),
(55, 2, 0, '1', 'b12'),
(56, 2, 0, '1', 'b16'),
(57, 2, 0, '1', 'b20'),
(58, 2, 1, '1', 'x18'),
(59, 2, 1, '1', 'x19'),
(60, 2, 1, '1', 'x20'),
(61, 2, 1, '1', 'x52'),
(62, 2, 1, '', 'x46'),
(63, 2, 1, '', 'x47'),
(64, 2, 1, '', 'x48'),
(65, 2, 1, '', 'x49'),
(66, 2, 0, '0', 'p80'),
(67, 2, 0, '0', 'p46');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_slide`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_slide` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `displayorder` int(10) NOT NULL COMMENT '排序',
  `title` varchar(30) NOT NULL COMMENT '幻灯名称',
  `thumb` varchar(200) NOT NULL COMMENT '幻灯图片',
  `url` varchar(100) NOT NULL COMMENT '幻灯链接',
  `type` int(11) NOT NULL COMMENT '广告类型',
  `status` int(11) NOT NULL COMMENT '广告是否显示',
  `province` varchar(50) NOT NULL COMMENT '省',
  `city` varchar(50) NOT NULL COMMENT '市',
  `dist` varchar(50) NOT NULL COMMENT '区',
  `uid` int(11) NOT NULL COMMENT '操作员id',
  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间,新增'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_slide`
--

INSERT INTO `ims_xcommunity_slide` (`id`, `uniacid`, `displayorder`, `title`, `thumb`, `url`, `type`, `status`, `province`, `city`, `dist`, `uid`, `createtime`) VALUES
(6, 2, 0, '', 'images/2/2017/08/KnNmMun9k35nL7boc1BQlCmn3K57l8.png', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=fled&', 6, 1, '广西壮族自治区', '', '', 1, 1502414215),
(7, 2, 0, '', 'images/2/2017/08/RzJfJJM3zIW2mKFw2XZIK3c2fjf2JP.png', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=cost&', 6, 1, '广西壮族自治区', '', '', 1, 1502414240),
(8, 2, 0, '', 'images/2/2017/08/dtt20egz10vWl02XZ59DMOaoa011rd.jpg', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=shopping&', 6, 1, '广西壮族自治区', '', '', 1, 1502414266),
(9, 2, 0, '', 'images/2/2017/08/R6198MpM1e6dEFU98zD3U8Dzc16YAd.png', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=business&', 6, 1, '广西壮族自治区', '', '', 1, 1502414349),
(10, 2, 0, '', 'images/2/2017/08/kV155PW3GCC23E4mv5hteHM2H2CzEh.png', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=homemaking&', 6, 1, '广西壮族自治区', '桂林市', '', 1, 1502414374),
(11, 2, 0, '', 'images/2/2017/08/c8KbIi8bNnIK0lNQmZnB6nABMZssIL.png', 'http://wuye.iot-gj.cn/app/index.php?i=2&c=entry&m=feng_community&do=houselease&', 6, 1, '广西壮族自治区', '', '', 1, 1502414399),
(12, 2, 1, '1', 'images/2/2017/08/C5R8t1rXdP8DTrW8xvXdcb5rWbxtCp.png', '', 5, 1, '广西壮族自治区', '', '', 1, 1502414737),
(13, 2, 1, '1', 'images/2/2017/08/O0IlhM6Himh68l95yc9ZMZD60bPCI9.jpg', '', 1, 1, '广西壮族自治区', '', '', 1, 1502414775),
(14, 2, 2, '2', 'images/2/2017/08/gwFi6dZNIDWws762i2l6diA144Ll3D.png', '', 1, 1, '广西壮族自治区', '', '', 1, 1502414789);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_slide_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_slide_region` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL COMMENT '幻灯id',
  `regionid` int(11) NOT NULL COMMENT '小区id'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_slide_region`
--

INSERT INTO `ims_xcommunity_slide_region` (`id`, `sid`, `regionid`) VALUES
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_staff`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_staff` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `wechat` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `type` int(1) NOT NULL,
  `uid` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_staff`
--

INSERT INTO `ims_xcommunity_staff` (`id`, `uniacid`, `realname`, `mobile`, `nickname`, `wechat`, `openid`, `mail`, `departmentid`, `position`, `remark`, `type`, `uid`) VALUES
(1, 2, '洋哥', '15240694132', 'long', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', 'oNjw9wqWBsgRd7zoXDyh6GdK6Qjc', '', 1, '', '', 1, 0),
(2, 2, 'wuye', '15880089917', 'wuye', '', '', '', 1, '', '', 1, 1),
(3, 2, '刘波', '13540491005', '', 'scwave', '', '', 1, '维修接单员', '', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `park_id` varchar(32) NOT NULL,
  `park_name` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `total_spaces` int(32) NOT NULL,
  `remain_spaces` int(32) NOT NULL,
  `createtime` int(11) NOT NULL,
  `parkid` int(11) NOT NULL,
  `last_time` varchar(20) DEFAULT NULL,
  `company_id` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park_cars`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park_cars` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `id_card` varchar(50) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `issued_by` varchar(50) NOT NULL,
  `issued_date` int(11) NOT NULL,
  `renew_date` int(11) DEFAULT NULL,
  `start_date` int(11) DEFAULT NULL,
  `valid_date` int(11) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `deposit` int(11) DEFAULT NULL,
  `month_fee` decimal(9,2) DEFAULT NULL,
  `car_no` varchar(50) DEFAULT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  `car_pos` varchar(50) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `card_status` varchar(10) DEFAULT NULL,
  `park_id` int(11) NOT NULL,
  `openid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park_car_record`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park_car_record` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `createtime` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `car_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park_order`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park_order` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `uid` int(11) NOT NULL,
  `parkid` int(11) NOT NULL,
  `carid` int(11) NOT NULL,
  `park_id` varchar(32) NOT NULL,
  `park_serial` varchar(50) NOT NULL,
  `car_no` varchar(50) NOT NULL,
  `begin_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `pay_fee` decimal(9,2) NOT NULL,
  `toll_date` int(10) NOT NULL,
  `toll_by` varchar(50) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `code` int(1) NOT NULL,
  `enable` int(1) DEFAULT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park_set`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park_set` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `status` int(11) NOT NULL,
  `expire_num` int(11) NOT NULL,
  `arrears_num` int(11) DEFAULT NULL,
  `remind_num` int(11) DEFAULT NULL,
  `tjtime` int(11) DEFAULT NULL,
  `car_tpl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_stop_park_setting`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_stop_park_setting` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL COMMENT '公众号id',
  `title` varchar(100) NOT NULL COMMENT '链接',
  `company_id` varchar(32) NOT NULL,
  `sign_key` varchar(32) NOT NULL,
  `access_secret` varchar(32) NOT NULL,
  `createtime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_template`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_template` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `styleid` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_users`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_users` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `uuid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `companyid` int(11) NOT NULL,
  `menus` text NOT NULL,
  `xqmenus` text NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `commission` float NOT NULL,
  `xqcommission` float NOT NULL,
  `groupid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `dist` varchar(100) NOT NULL,
  `perms` text NOT NULL,
  `staffid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `xqtype` int(1) NOT NULL,
  `account` decimal(10,2) DEFAULT NULL,
  `plugin` text
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_users`
--

INSERT INTO `ims_xcommunity_users` (`id`, `uniacid`, `uid`, `uuid`, `createtime`, `companyid`, `menus`, `xqmenus`, `balance`, `commission`, `xqcommission`, `groupid`, `type`, `province`, `city`, `dist`, `perms`, `staffid`, `pid`, `departmentid`, `xqtype`, `account`, `plugin`) VALUES
(3, 2, 3, 1, 1504925606, 0, '', '1,2,3,4,5,6,7,8,9,10,11,12,13,14', '0.00', 0, 0, 0, 1, '', '', '', '', 2, 1, 1, 1, NULL, NULL),
(4, 2, 4, 1, 1504945881, 0, '1,12,13,15,2,24,3,39,40,7,60,61,62,63', '1,2,3,14', '0.00', 0, 0, 0, 2, '', '', '', '', 3, 1, 1, 1, NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_users_group`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_users_group` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `maxaccount` int(11) NOT NULL,
  `num` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_users_log`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_users_log` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `op` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `ims_xcommunity_users_log`
--

INSERT INTO `ims_xcommunity_users_log` (`id`, `uniacid`, `uid`, `name`, `type`, `op`, `createtime`, `ip`) VALUES
(1, 2, 1, '智能门禁-修改', '', '区域名称:1栋', 1503711405, '116.1.75.41'),
(2, 2, 1, '智能门禁-修改', '', '区域名称:1栋', 1503711433, '116.1.75.41'),
(3, 2, 1, '物业管理-修改', '', '物业名称:福城物业公司', 1504525795, '113.118.234.190'),
(4, 2, 1, '小区管理-修改', '', '修改小区ID:1修改名称:嘉洲富苑', 1504526578, '113.118.234.190'),
(5, 2, 1, '房号管理-添加', '', '添房号信息UID:11', 1504526816, '113.118.234.190'),
(6, 2, 1, '', '', '业主UID:11绑定门禁', 1504526896, '113.118.234.190'),
(7, 2, 1, '首页-公告-修改', '', '信息标题:2017年第17号台风古超或将明天生成台风', 1504527460, '113.118.234.190'),
(8, 2, 1, '小区管理-修改', '', '修改小区ID:1修改名称:嘉洲富苑', 1504595599, '113.118.234.175'),
(9, 2, 1, '房号管理-添加', '', '添房号信息UID:11', 1504680594, '113.118.234.175'),
(10, 2, 1, '用户管理-删除', '', '删除用户姓名:周刚', 1504680617, '113.118.234.175'),
(11, 2, 1, '房号管理-添加', '', '添房号信息UID:13', 1504680938, '113.118.234.175'),
(12, 2, 1, '用户管理-删除', '', '删除用户姓名:', 1504681033, '113.118.234.175'),
(13, 2, 1, '用户管理-删除', '', '删除用户姓名:天涯客', 1504681066, '113.118.234.175'),
(14, 2, 1, '房号管理-添加', '', '添房号信息UID:4', 1504681140, '113.118.234.175'),
(15, 2, 1, '', '', '业主UID:12绑定门禁', 1504681231, '113.118.234.175'),
(16, 2, 1, '', '', '批量审核业主开门', 1504681254, '113.118.234.175'),
(17, 2, 1, '', '', '批量审核业主开门', 1504681266, '113.118.234.175'),
(18, 2, 1, '用户管理-删除', '', '删除用户姓名:庞金龙', 1504688464, '116.1.4.48'),
(19, 2, 1, '用户管理-删除', '', '删除用户姓名:庞金龙', 1504689460, '116.1.4.48'),
(20, 2, 1, '', '', '业主UID:14绑定门禁', 1504703113, '113.118.234.175'),
(21, 2, 1, '用户管理-删除', '', '删除用户姓名:天涯客', 1504703475, '113.118.234.175'),
(22, 2, 1, '', '', '导入房号信息', 1504704086, '113.118.234.175'),
(23, 2, 1, '用户管理-删除', '', '删除用户姓名:庞金龙', 1504753659, '116.1.4.48'),
(24, 2, 1, '', '', '业主UID:15绑定门禁', 1504777410, '113.118.234.25'),
(25, 2, 1, '', '', '业主UID:14绑定门禁', 1504777427, '113.118.234.25'),
(26, 2, 1, '', '', '业主UID:12绑定门禁', 1504777438, '113.118.234.25'),
(27, 2, 1, '', '', '业主UID:17绑定门禁', 1504777451, '113.118.234.25'),
(28, 2, 1, '', '', '业主UID:16绑定门禁', 1504777462, '113.118.234.25'),
(29, 2, 1, '', '', '业主UID:16绑定门禁', 1504777502, '113.118.234.25'),
(30, 2, 1, '', '', '业主UID:18绑定门禁', 1504783539, '113.118.234.25'),
(31, 2, 1, '', '', '业主UID:4绑定门禁', 1504786142, '113.118.234.25'),
(32, 2, 1, '', '', '业主UID:23绑定门禁', 1504841901, '113.118.234.25'),
(33, 2, 1, '', '', '业主UID:22绑定门禁', 1504841913, '113.118.234.25'),
(34, 2, 1, '', '', '业主UID:21绑定门禁', 1504841922, '113.118.234.25'),
(35, 2, 1, '', '', '业主UID:20绑定门禁', 1504841931, '113.118.234.25'),
(36, 2, 1, '', '', '业主UID:18绑定门禁', 1504841953, '113.118.234.25'),
(37, 2, 1, '', '', '业主UID:19绑定门禁', 1504841960, '113.118.234.25'),
(38, 2, 1, '', '', '业主UID:26绑定门禁', 1504861719, '113.118.234.25'),
(39, 2, 1, '', '', '业主UID:25绑定门禁', 1504861729, '113.118.234.25'),
(40, 2, 1, '', '', '修改手机端风格', 1504924383, '116.1.4.48'),
(41, 2, 1, '', '', '修改手机端风格', 1504924383, '116.1.4.48'),
(42, 2, 1, '', '', '修改手机端风格', 1504924491, '116.1.4.48'),
(43, 2, 1, '', '', '修改手机端风格', 1504924491, '116.1.4.48'),
(44, 2, 1, '员工管理-通讯录-添加', '', '添加员工姓名:wuye', 1504925572, '116.1.4.48'),
(45, 2, 1, '员工管理-权限管理-添加', '', '添加用户名:15880089917', 1504925606, '116.1.4.48'),
(46, 2, 1, '员工管理-权限管理-设置手机端权限', '', '用户ID:3', 1504925655, '116.1.4.48'),
(47, 2, 1, '', '', '修改手机端风格', 1504935735, '116.1.4.48'),
(48, 2, 1, '', '', '修改手机端风格', 1504935735, '116.1.4.48'),
(49, 2, 1, '', '', '修改手机端风格', 1504935737, '116.1.4.48'),
(50, 2, 1, '', '', '修改手机端风格', 1504935737, '116.1.4.48'),
(51, 2, 1, '员工管理-部门管理-添加', '', '添加部门名称:财务部', 1504945704, '14.20.91.248'),
(52, 2, 1, '员工管理-通讯录-添加', '', '添加员工姓名:刘波', 1504945768, '14.20.91.248'),
(53, 2, 1, '员工管理-权限管理-添加', '', '添加用户名:13540491005', 1504945881, '14.20.91.248'),
(54, 2, 1, '员工管理-权限管理-设置手机端权限', '', '用户ID:4', 1504945922, '14.20.91.248'),
(55, 2, 2, '', '', '修改手机端风格', 1506333289, '116.1.73.145'),
(56, 2, 2, '', '', '修改手机端风格', 1506333290, '116.1.73.145'),
(57, 2, 2, '', '', '修改手机端风格', 1507295767, '116.1.4.234'),
(58, 2, 2, '', '', '修改手机端风格', 1507295767, '116.1.4.234'),
(59, 2, 1, '用户管理-删除', '', '删除用户姓名:祖脉罗', 1507773072, '116.1.75.56'),
(60, 2, 1, '用户管理-删除', '', '删除用户姓名:庞金龙', 1507773077, '116.1.75.56'),
(61, 2, 1, '', '', '修改手机端风格', 1507777169, '116.1.75.56'),
(62, 2, 1, '', '', '修改手机端风格', 1507777169, '116.1.75.56'),
(63, 2, 1, '', '', '修改手机端风格', 1507777173, '116.1.75.56'),
(64, 2, 1, '', '', '修改手机端风格', 1507777173, '116.1.75.56'),
(65, 2, 1, '商家券号-核销', '', '核销券号ID:2', 1507874822, '116.1.4.60'),
(66, 2, 1, '', '', '添加子商户ID:2', 1507879992, '116.1.4.60'),
(67, 2, 1, '', '', '底部菜单设置', 1507883201, '116.1.4.60'),
(68, 2, 1, '', '', '底部菜单设置', 1507883201, '116.1.4.60'),
(69, 2, 1, '', '', '修改手机端风格', 1508833143, '116.1.75.180'),
(70, 2, 1, '', '', '底部菜单设置', 1508833149, '116.1.75.180');

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_users_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_users_region` (
  `id` int(10) unsigned NOT NULL,
  `regionid` int(10) unsigned NOT NULL,
  `usersid` int(10) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_wechat`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_wechat` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) NOT NULL,
  `type` int(1) NOT NULL COMMENT '新增类型',
  `userid` int(11) NOT NULL COMMENT '存小区id或者操作员id',
  `appid` varchar(50) NOT NULL,
  `appsecret` varchar(50) NOT NULL,
  `mchid` varchar(50) NOT NULL,
  `apikey` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='微信配置';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_wechat_notice`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_wechat_notice` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `repair` int(1) NOT NULL,
  `report` int(1) NOT NULL,
  `shopping` int(1) NOT NULL,
  `business` int(1) NOT NULL,
  `homemaking` int(1) NOT NULL,
  `cost` int(1) NOT NULL,
  `notice` int(1) NOT NULL,
  `type` int(1) NOT NULL,
  `uid` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `dist` varchar(50) NOT NULL,
  `staffid` int(111) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='通知管理表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_wechat_notice_region`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_wechat_notice_region` (
  `id` int(10) unsigned NOT NULL,
  `nid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='通知副表';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_xqcars`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_xqcars` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(10) unsigned NOT NULL,
  `regionid` int(11) NOT NULL,
  `parkingid` int(11) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `card_num` varchar(30) NOT NULL,
  `car_num` varchar(30) NOT NULL,
  `createtime` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='车辆管理';

-- --------------------------------------------------------

--
-- 表的结构 `ims_xcommunity_xqnotice`
--

CREATE TABLE IF NOT EXISTS `ims_xcommunity_xqnotice` (
  `id` int(10) unsigned NOT NULL,
  `uniacid` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '当前操作员uid',
  `userid` int(11) NOT NULL COMMENT '绑定用户uid',
  `enable` int(11) NOT NULL COMMENT '1短信 2微信',
  `type` int(1) NOT NULL COMMENT '1超市/商家 2物业 3全部',
  `username` varchar(50) NOT NULL COMMENT '手机号码/openid',
  `api` varchar(50) NOT NULL COMMENT '打印机api',
  `device` varchar(50) NOT NULL COMMENT '打印机终端编号',
  `createtime` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='通知';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ims_account`
--
ALTER TABLE `ims_account`
  ADD PRIMARY KEY (`acid`),
  ADD KEY `idx_uniacid` (`uniacid`);

--
-- Indexes for table `ims_account_wechats`
--
ALTER TABLE `ims_account_wechats`
  ADD PRIMARY KEY (`acid`),
  ADD KEY `idx_key` (`key`);

--
-- Indexes for table `ims_account_wxapp`
--
ALTER TABLE `ims_account_wxapp`
  ADD PRIMARY KEY (`acid`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_article_category`
--
ALTER TABLE `ims_article_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ims_article_news`
--
ALTER TABLE `ims_article_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `cateid` (`cateid`);

--
-- Indexes for table `ims_article_notice`
--
ALTER TABLE `ims_article_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `cateid` (`cateid`);

--
-- Indexes for table `ims_article_unread_notice`
--
ALTER TABLE `ims_article_unread_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `notice_id` (`notice_id`);

--
-- Indexes for table `ims_basic_reply`
--
ALTER TABLE `ims_basic_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_business`
--
ALTER TABLE `ims_business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lat_lng` (`lng`,`lat`);

--
-- Indexes for table `ims_core_attachment`
--
ALTER TABLE `ims_core_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_core_cache`
--
ALTER TABLE `ims_core_cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ims_core_cron`
--
ALTER TABLE `ims_core_cron`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createtime` (`createtime`),
  ADD KEY `nextruntime` (`nextruntime`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `cloudid` (`cloudid`);

--
-- Indexes for table `ims_core_cron_record`
--
ALTER TABLE `ims_core_cron_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `tid` (`tid`),
  ADD KEY `module` (`module`);

--
-- Indexes for table `ims_core_menu`
--
ALTER TABLE `ims_core_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_core_paylog`
--
ALTER TABLE `ims_core_paylog`
  ADD PRIMARY KEY (`plid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_tid` (`tid`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `uniontid` (`uniontid`);

--
-- Indexes for table `ims_core_performance`
--
ALTER TABLE `ims_core_performance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_core_queue`
--
ALTER TABLE `ims_core_queue`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `uniacid` (`uniacid`,`acid`),
  ADD KEY `module` (`module`),
  ADD KEY `dateline` (`dateline`);

--
-- Indexes for table `ims_core_refundlog`
--
ALTER TABLE `ims_core_refundlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `refund_uniontid` (`refund_uniontid`),
  ADD KEY `uniontid` (`uniontid`);

--
-- Indexes for table `ims_core_resource`
--
ALTER TABLE `ims_core_resource`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `acid` (`uniacid`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `ims_core_sendsms_log`
--
ALTER TABLE `ims_core_sendsms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_core_sessions`
--
ALTER TABLE `ims_core_sessions`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `ims_core_settings`
--
ALTER TABLE `ims_core_settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `ims_coupon_location`
--
ALTER TABLE `ims_coupon_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`,`acid`);

--
-- Indexes for table `ims_cover_reply`
--
ALTER TABLE `ims_cover_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_custom_reply`
--
ALTER TABLE `ims_custom_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_images_reply`
--
ALTER TABLE `ims_images_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_mc_cash_record`
--
ALTER TABLE `ims_mc_cash_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `ims_mc_chats_record`
--
ALTER TABLE `ims_mc_chats_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`,`acid`),
  ADD KEY `openid` (`openid`),
  ADD KEY `createtime` (`createtime`);

--
-- Indexes for table `ims_mc_credits_recharge`
--
ALTER TABLE `ims_mc_credits_recharge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid_uid` (`uniacid`,`uid`),
  ADD KEY `idx_tid` (`tid`);

--
-- Indexes for table `ims_mc_credits_record`
--
ALTER TABLE `ims_mc_credits_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `ims_mc_fans_groups`
--
ALTER TABLE `ims_mc_fans_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_mc_fans_tag_mapping`
--
ALTER TABLE `ims_mc_fans_tag_mapping`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mapping` (`fanid`,`tagid`),
  ADD KEY `fanid_index` (`fanid`),
  ADD KEY `tagid_index` (`tagid`);

--
-- Indexes for table `ims_mc_groups`
--
ALTER TABLE `ims_mc_groups`
  ADD PRIMARY KEY (`groupid`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_mc_handsel`
--
ALTER TABLE `ims_mc_handsel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`touid`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_mc_mapping_fans`
--
ALTER TABLE `ims_mc_mapping_fans`
  ADD PRIMARY KEY (`fanid`),
  ADD UNIQUE KEY `openid_2` (`openid`),
  ADD KEY `acid` (`acid`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `nickname` (`nickname`),
  ADD KEY `updatetime` (`updatetime`),
  ADD KEY `uid` (`uid`),
  ADD KEY `openid` (`openid`);

--
-- Indexes for table `ims_mc_mapping_ucenter`
--
ALTER TABLE `ims_mc_mapping_ucenter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_mc_mass_record`
--
ALTER TABLE `ims_mc_mass_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`,`acid`);

--
-- Indexes for table `ims_mc_members`
--
ALTER TABLE `ims_mc_members`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `groupid` (`groupid`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `email` (`email`),
  ADD KEY `mobile` (`mobile`);

--
-- Indexes for table `ims_mc_member_address`
--
ALTER TABLE `ims_mc_member_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uinacid` (`uniacid`),
  ADD KEY `idx_uid` (`uid`);

--
-- Indexes for table `ims_mc_member_fields`
--
ALTER TABLE `ims_mc_member_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_fieldid` (`fieldid`);

--
-- Indexes for table `ims_mc_member_property`
--
ALTER TABLE `ims_mc_member_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_mc_oauth_fans`
--
ALTER TABLE `ims_mc_oauth_fans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_oauthopenid_acid` (`oauth_openid`,`acid`);

--
-- Indexes for table `ims_menu_event`
--
ALTER TABLE `ims_menu_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `picmd5` (`picmd5`);

--
-- Indexes for table `ims_mobilenumber`
--
ALTER TABLE `ims_mobilenumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_modules`
--
ALTER TABLE `ims_modules`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `idx_name` (`name`);

--
-- Indexes for table `ims_modules_bindings`
--
ALTER TABLE `ims_modules_bindings`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `idx_module` (`module`);

--
-- Indexes for table `ims_modules_plugin`
--
ALTER TABLE `ims_modules_plugin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `main_module` (`main_module`);

--
-- Indexes for table `ims_modules_recycle`
--
ALTER TABLE `ims_modules_recycle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modulename` (`modulename`);

--
-- Indexes for table `ims_music_reply`
--
ALTER TABLE `ims_music_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_news_reply`
--
ALTER TABLE `ims_news_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_profile_fields`
--
ALTER TABLE `ims_profile_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_qrcode`
--
ALTER TABLE `ims_qrcode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_qrcid` (`qrcid`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `ticket` (`ticket`);

--
-- Indexes for table `ims_qrcode_stat`
--
ALTER TABLE `ims_qrcode_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_rule`
--
ALTER TABLE `ims_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_rule_keyword`
--
ALTER TABLE `ims_rule_keyword`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_content` (`content`),
  ADD KEY `rid` (`rid`),
  ADD KEY `idx_rid` (`rid`),
  ADD KEY `idx_uniacid_type_content` (`uniacid`,`type`,`content`);

--
-- Indexes for table `ims_site_article`
--
ALTER TABLE `ims_site_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_iscommend` (`iscommend`),
  ADD KEY `idx_ishot` (`ishot`);

--
-- Indexes for table `ims_site_category`
--
ALTER TABLE `ims_site_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_site_multi`
--
ALTER TABLE `ims_site_multi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `bindhost` (`bindhost`);

--
-- Indexes for table `ims_site_nav`
--
ALTER TABLE `ims_site_nav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `multiid` (`multiid`);

--
-- Indexes for table `ims_site_page`
--
ALTER TABLE `ims_site_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `multiid` (`multiid`);

--
-- Indexes for table `ims_site_slide`
--
ALTER TABLE `ims_site_slide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `multiid` (`multiid`);

--
-- Indexes for table `ims_site_store_goods`
--
ALTER TABLE `ims_site_store_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module` (`module`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `price` (`price`);

--
-- Indexes for table `ims_site_store_order`
--
ALTER TABLE `ims_site_store_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goodid` (`goodsid`),
  ADD KEY `buyerid` (`buyerid`);

--
-- Indexes for table `ims_site_styles`
--
ALTER TABLE `ims_site_styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_site_styles_vars`
--
ALTER TABLE `ims_site_styles_vars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_site_templates`
--
ALTER TABLE `ims_site_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_stat_fans`
--
ALTER TABLE `ims_stat_fans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`,`date`);

--
-- Indexes for table `ims_stat_keyword`
--
ALTER TABLE `ims_stat_keyword`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`);

--
-- Indexes for table `ims_stat_msg_history`
--
ALTER TABLE `ims_stat_msg_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`);

--
-- Indexes for table `ims_stat_rule`
--
ALTER TABLE `ims_stat_rule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_stat_visit`
--
ALTER TABLE `ims_stat_visit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `module` (`module`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_uni_account`
--
ALTER TABLE `ims_uni_account`
  ADD PRIMARY KEY (`uniacid`);

--
-- Indexes for table `ims_uni_account_group`
--
ALTER TABLE `ims_uni_account_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_uni_account_menus`
--
ALTER TABLE `ims_uni_account_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `menuid` (`menuid`);

--
-- Indexes for table `ims_uni_account_modules`
--
ALTER TABLE `ims_uni_account_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_module` (`module`),
  ADD KEY `idx_uniacid` (`uniacid`);

--
-- Indexes for table `ims_uni_account_users`
--
ALTER TABLE `ims_uni_account_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_memberid` (`uid`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_uni_group`
--
ALTER TABLE `ims_uni_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_uni_settings`
--
ALTER TABLE `ims_uni_settings`
  ADD PRIMARY KEY (`uniacid`);

--
-- Indexes for table `ims_uni_verifycode`
--
ALTER TABLE `ims_uni_verifycode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_userapi_cache`
--
ALTER TABLE `ims_userapi_cache`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_userapi_reply`
--
ALTER TABLE `ims_userapi_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_users`
--
ALTER TABLE `ims_users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ims_users_failed_login`
--
ALTER TABLE `ims_users_failed_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_username` (`ip`,`username`);

--
-- Indexes for table `ims_users_founder_group`
--
ALTER TABLE `ims_users_founder_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_users_group`
--
ALTER TABLE `ims_users_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_users_invitation`
--
ALTER TABLE `ims_users_invitation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_code` (`code`);

--
-- Indexes for table `ims_users_permission`
--
ALTER TABLE `ims_users_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_users_profile`
--
ALTER TABLE `ims_users_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_video_reply`
--
ALTER TABLE `ims_video_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_voice_reply`
--
ALTER TABLE `ims_voice_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_wechat_attachment`
--
ALTER TABLE `ims_wechat_attachment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `media_id` (`media_id`),
  ADD KEY `acid` (`acid`);

--
-- Indexes for table `ims_wechat_news`
--
ALTER TABLE `ims_wechat_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `attach_id` (`attach_id`);

--
-- Indexes for table `ims_wxapp_general_analysis`
--
ALTER TABLE `ims_wxapp_general_analysis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `ref_date` (`ref_date`);

--
-- Indexes for table `ims_wxapp_versions`
--
ALTER TABLE `ims_wxapp_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `version` (`version`),
  ADD KEY `uniacid` (`uniacid`);

--
-- Indexes for table `ims_wxcard_reply`
--
ALTER TABLE `ims_wxcard_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rid` (`rid`);

--
-- Indexes for table `ims_xcommunity_activity`
--
ALTER TABLE `ims_xcommunity_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_activity_region`
--
ALTER TABLE `ims_xcommunity_activity_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_alipayment`
--
ALTER TABLE `ims_xcommunity_alipayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_announcement`
--
ALTER TABLE `ims_xcommunity_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_announcement_region`
--
ALTER TABLE `ims_xcommunity_announcement_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_bind_door`
--
ALTER TABLE `ims_xcommunity_bind_door`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_bind_door_device`
--
ALTER TABLE `ims_xcommunity_bind_door_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_building`
--
ALTER TABLE `ims_xcommunity_building`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_building_device`
--
ALTER TABLE `ims_xcommunity_building_device`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_carpool`
--
ALTER TABLE `ims_xcommunity_carpool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_cart`
--
ALTER TABLE `ims_xcommunity_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_car_images`
--
ALTER TABLE `ims_xcommunity_car_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_category`
--
ALTER TABLE `ims_xcommunity_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_company`
--
ALTER TABLE `ims_xcommunity_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_cost`
--
ALTER TABLE `ims_xcommunity_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_cost_list`
--
ALTER TABLE `ims_xcommunity_cost_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homenumber` (`homenumber`),
  ADD KEY `homenumber_2` (`homenumber`),
  ADD KEY `homenumber_3` (`homenumber`),
  ADD KEY `homenumber_4` (`homenumber`),
  ADD KEY `homenumber_5` (`homenumber`);

--
-- Indexes for table `ims_xcommunity_coupon_order`
--
ALTER TABLE `ims_xcommunity_coupon_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`),
  ADD KEY `orderid_3` (`orderid`),
  ADD KEY `orderid_4` (`orderid`),
  ADD KEY `orderid_5` (`orderid`);

--
-- Indexes for table `ims_xcommunity_department`
--
ALTER TABLE `ims_xcommunity_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `pid_2` (`pid`),
  ADD KEY `pid_3` (`pid`),
  ADD KEY `pid_4` (`pid`),
  ADD KEY `pid_5` (`pid`);

--
-- Indexes for table `ims_xcommunity_dp`
--
ALTER TABLE `ims_xcommunity_dp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_fled`
--
ALTER TABLE `ims_xcommunity_fled`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `addressid_2` (`addressid`),
  ADD KEY `addressid_3` (`addressid`),
  ADD KEY `addressid_4` (`addressid`),
  ADD KEY `addressid_5` (`addressid`);

--
-- Indexes for table `ims_xcommunity_fled_images`
--
ALTER TABLE `ims_xcommunity_fled_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_goods`
--
ALTER TABLE `ims_xcommunity_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_goods_region`
--
ALTER TABLE `ims_xcommunity_goods_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_home`
--
ALTER TABLE `ims_xcommunity_home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_homemaking`
--
ALTER TABLE `ims_xcommunity_homemaking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `addressid_2` (`addressid`),
  ADD KEY `addressid_3` (`addressid`),
  ADD KEY `addressid_4` (`addressid`),
  ADD KEY `addressid_5` (`addressid`);

--
-- Indexes for table `ims_xcommunity_houselease`
--
ALTER TABLE `ims_xcommunity_houselease`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `uid_2` (`uid`),
  ADD KEY `uid_3` (`uid`),
  ADD KEY `uid_4` (`uid`),
  ADD KEY `uid_5` (`uid`);

--
-- Indexes for table `ims_xcommunity_houselease_images`
--
ALTER TABLE `ims_xcommunity_houselease_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_images`
--
ALTER TABLE `ims_xcommunity_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_member`
--
ALTER TABLE `ims_xcommunity_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `uid_2` (`uid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `uid_3` (`uid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `uid_4` (`uid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `uid_5` (`uid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_member_address`
--
ALTER TABLE `ims_xcommunity_member_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`),
  ADD KEY `memberid_2` (`memberid`),
  ADD KEY `memberid_3` (`memberid`),
  ADD KEY `memberid_4` (`memberid`),
  ADD KEY `memberid_5` (`memberid`);

--
-- Indexes for table `ims_xcommunity_member_bind`
--
ALTER TABLE `ims_xcommunity_member_bind`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_member_family`
--
ALTER TABLE `ims_xcommunity_member_family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_member_log`
--
ALTER TABLE `ims_xcommunity_member_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_member_room`
--
ALTER TABLE `ims_xcommunity_member_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_member_visit_log`
--
ALTER TABLE `ims_xcommunity_member_visit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_memo`
--
ALTER TABLE `ims_xcommunity_memo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_memo_company`
--
ALTER TABLE `ims_xcommunity_memo_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_menu`
--
ALTER TABLE `ims_xcommunity_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_nav`
--
ALTER TABLE `ims_xcommunity_nav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_nav_region`
--
ALTER TABLE `ims_xcommunity_nav_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_notice`
--
ALTER TABLE `ims_xcommunity_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staffid`),
  ADD KEY `staffid_2` (`staffid`),
  ADD KEY `staffid_3` (`staffid`),
  ADD KEY `staffid_4` (`staffid`),
  ADD KEY `staffid_5` (`staffid`);

--
-- Indexes for table `ims_xcommunity_notice_category`
--
ALTER TABLE `ims_xcommunity_notice_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `nid` (`nid`),
  ADD KEY `cid_2` (`cid`),
  ADD KEY `nid_2` (`nid`),
  ADD KEY `cid_3` (`cid`),
  ADD KEY `nid_3` (`nid`),
  ADD KEY `cid_4` (`cid`),
  ADD KEY `nid_4` (`nid`),
  ADD KEY `cid_5` (`cid`),
  ADD KEY `nid_5` (`nid`);

--
-- Indexes for table `ims_xcommunity_notice_region`
--
ALTER TABLE `ims_xcommunity_notice_region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_opendoor_data`
--
ALTER TABLE `ims_xcommunity_opendoor_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_open_log`
--
ALTER TABLE `ims_xcommunity_open_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_order`
--
ALTER TABLE `ims_xcommunity_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `addressid_2` (`addressid`),
  ADD KEY `addressid_3` (`addressid`),
  ADD KEY `addressid_4` (`addressid`),
  ADD KEY `addressid_5` (`addressid`);

--
-- Indexes for table `ims_xcommunity_order_goods`
--
ALTER TABLE `ims_xcommunity_order_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `goodsid` (`goodsid`),
  ADD KEY `orderid_2` (`orderid`),
  ADD KEY `goodsid_2` (`goodsid`),
  ADD KEY `orderid_3` (`orderid`),
  ADD KEY `goodsid_3` (`goodsid`),
  ADD KEY `orderid_4` (`orderid`),
  ADD KEY `goodsid_4` (`goodsid`),
  ADD KEY `orderid_5` (`orderid`),
  ADD KEY `goodsid_5` (`goodsid`);

--
-- Indexes for table `ims_xcommunity_parking`
--
ALTER TABLE `ims_xcommunity_parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_pay`
--
ALTER TABLE `ims_xcommunity_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_pay_api`
--
ALTER TABLE `ims_xcommunity_pay_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_phone`
--
ALTER TABLE `ims_xcommunity_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_phone_region`
--
ALTER TABLE `ims_xcommunity_phone_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_plugin`
--
ALTER TABLE `ims_xcommunity_plugin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_print`
--
ALTER TABLE `ims_xcommunity_print`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_property`
--
ALTER TABLE `ims_xcommunity_property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_rank`
--
ALTER TABLE `ims_xcommunity_rank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rankid` (`rankid`),
  ADD KEY `rankid_2` (`rankid`),
  ADD KEY `rankid_3` (`rankid`),
  ADD KEY `rankid_4` (`rankid`),
  ADD KEY `rankid_5` (`rankid`);

--
-- Indexes for table `ims_xcommunity_reading_member`
--
ALTER TABLE `ims_xcommunity_reading_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_region`
--
ALTER TABLE `ims_xcommunity_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_report`
--
ALTER TABLE `ims_xcommunity_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressid` (`addressid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `regionid` (`regionid`),
  ADD KEY `addressid_2` (`addressid`),
  ADD KEY `cid_2` (`cid`),
  ADD KEY `regionid_2` (`regionid`),
  ADD KEY `addressid_3` (`addressid`),
  ADD KEY `cid_3` (`cid`),
  ADD KEY `regionid_3` (`regionid`),
  ADD KEY `addressid_4` (`addressid`),
  ADD KEY `cid_4` (`cid`),
  ADD KEY `regionid_4` (`regionid`),
  ADD KEY `addressid_5` (`addressid`),
  ADD KEY `cid_5` (`cid`),
  ADD KEY `regionid_5` (`regionid`);

--
-- Indexes for table `ims_xcommunity_report_images`
--
ALTER TABLE `ims_xcommunity_report_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_report_log`
--
ALTER TABLE `ims_xcommunity_report_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reportid` (`reportid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `reportid_2` (`reportid`),
  ADD KEY `uid_2` (`uid`),
  ADD KEY `reportid_3` (`reportid`),
  ADD KEY `uid_3` (`uid`),
  ADD KEY `reportid_4` (`reportid`),
  ADD KEY `uid_4` (`uid`),
  ADD KEY `reportid_5` (`reportid`),
  ADD KEY `uid_5` (`uid`);

--
-- Indexes for table `ims_xcommunity_res`
--
ALTER TABLE `ims_xcommunity_res`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `aid_2` (`aid`),
  ADD KEY `uid_2` (`uid`),
  ADD KEY `aid_3` (`aid`),
  ADD KEY `uid_3` (`uid`),
  ADD KEY `aid_4` (`aid`),
  ADD KEY `uid_4` (`uid`),
  ADD KEY `aid_5` (`aid`),
  ADD KEY `uid_5` (`uid`);

--
-- Indexes for table `ims_xcommunity_search`
--
ALTER TABLE `ims_xcommunity_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_search_region`
--
ALTER TABLE `ims_xcommunity_search_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_send_log`
--
ALTER TABLE `ims_xcommunity_send_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_service_data`
--
ALTER TABLE `ims_xcommunity_service_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_setting`
--
ALTER TABLE `ims_xcommunity_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_slide`
--
ALTER TABLE `ims_xcommunity_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_slide_region`
--
ALTER TABLE `ims_xcommunity_slide_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_staff`
--
ALTER TABLE `ims_xcommunity_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentid` (`departmentid`),
  ADD KEY `departmentid_2` (`departmentid`),
  ADD KEY `departmentid_3` (`departmentid`),
  ADD KEY `departmentid_4` (`departmentid`),
  ADD KEY `departmentid_5` (`departmentid`);

--
-- Indexes for table `ims_xcommunity_stop_park`
--
ALTER TABLE `ims_xcommunity_stop_park`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_stop_park_cars`
--
ALTER TABLE `ims_xcommunity_stop_park_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_stop_park_car_record`
--
ALTER TABLE `ims_xcommunity_stop_park_car_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_stop_park_order`
--
ALTER TABLE `ims_xcommunity_stop_park_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_stop_park_set`
--
ALTER TABLE `ims_xcommunity_stop_park_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_stop_park_setting`
--
ALTER TABLE `ims_xcommunity_stop_park_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_template`
--
ALTER TABLE `ims_xcommunity_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_users`
--
ALTER TABLE `ims_xcommunity_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staffid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `staffid_2` (`staffid`),
  ADD KEY `uid_2` (`uid`),
  ADD KEY `staffid_3` (`staffid`),
  ADD KEY `uid_3` (`uid`),
  ADD KEY `staffid_4` (`staffid`),
  ADD KEY `uid_4` (`uid`),
  ADD KEY `staffid_5` (`staffid`),
  ADD KEY `uid_5` (`uid`);

--
-- Indexes for table `ims_xcommunity_users_group`
--
ALTER TABLE `ims_xcommunity_users_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_users_log`
--
ALTER TABLE `ims_xcommunity_users_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_users_region`
--
ALTER TABLE `ims_xcommunity_users_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_wechat`
--
ALTER TABLE `ims_xcommunity_wechat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_wechat_notice`
--
ALTER TABLE `ims_xcommunity_wechat_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staffid`),
  ADD KEY `staffid_2` (`staffid`),
  ADD KEY `staffid_3` (`staffid`),
  ADD KEY `staffid_4` (`staffid`),
  ADD KEY `staffid_5` (`staffid`);

--
-- Indexes for table `ims_xcommunity_wechat_notice_region`
--
ALTER TABLE `ims_xcommunity_wechat_notice_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_xqcars`
--
ALTER TABLE `ims_xcommunity_xqcars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_xcommunity_xqnotice`
--
ALTER TABLE `ims_xcommunity_xqnotice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ims_account`
--
ALTER TABLE `ims_account`
  MODIFY `acid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_account_wxapp`
--
ALTER TABLE `ims_account_wxapp`
  MODIFY `acid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_article_category`
--
ALTER TABLE `ims_article_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_article_news`
--
ALTER TABLE `ims_article_news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_article_notice`
--
ALTER TABLE `ims_article_notice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_article_unread_notice`
--
ALTER TABLE `ims_article_unread_notice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_basic_reply`
--
ALTER TABLE `ims_basic_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_business`
--
ALTER TABLE `ims_business`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_attachment`
--
ALTER TABLE `ims_core_attachment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `ims_core_cron`
--
ALTER TABLE `ims_core_cron`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_cron_record`
--
ALTER TABLE `ims_core_cron_record`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_menu`
--
ALTER TABLE `ims_core_menu`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_paylog`
--
ALTER TABLE `ims_core_paylog`
  MODIFY `plid` bigint(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ims_core_performance`
--
ALTER TABLE `ims_core_performance`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_queue`
--
ALTER TABLE `ims_core_queue`
  MODIFY `qid` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_refundlog`
--
ALTER TABLE `ims_core_refundlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_resource`
--
ALTER TABLE `ims_core_resource`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_core_sendsms_log`
--
ALTER TABLE `ims_core_sendsms_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_coupon_location`
--
ALTER TABLE `ims_coupon_location`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_cover_reply`
--
ALTER TABLE `ims_cover_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_custom_reply`
--
ALTER TABLE `ims_custom_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_images_reply`
--
ALTER TABLE `ims_images_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_cash_record`
--
ALTER TABLE `ims_mc_cash_record`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_chats_record`
--
ALTER TABLE `ims_mc_chats_record`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_mc_credits_recharge`
--
ALTER TABLE `ims_mc_credits_recharge`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_credits_record`
--
ALTER TABLE `ims_mc_credits_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ims_mc_fans_groups`
--
ALTER TABLE `ims_mc_fans_groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_mc_fans_tag_mapping`
--
ALTER TABLE `ims_mc_fans_tag_mapping`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_groups`
--
ALTER TABLE `ims_mc_groups`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_mc_handsel`
--
ALTER TABLE `ims_mc_handsel`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_mapping_fans`
--
ALTER TABLE `ims_mc_mapping_fans`
  MODIFY `fanid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `ims_mc_mapping_ucenter`
--
ALTER TABLE `ims_mc_mapping_ucenter`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_mass_record`
--
ALTER TABLE `ims_mc_mass_record`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_members`
--
ALTER TABLE `ims_mc_members`
  MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `ims_mc_member_address`
--
ALTER TABLE `ims_mc_member_address`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_member_fields`
--
ALTER TABLE `ims_mc_member_fields`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ims_mc_member_property`
--
ALTER TABLE `ims_mc_member_property`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mc_oauth_fans`
--
ALTER TABLE `ims_mc_oauth_fans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_menu_event`
--
ALTER TABLE `ims_menu_event`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_mobilenumber`
--
ALTER TABLE `ims_mobilenumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_modules`
--
ALTER TABLE `ims_modules`
  MODIFY `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ims_modules_bindings`
--
ALTER TABLE `ims_modules_bindings`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ims_modules_plugin`
--
ALTER TABLE `ims_modules_plugin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `ims_modules_recycle`
--
ALTER TABLE `ims_modules_recycle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_music_reply`
--
ALTER TABLE `ims_music_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_news_reply`
--
ALTER TABLE `ims_news_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_profile_fields`
--
ALTER TABLE `ims_profile_fields`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ims_qrcode`
--
ALTER TABLE `ims_qrcode`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_qrcode_stat`
--
ALTER TABLE `ims_qrcode_stat`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_rule`
--
ALTER TABLE `ims_rule`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ims_rule_keyword`
--
ALTER TABLE `ims_rule_keyword`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ims_site_article`
--
ALTER TABLE `ims_site_article`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_category`
--
ALTER TABLE `ims_site_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_multi`
--
ALTER TABLE `ims_site_multi`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_site_nav`
--
ALTER TABLE `ims_site_nav`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_page`
--
ALTER TABLE `ims_site_page`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_slide`
--
ALTER TABLE `ims_site_slide`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_store_goods`
--
ALTER TABLE `ims_site_store_goods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_store_order`
--
ALTER TABLE `ims_site_store_order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_styles`
--
ALTER TABLE `ims_site_styles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_site_styles_vars`
--
ALTER TABLE `ims_site_styles_vars`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_site_templates`
--
ALTER TABLE `ims_site_templates`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_stat_fans`
--
ALTER TABLE `ims_stat_fans`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `ims_stat_keyword`
--
ALTER TABLE `ims_stat_keyword`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_stat_msg_history`
--
ALTER TABLE `ims_stat_msg_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_stat_rule`
--
ALTER TABLE `ims_stat_rule`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_stat_visit`
--
ALTER TABLE `ims_stat_visit`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_uni_account`
--
ALTER TABLE `ims_uni_account`
  MODIFY `uniacid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_uni_account_group`
--
ALTER TABLE `ims_uni_account_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_uni_account_menus`
--
ALTER TABLE `ims_uni_account_menus`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_uni_account_modules`
--
ALTER TABLE `ims_uni_account_modules`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_uni_account_users`
--
ALTER TABLE `ims_uni_account_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_uni_group`
--
ALTER TABLE `ims_uni_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_uni_verifycode`
--
ALTER TABLE `ims_uni_verifycode`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_userapi_cache`
--
ALTER TABLE `ims_userapi_cache`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_userapi_reply`
--
ALTER TABLE `ims_userapi_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ims_users`
--
ALTER TABLE `ims_users`
  MODIFY `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ims_users_failed_login`
--
ALTER TABLE `ims_users_failed_login`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_users_founder_group`
--
ALTER TABLE `ims_users_founder_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_users_group`
--
ALTER TABLE `ims_users_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_users_invitation`
--
ALTER TABLE `ims_users_invitation`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_users_permission`
--
ALTER TABLE `ims_users_permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_users_profile`
--
ALTER TABLE `ims_users_profile`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_video_reply`
--
ALTER TABLE `ims_video_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_voice_reply`
--
ALTER TABLE `ims_voice_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_wechat_attachment`
--
ALTER TABLE `ims_wechat_attachment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_wechat_news`
--
ALTER TABLE `ims_wechat_news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_wxapp_general_analysis`
--
ALTER TABLE `ims_wxapp_general_analysis`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_wxapp_versions`
--
ALTER TABLE `ims_wxapp_versions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_wxcard_reply`
--
ALTER TABLE `ims_wxcard_reply`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_activity`
--
ALTER TABLE `ims_xcommunity_activity`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_activity_region`
--
ALTER TABLE `ims_xcommunity_activity_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_alipayment`
--
ALTER TABLE `ims_xcommunity_alipayment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_announcement`
--
ALTER TABLE `ims_xcommunity_announcement`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_announcement_region`
--
ALTER TABLE `ims_xcommunity_announcement_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_xcommunity_bind_door`
--
ALTER TABLE `ims_xcommunity_bind_door`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ims_xcommunity_bind_door_device`
--
ALTER TABLE `ims_xcommunity_bind_door_device`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ims_xcommunity_building`
--
ALTER TABLE `ims_xcommunity_building`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_building_device`
--
ALTER TABLE `ims_xcommunity_building_device`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_carpool`
--
ALTER TABLE `ims_xcommunity_carpool`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_cart`
--
ALTER TABLE `ims_xcommunity_cart`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_xcommunity_car_images`
--
ALTER TABLE `ims_xcommunity_car_images`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_category`
--
ALTER TABLE `ims_xcommunity_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ims_xcommunity_company`
--
ALTER TABLE `ims_xcommunity_company`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_cost`
--
ALTER TABLE `ims_xcommunity_cost`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_cost_list`
--
ALTER TABLE `ims_xcommunity_cost_list`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ims_xcommunity_coupon_order`
--
ALTER TABLE `ims_xcommunity_coupon_order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_department`
--
ALTER TABLE `ims_xcommunity_department`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_dp`
--
ALTER TABLE `ims_xcommunity_dp`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_fled`
--
ALTER TABLE `ims_xcommunity_fled`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_fled_images`
--
ALTER TABLE `ims_xcommunity_fled_images`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_goods`
--
ALTER TABLE `ims_xcommunity_goods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_xcommunity_goods_region`
--
ALTER TABLE `ims_xcommunity_goods_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ims_xcommunity_home`
--
ALTER TABLE `ims_xcommunity_home`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ims_xcommunity_homemaking`
--
ALTER TABLE `ims_xcommunity_homemaking`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_houselease`
--
ALTER TABLE `ims_xcommunity_houselease`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_houselease_images`
--
ALTER TABLE `ims_xcommunity_houselease_images`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_images`
--
ALTER TABLE `ims_xcommunity_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member`
--
ALTER TABLE `ims_xcommunity_member`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_address`
--
ALTER TABLE `ims_xcommunity_member_address`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_bind`
--
ALTER TABLE `ims_xcommunity_member_bind`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_family`
--
ALTER TABLE `ims_xcommunity_member_family`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_log`
--
ALTER TABLE `ims_xcommunity_member_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_room`
--
ALTER TABLE `ims_xcommunity_member_room`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `ims_xcommunity_member_visit_log`
--
ALTER TABLE `ims_xcommunity_member_visit_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `ims_xcommunity_memo`
--
ALTER TABLE `ims_xcommunity_memo`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_memo_company`
--
ALTER TABLE `ims_xcommunity_memo_company`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_menu`
--
ALTER TABLE `ims_xcommunity_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `ims_xcommunity_nav`
--
ALTER TABLE `ims_xcommunity_nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ims_xcommunity_nav_region`
--
ALTER TABLE `ims_xcommunity_nav_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ims_xcommunity_notice`
--
ALTER TABLE `ims_xcommunity_notice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_notice_category`
--
ALTER TABLE `ims_xcommunity_notice_category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_notice_region`
--
ALTER TABLE `ims_xcommunity_notice_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_opendoor_data`
--
ALTER TABLE `ims_xcommunity_opendoor_data`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ims_xcommunity_open_log`
--
ALTER TABLE `ims_xcommunity_open_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=376;
--
-- AUTO_INCREMENT for table `ims_xcommunity_order`
--
ALTER TABLE `ims_xcommunity_order`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `ims_xcommunity_order_goods`
--
ALTER TABLE `ims_xcommunity_order_goods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `ims_xcommunity_parking`
--
ALTER TABLE `ims_xcommunity_parking`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_pay`
--
ALTER TABLE `ims_xcommunity_pay`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ims_xcommunity_pay_api`
--
ALTER TABLE `ims_xcommunity_pay_api`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ims_xcommunity_phone`
--
ALTER TABLE `ims_xcommunity_phone`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_phone_region`
--
ALTER TABLE `ims_xcommunity_phone_region`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_plugin`
--
ALTER TABLE `ims_xcommunity_plugin`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_print`
--
ALTER TABLE `ims_xcommunity_print`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_property`
--
ALTER TABLE `ims_xcommunity_property`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_rank`
--
ALTER TABLE `ims_xcommunity_rank`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_reading_member`
--
ALTER TABLE `ims_xcommunity_reading_member`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ims_xcommunity_region`
--
ALTER TABLE `ims_xcommunity_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_report`
--
ALTER TABLE `ims_xcommunity_report`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_report_images`
--
ALTER TABLE `ims_xcommunity_report_images`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_report_log`
--
ALTER TABLE `ims_xcommunity_report_log`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_res`
--
ALTER TABLE `ims_xcommunity_res`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_search`
--
ALTER TABLE `ims_xcommunity_search`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_search_region`
--
ALTER TABLE `ims_xcommunity_search_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_send_log`
--
ALTER TABLE `ims_xcommunity_send_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ims_xcommunity_service_data`
--
ALTER TABLE `ims_xcommunity_service_data`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_setting`
--
ALTER TABLE `ims_xcommunity_setting`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `ims_xcommunity_slide`
--
ALTER TABLE `ims_xcommunity_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ims_xcommunity_slide_region`
--
ALTER TABLE `ims_xcommunity_slide_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ims_xcommunity_staff`
--
ALTER TABLE `ims_xcommunity_staff`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park`
--
ALTER TABLE `ims_xcommunity_stop_park`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park_cars`
--
ALTER TABLE `ims_xcommunity_stop_park_cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park_car_record`
--
ALTER TABLE `ims_xcommunity_stop_park_car_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park_order`
--
ALTER TABLE `ims_xcommunity_stop_park_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park_set`
--
ALTER TABLE `ims_xcommunity_stop_park_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_stop_park_setting`
--
ALTER TABLE `ims_xcommunity_stop_park_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_template`
--
ALTER TABLE `ims_xcommunity_template`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_users`
--
ALTER TABLE `ims_xcommunity_users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ims_xcommunity_users_group`
--
ALTER TABLE `ims_xcommunity_users_group`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ims_xcommunity_users_log`
--
ALTER TABLE `ims_xcommunity_users_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `ims_xcommunity_users_region`
--
ALTER TABLE `ims_xcommunity_users_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_wechat`
--
ALTER TABLE `ims_xcommunity_wechat`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_wechat_notice`
--
ALTER TABLE `ims_xcommunity_wechat_notice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_wechat_notice_region`
--
ALTER TABLE `ims_xcommunity_wechat_notice_region`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ims_xcommunity_xqcars`
--
ALTER TABLE `ims_xcommunity_xqcars`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ims_xcommunity_xqnotice`
--
ALTER TABLE `ims_xcommunity_xqnotice`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
