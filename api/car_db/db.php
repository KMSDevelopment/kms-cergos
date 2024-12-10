<?php

--  
-- `For ADVANCED Car Year Make Model Trim Database & API: https://databases.one`
-- `Demo here: https://databases.one/cardatabase-demo-advanced/`
--  

CREATE TABLE IF NOT EXISTS `car_makes` (
  `make_id` int(11) NOT NULL,
  `make` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- `car_makes_2008_2018`
--

INSERT INTO `car_makes` (`make_id`, `make`) VALUES
(1, 'AC'),
(2, 'Acura'),
(3, 'Alfa Romeo'),
(4, 'Alpina'),
(5, 'Alpine'),
(195, 'AM General'),
(191, 'Ariel'),
(8, 'Aston Martin'),
(9, 'Audi'),
(240, 'Bajaj'),
(12, 'Beijing'),
(13, 'Bentley'),
(238, 'Bilenkin'),
(16, 'BMW'),
(224, 'Borgward'),
(207, 'Brabus'),
(173, 'Brilliance'),
(17, 'Bristol'),
(203, 'Bronto'),
(183, 'Bufori'),
(18, 'Bugatti'),
(19, 'Buick'),
(20, 'BYD'),
(199, 'Byvin'),
(21, 'Cadillac'),
(24, 'Caterham'),
(184, 'Changan'),
(171, 'ChangFeng'),
(25, 'Chery'),
(26, 'Chevrolet'),
(27, 'Chrysler'),
(28, 'Citroen'),
(30, 'Coggiola'),
(31, 'Dacia'),
(33, 'Daewoo'),
(35, 'Daihatsu'),
(36, 'Daimler'),
(37, 'Datsun'),
(40, 'Derways'),
(41, 'Dodge'),
(169, 'DongFeng'),
(43, 'Donkervoort'),
(213, 'DS'),
(198, 'E-Car'),
(197, 'Ecomotors'),
(45, 'FAW'),
(46, 'Ferrari'),
(47, 'Fiat'),
(196, 'Fisker'),
(48, 'Ford'),
(168, 'Foton'),
(176, 'Fuqi'),
(155, 'GAZ'),
(50, 'Geely'),
(232, 'Genesis'),
(52, 'GMC'),
(180, 'Gonow'),
(211, 'Gordon'),
(53, 'Great Wall'),
(167, 'Hafei'),
(189, 'Haima'),
(212, 'Haval'),
(209, 'Hawtai'),
(54, 'Hindustan'),
(55, 'Holden'),
(56, 'Honda'),
(177, 'HuangHai'),
(57, 'Hummer'),
(58, 'Hyundai'),
(60, 'Infiniti'),
(62, 'Invicta'),
(59, 'Iran Khodro'),
(64, 'Isuzu'),
(65, 'IVECO'),
(158, 'Izh'),
(66, 'JAC'),
(67, 'Jaguar'),
(68, 'Jeep'),
(242, 'Jinbei'),
(182, 'JMC'),
(70, 'Kia'),
(71, 'Koenigsegg'),
(223, 'Kombat'),
(162, 'KTM'),
(72, 'Lamborghini'),
(73, 'Lancia'),
(74, 'Land Rover'),
(75, 'Landwind'),
(76, 'Lexus'),
(185, 'Liebao Motor'),
(170, 'Lifan'),
(77, 'Lincoln'),
(78, 'Lotus'),
(79, 'LTI'),
(245, 'Lucid'),
(194, 'Luxgen'),
(80, 'Mahindra'),
(163, 'Marlin'),
(188, 'Marussia'),
(82, 'Maruti'),
(83, 'Maserati'),
(84, 'Maybach'),
(85, 'Mazda'),
(86, 'McLaren'),
(88, 'Mercedes-Benz'),
(89, 'Mercury'),
(91, 'MG'),
(92, 'Microcar'),
(94, 'MINI'),
(95, 'Mitsubishi'),
(96, 'Mitsuoka'),
(97, 'Morgan'),
(99, 'Nissan'),
(100, 'Noble'),
(102, 'Opel'),
(104, 'Pagani'),
(105, 'Panoz'),
(106, 'Perodua'),
(107, 'Peugeot'),
(164, 'PGO'),
(165, 'Piaggio'),
(109, 'Pontiac'),
(110, 'Porsche'),
(112, 'Proton'),
(113, 'PUCH'),
(206, 'Qoros'),
(225, 'Ravon'),
(117, 'Renault'),
(123, 'Renault Samsung'),
(217, 'Rezvani'),
(218, 'Rimac'),
(118, 'Rolls-Royce'),
(119, 'Ronart'),
(121, 'Saab'),
(192, 'Santana'),
(124, 'Saturn'),
(125, 'Scion'),
(126, 'SEAT'),
(214, 'Shanghai Maple'),
(172, 'ShuangHuan'),
(127, 'Skoda'),
(128, 'Smart'),
(174, 'Soueast'),
(130, 'Spyker'),
(131, 'SsangYong'),
(132, 'Subaru'),
(133, 'Suzuki'),
(179, 'TagAZ'),
(135, 'TATA'),
(190, 'Tazzari'),
(187, 'Tesla'),
(239, 'Think'),
(137, 'Tianma'),
(140, 'Toyota'),
(204, 'Tramontana'),
(161, 'UAZ'),
(210, 'Ultima'),
(144, 'Vauxhall'),
(154, 'VAZ (Lada)'),
(147, 'Volkswagen'),
(148, 'Volvo'),
(166, 'Vortex'),
(216, 'W Motors'),
(150, 'Westfield'),
(151, 'Wiesmann'),
(152, 'Xin Kai'),
(202, 'Yo-mobile'),
(153, 'Zastava'),
(156, 'ZAZ'),
(228, 'Zenos'),
(215, 'Zenvo'),
(234, 'Zibar'),
(193, 'Zotye'),
(175, 'ZX');

ALTER TABLE `car_makes`
  ADD PRIMARY KEY (`make_id`), ADD UNIQUE KEY `make` (`make`);

ALTER TABLE `car_makes`
  MODIFY `make_id` int(11) NOT NULL;

--
-- `https://databases.one`
--

CREATE TABLE IF NOT EXISTS `car_models` (
  `model_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `make_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- `car_models_2008_2018`
--

INSERT INTO `car_models` (`model_id`, `model`, `make_id`) VALUES
(3, 'Cobra', 1),
(1844, '378 GT Zagato', 1),
(7, 'MDX', 2),
(8, 'NSX', 2),
(9, 'RL', 2),
(12, 'TL', 2),
(13, 'TSX', 2),
(1311, 'RDX', 2),
(1448, 'CSX', 2),
(1674, 'ZDX', 2),
(1829, 'ILX', 2),
(2077, 'RLX', 2),
(2228, 'TLX', 2),
(16, '147', 3),
(29, 'Giulia', 3),
(30, 'Giulietta', 3),
(31, 'GT', 3),
(36, 'Spider', 3),
(1063, 'Brera', 3),
(1086, '159', 3),
(1565, '8C Competizione', 3),
(1573, 'MiTo', 3),
(2132, '4C', 3),
(2230, 'Disco Volante', 3),
(2693, 'Stelvio', 3),
(2061, 'XD3', 4),
(2138, 'B4', 4),
(2252, 'B6', 4),
(2254, 'B3', 4),
(2256, 'D3', 4),
(2257, 'B7', 4),
(2261, 'B5', 4),
(2262, 'D5', 4),
(38, 'A110', 5),
(47, 'DB9', 8),
(50, 'V12 Vanquish', 8),
(51, 'V8 Vantage', 8),
(52, 'Virage', 8),
(1482, 'DBS', 8),
(1531, 'Rapide', 8),
(1662, 'V12 Vantage', 8),
(1800, 'Cygnet', 8),
(1987, 'V12 Zagato', 8),
(2058, 'One-77', 8),
(2586, 'DB11', 8),
(57, 'A3', 9),
(58, 'A4', 9),
(59, 'A4 allroad', 9),
(60, 'A6', 9),
(61, 'A8', 9),
(62, 'A6 allroad', 9),
(67, 'RS4', 9),
(68, 'RS6', 9),
(70, 'S3', 9),
(71, 'S4', 9),
(72, 'S6', 9),
(73, 'S8', 9),
(74, 'TT', 9),
(1092, 'Q7', 9),
(1440, 'R8', 9),
(1461, 'A5', 9),
(1577, 'Q5', 9),
(1696, 'RS5', 9),
(1698, 'A1', 9),
(1715, 'A7', 9),
(1761, 'RS3', 9),
(1788, 'Q3', 9),
(1825, 'S5', 9),
(1831, 'S7', 9),
(2080, 'RS7', 9),
(2085, 'RS Q3', 9),
(2119, 'SQ5', 9),
(2179, 'S1', 9),
(2233, 'TTS', 9),
(2234, 'TT RS', 9),
(2583, 'Q2', 9),
(2588, 'SQ7', 9),
(1071, 'BJ2020', 12),
(84, 'Arnage', 13),
(85, 'Azure', 13),
(86, 'Brooklands', 13),
(88, 'Continental Flying Spur', 13),
(89, 'Mulsanne', 13),
(1968, 'Flying Spur', 13),
(1998, 'Continental GT', 13),
(2489, 'Bentayga', 13),
(93, '3er', 16),
(94, '5er', 16),
(95, '6er', 16),
(96, '7er', 16),
(1042, '1er', 16),
(1665, 'X5', 16),
(1894, 'X1', 16),
(1895, 'X3', 16),
(1896, 'X6', 16),
(1899, 'Z4', 16),
(2070, '4er', 16),
(2081, 'i3', 16),
(2135, '2er', 16),
(2157, 'i8', 16),
(2172, '2er Active Tourer', 16),
(2177, 'X4', 16),
(2271, '1M', 16),
(2272, 'M3', 16),
(2273, 'M4', 16),
(2274, 'M5', 16),
(2275, 'M6', 16),
(2277, 'X5 M', 16),
(2278, 'X6 M', 16),
(2279, 'Z4 M', 16),
(2428, '2er Grand Tourer', 16),
(2501, 'M2', 16),
(2670, 'X2 Concept', 16),
(98, 'Blenheim', 17),
(99, 'Fighter', 17),
(1118, 'Blenheim Speedster', 17),
(102, 'EB Veyron 16.4', 18),
(2582, 'Chiron', 18),
(104, 'GL8', 19),
(106, 'Park Avenue', 19),
(108, 'Regal', 19),
(1073, 'LaCrosse', 19),
(1352, 'Lucerne', 19),
(1506, 'Enclave', 19),
(1566, 'Excelle', 19),
(2218, 'Encore', 19),
(2412, 'Verano', 19),
(2549, 'Envision', 19),
(1251, 'Flyer', 20),
(1430, 'F3', 20),
(1595, 'F0', 20),
(1596, 'F6', 20),
(1597, 'F8', 20),
(1952, 'E6', 20),
(1953, 'G3', 20),
(1954, 'G6', 20),
(1955, 'L3', 20),
(1956, 'M6', 20),
(1957, 'S6', 20),
(2211, 'F5', 20),
(115, 'CTS', 21),
(118, 'Escalade', 21),
(121, 'XLR', 21),
(1039, 'SRX', 21),
(1264, 'BLS', 21),
(1266, 'STS', 21),
(1353, 'DTS', 21),
(1919, 'ATS', 21),
(1925, 'XTS', 21),
(2200, 'ELR', 21),
(2296, 'CTS-V', 21),
(2392, 'ATS-V', 21),
(2404, 'CT6', 21),
(2517, 'XT5', 21),
(125, 'Seven', 24),
(1530, 'CSR', 24),
(1269, 'Tiggo (T11)', 25),
(1270, 'Oriental Son (B11)', 25),
(1347, 'Amulet (A15)', 25),
(1351, 'Fora (A21)', 25),
(1439, 'Sweet (QQ)', 25),
(1546, 'QQ6 (S21)', 25),
(1547, 'Kimo (A1)', 25),
(1603, 'CrossEastar (B14)', 25),
(1692, 'M11 (A3)', 25),
(1765, 'Bonus (A13)', 25),
(1786, 'IndiS (S18D)', 25),
(1791, 'Very (A13)', 25),
(2215, 'Tiggo 5', 25),
(2216, 'Bonus 3 (E3/A19)', 25),
(2229, 'Arrizo 7', 25),
(2698, 'Tiggo 3', 25),
(2711, 'Tiggo 2', 25),
(2832, 'QQme', 25),
(2833, 'B13', 25),
(127, 'Astra', 26),
(131, 'Camaro', 26),
(132, 'Caprice', 26),
(137, 'Corvette', 26),
(138, 'Impala', 26),
(141, 'Malibu', 26),
(144, 'Niva', 26),
(149, 'Suburban', 26),
(150, 'Tahoe', 26),
(151, 'Tracker', 26),
(152, 'TrailBlazer', 26),
(156, 'Zafira', 26),
(1040, 'Aveo', 26),
(1075, 'Cobalt', 26),
(1076, 'Classic', 26),
(1077, 'Uplander', 26),
(1078, 'Equinox', 26),
(1103, 'Captiva', 26),
(1121, 'Lacetti', 26),
(1122, 'Lanos', 26),
(1123, 'Spark', 26),
(1125, 'Nubira', 26),
(1126, 'Rezzo', 26),
(1127, 'Viva', 26),
(1314, 'Epica', 26),
(1341, 'HHR', 26),
(1349, 'Silverado', 26),
(1381, 'Avalanche', 26),
(1427, 'Colorado', 26),
(1567, 'Tavera', 26),
(1568, 'Sail', 26),
(1569, 'LUV D-MAX', 26),
(1600, 'Cruze', 26),
(1601, 'Cruze (HR)', 26),
(1686, 'Traverse', 26),
(1787, 'Orlando', 26),
(1794, 'Volt', 26),
(1808, 'Sonic', 26),
(1945, 'Express', 26),
(1951, 'MW', 26),
(1958, 'Kalos', 26),
(2225, 'SS', 26),
(2551, 'Bolt', 26),
(2863, 'Tacuma', 26),
(163, 'Pacifica', 27),
(165, 'PT Cruiser', 27),
(166, 'Sebring', 27),
(168, 'Town & Country', 27),
(171, 'Voyager', 27),
(1129, '300C', 27),
(1450, 'Aspen', 27),
(1959, '200', 27),
(2300, '300C SRT8', 27),
(175, 'Berlingo', 28),
(177, 'C3', 28),
(178, 'C3 Picasso', 28),
(179, 'C5', 28),
(180, 'C8', 28),
(191, 'Xsara Picasso', 28),
(1055, 'C4', 28),
(1056, 'C4 Picasso', 28),
(1068, 'C6', 28),
(1131, 'C1', 28),
(1132, 'C2', 28),
(1265, 'Jumpy', 28),
(1490, 'C-Crosser', 28),
(1711, 'DS3', 28),
(1796, 'DS4', 28),
(1826, 'C4 Aircross', 28),
(1920, 'C-Elysee', 28),
(1960, 'DS5', 28),
(2190, 'C4 Cactus', 28),
(2337, 'C-ZERO', 28),
(2627, 'E-Mehari', 28),
(2628, 'Spacetourer', 28),
(2680, 'Nemo', 28),
(2782, 'C3 Aircross', 28),
(2794, 'C-Triomphe', 28),
(2846, 'C-Quatre', 28),
(194, 'T Rex', 30),
(1357, 'Logan', 31),
(1554, 'Sandero', 31),
(1707, 'Duster', 31),
(1907, 'Lodgy', 31),
(2020, 'Dokker', 31),
(198, 'Nubira', 33),
(205, 'Lacetti', 33),
(206, 'Lanos', 33),
(208, 'Leganza', 33),
(210, 'Matiz', 33),
(212, 'Nexia', 33),
(215, 'Rezzo', 33),
(1386, 'Damas', 33),
(1406, 'Tacuma', 33),
(1563, 'G2X', 33),
(1571, 'Tosca', 33),
(1572, 'Winstorm', 33),
(1580, 'Gentra', 33),
(2353, 'Sens', 33),
(2743, 'Alpheon', 33),
(218, 'Altis', 35),
(220, 'Atrai', 35),
(223, 'Cuore', 35),
(227, 'Mira', 35),
(228, 'Move', 35),
(230, 'Sirion', 35),
(231, 'Terios', 35),
(1454, 'Trevis', 35),
(1456, 'Copen', 35),
(1457, 'Esse', 35),
(1458, 'Be-go', 35),
(1473, 'Boon', 35),
(1499, 'Materia', 35),
(1559, 'Tanto', 35),
(1561, 'Sonica', 35),
(1562, 'Xenia', 35),
(1622, 'Mira Gino', 35),
(1721, 'Coo', 35),
(2520, 'Move Latte', 35),
(2734, 'Hijet', 35),
(2749, 'Mira e:S', 35),
(2767, 'Move Conte', 35),
(2768, 'Move Canbus', 35),
(2769, 'Tanto Exe', 35),
(2036, 'X350', 36),
(2158, 'GO', 37),
(2159, 'GO+', 37),
(2184, 'on-DO', 37),
(2227, 'mi-DO', 37),
(1101, 'Shuttle', 40),
(1405, 'Aurora', 40),
(1451, 'Plutus', 40),
(1495, 'Saladin', 40),
(2742, 'DW Hower H3', 40),
(240, 'Avenger', 41),
(241, 'Caravan', 41),
(242, 'Dakota', 41),
(243, 'Durango', 41),
(1016, 'RAM', 41),
(1100, 'Caliber', 41),
(1140, 'Magnum', 41),
(1143, 'Viper', 41),
(1360, 'Charger', 41),
(1444, 'Nitro', 41),
(1517, 'Challenger', 41),
(1574, 'Journey', 41),
(2071, 'Dart', 41),
(2617, 'D8 GTO', 43),
(1093, 'Jinn', 45),
(1445, 'Besturn B50', 45),
(1446, 'Vita', 45),
(1969, 'V2', 45),
(1970, 'V5', 45),
(2087, 'Besturn B70', 45),
(2155, 'Oley', 45),
(2224, 'Besturn X80', 45),
(1079, '612', 46),
(1342, '599', 46),
(1362, 'F430', 46),
(1555, 'California', 46),
(1706, '458', 46),
(1747, 'FF', 46),
(1984, 'F12berlinetta', 46),
(2018, 'LaFerrari', 46),
(2389, '488', 46),
(2524, 'FXX K', 46),
(2569, 'GTC4Lusso', 46),
(2699, '812 Superfast', 46),
(2745, 'Portofino', 46),
(273, '500', 47),
(276, 'Bravo', 47),
(278, 'Croma', 47),
(280, 'Fiorino', 47),
(282, 'Multipla', 47),
(283, 'Palio', 47),
(284, 'Panda', 47),
(285, 'Punto', 47),
(288, 'Seicento', 47),
(289, 'Siena', 47),
(291, 'Strada', 47),
(293, 'Tipo', 47),
(294, 'Ulysse', 47),
(1080, 'Idea', 47),
(1094, 'Sedici', 47),
(1146, 'Albea', 47),
(1275, 'Scudo', 47),
(1438, 'Linea', 47),
(1459, '600', 47),
(1556, 'Doblo', 47),
(1732, 'Qubo', 47),
(2032, '500L', 47),
(2065, 'Freemont', 47),
(2250, '500X', 47),
(2611, '124 Spider', 47),
(2673, 'Fullback', 47),
(302, 'Expedition', 48),
(303, 'Explorer', 48),
(304, 'Fiesta', 48),
(305, 'Focus', 48),
(306, 'Galaxy', 48),
(308, 'KA', 48),
(310, 'Mondeo', 48),
(320, 'Crown Victoria', 48),
(322, 'Econoline', 48),
(323, 'Escape', 48),
(324, 'Mustang', 48),
(325, 'Taurus', 48),
(1082, 'Freestyle', 48),
(1150, 'GT', 48),
(1151, 'Ranger', 48),
(1255, 'S-MAX', 48),
(1258, 'Tourneo Connect', 48),
(1387, 'F-150', 48),
(1483, 'Edge', 48),
(1492, 'C-MAX', 48),
(1507, 'Taurus X', 48),
(1529, 'Kuga', 48),
(1602, 'Flex', 48),
(1627, 'Explorer Sport Trac', 48),
(1762, 'Everest', 48),
(1903, 'Fusion (North America)', 48),
(1904, 'Fusion', 48),
(2078, 'B-MAX', 48),
(2086, 'Ranger (North America)', 48),
(2156, 'EcoSport', 48),
(2206, 'Tourneo Custom', 48),
(2241, 'Tourneo Courier', 48),
(2265, 'Focus (North America)', 48),
(2315, 'Fiesta ST', 48),
(2316, 'Focus ST', 48),
(2317, 'Focus RS', 48),
(2796, 'Ikon', 48),
(2797, 'Territory', 48),
(1274, 'MR', 50),
(1465, 'CK (Otaka)', 50),
(1551, 'MK', 50),
(1552, 'FC (Vision)', 50),
(1802, 'MK Cross', 50),
(1823, 'Emgrand EC7', 50),
(2144, 'SC7', 50),
(2145, 'LC (Panda)', 50),
(2146, 'LC (Panda) Cross', 50),
(2147, 'Emgrand EC8', 50),
(2148, 'Emgrand X7', 50),
(2194, 'GC6', 50),
(2411, 'GC9', 50),
(2633, 'Emgrand 7', 50),
(2697, 'Emgrand GT', 50),
(2904, 'Atlas', 50),
(334, 'Envoy', 52),
(336, 'Savana', 52),
(338, 'Yukon', 52),
(1153, 'Sierra', 52),
(1471, 'Acadia', 52),
(1675, 'Terrain', 52),
(1949, 'Canyon', 52),
(1104, 'Safe', 53),
(1105, 'Sing RUV', 53),
(1276, 'Sailor', 53),
(1356, 'Wingle', 53),
(1437, 'Pegasus', 53),
(1583, 'Peri', 53),
(1639, 'Coolbear', 53),
(1640, 'Florid', 53),
(1658, 'Cowry (V80)', 53),
(1702, 'Voleex C10 (Phenom)', 53),
(1905, 'Deer', 53),
(1906, 'Hover', 53),
(1930, 'Hover M2', 53),
(2064, 'Hover M4', 53),
(2154, 'Hover M1 (Peri 4x4)', 53),
(2236, 'Hover H6', 53),
(2237, 'Hover H5', 53),
(2238, 'Hover H3', 53),
(2341, 'Voleex C30', 53),
(1154, 'Ambassador', 54),
(349, 'UTE', 55),
(350, 'Accord', 56),
(351, 'Avancier', 56),
(353, 'City', 56),
(354, 'Civic', 56),
(356, 'CR-V', 56),
(359, 'Fit', 56),
(360, 'HR-V', 56),
(361, 'Insight', 56),
(362, 'Inspire', 56),
(363, 'Jazz', 56),
(364, 'Legend', 56),
(365, 'Life', 56),
(367, 'Mobilio', 56),
(368, 'Odyssey (North America)', 56),
(371, 'Pilot', 56),
(374, 'S2000', 56),
(377, 'Stepwgn', 56),
(378, 'Stream', 56),
(382, 'Vamos', 56),
(1033, 'Partner', 56),
(1045, 'Element', 56),
(1046, 'Fit Aria', 56),
(1084, 'FR-V', 56),
(1165, 'NSX', 56),
(1346, 'Ridgeline', 56),
(1513, 'Airwave', 56),
(1521, 'Shuttle', 56),
(1581, 'Edix', 56),
(1604, 'Crossroad', 56),
(1609, 'Elysion', 56),
(1694, 'FCX Clarity', 56),
(1755, 'CR-Z', 56),
(1763, 'Crosstour', 56),
(1799, 'Freed', 56),
(1814, 'Zest', 56),
(1967, 'Odyssey', 56),
(2196, 'Vezel', 56),
(2314, 'Civic Type R', 56),
(2368, 'Acty', 56),
(2403, 'S660', 56),
(2675, 'Fit Shuttle', 56),
(2717, 'N-WGN', 56),
(2728, 'N-One', 56),
(2737, 'Grace', 56),
(2757, 'Mobilio Spike', 56),
(2779, 'N-BOX', 56),
(2839, 'Brio', 56),
(386, 'H2', 57),
(387, 'H3', 57),
(388, 'Accent', 58),
(389, 'Atos', 58),
(390, 'Centennial', 58),
(393, 'Getz', 58),
(394, 'Elantra', 58),
(395, 'Matrix', 58),
(398, 'Santa Fe', 58),
(400, 'Sonata', 58),
(403, 'Trajet', 58),
(1034, 'Tucson', 58),
(1166, 'Coupe', 58),
(1267, 'Verna', 58),
(1268, 'Grandeur', 58),
(1277, 'Starex (H-1)', 58),
(1322, 'Veracruz', 58),
(1345, 'Tiburon', 58),
(1407, 'Tuscani', 58),
(1479, 'i30', 58),
(1486, 'Avante', 58),
(1510, 'Genesis', 58),
(1624, 'i20', 58),
(1626, 'i10', 58),
(1657, 'ix55', 58),
(1688, 'Equus', 58),
(1689, 'ix35', 58),
(1785, 'Veloster', 58),
(1815, 'Solaris', 58),
(1835, 'Genesis Coupe', 58),
(1846, 'ix20', 58),
(1976, 'i40', 58),
(2122, 'Maxcruz', 58),
(2244, 'Aslan', 58),
(2350, 'Entourage', 58),
(2605, 'Creta', 58),
(2666, 'IONIQ', 58),
(2723, 'Kona', 58),
(2739, 'i30 N', 58),
(2748, 'Click', 58),
(2898, 'Azera', 58),
(2902, 'EON', 58),
(1102, 'Samand', 59),
(2141, 'Soren', 59),
(2899, 'Dena', 59),
(2900, 'Runna', 59),
(2901, 'Sarir', 59),
(407, 'FX', 60),
(1508, 'EX', 60),
(1725, 'M', 60),
(1804, 'G', 60),
(1807, 'QX56', 60),
(1974, 'JX', 60),
(2123, 'QX70', 60),
(2124, 'Q50', 60),
(2125, 'QX50', 60),
(2126, 'Q60', 60),
(2127, 'QX60', 60),
(2128, 'QX80', 60),
(2193, 'Q70', 60),
(2214, 'Q40', 60),
(2490, 'Q30', 60),
(2521, 'QX30', 60),
(1083, 'S1', 62),
(415, 'Ascender', 64),
(1631, 'D-Max', 64),
(2045, 'MU-7', 64),
(2182, 'MU-X', 64),
(1557, 'Massif', 65),
(1477, 'M1 (Refine)', 66),
(1478, 'S1 (Rein)', 66),
(1999, 'J3 (Tongyue,Tojoy)', 66),
(2000, 'J7 (Binyue)', 66),
(2001, 'J5 (Heyue)', 66),
(2002, 'J6 (Heyue RS)', 66),
(2003, 'J2 (Yueyue)', 66),
(2160, 'S5 (Eagle)', 66),
(2480, 'S3', 66),
(2484, 'J4 (Heyue A30)', 66),
(2485, 'M5', 66),
(425, 'S-Type', 67),
(426, 'X-Type', 67),
(427, 'XJ', 67),
(1015, 'XK', 67),
(1502, 'XF', 67),
(1994, 'F-Type', 67),
(2240, 'XE', 67),
(2297, 'XFR', 67),
(2298, 'XKR', 67),
(2344, 'XJR', 67),
(2491, 'F-Pace', 67),
(2573, 'F-Type SVR', 67),
(2738, 'E-Pace', 67),
(429, 'Cherokee', 68),
(431, 'Grand Cherokee', 68),
(432, 'Wrangler', 68),
(1256, 'Commander', 68),
(1321, 'Compass', 68),
(1388, 'Liberty (North America)', 68),
(1460, 'Liberty (Patriot)', 68),
(2231, 'Renegade', 68),
(2299, 'Grand Cherokee SRT8', 68),
(434, 'Carens', 70),
(435, 'Carnival', 70),
(440, 'Magentis', 70),
(441, 'Opirus', 70),
(443, 'Pride', 70),
(445, 'Rio', 70),
(448, 'Sorento', 70),
(449, 'Sportage', 70),
(450, 'Visto', 70),
(1047, 'Sedona', 70),
(1051, 'Cerato', 70),
(1327, 'Spectra', 70),
(1385, 'Optima', 70),
(1433, 'Cee''d', 70),
(1511, 'Mohave (Borrego)', 70),
(1586, 'Picanto', 70),
(1608, 'Soul', 70),
(1700, 'Venga', 70),
(1797, 'Cadenza', 70),
(1840, 'Ray', 70),
(1921, 'Quoris', 70),
(2303, 'Cee''d GT', 70),
(2570, 'Niro', 70),
(2691, 'Stinger', 70),
(2763, 'Forte', 70),
(2764, 'K5', 70),
(2765, 'Morning', 70),
(2780, 'Stonic', 70),
(2807, 'K3', 70),
(2818, 'K7', 70),
(2823, 'K9', 70),
(2825, 'Lotze', 70),
(1753, 'CCX', 71),
(1758, 'Agera', 71),
(2181, 'One:1', 71),
(2401, 'Regera', 71),
(458, 'Murcielago', 72),
(1048, 'Gallardo', 72),
(1633, 'Reventon', 72),
(1821, 'Aventador', 72),
(2183, 'HuracÃ¡n', 72),
(2186, 'Veneno', 72),
(2217, 'Sesto Elemento', 72),
(2589, 'Centanario', 72),
(2696, 'Urus Concept', 72),
(2708, 'Egoista', 72),
(462, 'Delta', 73),
(467, 'Phedra', 73),
(469, 'Thema', 73),
(470, 'Thesis', 73),
(1463, 'Ypsilon', 73),
(1498, 'Musa', 73),
(2380, 'Voyager', 73),
(2385, 'Flavia', 73),
(472, 'Discovery', 74),
(473, 'Freelander', 74),
(474, 'Range Rover', 74),
(475, 'Range Rover Sport', 74),
(1792, 'Range Rover Evoque', 74),
(1908, 'Defender', 74),
(2246, 'Discovery Sport', 74),
(2700, 'Range Rover Velar', 74),
(1281, 'X6', 75),
(2022, 'X5', 75),
(2023, 'Forward', 75),
(2024, 'Fashion (CV9)', 75),
(2213, 'X9', 75),
(2657, 'X7', 75),
(476, 'ES', 76),
(477, 'GX', 76),
(478, 'IS', 76),
(479, 'LS', 76),
(480, 'LX', 76),
(481, 'RX', 76),
(482, 'SC', 76),
(1171, 'GS', 76),
(1699, 'HS', 76),
(1740, 'CT', 76),
(1790, 'LFA', 76),
(2137, 'RC', 76),
(2220, 'NX', 76),
(2301, 'IS F', 76),
(2302, 'RC F', 76),
(2402, 'GS F', 76),
(2550, 'LC', 76),
(484, 'Navigator', 77),
(485, 'Town Car', 77),
(1180, 'Continental', 77),
(1278, 'Mark LT', 77),
(1363, 'MKX', 77),
(1464, 'MKZ', 77),
(1712, 'MKT', 77),
(1813, 'MKS', 77),
(2185, 'MKC', 77),
(488, 'Elise', 78),
(491, 'Europa S', 78),
(493, 'Exige', 78),
(1651, 'Evora', 78),
(494, 'TX', 79),
(496, 'Bolero', 80),
(498, 'Commander', 80),
(1184, 'Scorpio', 80),
(1343, 'Marshal', 80),
(2055, 'Xylo', 80),
(2057, 'Verito', 80),
(504, '800', 82),
(505, 'Alto', 82),
(508, 'Gypsy', 82),
(509, 'Omni', 82),
(510, 'Versa', 82),
(511, 'Wagon R', 82),
(520, 'Ghibli', 83),
(527, 'Quattroporte', 83),
(1484, 'GranTurismo', 83),
(2585, 'Levante', 83),
(1995, '57', 84),
(1996, '62', 84),
(535, 'Atenza', 85),
(537, 'AZ-Offroad', 85),
(538, 'AZ-Wagon', 85),
(540, 'Carol', 85),
(542, 'Demio', 85),
(548, '2', 85),
(550, 'MPV', 85),
(552, 'MX-5', 85),
(555, 'Premacy', 85),
(558, 'RX-8', 85),
(559, 'Scrum', 85),
(561, 'Spiano', 85),
(562, 'Tribute', 85),
(1036, '3', 85),
(1098, 'CX-7', 85),
(1189, '6', 85),
(1320, '5', 85),
(1365, 'CX-9', 85),
(1410, 'Familia', 85),
(1414, 'BT-50', 85),
(1425, 'Bongo', 85),
(1466, 'Verisa', 85),
(1467, 'Axela', 85),
(1468, 'Roadster', 85),
(1623, 'Biante', 85),
(1812, 'CX-5', 85),
(2304, '3 MPS', 85),
(2305, '6 MPS', 85),
(2398, 'CX-3', 85),
(2719, 'Flair', 85),
(2720, 'Flair Crossover', 85),
(2778, 'CX-8', 85),
(1941, 'MP4-12C', 86),
(2131, 'P1', 86),
(2210, '650S', 86),
(2393, '675LT', 86),
(2405, '570S', 86),
(2413, '540C', 86),
(2581, '570GT', 86),
(2704, '720S', 86),
(569, 'A-klasse', 88),
(570, 'C-klasse', 88),
(571, 'CL-klasse', 88),
(572, 'CLK-klasse', 88),
(573, 'E-klasse', 88),
(574, 'G-klasse', 88),
(575, 'M-klasse', 88),
(576, 'S-klasse', 88),
(577, 'SLK-klasse', 88),
(1052, 'CLS-klasse', 88),
(1053, 'SLR McLaren', 88),
(1067, 'B-klasse', 88),
(1072, 'R-klasse', 88),
(1099, 'GL-klasse', 88),
(1428, 'Viano', 88),
(1516, 'Vito', 88),
(1553, 'CLC-klasse', 88),
(1570, 'GLK-klasse', 88),
(1670, 'SLS AMG', 88),
(1671, 'SL-klasse', 88),
(1911, 'V-klasse', 88),
(1926, 'CLA-klasse', 88),
(2094, 'GLA-klasse', 88),
(2106, 'Citan', 88),
(2239, 'AMG GT', 88),
(2269, 'Maybach S-klasse', 88),
(2280, 'A-klasse AMG', 88),
(2281, 'C-klasse AMG', 88),
(2282, 'CL-klasse AMG', 88),
(2283, 'CLA-klasse AMG', 88),
(2284, 'CLK-klasse AMG', 88),
(2285, 'CLS-klasse AMG', 88),
(2286, 'G-klasse AMG', 88),
(2287, 'G-klasse AMG 6x6', 88),
(2288, 'GLA-klasse AMG', 88),
(2289, 'M-klasse AMG', 88),
(2290, 'SLK-klasse AMG', 88),
(2292, 'SL-klasse AMG', 88),
(2293, 'S-klasse AMG', 88),
(2294, 'E-klasse AMG', 88),
(2343, 'GL-klasse AMG', 88),
(2396, 'GLE', 88),
(2397, 'AMG GLE', 88),
(2406, 'GLE Coupe', 88),
(2407, 'AMG GLE Coupe', 88),
(2426, 'GLC', 88),
(2507, 'GLS-klasse', 88),
(2508, 'GLS-klasse AMG', 88),
(2528, 'SLC-klasse', 88),
(2532, 'SLC-klasse AMG', 88),
(2598, 'AMG GLC', 88),
(2603, 'GLC Coupe', 88),
(2665, 'AMG GLC Coupe', 88),
(2678, 'X-klasse Concept', 88),
(580, 'Mountaineer', 89),
(582, 'Sable', 89),
(1205, 'Grand Marquis', 89),
(1366, 'Milan', 89),
(1367, 'Mariner', 89),
(1754, '550', 91),
(2026, '6', 91),
(2027, '350', 91),
(2028, '5', 91),
(2136, '3', 91),
(2414, 'GS', 91),
(2654, '750', 91),
(2101, 'M.Go', 92),
(2102, 'M8', 92),
(2104, 'MC', 92),
(2163, 'F8C', 92),
(594, 'Hatch', 94),
(1534, 'Clubman', 94),
(1535, 'Countryman', 94),
(1935, 'Paceman', 94),
(1937, 'Cabrio', 94),
(1938, 'Coupe', 94),
(2076, 'Roadster', 94),
(596, 'Airtrek', 95),
(600, 'Challenger', 95),
(602, 'Colt', 95),
(608, 'Eclipse', 95),
(609, 'eK', 95),
(612, 'Galant', 95),
(613, 'Grandis', 95),
(616, 'Minica', 95),
(617, 'Mirage', 95),
(618, 'Outlander', 95),
(619, 'Pajero', 95),
(624, 'Proudia', 95),
(625, 'RVR', 95),
(630, 'Space Star', 95),
(633, 'Toppo', 95),
(634, 'Town Box', 95),
(1159, 'Delica', 95),
(1192, 'Lancer', 95),
(1217, 'Endeavor', 95),
(1317, 'L200', 95),
(1318, 'Raider', 95),
(1396, 'Montero', 95),
(1397, 'Montero Sport', 95),
(1475, 'i', 95),
(1683, 'Minicab', 95),
(1703, 'ASX', 95),
(1836, 'i-MiEV', 95),
(1841, 'Lancer Evolution', 95),
(1842, 'Pajero Sport', 95),
(2083, 'Lancer Cargo', 95),
(2162, 'Pajero Mini', 95),
(2349, 'Attrage', 95),
(2359, 'Dignity', 95),
(2409, 'Lancer Ralliart', 95),
(2649, 'Delica D:2', 95),
(2650, 'Delica D:3', 95),
(2753, 'eK Sport', 95),
(2760, 'Galant Fortis', 95),
(2761, 'Triton', 95),
(2770, 'eK Custom', 95),
(2771, 'eK Space', 95),
(2775, 'Eclipse Cross', 95),
(2776, 'Delica D:5', 95),
(2799, 'Savrin', 95),
(2858, 'Xpander', 95),
(2866, 'Freeca', 95),
(1128, 'Galue', 96),
(1739, 'Nouera', 96),
(1778, 'Himiko', 96),
(1779, 'Orochi', 96),
(1781, 'Viewt', 96),
(1784, 'Like', 96),
(2034, 'Galue 204', 96),
(636, 'Aero 8', 97),
(637, '4/4', 97),
(638, 'Plus 8', 97),
(639, 'Plus 4', 97),
(1771, 'Roadster', 97),
(2038, 'AeroMax', 97),
(2039, 'Aero SuperSports', 97),
(2040, 'Aero Coupe', 97),
(2142, '3 Wheeler', 97),
(2143, '4 Seater', 97),
(655, '350Z', 99),
(656, 'Almera', 99),
(658, 'Altima', 99),
(662, 'Cedric', 99),
(663, 'Cefiro', 99),
(665, 'Cima', 99),
(666, 'Crew', 99),
(667, 'Cube', 99),
(668, 'Elgrand', 99),
(675, 'Micra', 99),
(676, 'Moco', 99),
(677, 'Murano', 99),
(678, 'Pathfinder', 99),
(680, 'Presage', 99),
(682, 'President', 99),
(683, 'Primera', 99),
(684, 'Pulsar', 99),
(685, 'Quest', 99),
(688, 'Safari', 99),
(689, 'Sentra', 99),
(690, 'Serena', 99),
(692, 'Skyline', 99),
(693, 'Skyline Crossover', 99),
(697, 'Terrano', 99),
(700, 'Wingroad', 99),
(701, 'X-Terra', 99),
(702, 'X-Trail', 99),
(1020, 'Maxima', 99),
(1021, 'Patrol', 99),
(1022, 'Vanette', 99),
(1087, 'Teana', 99),
(1096, 'Note', 99),
(1097, 'Navara (Frontier)', 99),
(1160, 'Urvan', 99),
(1161, 'Titan', 99),
(1225, 'Armada', 99),
(1323, 'Primastar', 99),
(1355, 'Qashqai', 99),
(1358, 'Lafesta', 99),
(1364, 'Rogue', 99),
(1394, 'March', 99),
(1395, 'AD', 99),
(1398, 'Fairlady Z', 99),
(1449, 'Versa', 99),
(1462, 'Tiida', 99),
(1536, 'GT-R', 99),
(1582, 'Fuga', 99),
(1585, 'NP 300', 99),
(1635, '370Z', 99),
(1644, 'Leaf', 99),
(1646, 'Caravan', 99),
(1693, 'Clipper', 99),
(1718, 'Juke', 99),
(1759, 'Otti (Dayz)', 99),
(1843, 'Bluebird Sylphy', 99),
(1940, 'NV200', 99),
(1979, 'Dualis', 99),
(1981, 'Pino', 99),
(1982, 'Pixo', 99),
(2096, 'Almera Classic', 99),
(2120, 'Roox', 99),
(2208, 'NV350 Caravan', 99),
(2362, 'Qashqai+2', 99),
(2370, 'Kix', 99),
(2418, 'Juke Nismo', 99),
(2651, 'Latio', 99),
(2747, 'Dayz', 99),
(2869, 'Livina', 99),
(2876, 'Clipper Rio', 99),
(2105, 'M600', 100),
(2819, 'M15', 100),
(710, 'Agila', 102),
(715, 'Meriva', 102),
(718, 'Signum', 102),
(721, 'Tigra', 102),
(1193, 'Astra', 102),
(1194, 'Zafira', 102),
(1197, 'Vectra', 102),
(1198, 'Corsa', 102),
(1200, 'Combo', 102),
(1260, 'Antara', 102),
(1593, 'Insignia', 102),
(1832, 'Mokka', 102),
(1833, 'Ampera', 102),
(1892, 'GT', 102),
(1927, 'Cascada', 102),
(1929, 'Adam', 102),
(2204, 'Vivaro', 102),
(2321, 'Astra OPC', 102),
(2323, 'Corsa OPC', 102),
(2324, 'Insignia OPC', 102),
(2327, 'Meriva OPC', 102),
(2328, 'Vectra OPC', 102),
(2329, 'Zafira OPC', 102),
(2387, 'Karl', 102),
(2706, 'Crossland X', 102),
(2746, 'Grandland X', 102),
(723, 'Zonda', 104),
(2109, 'Huayra', 104),
(725, 'Esperante', 105),
(727, 'Kenari', 106),
(728, 'Kancil', 106),
(1950, 'Viva', 106),
(2097, 'Kembara', 106),
(2098, 'Nautica', 106),
(2099, 'Alza', 106),
(2100, 'MyVi', 106),
(731, '206', 107),
(734, '307', 107),
(736, '405', 107),
(740, '607', 107),
(742, '807', 107),
(1090, '1007', 107),
(1095, '107', 107),
(1162, 'Partner', 107),
(1214, '207', 107),
(1215, '407', 107),
(1282, 'Expert', 107),
(1488, 'Bipper', 107),
(1493, '4007', 107),
(1523, '308', 107),
(1629, '3008', 107),
(1687, '5008', 107),
(1704, 'RCZ', 107),
(1709, '508', 107),
(1824, '4008', 107),
(1838, '408', 107),
(1922, '208', 107),
(1943, '301', 107),
(2164, '2008', 107),
(2199, '108', 107),
(2334, '208 GTi', 107),
(2336, 'iOn', 107),
(2427, '308 GTi', 107),
(2574, 'Traveller', 107),
(752, 'Grand Prix', 109),
(753, 'Montana', 109),
(756, 'Vibe', 109),
(1369, 'G6', 109),
(1370, 'Solstice', 109),
(1371, 'Torrent', 109),
(1742, 'G4', 109),
(1743, 'G5', 109),
(1744, 'G8', 109),
(757, '911', 110),
(760, 'Boxster', 110),
(762, 'Cayenne', 110),
(1069, 'Cayman', 110),
(1634, 'Panamera', 110),
(2093, '918 Spyder', 110),
(2139, 'Macan', 110),
(2308, '911 GT2', 110),
(2309, '911 GT3', 110),
(2391, 'Cayman GT4', 110),
(2564, '718 Boxster', 110),
(2614, '718 Cayman', 110),
(2701, '911 R', 110),
(765, 'Perdana', 112),
(766, 'Satria', 112),
(767, 'Wira (400 Series)', 112),
(768, 'Saga', 112),
(769, 'Waja', 112),
(2043, 'Persona', 112),
(2044, 'Gen-2', 112),
(2047, 'Exora', 112),
(2048, 'Inspira', 112),
(2049, 'Preve', 112),
(2886, 'Arena', 112),
(2887, 'Savvy', 112),
(770, 'Pinzgauer', 113),
(776, 'Clio', 117),
(777, 'Espace', 117),
(778, 'Kangoo', 117),
(779, 'Laguna', 117),
(780, 'Megane', 117),
(781, 'Safrane', 117),
(782, 'Scenic', 117),
(784, 'Symbol', 117),
(785, 'Twingo', 117),
(786, 'Vel Satis', 117),
(1049, 'Modus', 117),
(1050, 'Logan', 117),
(1283, 'Trafic', 117),
(1576, 'Koleos', 117),
(1648, 'Fluence', 117),
(1672, 'Sandero', 117),
(1727, 'Latitude', 117),
(1764, 'Twizy', 117),
(1816, 'Duster', 117),
(1973, 'Wind', 117),
(1975, 'ZOE', 117),
(2008, 'Captur', 117),
(2247, 'Lodgy', 117),
(2248, 'Dokker', 117),
(2310, 'Clio RS', 117),
(2311, 'Megane RS', 117),
(2421, 'Kadjar', 117),
(2430, 'Talisman', 117),
(2488, 'Sandero RS', 117),
(2494, 'KWID', 117),
(2612, 'Kaptur', 117),
(2646, 'Alaskan', 117),
(1647, 'Ghost', 118),
(1997, 'Phantom', 118),
(2066, 'Wraith', 118),
(2487, 'Dawn', 118),
(790, 'Lightning', 119),
(795, '9-3', 121),
(796, '9-5', 121),
(1044, '9-7X', 121),
(1793, '9-4X', 121),
(800, 'SM3', 123),
(801, 'SM5', 123),
(1348, 'SM7', 123),
(2826, 'QM5', 123),
(2827, 'QM6', 123),
(805, 'VUE', 124),
(1344, 'Aura', 124),
(1373, 'Sky', 124),
(1375, 'Outlook', 124),
(1575, 'Astra', 124),
(1065, 'xB', 125),
(1066, 'tC', 125),
(1524, 'xD', 125),
(1795, 'iQ', 125),
(2025, 'FR-S', 125),
(2429, 'iM', 125),
(2478, 'iA', 125),
(806, 'Ibiza', 126),
(808, 'Alhambra', 126),
(810, 'Cordoba', 126),
(812, 'Leon', 126),
(816, 'Toledo', 126),
(1336, 'Altea', 126),
(1628, 'Exeo', 126),
(2318, 'Ibiza Cupra', 126),
(2319, 'Leon Cupra', 126),
(2335, 'Mii', 126),
(2584, 'Ateca', 126),
(2729, 'Arona', 126),
(817, 'Fabia', 127),
(819, 'Octavia', 127),
(820, 'Rapid', 127),
(821, 'Superb', 127),
(1350, 'Roomster', 127),
(1637, 'Yeti', 127),
(1924, 'Citigo', 127),
(2312, 'Fabia RS', 127),
(2313, 'Octavia RS', 127),
(2664, 'Kodiaq', 127),
(2715, 'Karoq', 127),
(1379, 'Fortwo', 128),
(1435, 'Forfour', 128),
(1241, 'C8', 130),
(2051, 'C12', 130),
(823, 'Chairman', 131),
(825, 'Rexton', 131),
(1242, 'Korando', 131),
(1244, 'Rodius', 131),
(1279, 'Kyron', 131),
(1284, 'Actyon', 131),
(1883, 'Actyon Sports', 131),
(2129, 'Stavic', 131),
(2235, 'Korando Sports', 131),
(2399, 'Tivoli', 131),
(2420, 'Nomad', 131),
(2690, 'XLV', 131),
(2873, 'Korando Turismo', 131),
(828, 'Forester', 132),
(829, 'Impreza', 132),
(830, 'Justy', 132),
(831, 'Legacy', 132),
(833, 'Pleo', 132),
(1261, 'Tribeca', 132),
(1442, 'R1', 132),
(1443, 'R2', 132),
(1501, 'Outback', 132),
(1589, 'Stella', 132),
(1746, 'Exiga', 132),
(1749, 'Dex', 132),
(1750, 'Sambar', 132),
(1751, 'Lucra', 132),
(1752, 'Trezia', 132),
(1884, 'XV', 132),
(1936, 'BRZ', 132),
(2197, 'WRX', 132),
(2306, 'Impreza WRX', 132),
(2338, 'WRX STi', 132),
(2339, 'Impreza WRX STi', 132),
(2340, 'Levorg', 132),
(2787, 'Dias Wagon', 132),
(2893, 'Ascent', 132),
(840, 'Grand Vitara', 133),
(841, 'Ignis', 133),
(842, 'Jimny', 133),
(843, 'Liana', 133),
(844, 'MR Wagon', 133),
(845, 'Swift', 133),
(1245, 'Alto', 133),
(1246, 'Wagon R+', 133),
(1418, 'Escudo', 133),
(1519, 'Splash', 133),
(1584, 'Every', 133),
(1598, 'Reno', 133),
(1611, 'Wagon R', 133),
(1724, 'Kizashi', 133),
(1737, 'Cervo', 133),
(1777, 'Landy', 133),
(1859, 'Baleno', 133),
(1860, 'Forenza', 133),
(1861, 'Kei', 133),
(1862, 'SX4', 133),
(1863, 'XL7', 133),
(1946, 'Spacia', 133),
(1972, 'Ertiga', 133),
(2133, 'Solio', 133),
(2187, 'Palette', 133),
(2201, 'Celerio', 133),
(2212, 'Vitara', 133),
(2681, 'Equator', 133),
(2772, 'Hustler', 133),
(2781, 'APV', 133),
(2803, 'Alto Lapin', 133),
(851, 'Aria', 135),
(853, 'Indica', 135),
(854, 'Sumo', 135),
(1248, 'Safari', 135),
(1376, 'Indigo', 135),
(1939, 'Nano', 135),
(2379, 'Xenon', 135),
(2850, 'Sumo Grande', 135),
(1289, 'Century', 137),
(860, '4Runner', 140),
(861, 'Allion', 140),
(864, 'Avalon', 140),
(865, 'Avensis', 140),
(866, 'Avensis Verso', 140),
(867, 'bB', 140),
(872, 'Camry', 140),
(876, 'Corolla', 140),
(877, 'Corolla Verso', 140),
(881, 'Crown', 140),
(886, 'Harrier', 140),
(887, 'Highlander', 140),
(888, 'Ipsum', 140),
(889, 'Kluger', 140),
(890, 'Land Cruiser', 140),
(898, 'Picnic', 140),
(900, 'Premio', 140),
(901, 'Previa', 140),
(902, 'Prius', 140),
(905, 'Raum', 140),
(906, 'RAV 4', 140),
(908, 'Sequoia', 140),
(910, 'Sienna', 140),
(917, 'Vitz', 140),
(919, 'Yaris', 140),
(1026, 'HiAce', 140),
(1027, 'LiteAce', 140),
(1070, 'Aygo', 140),
(1250, 'Century', 140),
(1285, 'Hilux', 140),
(1292, 'Estima', 140),
(1293, 'Fortuner', 140),
(1296, 'Ist', 140),
(1298, 'Matrix', 140),
(1299, 'Noah', 140),
(1300, 'Probox', 140),
(1305, 'Succeed', 140),
(1306, 'TownAce', 140),
(1307, 'Tacoma', 140),
(1309, 'Voxy', 140),
(1310, 'Wish', 140),
(1377, 'Auris', 140),
(1390, 'Tundra', 140),
(1391, 'Alphard', 140),
(1399, 'Sienta', 140),
(1412, 'FJ Cruiser', 140),
(1423, 'Mark X', 140),
(1424, 'Mark X ZiO', 140),
(1472, 'Passo', 140),
(1487, 'Aurion', 140),
(1509, 'Porte', 140),
(1512, 'ISis', 140),
(1522, 'Venza', 140),
(1588, 'Ractis', 140),
(1591, 'Corolla Rumion', 140),
(1607, 'Urban Cruiser', 140),
(1610, 'iQ', 140),
(1615, 'Belta', 140),
(1616, 'Blade', 140),
(1618, 'Rush', 140),
(1668, 'Innova', 140),
(1681, 'Vellfire', 140),
(1708, 'Verso', 140),
(1726, 'Vios', 140),
(1776, 'Vanguard', 140),
(1810, 'Crown Majesta', 140),
(1811, 'Land Cruiser Prado', 140),
(1827, 'GT86', 140),
(1845, 'Passo Sette', 140),
(1912, 'Hilux Surf', 140),
(1965, 'Sai', 140),
(1966, 'Verso-S', 140),
(2092, 'Prius v (+)', 140),
(2167, 'Prius c', 140),
(2242, 'ProAce', 140),
(2266, 'Camry Solara', 140),
(2268, 'Camry (Japan)', 140),
(2504, 'Mirai', 140),
(2529, 'Pixis Epoch', 140),
(2530, 'Pixis Mega', 140),
(2531, 'Pixis Space', 140),
(2648, 'Aqua', 140),
(2687, 'C-HR', 140),
(2716, 'Spade', 140),
(2721, 'Esquire', 140),
(2804, 'Comfort', 140),
(2811, 'Prius Alpha', 140),
(2853, 'Avanza', 140),
(2855, 'Etios', 140),
(1252, 'Astra', 144),
(1254, 'Vectra', 144),
(1734, 'VXR8', 144),
(2063, 'Adam', 144),
(970, 'Golf', 147),
(971, 'Golf Plus', 147),
(975, 'Beetle', 147),
(976, 'Passat', 147),
(977, 'Phaeton', 147),
(978, 'Polo', 147),
(980, 'Scirocco', 147),
(981, 'Sharan', 147),
(983, 'Touareg', 147),
(984, 'Touran', 147),
(1088, 'Fox', 147),
(1201, 'Jetta', 147),
(1257, 'Pointer', 147),
(1259, 'Eos', 147),
(1378, 'Caddy', 147),
(1485, 'Tiguan', 147),
(1518, 'Multivan', 147),
(1705, 'Amarok', 147),
(1717, 'Routan', 147),
(1923, 'up!', 147),
(1928, 'XL1', 147),
(1932, 'Passat CC', 147),
(2165, 'Golf Sportsvan', 147),
(2166, 'Passat (North America)', 147),
(2202, 'Caravelle', 147),
(2203, 'Transporter', 147),
(2205, 'California', 147),
(2322, 'Golf GTI', 147),
(2325, 'Scirocco R', 147),
(2326, 'Golf R', 147),
(2331, 'Polo R WRC', 147),
(2332, 'Polo GTI', 147),
(2527, 'Golf R32', 147),
(2703, 'Arteon', 147),
(2724, 'Teramont', 147),
(2805, 'Parati', 147),
(2852, 'Gol', 147),
(2857, 'T-Roc', 147),
(995, 'S40', 148),
(996, 'S60', 148),
(998, 'S80', 148),
(999, 'S90', 148),
(1000, 'V40', 148),
(1001, 'V90', 148),
(1002, 'XC90', 148),
(1009, 'V70', 148),
(1032, 'C70', 148),
(1037, 'XC70', 148),
(1312, 'V50', 148),
(1319, 'C30', 148),
(1599, 'XC60', 148),
(1760, 'V60', 148),
(2345, 'V40 Cross Country', 148),
(2386, 'V60 Cross Country', 148),
(2410, 'S60 Cross Country', 148),
(2667, 'V90 Cross Country', 148),
(2774, 'XC40', 148),
(2088, 'SEi & Sport', 150),
(2089, 'SEiGHT', 150),
(1106, 'Roadster', 151),
(1489, 'GT', 151),
(1059, 'SR-V X3', 152),
(1060, 'SUV X3', 152),
(1061, 'Pickup X3', 152),
(1005, 'Skala', 153),
(1110, 'Yugo', 153),
(1474, '10', 153),
(2053, 'Florida', 153),
(945, '2104', 154),
(946, '2105', 154),
(948, '2107', 154),
(951, '2110', 154),
(952, '2111', 154),
(953, '2112', 154),
(954, '2113', 154),
(955, '2114', 154),
(956, '2115', 154),
(959, '2131 (4x4)', 154),
(1089, 'Kalina', 154),
(1313, '1111 Oka', 154),
(1431, 'Priora', 154),
(1504, '2329', 154),
(1659, 'Revolution', 154),
(1798, 'Granta', 154),
(1837, 'Largus', 154),
(1893, '2121 (4x4)', 154),
(2079, '21099', 154),
(2388, 'Vesta', 154),
(2400, 'XRAY', 154),
(2475, 'EL Lada', 154),
(1587, 'Volga Siber', 155),
(1731, '2330 Â«TigrÂ»', 155),
(2011, '3102 Â«VolgaÂ»', 155),
(2014, '3110 Â«VolgaÂ»', 155),
(2015, '31105 Â«VolgaÂ»', 155),
(1006, '1102 Â«TavriyaÂ»', 156),
(1007, '1103 Â«SlavutaÂ»', 156),
(1447, 'Sens', 156),
(1497, '1105 Â«DanaÂ»', 156),
(1643, 'Chance', 156),
(1757, 'Forza', 156),
(1986, 'Vida', 156),
(2679, 'Lanos', 156),
(2006, '2717', 158),
(936, '469', 161),
(1062, 'Patriot', 161),
(1606, 'Pickup', 161),
(2004, 'Hunter', 161),
(1645, 'X-Bow', 162),
(2114, 'Sportster', 163),
(2115, '5EXi', 163),
(2346, 'Hemera', 164),
(2347, 'Cevennes', 164),
(2348, 'Speedster II', 164),
(2059, 'Porter', 165),
(1729, 'Corda', 166),
(1733, 'Tingo', 166),
(1735, 'Estina', 166),
(1107, 'Brio', 167),
(1315, 'Saibao', 167),
(1316, 'Sigma', 167),
(1339, 'Simbo', 167),
(1340, 'Princip', 167),
(1756, 'Midi', 168),
(1931, 'Tunland', 168),
(2647, 'Sauvana', 168),
(1548, 'MPV', 169),
(1549, 'Oting', 169),
(1550, 'Rich', 169),
(2041, 'H30 Cross', 169),
(2195, 'S30', 169),
(2594, 'AX7', 169),
(2661, 'A9', 169),
(2663, '370', 169),
(1354, 'Breez (520)', 170),
(1679, 'Solano', 170),
(1680, 'Smily', 170),
(1934, 'X60', 170),
(2176, 'Cebrium (720)', 170),
(2192, 'Celliya (530)', 170),
(2424, 'X50', 170),
(2709, 'Myway', 170),
(2730, 'Murman', 170),
(1359, 'SUV (CS6)', 171),
(1380, 'Sceo', 172),
(2050, 'Noble', 172),
(1382, 'M1 (BS6)', 173),
(1383, 'M2 (BS4)', 173),
(1564, 'M3 (BC3)', 173),
(1578, 'FRV (BS2)', 173),
(2178, 'V5', 173),
(2249, 'H530', 173),
(2422, 'H230', 173),
(1453, 'Lioncel', 174),
(1469, 'Landmark', 175),
(1470, 'Grand Tiger', 175),
(1719, 'Admiral', 175),
(1491, '6500 (Land King)', 176),
(1505, 'Antelope', 177),
(1543, 'Plutus', 177),
(1650, 'Landscape', 177),
(1579, 'Tager', 179),
(1592, 'Road Partner', 179),
(1638, 'Vega', 179),
(1820, 'C-30', 179),
(1933, 'Aquila', 179),
(1947, 'C10', 179),
(1962, 'C190', 179),
(1542, 'Troy', 180),
(1678, 'Baodian', 182),
(1619, 'La Joya', 183),
(2068, 'Geneva', 183),
(1620, 'CM-8', 184),
(1621, 'Z-Shine', 184),
(2149, 'CS35', 184),
(2150, 'Benni', 184),
(2151, 'Eado', 184),
(2152, 'Raeton', 184),
(2394, 'CS75', 184),
(2671, 'Alsvin V7', 184),
(2108, 'Leopard', 185),
(1691, 'Roadster', 187),
(1772, 'Model S', 187),
(2497, 'Model X', 187),
(2741, 'Model 3', 187),
(1722, 'B1', 188),
(1723, 'B2', 188),
(1730, '3', 189),
(2062, '7', 189),
(2180, 'M3', 189),
(2483, 'S5', 189),
(2862, '2', 189),
(2890, 'Family F7', 189),
(2891, 'Freema', 189),
(1736, 'Zero', 190),
(1769, 'Atom', 191),
(1819, 'PS-10', 192),
(1828, 'Nomad (RX6400)', 193),
(2481, 'Z300', 193),
(2482, 'T600', 193),
(2535, 'Z100', 193),
(2694, 'SR9', 193),
(1914, 'Luxgen5', 194),
(1915, 'Luxgen7 SUV', 194),
(1916, 'Luxgen7 MPV', 194),
(2174, 'U7 Turbo', 194),
(2191, 'U6 Turbo', 194),
(1983, 'HMMWV (Humvee)', 195),
(1988, 'Karma', 196),
(1989, 'Estrima Biro', 197),
(1990, 'GD04B', 198),
(1991, 'BD326J (Moca)', 199),
(1992, 'BD132J (CoCo)', 199),
(2111, 'E-Krossover', 202),
(2112, 'Ris', 203),
(2113, 'Tramontana', 204),
(2140, '3', 206),
(2188, 'SV12', 207),
(2658, 'ML 63 Biturbo', 207),
(2223, 'Boliger', 209),
(2845, 'Laville', 209),
(2882, 'B21', 209),
(2226, 'GTR', 210),
(2243, 'Roadster', 211),
(2245, 'H6', 212),
(2384, 'H8', 212),
(2395, 'H9', 212),
(2415, 'H2', 212),
(2847, 'H6 Coupe', 212),
(2342, '5', 213),
(2416, '3', 213),
(2417, '4', 213),
(2896, '7 Crossback', 213),
(2375, 'C81', 214),
(2376, 'C51', 214),
(2377, 'C52', 214),
(2378, 'C31', 214),
(2816, 'C32', 214),
(2817, 'C61', 214),
(2390, 'ST1', 215),
(2408, 'Lykan Hypersport', 216),
(2518, 'Fenyr Supersport', 216),
(2423, 'Beast', 217),
(2425, 'Concept_One', 218),
(2477, 'T98', 223),
(2492, '2000', 224),
(2498, 'Gentra', 225),
(2499, 'Matiz', 225),
(2505, 'Nexia R3', 225),
(2565, 'R2', 225),
(2686, 'R4', 225),
(2515, 'E10', 228),
(2668, 'G90', 232),
(2669, 'G80', 232),
(2677, 'MK2', 234),
(2695, 'Vintage', 238),
(2702, 'City', 239),
(2710, 'Qute', 240),
(2735, 'Haise', 242),
(2903, 'Air Concept', 245);

ALTER TABLE `car_models`
  ADD PRIMARY KEY (`model_id`), ADD UNIQUE KEY `model_make` (`model_id`,`make_id`);

ALTER TABLE `car_models`
  MODIFY `model_id` int(11) NOT NULL;