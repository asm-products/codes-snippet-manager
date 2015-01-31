-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 31, 2015 at 03:49 PM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `icanbetg_icanbeacoder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `icbac_labels`
--

CREATE TABLE `icbac_labels` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `label_name` text NOT NULL,
  `label_id` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1347 ;

-- --------------------------------------------------------

--
-- Table structure for table `icbac_thoughtcast`
--

CREATE TABLE `icbac_thoughtcast` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text,
  `title` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `status` int(3) NOT NULL DEFAULT '0',
  `priority` varchar(50) NOT NULL,
  `cast_type` varchar(128) NOT NULL,
  `category_id` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `date_added` text,
  `archive` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

-- --------------------------------------------------------

--
-- Table structure for table `icbac_users`
--

CREATE TABLE `icbac_users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `create_at` text NOT NULL,
  `lastvisit_at` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Table structure for table `icbac_user_meta`
--

CREATE TABLE `icbac_user_meta` (
`id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` longtext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `icbac_user_oauth`
--

CREATE TABLE `icbac_user_oauth` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `profile_cache` text,
  `session_data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `icbac_labels`
--
ALTER TABLE `icbac_labels`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icbac_thoughtcast`
--
ALTER TABLE `icbac_thoughtcast`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `icbac_users`
--
ALTER TABLE `icbac_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `status` (`status`), ADD KEY `superuser` (`superuser`);

--
-- Indexes for table `icbac_user_meta`
--
ALTER TABLE `icbac_user_meta`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icbac_user_oauth`
--
ALTER TABLE `icbac_user_oauth`
 ADD PRIMARY KEY (`provider`,`identifier`), ADD UNIQUE KEY `unic_user_id_name` (`user_id`,`provider`), ADD KEY `oauth_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `icbac_labels`
--
ALTER TABLE `icbac_labels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1347;
--
-- AUTO_INCREMENT for table `icbac_thoughtcast`
--
ALTER TABLE `icbac_thoughtcast`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `icbac_users`
--
ALTER TABLE `icbac_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=141;
--
-- AUTO_INCREMENT for table `icbac_user_meta`
--
ALTER TABLE `icbac_user_meta`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
