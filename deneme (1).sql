-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 04:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deneme`
--

-- --------------------------------------------------------

--
-- Table structure for table `formalanbilgileri`
--

CREATE TABLE `formalanbilgileri` (
  `alan_id` int(11) NOT NULL,
  `aitoldugu_form_turu_id` int(11) NOT NULL,
  `alan_turu` varchar(20) NOT NULL,
  `ait_oldugu_bolge_id` int(11) NOT NULL,
  `alan_aciklama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formalanbilgileri`
--

INSERT INTO `formalanbilgileri` (`alan_id`, `aitoldugu_form_turu_id`, `alan_turu`, `ait_oldugu_bolge_id`, `alan_aciklama`) VALUES
(389, 156, 'textbox', 199, 'Protokol'),
(390, 156, 'textbox', 199, 'Öğrenci Ebe'),
(391, 156, 'textbox', 199, 'Onaylayan'),
(392, 156, 'textbox', 200, 'Adı Soyadı'),
(393, 156, 'textbox', 200, 'Yaşı'),
(394, 156, 'textbox', 200, 'Boyu'),
(395, 156, 'textbox', 200, 'Gebelik Başlangıcında Kilosu'),
(396, 156, 'textbox', 200, 'Şimdiki Kilosu'),
(397, 156, 'textbox', 200, 'Kan Grubu'),
(398, 156, 'textbox', 200, 'Eşinin Kan Grubu'),
(399, 156, 'textbox', 200, 'Eşinin Akrabalık Derecesi'),
(400, 156, 'textbox', 200, 'Menarş Yaşı'),
(401, 156, 'textbox', 200, 'Son Adet Tarihi'),
(402, 156, 'textbox', 200, 'Tahmini Doğum Tarihi'),
(403, 156, 'textbox', 200, 'Gebelik Sayısı'),
(404, 156, 'textbox', 200, 'Yaşayan Çocuk Sayısı'),
(405, 156, 'textbox', 200, 'Düşük Sayısı İsteyerek/Spontan'),
(406, 156, 'textbox', 200, 'Ölen Çocuk Sayısı'),
(407, 156, 'textbox', 200, 'Ölü Doğum Sayısı'),
(408, 156, 'textbox', 200, 'Son Doğumun Sonlandığı Tarih'),
(409, 156, 'textbox', 200, 'Erken Doğum Hikayesi'),
(410, 156, 'textbox', 200, 'İlk 24 saat içinde sarılığı olan bebek doğmuş mu? '),
(411, 156, 'textbox', 200, 'Sakatlığı olan bebek doğmuş mu ?'),
(412, 156, 'textbox', 200, 'Önceki Doğum Şekli Vajinal Doğum Sezaryen Vakum Forseps... '),
(413, 156, 'textbox', 200, 'Önceki Doğumların Yapıldığı Yer Evde Yardımsız Evde Ebe Hastane... '),
(414, 156, 'textbox', 200, 'Gebelik Öncesi Sistemik Bir Hastalık Varlığı Diabet Kalp vs. '),
(415, 156, 'textbox', 200, 'Gebelik Öncesi Kullandığı A.P Yöntemi '),
(416, 156, 'textbox', 200, 'Tetanoz Aşısı Yaptırma Durumu '),
(417, 156, 'textbox', 200, 'Fe Ca vs preparatı alıyor mu ?'),
(418, 156, 'textbox', 200, 'Başka kullandığı ilaçlar var mı ?'),
(419, 156, 'textbox', 202, 'Kan Basıncı'),
(420, 156, 'textbox', 202, 'Nabız'),
(421, 156, 'textbox', 202, 'Ateş'),
(422, 156, 'textbox', 202, 'ÇKS'),
(423, 156, 'textbox', 202, 'Meme Ucu Muayenesi İçe Çökük Çok Büyük Kolostrum...'),
(424, 156, 'textbox', 203, 'I. Loepold'),
(425, 156, 'textbox', 203, 'II.  Loepold'),
(426, 156, 'textbox', 203, 'III.  Loepold'),
(427, 156, 'textbox', 203, 'IV.  Loepold'),
(428, 156, 'date', 199, 'Tarih'),
(429, 156, 'veritablocheck', 201, ''),
(430, 157, 'textbox', 204, 'Protokol'),
(431, 157, 'textbox', 204, 'Öğrenci Ebe'),
(432, 157, 'textbox', 204, 'Onaylayan'),
(433, 157, 'textbox', 205, 'Adı Soyadı'),
(434, 157, 'textbox', 205, 'Yaşı'),
(435, 157, 'textbox', 205, 'Boyu'),
(436, 157, 'textbox', 205, 'Gebelik Başlangıcında Kilosu'),
(437, 157, 'textbox', 205, 'Şimdiki Kilosu'),
(438, 157, 'textbox', 205, 'Kan Grubu'),
(439, 157, 'textbox', 205, 'Eşinin Kan Grubu'),
(440, 157, 'textbox', 205, 'Eşinin Akrabalık Derecesi'),
(441, 157, 'textbox', 205, 'Menarş Yaşı'),
(442, 157, 'textbox', 205, 'Son Adet Tarihi'),
(443, 157, 'textbox', 205, 'Tahmini Doğum Tarihi'),
(444, 157, 'textbox', 205, 'Gebelik Sayısı'),
(445, 157, 'textbox', 205, 'Yaşayan Çocuk Sayısı'),
(446, 157, 'textbox', 205, 'Düşük Sayısı İsteyerek/Spontan'),
(447, 157, 'textbox', 205, 'Ölen Çocuk Sayısı'),
(448, 157, 'textbox', 205, 'Ölü Doğum Sayısı'),
(449, 157, 'textbox', 205, 'Son Doğumun Sonlandığı Tarih'),
(450, 157, 'textbox', 205, 'Erken Doğum Hikayesi'),
(451, 157, 'textbox', 205, 'İlk 24 saat içinde sarılığı olan bebek doğmuş mu? '),
(452, 157, 'textbox', 205, 'Sakatlığı olan bebek doğmuş mu ?'),
(453, 157, 'textbox', 205, 'Önceki Doğum Şekli Vajinal Doğum Sezaryen Vakum Forseps... '),
(454, 157, 'textbox', 205, 'Önceki Doğumların Yapıldığı Yer Evde Yardımsız Evde Ebe Hastane... '),
(455, 157, 'textbox', 205, 'Gebelik Öncesi Sistemik Bir Hastalık Varlığı Diabet Kalp vs. '),
(456, 157, 'textbox', 205, 'Gebelik Öncesi Kullandığı A.P Yöntemi '),
(457, 157, 'textbox', 205, 'Tetanoz Aşısı Yaptırma Durumu '),
(458, 157, 'textbox', 205, 'Fe Ca vs preparatı alıyor mu ?'),
(459, 157, 'textbox', 205, 'Başka kullandığı ilaçlar var mı ?'),
(460, 157, 'textbox', 207, 'Kan Basıncı'),
(461, 157, 'textbox', 207, 'Nabız'),
(462, 157, 'textbox', 207, 'Solunum'),
(463, 157, 'textbox', 207, 'Ateş'),
(464, 157, 'textbox', 207, 'ÇKS'),
(465, 157, 'textbox', 207, 'Meme Ucu Muayenesi İçe Çökük Çok Büyük Kolostrum...'),
(466, 157, 'textbox', 208, 'Hb'),
(467, 157, 'textbox', 208, 'Hct'),
(468, 157, 'textbox', 208, 'Lökosit'),
(469, 157, 'textbox', 208, 'İdrarda Protein'),
(470, 157, 'textbox', 208, 'İdrarda Glikoz'),
(471, 157, 'textbox', 209, 'I. Leopold'),
(472, 157, 'textbox', 209, 'II. Leopold'),
(473, 157, 'textbox', 209, 'III. Leopold'),
(474, 157, 'textbox', 209, 'IV. Leopold'),
(475, 157, 'textbox', 209, 'Sorun'),
(476, 157, 'textbox', 209, 'Neden'),
(477, 157, 'textbox', 209, 'Girişimler'),
(478, 157, 'date', 204, 'Tarih'),
(479, 157, 'veritablocheck', 206, ''),
(480, 158, 'textbox', 210, 'Protokol'),
(481, 158, 'textbox', 210, 'Öğrenci Ebe'),
(482, 158, 'textbox', 210, 'Onaylayan'),
(483, 158, 'textbox', 211, 'Adı Soyadı'),
(484, 158, 'textbox', 211, 'Yaşı'),
(485, 158, 'textbox', 211, 'Mesleği'),
(486, 158, 'textbox', 211, 'SAT'),
(487, 158, 'textbox', 211, 'Gravida'),
(488, 158, 'textbox', 211, 'Para'),
(489, 158, 'textbox', 211, 'Abortus'),
(490, 158, 'textbox', 211, 'Kan Grubu'),
(491, 158, 'textbox', 211, 'Travay Odasına Geliş Saati'),
(492, 158, 'textbox', 211, 'Amnion Kesesi Açıldı'),
(493, 158, 'textbox', 211, 'Kendiliğinden Saat'),
(494, 158, 'textbox', 211, 'Suni Saat'),
(495, 158, 'textbox', 211, 'İndüksiyon Başlangıç Saat'),
(496, 158, 'textbox', 211, 'Lavman Saat'),
(497, 158, 'textbox', 211, 'İdrar Yapma Saat'),
(498, 158, 'textbox', 212, ' I. Leopold Manevra Bulgusu'),
(499, 158, 'textbox', 212, 'II. Leopold Manevra Bulgusu'),
(500, 158, 'textbox', 212, 'III. Leopold Manevra Bulgusu'),
(501, 158, 'textbox', 212, ' IV. Leopold Manevra Bulgusu'),
(502, 158, 'textbox', 212, 'Promontoryumun Durumu'),
(503, 158, 'textbox', 212, 'Prezente Olan Kısım'),
(504, 158, 'textbox', 212, 'Amnion Sıvısının Rengi'),
(505, 158, 'date', 210, 'Tarih'),
(506, 158, 'veritablotext', 213, ''),
(540, 160, 'textbox', 219, 'Protokol'),
(541, 160, 'textbox', 219, 'Öğrenci Ebe'),
(542, 160, 'textbox', 219, 'Onaylayan'),
(543, 160, 'textbox', 220, 'Adı Soyadı'),
(544, 160, 'textbox', 220, 'Yaşı'),
(545, 160, 'textbox', 220, 'Mesleği'),
(546, 160, 'textbox', 220, 'SAT'),
(547, 160, 'textbox', 220, 'Gravida'),
(548, 160, 'textbox', 220, 'Para'),
(549, 160, 'textbox', 220, 'Abortus'),
(550, 160, 'textbox', 220, 'Kan Grubu'),
(551, 160, 'textbox', 220, 'Travay Odasına Geliş Saati'),
(552, 160, 'textbox', 220, 'Amnion Kesesi Açıldı'),
(553, 160, 'textbox', 220, 'Kendiliğinden Saat'),
(554, 160, 'textbox', 220, 'Suni Saat'),
(555, 160, 'textbox', 220, 'Eylemin Başlaması Kendiliğinden / Saat'),
(556, 160, 'textbox', 220, 'Eylemin Başlaması İndüksiyonla / Saat'),
(557, 160, 'textbox', 220, 'İndüksiyon Başlangıç Saat'),
(558, 160, 'textbox', 220, 'Lavman Saat'),
(559, 160, 'textbox', 220, 'İdrar Yapma Saat'),
(560, 160, 'textbox', 221, ' I. Leopold Manevra Bulgusu'),
(561, 160, 'textbox', 221, 'II. Leopold Manevra Bulgusu'),
(562, 160, 'textbox', 221, 'III. Leopold Manevra Bulgusu'),
(563, 160, 'textbox', 221, ' IV. Leopold Manevra Bulgusu'),
(564, 160, 'textbox', 221, 'Promontoryumun Durumu'),
(565, 160, 'textbox', 221, 'Prezente Olan Kısım'),
(566, 160, 'textbox', 221, 'Amnion Sıvısının Rengi'),
(567, 160, 'textbox', 221, 'Doğum Şekli'),
(568, 160, 'textbox', 223, 'Cinsiyeti'),
(569, 160, 'textbox', 223, 'Boy'),
(570, 160, 'textbox', 223, 'Kilo'),
(571, 160, 'date', 219, 'Tarih'),
(572, 160, 'datetime', 221, 'Tarih / Saat'),
(573, 160, 'veritablotext', 222, ''),
(574, 161, 'veritablocheck', 224, 'tablo deneme'),
(658, 180, 'ornekword', 255, 'worddocuments/samples/ornekword-180-1701789436.docx'),
(659, 180, 'kullaniciword', 255, 'Word dosyası yükleyin : '),
(734, 217, 'textbox', 297, 'deneme 1'),
(735, 217, 'radio', 297, 'r1'),
(736, 217, 'checkbox', 297, 'c11'),
(737, 217, 'textarea', 297, 'tt1'),
(738, 217, 'selectmenu', 297, 's1'),
(739, 217, 'veritablotext', 297, 'vt1'),
(740, 217, 'date', 297, 'd1'),
(741, 217, 'resimalani', 297, 'r2'),
(742, 217, 'textbox', 298, 't1'),
(743, 217, 'radio', 298, 'r1'),
(744, 217, 'checkbox', 298, 'cc1'),
(745, 217, 'textarea', 298, 't2'),
(746, 217, 'veritablocheck', 298, 'vt2'),
(747, 217, 'date', 298, 'dt2'),
(748, 217, 'datetime', 298, 'dtt2'),
(749, 217, 'resimalani', 298, 'r1'),
(750, 218, 'textbox', 299, 't1'),
(751, 218, 'textbox', 299, 't2'),
(752, 218, 'radio', 300, 'r1'),
(753, 218, 'radio', 300, 'r2');

-- --------------------------------------------------------

--
-- Table structure for table `formalangirdileri`
--

CREATE TABLE `formalangirdileri` (
  `veri_id` int(11) NOT NULL,
  `veri` varchar(500) NOT NULL,
  `ait_oldugu_alan_id` int(11) NOT NULL,
  `veri_turu` varchar(20) NOT NULL,
  `ait_oldugu_form_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formalangirdileri`
--

INSERT INTO `formalangirdileri` (`veri_id`, `veri`, `ait_oldugu_alan_id`, `veri_turu`, `ait_oldugu_form_id`) VALUES
(383, 'deneme', 389, 'textbox', 209),
(384, 'deneme2', 390, 'textbox', 209),
(385, 'deneme2', 391, 'textbox', 209),
(386, 'deneme', 392, 'textbox', 209),
(387, 'deneme2', 393, 'textbox', 209),
(388, 'deneme', 394, 'textbox', 209),
(389, 'deneme43', 395, 'textbox', 209),
(390, 'deneme', 396, 'textbox', 209),
(391, 'deneme2342', 397, 'textbox', 209),
(392, 'deneme', 398, 'textbox', 209),
(393, 'deneme', 399, 'textbox', 209),
(394, 'deneme', 400, 'textbox', 209),
(395, 'deneme', 401, 'textbox', 209),
(396, 'deneme', 402, 'textbox', 209),
(397, 'deneme', 403, 'textbox', 209),
(398, 'deneme', 404, 'textbox', 209),
(399, 'deneme', 405, 'textbox', 209),
(400, 'deneme', 406, 'textbox', 209),
(401, 'deneme', 407, 'textbox', 209),
(402, 'deneme', 408, 'textbox', 209),
(403, 'deneme', 409, 'textbox', 209),
(404, 'deneme', 410, 'textbox', 209),
(405, 'deneme', 411, 'textbox', 209),
(406, 'deneme', 412, 'textbox', 209),
(407, 'deneme', 413, 'textbox', 209),
(408, 'deneme', 414, 'textbox', 209),
(409, 'deneme', 415, 'textbox', 209),
(410, 'deneme', 416, 'textbox', 209),
(411, 'deneme', 417, 'textbox', 209),
(412, 'deneme', 418, 'textbox', 209),
(413, 'deneme', 419, 'textbox', 209),
(414, 'deneme', 420, 'textbox', 209),
(415, 'deneme', 421, 'textbox', 209),
(416, 'deneme', 422, 'textbox', 209),
(417, 'deneme', 423, 'textbox', 209),
(418, 'deneme', 424, 'textbox', 209),
(419, 'deneme', 425, 'textbox', 209),
(420, 'deneme4', 426, 'textbox', 209),
(421, 'deneme', 427, 'textbox', 209),
(422, '2004-09-27', 428, 'date', 209),
(472, 'deneme', 480, 'textbox', 211),
(473, 'deneme', 481, 'textbox', 211),
(474, 'deneme', 482, 'textbox', 211),
(475, 'deneme', 483, 'textbox', 211),
(476, 'deneme', 484, 'textbox', 211),
(477, 'deneme', 485, 'textbox', 211),
(478, 'deneme', 486, 'textbox', 211),
(479, 'deneme', 487, 'textbox', 211),
(480, 'deneme', 488, 'textbox', 211),
(481, 'deneme', 489, 'textbox', 211),
(482, 'deneme', 490, 'textbox', 211),
(483, 'deneme', 491, 'textbox', 211),
(484, 'deneme', 492, 'textbox', 211),
(485, 'deneme', 493, 'textbox', 211),
(486, 'deneme', 494, 'textbox', 211),
(487, 'deneme', 495, 'textbox', 211),
(488, 'deneme', 496, 'textbox', 211),
(489, 'deneme', 497, 'textbox', 211),
(490, 'deneme', 498, 'textbox', 211),
(491, 'deneme', 499, 'textbox', 211),
(492, 'deneme', 500, 'textbox', 211),
(493, 'deneme', 501, 'textbox', 211),
(494, 'deneme', 502, 'textbox', 211),
(495, 'deneme', 503, 'textbox', 211),
(496, 'deneme', 504, 'textbox', 211),
(497, '2023-09-27', 505, 'date', 211),
(498, 'deneme', 540, 'textbox', 212),
(499, 'deneme', 541, 'textbox', 212),
(500, 'deneme', 542, 'textbox', 212),
(501, 'deneme', 543, 'textbox', 212),
(502, 'deneme', 544, 'textbox', 212),
(503, 'deneme', 545, 'textbox', 212),
(504, 'deneme', 546, 'textbox', 212),
(505, 'deneme', 547, 'textbox', 212),
(506, 'deneme', 548, 'textbox', 212),
(507, 'deneme', 549, 'textbox', 212),
(508, 'deneme', 550, 'textbox', 212),
(509, 'deneme', 551, 'textbox', 212),
(510, 'deneme', 552, 'textbox', 212),
(511, 'deneme', 553, 'textbox', 212),
(512, 'deneme', 554, 'textbox', 212),
(513, 'denemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedenemedeneme', 555, 'textbox', 212),
(514, 'deneme', 556, 'textbox', 212),
(515, 'deneme', 557, 'textbox', 212),
(516, 'deneme', 558, 'textbox', 212),
(517, 'deneme', 559, 'textbox', 212),
(518, 'deneme', 560, 'textbox', 212),
(519, 'deneme', 561, 'textbox', 212),
(520, 'deneme', 562, 'textbox', 212),
(521, 'deneme', 563, 'textbox', 212),
(522, 'deneme', 564, 'textbox', 212),
(523, 'deneme', 565, 'textbox', 212),
(524, 'deneme', 566, 'textbox', 212),
(525, 'deneme', 567, 'textbox', 212),
(526, 'deneme', 568, 'textbox', 212),
(527, 'deneme', 569, 'textbox', 212),
(528, 'deneme', 570, 'textbox', 212),
(529, '2023-09-27', 571, 'date', 212),
(530, '2023-09-26T07:25', 572, 'datetime', 212),
(751, 'worddocuments/userdocuments/kullaniciword-245-1701793374.docx', 659, 'kullaniciword', 245),
(891, 'worddocuments/userdocuments/kullaniciword-261-1711571320.docx', 659, 'kullaniciword', 261),
(936, 'img/formresimleri/alanresimi-270_1_0.jpeg', 749, 'resimalani', 270),
(937, 'c2', 736, 'checkbox', 270),
(938, 's2', 744, 'checkbox', 270),
(939, 'deneme', 734, 'textbox', 270),
(940, 'a5ds6a5da6d', 742, 'textbox', 270),
(941, 'r12', 735, 'radio', 270),
(942, 'rr2', 743, 'radio', 270),
(943, 'asdasdasd', 737, 'textarea', 270),
(944, 'a5ds6a5d6a5da', 745, 'textarea', 270),
(945, '2025-04-28', 740, 'date', 270),
(946, '2025-04-11', 747, 'date', 270),
(947, '2025-04-28T15:22', 748, 'datetime', 270),
(948, 'ss1', 738, 'selectmenu', 270),
(949, 'c2', 736, 'checkbox', 271),
(950, 's1', 744, 'checkbox', 271),
(951, 's2', 744, 'checkbox', 271),
(952, 'asd8a9das', 734, 'textbox', 271),
(953, 'sa5d6a5dasda', 742, 'textbox', 271),
(954, 'r12', 735, 'radio', 271),
(955, 'rrr1', 743, 'radio', 271),
(956, '56s5d6a5d6a5sda', 737, 'textarea', 271),
(957, 'asd6a5d6as5d65as6d5as', 745, 'textarea', 271),
(958, '2025-04-10', 740, 'date', 271),
(959, '2025-04-20', 747, 'date', 271),
(960, '2025-04-08T15:53', 748, 'datetime', 271),
(961, 'ss2', 738, 'selectmenu', 271);

-- --------------------------------------------------------

--
-- Table structure for table `formareabilgileri`
--

CREATE TABLE `formareabilgileri` (
  `bolge_id` int(11) NOT NULL,
  `bolge_baslik` varchar(100) NOT NULL,
  `formdaki_sirasi` int(11) NOT NULL,
  `ait_oldugu_form_turu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formareabilgileri`
--

INSERT INTO `formareabilgileri` (`bolge_id`, `bolge_baslik`, `formdaki_sirasi`, `ait_oldugu_form_turu_id`) VALUES
(199, 'GENEL BİLGİLER2', 0, 156),
(200, 'FORM GENEL BİLGİLER', 1, 156),
(201, 'GEBELİKTE GÖRÜLEN TEHLİKE BELİRTİLERİ', 2, 156),
(202, 'GEBENİN FİZİK MUAYENE BULGULARI', 3, 156),
(203, 'Leopold Manevraları', 4, 156),
(204, 'GENEL BİLGİLER', 0, 157),
(205, 'FORM GENEL BİLGİLER', 1, 157),
(206, 'GEBELİKTE GÖRÜLEN TEHLİKE BELİRTİLERİ', 2, 157),
(207, 'GEBENİN FİZİK MUAYENE BULGULARI', 3, 157),
(208, 'Laboratuvar Bulguları', 4, 157),
(209, 'Leopold Manevraları', 5, 157),
(210, 'GENEL BİLGİLER', 0, 158),
(211, 'FORM GENEL BİLGİLER', 1, 158),
(212, '', 2, 158),
(213, '', 3, 158),
(219, 'GENEL BİLGİLER', 0, 160),
(220, 'FORM GENEL BİLGİLER', 1, 160),
(221, '', 2, 160),
(222, '', 3, 160),
(223, 'Bebekle İlgili Bulgular', 4, 160),
(224, 'GENEL BİLGİLER', 0, 161),
(255, 'Word dosyası görüntüleme ve yükleme', 0, 180),
(297, 'Deneme baslik1', 0, 217),
(298, 'Deneme baslik2', 1, 217),
(299, 'deneme1', 0, 218),
(300, 'dsada', 1, 218);

-- --------------------------------------------------------

--
-- Table structure for table `formbilgileri`
--

CREATE TABLE `formbilgileri` (
  `form_id` int(11) NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `eklenme_tarihi` datetime NOT NULL,
  `form_durum` varchar(20) NOT NULL DEFAULT 'bekleme',
  `form_turu_id` int(11) NOT NULL,
  `gonderilen_akademisyen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formbilgileri`
--

INSERT INTO `formbilgileri` (`form_id`, `ekleyen_id`, `eklenme_tarihi`, `form_durum`, `form_turu_id`, `gonderilen_akademisyen_id`) VALUES
(209, 8, '2023-09-27 14:30:20', 'onay', 156, 2),
(211, 8, '2023-09-27 14:52:55', 'onay', 158, 2),
(212, 8, '2023-09-27 15:26:36', 'bekleme', 160, 11),
(245, 8, '2023-12-05 16:58:55', 'orta', 180, 2),
(261, 8, '2024-03-27 21:28:40', 'kotu', 180, 2),
(270, 8, '2025-04-30 14:22:39', 'onay', 217, 2),
(271, 8, '2025-04-30 14:53:45', 'bekleme', 217, 2);

-- --------------------------------------------------------

--
-- Table structure for table `formnotlari`
--

CREATE TABLE `formnotlari` (
  `onay_id` int(11) NOT NULL,
  `metin` varchar(250) NOT NULL,
  `form_id` int(11) NOT NULL,
  `ogretmen_id` int(11) NOT NULL,
  `durum` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formnotlari`
--

INSERT INTO `formnotlari` (`onay_id`, `metin`, `form_id`, `ogretmen_id`, `durum`) VALUES
(6, 'Onay', 209, 1, 'onay'),
(9, 'adasd', 211, 2, 'onay'),
(13, '56sad6a5d5asd', 270, 1, 'onay');

-- --------------------------------------------------------

--
-- Table structure for table `formsecenekbilgileri`
--

CREATE TABLE `formsecenekbilgileri` (
  `secenek_id` int(11) NOT NULL,
  `ait_oldugu_alan_id` int(11) NOT NULL,
  `aciklama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formsecenekbilgileri`
--

INSERT INTO `formsecenekbilgileri` (`secenek_id`, `ait_oldugu_alan_id`, `aciklama`) VALUES
(227, 735, 'r11'),
(228, 735, 'r12'),
(229, 735, 'r13'),
(230, 735, 'r14'),
(231, 736, 'c1'),
(232, 736, 'c2'),
(233, 736, 'c3'),
(234, 738, 'ss1'),
(235, 738, 'ss2'),
(236, 738, 'ss3'),
(237, 738, 'ss4'),
(238, 743, 'rrr1'),
(239, 743, 'rr2'),
(240, 744, 's1'),
(241, 744, 's2'),
(242, 752, 's1'),
(243, 752, 's2'),
(244, 753, 's11'),
(245, 753, 's12');

-- --------------------------------------------------------

--
-- Table structure for table `formtablosatirlar`
--

CREATE TABLE `formtablosatirlar` (
  `nitelik_id` int(11) NOT NULL,
  `aciklama` varchar(150) NOT NULL,
  `ait_oldugu_alan_id` int(11) NOT NULL,
  `tablodaki_sirasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formtablosatirlar`
--

INSERT INTO `formtablosatirlar` (`nitelik_id`, `aciklama`, `ait_oldugu_alan_id`, `tablodaki_sirasi`) VALUES
(75, 'Vajinal Kanama', 429, 0),
(76, 'Kan Basıncında Yükselme', 429, 1),
(77, 'Baş Ağrısı - Baş Dönmesi', 429, 2),
(78, 'Bacaklarda Elde- Yüzde Ödem Dinlenmekle Geçmeyen', 429, 3),
(79, 'Epigastrik Ağrı', 429, 4),
(80, 'Müsküler İrritabilite', 429, 5),
(81, 'Oligüri/Disüri', 429, 6),
(82, 'Görmede Değişiklikler', 429, 7),
(83, 'Aşırı Bulantı', 429, 8),
(84, 'Kasık/ Bel/ Karın Ağrısı', 429, 9),
(85, 'Fetal Hareketlerin Olmaması', 429, 10),
(86, 'Polihidroamniyos/ Oligohidraamniyos', 429, 11),
(87, 'Çoğul Gebelik', 429, 12),
(88, 'Bacaklarda/ Vulvada Varis', 429, 13),
(89, 'TORCH', 429, 14),
(90, 'Vajinal Kanama', 479, 0),
(91, 'Kan Basıncında Yükselme', 479, 1),
(92, 'Baş Ağrısı - Baş Dönmesi', 479, 2),
(93, 'Bacaklarda Elde- Yüzde Ödem Dinlenmekle Geçmeyen', 479, 3),
(94, 'Epigastrik Ağrı', 479, 4),
(95, 'Müsküler İrritabilite', 479, 5),
(96, 'Oligüri/Disüri', 479, 6),
(97, 'Görmede Değişiklikler', 479, 7),
(98, 'Aşırı Bulantı', 479, 8),
(99, 'Kasık/ Bel/ Karın Ağrısı', 479, 9),
(100, 'Fetal Hareketlerin Olmaması', 479, 10),
(101, 'Polihidroamniyos/ Oligohidraamniyos', 479, 11),
(102, 'Çoğul Gebelik', 479, 12),
(103, 'Bacaklarda/ Vulvada Varis', 479, 13),
(104, 'TORCH', 479, 14),
(105, 'r1', 574, 0),
(106, '23', 574, 1),
(107, '24', 574, 2),
(108, '25', 574, 3),
(109, '26', 574, 4),
(110, '27', 574, 5),
(111, '38', 574, 6),
(146, 's1', 739, 0),
(147, 's2', 739, 1),
(148, 's3', 739, 2),
(149, 's1', 746, 0),
(150, 's2', 746, 1),
(151, 's3', 746, 2);

-- --------------------------------------------------------

--
-- Table structure for table `formtablosutunlar`
--

CREATE TABLE `formtablosutunlar` (
  `nitelik_id` int(11) NOT NULL,
  `aciklama` varchar(100) NOT NULL,
  `ait_oldugu_alan_id` int(11) NOT NULL,
  `tablodaki_sirasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formtablosutunlar`
--

INSERT INTO `formtablosutunlar` (`nitelik_id`, `aciklama`, `ait_oldugu_alan_id`, `tablodaki_sirasi`) VALUES
(82, 'Şimdiki Gebelik', 429, 0),
(83, 'Önceki Gebelik', 429, 1),
(85, 'Şimdiki Gebelik', 479, 0),
(86, 'Önceki Gebelik', 479, 1),
(87, 'Saat', 506, 0),
(88, 'T.A.', 506, 1),
(89, 'Nabız', 506, 2),
(90, 'Ateş', 506, 3),
(91, 'Kontraksiyonlar', 506, 4),
(92, 'FKH', 506, 5),
(93, 'Dilatasyon', 506, 6),
(94, 'Silinme', 506, 7),
(95, 'Fiske(F) / Mobil(M)', 506, 8),
(96, 'Öğrenci İmza', 506, 9),
(97, 'Saat', 573, 0),
(98, 'T.A.', 573, 1),
(99, 'Nabız', 573, 2),
(100, 'Ateş', 573, 3),
(101, 'Kontraksiyonlar', 573, 4),
(102, 'FKH', 573, 5),
(103, 'Dilatasyon', 573, 6),
(104, 'Silinme', 573, 7),
(105, 'Fiske(F) / Mobil(M)', 573, 8),
(106, 'Öğrenci İmza', 573, 9),
(107, '', 574, 0),
(158, 's1', 739, 0),
(159, 's2', 739, 1),
(160, 's3', 739, 2),
(161, 's1', 746, 0),
(162, 's2', 746, 1),
(163, 's3', 746, 2);

-- --------------------------------------------------------

--
-- Table structure for table `formttablogirdiler`
--

CREATE TABLE `formttablogirdiler` (
  `icerik_id` int(11) NOT NULL,
  `ait_oldugu_alan_id` int(11) NOT NULL,
  `icerik` varchar(500) NOT NULL,
  `ait_oldugu_nitelik_id` int(11) NOT NULL,
  `ait_oldugu_form_id` int(11) NOT NULL,
  `ait_oldugu_yannitelik_id` int(11) NOT NULL,
  `icerik_turu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formttablogirdiler`
--

INSERT INTO `formttablogirdiler` (`icerik_id`, `ait_oldugu_alan_id`, `icerik`, `ait_oldugu_nitelik_id`, `ait_oldugu_form_id`, `ait_oldugu_yannitelik_id`, `icerik_turu`) VALUES
(1319, 429, 'pasif', 82, 209, 75, 'veritablocheck'),
(1320, 429, 'pasif', 83, 209, 75, 'veritablocheck'),
(1322, 429, 'pasif', 82, 209, 76, 'veritablocheck'),
(1323, 429, 'pasif', 83, 209, 76, 'veritablocheck'),
(1325, 429, 'pasif', 82, 209, 77, 'veritablocheck'),
(1326, 429, 'aktif', 83, 209, 77, 'veritablocheck'),
(1328, 429, 'pasif', 82, 209, 78, 'veritablocheck'),
(1329, 429, 'aktif', 83, 209, 78, 'veritablocheck'),
(1331, 429, 'pasif', 82, 209, 79, 'veritablocheck'),
(1332, 429, 'aktif', 83, 209, 79, 'veritablocheck'),
(1334, 429, 'aktif', 82, 209, 80, 'veritablocheck'),
(1335, 429, 'aktif', 83, 209, 80, 'veritablocheck'),
(1337, 429, 'aktif', 82, 209, 81, 'veritablocheck'),
(1338, 429, 'aktif', 83, 209, 81, 'veritablocheck'),
(1340, 429, 'pasif', 82, 209, 82, 'veritablocheck'),
(1341, 429, 'pasif', 83, 209, 82, 'veritablocheck'),
(1343, 429, 'aktif', 82, 209, 83, 'veritablocheck'),
(1344, 429, 'pasif', 83, 209, 83, 'veritablocheck'),
(1346, 429, 'aktif', 82, 209, 84, 'veritablocheck'),
(1347, 429, 'pasif', 83, 209, 84, 'veritablocheck'),
(1349, 429, 'aktif', 82, 209, 85, 'veritablocheck'),
(1350, 429, 'pasif', 83, 209, 85, 'veritablocheck'),
(1352, 429, 'aktif', 82, 209, 86, 'veritablocheck'),
(1353, 429, 'aktif', 83, 209, 86, 'veritablocheck'),
(1355, 429, 'pasif', 82, 209, 87, 'veritablocheck'),
(1356, 429, 'aktif', 83, 209, 87, 'veritablocheck'),
(1358, 429, 'aktif', 82, 209, 88, 'veritablocheck'),
(1359, 429, 'aktif', 83, 209, 88, 'veritablocheck'),
(1361, 429, 'aktif', 82, 209, 89, 'veritablocheck'),
(1362, 429, 'aktif', 83, 209, 89, 'veritablocheck'),
(1408, 506, 'deneme', 87, 211, -1, 'veritablotext'),
(1409, 506, 'deneme', 88, 211, -1, 'veritablotext'),
(1410, 506, 'deneme', 89, 211, -1, 'veritablotext'),
(1411, 506, 'deneme', 90, 211, -1, 'veritablotext'),
(1412, 506, 'deneme', 91, 211, -1, 'veritablotext'),
(1413, 506, 'deneme', 92, 211, -1, 'veritablotext'),
(1414, 506, 'deneme', 93, 211, -1, 'veritablotext'),
(1415, 506, 'deneme', 94, 211, -1, 'veritablotext'),
(1416, 506, 'deneme', 95, 211, -1, 'veritablotext'),
(1417, 506, 'deneme', 96, 211, -1, 'veritablotext'),
(1418, 573, 'deneme', 97, 212, -1, 'veritablotext'),
(1419, 573, 'deneme', 98, 212, -1, 'veritablotext'),
(1420, 573, 'deneme', 99, 212, -1, 'veritablotext'),
(1421, 573, 'deneme', 100, 212, -1, 'veritablotext'),
(1422, 573, 'deneme deneme deneme deneme deneme deneme', 101, 212, -1, 'veritablotext'),
(1423, 573, 'deneme', 102, 212, -1, 'veritablotext'),
(1424, 573, 'deneme', 103, 212, -1, 'veritablotext'),
(1425, 573, 'deneme', 104, 212, -1, 'veritablotext'),
(1426, 573, 'deneme', 105, 212, -1, 'veritablotext'),
(1427, 573, 'deneme', 106, 212, -1, 'veritablotext'),
(1428, 573, 'deneme', 97, 212, -2, 'veritablotext'),
(1429, 573, 'deneme', 98, 212, -2, 'veritablotext'),
(1430, 573, 'deneme', 99, 212, -2, 'veritablotext'),
(1431, 573, 'deneme', 100, 212, -2, 'veritablotext'),
(1432, 573, 'deneme', 101, 212, -2, 'veritablotext'),
(1433, 573, 'deneme', 102, 212, -2, 'veritablotext'),
(1434, 573, 'deneme', 103, 212, -2, 'veritablotext'),
(1435, 573, 'deneme', 104, 212, -2, 'veritablotext'),
(1436, 573, 'deneme', 105, 212, -2, 'veritablotext'),
(1437, 573, 'deneme', 106, 212, -2, 'veritablotext'),
(1747, 739, 'sda5d6ad', 158, 270, 146, 'veritablotext'),
(1748, 739, '', 159, 270, 146, 'veritablotext'),
(1749, 739, '', 160, 270, 146, 'veritablotext'),
(1750, 739, '', 158, 270, 147, 'veritablotext'),
(1751, 739, 'sda6d5a6s5das', 159, 270, 147, 'veritablotext'),
(1752, 739, '', 160, 270, 147, 'veritablotext'),
(1753, 739, '', 158, 270, 148, 'veritablotext'),
(1754, 739, '', 159, 270, 148, 'veritablotext'),
(1755, 739, '', 160, 270, 148, 'veritablotext'),
(1756, 746, 'pasif', 161, 270, 149, 'veritablocheck'),
(1757, 746, 'aktif', 162, 270, 149, 'veritablocheck'),
(1758, 746, 'pasif', 163, 270, 149, 'veritablocheck'),
(1759, 746, 'aktif', 161, 270, 150, 'veritablocheck'),
(1760, 746, 'pasif', 162, 270, 150, 'veritablocheck'),
(1761, 746, 'pasif', 163, 270, 150, 'veritablocheck'),
(1762, 746, 'pasif', 161, 270, 151, 'veritablocheck'),
(1763, 746, 'pasif', 162, 270, 151, 'veritablocheck'),
(1764, 746, 'pasif', 163, 270, 151, 'veritablocheck'),
(1765, 739, '', 158, 271, 146, 'veritablotext'),
(1766, 739, '', 159, 271, 146, 'veritablotext'),
(1767, 739, '', 158, 271, 147, 'veritablotext'),
(1768, 739, '', 159, 271, 147, 'veritablotext'),
(1769, 739, '', 158, 271, 148, 'veritablotext'),
(1770, 739, '', 159, 271, 148, 'veritablotext'),
(1771, 739, '', 160, 271, 148, 'veritablotext'),
(1772, 746, 'aktif', 161, 271, 149, 'veritablocheck'),
(1773, 746, 'pasif', 162, 271, 149, 'veritablocheck'),
(1774, 746, 'pasif', 163, 271, 149, 'veritablocheck'),
(1775, 746, 'pasif', 161, 271, 150, 'veritablocheck'),
(1776, 746, 'aktif', 162, 271, 150, 'veritablocheck'),
(1777, 746, 'pasif', 163, 271, 150, 'veritablocheck'),
(1778, 746, 'pasif', 161, 271, 151, 'veritablocheck'),
(1779, 746, 'pasif', 162, 271, 151, 'veritablocheck'),
(1780, 746, 'pasif', 163, 271, 151, 'veritablocheck');

-- --------------------------------------------------------

--
-- Table structure for table `formturbilgileri`
--

CREATE TABLE `formturbilgileri` (
  `tur_id` int(11) NOT NULL,
  `baslik` varchar(100) NOT NULL,
  `ekleyen_id` int(11) NOT NULL,
  `resim_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `formturbilgileri`
--

INSERT INTO `formturbilgileri` (`tur_id`, `baslik`, `ekleyen_id`, `resim_url`) VALUES
(156, 'GEBE İZLEM FORMU', 1, 'img/gebe_izlem.png'),
(157, 'RİSKLİ GEBE İZLEM FORMU', 1, 'img/formtururesimleri/riskli_gebe_izlem.png'),
(158, 'DOĞUM ÖNCESİ MUAYENE FORMU', 1, 'img/dogum_oncesi_muayene.png'),
(160, 'NORMAL DOĞUM FORMU', 1, 'img/normal_dogum.png'),
(161, 'GEBE İZLEM FORMU', 1, 'img/gebe_izlem.png'),
(180, 'deneme form ', 1, 'img/formtururesimleri/formresim-1701789436.png'),
(217, 'Deneme 1', 1, 'img/formtururesimleri/formresim-1746015675.jpeg'),
(218, 'deneme', 1, 'img/formtururesimleri/formresim-1746019936.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicibilgileri`
--

CREATE TABLE `kullanicibilgileri` (
  `ogrenci_id` int(11) NOT NULL,
  `ogrenci_no` varchar(15) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `dogum_tarihi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kullanicibilgileri`
--

INSERT INTO `kullanicibilgileri` (`ogrenci_id`, `ogrenci_no`, `kullanici_id`, `dogum_tarihi`) VALUES
(6, '01', 8, '2004-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_tipi` tinyint(2) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `sifre` varchar(150) NOT NULL,
  `eposta` varchar(50) NOT NULL,
  `adsoyad` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `kullanicilar`
--

INSERT INTO `kullanicilar` (`kullanici_id`, `kullanici_tipi`, `kullanici_adi`, `sifre`, `eposta`, `adsoyad`) VALUES
(1, 0, 'yonetici', '123', 'yonetici@gmail.com', 'Yönetici'),
(2, 1, 'akademisyen1', '123', 'akademisyen@gmail.com', 'Akademisyen 1'),
(8, 2, 'ogrenci1', '123', 'deneme@gmail.com', 'Ahmet Kar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formalanbilgileri`
--
ALTER TABLE `formalanbilgileri`
  ADD PRIMARY KEY (`alan_id`),
  ADD KEY `aitoldugu_form_turu_id` (`aitoldugu_form_turu_id`),
  ADD KEY `ait_oldugu_bolge_id` (`ait_oldugu_bolge_id`);

--
-- Indexes for table `formalangirdileri`
--
ALTER TABLE `formalangirdileri`
  ADD PRIMARY KEY (`veri_id`),
  ADD KEY `ait_oldugu_alan_id` (`ait_oldugu_alan_id`),
  ADD KEY `form_alan_verisi_ibfk_2` (`ait_oldugu_form_id`);

--
-- Indexes for table `formareabilgileri`
--
ALTER TABLE `formareabilgileri`
  ADD PRIMARY KEY (`bolge_id`),
  ADD KEY `ait_oldugu_form_turu_id` (`ait_oldugu_form_turu_id`);

--
-- Indexes for table `formbilgileri`
--
ALTER TABLE `formbilgileri`
  ADD PRIMARY KEY (`form_id`),
  ADD KEY `ekleyen_id` (`ekleyen_id`),
  ADD KEY `form_turu_id` (`form_turu_id`);

--
-- Indexes for table `formnotlari`
--
ALTER TABLE `formnotlari`
  ADD PRIMARY KEY (`onay_id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `formsecenekbilgileri`
--
ALTER TABLE `formsecenekbilgileri`
  ADD PRIMARY KEY (`secenek_id`),
  ADD KEY `ait_oldugu_alan_id` (`ait_oldugu_alan_id`);

--
-- Indexes for table `formtablosatirlar`
--
ALTER TABLE `formtablosatirlar`
  ADD PRIMARY KEY (`nitelik_id`),
  ADD KEY `veritablo_yannitelikler_ibfk_1` (`ait_oldugu_alan_id`);

--
-- Indexes for table `formtablosutunlar`
--
ALTER TABLE `formtablosutunlar`
  ADD PRIMARY KEY (`nitelik_id`),
  ADD KEY `veritablo_nitelikler_ibfk_1` (`ait_oldugu_alan_id`);

--
-- Indexes for table `formttablogirdiler`
--
ALTER TABLE `formttablogirdiler`
  ADD PRIMARY KEY (`icerik_id`),
  ADD KEY `ait_oldugu_nitelik_id` (`ait_oldugu_nitelik_id`),
  ADD KEY `ait_oldugu_alan_id` (`ait_oldugu_alan_id`),
  ADD KEY `veritablo_icerikler_ibfk_4` (`ait_oldugu_form_id`),
  ADD KEY `ait_oldugu_yannitelik_id` (`ait_oldugu_yannitelik_id`);

--
-- Indexes for table `formturbilgileri`
--
ALTER TABLE `formturbilgileri`
  ADD PRIMARY KEY (`tur_id`),
  ADD KEY `ekleyen_id` (`ekleyen_id`);

--
-- Indexes for table `kullanicibilgileri`
--
ALTER TABLE `kullanicibilgileri`
  ADD PRIMARY KEY (`ogrenci_id`),
  ADD KEY `kullanici_id` (`kullanici_id`);

--
-- Indexes for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formalanbilgileri`
--
ALTER TABLE `formalanbilgileri`
  MODIFY `alan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754;

--
-- AUTO_INCREMENT for table `formalangirdileri`
--
ALTER TABLE `formalangirdileri`
  MODIFY `veri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=962;

--
-- AUTO_INCREMENT for table `formareabilgileri`
--
ALTER TABLE `formareabilgileri`
  MODIFY `bolge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `formbilgileri`
--
ALTER TABLE `formbilgileri`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `formnotlari`
--
ALTER TABLE `formnotlari`
  MODIFY `onay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `formsecenekbilgileri`
--
ALTER TABLE `formsecenekbilgileri`
  MODIFY `secenek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `formtablosatirlar`
--
ALTER TABLE `formtablosatirlar`
  MODIFY `nitelik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `formtablosutunlar`
--
ALTER TABLE `formtablosutunlar`
  MODIFY `nitelik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `formttablogirdiler`
--
ALTER TABLE `formttablogirdiler`
  MODIFY `icerik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1781;

--
-- AUTO_INCREMENT for table `formturbilgileri`
--
ALTER TABLE `formturbilgileri`
  MODIFY `tur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `kullanicibilgileri`
--
ALTER TABLE `kullanicibilgileri`
  MODIFY `ogrenci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formalanbilgileri`
--
ALTER TABLE `formalanbilgileri`
  ADD CONSTRAINT `formalanbilgileri_ibfk_2` FOREIGN KEY (`aitoldugu_form_turu_id`) REFERENCES `formturbilgileri` (`tur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formalanbilgileri_ibfk_3` FOREIGN KEY (`ait_oldugu_bolge_id`) REFERENCES `formareabilgileri` (`bolge_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `formalangirdileri`
--
ALTER TABLE `formalangirdileri`
  ADD CONSTRAINT `formalangirdileri_ibfk_1` FOREIGN KEY (`ait_oldugu_alan_id`) REFERENCES `formalanbilgileri` (`alan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formalangirdileri_ibfk_2` FOREIGN KEY (`ait_oldugu_form_id`) REFERENCES `formbilgileri` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formareabilgileri`
--
ALTER TABLE `formareabilgileri`
  ADD CONSTRAINT `formareabilgileri_ibfk_1` FOREIGN KEY (`ait_oldugu_form_turu_id`) REFERENCES `formturbilgileri` (`tur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formbilgileri`
--
ALTER TABLE `formbilgileri`
  ADD CONSTRAINT `formbilgileri_ibfk_1` FOREIGN KEY (`ekleyen_id`) REFERENCES `kullanicilar` (`kullanici_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formbilgileri_ibfk_2` FOREIGN KEY (`form_turu_id`) REFERENCES `formturbilgileri` (`tur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formnotlari`
--
ALTER TABLE `formnotlari`
  ADD CONSTRAINT `formnotlari_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `formbilgileri` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formsecenekbilgileri`
--
ALTER TABLE `formsecenekbilgileri`
  ADD CONSTRAINT `formsecenekbilgileri_ibfk_1` FOREIGN KEY (`ait_oldugu_alan_id`) REFERENCES `formalanbilgileri` (`alan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formtablosatirlar`
--
ALTER TABLE `formtablosatirlar`
  ADD CONSTRAINT `formtablosatirlar_ibfk_1` FOREIGN KEY (`ait_oldugu_alan_id`) REFERENCES `formalanbilgileri` (`alan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formtablosutunlar`
--
ALTER TABLE `formtablosutunlar`
  ADD CONSTRAINT `formtablosutunlar_ibfk_1` FOREIGN KEY (`ait_oldugu_alan_id`) REFERENCES `formalanbilgileri` (`alan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formttablogirdiler`
--
ALTER TABLE `formttablogirdiler`
  ADD CONSTRAINT `formttablogirdiler_ibfk_3` FOREIGN KEY (`ait_oldugu_alan_id`) REFERENCES `formalanbilgileri` (`alan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formttablogirdiler_ibfk_4` FOREIGN KEY (`ait_oldugu_form_id`) REFERENCES `formbilgileri` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `formturbilgileri`
--
ALTER TABLE `formturbilgileri`
  ADD CONSTRAINT `formturbilgileri_ibfk_1` FOREIGN KEY (`ekleyen_id`) REFERENCES `kullanicilar` (`kullanici_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kullanicibilgileri`
--
ALTER TABLE `kullanicibilgileri`
  ADD CONSTRAINT `kullanicibilgileri_ibfk_1` FOREIGN KEY (`kullanici_id`) REFERENCES `kullanicilar` (`kullanici_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
