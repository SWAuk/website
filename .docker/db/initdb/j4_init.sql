-- SQL added here will be installed to the "defaultdb" databases on db container startup
-- Adminer 4.7.1 MySQL dump
START TRANSACTION;

INSERT INTO `swana_content` (`id`, `asset_id`, `title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`,
							 `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`,
							 `checked_out_time`,
							 `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`,
							 `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `note`)
VALUES (1, 63, 'Lorem Ipsum', 'lorem-ipsum',
		'<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eget egestas velit, sed placerat odio. Suspendisse at leo nec magna scelerisque sodales et vestibulum ligula. Donec eget velit laoreet, dictum quam vel, sagittis felis. Sed ornare ipsum quis dolor tempus, nec egestas ex molestie. Suspendisse enim odio, posuere quis volutpat sit amet, cursus sed nunc. Quisque feugiat turpis nunc, at mattis odio tincidunt sed. In hac habitasse platea dictumst. Sed luctus lobortis tortor et semper.</p>\r\n<p>Mauris vitae hendrerit nisl, ut semper orci. Nullam hendrerit congue consectetur. Donec pharetra ultrices sapien et varius. Nulla id orci finibus, aliquet mauris sed, dignissim nisl. Sed congue eu mi quis venenatis. Curabitur in pulvinar dolor. Sed varius aliquam erat non rutrum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras fringilla viverra dictum.</p>\r\n<p>Morbi pulvinar massa id lacus bibendum blandit. Nam eget massa tempus, sollicitudin diam quis, interdum magna. Suspendisse pretium orci lacinia tortor tincidunt sodales. Aliquam a eros mollis, eleifend libero ut, porttitor erat. Donec quis velit nec justo interdum efficitur. Nulla tristique venenatis magna nec lacinia. Duis ultrices, mi eget aliquam commodo, purus diam sodales libero, a euismod nisl tortor et neque. Nulla nisi lacus, volutpat sit amet diam nec, fringilla malesuada nibh. Donec vehicula pulvinar lacus ut rhoncus. Morbi eget velit semper lacus convallis sollicitudin sit amet ut velit. Duis luctus augue ac est maximus faucibus. Aenean vel pharetra enim.</p>\r\n<p>Nunc vel pellentesque ante, ut sagittis lectus. Aenean et vehicula nisi. In hac habitasse platea dictumst. Quisque a aliquet quam, a vulputate nisl. Aenean non tincidunt ipsum. Nulla arcu turpis, consectetur a cursus sed, scelerisque ut quam. Ut id ipsum vel nisi tincidunt commodo ac eget nisl. Aenean leo neque, suscipit vel sem sit amet, molestie pharetra tellus. Nunc dictum turpis sed risus cursus, mollis dignissim diam vulputate. Aenean tristique nunc nunc, eu consectetur nunc rutrum ut. Phasellus lacinia libero dui, a dignissim nisi dapibus at.</p>\r\n<p>Aliquam hendrerit rutrum massa et aliquet. Phasellus elementum pellentesque est, ut congue erat porttitor quis. Phasellus ante risus, tincidunt congue maximus non, efficitur nec eros. Sed nec viverra ligula, at interdum massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse non sagittis massa. Vivamus sed eros efficitur, pulvinar lectus vitae, ultricies lorem. Phasellus vel arcu luctus, vehicula nunc eget, rutrum tortor. Cras id orci urna. Nam sit amet felis quis lacus pulvinar pharetra sed quis tortor. Aliquam eget mollis erat. Cras dignissim gravida varius. Cras malesuada tincidunt fermentum. Quisque vel massa blandit odio vehicula mattis vitae id elit.</p>\r\n</div>',
		'', 1, 2, '2019-02-10 17:01:25', 421, '', '2019-02-10 17:01:25', 0, 0, '0000-00-00 00:00:00',
		'2019-02-10 17:01:25', '0000-00-00 00:00:00',
		'{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}',
		'{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}',
		'{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',
		1, 1, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 1, '*', ''),
	   (2, 64, 'Duis id accumsan risus', 'duis-id-accumsan-risus',
		'<p>Duis id accumsan risus. Vestibulum augue nisi, semper vitae lacus nec, volutpat posuere lectus. Vivamus ut nisi bibendum, pellentesque massa ut, semper sem. Vestibulum placerat finibus erat, vehicula condimentum enim. Suspendisse volutpat risus sed nibh rutrum rutrum eleifend sit amet nisi. Vestibulum risus lorem, condimentum et vehicula id, tincidunt vitae neque. Praesent malesuada elementum tortor quis ultrices. Aliquam sit amet orci lectus. Donec pellentesque semper suscipit. Ut eget magna ultricies, luctus velit nec, semper est. Nam consequat sit amet mi eleifend scelerisque. Mauris non ante vitae lorem sodales fermentum eget a arcu. Nullam consectetur felis arcu, ut iaculis magna aliquam vel. Aenean vestibulum placerat congue.</p>\r\n<p>Phasellus turpis augue, scelerisque consequat dolor eu, rhoncus venenatis nisi. Quisque dictum interdum commodo. Sed cursus nulla ac porta consectetur. Nullam vel nisi cursus, mattis odio ac, condimentum orci. Vivamus dapibus nisl eget nisi efficitur dignissim. Maecenas viverra, velit ac lacinia dignissim, enim mi viverra turpis, quis bibendum est ex vel elit. Ut elementum, est quis ultrices dignissim, arcu mauris eleifend metus, sit amet egestas sem magna in nisi. Sed imperdiet diam vitae dignissim condimentum. Pellentesque mollis, massa et mollis egestas, turpis mauris varius augue, eget ultrices mauris justo sagittis tortor. Integer sed tempus dui. Phasellus viverra efficitur justo, quis hendrerit magna pulvinar in.</p>\r\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam non pretium eros. Aliquam sapien odio, dapibus eu lacinia quis, faucibus in tellus. Donec porttitor mi eget massa interdum, nec suscipit elit pharetra. Donec tincidunt eros quis dignissim feugiat. Quisque rhoncus convallis purus sed varius. Aliquam scelerisque quam quis leo aliquam, nec interdum ligula consequat.</p>\r\n<p>Curabitur quis felis feugiat, mollis elit quis, maximus leo. Aenean sed facilisis risus. Integer ac ornare justo. Nunc hendrerit velit ac massa imperdiet pellentesque. Nulla facilisi. Sed sed diam id metus ultricies lobortis. Donec tellus dolor, congue in nunc eget, luctus pulvinar turpis. Nullam at gravida diam. Nullam sapien lacus, varius vel malesuada ac, commodo id nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla facilisi. Aenean ullamcorper eu sem nec ultricies. Donec consectetur ultricies nulla, sed tempus nisi interdum at.</p>\r\n<p>Vestibulum tincidunt sem nec enim pharetra efficitur sit amet in lectus. Etiam pretium risus leo. In euismod erat ex, a efficitur elit tristique quis. Duis pharetra enim mauris, eu ultricies quam maximus a. Curabitur in vulputate velit, at vestibulum ligula. Nam placerat mi vitae purus eleifend, at viverra libero tempus. Fusce elementum sollicitudin tortor, sed consequat odio porttitor ac. Duis vulputate commodo sapien, non condimentum nibh consectetur vel.</p>',
		'', 1, 2, '2019-02-10 17:03:51', 421, '', '2019-02-10 17:03:51', 0, 0, '0000-00-00 00:00:00',
		'2019-02-10 17:03:51', '0000-00-00 00:00:00',
		'{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}',
		'{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}',
		'{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',
		1, 0, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', ''),
	   (3, 67, 'Sponsors Page New', 'sponsorsnew', '<p>non condimentum nibh consectetur vel.</p>', '', 1, 2,
		'2021-12-04 17:03:51', 421, '', '2021-12-04 17:03:51', 0, 0, '0000-00-00 00:00:00', '2021-12-04 17:03:51',
		'0000-00-00 00:00:00',
		'{\"image_intro\":\"\",\"float_intro\":\"\",\"image_intro_alt\":\"\",\"image_intro_caption\":\"\",\"image_fulltext\":\"\",\"float_fulltext\":\"\",\"image_fulltext_alt\":\"\",\"image_fulltext_caption\":\"\"}',
		'{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}',
		'{\"article_layout\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_tags\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_vote\":\"\",\"show_hits\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"alternative_readmore\":\"\",\"article_page_title\":\"\",\"show_publishing_options\":\"\",\"show_article_options\":\"\",\"show_urls_images_backend\":\"\",\"show_urls_images_frontend\":\"\"}',
		1, 0, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', '');



INSERT INTO `swana_extensions` (`extension_id`, `package_id`, `name`, `type`, `element`, `changelogurl`, `folder`,
								`client_id`, `enabled`, `access`, `protected`, `locked`, `manifest_cache`, `params`,
								`custom_data`, `checked_out`, `checked_out_time`, `ordering`, `state`, `note`)
VALUES (232, 0, 'com_swa', 'component', 'com_swa', '', '', 1, 1, 0, 0, 0,
		'{\"name\":\"com_swa\",\"type\":\"component\",\"creationDate\":\"July 2014\",\"author\":\"SWA Tech Team\",\"copyright\":\"Copyright (C) 2022. All rights reserved.\",\"authorEmail\":\"\",\"authorUrl\":\"https:\\/\\/studentwindsurfing.co.uk\",\"version\":\"0.1\",\"description\":\"Component for the Student Windsurfing Association website\",\"group\":\"\",\"namespace\":\"SwaUK\\\\Component\\\\Swa\",\"filename\":\"swa\"}',
		'{}', '', NULL, NULL, 0, 0, NULL),
	   (233, 0, 'plg_swa_afterlogin', 'plugin', 'afterlogin', '', 'swa', 0, 0, 1, 0, 0,
		'{\"name\":\"plg_swa_afterlogin\",\"type\":\"plugin\",\"creationDate\":\"May 2021\",\"author\":\"Oscar Lindenbaum\",\"copyright\":\"Copyright (C) 2022 Open Source Matters. All rights reserved.\",\"authorEmail\":\"\",\"authorUrl\":\"\",\"version\":\"0.0.2\",\"description\":\"Plugin to run functions after user auth.\",\"group\":\"\",\"filename\":\"afterlogin\"}',
		'{}', '', NULL, NULL, 0, 0, NULL),
	   (234, 0, 'Favourite', 'template', 'favourite', '', '', 0, 1, 1, 0, 0,
		'{\"name\":\"Favourite\",\"type\":\"template\",\"creationDate\":\"2012\",\"author\":\"FavThemes\",\"copyright\":\"Copyright (C) 2012-2017 FavThemes. All rights reserved.\",\"authorEmail\":\"hello@favthemes.com\",\"authorUrl\":\"https:\\/\\/www.favthemes.com\",\"version\":\"4.1\",\"description\":\"\\n\\n<p style=\\\"max-width: 900px; margin-bottom: 21px; text-align: justify;\\\"><strong>Favourite<\\/strong> is a free responsive Joomla! template with 200+ settings for an easy and fast customization, using Bootstrap 3, HTML5, CSS3, Google Fonts and Font Awesome. Design amazing responsive websites with this smart template that adapts and resizes itself to desktop and mobile devices, making your website looking great for everyone!\\n\\n<\\/br><\\/br>\\n\\nThis free template can be used on unlimited personal or commercial websites, just don\'t resell it! Once you ordered and downloaded the template from our store, you have free and unlimited access to all future Joomla! versions of the product.<\\/p>\\n\\n<a href=\\\"http:\\/\\/demo.favthemes.com\\/favourite\\/\\\" class=\\\"btn btn-success\\\" target=\\\"_blank\\\">Demo<\\/a>\\n\\n<a href=\\\"http:\\/\\/www.favthemes.com\\/docs\\\" class=\\\"btn btn-info\\\" target=\\\"_blank\\\">Documentation<\\/a>\\n\\n<\\/br><\\/br>\\n\\n<a href=\\\"http:\\/\\/demo.favthemes.com\\/favourite\\/\\\" target=\\\"_blank\\\">\\n  <img class=\\\"fav-admin-img\\\" style=\\\"padding: 4px; border: 1px solid #DDD; border-radius: 4px;\\\" src=\\\"..\\/templates\\/favourite\\/template_preview.png\\\" alt=\\\"Favourite Responsive Template\\\">\\n<\\/a>\\n\\n<\\/br><\\/br>\\nCopyright &#169; 2012-2017 <a href=\\\"https:\\/\\/www.favthemes.com\\\" target=\\\"_blank\\\" style=\\\"font-weight: bold;\\\">FavThemes<\\/a>.\\n<\\/br><\\/br>\\n\\n<link rel=\\\"stylesheet\\\" href=\\\"..\\/templates\\/favourite\\/admin\\/admin.css\\\" type=\\\"text\\/css\\\" \\/>\\n<link rel=\\\"stylesheet\\\" href=\\\"\\/\\/maxcdn.bootstrapcdn.com\\/font-awesome\\/4.7.0\\/css\\/font-awesome.min.css\\\" type=\\\"text\\/css\\\" \\/>\\n<link rel=\\\"stylesheet\\\" href=\\\"\\/\\/fonts.googleapis.com\\/css?family=Open+Sans\\\" type=\\\"text\\/css\\\" \\/>\\n<script src=\\\"..\\/templates\\/favourite\\/admin\\/jscolor\\/jscolor.js\\\" type=\\\"text\\/javascript\\\"><\\/script>\\n\\n\",\"group\":\"\",\"filename\":\"templateDetails\"}',
        '{\"template_styles\":\"style1\",\"custom_style\":\"\",\"max_width\":\"\",\"show_copyright\":\"1\",\"copyright_text\":\"FavThemes\",\"copyright_text_link\":\"www.favthemes.com\",\"nav_link_padding\":\"\",\"nav_font_size\":\"\",\"nav_text_transform\":\"uppercase\",\"nav_icons_color\":\"\",\"nav_icons_font_size\":\"\",\"nav_google_font\":\"Lato\",\"nav_google_font_weight\":\"700\",\"nav_google_font_style\":\"normal\",\"titles_font_size\":\"\",\"titles_line_height\":\"\",\"titles_text_align\":\"left\",\"titles_text_transform\":\"uppercase\",\"module_title_icon_font_size\":\"\",\"module_title_icon_padding\":\"\",\"module_title_icon_border_radius\":\"\",\"titles_google_font\":\"Lato\",\"titles_google_font_weight\":\"700\",\"titles_google_font_style\":\"normal\",\"error_page_article_id\":\"3\",\"offline_page_style\":\"offline-light\",\"offline_page_bg_image_style\":\"no-repeat; background-attachment: fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;\",\"show_back_to_top\":\"1\",\"back_to_top_style_color\":\"\",\"back_to_top_text\":\"Back to Top\",\"body_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"body_bg_image_overlay\":\"fav-transparent\",\"body_bg_color\":\"\",\"body_color\":\"\",\"body_title_color\":\"\",\"body_link_color\":\"\",\"body_link_hover_color\":\"\",\"notice_bg_style\":\"fav-module-block-color\",\"notice_bg_color\":\"\",\"notice_color\":\"\",\"notice_title_color\":\"\",\"notice_link_color\":\"\",\"notice_link_hover_color\":\"\",\"topbar_bg_style\":\"fav-module-block-light\",\"topbar_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"topbar_bg_image_overlay\":\"fav-transparent\",\"topbar_bg_color\":\"\",\"topbar_color\":\"\",\"topbar_title_color\":\"\",\"topbar_link_color\":\"\",\"topbar_link_hover_color\":\"\",\"slide_width\":\"\",\"slide_bg_style\":\"fav-module-block-light\",\"slide_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"slide_bg_image_overlay\":\"fav-transparent\",\"slide_bg_color\":\"\",\"slide_color\":\"\",\"slide_title_color\":\"\",\"slide_link_color\":\"\",\"slide_link_hover_color\":\"\",\"intro_bg_style\":\"fav-module-block-light\",\"intro_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"intro_bg_image_overlay\":\"fav-transparent\",\"intro_bg_color\":\"\",\"intro_color\":\"\",\"intro_title_color\":\"\",\"intro_link_color\":\"\",\"intro_link_hover_color\":\"\",\"breadcrumbs_bg_style\":\"fav-module-block-light\",\"breadcrumbs_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"breadcrumbs_bg_image_overlay\":\"fav-transparent\",\"breadcrumbs_bg_color\":\"\",\"breadcrumbs_color\":\"\",\"breadcrumbs_title_color\":\"\",\"breadcrumbs_link_color\":\"\",\"breadcrumbs_link_hover_color\":\"\",\"lead_bg_style\":\"fav-module-block-light\",\"lead_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"lead_bg_image_overlay\":\"fav-transparent\",\"lead_bg_color\":\"\",\"lead_color\":\"\",\"lead_title_color\":\"\",\"lead_link_color\":\"\",\"lead_link_hover_color\":\"\",\"promo_bg_style\":\"fav-module-block-light\",\"promo_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"promo_bg_image_overlay\":\"fav-transparent\",\"promo_bg_color\":\"\",\"promo_color\":\"\",\"promo_title_color\":\"\",\"promo_link_color\":\"\",\"promo_link_hover_color\":\"\",\"prime_bg_style\":\"fav-module-block-light\",\"prime_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"prime_bg_image_overlay\":\"fav-transparent\",\"prime_bg_color\":\"\",\"prime_color\":\"\",\"prime_title_color\":\"\",\"prime_link_color\":\"\",\"prime_link_hover_color\":\"\",\"showcase_bg_style\":\"fav-module-block-dark\",\"showcase_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"showcase_bg_image_overlay\":\"fav-transparent\",\"showcase_bg_color\":\"\",\"showcase_color\":\"\",\"showcase_title_color\":\"\",\"showcase_link_color\":\"\",\"showcase_link_hover_color\":\"\",\"feature_bg_style\":\"fav-module-block-light\",\"feature_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"feature_bg_image_overlay\":\"fav-transparent\",\"feature_bg_color\":\"\",\"feature_color\":\"\",\"feature_title_color\":\"\",\"feature_link_color\":\"\",\"feature_link_hover_color\":\"\",\"focus_bg_style\":\"fav-module-block-color\",\"focus_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"focus_bg_image_overlay\":\"fav-transparent\",\"focus_bg_color\":\"\",\"focus_color\":\"\",\"focus_title_color\":\"\",\"focus_link_color\":\"\",\"focus_link_hover_color\":\"\",\"portfolio_bg_style\":\"fav-module-block-dark\",\"portfolio_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"portfolio_bg_image_overlay\":\"fav-transparent\",\"portfolio_bg_color\":\"\",\"portfolio_color\":\"\",\"portfolio_title_color\":\"\",\"portfolio_link_color\":\"\",\"portfolio_link_hover_color\":\"\",\"screen_bg_style\":\"fav-module-block-light\",\"screen_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"screen_bg_image_overlay\":\"fav-transparent\",\"screen_bg_color\":\"\",\"screen_color\":\"\",\"screen_title_color\":\"\",\"screen_link_color\":\"\",\"screen_link_hover_color\":\"\",\"top_bg_style\":\"fav-module-block-light\",\"top_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"top_bg_image_overlay\":\"fav-transparent\",\"top_bg_color\":\"\",\"top_color\":\"\",\"top_title_color\":\"\",\"top_link_color\":\"\",\"top_link_hover_color\":\"\",\"maintop_bg_style\":\"fav-module-block-light\",\"maintop_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"maintop_bg_image_overlay\":\"fav-transparent\",\"maintop_bg_color\":\"\",\"maintop_color\":\"\",\"maintop_title_color\":\"\",\"maintop_link_color\":\"\",\"maintop_link_hover_color\":\"\",\"mainbottom_bg_style\":\"fav-module-block-light\",\"mainbottom_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"mainbottom_bg_image_overlay\":\"fav-transparent\",\"mainbottom_bg_color\":\"\",\"mainbottom_color\":\"\",\"mainbottom_title_color\":\"\",\"mainbottom_link_color\":\"\",\"mainbottom_link_hover_color\":\"\",\"bottom_bg_style\":\"fav-module-block-light\",\"bottom_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"bottom_bg_image_overlay\":\"fav-transparent\",\"bottom_bg_color\":\"\",\"bottom_color\":\"\",\"bottom_title_color\":\"\",\"bottom_link_color\":\"\",\"bottom_link_hover_color\":\"\",\"note_bg_style\":\"fav-module-block-dark\",\"note_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"note_bg_image_overlay\":\"fav-transparent\",\"note_bg_color\":\"\",\"note_color\":\"\",\"note_title_color\":\"\",\"note_link_color\":\"\",\"note_link_hover_color\":\"\",\"base_bg_style\":\"fav-module-block-light\",\"base_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"base_bg_image_overlay\":\"fav-transparent\",\"base_bg_color\":\"\",\"base_color\":\"\",\"base_title_color\":\"\",\"base_link_color\":\"\",\"base_link_hover_color\":\"\",\"block_bg_style\":\"fav-module-block-light\",\"block_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"block_bg_image_overlay\":\"fav-transparent\",\"block_bg_color\":\"\",\"block_color\":\"\",\"block_title_color\":\"\",\"block_link_color\":\"\",\"block_link_hover_color\":\"\",\"user_bg_style\":\"fav-module-block-light\",\"user_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"user_bg_image_overlay\":\"fav-transparent\",\"user_bg_color\":\"\",\"user_color\":\"\",\"user_title_color\":\"\",\"user_link_color\":\"\",\"user_link_hover_color\":\"\",\"footer_bg_style\":\"fav-module-block-dark\",\"footer_bg_image_style\":\"repeat; background-attachment: initial; -webkit-background-size: auto; -moz-background-size: auto; -o-background-size: auto; background-size: auto;\",\"footer_bg_image_overlay\":\"fav-transparent\",\"footer_bg_color\":\"\",\"footer_color\":\"\",\"footer_title_color\":\"\",\"footer_link_color\":\"\",\"footer_link_hover_color\":\"\",\"show_default_logo\":\"1\",\"default_logo\":\"logo.png\",\"default_logo_img_alt\":\"Favourite template\",\"default_logo_padding\":\"\",\"default_logo_margin\":\"\",\"show_media_logo\":\"0\",\"media_logo_img_alt\":\"Favourite template\",\"media_logo_padding\":\"\",\"media_logo_margin\":\"\",\"show_text_logo\":\"0\",\"text_logo\":\"Favourite\",\"text_logo_color\":\"\",\"text_logo_font_size\":\"\",\"text_logo_google_font\":\"Open Sans\",\"text_logo_google_font_weight\":\"400\",\"text_logo_google_font_style\":\"normal\",\"text_logo_line_height\":\"\",\"text_logo_padding\":\"\",\"text_logo_margin\":\"\",\"show_slogan\":\"0\",\"slogan\":\"slogan text here\",\"slogan_color\":\"\",\"slogan_font_size\":\"\",\"slogan_line_height\":\"\",\"slogan_padding\":\"\",\"slogan_margin\":\"\",\"show_retina_logo\":\"0\",\"retina_logo_height\":\"52px\",\"retina_logo_width\":\"188px\",\"retina_logo_img_alt\":\"Favourite template\",\"retina_logo_padding\":\"0px\",\"retina_logo_margin\":\"0px\",\"mobile_nav_color\":\"favth-navbar-default\",\"show_mobile_menu_text\":\"1\",\"mobile_menu_text\":\"Menu\",\"mobile_paragraph_font_size\":\"\",\"mobile_paragraph_line_height\":\"\",\"mobile_title_font_size\":\"\"}',
        '', NULL, NULL, 0, 0, NULL);

INSERT INTO `swana_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`,
                          `level`, `component_id`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`,
                          `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`)
VALUES        (587, 'main-nav-bar', 'My Tickets', 'my-tickets', '', 'account/my-tickets',
        'index.php?option=com_swa&view=membertickets', 'component', 1, 589, 2, 803, 4255, '2019-02-10 15:59:14', 0, 2,
        '', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        96, 97, 0, '*', 0),
       (589, 'main-nav-bar', 'Account', 'account', '', 'account', '', 'heading', 1, 1, 1, 0, 4255,
        '2019-02-10 15:59:08', 0, 2, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 91,
        100, 0, '*', 0),
       (590, 'main-nav-bar', 'Sponsors', 'sponsors', '', 'the-swa/sponsors',
        'index.php?option=com_content&view=article&id=752', 'component', 1, 660, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        8, 9, 0, '*', 0),
       (591, 'main-nav-bar', 'Club', 'club', '', 'club', '', 'heading', 1, 1, 1, 0, 4255, '2019-02-10 15:58:42', 0, 7,
        ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 57,
        70, 0, '*', 0),
       (602, 'main-nav-bar', 'How to attract freshers', 'how-to-attract-freshers', '', 'club/how-to-attract-freshers',
        'index.php?option=com_content&view=article&id=518', 'component', -2, 591, 2, 22, 0, '0000-00-00 00:00:00', 0, 7,
        ' ', 0,
        '{\"show_title\":\"0\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        62, 63, 0, '*', 0),
       (603, 'main-nav-bar', 'How to (legally) make money', 'how-to-legally-make-money', '',
        'club/how-to-legally-make-money', 'index.php?option=com_content&view=article&id=517', 'component', -2, 591, 2,
        22, 0, '0000-00-00 00:00:00', 0, 7, ' ', 0,
        '{\"show_title\":\"0\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        64, 65, 0, '*', 0),
       (604, 'main-nav-bar', 'How to (sensibly) spend money', 'how-to-sensibly-spend-money', '',
        'club/how-to-sensibly-spend-money', 'index.php?option=com_content&view=article&id=519', 'component', -2, 591, 2,
        22, 0, '0000-00-00 00:00:00', 0, 7, ' ', 0,
        '{\"show_title\":\"0\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        66, 67, 0, '*', 0),
       (605, 'main-nav-bar', 'How to run a safe event', 'how-to-run-a-safe-event', '', 'club/how-to-run-a-safe-event',
        'index.php?option=com_content&view=article&id=520', 'component', -2, 591, 2, 22, 0, '0000-00-00 00:00:00', 0, 7,
        ' ', 0,
        '{\"show_title\":\"0\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        68, 69, 0, '*', 0),
       (610, 'main-nav-bar', 'Events', 'events', '', 'events', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 0,
        1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 43,
        56, 0, '*', 0),
       (614, 'main-nav-bar', 'My Account', 'my-account', '', 'account/my-account',
        'index.php?option=com_users&view=profile&layout=edit', 'component', 1, 589, 2, 25, 4255, '2019-02-10 15:59:10',
        0, 2, '', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        92, 93, 0, '*', 0),
       (626, 'main-nav-bar', 'Competition Rules', 'competition-rules', '', 'events/competition-rules',
        'index.php?option=com_content&view=article&id=549', 'component', 1, 610, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        '', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        52, 53, 0, '*', 0),
       (627, 'main-nav-bar', 'Format & Details', 'event-details', '', 'events/event-details',
        'index.php?option=com_content&view=article&id=124', 'component', 1, 610, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"0\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        50, 51, 0, '*', 0),
       (628, 'main-nav-bar', 'Help us', 'help-us', '', 'the-swa/help-us',
        'index.php?option=com_content&view=article&id=161', 'component', 1, 660, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        10, 11, 0, '*', 0),
       (629, 'main-nav-bar', 'Our History', 'our-history', '', 'the-swa/our-history',
        'index.php?option=com_content&view=article&id=295', 'component', 1, 660, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        6, 7, 0, '*', 0),
       (630, 'bottom-nav-bar', 'Legal Information', 'legal-information', '', 'legal-information',
        'index.php?option=com_content&view=article&id=317', 'component', 1, 1, 1, 22, 4255, '2019-02-10 15:57:21', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        17, 18, 0, '*', 0),
       (631, 'bottom-nav-bar', 'FAQ / Contact Us', 'faq-contact-us', '', 'faq-contact-us',
        'index.php?option=com_content&view=article&id=192', 'component', -2, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1,
        '', 0,
        '{\"show_title\":\"1\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"1\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        129, 130, 0, '*', 0),
       (632, 'main-nav-bar', 'What do we do', 'what-do-we-do', '', 'the-swa/what-do-we-do',
        'index.php?option=com_content&view=article&id=206', 'component', 1, 660, 2, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        4, 5, 0, '*', 0),
       (633, 'bottom-nav-bar', 'Privacy Policy', 'privacy-policy', '', 'privacy-policy',
        'index.php?option=com_content&view=article&id=425', 'component', 1, 1, 1, 22, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"urls_position\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        19, 20, 0, '*', 0),
       (634, 'main-nav-bar', 'Who are we?', 'who-are-we', '', 'the-swa/who-are-we',
        'index.php?option=com_swa&view=committee', 'component', 1, 660, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        2, 3, 0, '*', 0),
       (635, 'main-nav-bar', 'Org', 'organisation', '', 'organisation', '', 'heading', 1, 1, 1, 0, 4255,
        '2019-02-10 15:58:49', 0, 8, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 71,
        90, 0, '*', 0),
       (660, 'main-nav-bar', 'The SWA', 'the-swa', '', 'the-swa', '', 'heading', 1, 1, 1, 0, 0, '0000-00-00 00:00:00',
        0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 1,
        14, 0, '*', 0),
       (901, 'main-nav-bar', 'My Membership', 'my-membership', '', 'account/my-membership',
        'index.php?option=com_swa&view=memberdetails', 'component', 1, 589, 2, 803, 4255, '2019-02-10 15:59:12', 0, 2,
        '', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        94, 95, 0, '*', 0),
       (963, 'main-nav-bar', 'Members', 'members', '', 'club/members',
        'index.php?option=com_swa&view=universitymembers', 'component', 1, 591, 2, 803, 4255, '2019-02-10 15:58:45', 0,
        7, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        58, 59, 0, '*', 0),
       (964, 'main-nav-bar', 'Event Attendees', 'event-attendees', '', 'club/event-attendees',
        'index.php?option=com_swa&view=universityeventattendees', 'component', 1, 591, 2, 803, 4255,
        '2019-02-10 15:58:46', 0, 7, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        60, 61, 0, '*', 0),
       (1043, 'main-nav-bar', 'My Details', 'my-details', '', 'organisation/my-details',
        'index.php?option=com_swa&view=orgcommitteedetails', 'component', 1, 635, 2, 803, 4255, '2019-02-10 15:58:51',
        0, 8, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        72, 73, 0, '*', 0),
       (1044, 'main-nav-bar', 'Committee', 'committee', '', 'organisation/committee',
        'index.php?option=com_swa&view=committee', 'component', 1, 635, 2, 803, 4255, '2019-02-10 15:58:53', 0, 8, ' ',
        0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        74, 75, 0, '*', 0),
       (1066, 'main-nav-bar', 'Calendar', 'calendar', '', 'events/calendar', 'index.php?option=com_swa&view=events',
        'component', 1, 610, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        46, 47, 0, '*', 0),
       (1068, 'main-nav-bar', 'Season Results', 'season-results', '', 'events/season-results',
        'index.php?option=com_swa&view=seasonresults', 'component', 1, 610, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, ' ',
        0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        54, 55, 0, '*', 0),
       (1069, 'main-nav-bar', 'Qualified members', 'qualified-members', '', 'organisation/qualified-members',
        'index.php?option=com_swa&view=orgmemberqualifications', 'component', 1, 635, 2, 803, 4255,
        '2019-02-10 15:58:57', 0, 8, '', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        76, 77, 0, '*', 0),
       (1089, 'main-nav-bar', 'My Qualifications', 'my-qualifications', '', 'account/my-qualifications',
        'index.php?option=com_swa&view=qualifications', 'component', 1, 589, 2, 803, 4255, '2019-02-10 15:59:15', 0, 2,
        ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        98, 99, 0, '*', 0),
       (1109, 'main-nav-bar', 'Buy tickets', 'buy-tickets', '', 'events/buy-tickets',
        'index.php?option=com_swa&view=ticketpurchase', 'component', 1, 610, 2, 803, 4255, '2019-02-10 15:58:33', 0, 1,
        ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        48, 49, 0, '*', 0),
       (1167, 'main-nav-bar', 'Universities', 'universities', '', 'organisation/universities',
        'index.php?option=com_swa&view=universities', 'component', 1, 635, 2, 803, 4255, '2019-02-10 15:59:00', 0, 8,
        ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        78, 79, 0, '*', 0),
       (1374, 'main-nav-bar', 'Contact Us', 'contact-us', '', 'the-swa/contact-us',
        'index.php?option=com_contact&view=contact&id=1', 'component', 1, 660, 2, 8, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"presentation_style\":\"\",\"show_contact_category\":\"\",\"show_contact_list\":\"\",\"show_tags\":\"\",\"show_info\":\"\",\"show_name\":\"\",\"show_position\":\"\",\"show_email\":\"\",\"add_mailto_link\":\"\",\"show_street_address\":\"\",\"show_suburb\":\"\",\"show_state\":\"\",\"show_postcode\":\"\",\"show_country\":\"\",\"show_telephone\":\"\",\"show_mobile\":\"\",\"show_fax\":\"\",\"show_webpage\":\"\",\"show_image\":\"\",\"allow_vcard\":\"\",\"show_misc\":\"\",\"show_articles\":\"\",\"articles_display_num\":\"\",\"show_links\":\"\",\"linka_name\":\"\",\"linkb_name\":\"\",\"linkc_name\":\"\",\"linkd_name\":\"\",\"linke_name\":\"\",\"show_email_form\":\"\",\"show_email_copy\":\"\",\"banned_email\":\"\",\"banned_subject\":\"\",\"banned_text\":\"\",\"validate_session\":\"\",\"custom_reply\":\"\",\"redirect\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        12, 13, 0, '*', 0),
       (1451, 'main-nav-bar', 'Login', 'login', '', 'login', 'index.php?option=com_users&view=login', 'component', 1, 1,
        1, 25, 4255, '2019-02-10 16:00:40', 0, 5, ' ', 0,
        '{\"loginredirectchoice\":\"1\",\"login_redirect_url\":\"\",\"login_redirect_menuitem\":\"1706\",\"logindescription_show\":\"1\",\"login_description\":\"\",\"login_image\":\"\",\"logoutredirectchoice\":\"1\",\"logout_redirect_url\":\"\",\"logout_redirect_menuitem\":\"\",\"logoutdescription_show\":\"1\",\"logout_description\":\"\",\"logout_image\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        115, 116, 0, '*', 0),
       (1657, 'main-nav-bar', 'Logout', 'logout', '', 'logout',
        'index.php?option=com_users&view=login&layout=logout&task=user.menulogout', 'component', 1, 1, 1, 25, 4255,
        '2019-02-10 16:00:39', 0, 2, ' ', 0,
        '{\"logout\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        113, 114, 0, '*', 0),
       (1663, 'main-nav-bar', 'About', 'about', '', 'about', '', 'heading', -2, 1, 1, 0, 0, '0000-00-00 00:00:00', 0, 1,
        ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}',
        117, 118, 0, '*', 0),
       (1679, 'main', 'COM_SMARTCOUNTDOWN3', 'com-smartcountdown3', '', 'com-smartcountdown3',
        'index.php?option=com_smartcountdown3', 'component', 1, 1, 1, 10020, 0, '0000-00-00 00:00:00', 0, 1,
        'class:component', 0, '{}', 161, 162, 0, '', 1),
       (1680, 'main-nav-bar', 'Search', 'search', '', 'search', 'index.php?option=com_search&view=search', 'component',
        -2, 1, 1, 19, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"search_phrases\":\"\",\"search_areas\":\"\",\"show_date\":\"\",\"searchphrase\":\"0\",\"ordering\":\"newest\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        163, 164, 0, '*', 0),
       (1681, 'main-nav-bar', 'Blog', 'blog', '', 'media-outlet/blog',
        'index.php?option=com_content&view=category&layout=blog&id=302', 'component', -2, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"-1\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        36, 37, 0, '*', 0),
       (1682, 'main-nav-bar', 'People', 'people', '', 'media-outlet/people',
        'index.php?option=com_content&view=category&layout=blog&id=297', 'component', -2, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        30, 31, 0, '*', 0),
       (1683, 'main-nav-bar', 'SWA Society', 'society', '', 'media-outlet/society',
        'index.php?option=com_content&view=category&layout=blog&id=297', 'component', 1, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        24, 25, 0, '*', 0),
       (1684, 'main-nav-bar', 'Skills & Guides', 'skills', '', 'media-outlet/skills',
        'index.php?option=com_content&view=category&layout=blog&id=299', 'component', 1, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        28, 29, 0, '*', 0),
       (1685, 'main-nav-bar', 'SWA Sponsors', 'sponsors', '', 'media-outlet/sponsors',
        'index.php?option=com_content&view=category&layout=blog&id=296', 'component', 0, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        26, 27, 0, '*', 0),
       (1686, 'main-nav-bar', 'SWA Series', 'series', '', 'media-outlet/series', 'index.php?Itemid=', 'alias', 1, 1687,
        2, 0, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"aliasoptions\":\"1690\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1}',
        22, 23, 0, '*', 0),
       (1687, 'main-nav-bar', 'Media', 'media-outlet', '', 'media-outlet', '', 'heading', 1, 1, 1, 0, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1}', 21,
        42, 0, '*', 0),
       (1688, 'main-nav-bar', 'Archive', 'archive', '', 'media-outlet/archive',
        'index.php?option=com_content&view=category&layout=blog&id=306', 'component', -2, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        34, 35, 0, '*', 0),
       (1689, 'main-nav-bar', 'Miscellaneous', 'miscellaneous', '', 'media-outlet/miscellaneous',
        'index.php?option=com_content&view=category&layout=blog&id=307', 'component', -2, 1687, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        32, 33, 0, '*', 0),
       (1690, 'main-nav-bar', 'Articles', 'articles', '', 'events/articles',
        'index.php?option=com_content&view=category&layout=blog&id=144', 'component', 1, 610, 2, 22, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"layout_type\":\"blog\",\"show_category_heading_title_text\":\"\",\"show_category_title\":\"\",\"show_description\":\"\",\"show_description_image\":\"\",\"maxLevel\":\"\",\"show_empty_categories\":\"\",\"show_no_articles\":\"\",\"show_subcat_desc\":\"\",\"show_cat_num_articles\":\"\",\"show_cat_tags\":\"\",\"page_subheading\":\"\",\"num_leading_articles\":\"\",\"num_intro_articles\":\"\",\"num_columns\":\"\",\"num_links\":\"\",\"multi_column_order\":\"\",\"show_subcategory_content\":\"\",\"orderby_pri\":\"\",\"orderby_sec\":\"\",\"order_date\":\"\",\"show_pagination\":\"\",\"show_pagination_results\":\"\",\"show_featured\":\"\",\"article_layout\":\"_:default\",\"show_title\":\"\",\"link_titles\":\"\",\"show_intro\":\"\",\"info_block_position\":\"\",\"info_block_show_title\":\"\",\"show_category\":\"\",\"link_category\":\"\",\"show_parent_category\":\"\",\"link_parent_category\":\"\",\"show_associations\":\"\",\"show_author\":\"\",\"link_author\":\"\",\"show_create_date\":\"\",\"show_modify_date\":\"\",\"show_publish_date\":\"\",\"show_item_navigation\":\"\",\"show_vote\":\"\",\"show_readmore\":\"\",\"show_readmore_title\":\"\",\"show_icons\":\"\",\"show_print_icon\":\"\",\"show_email_icon\":\"\",\"show_hits\":\"\",\"show_tags\":\"\",\"show_noauth\":\"\",\"show_feed_link\":\"\",\"feed_summary\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        44, 45, 0, '*', 0),
       (1695, 'main', 'COM_FAVICON', 'com-favicon', '', 'com-favicon', 'index.php?option=com_favicon', 'component', 1,
        1, 1, 10035, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_favicon/assets/images/favicon16.png', 0, '{}', 165,
        166, 0, '', 1),
       (1696, 'main-nav-bar', 'Help', 'help', '', 'help', 'index.php?option=com_faqbookpro&view=section&id=7',
        'component', 1, 1, 1, 10007, 0, '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        101, 112, 0, '*', 0),
       (1697, 'main-nav-bar', 'Members', 'members', '', 'help/members',
        'index.php?option=com_faqbookpro&view=topic&id=16', 'component', 1, 1696, 2, 10007, 0, '0000-00-00 00:00:00', 0,
        1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        104, 105, 0, '*', 0),
       (1698, 'main-nav-bar', 'Club committee', 'club-committee', '', 'help/club-committee',
        'index.php?option=com_faqbookpro&view=topic&id=17', 'component', 1, 1696, 2, 10007, 0, '0000-00-00 00:00:00', 0,
        7, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        108, 109, 0, '*', 0),
       (1699, 'main-nav-bar', 'SWA committee', 'swa-committee', '', 'help/swa-committee',
        'index.php?option=com_faqbookpro&view=topic&id=18', 'component', 1, 1696, 2, 10007, 0, '0000-00-00 00:00:00', 0,
        8, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        110, 111, 0, '*', 0),
       (1700, 'main-nav-bar', 'Website', 'website', '', 'help/website',
        'index.php?option=com_faqbookpro&view=section&id=7', 'component', -2, 1696, 2, 10007, 0, '0000-00-00 00:00:00',
        0, 1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        106, 107, 0, '*', 0),
       (1701, 'main-nav-bar', 'The SWA', 'the-swa', '', 'help/the-swa',
        'index.php?option=com_faqbookpro&view=topic&id=15', 'component', 1, 1696, 2, 10007, 0, '0000-00-00 00:00:00', 0,
        1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        102, 103, 0, '*', 0),
       (1702, 'main', 'COM_RANTISPAM', 'com-rantispam', '', 'com-rantispam', 'index.php?option=com_rantispam',
        'component', 1, 1, 1, 10043, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_rantispam/assets/images/s_com_rantispam.png', 0, '{}', 167, 174, 0, '', 1),
       (1703, 'main', 'COM_RANTISPAM_TITLE_SPAMS', 'com-rantispam-title-spams', '',
        'com-rantispam/com-rantispam-title-spams', 'index.php?option=com_rantispam&view=spams', 'component', 1, 1702, 2,
        10043, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 168, 169, 0, '', 1),
       (1704, 'main', 'COM_RANTISPAM_TITLE_BANNEDIPS', 'com-rantispam-title-bannedips', '',
        'com-rantispam/com-rantispam-title-bannedips', 'index.php?option=com_rantispam&view=bannedips', 'component', 1,
        1702, 2, 10043, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 170, 171, 0, '', 1),
       (1705, 'main', 'COM_RANTISPAM_TITLE_ABOUT', 'com-rantispam-title-about', '',
        'com-rantispam/com-rantispam-title-about', 'index.php?option=com_rantispam&view=about', 'component', 1, 1702, 2,
        10043, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 172, 173, 0, '', 1),
       (1728, 'main-nav-bar', 'Images & Videos', 'gallery', '', 'media-outlet/gallery',
        'index.php?option=com_bt_media&view=category&catid=6', 'component', -2, 1687, 2, 10066, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"theme\":\"\",\"show_filter_bar\":\"\",\"cat_cat_info\":\"\",\"cat_show_parent\":\"\",\"cat_show_child\":\"\",\"show_media_type\":\"\",\"show_list_limit_item\":\"\",\"show_ordering\":\"\",\"order_type\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        38, 41, 0, '*', 0),
       (1730, 'main', 'COM_BT_MEDIA', 'com-bt-media', '', 'com-bt-media', 'index.php?option=com_bt_media', 'component',
        1, 1, 1, 10066, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_bt_media/assets/icon/s_bt_media.png', 0, '{}',
        179, 188, 0, '', 1),
       (1731, 'main', 'COM_BT_MEDIA_MENU_CPANEL_TITLE', 'com-bt-media-menu-cpanel-title', '',
        'com-bt-media/com-bt-media-menu-cpanel-title', 'index.php?option=com_bt_media&view=controlpanel', 'component',
        1, 1730, 2, 10066, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_bt_media/assets/icon/s_bt_media.png', 0,
        '{}', 180, 181, 0, '', 1),
       (1732, 'main', 'COM_BT_MEDIA_MENU_CATEGORYS_TITLE', 'com-bt-media-menu-categorys-title', '',
        'com-bt-media/com-bt-media-menu-categorys-title', 'index.php?option=com_bt_media&view=categories', 'component',
        1, 1730, 2, 10066, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_bt_media/assets/icon/s_category-manager.png',
        0, '{}', 182, 183, 0, '', 1),
       (1733, 'main', 'COM_BT_MEDIA_MENU_MEDIASMANAGEMENT_TITLE', 'com-bt-media-menu-mediasmanagement-title', '',
        'com-bt-media/com-bt-media-menu-mediasmanagement-title', 'index.php?option=com_bt_media&view=list', 'component',
        1, 1730, 2, 10066, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_bt_media/assets/icon/s_media-manager.png', 0,
        '{}', 184, 185, 0, '', 1),
       (1734, 'main', 'COM_BT_MEDIA_MENU_TAG_TITLE', 'com-bt-media-menu-tag-title', '',
        'com-bt-media/com-bt-media-menu-tag-title', 'index.php?option=com_bt_media&view=tags', 'component', 1, 1730, 2,
        10066, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_bt_media/assets/icon/s_tags-manager.png', 0, '{}', 186,
        187, 0, '', 1),
       (1735, 'main-nav-bar', 'Videos', 'videos', '', 'media-outlet/gallery/videos',
        'index.php?option=com_bt_media&view=list&categories[0]=', 'component', -2, 1728, 3, 10066, 0,
        '0000-00-00 00:00:00', 0, 1, ' ', 0,
        '{\"theme\":\"\",\"show_filter_bar\":\"\",\"show_sub_media\":\"\",\"show_media_type\":\"video\",\"show_list_limit_item\":\"\",\"show_ordering\":\"\",\"order_type\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        39, 40, 0, '*', 0),
       (1736, 'main-nav-bar', 'Committee Gallery', 'committee-gallery', '', 'organisation/committee-gallery',
        'index.php?option=com_bt_media&view=category&catid=11', 'component', 1, 635, 2, 10066, 0, '0000-00-00 00:00:00',
        0, 8, ' ', 0,
        '{\"theme\":\"\",\"show_filter_bar\":\"\",\"cat_cat_info\":\"\",\"cat_show_parent\":\"\",\"cat_show_child\":\"\",\"show_media_type\":\"\",\"show_list_limit_item\":\"\",\"show_ordering\":\"\",\"order_type\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        80, 81, 0, '*', 0),
       (1737, 'main-nav-bar', 'Media Upload', 'media-upload', '', 'organisation/media-upload',
        'index.php?option=com_bt_media&view=detail&layout=edit', 'component', 1, 635, 2, 10066, 0,
        '0000-00-00 00:00:00', 0, 8, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        82, 83, 0, '*', 0),
       (1738, 'main-nav-bar', 'Create Article', 'create-article', '', 'organisation/create-article',
        'index.php?option=com_content&view=form&layout=edit', 'component', 1, 635, 2, 22, 0, '0000-00-00 00:00:00', 0,
        8, ' ', 0,
        '{\"enable_category\":\"0\",\"catid\":\"\",\"redirect_menuitem\":\"\",\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        84, 85, 0, '*', 0),
       (1741, 'main-nav-bar', 'Emails', 'emails', '', 'organisation/emails', 'index.php?option=com_phcloud&view=emails',
        'component', 1, 635, 2, 10090, 0, '0000-00-00 00:00:00', 0, 8, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        86, 87, 0, '*', 0),
       (1742, 'main-nav-bar', 'PH Ctrl Pan', 'ph-ctrl-pan', '', 'organisation/ph-ctrl-pan',
        'index.php?option=com_phcloud&view=cpanel', 'component', -2, 635, 2, 10090, 0, '0000-00-00 00:00:00', 0, 6, ' ',
        0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        88, 89, 0, '*', 0),
       (1744, 'main', 'COM_PHCLOUD', 'com-phcloud', '', 'com-phcloud', 'index.php?option=com_phcloud', 'component', 1,
        1, 1, 10090, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 189, 190, 0, '', 1),
       (1745, 'main', 'COM_PROFILES', 'com-profiles', '', 'com-profiles', 'index.php?option=com_profiles', 'component',
        1, 1, 1, 10093, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_profiles/filemanager/images/icons/folder.png',
        0, '{}', 191, 192, 0, '', 1),
       (2133, 'main', 'COM_FAQBOOKPRO_ADMIN_MENU', 'com-faqbookpro-admin-menu', '', 'com-faqbookpro-admin-menu',
        'index.php?option=com_faqbookpro', 'component', 1, 1, 1, 10007, 0, '0000-00-00 00:00:00', 0, 1,
        'class:component', 0, '{}', 193, 202, 0, '', 1),
       (2134, 'main', 'COM_FAQBOOKPRO_SUBMENU_SECTIONS', 'com-faqbookpro-submenu-sections', '',
        'com-faqbookpro-admin-menu/com-faqbookpro-submenu-sections', 'index.php?option=com_faqbookpro&view=sections',
        'component', 1, 2133, 2, 10007, 0, '0000-00-00 00:00:00', 0, 1, 'class:sections', 0, '{}', 194, 195, 0, '', 1),
       (2135, 'main', 'COM_FAQBOOKPRO_SUBMENU_TOPICS', 'com-faqbookpro-submenu-topics', '',
        'com-faqbookpro-admin-menu/com-faqbookpro-submenu-topics', 'index.php?option=com_faqbookpro&view=topics',
        'component', 1, 2133, 2, 10007, 0, '0000-00-00 00:00:00', 0, 1, 'class:topics', 0, '{}', 196, 197, 0, '', 1),
       (2136, 'main', 'COM_FAQBOOKPRO_SUBMENU_QUESTIONS', 'com-faqbookpro-submenu-questions', '',
        'com-faqbookpro-admin-menu/com-faqbookpro-submenu-questions', 'index.php?option=com_faqbookpro&view=questions',
        'component', 1, 2133, 2, 10007, 0, '0000-00-00 00:00:00', 0, 1, 'class:questions', 0, '{}', 198, 199, 0, '', 1),
       (2137, 'main', 'COM_FAQBOOKPRO_SUBMENU_ABOUT', 'com-faqbookpro-submenu-about', '',
        'com-faqbookpro-admin-menu/com-faqbookpro-submenu-about', 'index.php?option=com_faqbookpro&view=about',
        'component', 1, 2133, 2, 10007, 0, '0000-00-00 00:00:00', 0, 1, 'class:about', 0, '{}', 200, 201, 0, '', 1),
       (2195, 'main', 'COM_SWA', 'com-swa', '', 'com-swa', 'index.php?option=com_swa', 'component', 1, 1, 1, 803, 0,
        '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_com_swa.png', 0, '{}', 203, 240, 0, '', 1),
       (2196, 'main', 'COM_SWA_TITLE_MEMBERS', 'com-swa-title-members', '', 'com-swa/com-swa-title-members',
        'index.php?option=com_swa&view=members', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 204, 205, 0, '', 1),
       (2197, 'main', 'COM_SWA_TITLE_COMMITTEE', 'com-swa-title-committee', '', 'com-swa/com-swa-title-committee',
        'index.php?option=com_swa&view=committeemembers', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 206, 207, 0, '', 1),
       (2198, 'main', 'COM_SWA_TITLE_UNIVERSITYMEMBERS', 'com-swa-title-universitymembers', '',
        'com-swa/com-swa-title-universitymembers', 'index.php?option=com_swa&view=universitymembers', 'component', 1,
        2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 208,
        209, 0, '', 1),
       (2199, 'main', 'COM_SWA_TITLE_QUALIFICATIONS', 'com-swa-title-qualifications', '',
        'com-swa/com-swa-title-qualifications', 'index.php?option=com_swa&view=qualifications', 'component', 1, 2195, 2,
        803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 210, 211, 0, '',
        1),
       (2200, 'main', 'COM_SWA_TITLE_EVENTS', 'com-swa-title-events', '', 'com-swa/com-swa-title-events',
        'index.php?option=com_swa&view=events', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 212, 213, 0, '', 1),
       (2201, 'main', 'COM_SWA_TITLE_EVENTHOSTS', 'com-swa-title-eventhosts', '', 'com-swa/com-swa-title-eventhosts',
        'index.php?option=com_swa&view=eventhosts', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 214, 215, 0, '', 1),
       (2202, 'main', 'COM_SWA_TITLE_EVENTREGISTRATIONS', 'com-swa-title-eventregistrations', '',
        'com-swa/com-swa-title-eventregistrations', 'index.php?option=com_swa&view=eventregistrations', 'component', 1,
        2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 216,
        217, 0, '', 1),
       (2203, 'main', 'COM_SWA_TITLE_EVENTTICKETS', 'com-swa-title-eventtickets', '',
        'com-swa/com-swa-title-eventtickets', 'index.php?option=com_swa&view=eventtickets', 'component', 1, 2195, 2,
        803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 218, 219, 0, '',
        1),
       (2204, 'main', 'COM_SWA_TITLE_TICKETS', 'com-swa-title-tickets', '', 'com-swa/com-swa-title-tickets',
        'index.php?option=com_swa&view=tickets', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 220, 221, 0, '', 1),
       (2208, 'main', 'COM_SWA_TITLE_UNIVERSITIES', 'com-swa-title-universities', '',
        'com-swa/com-swa-title-universities', 'index.php?option=com_swa&view=universities', 'component', 1, 2195, 2,
        803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 228, 229, 0, '',
        1),
       (2209, 'main', 'COM_SWA_TITLE_SEASONS', 'com-swa-title-seasons', '', 'com-swa/com-swa-title-seasons',
        'index.php?option=com_swa&view=seasons', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 230, 231, 0, '', 1),
       (2210, 'main', 'COM_SWA_TITLE_COMPETITIONS', 'com-swa-title-competitions', '',
        'com-swa/com-swa-title-competitions', 'index.php?option=com_swa&view=competitions', 'component', 1, 2195, 2,
        803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 232, 233, 0, '',
        1),
       (2211, 'main', 'COM_SWA_TITLE_COMPETITIONTYPES', 'com-swa-title-competitiontypes', '',
        'com-swa/com-swa-title-competitiontypes', 'index.php?option=com_swa&view=competitiontypes', 'component', 1,
        2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 234,
        235, 0, '', 1),
       (2212, 'main', 'COM_SWA_TITLE_TEAMRESULTS', 'com-swa-title-teamresults', '', 'com-swa/com-swa-title-teamresults',
        'index.php?option=com_swa&view=teamresults', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 236, 237, 0, '', 1),
       (2213, 'main', 'COM_SWA_TITLE_INDIVIDUALRESULTS', 'com-swa-title-individualresults', '',
        'com-swa/com-swa-title-individualresults', 'index.php?option=com_swa&view=individualresults', 'component', 1,
        2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_swa/assets/images/s_default.png', 0, '{}', 238,
        239, 0, '', 1),
       (2215, 'main', 'COM_SWA_TITLE_SPONSORS', 'com-swa-title-sponsors', '', 'com-swa/com-swa-title-sponsors',
        'index.php?option=com_swa&view=sponsors', 'component', 1, 2195, 2, 803, 0, '0000-00-00 00:00:00', 0, 1,
        'components/com_swa/assets/images/s_default.png', 0, '{}', 240, 241, 0, '', 1),
       (2214, 'main', 'COM_AKEEBA', 'com-akeeba', '', 'com-akeeba', 'index.php?option=com_akeeba', 'component', 1, 1, 1,
        10015, 0, '0000-00-00 00:00:00', 0, 1, 'class:component', 0, '{}', 241, 242, 0, '', 1),
       (4785, 'main-nav-bar', 'Update Club Agreement', 'club-agreement', '', 'club/agreement',
        'index.php?option=com_swa&view=clubagreement', 'component', 1, 2458, 3, 10052, 14657, '2022-05-21 13:35:23', 0,
        1, ' ', 0,
        '{\"menu-anchor_title\":\"\",\"menu-anchor_css\":\"\",\"menu_image\":\"\",\"menu_image_css\":\"\",\"menu_text\":1,\"menu_show\":1,\"page_title\":\"\",\"show_page_heading\":\"\",\"page_heading\":\"\",\"pageclass_sfx\":\"\",\"menu-meta_description\":\"\",\"menu-meta_keywords\":\"\",\"robots\":\"\",\"secure\":0}',
        151, 152, 0, '*', 0);

DROP TABLE IF EXISTS `swana_menu_types`;
CREATE TABLE `swana_menu_types`
(
    `id`          int(10) unsigned                        NOT NULL AUTO_INCREMENT,
    `asset_id`    int(10) unsigned                        NOT NULL DEFAULT '0',
    `menutype`    varchar(24) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `title`       varchar(48) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
    `client_id`   int(11)                                 NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 11
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `swana_menu_types` (`id`, `asset_id`, `menutype`, `title`, `description`, `client_id`)
VALUES
       (10, 743, 'bottom-nav-bar', 'Bottom Nav Bar', '', 0);






DROP TABLE IF EXISTS `swana_swa_committee`;
CREATE TABLE `swana_swa_committee`
(
    `id`        int(11)       NOT NULL AUTO_INCREMENT,
    `member_id` int(11)       NOT NULL,
    `position`  varchar(50)   NOT NULL,
    `blurb`     varchar(2000) NOT NULL,
    `image`     varchar(100)  NOT NULL,
    `ordering`  int(11)       NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `fk_committee_member_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_sponsors`;
CREATE TABLE `swana_swa_sponsors`
(
    `name`          varchar(32)  NOT NULL,
    `logo_url`      varchar(512) NOT NULL,
    `blurb`         text         NOT NULL,
    `sponsor_level` int(11)      NOT NULL,
    `id`            int(11)      NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO `swana_swa_sponsors` (`name`, `logo_url`, `blurb`, `sponsor_level`, `id`)
VALUES ('Sample Sponsor',
        'https://cdn.vox-cdn.com/thumbor/Uk16ijHSOhgjs0byA-rA4p2icMY=/1400x1050/filters:format(jpeg)/cdn.vox-cdn.com/uploads/chorus_asset/file/10666689/hypnotoad.jpg',
        'All hail the hypnotoad', 1, 1);

INSERT INTO `swana_swa_committee` (`id`, `member_id`, `position`, `blurb`, `image`, `ordering`)
VALUES (1, 2, 'Under', '<p>blah blah blah</p>', 'https://openclipart.org/download/242499/1456705995.svg', 1);

DROP TABLE IF EXISTS `swana_swa_competition`;
CREATE TABLE `swana_swa_competition`
(
    `id`                  int(11) NOT NULL AUTO_INCREMENT,
    `event_id`            int(11) NOT NULL,
    `competition_type_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_competition_event1_idx` (`event_id`),
    KEY `fk_competition_competition_type1_idx` (`competition_type_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_competition_type`;
CREATE TABLE `swana_swa_competition_type`
(
    `id`     int(11)     NOT NULL AUTO_INCREMENT,
    `name`   varchar(45) NOT NULL,
    `series` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_competition_type` (`id`, `name`, `series`)
VALUES (1, 'Team', 'Team'),
       (2, 'Wave', 'Wave'),
       (3, 'Freestyle', 'Freestyle'),
       (4, 'Advanced Race', 'Race'),
       (5, 'Intermediate Race', 'Race'),
       (6, 'Beginner Race', 'Race');


DROP TABLE IF EXISTS `swana_swa_event`;
CREATE TABLE `swana_swa_event`
(
    `id`         int(11)      NOT NULL AUTO_INCREMENT,
    `name`       varchar(100) NOT NULL,
    `season_id`  int(11)      NOT NULL,
    `capacity`   int(11)      NOT NULL,
    `date_open`  date         NOT NULL,
    `date_close` date         NOT NULL,
    `date`       date         NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_event_season1_idx` (`season_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_event` (`id`, `name`, `season_id`, `capacity`, `date_open`, `date_close`, `date`)
VALUES (1, 'The Best Event', 19, 10, '2019-02-10', '2999-02-13', '2999-02-15');

DROP TABLE IF EXISTS `swana_swa_event_host`;
CREATE TABLE `swana_swa_event_host`
(
    `id`            int(11) NOT NULL AUTO_INCREMENT,
    `event_id`      int(11) NOT NULL,
    `university_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_event_host_event1_idx` (`event_id`),
    KEY `fk_event_host_university1_idx` (`university_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_event_host` (`id`, `event_id`, `university_id`)
VALUES (1, 1, 1);

DROP TABLE IF EXISTS `swana_swa_event_registration`;
CREATE TABLE `swana_swa_event_registration`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT,
    `event_id`  int(11) NOT NULL,
    `member_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_event_registration_event1_idx` (`event_id`),
    KEY `fk_event_registration_member1_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_event_registration` (`id`, `event_id`, `member_id`)
VALUES (1, 1, 7);


DROP TABLE IF EXISTS `swana_swa_event_ticket`;
CREATE TABLE `swana_swa_event_ticket`
(
    `id`                 int(11)       NOT NULL AUTO_INCREMENT,
    `event_id`           int(11)       NOT NULL,
    `name`               varchar(100)  NOT NULL,
    `quantity`           int(11)       NOT NULL,
    `price`              decimal(6, 2) NOT NULL,
    `notes`              text,
    `need_level`         varchar(20)            DEFAULT NULL,
    `need_swa`           tinyint(1)    NOT NULL DEFAULT '0',
    `need_xswa`          tinyint(1)    NOT NULL DEFAULT '0',
    `need_host`          tinyint(1)    NOT NULL DEFAULT '0',
    `need_qualification` tinyint(1)    NOT NULL DEFAULT '0',
    `details`            text,
    PRIMARY KEY (`id`),
    KEY `fk_event_ticket_event1_idx` (`event_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_event_ticket` (`id`, `event_id`, `name`, `quantity`, `price`, `notes`, `need_level`, `need_swa`,
                                      `need_xswa`, `need_host`, `need_qualification`, `details`)
VALUES (1, 1, 'Windsurf (normal)', 5, 10.00, '', NULL, 0, 0, 0, 0,
        '{   \"visible\": \"All\",   \"xswa\": false,   \"qualification\": false,   \"committee\": false,   \"member\": {\"allowed\": [],\"denied\": []},   \"university\": {\"allowed\": [],\"denied\": []},   \"level\": {\"allowed\": [],\"denied\": []},   \"addons\": [] } '),
       (2, 1, 'Host', 5, 5.00, '', NULL, 0, 0, 0, 0,
        '{   \"visible\": \"All\",   \"xswa\": false,   \"qualification\": false,   \"committee\": false,   \"member\": {\"allowed\": [],\"denied\": []},   \"university\": {\"allowed\": [],\"denied\": []},   \"level\": {\"allowed\": [],\"denied\": []},   \"addons\": [] } '),
       (3, 1, 'Party (has-addons)', 5, 5.00, '', NULL, 0, 0, 0, 0, '{   \"visible\": \"All\",   \"xswa\": false,   \"qualification\": false,   \"committee\": false,   \"member\": {\"allowed\": [],\"denied\": []},   \"university\": {\"allowed\": [],\"denied\": []},   \"level\": {\"allowed\": [],\"denied\": []},   \"addons\":  [{
		"name": "T-Shirt",
		"description": "Limited Edition AK19 T-Shirt",
		"options": {
			"name": "Size",
			"values": [{
					"label": "XS",
					"value": "XS"
				},
				{
					"label": "S",
					"value": "S"
				},
				{
					"label": "M",
					"value": "M"
				},
				{
					"label": "L",
					"value": "L"
				},
				{
					"label": "XL",
					"value": "XL:"
				},
				{
					"label": "XXL",
					"value": "XXL"
				}
			]
		},
		"price": 6.99
	}, {
		"name": "Hoodie",
		"description": "Limited Edition AK19 Hoodie",
		"options": {
			"name": "Size",
			"values": [{
					"label": "XS",
					"value": "XS"
				},
				{
					"label": "S",
					"value": "S"
				},
				{
					"label": "M",
					"value": "M"
				},
				{
					"label": "L",
					"value": "L"
				},
				{
					"label": "XL",
					"value": "XL:"
				},
				{
					"label": "XXL",
					"value": "XXL"
				}
			]
		},
		"price": 15.5
	}, {
		"name": "Crew Neck Jumper",
		"description": "Limited Edition AK19 Jumper",
		"options": {
			"name": "Option",
			"values": [{
					"label": "XS",
					"value": "XS"
				},
				{
					"label": "S",
					"value": "S"
				},
				{
					"label": "M",
					"value": "M"
				},
				{
					"label": "L",
					"value": "L"
				},
				{
					"label": "XL",
					"value": "XL:"
				},
				{
					"label": "XXL",
					"value": "XXL"
				}
			]
		},
		"price": 15
	}] } ');


DROP TABLE IF EXISTS `swana_swa_indi_result`;
CREATE TABLE `swana_swa_indi_result`
(
    `id`             int(11) NOT NULL AUTO_INCREMENT,
    `member_id`      int(11) NOT NULL,
    `competition_id` int(11) NOT NULL,
    `result`         int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_indi_result_competition1_idx` (`competition_id`),
    KEY `fk_indi_result_member1_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_member`;
CREATE TABLE `swana_swa_member`
(
    `id`              int(11) unsigned NOT NULL AUTO_INCREMENT,
    `user_id`         int(11)          NOT NULL,
    `lifetime_member` tinyint(1)       NOT NULL DEFAULT '0',
    `gender`          varchar(255)     NOT NULL DEFAULT 'None',
    `pronouns`        varchar(30)      NOT NULL,
    `ethnicity`       varchar(70)      NOT NULL DEFAULT 'Default',
    `dob`             date             NOT NULL DEFAULT '0000-00-00',
    `university_id`   int(11)          NOT NULL,
    `level`           varchar(20)      NOT NULL DEFAULT 'Beginner',
    `race`            varchar(255)     NOT NULL DEFAULT 'None',
    `econtact`        varchar(255)     NOT NULL,
    `enumber`         varchar(255)     NOT NULL,
    `dietary`         varchar(30)      NOT NULL DEFAULT 'None',
    `medical`         TEXT                      DEFAULT NULL,
    `tel`             varchar(15)      NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id_UNIQUE` (`user_id`),
    KEY `fk_member_user_idx` (`user_id`),
    KEY `fk_member_university_idx` (`university_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_member`
(`id`, `user_id`, `lifetime_member`, `gender`, `pronouns`, `dob`, `university_id`, `level`, `race`, `econtact`,
 `enumber`, `dietary`, `tel`, `ethnicity`)
VALUES (1, 427, 1, 'Male', 'he/him', '1989-02-10', 1, 'Advanced', 'Male', 'Rachel', '07656765455', 'Vegan',
        '07805925656', 'English / Welsh / Scottish / Northern Irish / British'),
       (2, 426, 1, 'Female', 'she/they', '1994-02-10', 2, 'Beginner', 'Female', 'Ross', '07656765455', 'None',
        '07805925657', 'English / Welsh / Scottish / Northern Irish / British'),
       (3, 425, 1, 'Male', 'he/her', '1996-01-29', 2, 'Advanced', 'Male', 'Chandler', '07656765455', 'Vegan',
        '07805925659', 'English / Welsh / Scottish / Northern Irish / British'),
       (4, 424, 0, 'Male', 'he/them', '1999-02-10', 1, 'Beginner', 'Male', 'Monica', '07656765455', 'Halal',
        '07805936373', 'English / Welsh / Scottish / Northern Irish / British'),
       (5, 422, 0, 'Male', 'she/her', '1998-02-10', 1, 'Intermediate', 'Male', 'Joey', '07656765455', 'Kosher',
        '07805925689', 'English / Welsh / Scottish / Northern Irish / British'),
       (6, 423, 0, 'Female', 'she/he', '1998-02-10', 1, 'Intermediate', 'Female', 'Phoebe', '07656765455', 'Vegan',
        '07805925651', 'English / Welsh / Scottish / Northern Irish / British'),
       (7, 421, 1, 'Male', 'he/him', '1992-01-01', 1, 'Intermediate', 'Male', 'Janice', '07656765455', 'None',
        '07123456789', 'Irish');


DROP TABLE IF EXISTS `swana_swa_membership`;
CREATE TABLE `swana_swa_membership`
(
    `member_id` int(11) NOT NULL,
    `season_id` int(11) NOT NULL,
    PRIMARY KEY (`member_id`, `season_id`),
    KEY `fk_membership_member_idx` (`member_id`),
    KEY `fk_membership_season_idx` (`season_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_qualification`;
CREATE TABLE `swana_swa_qualification`
(
    `id`          int(11)     NOT NULL AUTO_INCREMENT,
    `member_id`   int(11)     NOT NULL,
    `type`        varchar(50) NOT NULL,
    `expiry_date` date        NOT NULL,
    `file`        mediumblob  NOT NULL,
    `file_type`   varchar(50) NOT NULL,
    `approved`    tinyint(1)  NOT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_qualification_member_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_season`;
CREATE TABLE `swana_swa_season`
(
    `id`   int(11)    NOT NULL AUTO_INCREMENT,
    `year` varchar(7) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `year_UNIQUE` (`year`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_season` (`id`, `year`)
VALUES (11, '2011/12'),
       (12, '2012/13'),
       (13, '2013/14'),
       (14, '2014/15'),
       (15, '2015/16'),
       (16, '2016/17'),
       (17, '2017/18'),
       (18, '2018/19'),
       (19, '2019/20'),
       (20, '2020/21');

DROP TABLE IF EXISTS `swana_swa_team_result`;
CREATE TABLE `swana_swa_team_result`
(
    `id`             int(11) NOT NULL AUTO_INCREMENT,
    `competition_id` int(11) NOT NULL,
    `university_id`  int(11) NOT NULL,
    `team_number`    int(11) NOT NULL DEFAULT '1',
    `result`         int(11)          DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `fk_team_result_competition1_idx` (`competition_id`),
    KEY `fk_team_result_university1_idx` (`university_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


DROP TABLE IF EXISTS `swana_swa_ticket`;
CREATE TABLE `swana_swa_ticket`
(
    `id`              int(11)       NOT NULL AUTO_INCREMENT,
    `member_id`       int(11)       NOT NULL,
    `event_ticket_id` int(11)       NOT NULL,
    `paid`            decimal(6, 2) NOT NULL,
    `details`         text,
    PRIMARY KEY (`id`),
    KEY `fk_ticket_event_ticket1_idx` (`event_ticket_id`),
    KEY `fk_ticket_member1_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_ticket` (`id`, `member_id`, `event_ticket_id`, `paid`, `details`)
VALUES (1, 6, 2, 0.00, '{\"addons\":[]}'),
       (2, 5, 1, 0.00, '{\"addons\":[]}'),
		(3, 4, 3, 0.00, '\"addons\":{\"T-Shirt\":{\"qty\":1,\"price\":5,\"option\":\"S\"}}}'),
		(4, 2, 1, 0.00, '{\"addons\":[]}'),
		(5, 2, 2, 0.00, '{\"addons\":[]}'),
		(6, 4, 3, 0.00, '{\"addons\":[]}'),
		(7, 3, 2, 0.00, '\"addons\":{\"T-Shirt\":{\"qty\":1,\"price\":5,\"option\":\"L\"}}}'),
		(8, 6, 1, 0.00, '{\"addons\":[]}');

DROP TABLE IF EXISTS `swana_swa_university`;
CREATE TABLE `swana_swa_university`
(
	`id`                    int(11)      NOT NULL AUTO_INCREMENT,
	`name`                  varchar(200) NOT NULL,
	`url`                   varchar(200) DEFAULT NULL,
	`au_address`            varchar(200) DEFAULT NULL,
	`au_additional_address` varchar(200) DEFAULT NULL,
	`au_postcode`           varchar(10)  DEFAULT NULL,
	`club_email_1`          varchar(100) DEFAULT NULL,
	`club_email_2`          varchar(100) DEFAULT NULL,
	`club_contact_name`     varchar(100) DEFAULT NULL,
	`club_contact_method`   varchar(25)  DEFAULT NULL,
	`club_contact_value`    varchar(100) DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_university` (`id`, `name`, `url`, `au_address`, `au_additional_address`, `au_postcode`,
									`club_email_1`, `club_email_2`, `club_contact_name`, `club_contact_method`,
									`club_contact_value`)
VALUES (1, 'University1', '', 'Ex quia quia ut tota', 'Fugit in ea qui odi', 'Et laborum', 'rylaqygov@mailinator.com',
		'qokenu@mailinator.com', 'Hayfa Black', 'Email', 'jehuwe'),
	   (2, 'University2', '', 'testaddress', '', 'testcode', 'testmail@mail.com', 'testmail@mail.com', 'testname',
		'SMS', '999');

DROP TABLE IF EXISTS `swana_swa_university_member`;
CREATE TABLE `swana_swa_university_member`
(
	`id`            int(11)     NOT NULL AUTO_INCREMENT,
	`member_id`     int(11)     NOT NULL,
	`university_id` int(11)     NOT NULL,
	`committee`     varchar(15) NOT NULL DEFAULT '0',
	`graduated`     tinyint(1)  NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE KEY `unique_member_id_university_id` (`member_id`, `university_id`),
	KEY `fk_university_member_member_idx` (`member_id`),
	KEY `fk_university_member_university_idx` (`member_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `swana_swa_university_member` (`id`, `member_id`, `university_id`, `committee`, `graduated`)
VALUES (1, 6, 1, '0', 0),
	   (2, 5, 1, '0', 0),
	   (3, 4, 1, '0', 1),
	   (4, 3, 2, '0', 0),
	   (5, 1, 1, 'Committee', 0),
	   (6, 2, 2, '0', 0),
	   (7, 7, 1, '0', 0);

INSERT INTO `swana_users` (`id`, `name`, `username`, `email`, `password`, `block`, `sendEmail`, `registerDate`,
						   `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`, `otpKey`, `otep`,
						   `requireReset`)
VALUES (421, 'Super User', 'swa_admin', 'info@swa.co.uk', '$2y$10$ZcjQVdxj30o8EVYCoEd0Zu4xL2do7p7MOHLRTYAUgejQidlLEnR9u', 0,
		1, '2019-02-10 14:19:02', '2019-02-10 15:15:36', '0', '', '0000-00-00 00:00:00', 0, '', '', 0),
	   (422, 'John Smith', 'johnsmith', 'js@example.com',
		'$2y$10$tWZiATb/7e0zB9wuKvzOleNhKV5eVt/MapmthW4GEGnwg5eTEVCTS', 0, 0, '2019-02-10 15:24:48',
		'0000-00-00 00:00:00', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0),
	   (423, 'Jane Smith', 'janesmith', 'jane@example.com',
		'$2y$10$y0bhBEzBJIbyjqfFCpCybOw.3rmxRrttYkOhfXoEYG2thGRvb3vI2', 0, 0, '2019-02-10 15:25:57',
		'0000-00-00 00:00:00', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0),
	   (424, 'Mark Thompson', 'mthomp', 'mt@example.com',
		'$2y$10$8eSvR3CI7gILJbBLH/1pPeJtd1bEzVleV.ghvDP0mR/7MLChE5THe', 0, 0, '2019-02-10 15:27:00',
		'0000-00-00 00:00:00', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0),
	   (425, 'Ben Dover', 'bendover', 'bd@example.com', '$2y$10$B94OF41ggtE7RkAVXS65O..OUAyrqD6EP9j89DXoPnw8D1qwE38vS',
		0, 0, '2019-02-10 15:28:41', '0000-00-00 00:00:00', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0),
	   (426, 'Example SWA Committee person', 'swacom', 'com@example.com',
		'$2y$10$Wi7Iv3csPRy73dvzLiRPfeDLsh6lowxzk3yaMMOf2pvOBfAiejkmC', 0, 0, '2019-02-10 15:29:21',
		'0000-00-00 00:00:00', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0),
	   (427, 'Uni Committee Person', 'unicom', 'unicom@example.com',
		'$2y$10$doyHhJ.imnpWo6zzDISnTu0vr9IK4X/GaxAGRDqD8mB.csTbfp4Eq', 0, 0, '2019-02-10 15:30:37',
		'2019-02-10 15:53:29', '',
		'{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}',
		'0000-00-00 00:00:00', 0, '', '', 0);


INSERT INTO `swana_user_usergroup_map` (`user_id`, `group_id`)
VALUES (421, 8),
	   (422, 2),
	   (423, 2),
	   (424, 2),
	   (425, 2),
	   (426, 2),
	   (427, 2);


DROP TABLE IF EXISTS `swana_viewlevels`;
CREATE TABLE `swana_viewlevels`
(
	`id`       int(10) unsigned                         NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`title`    varchar(100) COLLATE utf8mb4_unicode_ci  NOT NULL DEFAULT '',
	`ordering` int(11)                                  NOT NULL DEFAULT '0',
	`rules`    varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'JSON encoded access control.',
	PRIMARY KEY (`id`),
	UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `swana_viewlevels` (`id`, `title`, `ordering`, `rules`)
VALUES (1, 'Public', 0, '[1]'),
	   (2, 'Registered', 2, '[6,2,8]'),
	   (3, 'Special', 3, '[6,3,8]'),
	   (5, 'Guest', 1, '[9]'),
	   (6, 'Super Users', 4, '[8]'),
	   (7, 'Club Committee', 0, '[]'),
	   (8, 'Org Committee', 0, '[]');

-- 2019-02-10 17:17:48


DROP TABLE IF EXISTS `swana_university_agreements`;
CREATE TABLE `swana_university_agreements`
(
	`id`            int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`signed`        BIT     NOT NULL DEFAULT 0,
	`date`          DATE,
	`university_id` int(11),
	`member_id`     int(11) COLLATE utf8mb4_unicode_ci,
	`override`      TINYINT NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;


INSERT INTO `swana_university_agreements` (`id`, `signed`, `date`, `university_id`, `member_id`, `override`)
VALUES (1, 0, NULL, NULL, NULL, 0),
	   (2, 1, '2019-02-10', 9, 1, 0);


-- `signed`
-- --'Whether the agreement has been signed'
-- `date`
-- -- 'The date the agreement was last signed'
-- `member_id`
-- -- 'The member that signed the agreement',
-- override, the values this takes mean; 0=nothing, 1=give access, 2=remove access
