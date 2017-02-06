CREATE TABLE IF NOT EXISTS `commentikis` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`parent_id` int(10) NOT NULL DEFAULT "0",
`name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`created_at` datetime DEFAULT NULL,
`updated_at` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_general_ci AUTO_INCREMENT=1;