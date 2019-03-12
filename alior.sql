-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2019 at 05:59 PM
-- Server version: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.2.15-1+0~20190209065123.16+stretch~1.gbp3ad8c0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alior`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

CREATE TABLE `adresses` (
  `id` int(11) NOT NULL,
  `strana_id` int(11) DEFAULT NULL,
  `oblast_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pochta_index` tinyint(3) DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `house` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `room` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `orientir` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`id`, `strana_id`, `oblast_id`, `city_id`, `pochta_index`, `street`, `house`, `room`, `orientir`, `profile_id`) VALUES
(13, 1, 11, 18, 127, 'Мир Саид Барака', '32', '', '(Некрасова) Возле гостиницы \"Samarkand Dream\"', 3),
(16, 1, 11, 18, NULL, 'Фирдавси', '1', '10', 'Infin Bank', 5),
(17, 1, 3, 68, 127, '45', '45', '45', '45', 6),
(20, 1, 11, 18, NULL, 'Фирдавси', '1', '10', 'Infin Bank', 4),
(21, 1, 11, 12, NULL, 'Navoiy', '109', '', 'sport magazin', 7),
(22, 1, 11, 18, NULL, 'Рудакий', '229', '', 'Старый кирпич завод', 8),
(23, 1, 2, 26, 127, '2123', '12312', '2312', '3123123', 9),
(24, 1, 1, 39, 127, 'd', 'd', 'd', 'd', 10),
(25, 1, 1, 39, 127, '5', '55', '555', 'sss', 11),
(26, 1, 12, 183, 127, 'ss', 'dd', 'dd', 'ddd', 12),
(27, 1, 1, 52, 127, '5', '55', '555', 'dsadsa', 15),
(28, 1, 1, 52, 127, '5', '55', '555', 'dsadsa', 16),
(29, 1, 1, 52, 127, '5', '55', '555', 'dsadsa', 18),
(30, 1, 1, 39, 127, '5', '55', '555', 'sss', 19),
(31, 1, 1, 39, 127, '5', '55', '555', 'sss', 20),
(33, 1, 3, 68, 127, '5', '55', '555', 'qwqw', 22),
(34, 1, 12, 183, 127, '5', '55', '555', '45', 23),
(35, 1, 9, 159, 127, '1', '21', '21', '12', 24),
(36, 1, 8, 143, 127, '1', '21', '21', 'sdsds', 25);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` text,
  `meta_keywords` text,
  `meta_description` text,
  `content` text,
  `status` tinyint(3) DEFAULT '10',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `in_menu` tinyint(4) NOT NULL,
  `sort` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `slug`, `title`, `meta_keywords`, `meta_description`, `content`, `status`, `created_at`, `updated_at`, `created_by`, `in_menu`, `sort`) VALUES
(4, 'oplata-i-dostavka-tovara', 'Оплата и Доставка ', '', '', '<h3 style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\">Способы оплаты</span></h3>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Для того, чтобы оплатить товар, Вам нужно перейти в &laquo;Корзину&raquo; и выбрать тот товар, который Вы хотите купить.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\" start=\"2\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">После перехода в Корзину, откроется список товаров, которые Вы добавили. Далее, нажимаем кнопку &laquo;Оформить заказ&raquo;.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\" start=\"3\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">В&nbsp; окне, появится &laquo;Способы оплаты&raquo; и &laquo;Способы доставки&raquo;, которые Вам не обходимо выбрать.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\" start=\"4\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Вы можете выбрать более подходящий для Вас способ оплаты:</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">Для жителей г. Самарканд</p>\r\n<ul style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; list-style: circle; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Оплата на месте;</li>\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Оплата по терминалу;</li>\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Оплата через платёжные системы, такие как Payme.</li>\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Перечислением</li>\r\n</ul>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">Для жителей других городов</p>\r\n<ul style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; list-style: circle; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Оплата через платёжные системы, такие как Payme.</li>\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Перечислением</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\" start=\"5\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">После заполнения всей информации нажимаем кнопку &laquo;Оформить заказ&raquo;</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<h3 style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\">Доставка</span></h3>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">При оформлении доставки, Ваш товар будет доставлен по указанному адресу, который Вы ввели при регистрации на сайте &laquo;Alior.uz&raquo;.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">Если Вам нужно изменить адрес доставки, то позвоните нам по номеру +998(90) 603-90-80&nbsp; и сообщите свой номер заказа, дату, сумму и новый адрес доставки.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">Вы сможете изменить адрес доставки в течение часа после оформления заказа.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">По Республике:</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<ol style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 40px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\">\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Наша компания обязуется от 2-х до 7-х рабочих дней доставить Ваш товар по указанному адресу На территории РУз <span style=\"font-size: 14pt; text-align: justify;\">&nbsp;</span>&nbsp;в зависимости от адреса производителя и адреса пакупателя. Стоимость доставки&nbsp; до адресата &ndash; 20 000 сум за 1 кг.&nbsp;<span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Доставка до одного из ближайших к Покупателю наших складов который можно выбрать при оформление заказа 10 000 сум (т.е. самовывоз со склада).&nbsp;</span>&nbsp;</li>\r\n<li style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px;\">Также, Вы сможете забрать товар самовывозом со склада, когда один из наших сотрудников свяжется с Вами при поступлении товара. После чего товар можно забрать&nbsp;в течении рабочего дня, с 9:00 до 18:00 по выбранному адресу при оформлении заказа.</li>\r\n</ol>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<h4 style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\">Примечание!</span></h4>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">Если по адресу доставки есть какие-то ограничения на въезд, такие, как пропускная система или же платная стоянка, то Вам нужно будет позаботиться об этом. В ином случае мы доставим Ваш товар до платного или ограниченного места.&nbsp;<span style=\"font-size: 14pt; text-align: justify; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;\">При выборе не правильного способа оплаты в зависимости от региона, заказ будет аннулирован или переделан!&nbsp;</span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 10px; outline: 0px; -webkit-tap-highlight-color: transparent; font-size: 17px; line-height: 1.4; color: #242424; font-family: LatoRegular, sans-serif;\">&nbsp;</p>', NULL, 1534610262, 1538744666, 2, 1, 1),
(7, 'o-nas', 'О Нас', 'О Нас', '', '', 10, 1536761242, 1538744704, 2, 1, 3),
(8, 'oferta', 'Оферта', '', '', '', NULL, 1536808437, 1536808437, 2, 0, NULL),
(9, 'polzovatelskoe-soglashenie', 'Пользовательское соглашение', '', '', '<h3 style=\"text-align: justify;\">&nbsp; &nbsp; <strong>&nbsp; &nbsp; &nbsp; 1. Условия использования</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>1.1 Alior.uz</strong> &ndash; торговая площадка для желающих купить или продать товар&nbsp; и использование информационных материалов Сайта регулируется нормами действующего законодательства Республики Узбекистан &ndash; Далее&nbsp; Торговая площадка, Сайт, Веб-сайт.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>1.2.</strong> Настоящее Соглашение определяет условия использования&nbsp; материалов и сервисов сайта alior.uz&nbsp; между Покупателями и Продавцами&nbsp; - Далее Пользователи.</p>\r\n<h3 style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong> 2. Общие положения&nbsp;</strong>&nbsp;</h3>\r\n<p style=\"text-align: justify;\"><strong>2.1.</strong> Данное соглашение является публичным договором (офертой) и адресовано неопределенному кругу лиц, вне зависимости от статуса физического или юридического лица, физического лица &ndash; предпринимателя, желающего продать или&nbsp; приобрести товары в торговой площадке alior.uz .</p>\r\n<p style=\"text-align: justify;\"><strong>2.2.</strong> Поскольку настоящее Соглашение является публичной офертой, то получая доступ к материалам Сайта, Продавец или Покупатель считается присоединившимся к настоящему Соглашению.</p>\r\n<p style=\"text-align: justify;\"><strong>2.3.</strong> Администрация или владелец сайта alior.uz, или уполномоченные им лица&nbsp; вправе в любое время в одностороннем порядке изменять условия настоящего Соглашения. Новое или измененное Соглашение становятся действительными после размещения его на Сайте. При несогласии Пользователя с внесенными изменениями он обязан отказаться от доступа к Сайту, прекратить использование материалов и сервисов Сайта.</p>\r\n<p style=\"text-align: justify;\"><strong>2.4.</strong> Пользователь соглашается с данной публичной офертой в целом и без оговорок. После регистрации на торговой площадке обязуется не предпринимать&nbsp; действия, которые могут рассматриваться как нарушающие Законодательство Республики Узбекистан, а так же могут привести к нарушению нормальной работы Сайта и других Пользователей.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>2.5.</strong> Не допускается использование материалов торговой площадки без согласия правообладателей.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>2.6.</strong> Комментарии и иные записи или действия Пользователя на торговой площадке не должны вступать в противоречие с требованиями законодательства Республики Узбекистан и общепринятых норм морали и этики.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>2.7.</strong> Пользователь соглашается с тем, что все условия настоящего Пользовательского Соглашения им прочитаны и понятны, и он принимает его полностью и безоговорочно. Администрация сайта alior.uz при обнаружении правонарушений вправе в одностороннем порядке закрыть общий доступ Пользователю для дальнейшего разбирательства.&nbsp;&nbsp;</p>\r\n<h3 style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 3. Обязательства Пользователя</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>3.1</strong> Пользователь согласен с тем, что Администрация Сайта не несет ответственности и не имеет прямых или косвенных обязательств перед Пользователем в связи с любыми возможными или возникшими потерями или убытками, связанными с любыми содержаниями используемые на Сайте.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>3.2.</strong> Пользователь (покупатель) обязан предоставить достоверную и точную информацию о себе и своих контактных данных, для исполнения Продавцом своих обязательств перед Покупателем и доставки ему Товара.</p>\r\n<p style=\"text-align: justify;\"><strong>3.3.</strong> Пользователь (продавец) обязан предоставить достоверную и точную информацию своих товаров и услуг размещённых на сайте, а покупатель обязан ознакомиться с условиями того или иного товара и услуг до её покупки.&nbsp;</p>\r\n<h3 style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>4. Регистрация на Сайте</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>4.1</strong>. Для формирования заказов на Сайте Пользователю необходимо&nbsp; пройти процедуру регистрации и внести необходимые данные, согласно анкете, далее произвести активирование, перейдя по ссылке в указанном E-mail адресе при регистрации.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>4.2.</strong> В процессе регистрации на Сайте Пользователь указывает логин и пароль, за безопасность которым он несет полную ответственность. Пользователь обязуется не сообщать третьим лицам логин и пароль, указанные при регистрации, хранить эти данные в недоступном для посторонних месте. За все действия, совершаемые от его имени, то есть с использованием его логина и пароля, ответственность несет исключительно сам Пользователь.</p>\r\n<p style=\"text-align: justify;\"><strong>4.3.</strong> В процессе регистрации Сайт alior.uz генерирует логин, который надо запомнить или хранить в недоступном для посторонних месте.&nbsp;</p>\r\n<h3 style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>3. Конфиденциальность и персональные данные</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>3.1.</strong> Информацию, предоставляемая Пользователем,&nbsp; администрация сайта использует с цель выполнения Заказов между Пользователями, если иных целей не указано в данном Соглашении.</p>\r\n<p style=\"text-align: justify;\"><strong>3.2.</strong> При заполнении регистрационной анкеты на сайте alior.uz,&nbsp; Пользователь добровольно дает согласие на сбор и обработку своих персональных данных. Администрации Сайта и Пользователи используют её для обработки Заказа на приобретение Товаров и услуг на торговой площадке, как со стороны продавца, так и со стороны покупателя. Администрации Сайта использует информацию для отправки телекоммуникационными средствами связи (по электронной почте, мобильной связью) рекламных и специальных предложений, информации об акциях, розыгрыши или любой другой информации о деятельности Торговой площадки alior.uz&nbsp; и в других коммерческих целях.</p>\r\n<p style=\"text-align: justify;\"><strong>3.3.</strong> Для целей, предусмотренных настоящим пунктом, Администрация и Пользователь вправе направлять письма, сообщения и материалы на почтовый адрес или электронную почту другого Пользователя, а также отправлять sms-сообщения, совершать звонки на указанный в анкете номер, если это необходимо для выполнения заказа. Администрация имеет право осуществлять запись телефонных звонков с Пользователем с целью улучшения качества обслуживания, на что Пользователь дает свое безоговорочное согласие.</p>\r\n<p style=\"text-align: justify;\"><strong>3.4.</strong> Пользователь дает согласие на использование Администрацией технологии cookie. Файлы cookie не содержат личной информации и не могут никоим образом считывать информацию жесткого диска Пользователя. Файлы cookie используются для того, чтобы повышать качество предоставляемых услуг и для быстрой идентификации Пользователя; сохранения настроек Пользователя, его персональных предпочтений, отслеживания состояния сессии доступа и характерных для него тенденций. Администрация также использует файлы cookie в рекламных целях, в том числе, чтобы управлять объявлениями на сайтах в сети Интернет. При отключении технологии cookie Пользователем, Администрация не гарантирует полную работоспособность торговой площадки alior.uz&nbsp; или некоторых его сервисов.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>3.4.</strong> Пользователь дает право Администрации осуществлять обработку его персональных данных, в том числе: помещать персональные данные в базы данных Администрации (без дополнительного уведомления об этом), осуществлять пожизненное хранение данных, их накопление, обновление, изменение (по мере необходимости). Администрация обязуется обеспечить защиту данных от несанкционированного доступа третьих лиц, не распространять и не передавать данные любой третьей стороне (кроме передачи данных связанным лицам, коммерческим партнерам, лицам, уполномоченным Администрацией на осуществление непосредственной обработки данных для указанных целей, а также на запрос компетентного государственного органа).&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>3.5.</strong> В случае нежелания получать рассылку о рекламных акциях, новых продуктах и т.д., Пользователь имеет право отказаться от нее, путем отправки письма Администрации.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>3.6.</strong> Администрация не несет ответственности за содержание и достоверность информации, предоставляемой Пользователем при регистрации на Торговой площадке alior.uz и оформлении Заказа. Пользователь несет ответственность за достоверность указанной информации при регистрации на Сайте и оформлении Заказа, соглашаясь на все риски, связанные с исполнением или неисполнением данного Заказа.&nbsp;</p>\r\n<h3 style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>4. Порядок оформления Заказов, ценообразование, обмен.</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>4.1.</strong> Пользователь оформляет заказ самостоятельно, путем нажатия кнопки &ldquo;оформить заказ&rdquo; и &ldquo;купить&rdquo;&nbsp; или по телефону, указанному у продавца. После оформления заказа покупатель сможет увидеть все свои заказы в личном кабинете.</p>\r\n<p style=\"text-align: justify;\"><strong>4.3.</strong> В случае отсутствия товара, указанного на Сайте, вследствие технических неполадок, а также по иным причинам, не зависящим от Администрации, указанный заказ аннулируется полностью или частично, а Пользователь информируется путём направления ему уведомления.&nbsp;</p>\r\n<p style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp;&nbsp;<strong>4.3.1</strong> Наличие товара</p>\r\n<p style=\"text-align: justify;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Пользователь предоставляя информацию о наличии товара в конкретный момент времени обязан гарантировать наличие товара. По счету-оферте Пользователь гарантирует наличие товара и доставку в течение указанного им рабочих дней или возврат денег. Пользователь обновляет информацию по наличию товаров своевременно.</p>\r\n<p style=\"text-align: justify;\"><strong>4.4.</strong> Присоединяясь к данному Соглашению и оформляя заказ, Пользователь (покупатель) подтверждает, что ознакомлен с разделами Сайта &laquo;Доставка&raquo; и &laquo;Оплата&raquo; у Пользователя (продавца); соглашается с ними и принимает их в полной мере. Пользователь (продавец) не имеет право изменить срок доставки заказа, которое было указано раннее на сайте.</p>\r\n<p style=\"text-align: justify;\"><strong>4.5.</strong> Пользователь соглашается с тем, что цена на товар, отложенный им в &laquo;корзину&raquo;, его ассортимент и количество, будут&nbsp; актуальными лишь на момент формирования &laquo;корзины&raquo; и могут изменяться, если покупка не была окончательно оформлена путем нажатия кнопки &laquo;оформить заказ&raquo;, &laquo;купить&raquo;.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>4.6.</strong> Пользователь соглашается с тем, что приобретенный им Товар не подлежит&nbsp; обмену и возврату в следующих случаях:</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; 4.6.1.</strong> С момента покупки Товара прошло более 10 календарных дней;</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp;4.6.2.</strong> С момента приобретения Товара не прошло 10 календарных дней, но товар был в употреблении, нарушена целостность упаковки и/или комплектность,&nbsp; отсутствуют бирки/ценника и т.д.</p>\r\n<p style=\"text-align: justify;\">- Товар содержится в перечне товаров, которые возврату и обмену не подлежат, согласно Постановлению Кабинета Министров Республики Узбекистан №75 от 13 февраля 2003 года в действующей редакции http://www.lex.uz/acts/243233, а именно:</p>\r\n<p style=\"text-align: justify;\">Продовольственные товары, лекарственные препараты и средства, предметы сан гигиены.</p>\r\n<p style=\"text-align: justify;\">&nbsp;Непродовольственные товары:</p>\r\n<p style=\"text-align: justify;\">-фотопленки, фотопластинки, фотографическая бумага</p>\r\n<p style=\"text-align: justify;\">-корсетные товары</p>\r\n<p style=\"text-align: justify;\">-парфюмерно-косметические изделия</p>\r\n<p style=\"text-align: justify;\">-перо-пуховые изделия</p>\r\n<p style=\"text-align: justify;\">-детские игрушки мягкие</p>\r\n<p style=\"text-align: justify;\">-детские игрушки резиновые надувные</p>\r\n<p style=\"text-align: justify;\">-зубные щетки</p>\r\n<p style=\"text-align: justify;\">-мундштуки</p>\r\n<p style=\"text-align: justify;\">-аппараты для бритья</p>\r\n<p style=\"text-align: justify;\">-помазки для бритья</p>\r\n<p style=\"text-align: justify;\">-расчески, грибницы и щетки массажные</p>\r\n<p style=\"text-align: justify;\">-сурдины (для духовых музыкальных инструментов)</p>\r\n<p style=\"text-align: justify;\">-скрипичные подбородок</p>\r\n<p style=\"text-align: justify;\">-перчатки</p>\r\n<p style=\"text-align: justify;\">-ткани</p>\r\n<p style=\"text-align: justify;\">-тюлегардинные и кружевные полотна</p>\r\n<p style=\"text-align: justify;\">-ковровые изделия метражные</p>\r\n<p style=\"text-align: justify;\">-белье нательное</p>\r\n<p style=\"text-align: justify;\">-белье постельное</p>\r\n<p style=\"text-align: justify;\">-чулочно-носочные изделия</p>\r\n<p style=\"text-align: justify;\">-товары в аэрозольной упаковке</p>\r\n<p style=\"text-align: justify;\">-печатные издания линейный и листовой металлопрокат, трубная продукция, пиломатериалы, погонажные (плинтус, наличник), плитные</p>\r\n<p style=\"text-align: justify;\">-материалы (древесноволокнистые и древесностружечные плиты, фанера) и стекло, нарезанные или раскроенные под размер, определенный покупателем (заказчиком)</p>\r\n<p style=\"text-align: justify;\">-аудио-, видеокассеты, диски для лазерных систем считывания с записью</p>\r\n<p style=\"text-align: justify;\">-изделия из натуральных и искусственных волос (парики)</p>\r\n<p style=\"text-align: justify;\">-товары для новорожденных (пеленки, соски, бутылочки для кормления тому подобное)</p>\r\n<p style=\"text-align: justify;\">-инструменты для маникюра, педикюра (ножницы, пилочки и т.п.)</p>\r\n<p style=\"text-align: justify;\">-ювелирные изделия из драгоценных металлов, драгоценных камней, драгоценных камней органогенного образования и полудрагоценных камней</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp;4.6.3.</strong> Пользователь (Покупатель) отказывается предоставить фотоматериалы бракованного и/или неисправного на его взгляд товара.</p>\r\n<p style=\"text-align: justify;\"><strong>4.7.</strong> Данным Соглашением Пользователь подтверждает свою осведомленность в том, что обмену или возврату подлежит только новый товар, который не был в употреблении и не имеет следов использования: царапин, сколов, потёртостей. Должны быть сохранены: полный комплект товара, целостность и все компоненты упаковки, ярлыки, заводская маркировка и Пользователь (Покупатель) имеет оригинал документа, подтверждающий факт покупки соответствующего Товара. Нарушение любого из этих пунктов оставляет за Пользователем (продавцом) право отказать Пользователю (покупателю) в обмене или возврате товара.</p>\r\n<p style=\"text-align: justify;\"><strong>4.8.</strong> При отказе Пользователем (покупателем) от товара Пользователя (продавца) производится возврат денежных средств оплаченного пре покупки Пользователем (покупателем).</p>\r\n<h3 style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 5. Ограничение ответственности Администрации</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>5.1.</strong> Администрация&nbsp; не несет никакой ответственности за любые ошибки, опечатки и неточности, которые могут быть обнаружены в материалах, содержащихся на данном Сайте. Администрация прикладывает все необходимые усилия, чтобы обеспечить точность и достоверность представляемой на сайте Торговой площадки информации. Вся информация и материалы предоставляются на условиях \"как есть\", без каких либо гарантий, как явных, так и подразумеваемых.</p>\r\n<p style=\"text-align: justify;\"><strong>5.2.</strong> Администрация&nbsp; не несет никакой ответственности за высказывания и мнения Пользователей Сайта, оставленные в качестве комментариев или обзоров.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>5.3.</strong> Администрация не несет ответственность за возможные противоправные действия Пользователей относительно третьих лиц, либо третьих лиц относительно Пользователя.&nbsp;</p>\r\n<p style=\"text-align: justify;\"><strong>5.4.</strong> Администрация не несет ответственности за ущерб, убытки или расходы (реальные либо возможные), возникшие в связи с настоящим Сайтом, его использованием или невозможностью использования.</p>\r\n<p style=\"text-align: justify;\"><strong>5.5.</strong> Администрация не несет ответственности за утерю Пользователем возможности доступа к своему аккаунту &mdash; учетной записи на сайте alior.uz (утрату логина, пароля, иной информации).</p>\r\n<p style=\"text-align: justify;\"><strong>5.6.</strong> В целях вышеизложенного Администрация оставляет за собой право удалять размещенную на Сайте информацию и предпринимать технические и юридические меры для прекращения доступа к Торговой площадке Пользователей,&nbsp; создающих проблемы в использовании Сайта другими Пользователями, или Пользователей, нарушающих требования Соглашения.</p>\r\n<p style=\"text-align: justify;\"><strong>5.7.</strong> Администрация веб-сайта так же не несет ответственности за:</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp;5.7.1.</strong>&nbsp; Задержки или сбои в процессе совершения операции, возникшие вследствие непреодолимой силы, а также любого случая неполадок в телекоммуникационных, компьютерных, электрических и иных смежных системах.</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp;5.7.2.</strong> Действия систем переводов, банков, платежных систем и за задержки связанные с их работой.</p>\r\n<p style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp;5.7.3.</strong> Надлежащее функционирование Сайта, в случае, если Пользователь не имеет необходимых технических средств, для его использования, а также не несет никаких обязательств по обеспечению пользователей такими средствами.</p>\r\n<h3 style=\"text-align: justify;\"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 6. Исключительные права</strong></h3>\r\n<p style=\"text-align: justify;\"><strong>6.1.</strong> Все объекты, доступные с помощью сервисов Сайта alior.uz в том числе элементы дизайна, текст, графические изображения, иллюстрации, видео, программы для ЭВМ, базы данных, музыка, звуки и другие объекты (далее - содержание сервисов), а также любой контент, размещенный на веб-сайте alior.uz, являются объектами исключительных прав Администрации, Пользователей и других правообладателей.</p>\r\n<p style=\"text-align: justify;\"><strong>6.2.</strong>&nbsp;Все возможные споры, вытекающие из настоящего Соглашения или связанные с ним, подлежат разрешению в соответствии с действующим законодательством Республики Узбекистан.</p>\r\n<p style=\"text-align: justify;\"><strong>6.3.</strong> Использование контента, а также любых других элементов сервисов возможно только в рамках функционала, предлагаемого тем или иным сервисом. Никакие элементы содержания сервисов Сайта alior.uz, а также любой контент, размещенный на сервисах Сайта alior.uz не могут быть использованы иным образом без предварительного разрешения / согласия правообладателя. Под использованием подразумеваются, в том числе: воспроизведение, копирование, переработка, распространение на любой основе, отображение во фрейме и так далее. Исключение составляют случаи, прямо предусмотренные законодательством Республики Узбекистан. Использование Пользователем элементов содержания сервиса, а также любого контента для личного некоммерческого использования, допускается при условии сохранения всех знаков охраны авторского права, смежных прав, товарных знаков, других уведомлений об авторстве, сохранения имени или псевдонима, автора наименования правообладателя в неизменном виде, сохранении соответствующего объекта в неизменном виде. Исключение составляют случаи, прямо предусмотренные законодательством Республики Узбекистан.</p>\r\n<p style=\"text-align: justify;\"><strong>6.4.</strong> По всем вопросам относительно прав, а также с другими вопросами и предложениями Вы можете связаться с нами.&nbsp;</p>\r\n<p style=\"text-align: justify;\">&nbsp;</p>', 10, 1537440313, 1540360664, 2, 0, NULL),
(10, 'usloviya-prodazhi', 'Условия Продажи', '', '', '', 10, 1537440546, 1537440546, 2, 0, NULL),
(11, 'kak-kupit-tovar', 'Как купить товар?', '', '', '', NULL, 1537440595, 1537440595, 2, 0, NULL),
(12, 'vozvrat-tovara', 'Возврат товара', '', '', '', 10, 1537440640, 1537440640, 2, 0, NULL),
(13, 'kak-prodat-tovar', 'Как продать товар?', '', '', '', 10, 1537440693, 1537440693, 2, 0, NULL),
(14, 'reklama-na-sayte', 'Реклама на сайте', '', '', '', 10, 1537441014, 1537441014, 2, 0, NULL),
(15, 'kommercheskoe-predlozhenie', 'Коммерческое предложение', '', '', '<p class=\"MsoNormal\" style=\"text-align: center;\"><span style=\"font-size: 12.0pt; line-height: 115%;\"><span style=\"mso-spacerun: yes;\">&nbsp; &nbsp;<img src=\"/uploads/2018/10/336.jpg\" alt=\"alior\" width=\"244\" height=\"195\" /></span></span><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-language: RU; mso-no-proof: yes;\"><!--[endif]--></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: center;\" align=\"center\"><span style=\"font-size: 12.0pt; line-height: 115%;\">Коммерческое предложение</span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-indent: 35.4pt;\"><span style=\"font-size: 12.0pt; line-height: 115%;\">OOO &ldquo;GULASIOB&rdquo; под торговой маркой alior.uz создал, торговую интернет площадку, где каждый желающий может продавать товары по всей Республики Узбекистан, при этом повысив уровень своих продаж. Наша компания учитывала все нюансы и проблемы связанные с торговлей и нашла наиболее, оптимальный вариант. </span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 35.4pt;\"><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">alior</span><span style=\"font-size: 12.0pt; line-height: 115%;\">.</span><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">uz</span> <span style=\"font-size: 12.0pt; line-height: 115%;\">предлагает:</span></p>\r\n<p class=\"MsoListParagraphCxSpFirst\" style=\"margin-left: 71.4pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; font-family: Wingdings; mso-fareast-font-family: Wingdings; mso-bidi-font-family: Wingdings;\"><span style=\"mso-list: Ignore;\">&uuml;<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Повысить уровень продаж от 20% до 80% благодаря размещению товаров, на нашем веб-сайте</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-left: 71.4pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; font-family: Wingdings; mso-fareast-font-family: Wingdings; mso-bidi-font-family: Wingdings;\"><span style=\"mso-list: Ignore;\">&uuml;<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Сэкономить время и деньги на составление заказов и доставок </span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-left: 71.4pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; font-family: Wingdings; mso-fareast-font-family: Wingdings; mso-bidi-font-family: Wingdings;\"><span style=\"mso-list: Ignore;\">&uuml;<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Сэкономьте до 30% рекламного бюджета без потери объёма продаж</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"margin-left: 71.4pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; font-family: Wingdings; mso-fareast-font-family: Wingdings; mso-bidi-font-family: Wingdings;\"><span style=\"mso-list: Ignore;\">&uuml;<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Индивидуальный подход к каждому клиенту</span></p>\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"margin-left: 71.4pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; font-family: Wingdings; mso-fareast-font-family: Wingdings; mso-bidi-font-family: Wingdings;\"><span style=\"mso-list: Ignore;\">&uuml;<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Вы не плотите фиксированную зарплату, а плотите только по факту продаж</span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 12.0pt; line-height: 115%;\"><span style=\"mso-spacerun: yes;\">&nbsp;&nbsp;&nbsp;&nbsp; </span>Учитывая быстро развивающуюся динамику электронных продаж по всему миру, мы решили создать свою торговую площадку, где любой продавец смог бы пользоваться и увеличивать свой объём продаж. <span style=\"mso-spacerun: yes;\">&nbsp;</span>Для быстрого и удобного пользования сайтом для наших клиентов, оформление сайта составлено командой профессиональных программистов для использования на интуитивной основе. <strong style=\"mso-bidi-font-weight: normal;\">В связи с этим мы предлагаем Вам быть в числе первых и обогнать своих конкурентов, чем догонять их</strong>. <span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size: 12.0pt; line-height: 115%;\">Для регистрации на сайте Вам необходимо предоставить пакет документов (Только для юридических лиц)</span><span style=\"font-size: 12.0pt; line-height: 115%;\">. В пакет документов входит: Гувохнома, копия паспорта, лицензия, сертификат, далолатнома, справка с налоговой, договор инкассации, и другие документы при необходимости. Здесь предоставлены общий пакет документов, соответственно у каждого предпринимателя свой пакет документов в зависимости от вида деятельности. После юридических формальностей Вам необходимо зарегистрироваться на сайте </span><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">alior</span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%;\">.</span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">uz</span></strong><span style=\"font-size: 12.0pt; line-height: 115%;\"> и подтвердить авторизацию через свой </span><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">E</span><span style=\"font-size: 12.0pt; line-height: 115%;\">-</span><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">mail</span><span style=\"font-size: 12.0pt; line-height: 115%;\"> адрес. При регистрации сайт автоматически сгенерирует вам </span><span lang=\"EN-US\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">ID</span><span style=\"font-size: 12.0pt; line-height: 115%;\"> номер, который будет являться в будущем вашим логином (надо его запомнить или записать). </span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\">&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 12.0pt; line-height: 115%;\"><span style=\"mso-tab-count: 1;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Для дополнительной информации</span>, обращайтесь по номеру (90) 603-90-80, (93)994-35-53, будем рады помочь и ответим на Ваши вопросы! <span style=\"mso-spacerun: yes;\">&nbsp;</span><span style=\"mso-spacerun: yes;\">&nbsp;</span></span></p>', 10, 1538054199, 1540198735, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '5', 1538044990),
('client', '10', 1540207288),
('client', '11', 1550636042),
('client', '12', 1550636313),
('client', '15', 1550636471),
('client', '16', 1550637438),
('client', '18', 1550637574),
('client', '19', 1550638104),
('client', '20', 1550640167),
('client', '21', 1550640344),
('client', '22', 1550642233),
('client', '23', 1550642339),
('client', '4', 1538042650),
('client', '7', 1538714093),
('client', '9', 1540205581),
('client_juridical', '24', 1551027841),
('client_juridical', '25', 1551068163),
('client_juridical', '3', 1538026095),
('client_juridical', '8', 1538825209),
('regional_managers', '6', 1538055730),
('super_admin', '2', 1533699575);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/confirm', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/login', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/logout', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/orders', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/orderview', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/account/signup', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/assignment/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/assignment/assign', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/assignment/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/assignment/revoke', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/assignment/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/default/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/default/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/menu/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/assign', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/remove', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/permission/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/assign', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/remove', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/role/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/assign', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/refresh', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/route/remove', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/rule/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/activate', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/change-password', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/login', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/logout', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/request-password-reset', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/reset-password', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/signup', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/admin/user/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/admins/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/admins/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/admins/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/admins/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/admins/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/agent/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/agent/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/agent/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/agent/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/agent/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/item', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/category/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/client/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/client/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/client/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/client/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/client/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/clientjuridical/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/clientjuridical/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/clientjuridical/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/clientjuridical/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/clientjuridical/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/courier/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/courier/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/courier/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/courier/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/courier/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/default/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/default/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/employees/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manager/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manager/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manager/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manager/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manager/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manufacturer/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manufacturer/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manufacturer/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manufacturer/index', 2, NULL, NULL, NULL, 1525621333, 1525621333),
('/administration/manufacturer/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/manufacturer/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/orders/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/paymethod/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/deleteimg', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/setmain', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/slug', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/product/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/regmanager/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/regmanager/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/regmanager/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/regmanager/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/regmanager/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/reviews/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/sklad/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/create', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/delete', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/update', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/administration/unit/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/addtocart', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/checkout', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/clearcart', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/dellitem', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/cart/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/db-explain', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/download-mail', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/toolbar', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/default/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/user/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/user/reset-identity', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/debug/user/set-identity', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/action', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/diff', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/preview', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/gii/default/view', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/main/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/main/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/product/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/product/category', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/product/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/product/quikview', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/product/slug', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/about', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/captcha', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/contact', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/error', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/site/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/default/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/default/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/images/*', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/images/image-by-item-and-alias', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/images/index', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('/yii2images/images/test-test', 2, NULL, NULL, NULL, 1525852696, 1525852696),
('admin', 1, 'Администратор', NULL, NULL, 1523186169, 1523186169),
('agent', 1, 'Агенты', NULL, NULL, 1523186259, 1523186259),
('buxgalter', 1, 'кабинет бухгалтера', NULL, NULL, 1523186199, 1523186199),
('client', 1, 'Физическое лицо', NULL, NULL, 1523186359, 1529183954),
('client_juridical', 1, 'Юридическое лицо', NULL, NULL, 1523186402, 1529183937),
('isAgentOrder', 2, 'Ushbu order rostan ham shu agentnikimi?', 'isAgentPradaja', NULL, 1527069597, 1527069597),
('IsCommentMe', 2, NULL, 'IsCommentMe', NULL, 1529215062, 1529215522),
('IsCourierClient', 2, 'IsCourierClient', 'isCourierClient', NULL, 1530273151, 1530273151),
('isParentRegmanager', 2, 'Regional manager o\'zining managerlarni tahrirlash va o\'chirish', 'isParentRegmanager', NULL, 1526037324, 1526037324),
('IsRegion', 2, 'Bu pravela qaysidir userni qaysidir regionga tegishli ekanligini ko\'rsatib turadi ', 'IsRegion', NULL, 1532024377, 1532024529),
('IsRegManager', 2, 'Regional manager huquqlari', 'isRegionalManager', NULL, 1525620537, 1525852501),
('isRegProduct', 2, 's', 'isRegProduct', NULL, 1537589476, 1537589476),
('isRulePradaja', 2, 'Pradaja bo\'limoining hquuqlari', 'isRulePradaja', NULL, 1526031315, 1526031785),
('IsSellerOrder', 2, 'Rostan ham Sotuvchininig zakazimi?', 'IsSellerOrder', NULL, 1550933994, 1550933994),
('IsUserOrder', 2, 'Rostan ham ushbu zakaz userga tegishlimi?', 'IsUserOrder', NULL, 1550935149, 1550935149),
('IsUserProduct', 2, 'Bu rule tavar foydalanuvchiga tegishli ekanligini tekshiradi', 'IsUserProduct', NULL, 1550686395, 1550686395),
('manager', 1, 'Менеджеры', NULL, NULL, 1523186229, 1523186229),
('ProfileParentUser', 2, 'Profileni uzi yaratgan busa ', 'isParentProfile', NULL, 1526041554, 1526041554),
('regional_managers', 1, 'Региональные менеджеры', NULL, NULL, 1523186240, 1525852927),
('super_admin', 1, 'Супер администратор	', NULL, NULL, 1523186157, 1523186157),
('сouriers', 1, 'Курьеры', NULL, NULL, 1523186268, 1523186268);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'IsRegion'),
('admin', 'isRegProduct'),
('admin', 'IsSellerOrder'),
('admin', 'IsUserOrder'),
('admin', 'IsUserProduct'),
('agent', 'IsCommentMe'),
('agent', 'IsRegion'),
('agent', 'IsSellerOrder'),
('agent', 'IsUserProduct'),
('buxgalter', 'IsRegion'),
('buxgalter', 'isRegProduct'),
('buxgalter', 'IsSellerOrder'),
('buxgalter', 'IsUserOrder'),
('buxgalter', 'IsUserProduct'),
('client', 'IsSellerOrder'),
('client', 'IsUserOrder'),
('client', 'IsUserProduct'),
('client_juridical', 'IsSellerOrder'),
('client_juridical', 'IsUserOrder'),
('client_juridical', 'IsUserProduct'),
('IsRegManager', '/administration/manager/*'),
('IsRegManager', '/administration/manager/create'),
('IsRegManager', '/administration/manager/index'),
('IsRegManager', '/administration/manager/update'),
('IsRegManager', '/administration/manager/view'),
('IsRegManager', '/administration/manufacturer/index'),
('manager', 'IsRegion'),
('manager', 'isRegProduct'),
('manager', 'IsSellerOrder'),
('manager', 'IsUserOrder'),
('manager', 'IsUserProduct'),
('manager', 'ProfileParentUser'),
('regional_managers', '/administration/manager/*'),
('regional_managers', 'isParentRegmanager'),
('regional_managers', 'IsRegion'),
('regional_managers', 'IsRegManager'),
('regional_managers', 'isRulePradaja'),
('regional_managers', 'IsUserOrder'),
('regional_managers', 'IsUserProduct'),
('regional_managers', 'ProfileParentUser'),
('super_admin', '/administration/manufacturer/index'),
('super_admin', 'IsSellerOrder'),
('super_admin', 'IsUserOrder'),
('super_admin', 'IsUserProduct'),
('сouriers', 'IsCourierClient'),
('сouriers', 'IsRegion'),
('сouriers', 'IsSellerOrder'),
('сouriers', 'IsUserOrder'),
('сouriers', 'IsUserProduct');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAgentPradaja', 0x4f3a32393a226170705c6d6f64656c735c72756c65735c4167656e7450726164616a61223a333a7b733a343a226e616d65223b733a31343a2269734167656e7450726164616a61223b733a393a22637265617465644174223b693a313532373036393533393b733a393a22757064617465644174223b693a313532373036393533393b7d, 1527069539, 1527069539),
('IsCommentMe', 0x4f3a33343a226170705c6d6f64656c735c72756c65735c6167656e745c4973436f6d6d656e744d65223a333a7b733a343a226e616d65223b733a31313a224973436f6d6d656e744d65223b733a393a22637265617465644174223b693a313532393138323234343b733a393a22757064617465644174223b693a313532393138323234343b7d, 1529182244, 1529182244),
('isCourierClient', 0x4f3a34303a226170705c6d6f64656c735c72756c65735c636f75726965725c6973436f7572696572436c69656e74223a333a7b733a343a226e616d65223b733a31353a226973436f7572696572436c69656e74223b733a393a22637265617465644174223b693a313533303237333131363b733a393a22757064617465644174223b693a313533303237333131363b7d, 1530273116, 1530273116),
('isParentProfile', 0x4f3a33343a226170705c6d6f64656c735c72756c65735c50726f66696c65506172656e7455736572223a333a7b733a343a226e616d65223b733a31353a226973506172656e7450726f66696c65223b733a393a22637265617465644174223b693a313532363034313532383b733a393a22757064617465644174223b693a313532363034313532383b7d, 1526041528, 1526041528),
('isParentRegmanager', 0x4f3a33393a226170705c6d6f64656c735c72756c65735c4d616e61676572466f725265676d616e616765725544223a333a7b733a343a226e616d65223b733a31383a226973506172656e745265676d616e61676572223b733a393a22637265617465644174223b693a313532363033373238383b733a393a22757064617465644174223b693a313532363033373238383b7d, 1526037288, 1526037288),
('IsRegion', 0x4f3a33343a226170705c6d6f64656c735c72756c65735c6973726567696f6e5c4973526567696f6e223a333a7b733a343a226e616d65223b733a383a224973526567696f6e223b733a393a22637265617465644174223b693a313533323032343330323b733a393a22757064617465644174223b693a313533323032343330323b7d, 1532024302, 1532024302),
('isRegionalManager', 0x4f3a32353a226170705c6d6f64656c735c5265676d616e6167657252756c65223a333a7b733a343a226e616d65223b733a31373a226973526567696f6e616c4d616e61676572223b733a393a22637265617465644174223b693a313532353835323431333b733a393a22757064617465644174223b693a313532353835323431333b7d, 1525852413, 1525852413),
('IsRegionManager', 0x4f3a34313a226170705c6d6f64656c735c72756c65735c6973726567696f6e5c4973526567696f6e4d616e61676572223a333a7b733a343a226e616d65223b733a31353a224973526567696f6e4d616e61676572223b733a393a22637265617465644174223b693a313533323032323131353b733a393a22757064617465644174223b693a313533323032323131353b7d, 1532022115, 1532022115),
('isRegProduct', 0x4f3a33383a226170705c6d6f64656c735c72756c65735c70726f647563745c526567696f6e50726f64756374223a333a7b733a343a226e616d65223b733a31323a22697352656750726f64756374223b733a393a22637265617465644174223b693a313533373538393433373b733a393a22757064617465644174223b693a313533373538393433373b7d, 1537589437, 1537589437),
('isRulePradaja', 0x4f3a32383a226170705c6d6f64656c735c72756c65735c50726164616a6152756c65223a333a7b733a343a226e616d65223b733a31333a22697352756c6550726164616a61223b733a393a22637265617465644174223b693a313532363033313237303b733a393a22757064617465644174223b693a313532363033313237303b7d, 1526031270, 1526031270),
('IsSellerOrder', 0x4f3a33363a226170705c6d6f64656c735c72756c65735c6f726465725c497353656c6c65724f72646572223a333a7b733a343a226e616d65223b733a31333a22497353656c6c65724f72646572223b733a393a22637265617465644174223b693a313535303933333936333b733a393a22757064617465644174223b693a313535303933333936333b7d, 1550933963, 1550933963),
('IsUserOrder', 0x4f3a33343a226170705c6d6f64656c735c72756c65735c6f726465725c4973557365724f72646572223a333a7b733a343a226e616d65223b733a31313a224973557365724f72646572223b733a393a22637265617465644174223b693a313535303933353133303b733a393a22757064617465644174223b693a313535303933353133303b7d, 1550935130, 1550935130),
('IsUserProduct', 0x4f3a33383a226170705c6d6f64656c735c72756c65735c70726f647563745c49735573657250726f64756374223a333a7b733a343a226e616d65223b733a31333a2249735573657250726f64756374223b733a393a22637265617465644174223b693a313535303638363335313b733a393a22757064617465644174223b693a313535303638363335313b7d, 1550686351, 1550686351);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(155) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text,
  `image` text,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `code`, `slug`, `text`, `image`, `sort`) VALUES
(6, NULL, 'Всё для дома и офиса', '', 'vse-dlya-doma-i-ofisa', '', '', NULL),
(7, NULL, 'Продукты питания', '', 'produkty-pitaniya', '', '', NULL),
(8, NULL, 'Мода', '', 'moda', '', '', NULL),
(9, NULL, 'Транспорт', '', 'transport', '', '', NULL),
(10, NULL, 'Электроника', '', 'elektronika', '', '', NULL),
(11, NULL, 'Недвижимость', '', 'nedvizhimost', '', '', NULL),
(12, NULL, 'Для бизнеса', '', 'dlya-biznesa', '', '', NULL),
(13, NULL, 'Предметы искусства ', '', 'predmety-iskusstva', '', '', NULL),
(14, NULL, 'Отдых и Туризм', '', 'otdyh-i-turizm', '', '', NULL),
(15, NULL, 'Услуги', '', 'uslugi', '', '', NULL),
(16, 10, 'Техника', '', 'tehnika', '', '', NULL),
(17, 6, 'Бытовая химия ', '', 'bytovaya-himiya', '', '', NULL),
(18, 6, 'Для сада', '', 'dlya-sada', '', '', NULL),
(19, 6, 'Мебель', '', 'mebel', '', '', NULL),
(20, 6, 'Канцелярская', '', 'kancelyarskaya', '', '', NULL),
(21, 6, 'Хозяйственные материалы', '', 'hozyaystvennye-materialy', '', '', NULL),
(22, 6, 'Строительные материалы', '', 'stroitelnye-materialy', '', '', NULL),
(23, 16, 'Холодильник', '', 'holodilnik', '', '', NULL),
(24, 16, 'Стиральная машина', '', 'stiralnaya-mashina', '', '', NULL),
(25, 16, 'Телевизор', '', 'televizor', '', '', NULL),
(26, 16, 'Микроволновая печь', '', 'mikrovolnovaya-pech', '', '', NULL),
(27, 16, 'Газовая плита', '', 'gazovaya-plita', '', '', NULL),
(28, 16, 'Кондиционер', '', 'kondicioner', '', '', NULL),
(31, 16, 'Утюг', '', 'utyug', '', '', NULL),
(32, 16, 'Швейная машина', '', 'shveynaya-mashina', '', '', NULL),
(33, 16, 'Миксер', '', 'mikser', '', '', NULL),
(34, 16, 'Соковыжималка', '', 'sokovyzhimalka', '', '', NULL),
(35, 16, 'Пылесос', '', 'pylesos', '', '', NULL),
(36, 16, 'Печи', '', 'pechi', '', '', NULL),
(37, 16, 'Аристон', '', 'ariston', '', '', NULL),
(38, 16, 'Другие ', '', 'drugie', '', '', NULL),
(39, 17, 'Стиральный порошок', '', 'stiralnyy-poroshok', '', '', NULL),
(40, 17, 'Чистящие средства', '', 'chistyaschie-sredstva', '', '', NULL),
(41, 17, 'Мыло ', '', 'mylo', '', '', NULL),
(43, 17, 'Другие ', '', 'drugie-2', '', '', NULL),
(44, 6, 'Сантехника', '', 'santehnika', '', '', NULL),
(45, 6, 'Ковёр', '', 'kover', '', '', NULL),
(46, 18, 'Цветы', '', 'cvety', '', '', NULL),
(47, 18, 'Деревья', '', 'derevya', '', '', NULL),
(48, 18, 'Удобрение', '', 'udobrenie', '', '', NULL),
(49, 18, 'Другие ', '', 'drugie-3', '', '', NULL),
(50, 19, 'Для дома', '', 'dlya-doma', '', '', NULL),
(51, 19, 'для сада ', '', 'dlya-sada-2', '', '', NULL),
(52, 19, 'Для офиса ', '', 'dlya-ofisa', '', '', NULL),
(53, 19, 'Другие ', '', 'drugie-4', '', '', NULL),
(54, 20, 'Ручка', '', 'ruchka', '', '', NULL),
(55, 20, 'Карандаш', '', 'karandash', '', '', NULL),
(56, 20, 'Фломастер', '', 'flomaster', '', '', NULL),
(57, 20, 'Бумага', '', 'bumaga', '', '', NULL),
(58, 20, 'Тетрадь', '', 'tetrad', '', '', NULL),
(59, 20, 'Ножницы', '', 'nozhnicy', '', '', NULL),
(60, 20, 'Клей ', '', 'kley', '', '', NULL),
(61, 20, 'Линейка', '', 'lineyka', '', '', NULL),
(62, 20, 'Пенал', '', 'penal', '', '', NULL),
(63, 20, 'Стиплер', '', 'stipler', '', '', NULL),
(64, 20, 'Папка', '', 'papka', '', '', NULL),
(65, 20, 'Резинка', '', 'rezinka', '', '', NULL),
(66, 20, 'Скотч ', '', 'skotch', '', '', NULL),
(67, 20, 'Другие ', '', 'drugie-5', '', '', NULL),
(68, 21, 'Лампочка', '', 'lampochka', '', '', NULL),
(69, 21, 'Щётка', '', 'schetka', '', '', NULL),
(70, 21, 'Обои', '', 'oboi', '', '', NULL),
(71, 21, 'Розетка', '', 'rozetka', '', '', NULL),
(72, 21, 'Включатель', '', 'vklyuchatel', '', '', NULL),
(73, 21, 'Люстра', '', 'lyustra', '', '', NULL),
(74, 21, 'Целлофан', '', 'cellofan', '', '', NULL),
(75, 21, 'Ножи', '', 'nozhi', '', '', NULL),
(76, 21, 'Вилка', '', 'vilka', '', '', NULL),
(77, 21, 'Ложка', '', 'lozhka', '', '', NULL),
(78, 21, 'Тарелка', '', 'tarelka', '', '', NULL),
(79, 21, 'Косушка', '', 'kosushka', '', '', NULL),
(80, 21, 'Пиала', '', 'piala', '', '', NULL),
(81, 21, 'Чайник', '', 'chaynik', '', '', NULL),
(82, 21, 'Бакал', '', 'bakal', '', '', NULL),
(83, 21, 'Стакан', '', 'stakan', '', '', NULL),
(84, 21, 'Салфетка', '', 'salfetka', '', '', NULL),
(85, 21, 'Подставка', '', 'podstavka', '', '', NULL),
(86, 21, 'Полотенце', '', 'polotence', '', '', NULL),
(87, 21, 'Ковш', '', 'kovsh', '', '', NULL),
(88, 21, 'Другие ', '', 'drugie-6', '', '', NULL),
(89, 22, 'Краска', '', 'kraska', '', '', NULL),
(90, 22, 'Кабель', '', 'kabel', '', '', NULL),
(91, 22, 'Песок', '', 'pesok', '', '', NULL),
(92, 22, 'Гравий ', '', 'graviy', '', '', NULL),
(93, 22, 'Щебень', '', 'scheben', '', '', NULL),
(94, 22, 'Кирпич ', '', 'kirpich', '', '', NULL),
(95, 22, 'Цемент', '', 'cement', '', '', NULL),
(96, 22, 'Кафель', '', 'kafel', '', '', NULL),
(97, 22, 'Мрамор', '', 'mramor', '', '', NULL),
(98, 22, 'Плитка', '', 'plitka', '', '', NULL),
(99, 22, 'Двери', '', 'dveri', '', '', NULL),
(100, 22, 'Окно', '', 'okno', '', '', NULL),
(101, 22, 'Линолеум', '', 'linoleum', '', '', NULL),
(102, 22, 'Паркет', '', 'parket', '', '', NULL),
(103, 22, 'Доски', '', 'doski', '', '', NULL),
(104, 22, 'Арматура', '', 'armatura', '', '', NULL),
(105, 22, 'Другие ', '', 'drugie-7', '', '', NULL),
(106, 7, 'Мясная продукция', '', 'myasnaya-produkciya', '', '', NULL),
(107, 7, 'Морепродукты', '', 'moreprodukty', '', '', NULL),
(108, 7, 'Молочная продукция', '', 'molochnaya-produkciya', '', '', NULL),
(109, 7, 'Консервы', '', 'konservy', '', '', NULL),
(110, 7, 'Мука и продукция из неё', '', 'muka-i-produkciya-iz-nee', '', '', NULL),
(111, 7, 'Сладости', '', 'sladosti', '', '', NULL),
(112, 7, 'Вода Напитки Соки', '', 'voda', '', '', NULL),
(113, 7, 'Приправа', '', 'priprava', '', '', NULL),
(114, 7, 'Детское питание', '', 'detskoe-pitanie', '', '', NULL),
(115, 7, 'Кофе', '', 'kofe', '', '', NULL),
(116, 7, 'Яйца', '', 'yayca', '', '', NULL),
(117, 7, 'Майонез и Кетчуп', '', 'mayonez-i-ketchup', '', '', NULL),
(118, 7, 'Масло', '', 'maslo', '', '', NULL),
(119, 7, 'Другие ', '', 'drugie-8', '', '', NULL),
(120, 106, 'Говядина', '', 'govyadina', '', '', NULL),
(121, 106, 'Баранина', '', 'baranina', '', '', NULL),
(122, 106, 'Бройлеры', '', 'broylery', '', '', NULL),
(123, 106, 'Окорочка', '', 'okorochka', '', '', NULL),
(124, 106, 'Индейка  ', '', 'indeyka', '', '', NULL),
(125, 106, 'Кролик', '', 'krolik', '', '', NULL),
(126, 108, 'Молоко', '', 'moloko', '', '', NULL),
(127, 108, 'Кефир', '', 'kefir', '', '', NULL),
(128, 108, 'Творог', '', 'tvorog', '', '', NULL),
(129, 108, 'Сметана', '', 'smetana', '', '', NULL),
(130, 108, 'Каймак', '', 'kaymak', '', '', NULL),
(131, 108, 'Сыр', '', 'syr', '', '', NULL),
(132, 108, 'Другие ', '', 'drugie-9', '', '', NULL),
(133, 110, 'Хлебобулочная продукция', '', 'hlebobulochnaya-produkciya', '', '', NULL),
(134, 110, 'Макаронные изделия', '', 'makaronnye-izdeliya', '', '', NULL),
(135, 110, 'Тесто', '', 'testo', '', '', NULL),
(136, 110, 'Мука', '', 'muka', '', '', NULL),
(137, 110, 'Другие ', '', 'drugie-10', '', '', NULL),
(138, 133, 'Буханка', '', 'buhanka', '', '', NULL),
(139, 133, 'Чап-Чак', '', 'chap-chak', '', '', NULL),
(140, 133, 'Лепёшки', '', 'lepeshki', '', '', NULL),
(141, 133, 'Булочки', '', 'bulochki', '', '', NULL),
(142, 133, 'Фатир', '', 'fatir', '', '', NULL),
(143, 133, 'Пита', '', 'pita', '', '', NULL),
(144, 133, 'Лаваш', '', 'lavash', '', '', NULL),
(145, 133, 'Другие ', '', 'drugie-11', '', '', NULL),
(146, 111, 'Сахар', '', 'sahar', '', '', NULL),
(147, 111, 'Торты', '', 'torty', '', '', NULL),
(148, 111, 'Печённое', '', 'pechennoe', '', '', NULL),
(149, 111, 'Конфеты', '', 'konfety', '', '', NULL),
(150, 111, 'Шоколад', '', 'shokolad', '', '', NULL),
(151, 111, 'Навад', '', 'navad', '', '', NULL),
(152, 111, 'Печенье', '', 'pechene', '', '', NULL),
(153, 111, 'Вафли', '', 'vafli', '', '', NULL),
(154, 111, 'Пряники', '', 'pryaniki', '', '', NULL),
(155, 111, 'Другие ', '', 'drugie-12', '', '', NULL),
(156, 113, 'Красный перец', '', 'krasnyy-perec', '', '', NULL),
(157, 113, 'Чёрный перец', '', 'chernyy-perec', '', '', NULL),
(158, 113, 'Зира', '', 'zira', '', '', NULL),
(159, 113, 'Другие ', '', 'drugie-13', '', '', NULL),
(160, 118, 'Сливочное масло', '', 'slivochnoe-maslo', '', '', NULL),
(161, 118, 'Растительное масло', '', 'rastitelnoe-maslo', '', '', NULL),
(162, 118, 'Другие ', '', 'drugie-14', '', '', NULL),
(163, 7, 'Соль', '', 'sol', '', '', NULL),
(164, 7, 'Чай', '', 'chay', '', '', NULL),
(165, 7, 'Сельхоз продукты', '', 'selhoz-produkty', '', '', NULL),
(166, 7, 'Цитрусовые', '', 'citrusovye', '', '', NULL),
(167, 7, 'Сухофрукты', '', 'suhofrukty', '', '', NULL),
(168, 165, 'Маш', '', 'mash', '', '', NULL),
(169, 165, 'Рис', '', 'ris', '', '', NULL),
(170, 165, 'Крупа', '', 'krupa', '', '', NULL),
(171, 165, 'Горох', '', 'goroh', '', '', NULL),
(172, 165, 'Фасоль', '', 'fasol', '', '', NULL),
(173, 165, 'Орехи', '', 'orehi', '', '', NULL),
(174, 165, 'Кукуруз', '', 'kukuruz', '', '', NULL),
(175, 165, 'Другие ', '', 'drugie-15', '', '', NULL),
(176, 8, 'Для мужчин', '', 'dlya-muzhchin', '', '', NULL),
(177, 8, 'Для женщин', '', 'dlya-zhenschin', '', '', NULL),
(178, 8, 'Для детей', '', 'dlya-detey', '', '', NULL),
(179, 8, 'Украшения', '', 'ukrasheniya', '', '', NULL),
(180, 8, 'Парфюмерия ', '', 'parfyumeriya', '', '', NULL),
(181, 176, 'Туфли', '', 'tufli', '', '', NULL),
(182, 176, 'Тапочки', '', 'tapochki', '', '', NULL),
(183, 176, 'Носки', '', 'noski', '', '', NULL),
(184, 176, 'Шорты', '', 'shorty', '', '', NULL),
(185, 176, 'Брюки', '', 'bryuki', '', '', NULL),
(186, 176, 'Ремень', '', 'remen', '', '', NULL),
(187, 176, 'Майка', '', 'mayka', '', '', NULL),
(188, 176, 'Рубашка', '', 'rubashka', '', '', NULL),
(189, 176, 'Костюм', '', 'kostyum', '', '', NULL),
(190, 176, 'Костюм брюки  ', '', 'kostyum-bryuki', '', '', NULL),
(191, 176, 'Куртка', '', 'kurtka', '', '', NULL),
(192, 176, 'Пальто', '', 'palto', '', '', NULL),
(193, 176, ' Плащ', '', 'plasch', '', '', NULL),
(194, 176, 'Головной убор', '', 'shapka', '', '', NULL),
(195, 176, 'Спортивная одежда      ', '', 'sportivnaya-odezhda', '', '', NULL),
(196, 8, 'Очки', '', 'ochki', '', '', NULL),
(197, 8, 'Другие ', '', 'drugie-16', '', '', NULL),
(198, 176, 'Другие ', '', 'drugie-17', '', '', NULL),
(199, 177, 'Туфли', '', 'tufli-2', '', '', NULL),
(200, 177, 'Тапочки', '', 'tapochki-2', '', '', NULL),
(201, 177, 'Носки', '', 'noski-2', '', '', NULL),
(202, 177, 'Колготки', '', 'kolgotki', '', '', NULL),
(203, 177, 'Шорты', '', 'shorty-2', '', '', NULL),
(204, 177, 'Брюки', '', 'bryuki-2', '', '', NULL),
(205, 177, 'Юбка', '', 'yubka', '', '', NULL),
(206, 177, 'Рубашка', '', 'rubashka-2', '', '', NULL),
(207, 177, 'Платье', '', 'plate', '', '', NULL),
(208, 177, 'Костюм', '', 'kostyum-2', '', '', NULL),
(209, 177, 'Костюм брюки  ', '', 'kostyum-bryuki-2', '', '', NULL),
(210, 177, 'Куртка', '', 'kurtka-2', '', '', NULL),
(211, 177, 'Пальто', '', 'palto-2', '', '', NULL),
(212, 177, ' Плащ', '', 'plasch-2', '', '', NULL),
(213, 177, 'Шуба', '', 'shuba', '', '', NULL),
(214, 177, 'Головной убор', '', 'golovnoy-ubor', '', '', NULL),
(215, 177, 'Спортивная одежда      ', '', 'sportivnaya-odezhda-2', '', '', NULL),
(216, 177, 'Другие ', '', 'drugie-18', '', '', NULL),
(217, 178, 'от 0 до 1 года', '', 'ot-0-do-1-goda', '', '', NULL),
(218, 178, 'от 1 до 3 лет', '', 'ot-1-do-3-let', '', '', NULL),
(219, 178, 'от 3 до 5 лет', '', 'ot-3-do-5-let', '', '', NULL),
(220, 178, 'от 5 до 8 лет', '', 'ot-5-do-8-let', '', '', NULL),
(221, 178, 'от 8 до 11 лет', '', 'ot-8-do-11-let', '', '', NULL),
(222, 178, 'от 11 до 16 лет', '', 'ot-11-do-16-let', '', '', NULL),
(223, 178, 'Подгузники', '', 'podguzniki', '', '', NULL),
(224, 178, 'Другие ', '', 'drugie-19', '', '', NULL),
(225, 179, 'Кольца', '', 'kolca', '', '', NULL),
(226, 179, 'Ожерелья', '', 'ozherelya', '', '', NULL),
(227, 179, 'Цепь', '', 'cep', '', '', NULL),
(228, 179, 'Серьги', '', 'sergi', '', '', NULL),
(229, 179, 'Другие ', '', 'drugie-20', '', '', NULL),
(230, 10, 'Телефоны и аксессуары', '', 'telefony-i-aksessuary', '', '', NULL),
(231, 10, 'Телевизоры и аксессуары', '', 'televizory-i-aksessuary', '', '', NULL),
(232, 10, 'Часы браслеты ', '', 'chasy-braslety', '', '', NULL),
(233, 10, 'Планшеты и аксессуары', '', 'planshety-i-aksessuary', '', '', NULL),
(234, 10, 'Аудиотехника', '', 'audiotehnika', '', '', NULL),
(235, 10, 'Видеотехника', '', 'videotehnika', '', '', NULL),
(236, 10, 'Фото и Видеокамеры', '', 'foto-i-videokamery', '', '', NULL),
(237, 10, 'Навигаторы', '', 'navigatory', '', '', NULL),
(238, 10, 'Компьютеры и комплектующие  ', '', 'kompyutery-i-komplektuyuschie', '', '', NULL),
(239, 10, 'игровые приставки и компьютеры', '', 'igrovye-pristavki-i-kompyutery', '', '', NULL),
(240, 10, 'оптические приборы', '', 'opticheskie-pribory', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatroom`
--

CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `sts` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chatroom`
--

INSERT INTO `chatroom` (`id`, `created_at`, `created_by`, `sts`) VALUES
(6, 2019, 6, 1),
(7, 2019, 2, 1),
(8, 2019, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `region_id` int(100) DEFAULT NULL,
  `sort_city` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `region_id`, `sort_city`) VALUES
(1, 'Джизак', 9, 1),
(3, 'Акташ', 11, NULL),
(4, 'Булунгур', 11, NULL),
(5, 'Чилек', 11, NULL),
(6, 'Дарбанд', 11, NULL),
(7, 'Джамбай', 11, NULL),
(8, 'Джума', 11, NULL),
(9, 'Гузалкент', 11, NULL),
(10, 'Гюлабад', 11, NULL),
(11, 'Иштыхан', 11, NULL),
(12, 'Каттакурган', 11, NULL),
(13, 'Кушрабад', 11, NULL),
(14, 'Лаиш', 11, NULL),
(15, 'Нурабад', 11, NULL),
(16, 'Пайарык', 11, NULL),
(17, 'Пайшанба', 11, NULL),
(18, 'Самарканд', 11, NULL),
(19, 'Тайлак', 11, NULL),
(20, 'Ургут', 11, NULL),
(21, 'Зиадин', 11, NULL),
(22, 'Акалтын', 2, NULL),
(23, 'Алтынкуль', 2, NULL),
(24, 'Андижан', 2, NULL),
(25, 'Асака', 2, NULL),
(26, 'Ахунбабаев', 2, NULL),
(27, 'Балыкчи', 2, NULL),
(28, 'Боз', 2, NULL),
(29, 'Булакбаши', 2, NULL),
(30, 'Карасу', 2, NULL),
(31, 'Куйганъяр', 2, NULL),
(32, 'Кургантепа', 2, NULL),
(33, 'Мархамат', 2, NULL),
(34, 'Пайтуг', 2, NULL),
(35, 'Пахтаабад', 2, NULL),
(36, 'Шахрихан', 2, NULL),
(37, 'Ханабад', 2, NULL),
(38, 'Ходжаабад', 2, NULL),
(39, 'Акмангит', 1, NULL),
(40, 'Беруни', 1, NULL),
(41, 'Бустан', 1, NULL),
(42, 'Чимбай', 1, NULL),
(43, 'Канлыкуль', 1, NULL),
(44, 'Караузяк', 1, NULL),
(45, 'Кегейли', 1, NULL),
(46, 'Кунград', 1, NULL),
(47, 'Мангит', 1, NULL),
(48, 'Муйнак', 1, NULL),
(49, 'Нукус', 1, NULL),
(50, 'Шуманай', 1, NULL),
(51, 'Тахиаташ', 1, NULL),
(52, 'Тахтакупыр', 1, NULL),
(53, 'Турткуль', 1, NULL),
(54, 'Ходжейли', 1, NULL),
(55, 'Алат', 5, NULL),
(56, 'Бухара', 5, NULL),
(57, 'Галаасия', 5, NULL),
(58, 'Газли', 5, NULL),
(59, 'Гиждуван', 5, NULL),
(60, 'Каган', 5, NULL),
(61, 'Каракуль', 5, NULL),
(62, 'Караулбазар', 5, NULL),
(63, 'Ромитан', 5, NULL),
(64, 'Шафиркан', 5, NULL),
(65, 'Вабкент', 5, NULL),
(66, 'Жондор', 5, NULL),
(67, 'Чартак', 3, NULL),
(68, 'Челак', 3, NULL),
(69, 'Чуст', 3, NULL),
(70, 'Джумашуй', 3, NULL),
(71, 'Касансай', 3, NULL),
(72, 'Наманган', 3, NULL),
(73, 'Пап', 3, NULL),
(74, 'Ташбулак', 3, NULL),
(75, 'Туракурган', 3, NULL),
(76, 'Учкурган', 3, NULL),
(77, 'Хаккулабад', 3, NULL),
(78, 'Алтыарык', 4, NULL),
(79, 'Багдад', 4, NULL),
(80, 'Бешарык', 4, NULL),
(81, 'Дангара', 4, NULL),
(82, 'Фергана', 4, NULL),
(83, 'Каканд', 4, NULL),
(84, 'Кува', 4, NULL),
(85, 'Кувасай', 4, NULL),
(86, 'Лангар', 4, NULL),
(87, 'Маргилан', 4, NULL),
(88, 'Навбахор', 4, NULL),
(89, 'Раван', 4, NULL),
(90, 'Риштан', 4, NULL),
(91, 'Шахимардан', 4, NULL),
(92, 'Ташлак', 4, NULL),
(93, 'Учкуприк', 4, NULL),
(94, 'Вуадиль', 4, NULL),
(95, 'Хамза', 4, NULL),
(96, 'Яйпан', 4, NULL),
(97, 'Янги Маргилан', 4, NULL),
(98, 'Янгикурган', 4, NULL),
(99, 'Язъяван', 4, NULL),
(100, 'Багат', 6, NULL),
(101, 'Чалыш', 6, NULL),
(102, 'Гурлен', 6, NULL),
(103, 'Караул', 6, NULL),
(104, 'Кошкупыр', 6, NULL),
(105, 'Питнак', 6, NULL),
(106, 'Шават', 6, NULL),
(107, 'Ургенч', 6, NULL),
(108, 'Ханка', 6, NULL),
(109, 'Хазарасп', 6, NULL),
(110, 'Хива', 6, NULL),
(111, 'Янгиарык', 6, NULL),
(112, 'Ангор', 7, NULL),
(113, 'Байсун', 7, NULL),
(114, 'Бандихон', 7, NULL),
(115, 'Денау', 7, NULL),
(116, 'Джаргурган', 7, NULL),
(117, 'Карлук', 7, NULL),
(118, 'Кизирик', 7, NULL),
(119, 'Кумкурган', 7, NULL),
(120, 'Музрабад', 7, NULL),
(121, 'Сариасия', 7, NULL),
(122, 'Сарык', 7, NULL),
(123, 'Шаргунь', 7, NULL),
(124, 'Шерабад', 7, NULL),
(125, 'Шурчи', 7, NULL),
(126, 'Термез', 7, NULL),
(127, 'Учкызыл', 7, NULL),
(128, 'Узун', 7, NULL),
(129, 'Халкабад', 7, NULL),
(130, 'Бешкент', 8, NULL),
(131, 'Чиракчи', 8, NULL),
(132, 'Дехканабад', 8, NULL),
(133, 'Гузар', 8, NULL),
(134, 'Камаши', 8, NULL),
(135, 'Карашина', 8, NULL),
(136, 'Карши', 8, NULL),
(137, 'Касан', 8, NULL),
(138, 'Касби', 8, NULL),
(139, 'Китаб', 8, NULL),
(140, 'Мубарек', 8, NULL),
(141, 'Муглан', 8, NULL),
(142, 'Шахрисабз', 8, NULL),
(143, 'Талимарджан', 8, NULL),
(144, 'Яккабаг', 8, NULL),
(145, 'Янги Миришкор', 8, NULL),
(146, 'Янги-Нишан', 8, NULL),
(147, 'Айдаркуль', 9, NULL),
(148, 'Баландчакир', 9, NULL),
(149, 'Даштобод', 9, NULL),
(150, 'Дустлик', 9, NULL),
(151, 'Гагарин', 9, NULL),
(152, 'Галлаарал', 9, NULL),
(153, 'Голиблар', 9, NULL),
(154, 'Марджанбулак', 9, NULL),
(155, 'Пахтакор', 9, NULL),
(156, 'Учтепа', 9, NULL),
(157, 'Усмат', 9, NULL),
(158, 'Янгикишлак', 9, NULL),
(159, 'Заамин', 9, NULL),
(160, 'Зафарабад', 9, NULL),
(161, 'Зарбдар', 9, NULL),
(162, 'Бешрабат', 10, NULL),
(163, 'Канимех', 10, NULL),
(164, 'Кармана', 10, NULL),
(165, 'Кызылтепа', 10, NULL),
(166, 'Навои', 10, NULL),
(167, 'Нурата', 10, NULL),
(168, 'Тамдыбулак', 10, NULL),
(169, 'Учкудук', 10, NULL),
(170, 'Янгирабат', 10, NULL),
(171, 'Зарафшан', 10, NULL),
(172, 'Бахт', 12, NULL),
(173, 'Баяут', 12, NULL),
(174, 'Сырдарья', 12, NULL),
(175, 'Гулистан', 12, NULL),
(176, 'Навруз', 12, NULL),
(177, 'Сайхун', 12, NULL),
(178, 'Сардоба', 12, NULL),
(179, 'Ширин', 12, NULL),
(181, 'Теренозек', 12, NULL),
(182, 'Хаваст', 12, NULL),
(183, 'Янгиер', 12, NULL),
(184, 'Янгиёр', 12, NULL),
(185, 'Аккурган', 13, NULL),
(186, 'Алмалык', 13, NULL),
(187, 'Ангрен', 13, NULL),
(188, 'Ахангаран', 13, NULL),
(189, 'Бекабад', 13, NULL),
(190, 'Чимган', 13, NULL),
(191, 'Бука', 13, NULL),
(192, 'Чарвак', 13, NULL),
(193, 'Чиназ', 13, NULL),
(194, 'Чирчик', 13, NULL),
(195, 'Сукок', 13, NULL),
(196, 'Дурмень', 13, NULL),
(197, 'Дустабат', 13, NULL),
(198, 'Эшангузар', 13, NULL),
(199, 'Газалкент', 13, NULL),
(200, 'Гульбахор', 13, NULL),
(201, 'Искандар', 13, NULL),
(202, 'Карасу', 13, NULL),
(203, 'Келес', 13, NULL),
(204, 'Кибрай', 13, NULL),
(205, 'Коксарай', 13, NULL),
(206, 'Красногорск', 13, NULL),
(207, 'Мирабад', 13, NULL),
(208, 'Назарбек', 13, NULL),
(209, 'Нурафшан', 13, NULL),
(210, 'Паркент', 13, NULL),
(211, 'Пскент', 13, NULL),
(212, 'Салар', 13, NULL),
(213, 'Ташкент', 13, NULL),
(214, 'Ташморе', 13, NULL),
(215, 'Туркестан', 13, NULL),
(216, 'Уртааул', 13, NULL),
(217, 'Ходжикент', 13, NULL),
(218, 'Янгиабад', 13, NULL),
(219, 'Янгибазар', 13, NULL),
(220, 'Янгиюль', 13, NULL),
(221, 'Зафар', 13, NULL),
(222, 'Зангиата', 13, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comment_profile`
--

CREATE TABLE `comment_profile` (
  `id` int(11) NOT NULL,
  `com_text` text CHARACTER SET utf8 NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_profile`
--

INSERT INTO `comment_profile` (`id`, `com_text`, `sts`, `created_at`, `updated_at`, `created_by`, `profile_id`) VALUES
(21, 'Владелец торговой площадки alior.uz', 1, 1538023708, 1538023708, 0, 43),
(22, 'Предприятие импортёр ', 1, 1538825209, 1538825209, 2, 8),
(23, '213123123', 1, 1540205581, 1540205581, 0, 9),
(24, '<script>var query = connection.query(\'DROP Table product function(err, results) {    });</script>', 1, 1540207288, 1540207288, 0, 10),
(25, 's', 1, 1550636471, 1550636471, 0, 15),
(26, 's', 1, 1550637437, 1550637437, 0, 16),
(27, 's', 1, 1550637574, 1550637574, 0, 18);

-- --------------------------------------------------------

--
-- Table structure for table `contact_our`
--

CREATE TABLE `contact_our` (
  `id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `theme_appeal` varchar(255) NOT NULL,
  `text_appeal` text NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courier_loaded_products`
--

CREATE TABLE `courier_loaded_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prname` varchar(200) NOT NULL,
  `product_price` decimal(19,2) NOT NULL,
  `price_item` decimal(19,2) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `qty_loaded` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `remnant` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courier_loaded_products`
--

INSERT INTO `courier_loaded_products` (`id`, `product_id`, `prname`, `product_price`, `price_item`, `courier_id`, `qty_loaded`, `qty`, `remnant`, `created_at`, `created_by`, `updated_by`, `status`, `updated_at`) VALUES
(5, 42, '??????? LG VK76A09NTCR', '1030050.00', '1030050.00', 39, 1, 1, 0, 1536929639, 10, 39, 2, 1536929678),
(6, 43, '?????????? ?????? LG F0J5NN4W', '3058000.00', '3058000.00', 39, 1, 1, 0, 1536929639, 10, 39, 2, 1536929678);

-- --------------------------------------------------------

--
-- Table structure for table `debitor`
--

CREATE TABLE `debitor` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `amount` double(19,2) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `repay_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_method`
--

CREATE TABLE `delivery_method` (
  `id` int(11) NOT NULL,
  `deliver_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `delevery_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_method`
--

INSERT INTO `delivery_method` (`id`, `deliver_name`, `status`, `delevery_type`) VALUES
(2, 'Самовывоз со склада', 1, 1),
(3, 'Доставка на дом (до склада)', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `discount_name` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `price_procent` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_mediafile`
--

CREATE TABLE `filemanager_mediafile` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `alt` text,
  `size` varchar(255) NOT NULL,
  `description` text,
  `thumbs` text,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filemanager_mediafile`
--

INSERT INTO `filemanager_mediafile` (`id`, `filename`, `type`, `url`, `alt`, `size`, `description`, `thumbs`, `created_at`, `updated_at`) VALUES
(1, '336.jpg', 'image/jpeg', '/uploads/2018/10/336.jpg', 'alior', '40726', '', 'a:3:{s:5:\"small\";s:30:\"/uploads/2018/10/336-small.jpg\";s:6:\"medium\";s:31:\"/uploads/2018/10/336-medium.jpg\";s:5:\"large\";s:30:\"/uploads/2018/10/336-large.jpg\";}', 1538659327, 1538659372),
(2, '62215-pobeg-4-sezon-15-seriya-going-undermp4snapshot322820180920161427.jpg', 'image/jpeg', '/uploads/2018/10/62215-pobeg-4-sezon-15-seriya-going-undermp4snapshot322820180920161427.jpg', NULL, '24059', NULL, 'a:3:{s:5:\"small\";s:97:\"/uploads/2018/10/62215-pobeg-4-sezon-15-seriya-going-undermp4snapshot322820180920161427-small.jpg\";s:6:\"medium\";s:98:\"/uploads/2018/10/62215-pobeg-4-sezon-15-seriya-going-undermp4snapshot322820180920161427-medium.jpg\";s:5:\"large\";s:97:\"/uploads/2018/10/62215-pobeg-4-sezon-15-seriya-going-undermp4snapshot322820180920161427-large.jpg\";}', 1538663512, NULL),
(3, '100001.png', 'image/png', '/uploads/2018/12/100001.png', '', '7475', '', 'a:3:{s:5:\"small\";s:33:\"/uploads/2018/12/100001-small.png\";s:6:\"medium\";s:34:\"/uploads/2018/12/100001-medium.png\";s:5:\"large\";s:33:\"/uploads/2018/12/100001-large.png\";}', 1545114172, 1545114190);

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_mediafile_tag`
--

CREATE TABLE `filemanager_mediafile_tag` (
  `mediafile_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_owners`
--

CREATE TABLE `filemanager_owners` (
  `mediafile_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `owner_attribute` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager_tag`
--

CREATE TABLE `filemanager_tag` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(11) DEFAULT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `name`) VALUES
(1, 'Products/Product1/92a3d3.png', 1, 1, 'Product', 'f175ad056f-1', ''),
(2, 'Products/Product2/943a08.png', 2, 1, 'Product', '978fccd702-1', ''),
(3, 'Products/Product3/d8b285.png', 3, 1, 'Product', '4b242ac74a-1', ''),
(4, 'Products/Product4/e88fed.png', 4, 1, 'Product', '05fa6b8182-1', ''),
(5, 'Products/Product5/28d7ed.png', 5, 1, 'Product', '4dc5600cc1-1', ''),
(6, 'Products/Product6/9a854f.png', 6, 1, 'Product', 'a6dc6723d3-1', ''),
(7, 'Products/Product7/955575.png', 7, 1, 'Product', 'aca88030b0-1', ''),
(10, 'Products/Product8/89b8ac.jpg', 8, 1, 'Product', '1fa29529e3-1', ''),
(11, 'Products/Product8/b91199.jpg', 8, NULL, 'Product', '84e57b3e1f-2', ''),
(12, 'Products/Product9/b094c1.jpg', 9, 1, 'Product', '13cc4f433c-1', ''),
(13, 'Products/Product9/9c463f.jpg', 9, NULL, 'Product', '6fbe953dc1-2', ''),
(14, 'Products/Product10/57ea84.jpg', 10, 1, 'Product', '5610e4e312-1', ''),
(15, 'Products/Product10/bbb57a.jpg', 10, NULL, 'Product', 'bf05c0c07d-2', ''),
(16, 'Products/Product11/db0b73.jpg', 11, 1, 'Product', 'bf2a82663f-1', ''),
(17, 'Products/Product11/cfd784.jpg', 11, NULL, 'Product', '50401edea5-2', ''),
(18, 'Products/Product12/cbbaf9.jpg', 12, 1, 'Product', '59e66b6601-1', ''),
(19, 'Products/Product13/b574ce.jpg', 13, 1, 'Product', 'bb27e40e3e-1', ''),
(20, 'Products/Product13/c2dbc6.jpg', 13, NULL, 'Product', '7cea07f158-2', ''),
(21, 'Products/Product14/c51352.jpg', 14, 1, 'Product', '568615c9c6-1', ''),
(22, 'Products/Product14/95e251.jpg', 14, NULL, 'Product', '950e913693-2', ''),
(23, 'Products/Product15/048c98.jpg', 15, 1, 'Product', '6c887db4fa-1', ''),
(24, 'Products/Product15/788c6b.jpg', 15, NULL, 'Product', '3b281c4a95-2', ''),
(25, 'Products/Product16/a417ea.jpg', 16, 1, 'Product', '3b5f6c2aa3-1', ''),
(26, 'Products/Product20/175caf.png', 20, 1, 'Product', 'd330719261-1', ''),
(27, 'Products/Product21/c25f7d.png', 21, 1, 'Product', '6e063fd2da-1', ''),
(28, 'Products/Product22/6cf658.jpg', 22, 1, 'Product', '440449b446-1', ''),
(29, 'Products/Product23/6ca5bd.jpg', 23, 1, 'Product', 'e165f7a87a-1', ''),
(31, 'Products/Product24/06ec11.png', 24, 1, 'Product', '12ced94540-1', ''),
(32, 'Products/Product25/6fe4e7.jpg', 25, 1, 'Product', '867c5feae8-1', ''),
(33, 'Products/Product26/c2c116.png', 26, 1, 'Product', 'bf3af50e8f-1', ''),
(34, 'Products/Product27/8affb1.png', 27, 1, 'Product', 'f0d4f65289-1', ''),
(35, 'Products/Product28/d9e61a.png', 28, 1, 'Product', '097973ef60-1', ''),
(36, 'Products/Product29/3f1d39.png', 29, 1, 'Product', '816ebfff54-1', ''),
(37, 'Products/Product30/f098d9.jpg', 30, 1, 'Product', '47c2288979-1', ''),
(38, 'Products/Product32/0cb10a.jpg', 32, 1, 'Product', '753546d69c-1', ''),
(39, 'Products/Product32/412849.jpg', 32, NULL, 'Product', '3aa093a4e2-2', ''),
(40, 'Products/Product32/cc1556.jpg', 32, NULL, 'Product', 'a2710c5abb-3', ''),
(41, 'Products/Product33/963e8c.jpg', 33, 1, 'Product', '0376f5d9ab-1', ''),
(42, 'Products/Product33/285b94.png', 33, NULL, 'Product', 'dce73c5564-2', ''),
(43, 'Products/Product33/848e3b.jpg', 33, NULL, 'Product', '324bf3329b-3', ''),
(44, 'Products/Product34/89e442.jpg', 34, 1, 'Product', 'a5c709bebf-1', ''),
(45, 'Products/Product34/ab2ba4.png', 34, NULL, 'Product', 'f1b6dc04ee-2', ''),
(46, 'Products/Product34/b22797.png', 34, NULL, 'Product', 'f73539732b-3', ''),
(47, 'Products/Product35/902bba.jpg', 35, 1, 'Product', 'db8bed90de-1', ''),
(48, 'Products/Product36/f6de0d.jpg', 36, 1, 'Product', '9e105e0dd2-1', ''),
(49, 'Products/Product37/76399f.jpg', 37, 1, 'Product', 'e5584c8dd5-1', ''),
(50, 'Products/Product37/0b30fb.jpg', 37, NULL, 'Product', '337c0e7466-2', ''),
(51, 'Products/Product37/07259e.jpg', 37, NULL, 'Product', '5419dfe879-3', ''),
(52, 'Products/Product38/0f3377.png', 38, 1, 'Product', 'e40b4752e7-1', ''),
(53, 'Products/Product38/699b21.jpg', 38, NULL, 'Product', '92900b50b3-2', ''),
(55, 'Products/Product40/f282a9.jpg', 40, 1, 'Product', '19f200cdde-1', ''),
(56, 'Products/Product41/0b354a.jpg', 41, 1, 'Product', '6ebf67e0cc-1', ''),
(57, 'Products/Product41/b58dab.jpg', 41, NULL, 'Product', 'c25ea24115-2', ''),
(58, 'Products/Product41/f76b67.jpg', 41, NULL, 'Product', 'aba67441fb-3', ''),
(59, 'Products/Product42/ceca58.jpg', 42, 1, 'Product', '61987c8dfb-1', '');

-- --------------------------------------------------------

--
-- Table structure for table `ImageManager`
--

CREATE TABLE `ImageManager` (
  `id` int(10) UNSIGNED NOT NULL,
  `fileName` varchar(128) NOT NULL,
  `fileHash` varchar(32) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `createdBy` int(10) UNSIGNED DEFAULT NULL,
  `modifiedBy` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `in_date` datetime NOT NULL,
  `in_desc` text CHARACTER SET utf8 NOT NULL,
  `pay_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `amount` decimal(19,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `juridical`
--

CREATE TABLE `juridical` (
  `id` int(11) NOT NULL,
  `tashkilot` varchar(255) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `hisobraqam` varchar(20) DEFAULT NULL,
  `inn` varchar(9) DEFAULT NULL,
  `mfo` smallint(6) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `oked` smallint(6) DEFAULT NULL,
  `status_shop_id` int(11) DEFAULT NULL,
  `orgo_id` int(11) DEFAULT NULL,
  `main_name` varchar(100) DEFAULT NULL,
  `okpo` varchar(50) DEFAULT NULL,
  `coato` varchar(50) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `brand_juridical` varchar(200) NOT NULL,
  `contract_date` date NOT NULL,
  `contract_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `juridical`
--

INSERT INTO `juridical` (`id`, `tashkilot`, `bank`, `hisobraqam`, `inn`, `mfo`, `created_at`, `updated_at`, `oked`, `status_shop_id`, `orgo_id`, `main_name`, `okpo`, `coato`, `profile_id`, `brand_juridical`, `contract_date`, `contract_number`) VALUES
(8, 'GULASIOB', 'АКБ \"INVEST FINANS BANK\"', '20208000700478987001', '303374521', 1133, 1538023708, 1538025047, 10820, 7, 4, NULL, '', '', 43, ' ', '2018-09-27', 'SA/1'),
(9, 'GULASIOB', 'АКБ \"INVEST FINANS BANK\"', '20208000700478987001', '303374521', 1133, 1538026095, 1538043360, 10820, 8, 4, NULL, '', '', 3, ' ', '2018-09-27', 'SA/1'),
(10, 'Шаров Зода Икром Илхомович', 'АИТБ «Ипак Йули» МФ «Умар»', '20218000704594426001', '475608624', 283, 1538825209, 1538829324, NULL, 9, 5, NULL, '', '', 8, ' ', '0000-00-00', ''),
(11, 'Dilshod Tursimatov', 'Asaka Bank', '88888888888888888888', '888888888', 32767, 1551027841, 1551027841, 32767, 1, 1, NULL, '777', '4444', 24, ' ', '0000-00-00', ''),
(12, 'StantComputers', '323232', '32323232323232323232', '323232323', 32767, 1551068163, 1551068163, 23232, 1, 1, NULL, '32323', '2323232', 25, ' ', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(155) DEFAULT NULL,
  `img_logo` text,
  `desc` text,
  `slug` varchar(255) DEFAULT NULL,
  `strana_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`, `code`, `img_logo`, `desc`, `slug`, `strana_id`) VALUES
(1, 'Coca Cola', NULL, '/uploads/2018/12/100001.png', '', 'coca-cola', 1);

-- --------------------------------------------------------

--
-- Table structure for table `marketplace`
--

CREATE TABLE `marketplace` (
  `id` int(11) NOT NULL,
  `market_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marketplace`
--

INSERT INTO `marketplace` (`id`, `market_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Самаркандская область №1', 1, 1531979589, 1531979589),
(2, 'Самаркандская область №2', 1, 1531979794, 1531979794),
(3, 'Джизакский область №1', 1, 1531979834, 1531979834),
(4, 'Джизакский область №2', 1, 1531979844, 1531979844);

-- --------------------------------------------------------

--
-- Table structure for table `messages_t`
--

CREATE TABLE `messages_t` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted_by_sender` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted_by_receiver` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `chatroom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages_t`
--

INSERT INTO `messages_t` (`id`, `sender_id`, `receiver_id`, `text`, `is_new`, `is_deleted_by_sender`, `is_deleted_by_receiver`, `created_at`, `chatroom_id`) VALUES
(12, 6, 22, 'Salom Farrux biz DilshodDeveloperdan', 0, 0, 0, '2019-02-28 23:26:51', 6),
(13, 22, 6, 'asdasdasdasdsa', 0, 0, 0, '2019-02-28 23:27:10', 6),
(14, 22, 6, 'salom', 0, 0, 0, '2019-02-28 23:29:13', 6),
(15, 22, 6, 'dsdsds', 0, 0, 0, '2019-02-28 23:30:29', 6),
(16, 22, 6, 'dsadsadsa', 0, 0, 0, '2019-02-28 23:30:40', 6),
(17, 22, 6, 'Salom test', 0, 0, 0, '2019-02-28 23:31:14', 6),
(18, 6, 22, 'test', 0, 0, 0, '2019-02-28 23:31:29', 6),
(19, 6, 22, 'salom', 0, 0, 0, '2019-03-01 11:00:28', 6),
(20, 6, 22, 'dasdsa', 0, 0, 0, '2019-03-01 11:10:13', 6),
(21, 2, 24, 'salom', 0, 0, 0, '2019-03-04 09:06:59', 7),
(22, 2, 24, 'Salom', 0, 0, 0, '2019-03-04 09:07:46', 7),
(23, 2, 24, 'Salom dunyo', 0, 0, 0, '2019-03-04 09:07:51', 7),
(24, 2, 24, 'E huddddoiooo', 0, 0, 0, '2019-03-04 09:07:56', 7),
(25, 2, 24, 'salom', 0, 0, 0, '2019-03-04 10:39:25', 7),
(26, 2, 22, 'salom biz developr', 0, 0, 0, '2019-03-04 10:40:31', 8),
(27, 2, 22, 'sdsd', 0, 0, 0, '2019-03-04 11:24:12', 8),
(28, 2, 24, 'sasa', 1, 0, 0, '2019-03-04 11:27:14', 7),
(29, 2, 22, 'ssss', 0, 0, 0, '2019-03-04 11:28:11', 8);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1523185909),
('m140506_102106_rbac_init', 1523186127),
('m140622_111540_create_image_table', 1524733326),
('m140622_111545_add_name_to_image_table', 1524733326),
('m141129_130551_create_filemanager_mediafile_table', 1523669243),
('m141203_173402_create_filemanager_owners_table', 1523669243),
('m141203_175538_add_filemanager_owners_ref_mediafile_fk', 1523669244),
('m160518_074611_wishlist', 1534481705),
('m160616_000010_add_filemanager_tags', 1523669247),
('m160622_085710_create_ImageManager_table', 1524213130),
('m170223_113221_addBlameableBehavior', 1524213131),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1523186127),
('m180408_022700_init', 1523185911),
('m180408_054726_profile', 1523185912),
('m180408_100337_juridical_table', 1523185913),
('m180408_103018_regions_table', 1523185913),
('m180408_113017_profile_table', 1523187080),
('m180411_112555_coategory', 1523447503),
('m180411_113956_products', 1523447603),
('m180417_112609_manufacturer_table', 1523968298),
('m180417_122539_add_product_manufaturerid', 1523968660),
('m180417_130314_add_column_manufacturer_image', 1523970425),
('m180418_094448_product_images_table', 1524049610),
('m180418_110542_fk_product_images_productid', 1524049611),
('m180419_091105_create_table_attribute', 1524130618),
('m180419_105802_add_column_product_attr', 1524135569),
('m180419_113615_addColumn_proattr_ismain', 1524138259),
('m180420_082414_update_column_attr', 1524212806),
('m180420_082804_add_columnattr_isfilter', 1524212900),
('m180422_151621_create_table_orders', 1524413037),
('m180422_160453_create_order_item_table', 1524413665),
('m180423_022634_add_column_orders', 1524450904),
('m180423_023606_create_table_pay_method', 1524451249),
('m180423_024136_add_fk_toorders', 1524451701),
('m180423_040957_add_column_to_orders', 1524456774),
('m180423_043021_add_column_shartlar_to_orders', 1524458022),
('m180423_101521_addfktoorder_item', 1524478756),
('m180423_130912_add_column_to_orders_status', 1524489064),
('m180429_150757_create_table_product_reviews', 1525036534),
('m180430_042739_add_foreginkey_reviews', 1525062994),
('m180430_095350_add_column_to_reviews', 1525082118),
('m180430_123830_add_timestamp_to_reviews', 1525092159),
('m180501_133050_createtable_sklad', 1525181828),
('m180501_133757_add_col_to_pro1', 1525182871),
('m180501_135244_create_unit_table', 1525182873),
('m180502_154447_delete_skladid_from_product', 1525275990),
('m180502_154812_add_column_toregin_to_product', 1525276474),
('m180502_155449_add_column_toregin_to_producdt', 1525276946),
('m180502_160044_add_product_column_created_updated', 1525276948),
('m180503_122432_add_col_to_orders_kuryer_id', 1525350458),
('m180508_033758_addtocolumnprofil', 1525750799),
('m180510_033803_create_table_order_status_history', 1526091388),
('m180512_020611_create_table_article', 1526091388),
('m180512_113746_create_news_table', 1526125226),
('m180512_113818_create_newscategory_table', 1526125226),
('m180513_102916_news_column_add_slug', 1526207458),
('m180514_111331_create_notfications_table', 1526296933),
('m180514_113737_create_notify_type_table', 1526297922),
('m180514_113914_add_notify_table_foregin_key', 1526298331),
('m180520_135357_addpro_views_count', 1526824525),
('m180521_081208_create_discount_table', 1526891222),
('m180521_082555_delViewCount', 1526891223),
('m180521_090315_add_col_discount', 1526893493),
('m180522_030931_addCOLdiskount', 1526958647),
('m180522_040434_addColToDiscountStatus', 1526962039),
('m180522_124444_colnamechangeDISCOUNT', 1526993218),
('m180523_035120_orderITEMAddCol', 1527047639),
('m180523_093537_adCOlToOrderCreatedBy', 1527068237),
('m180603_113930_create_adresses_table', 1528026327),
('m180603_114855_create_adresses_table', 1528026571),
('m180603_115142_create_adresses_tablesssss', 1528026793),
('m180603_115453_create_strana_table', 1528027668),
('m180603_115814_create_cities_table', 1528027668),
('m180603_120029_add_regions_col', 1528028178),
('m180603_121634_add_fk_ad', 1528028241),
('m180608_095711_add_col_fkk', 1530250271),
('m180629_052950_fk_orderid_invoiceid', 1530250271),
('m180629_053419_fk_orderid_invoiceid_created', 1530250589),
('m180629_053740_fk_weeks', 1530250804);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` text,
  `meta_keywords` text,
  `meta_description` text,
  `content` text,
  `status` tinyint(3) DEFAULT '10',
  `category_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `in_menu` tinyint(4) NOT NULL,
  `sort` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `title`, `meta_keywords`, `meta_description`, `content`, `status`, `category_id`, `created_at`, `updated_at`, `created_by`, `in_menu`, `sort`) VALUES
(1, 'salom-men-seni-sevaman', 'Извнети я занят', 'SBAZAR', 'Дорогие друзья!В интернет-магазине SBAZAR.UZ специальное предложение от бренда Panasonic.', '<div class=\"row item\" style=\"box-sizing: border-box; margin-right: -15px; margin-left: -15px; color: #333333; font-family: \'Roboto Condensed\', sans-serif;\" data-key=\"4\">\r\n<div class=\"col-md-8 col-sm-9\" style=\"box-sizing: border-box; position: relative; min-height: 1px; padding-right: 15px; padding-left: 15px; float: left; width: 780px;\">\r\n<p class=\"text\" style=\"box-sizing: border-box; margin: 0px; font-size: 1em; color: #666666; line-height: 1.8em;\">Дорогие друзья!В интернет-магазине SBAZAR.UZ специальное предложение от бренда Panasonic.</p>\r\n</div>\r\n</div>', 10, 1, 1526127559, 1526127618, 23, 0, 0),
(2, 'salomlar', 'salomlars', 'ss', 'asdd', '<p>assdasd</p>', 0, 1, 1526207003, 1526207043, 23, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newscategory`
--

CREATE TABLE `newscategory` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newscategory`
--

INSERT INTO `newscategory` (`id`, `category_name`, `slug`) VALUES
(1, 'Новости', NULL),
(2, 'Салом', 'salom');

-- --------------------------------------------------------

--
-- Table structure for table `notfications`
--

CREATE TABLE `notfications` (
  `id` int(11) NOT NULL,
  `notfy_type_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `notfy_text` text,
  `created_at` int(11) DEFAULT NULL,
  `receive_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notify_type`
--

CREATE TABLE `notify_type` (
  `id` int(11) NOT NULL,
  `notfy_name` varchar(255) DEFAULT NULL,
  `notfy_template` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_type`
--

INSERT INTO `notify_type` (`id`, `notfy_name`, `notfy_template`) VALUES
(1, 'error', 'error'),
(2, 'info', ''),
(3, 'newsale', 'newsale'),
(4, 'success', ''),
(5, 'neworder', '');

-- --------------------------------------------------------

--
-- Table structure for table `no_customers`
--

CREATE TABLE `no_customers` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_archive` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_customers`
--

INSERT INTO `no_customers` (`id`, `client_id`, `comment_id`, `created_at`, `updated_at`, `created_by`, `status`, `is_archive`) VALUES
(1, 6, NULL, 1533713734, 1533713734, 7, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sum` decimal(19,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `pay_status` tinyint(3) DEFAULT NULL,
  `pay_method_name` varchar(50) DEFAULT NULL,
  `pay_method_id` int(11) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `order_type` tinyint(4) NOT NULL,
  `delivery_method` int(11) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `courier_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `delivery_status` tinyint(4) DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `delivered_date` datetime NOT NULL,
  `deliver_sklad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `created_at`, `updated_at`, `qty`, `sum`, `user_id`, `seller_id`, `region_id`, `pay_status`, `pay_method_name`, `pay_method_id`, `is_read`, `order_type`, `delivery_method`, `status`, `courier_id`, `created_by`, `delivery_status`, `delivery_date`, `delivered_date`, `deliver_sklad`) VALUES
(10, 1550772482, 1550942707, 1, '2990000.00', 22, 22, 3, 20, 'Терминал', 3, 1, 3, 3, 13, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(11, 1550772482, 1550939122, 1, '4930000.00', 22, 2, 3, 20, 'Терминал', 3, 1, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(12, 1550772483, 1550772483, 3, '13300.00', 22, 3, 3, 20, 'Терминал', 3, 0, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(13, 1550772900, 1550942396, 1, '2990000.00', 22, 22, 3, 20, 'Терминал', 3, 1, 3, 3, 11, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(14, 1550772900, 1550830298, 1, '2465000.00', 22, 2, 3, 20, 'Терминал', 3, 1, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(15, 1550772900, 1550772900, 1, '2300.00', 22, 3, 3, 20, 'Терминал', 3, 0, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(16, 1550826058, 1550939088, 2, '4600.00', 22, 3, 3, 20, 'Терминал', 3, 1, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(17, 1550826110, 1550934712, 3, '15600.00', 22, 3, 3, 20, 'Перечислением', 3, 1, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(18, 1551028471, 1551028504, 1, '2990000.00', 24, 22, 9, 20, 'Терминал', NULL, 1, 3, 3, 10, NULL, 24, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(19, 1551028471, 1551028471, 1, '2465000.00', 24, 2, 9, 20, 'Терминал', NULL, 0, 3, 3, 10, NULL, 24, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(20, 1551028630, 1551028648, 1, '8100000.00', 22, 24, 3, 20, 'Терминал', NULL, 1, 3, 3, 10, NULL, 22, 0, '0000-00-00', '0000-00-00 00:00:00', NULL),
(21, 1551068410, 1551068439, 1, '8100000.00', 25, 24, 8, 20, 'PeyMe', NULL, 1, 3, 3, 10, NULL, 25, 0, '0000-00-00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(19,2) DEFAULT NULL,
  `qty_item` int(11) DEFAULT NULL,
  `summ_item` decimal(19,2) DEFAULT NULL,
  `discount_procent` int(11) DEFAULT NULL,
  `discount_name` varchar(255) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `name`, `price`, `qty_item`, `summ_item`, `discount_procent`, `discount_name`, `discount_id`) VALUES
(5, 10, 33, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', '2990000.00', 1, '2990000.00', NULL, NULL, NULL),
(6, 11, 32, 'СМАРТФОН IPHONE XS MAX 64GB GRAY, SILVER', '2465000.00', 2, '4930000.00', NULL, NULL, NULL),
(7, 12, 30, 'Fuse Tea 0,450л Лимон', '2300.00', 1, '2300.00', NULL, NULL, NULL),
(8, 12, 29, 'Fuse Tea 0,450л Персик', '2300.00', 2, '4600.00', NULL, NULL, NULL),
(9, 12, 25, 'Fanta 1,5л', '6400.00', 1, '6400.00', NULL, NULL, NULL),
(10, 13, 33, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', '2990000.00', 1, '2990000.00', NULL, NULL, NULL),
(11, 14, 32, 'СМАРТФОН IPHONE XS MAX 64GB GRAY, SILVER', '2465000.00', 1, '2465000.00', NULL, NULL, NULL),
(12, 15, 30, 'Fuse Tea 0,450л Лимон', '2300.00', 1, '2300.00', NULL, NULL, NULL),
(13, 16, 30, 'Fuse Tea 0,450л Лимон', '2300.00', 1, '2300.00', NULL, NULL, NULL),
(14, 16, 29, 'Fuse Tea 0,450л Персик', '2300.00', 1, '2300.00', NULL, NULL, NULL),
(15, 17, 25, 'Fanta 1,5л', '6400.00', 1, '6400.00', NULL, NULL, NULL),
(16, 17, 26, 'Sprite 0,5л', '2800.00', 1, '2800.00', NULL, NULL, NULL),
(17, 17, 21, 'Coca Cola 1,5л', '6400.00', 1, '6400.00', NULL, NULL, NULL),
(18, 18, 33, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', '2990000.00', 1, '2990000.00', NULL, NULL, NULL),
(19, 19, 32, 'СМАРТФОН IPHONE XS MAX 64GB GRAY, SILVER', '2465000.00', 1, '2465000.00', NULL, NULL, NULL),
(20, 20, 34, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', '8100000.00', 1, '8100000.00', NULL, NULL, NULL),
(21, 21, 34, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', '8100000.00', 1, '8100000.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status_history`
--

CREATE TABLE `order_status_history` (
  `id` int(11) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `notfy_client` tinyint(3) DEFAULT NULL,
  `comment_status` varchar(300) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `sts` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `name`, `sts`) VALUES
(1, 'ЯТТ', 1),
(2, 'ИП', 1),
(3, 'СП', 1),
(4, 'ООО', 1),
(5, 'ЧП', 1),
(6, 'ОК', 1),
(7, 'MCHJ', 1),
(8, 'AO', 1),
(9, 'Другое', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payme_uz`
--

CREATE TABLE `payme_uz` (
  `id` int(11) NOT NULL,
  `transaction` varchar(50) DEFAULT NULL,
  `code` varchar(25) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `owner_id` varchar(25) DEFAULT NULL,
  `amount` varchar(25) DEFAULT NULL,
  `reason` varchar(25) DEFAULT NULL,
  `payme_time` varchar(25) DEFAULT NULL,
  `cancel_time` varchar(25) DEFAULT NULL,
  `create_time` varchar(25) DEFAULT NULL,
  `perform_time` varchar(25) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pay_method`
--

CREATE TABLE `pay_method` (
  `id` int(11) NOT NULL,
  `pay_name` varchar(50) NOT NULL,
  `payment_status` tinyint(3) DEFAULT NULL,
  `delivery_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay_method`
--

INSERT INTO `pay_method` (`id`, `pay_name`, `payment_status`, `delivery_id`) VALUES
(1, 'Наличные', 1, 0),
(2, 'Терминал', 1, 0),
(3, 'Перечислением', 1, 2),
(4, 'Оплата при доставке', 1, 0),
(6, 'PeyMe', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `type_product` tinyint(4) NOT NULL DEFAULT '1',
  `manufacturer_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `related_products` text COMMENT 'PHP serialize',
  `name` varchar(200) NOT NULL,
  `code` varchar(155) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_protsent` int(11) DEFAULT NULL,
  `text` text,
  `short_text` varchar(500) DEFAULT NULL,
  `is_new` enum('yes','no') DEFAULT 'no',
  `is_popular` enum('yes','no') DEFAULT 'no',
  `feature_image` text,
  `available` enum('yes','no') DEFAULT 'yes',
  `sort` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `aproval_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `view_count` int(11) DEFAULT '1',
  `old_price` decimal(19,2) DEFAULT NULL,
  `wholesale_price` decimal(19,2) DEFAULT NULL,
  `wholesale_count` int(11) DEFAULT NULL,
  `return_guarantee` text NOT NULL,
  `product_status` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `wholesale_protsent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `profile_id`, `type_product`, `manufacturer_id`, `amount`, `related_products`, `name`, `code`, `price`, `price_protsent`, `text`, `short_text`, `is_new`, `is_popular`, `feature_image`, `available`, `sort`, `slug`, `region_id`, `unit_id`, `aproval_id`, `user_id`, `updated_at`, `created_at`, `status`, `view_count`, `old_price`, `wholesale_price`, `wholesale_count`, `return_guarantee`, `product_status`, `created_by`, `wholesale_protsent`) VALUES
(1, 40, 2, 1, NULL, 50, NULL, 'Жидкий гель \"Зелёный чай\"', NULL, '4700.00', NULL, '<p><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Средство для</span> <span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">мытья посуды с ароматом лимона быстро удаляет жир в холодной воде придавая воде кристальный блеск.&nbsp;</span></p>', '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Средство для</span> <span style=\"font-size: 14.0pt; line-height: 115%;\">мытья посуды с ароматом лимона</span></p>', 'no', 'no', NULL, 'yes', NULL, 'zhidkiy-gel-zelenyy-chay', 15, 1, 0, 3, 1538744772, 1538741551, 0, 30, '5100.00', '4500.00', 24, '', 'Новый', 2, NULL),
(2, 112, 2, 1, NULL, 70, NULL, 'Минеральная вода \"Nestle\" 0,5л', NULL, '1400.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литр</span></p>', '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Питьевая вода. Без газа</span></p>', 'no', 'no', NULL, 'yes', NULL, 'pitevaya-voda-nestle-05l', 15, 1, 0, 3, 1538833150, 1538746282, 0, 22, '1500.00', '1350.00', 60, '', 'Новый', 2, NULL),
(3, 112, 2, 1, NULL, 70, NULL, 'Минеральная вода \"Nestle\" 0,5л', NULL, '1400.00', NULL, '<p><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литр</span></p>', '<p><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Минеральная вода с газом</span></p>', 'no', 'no', NULL, 'yes', NULL, 'mineralnaya-voda-nestle-05l', 15, 1, 0, 3, 1538748271, 1538747964, 0, 19, '1500.00', '1350.00', 60, '', 'Новый', 2, NULL),
(4, 112, 2, 1, NULL, 50, NULL, 'Минеральная вода \"Nestle\" 1л', NULL, '2000.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литра</span></p>', '<p>Питьевая вода без газа</p>', 'no', 'no', NULL, 'yes', NULL, 'pitevaya-voda-nestle-1l', 15, 1, 0, 3, 1538833127, 1538751965, 0, 27, '2100.00', '1900.00', 40, '', 'Новый', 2, NULL),
(5, 112, 2, 1, NULL, 50, NULL, 'Минеральная вода \"Nestle\" 1л', NULL, '2000.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литра</span></p>', '<p>Минеральная вода с газом</p>', 'no', 'no', NULL, 'yes', NULL, 'mineralnaya-voda-nestle-1l', 15, 1, 0, 3, 1538811288, 1538811212, 0, 23, '2100.00', '1900.00', 40, '', 'Новый', 2, NULL),
(6, 112, 2, 1, NULL, 50, NULL, 'Минеральная вода \"Nestle\" 1,5л', NULL, '2300.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литра</span></p>', '<p>Минеральная вода с газом</p>', 'no', 'no', NULL, 'yes', NULL, 'mineralnaya-voda-nestle-15l', 15, 1, 0, 3, 1538819080, 1538811528, 0, 23, '2500.00', '0.00', NULL, '', 'Новый', 2, NULL),
(7, 112, 2, 1, NULL, 50, NULL, 'Минеральная вода \"Nestle\" 1,5л', NULL, '2300.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Качественная и кристально чистая минеральная вода. В день рекомендуется пить 1-1,5 литра</span></p>', '<p>Питьевая вода без газа</p>', 'no', 'no', NULL, 'yes', NULL, 'pitevaya-voda-nestle-15l', 15, 1, 0, 3, 1538833105, 1538811779, 0, 24, '2500.00', '0.00', NULL, '', 'Новый', 2, NULL),
(8, 39, 2, 1, NULL, 5, NULL, 'Стиральный порошок Пемос 3,5 кг автомат', NULL, '52000.00', NULL, '<p><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Стиральный порошок Пемос отстирает Ваше бельё до белизны. Производство Россия</span></p>', '<p>Стиральный порошок Пемос 3,5 кг автомат</p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-pemos-35-kg-avtomat', 15, 1, 0, 3, 1538813055, 1538812755, 0, 27, '55000.00', NULL, NULL, '', 'Новый', 2, NULL),
(9, 40, 2, 1, NULL, 20, NULL, 'Жидкий пятновыводитель Vanish ', NULL, '7400.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 16.0pt; line-height: 115%;\">Жидкий пятновыводитель и отбеливатель для тканей </span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Предварительная обработка:</span></p>\r\n<p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify; text-indent: -18.0pt; mso-list: l2 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;\"><span style=\"mso-list: Ignore;\">1.<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Нанесите 20 мл средства на пятно. </span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"text-align: justify; text-indent: -18.0pt; mso-list: l2 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;\"><span style=\"mso-list: Ignore;\">2.<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Потрите пятно</span></p>\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"text-align: justify; text-indent: -18.0pt; mso-list: l2 level1 lfo1;\"><!-- [if !supportLists]--><span style=\"font-size: 12.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;\"><span style=\"mso-list: Ignore;\">3.<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 12.0pt; line-height: 115%;\">Вылейте содержимое пакета в стиральную машину вместе с бельём</span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Замачивание:</span></p>\r\n<p class=\"MsoListParagraphCxSpFirst\" style=\"text-align: justify; text-indent: -18.0pt; mso-list: l0 level1 lfo2;\"><!-- [if !supportLists]--><span style=\"font-size: 14.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;\"><span style=\"mso-list: Ignore;\">1.<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 14.0pt; line-height: 115%;\">После замачивания стирайте как обычно или тщательно прополощите</span></p>\r\n<p class=\"MsoListParagraphCxSpMiddle\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%;\">Стирка</span></p>\r\n<p class=\"MsoListParagraphCxSpLast\" style=\"text-align: justify; text-indent: -18.0pt; mso-list: l1 level1 lfo3;\"><!-- [if !supportLists]--><span style=\"font-size: 14.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;\"><span style=\"mso-list: Ignore;\">1.<span style=\"font: 7.0pt \'Times New Roman\';\">&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style=\"font-size: 14.0pt; line-height: 115%;\">Вылейте содержимое пакета 100 мл в барабан стиральной машины вместе с бельём. Добавьте стиральный порошок</span></p>', '<p><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Calibri\',\'sans-serif\'; mso-ascii-theme-font: minor-latin; mso-fareast-font-family: Calibri; mso-fareast-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; mso-ansi-language: RU; mso-fareast-language: EN-US; mso-bidi-language: AR-SA;\">Жидкий пятновыводитель и отбеливатель для тканей 100 мл</span></p>', 'no', 'no', NULL, 'yes', NULL, 'zhidkiy-pyatnovyvoditel-vanish', 15, 1, 0, 3, 1538817835, 1538817666, 0, 27, '7500.00', '7200.00', 10, '', 'Новый', 2, NULL),
(10, 39, 2, 1, NULL, 5, NULL, 'Стиральный Порошок Persil автомат 4,5кг', NULL, '95000.00', NULL, '<p>Стиральный Порошок Persil автомат 4,5кг производство&nbsp;<span style=\"font-family: Verdana, sans-serif; font-size: 10.5pt;\">Россия.</span></p>', '<p>Стиральный Порошок Persil автомат 4,5кг</p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-persil-avtomat-45kg', 15, 1, 0, 3, 1538819818, 1538818640, 0, 21, '97000.00', NULL, NULL, '', 'Новый', 2, NULL),
(11, 39, 2, 1, NULL, 2, NULL, 'Стиральный порошок Persil ver nel 1,8кг ручная стирка', NULL, '35200.00', NULL, '<p>Стиральный порошок Persil ver nel 1,8кг ручная стирка</p>', '<p>Стиральный порошок Persil ver nel 1,8кг ручная стирка</p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-persil-ver-nel-18kg', 15, 1, 0, 3, 1538896564, 1538822375, 0, 34, '38700.00', NULL, NULL, '', 'Новый', 2, NULL),
(12, 39, 2, 1, NULL, 10, NULL, 'Стиральный порошок Losk 6 автомат', NULL, '35900.00', NULL, '<p>Стиральный порошок Losk 6 горное озеро автомат 3 кг</p>', '<p>Стиральный порошок Losk 6 горное озеро автомат 3 кг</p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-losk-6', 15, 1, 0, 3, 1538896598, 1538895271, 0, 29, '37000.00', '34200.00', 3, '', 'Новый', 2, NULL),
(13, 39, 2, 1, NULL, 10, NULL, 'Стиральный порошок Зелёный чай ручная стирка', NULL, '13600.00', NULL, '<p><span style=\"text-align: justify; font-size: 14pt; line-height: 21.4667px; font-family: Arial, sans-serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Стиральный порошок Зелёный чай ручная стирка 900гр</span><span style=\"text-align: justify;\">&nbsp;</span></p>', '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Arial\',\'sans-serif\'; color: black; background: white; mso-bidi-font-weight: bold;\">Стиральный порошок Зелёный чай ручная стирка 900гр</span>&nbsp;</p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-zelenyy-chay', 15, 1, 0, 3, 1538896630, 1538895659, 0, 28, '14100.00', '13200.00', 3, '', 'Новый', 2, NULL),
(14, 39, 2, 1, NULL, 10, NULL, 'Стиральный порошок Зелёный чай автомат', NULL, '19600.00', NULL, '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Arial\',\'sans-serif\'; color: black; background: white; mso-bidi-font-weight: bold;\">Стиральный порошок Зелёный чай автомат 900гр</span></p>', '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Arial\',\'sans-serif\'; color: black; background: white; mso-bidi-font-weight: bold;\">Стиральный порошок Зелёный чай автомат 900гр</span></p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-zelenyy-chay-2', 15, 1, 0, 3, 1538896649, 1538896499, 0, 39, '20200.00', '18700.00', 3, '', 'Новый', 2, NULL),
(15, 39, 2, 1, NULL, 10, NULL, 'Стиральный порошок Зелёный чай автомат', NULL, '32300.00', NULL, '<p><span style=\"font-family: Arial, sans-serif; font-size: 18.6667px; text-align: justify;\">Стиральный порошок Зелёный чай автомат 1500гр</span></p>', '<p class=\"MsoNormal\" style=\"text-align: justify;\"><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Arial\',\'sans-serif\'; color: black; background: white; mso-bidi-font-weight: bold;\">Стиральный порошок Зелёный чай автомат 1500гр</span></p>', 'no', 'no', NULL, 'yes', NULL, 'stiralnyy-poroshok-zelenyy-chay-avtomat', 15, 1, 0, 3, 1538999408, 1538897769, 0, 77, '34000.00', '30800.00', 3, '<p>Если товар не будет соответствовать качеству, то мы гарантируем возврат</p>', 'Новый', 2, NULL),
(16, 112, 2, 1, NULL, 200, NULL, 'Coca Cola', NULL, '6400.00', NULL, '<p>Coca Cola 0,5л</p>', '<p>Coca Cola 0,5л</p>', 'no', 'no', NULL, 'yes', NULL, 'coca-cola', 15, 1, 0, 3, 1545110761, 1545110761, 0, 2, NULL, '6300.00', 60, '', 'Новый', 2, NULL),
(20, 112, 2, 1, NULL, 100, NULL, 'Coca Cola 1л', NULL, '4800.00', NULL, '<p>Coca Cola 1л</p>', '<p>Coca Cola 1л</p>', 'no', 'no', NULL, 'yes', NULL, 'coca-cola-1l', 15, 1, 0, 3, 1545111141, 1545111063, 0, 4, '5000.00', '4700.00', 30, '', 'Новый', 2, NULL),
(21, 112, 2, 1, NULL, 100, NULL, 'Coca Cola 1,5л', NULL, '6400.00', NULL, '<p>Coca Cola 1,5л</p>', '<p>Coca Cola 1,5л</p>', 'no', 'no', NULL, 'yes', NULL, 'coca-cola-15l', 15, 1, 0, 3, 1545111295, 1545111295, 0, 4, '6500.00', '6300.00', 30, '', 'Новый', 2, NULL),
(22, 112, 2, 1, NULL, 100, NULL, 'Fanta 0,5', NULL, '2800.00', NULL, '<p>Fanta 0,5</p>', '<p>Fanta 0,5</p>', 'no', 'no', NULL, 'yes', NULL, 'fanta-05', 15, 1, 0, 3, 1545111605, 1545111605, 0, 5, '3000.00', '2700.00', 60, '', 'Новый', 2, NULL),
(23, 112, 2, 1, NULL, 100, NULL, 'Coca Cola 0,5', NULL, '2800.00', NULL, '<p>Coca Cola 0,5</p>', '<p>Coca Cola 0,5</p>', 'no', 'no', NULL, 'yes', NULL, 'coca-cola-05', 15, 1, 0, 3, 1545112106, 1545112106, 0, 5, '3000.00', '2700.00', 60, '', 'Новый', 2, NULL),
(24, 112, 2, 1, NULL, 100, NULL, 'Fanta 1л', NULL, '4800.00', NULL, '<p>Fanta 1л</p>', '<p>Fanta 1л</p>', 'no', 'no', NULL, 'yes', NULL, 'fanta-1l', 15, 1, 0, 3, 1545112952, 1545112610, 0, 5, '5000.00', '4700.00', 30, '', 'Новый', 2, NULL),
(25, 112, 2, 1, NULL, 100, NULL, 'Fanta 1,5л', NULL, '6400.00', NULL, '<p>Fanta 1,5л</p>', '<p>Fanta 1,5л</p>', 'no', 'no', NULL, 'yes', NULL, 'fanta-15l', 15, 1, 0, 3, 1545112900, 1545112900, 0, 9, '6500.00', '6300.00', 30, '', 'Новый', 2, NULL),
(26, 112, 2, 1, NULL, 100, NULL, 'Sprite 0,5л', NULL, '2800.00', NULL, '<p>Sprite 0,5л</p>', '<p>Sprite 0,5л</p>', 'no', 'no', NULL, 'yes', NULL, 'sprite-05l', 15, 1, 0, 3, 1545113768, 1545113768, 0, 6, '3000.00', '2700.00', 60, '', 'Новый', 2, NULL),
(27, 112, 2, 1, NULL, 100, NULL, 'Sprite 1л', NULL, '4800.00', NULL, '<p>Sprite 1л</p>', '<p>Sprite 1л</p>', 'no', 'no', NULL, 'yes', NULL, 'sprite-1l', 15, 1, 0, 3, 1545113860, 1545113860, 0, 4, '5000.00', '4700.00', 30, '', 'Новый', 2, NULL),
(28, 112, 2, 1, 1, 100, NULL, 'Sprite 1,5л', NULL, '6400.00', NULL, '<p>Sprite 1,5л</p>', '<p>Sprite 1,5л</p>', 'no', 'no', NULL, 'yes', NULL, 'sprite-15l', 15, 1, 0, 3, 1545114234, 1545113960, 0, 8, '6500.00', '6300.00', 30, '', 'Новый', 2, NULL),
(29, 112, 2, 1, 1, 100, NULL, 'Fuse Tea 0,450л Персик', NULL, '2300.00', NULL, '<p>Fuse Tea 0,450л Персик. Напиток безалкогольный не газированный холодный черный чай с экстрактом чая и персика. Пастеризованный. Состав: вода, сахар, регулятор кислотности - лимонная кислота, цитрат натрия, концентрат персикового сока, натуральный персиковый ароматизатор и экстракт черного чая.</p>', '<p>Fuse Tea 0,450л Персик</p>', 'no', 'no', NULL, 'yes', NULL, 'fuse-tea-0450l', 15, 1, 0, 3, 1545116735, 1545115611, 0, 10, '2400.00', '2200.00', 60, '', 'Новый', 2, NULL),
(30, 112, 2, 1, 1, 100, NULL, 'Fuse Tea 0,450л Лимон', NULL, '2300.00', NULL, '<p>Fuse Tea 0,450л со вкусом Лимона</p>', '<p>Fuse Tea 0,450л со вкусом Лимона</p>', 'no', 'no', NULL, 'yes', NULL, 'fuse-tea-0450l-limon', 15, 1, 0, 3, 1545115952, 1545115952, 0, 19, '2500.00', '2200.00', 60, '', 'Новый', 2, NULL),
(32, 50, 2, 1, 1, 200, NULL, 'СМАРТФОН IPHONE XS MAX 64GB GRAY, SILVER', NULL, '2465000.00', NULL, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Непревзойденная защита Ваших данных</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" /><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" />&nbsp; &nbsp; &nbsp; &nbsp;Ноутбук HP 250 G6 имеет высокую степень защиты не только вредоносных программ, но, а также от посторонних глаз. Благодаря инновационным технологиям Dynamic Protection, Ваш ноутбук сможет защитить Ваш BIOS от любых внешних атак, а современный дисплей HP Sure View даст Вам возможность огородить Ваши конфиденциальные данные от чужих глаз.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Удобство в эксплуатации</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" /><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" />&nbsp; &nbsp; &nbsp; &nbsp;В современном ноутбуке HP 250 G6 для большего удобство предусмотрены разъемы HDMI, а также USB для подключения электронных&nbsp;девайсов, носителей, фото или видео камер. Теперь Вы сможете насладиться Вашими любимыми моментами и кадрами в высоком качестве на HD экране ноутбука.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Идеальный результат&nbsp;</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ноутбук HP 250 G6 имеет в себе свойство улучшать качество звука, отделяя голоса от фонового шума, чтобы обеспечить Вам идеально четкое прослушивание.&nbsp;Насладитесь идеальным соотношением идеального звучания и высокого качество изображения.</p>', '<p><span style=\"color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px;\">HP 250 G6 ноутбук нового поколения, который сможет обеспечить быстрою работу даже в режиме многозадачности. Современная технология улучшения качества изображения, а также звука даст в полной мере насладится работой устройства.</span></p>', 'no', 'no', NULL, 'yes', NULL, 'smartfon-iphone-xs-max-64gb-gray-silver', 11, 1, 0, 2, 1550678618, 1550678618, 0, 23, NULL, NULL, NULL, '<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Непревзойденная защита Ваших данных</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" /><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" />&nbsp; &nbsp; &nbsp; &nbsp;Ноутбук HP 250 G6 имеет высокую степень защиты не только вредоносных программ, но, а также от посторонних глаз. Благодаря инновационным технологиям Dynamic Protection, Ваш ноутбук сможет защитить Ваш BIOS от любых внешних атак, а современный дисплей HP Sure View даст Вам возможность огородить Ваши конфиденциальные данные от чужих глаз.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;<span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Удобство в эксплуатации</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" /><br style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent;\" />&nbsp; &nbsp; &nbsp; &nbsp;В современном ноутбуке HP 250 G6 для большего удобство предусмотрены разъемы HDMI, а также USB для подключения электронных&nbsp;девайсов, носителей, фото или видео камер. Теперь Вы сможете насладиться Вашими любимыми моментами и кадрами в высоком качестве на HD экране ноутбука.</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; font-weight: bold;\">Идеальный результат&nbsp;</span></p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; margin: 0px; padding: 0px; outline: 0px; -webkit-tap-highlight-color: transparent; color: #242424; font-family: LatoRegular, sans-serif; font-size: 16px; text-align: center;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Ноутбук HP 250 G6 имеет в себе свойство улучшать качество звука, отделяя голоса от фонового шума, чтобы обеспечить Вам идеально четкое прослушивание.&nbsp;Насладитесь идеальным соотношением идеального звучания и высокого качество изображения.</p>', 'Новый', 2, NULL),
(33, 50, 22, 1, NULL, 200, NULL, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', NULL, '2990000.00', NULL, '<p>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</p>', '<pre><span style=\"color: #008000; font-family: DejaVu Sans Mono;\"><span style=\"font-size: 12px;\"><strong>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</strong></span></span><span style=\"font-family: DejaVu Sans Mono;\"><span style=\"font-size: 9pt;\"><br /></span></span></pre>', 'no', 'no', NULL, 'yes', NULL, 'smartfon-iphone-x-64-gb-silver-gray', 3, 1, 0, 22, 1550687699, 1550679246, 0, 60, NULL, NULL, NULL, '<p>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</p>', 'Новый', 22, NULL),
(34, 6, 24, 1, 1, 100, NULL, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', NULL, '8100000.00', NULL, '<p>sasa</p>', '<p>dassa</p>', 'no', 'no', NULL, 'yes', NULL, 'smartfon-iphone-x-64-gb-silver-gray-2', 9, 1, 0, 24, 1551028366, 1551028366, 0, 23, NULL, NULL, NULL, '<p>asasa</p>', 'Новый', 24, NULL),
(35, 6, 6, 1, 1, 5, NULL, 'СМАРТФОН IPHONE X 64 GB SILVER, GRAY', NULL, '18000000.00', NULL, '<p>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</p>', '<p>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</p>', 'no', 'no', NULL, 'yes', NULL, 'smartfon-iphone-x-64-gb-silver-gray-3', 11, 1, 0, 6, 1551502913, 1551464282, 0, 10, NULL, NULL, NULL, '<p>СМАРТФОН IPHONE X 64 GB SILVER, GRAY</p>', 'Новый', 6, NULL),
(36, 6, 6, 3, 1, 5, NULL, 'APPLE MACBOOK PRO 13 8/256', NULL, '15444000.00', NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">APPLE MACBOOK PRO 13 8/256</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'apple-macbook-pro-13-8256', 11, 1, 0, 6, 1551507299, 1551465901, 0, 6, NULL, NULL, NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">APPLE MACBOOK PRO 13 8/256</h1>', 'Новый', 6, NULL),
(37, 6, 24, 1, 1, 5, NULL, 'КОНДИЦИОНЕР MIDEA MISSION 3D DC INVERTER 18 (РАБОТАЕТ ПРИ -20 С)', NULL, '7000000.00', NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; line-height: 20px; color: #2e3a47; text-transform: uppercase; background-color: #ffffff;\">КОНДИЦИОНЕР MIDEA MISSION 3D DC INVERTER 18 (РАБОТАЕТ ПРИ -20 С)</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'kondicioner-midea-mission-3d-dc-inverter-18-rabotaet-pri--20-s', 9, 1, 0, 24, 1551623266, 1551623266, 0, 2, NULL, NULL, NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; line-height: 20px; color: #2e3a47; text-transform: uppercase; background-color: #ffffff;\">КОНДИЦИОНЕР MIDEA MISSION 3D DC INVERTER 18 (РАБОТАЕТ ПРИ -20 С)</h1>', 'Новый', 24, NULL),
(38, 46, 24, 1, 1, 5, NULL, 'КОМПЛЕКТ СПУТНИКОВОГО ТВ МТС (150 КАНАЛОВ) С УСТАНОВКОЙ ', NULL, '603000.00', NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; line-height: 20px; color: #2e3a47; text-transform: uppercase; background-color: #ffffff;\">КОМПЛЕКТ СПУТНИКОВОГО ТВ МТС (150 КАНАЛОВ) С УСТАНОВКОЙ ПОД КЛЮЧ + 1 ГОД БЕСПЛАТНОГО ПРОСМОТРА</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'komplekt-sputnikovogo-tv-mts-150-kanalov-s-ustanovkoy-pod-klyuch--1-god-besplatnogo-prosmotra', 9, 1, 0, 24, 1551788040, 1551623362, 0, 4, NULL, NULL, NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; line-height: 20px; color: #2e3a47; text-transform: uppercase; background-color: #ffffff;\">КОМПЛЕКТ СПУТНИКОВОГО ТВ МТС (150 КАНАЛОВ) С УСТАНОВКОЙ ПОД КЛЮЧ + 1 ГОД БЕСПЛАТНОГО ПРОСМОТРА</h1>', 'Новый', 24, NULL),
(40, 21, 24, 3, 1, 5, NULL, 'ПРОДЛЕНИЕ ПОДПИСКИ \"МТС ТВ\" НА 1 ГОД', NULL, '220000.00', NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">ПРОДЛЕНИЕ ПОДПИСКИ \"МТС ТВ\" НА 1 ГОД</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'prodlenie-podpiski-mts-tv-na-1-god', 9, 1, 0, 24, 1551624344, 1551624036, 0, 18, NULL, NULL, NULL, '<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">ПРОДЛЕНИЕ ПОДПИСКИ \"МТС ТВ\" НА 1 ГОД</h1>', 'Новый без ярлыков', 24, NULL),
(41, 178, 24, 1, 1, 5, NULL, 'СМАРТ БРАСЛЕТ XIAOMI MI BAND 3 (РУССКОЕ МЕНЮ)', NULL, '269000.00', NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">СМАРТ БРАСЛЕТ XIAOMI MI BAND 3 (РУССКОЕ МЕНЮ)</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'smart-braslet-xiaomi-mi-band-3-russkoe-menyu', 9, 1, 0, 24, 1551624457, 1551624457, 0, 4, NULL, NULL, NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">СМАРТ БРАСЛЕТ XIAOMI MI BAND 3 (РУССКОЕ МЕНЮ)</h1>', 'Новый', 24, NULL),
(42, 54, 24, 1, 1, 5, NULL, 'ЖОРЖ ОРУЭЛЛ: МОЛХОНА', NULL, '14000.00', NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">ЖОРЖ ОРУЭЛЛ: МОЛХОНА</h1>', NULL, 'no', 'no', NULL, 'yes', NULL, 'zhorzh-oruell-molhona', 9, 1, 0, 24, 1551624532, 1551624532, 0, 5, NULL, NULL, NULL, '<div class=\"review\" style=\"box-sizing: border-box; color: #2e3a47; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">&nbsp;</div>\r\n<h1 style=\"box-sizing: border-box; font-size: 18px; margin: 0px 0px 20px; font-family: \'Open Sans\', Arial, sans-serif; font-weight: 600; line-height: 20px; color: #2e3a47; text-transform: uppercase; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-style: initial; text-decoration-color: initial;\">ЖОРЖ ОРУЭЛЛ: МОЛХОНА</h1>', 'Новый с ярлыками', 24, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_ads`
--

CREATE TABLE `product_ads` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type_ads` tinyint(4) NOT NULL,
  `price_ads` decimal(19,2) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_ads`
--

INSERT INTO `product_ads` (`id`, `seller_id`, `product_id`, `type_ads`, `price_ads`, `sts`, `created_at`, `created_by`) VALUES
(2, 6, 36, 1, '100000.00', 1, 1551507278, 6),
(3, 24, 40, 1, '2000.00', 1, 1551624036, 24);

-- --------------------------------------------------------

--
-- Table structure for table `product_attr`
--

CREATE TABLE `product_attr` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attr_name_id` varchar(255) DEFAULT NULL,
  `attr_name` varchar(255) DEFAULT NULL,
  `attr_value` varchar(255) DEFAULT NULL,
  `is_group` smallint(6) DEFAULT NULL,
  `is_filter` tinyint(4) NOT NULL,
  `is_main` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_attr`
--

INSERT INTO `product_attr` (`id`, `product_id`, `attr_name_id`, `attr_name`, `attr_value`, `is_group`, `is_filter`, `is_main`) VALUES
(1, 1, NULL, 'Свойства продукции ', '', 1, 0, 0),
(2, 1, NULL, 'Масса нетто', '450 гр', 0, 0, 1),
(3, 1, NULL, 'Срок годности', '24 месяца', 0, 0, 0),
(4, 2, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(5, 2, NULL, 'Кальций', '10-25', 0, 0, 0),
(6, 2, NULL, 'Магний', '8-25', 0, 0, 0),
(7, 2, NULL, 'Хлорид', '8-25', 0, 0, 0),
(8, 2, NULL, 'Сульфат', '40-80', 0, 0, 0),
(9, 2, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(10, 3, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(11, 3, NULL, 'Кальций', '10-25', 0, 0, 0),
(12, 3, NULL, 'Магний ', '8-25', 0, 0, 0),
(13, 3, NULL, 'Хлорид', '8-25', 0, 0, 0),
(14, 3, NULL, 'Сульфат', '40-80', 0, 0, 0),
(15, 3, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(16, 4, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(17, 4, NULL, 'Кальций', '10-25', 0, 0, 0),
(18, 4, NULL, 'Магний', '8-25', 0, 0, 0),
(19, 4, NULL, 'Хлорид', '8-25', 0, 0, 0),
(20, 4, NULL, 'Сульфат', '40-80', 0, 0, 0),
(21, 4, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(22, 5, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(23, 5, NULL, 'Кальций', '10-25', 0, 0, 0),
(24, 5, NULL, 'Магний', '8-25', 0, 0, 0),
(25, 5, NULL, 'Хлорид', '8-25', 0, 0, 0),
(26, 5, NULL, 'Сульфат', '40-80', 0, 0, 0),
(27, 5, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(28, 6, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(29, 6, NULL, 'Кальций', '10-25', 0, 0, 0),
(30, 6, NULL, 'Магний', '8-25', 0, 0, 0),
(31, 6, NULL, 'Хлорид', '8-25', 0, 0, 0),
(32, 6, NULL, 'Сульфат', '40-80', 0, 0, 0),
(33, 6, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(34, 7, NULL, 'Свойства продукции ', 'мг/л', 1, 0, 0),
(35, 7, NULL, 'Кальций', '10-25', 0, 0, 0),
(36, 7, NULL, 'Магний', '8-25', 0, 0, 0),
(37, 7, NULL, 'Хлорид', '8-25', 0, 0, 0),
(38, 7, NULL, 'Сульфат', '40-80', 0, 0, 0),
(39, 7, NULL, 'Бикарбонат', '15-40', 0, 0, 0),
(40, 8, NULL, 'Вес', '3,5 кг', 0, 0, 0),
(41, 9, NULL, 'Номинальный объём', '100 мл', 1, 0, 0),
(42, 10, NULL, 'Вес', '4,5 кг', 1, 0, 0),
(43, 11, NULL, 'Вес 1,8кг', '', 1, 0, 0),
(44, 12, NULL, 'Вес 3кг', '', 1, 0, 0),
(45, 13, NULL, 'Вес 900гр', '', 1, 0, 0),
(46, 14, NULL, 'Вес 900гр', '', 1, 0, 0),
(47, 15, NULL, 'Вес 1,5 кг', '', 1, 0, 0),
(48, 16, NULL, 'Coca Cola', '', 0, 0, 0),
(52, 20, NULL, 'Coca Cola', '', 0, 0, 0),
(53, 21, NULL, 'Coca Cola', '', 0, 0, 0),
(54, 22, NULL, 'Fanta 0,5л', '', 0, 0, 0),
(55, 23, NULL, 'Coca Cola', '', 0, 0, 0),
(56, 24, NULL, 'Fanta 1л', '', 0, 0, 0),
(57, 25, NULL, 'Fanta 1,5л', '', 0, 0, 0),
(58, 26, NULL, 'Sprite 0,5л', '', 0, 0, 0),
(59, 27, NULL, 'Sprite 1л', '', 0, 0, 0),
(60, 28, NULL, 'Sprite 1,5л', '', 0, 0, 0),
(61, 29, NULL, 'Fuse Tea 0,450л', '', 0, 0, 0),
(62, 30, NULL, 'Fuse Tea 0,450л со вкусом Лимона', '', 0, 0, 0),
(65, 32, NULL, 'ОБЩИЕ ХАРАКТЕРИСТИКИ', '', 1, 0, 1),
(66, 32, NULL, 'Тип', 'смартфон', 0, 0, 0),
(67, 33, NULL, 'ОБЩИЕ ХАРАКТЕРИСТИКИ', '', 1, 0, 0),
(68, 33, NULL, 'Тип', 'смартфон', 0, 0, 0),
(69, 33, NULL, 'Версия ОС ', 'iOS 11', 0, 0, 0),
(70, 33, NULL, 'Тип корпуса ', 'классический', 0, 0, 0),
(71, 33, NULL, 'Материал корпуса', 'стекло', 0, 0, 0),
(72, 34, NULL, 'sas', 'asasa', 0, 0, 0),
(73, 35, NULL, '', '', 0, 0, 0),
(74, 36, NULL, '', '', 0, 0, 0),
(75, 37, NULL, '', '', 0, 0, 0),
(76, 38, NULL, '', '', 0, 0, 0),
(78, 40, NULL, '', '', 0, 0, 0),
(79, 41, NULL, '', '', 0, 0, 0),
(80, 42, NULL, '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img_path` text,
  `sort` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `star_rating` tinyint(3) NOT NULL,
  `otziv_text` varchar(500) NOT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `fathername` varchar(32) NOT NULL,
  `tell` varchar(32) NOT NULL,
  `role` varchar(32) NOT NULL,
  `adress` varchar(200) NOT NULL,
  `is_juridical` int(11) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `region_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `name_magazin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `firstname`, `lastname`, `fathername`, `tell`, `role`, `adress`, `is_juridical`, `status`, `region_id`, `created_at`, `updated_at`, `created_by`, `name_magazin`) VALUES
(2, 'Suhrob', 'Ahmedov', 'Ilhomovich', '+998906039080', 'super_admin', '', 10, 0, 11, 1533699575, 1533699730, NULL, 'dasturchiuz@gmail.com'),
(3, 'Suhrob', 'Ahmedov', 'Ilhomovich', '998939943553', 'client_juridical', '', 10, 10, 11, 1538026095, 1538043360, NULL, 'alior'),
(4, 'Suhrob', 'Ahmedov', 'Ilhomovich', '998906039080', 'client', '', 10, 10, 11, 1538042650, 1538043136, NULL, 'alior_uz'),
(5, 'Сухроб', 'Ахмедов', 'Илхомович', '+998(93)994-3553', 'admin', 'Мир Саид Барака 32', 10, 10, 11, 1538044990, 1538044990, 2, 'ewrwerfwefwerfqwrdf'),
(6, 'Фаррух', 'Ахроркулов', 'Равшанович', '+998(91)315-26-26', 'regional_managers', 'г. Самарканд БИЙ (Согдиана)', 10, 10, 11, 1538055730, 1538055776, 5, 'dsfsdefewrtew'),
(7, 'Djamol', 'Djurayev', 'Nigmatovich', '998939960505', 'client', '', 10, 10, 11, 1538714093, 1538891268, NULL, 'qrwef233'),
(8, 'Икром', 'Шарофзода', 'Илхомович', '998662337731', 'client_juridical', '', 10, 0, 11, 1538825209, 1538829324, 2, 'ewrewr23432'),
(9, 'Андрей', 'Степанов', '123123123', '998999999999', 'client', '', 10, 20, 2, 1540205581, 1543388613, NULL, '432erwqrwqr'),
(10, 'Андрей', 'Степанов', '1111', '998', 'client', '', 10, 20, 1, 1540207288, 1543388603, NULL, 'wqeeqwerrr3243243'),
(11, 'DIlsh', 'Dilsh', 'Dilsh', '998999999988', 'client', '', 10, 0, 1, 1550636042, 1550636042, NULL, 'eqweqweqwewqeqweqweq'),
(12, 'asdasdsa', 'dsad', 'sadsadasd', '998999999998', 'client', '', 10, 0, 12, 1550636313, 1550636313, NULL, 'weweweqweqeqweq'),
(15, 'fdsfdsfdsf', 'fdsfds', 'fdsfsdfdsf', '998787878787', 'client', '', 10, 0, 1, 1550636470, 1550636470, NULL, 'asdasdaewewew'),
(16, 'fdsfdsfdsf', 'fdsfds', 'fdsfsdfdsf', '998787878781', 'client', '', 10, 0, 1, 1550637436, 1550637436, NULL, 'sadaeweweewewe'),
(18, 'fdsfdsfdsf', 'fdsfds', 'fdsfsdfdsf', '998787878783', 'client', '', 10, 0, 1, 1550637574, 1550637574, NULL, 'sadawewew'),
(19, 'sss', 'dd', 'ssss', '998999997787', 'client', '', 10, 0, 1, 1550638104, 1550638104, NULL, 'qwe2'),
(20, 'qqqqqqqqqqqqq', 'qqqqqqqq', 'wwwwwwwwwwwwww', '998878778778', 'client', '', 10, 0, 1, 1550640167, 1550640167, NULL, 'qwqwqwq'),
(22, 'Dilshod', 'Tursimatov', 'sadsadasd', '998987788788', 'client', '', 10, 10, 3, 1550642233, 1550642277, NULL, 'DilshodDeveloper'),
(23, 'Dilshod', 'Tursimatov', 'dsadasd', '998777777775', 'client', '', 10, 0, 12, 1550642339, 1550642339, NULL, 'sssssssss'),
(24, 'Dilshod', 'Tursimatov', 'Sh', '998936135050', 'client_juridical', '', 10, 10, 9, 1551027841, 1551027908, NULL, 'dasturchi'),
(25, 'StantComputers', 'StantComputers', 'StantComputers', '998787878711', 'client_juridical', '', 10, 10, 8, 1551068163, 1551068384, NULL, 'StandComputers');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name_obl` varchar(64) NOT NULL,
  `strana_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name_obl`, `strana_id`, `status`) VALUES
(1, 'Каракалпакстан', 1, 1),
(2, 'Андижанская область ', 1, 1),
(3, 'Наманганская область ', 1, 1),
(4, 'Ферганская область', 1, 1),
(5, 'Бухарская область', 1, 1),
(6, 'Хорезмская область', 1, 1),
(7, 'Сурхандарьинская область', 1, 1),
(8, 'Кашкадарьинская область', 1, 1),
(9, 'Джизакская область ', 1, 1),
(10, 'Навоийская область', 1, 1),
(11, 'Самаркандская область', 1, 1),
(12, 'Сырдарьинская область', 1, 1),
(13, 'Ташкентская область', 1, 1),
(14, 'Ташкент', 1, 1),
(15, 'Самарканд ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `search_log`
--

CREATE TABLE `search_log` (
  `id` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `search_log`
--

INSERT INTO `search_log` (`id`, `session_id`, `user_id`, `keyword`, `ip`, `created_at`, `updated_at`) VALUES
(1, 'si1jvcuf2cv0qgo07dfa0eksls', 22, 'asd', '127.0.0.1', 1551287542, 1551287542),
(2, 'q9buq8cff12fl50b8fflp07t9p', 6, 'sss', '127.0.0.1', 1551509605, 1551509605),
(3, 'q9buq8cff12fl50b8fflp07t9p', 6, 'sss', '127.0.0.1', 1551509684, 1551509684);

-- --------------------------------------------------------

--
-- Table structure for table `sklad`
--

CREATE TABLE `sklad` (
  `id` int(11) NOT NULL,
  `name_sk` varchar(200) NOT NULL,
  `region_id_sk` int(11) NOT NULL,
  `adress_sk` varchar(255) NOT NULL,
  `phone_sk` varchar(15) NOT NULL,
  `responsible_sk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status_shop`
--

CREATE TABLE `status_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `sts` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_shop`
--

INSERT INTO `status_shop` (`id`, `name`, `sts`) VALUES
(1, 'Магазин', 1),
(2, 'Ресторан', 1),
(3, 'кафе', 1),
(4, 'Бар', 1),
(5, 'Гостиница', 1),
(6, 'Производство', 1),
(7, 'Дистрибьютор', 1),
(8, 'Услуги населению', 1),
(9, 'Импортёр', 1),
(10, 'Другое', 1);

-- --------------------------------------------------------

--
-- Table structure for table `strana`
--

CREATE TABLE `strana` (
  `id` int(11) NOT NULL,
  `strana_name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `sort_strana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strana`
--

INSERT INTO `strana` (`id`, `strana_name`, `sort_strana`) VALUES
(1, 'Узбекистан', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `unit_desc` varchar(100) DEFAULT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `unit_name`, `status`, `created_at`, `unit_desc`, `updated_at`) VALUES
(1, 'шт', 10, 2147483647, 'Дона', 2147483647),
(2, 'пач', 10, 1530337377, 'Пачка', 1530337377),
(3, 'кв', 10, 1530593023, 'Киловат', 1530593023),
(4, 'мл', 10, 1530593063, 'миллилитр', 1530593109),
(5, 'литр', 10, 1530593139, 'литр', 1530593139),
(6, 'кв2', 10, 1530593582, 'квадратный метр', 1530593582),
(7, 'м3', 10, 1530593629, 'куб', 1530593629),
(8, 'мм', 10, 1530594988, 'миллиметр', 1530594988),
(9, 'см', 10, 1530595011, 'сантиметр', 1530595011),
(10, 'метр', 10, 1530595036, 'метр', 1530595036),
(11, 'км', 10, 1530595068, 'километр', 1530595068),
(12, 'Кб', 10, 1530595111, 'килобайт', 1530595111),
(13, 'Мб', 10, 1530595135, 'мегобайт', 1530595135),
(14, 'Гб', 10, 1530595157, 'гегобайт', 1530595157),
(15, 'Тб', 10, 1530595180, 'теробайт', 1530595180),
(16, 'Мг', 10, 1530595245, 'миллиграм', 1530595245),
(17, 'Гр', 10, 1530595268, 'грамм', 1530595268),
(18, 'кг', 10, 1530595294, 'киллограм', 1530595294),
(19, 'Тон', 10, 1530595321, 'тон', 1530595321);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `user_id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `telefon`, `status`, `created_at`, `updated_at`) VALUES
(2, 'SUPERADMIN', 'UZB2', 'XFNsm1xYrEyrnrLPzO5ZYtZ_BJBG1YtV', '$2y$13$Z/XcyJ8QyUJhqx4pMiLWl.q1G/RvPFJyVwUXDnBMWAm77BUE32PYG', NULL, 'dasturchsiuz@gmail.com', '998936135045', 10, 1533699575, 1533699730),
(3, 'UZ3', 'UZB2', 'kMBI8yrty7qGEZFl8WLK-fOgxjki8Xvw', '$2y$13$V6PfOxcRfiqNMGoiiC0hM.mis53RMOFFPyKt5pjZbKBMosQxaeIui', NULL, 'sukhrob3000@mail.ru', '998939943553', 10, 1538026095, 1538043360),
(4, 'UZB4', NULL, 'Xa9Urle5HgYsIJVnzVraGWuyxO8mnJaF', '$2y$13$duTwS04XKG2IqgQWf7EiO./927jmb8Je35PFxT/ojfZrFvIBgvPDC', NULL, 'sukhrob3000@yandex.ru', '998906039080', 10, 1538042650, 1538043136),
(5, 'SamAdmin', NULL, '', '$2y$13$75Gt2IkLuEl40v1cJ2nVIOQ3geF6C0P07p7Mn/fN3K5R8Om57VNJG', NULL, 'forexclasik@gmail.com', '', 10, 1538044990, 1538045304),
(6, 'Farruh', NULL, '', '$2y$13$Z/XcyJ8QyUJhqx4pMiLWl.q1G/RvPFJyVwUXDnBMWAm77BUE32PYG', NULL, 'Farruh1405@gmail.com', '', 10, 1538055730, 1541858580),
(7, 'UZB7', NULL, 'uhswJrqpJoqH1Ltb7SXZGIZEq--zALcX', '', NULL, 'djuraev.djamol@mail.ru', '998939960505', 10, 1538714093, 1538891268),
(8, 'UZ8', NULL, 'LTN0JTZj4hEp6DomKW9MwORrLo4BKjHG', '', '', 'ikrom.sharofzoda1@mail.ru', '998662337731', 0, 1538825209, 1538829324),
(9, 'UZB9', NULL, 'c9tOOgXvwKiLE0FlfKJ2J3oqWmn3F70d', '', NULL, 'and.step89@bk.ru', '998999999999', 20, 1540205581, 1543388613),
(10, 'UZB10', NULL, 'TEyrYAo1NY-zHRR2M09uw849pinTNOEJ', '', NULL, 'and.stedp89@bk.ru', '998', 20, 1540207288, 1543388603),
(11, 'UZB11', NULL, '1qZ98KXFbjajUkQWImlJmlO7pxxaIbxq', '', NULL, 'dddddd@dddd.uz', '998999999988', 0, 1550636042, 1550636042),
(12, 'UZB12', NULL, 'HQSGVBC_raZYgPk5DiveRF-zoOajfzgL', '', NULL, '99ssssss@sss.uz', '998999999998', 0, 1550636313, 1550636313),
(15, 'UZB15', NULL, 'Ho_3ZOFYe298-VwWppS7gBlHXsvjYGQS', '', NULL, 'dsadsadsadsad@dsadasd.sa', '998787878787', 0, 1550636470, 1550636470),
(16, 'UZB16', NULL, 'KML5wCCSRreNTfIz8BlHrcEfV3wn9XiN', '', NULL, 'dsadsadsadsad@dsa.sa', '998787878781', 0, 1550637436, 1550637436),
(18, 'UZB18', NULL, 'w_dqP4OT1HQj18W1zULS25-UYECZ6DC7', '', NULL, 'dsadsadsdadsad@dsa.sa', '998787878783', 0, 1550637574, 1550637574),
(19, 'UZB19', NULL, '_MfG6stpb7mQhIimfgs9NH8kbd-Du02y', '', NULL, 'dasdasdsa@ddddd.ss', '998999997787', 0, 1550638104, 1550638104),
(20, 'UZB20', NULL, 'IOMY1rAuiAvvyKzvaB6XFlTTb--Kzz-A', '', NULL, 'jauxar@inbox.uz', '998878778778', 0, 1550640167, 1550640167),
(22, 'dilshod', 'UZB22', 'hvcpJ8XaWqSWqKLn22rm2AvEKsunYqPy', '$2y$13$Z/XcyJ8QyUJhqx4pMiLWl.q1G/RvPFJyVwUXDnBMWAm77BUE32PYG', NULL, 'dasturchiu1z@mail.ru', '998987788788', 10, 1550642233, 1550642277),
(23, 'UZB23', 'UZB23', 'tLyVk8O5qvYMiI-hUTrtYbxpzPWy4sj-', '', NULL, 'dasturchiuz@mail.ru', '998777777775', 0, 1550642339, 1550642339),
(24, 'DasturchiUZ', 'UZ24', 'QnxB1sCMX3AWS-0mJbaVnlakPlfS1Pe-', '$2y$13$xcGOe0g5y/qqztA/005Kc.a6BrIXLGOUx5DDF5Pf7ZdIPLZpGoYO.', NULL, 'dasturcwqhiuz@gmail.com', '998936135050', 10, 1551027841, 1551027908),
(25, 'StandComputers', 'UZ25', 'VnGq007Z-7QOOO9tx2uayTZ-KzQpgV4M', '$2y$13$nCMhlQC5vc7skb7eLC4lg.kD/7m8EWme89BLC611/of3YbARNl6FK', NULL, 'dasturchiuz@gmail.com', '998787878711', 10, 1551068163, 1551068384);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `id` int(11) NOT NULL,
  `path_to_file` varchar(255) NOT NULL,
  `mimeType` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `path_to_file`, `mimeType`, `user_id`) VALUES
(3, '/var/www/alior/alior/userimages/UZ24.jpg', 'image/jpeg', 24);

-- --------------------------------------------------------

--
-- Table structure for table `weeks_client_list`
--

CREATE TABLE `weeks_client_list` (
  `id` int(11) NOT NULL,
  `week_number` tinyint(4) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `role_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `model`, `item_id`) VALUES
(1, 3, 'app\\models\\Product', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-adresses-region-id` (`strana_id`),
  ADD KEY `fk-adresses-oblast-id` (`oblast_id`),
  ADD KEY `fk-cityid-cities-id` (`city_id`),
  ADD KEY `fk-profile-id-adress` (`profile_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-chatroomcreate-user-id` (`created_by`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-cities-region-id` (`region_id`);

--
-- Indexes for table `comment_profile`
--
ALTER TABLE `comment_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_our`
--
ALTER TABLE `contact_our`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_loaded_products`
--
ALTER TABLE `courier_loaded_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debitor`
--
ALTER TABLE `debitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_method`
--
ALTER TABLE `delivery_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager_mediafile_tag`
--
ALTER TABLE `filemanager_mediafile_tag`
  ADD KEY `filemanager_mediafile_tag_mediafile_id__mediafile_id` (`mediafile_id`),
  ADD KEY `filemanager_mediafile_tag_tag_id__tag_id` (`tag_id`);

--
-- Indexes for table `filemanager_owners`
--
ALTER TABLE `filemanager_owners`
  ADD PRIMARY KEY (`mediafile_id`,`owner_id`,`owner`,`owner_attribute`);

--
-- Indexes for table `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ImageManager`
--
ALTER TABLE `ImageManager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pay_id` (`pay_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `juridical`
--
ALTER TABLE `juridical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketplace`
--
ALTER TABLE `marketplace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_t`
--
ALTER TABLE `messages_t`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-messages_t-receiver_id` (`receiver_id`),
  ADD KEY `fk-messages_t-sender_id` (`sender_id`),
  ADD KEY `fk-messages_t-chat-id` (`chatroom_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newscategory`
--
ALTER TABLE `newscategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notfications`
--
ALTER TABLE `notfications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-notify-profile` (`profile_id`),
  ADD KEY `fk-notify-type` (`notfy_type_id`);

--
-- Indexes for table `notify_type`
--
ALTER TABLE `notify_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_customers`
--
ALTER TABLE `no_customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `pay_method_id` (`pay_method_id`),
  ADD KEY `fk-region-idыыы` (`region_id`) USING BTREE,
  ADD KEY `fk_seller_profile` (`seller_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-orders-id` (`order_id`),
  ADD KEY `fk-productw-id` (`product_id`);

--
-- Indexes for table `order_status_history`
--
ALTER TABLE `order_status_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payme_uz`
--
ALTER TABLE `payme_uz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_method`
--
ALTER TABLE `pay_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `profile_id` (`profile_id`),
  ADD KEY `fk-product-manufacturer_id` (`manufacturer_id`),
  ADD KEY `unit_idindx` (`unit_id`),
  ADD KEY `aproval_idindx` (`aproval_id`),
  ADD KEY `user_idindx` (`user_id`);

--
-- Indexes for table `product_ads`
--
ALTER TABLE `product_ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seller_id_products_ads` (`seller_id`),
  ADD KEY `fk_product_id_products_ads` (`product_id`);

--
-- Indexes for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-product_attr-id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-images-id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-reviews-user-id` (`user_id`),
  ADD KEY `fk-reviews-product-id` (`product_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `idx-profile-user_id` (`user_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-regions-strana-id` (`strana_id`);

--
-- Indexes for table `search_log`
--
ALTER TABLE `search_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sklad`
--
ALTER TABLE `sklad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_shop`
--
ALTER TABLE `status_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strana`
--
ALTER TABLE `strana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UN_user` (`email`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userimages_profile_user_id` (`user_id`);

--
-- Indexes for table `weeks_client_list`
--
ALTER TABLE `weeks_client_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `chatroom`
--
ALTER TABLE `chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `comment_profile`
--
ALTER TABLE `comment_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `contact_our`
--
ALTER TABLE `contact_our`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courier_loaded_products`
--
ALTER TABLE `courier_loaded_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `debitor`
--
ALTER TABLE `debitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_method`
--
ALTER TABLE `delivery_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filemanager_mediafile`
--
ALTER TABLE `filemanager_mediafile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filemanager_tag`
--
ALTER TABLE `filemanager_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `ImageManager`
--
ALTER TABLE `ImageManager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `juridical`
--
ALTER TABLE `juridical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marketplace`
--
ALTER TABLE `marketplace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages_t`
--
ALTER TABLE `messages_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newscategory`
--
ALTER TABLE `newscategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notfications`
--
ALTER TABLE `notfications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_type`
--
ALTER TABLE `notify_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `no_customers`
--
ALTER TABLE `no_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_status_history`
--
ALTER TABLE `order_status_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payme_uz`
--
ALTER TABLE `payme_uz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_method`
--
ALTER TABLE `pay_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product_ads`
--
ALTER TABLE `product_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_attr`
--
ALTER TABLE `product_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `search_log`
--
ALTER TABLE `search_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sklad`
--
ALTER TABLE `sklad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_shop`
--
ALTER TABLE `status_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `strana`
--
ALTER TABLE `strana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `weeks_client_list`
--
ALTER TABLE `weeks_client_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk-adresses-oblast-id` FOREIGN KEY (`oblast_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-adresses-region-id` FOREIGN KEY (`strana_id`) REFERENCES `strana` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-cityid-cities-id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-profile-id-adress` FOREIGN KEY (`profile_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatroom`
--
ALTER TABLE `chatroom`
  ADD CONSTRAINT `fk-chatroomcreate-user-id` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `fk-cities-region-id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `filemanager_mediafile_tag`
--
ALTER TABLE `filemanager_mediafile_tag`
  ADD CONSTRAINT `filemanager_mediafile_tag_mediafile_id__mediafile_id` FOREIGN KEY (`mediafile_id`) REFERENCES `filemanager_mediafile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filemanager_mediafile_tag_tag_id__tag_id` FOREIGN KEY (`tag_id`) REFERENCES `filemanager_tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filemanager_owners`
--
ALTER TABLE `filemanager_owners`
  ADD CONSTRAINT `filemanager_owners_ref_mediafile` FOREIGN KEY (`mediafile_id`) REFERENCES `filemanager_mediafile` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk-incode-invoice-id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages_t`
--
ALTER TABLE `messages_t`
  ADD CONSTRAINT `fk-messages_t-chat-id` FOREIGN KEY (`chatroom_id`) REFERENCES `chatroom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-messages_t-receiver_id` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-messages_t-sender_id` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notfications`
--
ALTER TABLE `notfications`
  ADD CONSTRAINT `fk-notify-profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-notify-type` FOREIGN KEY (`notfy_type_id`) REFERENCES `notify_type` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk-region-id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_seller_profile` FOREIGN KEY (`seller_id`) REFERENCES `profile` (`user_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk-orders-id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-productw-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk-product-manufacturer_id` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturer` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ads`
--
ALTER TABLE `product_ads`
  ADD CONSTRAINT `fk_product_id_products_ads` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_seller_id_products_ads` FOREIGN KEY (`seller_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD CONSTRAINT `fk-product_attr-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk-images-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `fk-reviews-product-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-reviews-user-id` FOREIGN KEY (`user_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk-profile-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `fk-regions-strana-id` FOREIGN KEY (`strana_id`) REFERENCES `strana` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `fk_userimages_profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `weeks_client_list`
--
ALTER TABLE `weeks_client_list`
  ADD CONSTRAINT `fk-weeks-client_id` FOREIGN KEY (`client_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-weeks-created_by` FOREIGN KEY (`created_by`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-weeks-user_id` FOREIGN KEY (`user_id`) REFERENCES `profile` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
