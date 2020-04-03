-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 03, 2020 at 01:35 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `phpbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `buddychat`
--

CREATE TABLE `buddychat` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `created_chat_id` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_chat_id` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buddychat`
--
ALTER TABLE `buddychat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buddychat`
--
ALTER TABLE `buddychat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
