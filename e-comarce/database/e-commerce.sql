-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 05:22 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_bangla` varchar(100) NOT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_bangla`, `parent_name`, `status`) VALUES
(1, 'Sea Fish', 'সামুদ্রিক মাছ', '', 1),
(2, 'Kechhki', 'কাচকি', 'Sea Fish', 1),
(3, 'Rupchanda', 'রুপচাঁদা', 'Sea Fish', 1),
(5, 'Sweets', 'মিষ্টি', '', 1),
(7, 'Chomchom', 'চমচম', 'Sweets', 1),
(8, 'Soybean Oil', 'সয়াবিন তেল', '', 1),
(9, 'Bashundhara Fortified Soybean Oil', 'বসুন্ধরা ফর্টিফাইড সয়াবিন তেল', 'Soybean Oil', 1),
(10, 'Mustard Oil', 'সরিষার তেল', '', 1),
(11, 'Radhuni Pure Mustard Oil', 'রাঁধুনি খাটি সরিষার তেল', 'Mustard Oil', 1),
(12, 'Vegetable', 'শাকসবজি', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_setting`
--

CREATE TABLE `contact_setting` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `open_time` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_setting`
--

INSERT INTO `contact_setting` (`id`, `address`, `open_time`, `email`, `phone`, `facebook`, `twitter`, `linkedin`, `pinterest`, `instagram`, `youtube`, `status`) VALUES
(4, '60-49 Road 11378 New York', '10:00 am to 23:00 pm', 'rakibphp51278@gmail.com', '8458854759869', 'https://web.facebook.com/GSMArenacom-189627474421', 'https://twitter.com/gsmarena_com', 'https://www.facebook.com/A2758/', 'https://www.facebook.com/A2758/', 'https://www.facebook.com/A2758/', 'https://www.youtube.com/channel/UCbLq9tsbo8peV22VxbDAfXA?sub_confirmation=1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(8) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `zip` int(4) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `account` varchar(10) DEFAULT NULL,
  `account_number` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_id`, `name`, `phone`, `password`, `street`, `apartment`, `city`, `zip`, `email`, `account`, `account_number`, `status`) VALUES
(1, 'QUL7572', 'Arju Ahmed', '01716242571', '33b9c0bd5f27f6138b9ce78725a2d30ab860806600cf4b981bfca75df1a4a7d96664cf71d521be1b3abe9af6ca147f207dcd1ebf8953abb3be3b31d5de44f4c5', 'Elongi, Kumarkhali, Kushtia.', '', 'Kumarkhali', 7010, 'rakibphp512@gmail.com', 'Rocket', '01687986378', 1),
(2, 'QUL7838', 'Rakibul Islam', '01716243334', '33b9c0bd5f27f6138b9ce78725a2d30ab860806600cf4b981bfca75df1a4a7d96664cf71d521be1b3abe9af6ca147f207dcd1ebf8953abb3be3b31d5de44f4c5', 'Elongi, Kumarkhali, Kushtia.', '', 'Kumarkhali', 7010, 'rakibphp512@gmail.com', 'Bkash', '01687986378', 1),
(3, 'QUL86818', 'Jannatul Ferdous', '01994662423', '33b9c0bd5f27f6138b9ce78725a2d30ab860806600cf4b981bfca75df1a4a7d96664cf71d521be1b3abe9af6ca147f207dcd1ebf8953abb3be3b31d5de44f4c5', 'Kushtia Sadar,Kushtia.', '', 'Kushtia', 7010, 'rakibphp512@gmail.com', 'Nagad', '01365698514', 1);

-- --------------------------------------------------------

--
-- Table structure for table `footer_menus`
--

CREATE TABLE `footer_menus` (
  `id` int(11) NOT NULL,
  `menu_item_name` varchar(100) NOT NULL,
  `menu_item_bangla` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `footer_menus`
--

INSERT INTO `footer_menus` (`id`, `menu_item_name`, `menu_item_bangla`, `page_id`, `status`) VALUES
(2, 'About Us', 'আমাদের সম্পর্কে', 4, 1),
(3, 'About Our Shop', 'আমাদের দোকান সম্পর্কে', 15, 1),
(4, 'Delivery Information', 'ডেলিভারি তথ্য', 18, 1),
(5, 'Privacy Policy', 'গোপনীয়তা নীতি', 5, 1),
(6, 'Our Sitemap', 'আমাদের সাইটম্যাপ', 17, 1),
(7, 'Our Services', 'আমাদের সেবাসমূহ', 16, 1),
(8, 'Contact Us', 'যোগাযোগ করুন', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `header_text` text DEFAULT NULL,
  `footer_text` text NOT NULL,
  `logo` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `header_text`, `footer_text`, `logo`, `status`) VALUES
(3, 'Quality 100', '<p>Copyright &copy; 2020 Quality 100. All rights reserved. Dashboard by <a href=\"http://quality100.shop\">Quality 100.</a></p>\r\n', '46064.png', 0),
(6, 'Quality 100%', '<p>Copyright &copy; 2020 Quality 100. All rights reserved. Dashboard by <a href=\"http://quality100.shop\">Quality 100.</a></p>\r\n', '71738.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu_item_name` varchar(100) NOT NULL,
  `menu_item_bangla` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `menu_item_name`, `menu_item_bangla`, `page_id`, `status`) VALUES
(1, 'Home', 'হোম', 6, 1),
(3, 'Shop', 'সপ', 7, 1),
(4, 'About Us', 'আমাদের সম্পর্কে', 4, 1),
(5, 'Contact Us', 'যোগাযোগ করুন', 13, 1),
(6, 'Live', 'সরাসরি', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(30) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(30) NOT NULL,
  `page_description` longtext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_title`, `page_slug`, `page_description`, `status`) VALUES
(4, 'about', 'this about page', 'about.php', '', 1),
(5, 'privacy-policy', 'Privacy Policy Page', 'privacy-policy.php', '', 1),
(6, 'index', 'this is home page', 'index.php', '', 1),
(7, 'shop', 'this is shop page', 'shop.php', '', 1),
(10, 'shop-details', 'this is shop details page', 'shop-details .php', '', 1),
(11, 'shopping-cart', 'this is shopping cart page', 'shopping-cart.php', '', 1),
(12, 'checkout', 'this is checkout page', 'checkout.php', '', 1),
(13, 'contact', 'this is contact page', 'contact.php', '', 1),
(14, 'login-signup', 'login or signup ', 'login-signup.php', '<p>This is login signup page</p>\r\n', 1),
(15, 'about-our-shop', 'about our shop ', 'about-our-shop.php', '<p>This is about our shop page</p>\r\n', 1),
(16, 'our-services', 'our services', 'our-services.php', '<p>This is our services</p>\r\n', 1),
(17, 'our-sitemap', 'our sitemap ', 'our-sitemap.php', '<p>This is our sitemap page</p>\r\n', 1),
(18, 'delivery-information', 'this delivery information', 'delivery-information.php', '<p>this is&nbsp;delivery information</p>\r\n', 1),
(20, 'live', 'this is live page', 'live.php', '<p>this live page</p>\r\n', 1),
(21, 'profile', 'your profile', 'profile.php', '<p>your profile</p>\r\n', 1),
(22, 'your-orders', 'your order page', 'your-orders.php', '<p>your order page</p>\r\n', 1),
(23, 'payment-history', 'your payment history', 'payment-history.php', '<p>your payment history</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_name_b` varchar(100) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_price_b` varchar(11) NOT NULL,
  `dis_check` varchar(1) DEFAULT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `discount_price_b` varchar(11) DEFAULT NULL,
  `product_weight` int(11) NOT NULL,
  `product_weight_b` varchar(11) NOT NULL,
  `product_weight_type` varchar(10) NOT NULL,
  `product_image` varchar(15) NOT NULL,
  `product_dec` longtext NOT NULL,
  `product_dec_b` longtext NOT NULL,
  `product_short_dec` text NOT NULL,
  `product_short_dec_b` text NOT NULL,
  `product_info` longtext NOT NULL,
  `product_info_b` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `parent_name`, `product_name`, `product_name_b`, `product_category`, `product_price`, `product_price_b`, `dis_check`, `discount_price`, `discount_price_b`, `product_weight`, `product_weight_b`, `product_weight_type`, `product_image`, `product_dec`, `product_dec_b`, `product_short_dec`, `product_short_dec_b`, `product_info`, `product_info_b`, `status`) VALUES
(13, 'SeaFish53575', 'Sea Fish', 'Fresh Kechhki', 'ফ্রেশ কাচকি', 'Kechhki', 560, '৫৬০', '1', 20, '২০', 1, '১', 'Kg', '10807.jpg', '<p>Product Description</p>\r\n', '<p>পণ্য&nbsp;বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(14, 'SeaFish86441', 'Sea Fish', 'Fresh Rupchanda (4-5 pieces) 1kg', 'তাজা রূপচাঁদা (৪-৫ পিস) ১ কেজি', 'Rupchanda', 1200, '১২০০', '1', 20, '২০', 250, '২৫০', 'Gm', '77705.jpg', '<p>Product&nbsp;Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(15, 'Sweets86588', 'Sweets', 'Chomchom Sweets', 'চমচম মিষ্টি', 'Chomchom', 300, '৩০০', NULL, NULL, '', 100, '১০০', 'Gm', '69942.jpg', '<p>Product Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(16, 'SoybeanOil10640', 'Soybean Oil', 'Boshundhara Soyabean Oil 2 Liter', 'বসুন্ধরা সয়াবিন তেল 2 লিটার', 'Bashundhara Fortified Soybean Oil', 230, '২৩০', NULL, NULL, '', 2, '২', 'Litter', '90950.jpg', '<p>Product Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(17, 'MustardOil55595', 'Mustard Oil', 'Radhuni Mustard Oil (500 ml)', 'রাধুনি সরিষার তেল (500 মিলি)', 'Radhuni Pure Mustard Oil', 490, '৪৯০', NULL, NULL, '', 500, '500', 'Ml', '68895.jpg', '<p>Product Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information&nbsp;</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(18, 'SoybeanOil57738', 'Soybean Oil', 'Boshundhara Soyabean Oil 5 Liter', 'বসুন্ধরা সয়াবিন তেল ৫ লিটার', 'Bashundhara Fortified Soybean Oil', 580, '৫৮০', '1', 10, '১০', 5, '৫', 'Litter', '23675.jpg', '<p>Product Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information&nbsp;</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(19, 'Sweets39211', 'Sweets', 'Tangail Chomchom', 'টাঙ্গাইল চমচম', 'Chomchom', 300, '৩০০', '1', 20, '২০', 1, '১', 'Kg', '3988.jpg', '<p>Product Description</p>\r\n', '<p>পণ্যের বর্ণনা</p>\r\n', '<p>Product Short Description</p>\r\n', '<p>পণ্য সংক্ষিপ্ত বিবরণ</p>\r\n', '<p>Product Information&nbsp;</p>\r\n', '<p>পণ্যের তথ্য</p>\r\n', 1),
(20, 'MustardOil41296', 'Mustard Oil', 'Radhuni Mustard Oil (250 ml)', 'রাধুনি সরিষার তেল (250 মিলি)', 'Radhuni Pure Mustard Oil', 90, '৯০', '1', 10, '১০', 250, '২৫০', 'Ml', '91297.jpg', '<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.&nbsp;</p>\r\n', '<p>আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন। প্যালেঞ্জেস্ক আইডি বা পোর্টাল ডেপিবাসের মধ্যে রয়েছে। প্রোটেন ইজেট নির্যাতনকারী ভিভামাস সাসকিপিট টর্চার ইজ ফেলিস পোর্টেটিটার ভলুটপাট। আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন।</p>\r\n', '<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.&nbsp;</p>\r\n', '<p>আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন। প্যালেঞ্জেস্ক আইডি বা পোর্টাল ডেপিবাসের মধ্যে রয়েছে। প্রোটেন ইজেট নির্যাতনকারী ভিভামাস সাসকিপিট টর্চার ইজ ফেলিস পোর্টেটিটার ভলুটপাট। আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন।</p>\r\n', '<p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.&nbsp;</p>\r\n', '<p>আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন। প্যালেঞ্জেস্ক আইডি বা পোর্টাল ডেপিবাসের মধ্যে রয়েছে। প্রোটেন ইজেট নির্যাতনকারী ভিভামাস সাসকিপিট টর্চার ইজ ফেলিস পোর্টেটিটার ভলুটপাট। আপনি যদি এটি করতে চান তবে আপনি কতটা যানবাহন ব্যবহার করতে পারবেন।</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `name_bangla` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `title_bangla` varchar(30) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `image` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `name_bangla`, `title`, `title_bangla`, `facebook`, `twitter`, `linkedin`, `pinterest`, `image`, `status`) VALUES
(1, 'Arju Ahamed', 'আরজু আহমেদ', 'Founder / CEO', 'ফাউন্ডার / সিইও', 'https://www.facebook.com/A2758/', 'https://twitter.com/', 'https://www.facebook.com/A2758/', 'https://www.facebook.com', '10314.jpg', 1),
(2, 'Rakibul Islam', 'রাকিবুল ইসলাম', 'Web Developer', 'ওয়েব ডেভেলপার', 'https://www.facebook.com/A2758/', 'https://twitter.com/', 'https://www.facebook.com/A2758/', 'https://www.facebook.com', '11358.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ui_elements`
--

CREATE TABLE `ui_elements` (
  `id` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_title_bangla` varchar(255) NOT NULL,
  `banner_desc` varchar(255) NOT NULL,
  `banner_desc_bangla` varchar(255) NOT NULL,
  `header_banner` varchar(15) NOT NULL,
  `footer_banner_1` varchar(15) DEFAULT NULL,
  `footer_banner_2` varchar(15) DEFAULT NULL,
  `header_text` longtext DEFAULT NULL,
  `header_text_b` longtext DEFAULT NULL,
  `footer_text` longtext DEFAULT NULL,
  `footer_text_b` longtext DEFAULT NULL,
  `image` varchar(15) NOT NULL,
  `page_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ui_elements`
--

INSERT INTO `ui_elements` (`id`, `banner_title`, `banner_title_bangla`, `banner_desc`, `banner_desc_bangla`, `header_banner`, `footer_banner_1`, `footer_banner_2`, `header_text`, `header_text_b`, `footer_text`, `footer_text_b`, `image`, `page_id`, `status`) VALUES
(11, 'Sea Fish', 'সামুদ্রিক মাছ', 'Fish 100% </br> Quality Fresh\r\n', 'মাছ ১০০% </br> কোয়ালিটি ফ্রেশ', '57887.jpg', '24657.jpg', '73100.jpeg', '', '', '', '', '17929.jpg', 6, 1),
(12, 'Quality 100 Shop', 'গুণমান 100 দোকান', 'Quality 100% Shop', 'গুণমান 100% দোকান', '76002.jpg', '81386.jpg', '1662.jpg', '', '', '', '', '44840.jpg', 7, 1),
(13, 'About Us', 'আমাদের সম্পর্কে', 'About Us', 'আমাদের সম্পর্কে', '58343.jpg', '72126.jpeg', '31381.jpg', '<p>About Us Header Text</p>\r\n', '<p>আমাদের শিরোনাম পাঠ্য</p>\r\n', '<p>About Us Footer&nbsp;Text</p>\r\n', '<p>আমাদের সম্পর্কে পাদলেখ পাঠ্য</p>\r\n', '66902.jpg', 4, 1),
(14, 'Contact Us', 'যোগাযোগ করুন', 'Contact Us', 'যোগাযোগ করুন', '60926.jpeg', '67223.jpg', '85052.jpg', '', '', '', '', '56147.jpg', 13, 1),
(15, 'About Our Shop', 'আমাদের দোকান সম্পর্কে', 'About Our Shop', 'আমাদের দোকান সম্পর্কে', '92886.jpg', '91236.jpg', '94820.jpg', '<p>Header Text About Our Shop&nbsp;</p>\r\n', '<p>আমাদের দোকান সম্পর্কে শিরোনাম পাঠ্য</p>\r\n', '<p>Footer Text About Our Shop&nbsp;</p>\r\n', '<p>আমাদের দোকান সম্পর্কে পাদলেখ পাঠ্য</p>\r\n', '1446.jpg', 15, 1),
(16, 'Privacy Policy', 'গোপনীয়তা নীতি', 'Privacy Policy', 'গোপনীয়তা নীতি', '27571.jpeg', '81649.jpg', '98612.jpg', '<p>Our Privacy Policy</p>\r\n', '<p>আমাদের গোপনীয়তা নীতি</p>\r\n', '<p>Our Privacy Policy</p>\r\n', '<p>আমাদের গোপনীয়তা নীতি</p>\r\n', '50009.jpg', 5, 1),
(17, 'Our Sitemap', 'আমাদের সাইটম্যাপ', 'Our Sitemap', 'আমাদের সাইটম্যাপ', '92095.jpg', '4992.jpg', '8215.jpg', '', '', '', '', '66504.jpg', 17, 1),
(18, 'Delivery Information', 'ডেলিভারি তথ্য', 'Delivery Information', 'ডেলিভারি তথ্য', '3635.jpeg', '35864.jpg', '73548.jpg', '', '', '', '', '44134.jpg', 18, 1),
(19, 'Login or Signup', 'লগিন করো অথবা সাইন আপ করুন', 'Login or Signup', 'লগিন করো অথবা সাইন আপ করুন', '90057.jpg', '33563.jpg', '5214.jpg', '', '', '', '', '23739.jpg', 14, 1),
(20, 'Shopping Cart', 'বাজারের ব্যাগ', 'Shopping Cart', 'বাজারের ব্যাগ', '66270.jpg', '79008.jpg', '93814.jpg', '', '', '', '', '60241.jpg', 11, 1),
(21, 'Checkout', 'চেকআউট', 'Checkout', 'চেকআউট', '99423.jpg', '56962.jpeg', '43011.jpg', '', '', '', '', '96013.jpg', 12, 1),
(22, 'Quality 100% Live', 'গুণমান 100% লাইভ', 'Quality 100% Live', 'গুণমান 100% লাইভ', '5052.jpg', '79491.jpg', '88744.jpg', '', '', '', '', '89649.jpg', 20, 1),
(23, 'Profile', 'প্রোফাইল', 'Profile', 'প্রোফাইল', '87550.jpeg', '47640.jpg', '17942.jpg', '', '', '', '', '64065.jpg', 21, 1),
(24, 'Your Orders', 'আপনার অর্ডারগুলো', 'Your Orders', 'আপনার অর্ডারগুলো', '82090.jpeg', '94535.jpg', '41226.jpg', '', '', '', '', '95411.jpg', 22, 1),
(25, 'Payment Histories', 'অর্থ প্রদানের তথ্য', 'Payment Histories', 'অর্থ প্রদানের তথ্য', '14644.jpg', '86220.jpg', '49154.jpg', '', '', '', '', '89654.jpg', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `type` varchar(30) NOT NULL,
  `image` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `type`, `image`, `status`) VALUES
(6, 'Rakibul Islam', 'rakibphp512@gmail.com', '33b9c0bd5f27f6138b9ce78725a2d30ab860806600cf4b981bfca75df1a4a7d96664cf71d521be1b3abe9af6ca147f207dcd1ebf8953abb3be3b31d5de44f4c5', 'Administrator', '64416.jpg', 1),
(7, 'Arju Ahamed', 'arjuraj@gmail.com', 'f687bc049524e2a83f0643c464da1f087f6bda1f86615fc2f4af795728a769701c6614a1d049f38593ed35c8feef374820d2af116e1e28ee680176c7a0acd5d2', 'Editor', '10476.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_title_b` varchar(255) NOT NULL,
  `video_thumbnail` varchar(15) NOT NULL,
  `video` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `video_title`, `video_title_b`, `video_thumbnail`, `video`, `status`) VALUES
(3, 'Fresh', 'তাজা মাছ', '92844.jpg', '32564.mp4', 1),
(4, 'Fresh Fish', 'তাজা মাছ', '52393.jpg', '99949.mp4', 1),
(5, 'Fresh Sea Fish', 'টাটকা সমুদ্রের মাছ', '77368.jpg', '12160.mp4', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_setting`
--
ALTER TABLE `contact_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer_menus`
--
ALTER TABLE `footer_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ui_elements`
--
ALTER TABLE `ui_elements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_setting`
--
ALTER TABLE `contact_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `footer_menus`
--
ALTER TABLE `footer_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ui_elements`
--
ALTER TABLE `ui_elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
