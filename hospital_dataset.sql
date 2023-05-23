-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: 23 مايو 2023 الساعة 21:26
-- إصدار الخادم: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_dataset`
--

-- --------------------------------------------------------

--
-- بنية الجدول `applicationstatus`
--

CREATE TABLE `applicationstatus` (
  `id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `applicationstatus`
--

INSERT INTO `applicationstatus` (`id`, `status`) VALUES
('0000', 'accepted'),
('0001', 'declined'),
('0002', 'under consideration');

-- --------------------------------------------------------

--
-- بنية الجدول `homeowner`
--

CREATE TABLE `homeowner` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `homeowner`
--

INSERT INTO `homeowner` (`id`, `name`, `phone_number`, `email_address`, `password`) VALUES
('0000', 'Sarah Ahmad', '0501800021', 'SarahAhmad@gmail.com', '$2y$10$B7LmHI9gRDuB3dk6g0w.ie3lWWERrpsMKwCWeRk/17bN.7GXCulGW'),
('0001', 'Leena Mohammed', '0505198512', 'LeenaMohammed@gmail.com', '$2y$10$/OhVAtb5.5vrnXtOFYzuquHgQaIvQH5lS6626tUCFsn6kchyJQEuq'),
('0002', 'Ahmad Fahad', '0561947002', 'AhmadFahad@gmail.com', '$2y$10$4c1Yfg7O1sDLlBrqEFJNi.1nL8lk2l8t5wMLD8p2ZpFdhbSdCptei');

-- --------------------------------------------------------

--
-- بنية الجدول `homeseeker`
--

CREATE TABLE `homeseeker` (
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `family_member` int(11) NOT NULL,
  `income` float NOT NULL,
  `job` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `homeseeker`
--

INSERT INTO `homeseeker` (`id`, `first_name`, `last_name`, `age`, `family_member`, `income`, `job`, `phone_number`, `email_address`, `password`) VALUES
('111', 'Reem', 'Abdulaziz', 32, 5, 25000, 'Doctor', '0501812325', 'ReemAbdulaziz@gmail.com', '$2y$10$9DucD17pf0b1v9piU2UMOuWoHC.7g7MBpQrhK9Xj94WUi6wFM85t.'),
('112', 'Saleh', 'Riyadh', 45, 9, 45000, 'Engineer', '0554515932', 'Saleh1@gmail.com', '$2y$10$0Mo2AAJWVbXSeXpKAgqbjeH3bICrt/9GjrGFgjxxJ5uS/BkXbDCSi'),
('113', 'Abdulilah', 'Abdullah', 58, 7, 50000, 'software developer', '0555587643', 'abdulilah1@gmail.com', '$2y$10$fxhpokspto66ZsNZPYxcMO09CYKn41AeFazoEh73Ez.1AtlsRHT7y'),
('646d0af765124', 'EMTENAN', 'ALGHAMDI', 32, 6, 25000, 'Doctor', '0558272754', 'emtenan.ag@gmail.com', '$2y$10$F5lwUMOWm2NQqrEZ1vbD6usRdYHDgqzPV7dmXhgHeQT1pvF8d8gVm');

-- --------------------------------------------------------

--
-- بنية الجدول `property`
--

CREATE TABLE `property` (
  `id` varchar(255) NOT NULL,
  `homeowner_id` varchar(255) NOT NULL,
  `property_category_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rooms` int(255) NOT NULL,
  `rent_cost` float NOT NULL,
  `location` text NOT NULL,
  `max_tenants` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `property`
--

INSERT INTO `property` (`id`, `homeowner_id`, `property_category_id`, `name`, `rooms`, `rent_cost`, `location`, `max_tenants`, `description`) VALUES
('1234', '0000', '13241', 'Holiday Villa', 8, 8000, 'Riyadh,Al-Aqeeq District', 30, 'Holiday Villa Hail  in Riyadh has 4-star accommodation with a terrace and a restaurant. The property is situated 6.5 km from Riyadh Stadium, 7.1 km from Aerf Castle and 8.3 km from Riyadh University. The accommodation features a 24-hour front desk, airport transfers, room service and free WiFi.'),
('1235', '0001', '13242', 'Home Plaza', 4, 2500, 'Riyadh,Al-Naries District', 20, 'Home Plaza is located 400 m from Al Hayat Mall. It offers self-catering accommodation, free Wi-Fi and a 24-hour front desk.\r\nAir-conditioned units at Home Plaza feature a flat-screen satellite TV. Each apartment has a living room and a fully equipped kitchen. Featuring a shower, private bathrooms also come with a bath.\r\n\r\nThis is our guests\' favourite part of Al Riyadh, according to independent reviews.\r\n\r\nCouples particularly like the location — they rated it 8.2 for a two-person trip.'),
('1236', '0002', '13242', 'Braira Hettin Hotel', 4, 1000, 'Riyadh,Al-Hettin District', 10, 'et 5 km from DIR\\x92IYYAH, Braira Hettin Hotel & Resort is a sustainable 5-star accommodation in Riyadh, featuring an outdoor swimming pool, a fitness centre and private parking. Among the facilities of this property are a restaurant, a 24-hour front desk and full-day security, along with free WiFi throughout the property. Boasting family rooms, this property also provides guests with an outdoor fireplace.\r\nThe units at the villa complex come with air conditioning, a seating area, a flat-screen TV with satellite channels, a kitchenette, a dining area, a safety deposit box and a private bathroom with a walk-in shower, bathrobes and slippers. Some units feature a terrace and/or a balcony with pool views and an outdoor dining area. At the villa complex, the units are fitted with bed linen and towels.\r\n\r\nBuffet and à la carte breakfast options with fresh pastries, fruits and juice are available every morning at the villa. There is a coffee shop and lounge.\r\n\r\nGuests can also relax in the garden.\r\n\r\nRiyadh Park is 6.3 km from Braira Hettin Hotel & Resort فندق و منتجع بريرا حطين, while Riyadh Gallery Mall is 10 km away. The nearest airport is King Khalid International Airport, 32 km from the accommodation.\r\n\r\nCouples particularly like the location — they rated it 9.1 for a two-person trip.');

-- --------------------------------------------------------

--
-- بنية الجدول `propertycategory`
--

CREATE TABLE `propertycategory` (
  `id` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `propertycategory`
--

INSERT INTO `propertycategory` (`id`, `category`) VALUES
('13242', 'Apartment'),
('13241', 'villa');

-- --------------------------------------------------------

--
-- بنية الجدول `propertyimage`
--

CREATE TABLE `propertyimage` (
  `id` varchar(255) NOT NULL,
  `property_id` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `propertyimage`
--

INSERT INTO `propertyimage` (`id`, `property_id`, `path`) VALUES
('1', '1234', 'img/appa.png'),
('2', '1235', 'img/appa.jpeg'),
('646c743d36', '1234', './img/2e6ee6d46c0b1a91ad6c7be02b454a66.jpg'),
('646d09e041', '1234', './img/a1bd8c1d9e4f0d931d1a6ef541a3c90c.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `rentalapplication`
--

CREATE TABLE `rentalapplication` (
  `id` varchar(255) NOT NULL,
  `property_id` varchar(255) NOT NULL,
  `home_seeker_id` varchar(255) NOT NULL,
  `application_status_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `rentalapplication`
--

INSERT INTO `rentalapplication` (`id`, `property_id`, `home_seeker_id`, `application_status_id`) VALUES
('ra000', '1234', '111', '0000'),
('ra001', '1235', '112', '0001'),
('ra002', '1236', '113', '0002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicationstatus`
--
ALTER TABLE `applicationstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeowner`
--
ALTER TABLE `homeowner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeseeker`
--
ALTER TABLE `homeseeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homeowner_id` (`homeowner_id`),
  ADD KEY `property_category_id` (`property_category_id`);

--
-- Indexes for table `propertycategory`
--
ALTER TABLE `propertycategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `propertyimage`
--
ALTER TABLE `propertyimage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `rentalapplication`
--
ALTER TABLE `rentalapplication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_status_id` (`application_status_id`),
  ADD KEY `home_seeker_id` (`home_seeker_id`),
  ADD KEY `property_id` (`property_id`);

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`homeowner_id`) REFERENCES `homeowner` (`id`),
  ADD CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_category_id`) REFERENCES `propertycategory` (`id`);

--
-- القيود للجدول `propertyimage`
--
ALTER TABLE `propertyimage`
  ADD CONSTRAINT `propertyimage_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);

--
-- القيود للجدول `rentalapplication`
--
ALTER TABLE `rentalapplication`
  ADD CONSTRAINT `rentalapplication_ibfk_1` FOREIGN KEY (`application_status_id`) REFERENCES `applicationstatus` (`id`),
  ADD CONSTRAINT `rentalapplication_ibfk_2` FOREIGN KEY (`home_seeker_id`) REFERENCES `homeseeker` (`id`),
  ADD CONSTRAINT `rentalapplication_ibfk_3` FOREIGN KEY (`property_id`) REFERENCES `property` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
