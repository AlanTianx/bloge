CREATE TABLE `blog_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) DEFAULT '' COMMENT '//文章标题',
  `article_tag` varchar(100) DEFAULT '',
  `article_description` varchar(255) DEFAULT '',
  `article_thumb` varchar(255) DEFAULT NULL,
  `article_content` text,
  `article_time` int(11) DEFAULT NULL,
  `article_editor` varchar(50) DEFAULT '',
  `article_view` int(11) DEFAULT '0',
  `cate_id` int(11) DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE `blog_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) DEFAULT '' COMMENT '分类名称',
  `cate_title` varchar(255) DEFAULT '' COMMENT '分类说明',
  `cate_keywords` varchar(255) DEFAULT '' COMMENT '关键词',
  `cate_description` varchar(255) DEFAULT '' COMMENT '描述',
  `cate_view` int(10) DEFAULT '0' COMMENT '查看次数',
  `cate_order` tinyint(4) DEFAULT '0' COMMENT '排序',
  `cate_pid` int(11) DEFAULT '0' COMMENT '父级ID',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章分类';

CREATE TABLE `blog_config` (
  `conf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) DEFAULT '' COMMENT '//配置标题',
  `conf_name` varchar(50) DEFAULT '' COMMENT '//配置项名字',
  `conf_content` text COMMENT '//配置项内容',
  `conf_order` int(11) DEFAULT '0',
  `conf_tips` varchar(255) DEFAULT '' COMMENT '//配置项说明',
  `field_type` varchar(50) DEFAULT '' COMMENT '//字段类型',
  `field_value` varchar(255) DEFAULT '' COMMENT '//字段值',
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `blog_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '//名称',
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '//url地址',
  `link_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '//标题',
  `link_order` int(11) NOT NULL DEFAULT '0' COMMENT '//排序',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blog_navs` (
  `nav_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(50) DEFAULT '',
  `nav_alias` varchar(50) DEFAULT '',
  `nav_url` varchar(255) DEFAULT '',
  `nav_order` int(11) DEFAULT '0',
  PRIMARY KEY (`nav_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `user_pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `blog_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

