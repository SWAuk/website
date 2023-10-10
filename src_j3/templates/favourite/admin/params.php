<?php

/**
*   Favourite
*
*   Responsive and customizable Joomla!3 template by FAVTHEMES
*
*   @version        4.1
*   @link           http://demo.favthemes.com/favourite
*   @author         FavThemes - https://www.favthemes.com
*   @copyright      Copyright (C) 2012-2017 FavThemes.com. All Rights Reserved.
*   @license        Licensed under GNU/GPLv3, see http://www.gnu.org/licenses/gpl-3.0.html
*/

// SETTINGS

$template_styles                     = $this->params->get('template_styles');
$custom_style                        = $this->params->get('custom_style');

$max_width                           = $this->params->get('max_width');

$show_copyright                      = $this->params->get('show_copyright');
$copyright_text                      = $this->params->get('copyright_text');
$copyright_text_link                 = $this->params->get('copyright_text_link');

$nav_font_size                       = $this->params->get('nav_font_size');
$nav_text_transform                  = $this->params->get('nav_text_transform');
$nav_link_padding                    = $this->params->get('nav_link_padding');
$nav_icons_color                     = $this->params->get('nav_icons_color');
$nav_icons_font_size                 = $this->params->get('nav_icons_font_size');

$nav_google_font                     = $this->params->get('nav_google_font');
$nav_google_font_weight              = $this->params->get('nav_google_font_weight');
$nav_google_font_style               = $this->params->get('nav_google_font_style');
$titles_google_font                  = $this->params->get('titles_google_font');
$titles_google_font_weight           = $this->params->get('titles_google_font_weight');
$titles_google_font_style            = $this->params->get('titles_google_font_style');

$titles_font_size                    = $this->params->get('titles_font_size');
$titles_line_height                  = $this->params->get('titles_line_height');
$titles_text_align                   = $this->params->get('titles_text_align');
$titles_text_transform               = $this->params->get('titles_text_transform');
$module_title_icon_font_size         = $this->params->get('module_title_icon_font_size');
$module_title_icon_padding           = $this->params->get('module_title_icon_padding');
$module_title_icon_border_radius     = $this->params->get('module_title_icon_border_radius');

$error_page_article_id               = $this->params->get('error_page_article_id');

$offline_page_style                  = $this->params->get('offline_page_style');
$offline_page_bg_image               = $this->params->get('offline_page_bg_image');
$offline_page_bg_image_style         = $this->params->get('offline_page_bg_image_style');

$show_back_to_top                    = $this->params->get('show_back_to_top');
$back_to_top_style_color             = $this->params->get('back_to_top_style_color');
$back_to_top_text                    = $this->params->get('back_to_top_text');


// LAYOUT

$body_bg_image                       = $this->params->get('body_bg_image');
$body_bg_image_style                 = $this->params->get('body_bg_image_style');
$body_bg_image_overlay               = $this->params->get('body_bg_image_overlay');
$body_bg_color                       = $this->params->get('body_bg_color');
$body_color                          = $this->params->get('body_color');
$body_title_color                    = $this->params->get('body_title_color');
$body_link_color                     = $this->params->get('body_link_color');
$body_link_hover_color               = $this->params->get('body_link_hover_color');

$notice_bg_style                     = $this->params->get('notice_bg_style');
$notice_bg_color                     = $this->params->get('notice_bg_color');
$notice_color                        = $this->params->get('notice_color');
$notice_title_color                  = $this->params->get('notice_title_color');
$notice_link_color                   = $this->params->get('notice_link_color');
$notice_link_hover_color             = $this->params->get('notice_link_hover_color');

$topbar_bg_style                     = $this->params->get('topbar_bg_style');
$topbar_bg_image                     = $this->params->get('topbar_bg_image');
$topbar_bg_image_style               = $this->params->get('topbar_bg_image_style');
$topbar_bg_image_overlay             = $this->params->get('topbar_bg_image_overlay');
$topbar_bg_color                     = $this->params->get('topbar_bg_color');
$topbar_color                        = $this->params->get('topbar_color');
$topbar_title_color                  = $this->params->get('topbar_title_color');
$topbar_link_color                   = $this->params->get('topbar_link_color');
$topbar_link_hover_color             = $this->params->get('topbar_link_hover_color');

$slide_width                         = $this->params->get('slide_width');
$slide_bg_style                      = $this->params->get('slide_bg_style');
$slide_bg_image                      = $this->params->get('slide_bg_image');
$slide_bg_image_style                = $this->params->get('slide_bg_image_style');
$slide_bg_image_overlay              = $this->params->get('slide_bg_image_overlay');
$slide_bg_color                      = $this->params->get('slide_bg_color');
$slide_color                         = $this->params->get('slide_color');
$slide_title_color                   = $this->params->get('slide_title_color');
$slide_link_color                    = $this->params->get('slide_link_color');
$slide_link_hover_color              = $this->params->get('slide_link_hover_color');

$intro_bg_style                      = $this->params->get('intro_bg_style');
$intro_bg_image                      = $this->params->get('intro_bg_image');
$intro_bg_image_style                = $this->params->get('intro_bg_image_style');
$intro_bg_image_overlay              = $this->params->get('intro_bg_image_overlay');
$intro_bg_color                      = $this->params->get('intro_bg_color');
$intro_color                         = $this->params->get('intro_color');
$intro_title_color                   = $this->params->get('intro_title_color');
$intro_link_color                    = $this->params->get('intro_link_color');
$intro_link_hover_color              = $this->params->get('intro_link_hover_color');

$breadcrumbs_bg_style                = $this->params->get('breadcrumbs_bg_style');
$breadcrumbs_bg_image                = $this->params->get('breadcrumbs_bg_image');
$breadcrumbs_bg_image_style          = $this->params->get('breadcrumbs_bg_image_style');
$breadcrumbs_bg_image_overlay        = $this->params->get('breadcrumbs_bg_image_overlay');
$breadcrumbs_bg_color                = $this->params->get('breadcrumbs_bg_color');
$breadcrumbs_color                   = $this->params->get('breadcrumbs_color');
$breadcrumbs_title_color             = $this->params->get('breadcrumbs_title_color');
$breadcrumbs_link_color              = $this->params->get('breadcrumbs_link_color');
$breadcrumbs_link_hover_color        = $this->params->get('breadcrumbs_link_hover_color');

$lead_bg_style                       = $this->params->get('lead_bg_style');
$lead_bg_image                       = $this->params->get('lead_bg_image');
$lead_bg_image_style                 = $this->params->get('lead_bg_image_style');
$lead_bg_image_overlay               = $this->params->get('lead_bg_image_overlay');
$lead_bg_color                       = $this->params->get('lead_bg_color');
$lead_color                          = $this->params->get('lead_color');
$lead_title_color                    = $this->params->get('lead_title_color');
$lead_link_color                     = $this->params->get('lead_link_color');
$lead_link_hover_color               = $this->params->get('lead_link_hover_color');

$promo_bg_style                      = $this->params->get('promo_bg_style');
$promo_bg_image                      = $this->params->get('promo_bg_image');
$promo_bg_image_style                = $this->params->get('promo_bg_image_style');
$promo_bg_image_overlay              = $this->params->get('promo_bg_image_overlay');
$promo_bg_color                      = $this->params->get('promo_bg_color');
$promo_color                         = $this->params->get('promo_color');
$promo_title_color                   = $this->params->get('promo_title_color');
$promo_link_color                    = $this->params->get('promo_link_color');
$promo_link_hover_color              = $this->params->get('promo_link_hover_color');

$prime_bg_style                      = $this->params->get('prime_bg_style');
$prime_bg_image                      = $this->params->get('prime_bg_image');
$prime_bg_image_style                = $this->params->get('prime_bg_image_style');
$prime_bg_image_overlay              = $this->params->get('prime_bg_image_overlay');
$prime_bg_color                      = $this->params->get('prime_bg_color');
$prime_color                         = $this->params->get('prime_color');
$prime_title_color                   = $this->params->get('prime_title_color');
$prime_link_color                    = $this->params->get('prime_link_color');
$prime_link_hover_color              = $this->params->get('prime_link_hover_color');

$showcase_bg_style                   = $this->params->get('showcase_bg_style');
$showcase_bg_image                   = $this->params->get('showcase_bg_image');
$showcase_bg_image_style             = $this->params->get('showcase_bg_image_style');
$showcase_bg_image_overlay           = $this->params->get('showcase_bg_image_overlay');
$showcase_bg_color                   = $this->params->get('showcase_bg_color');
$showcase_color                      = $this->params->get('showcase_color');
$showcase_title_color                = $this->params->get('showcase_title_color');
$showcase_link_color                 = $this->params->get('showcase_link_color');
$showcase_link_hover_color           = $this->params->get('showcase_link_hover_color');

$feature_bg_style                    = $this->params->get('feature_bg_style');
$feature_bg_image                    = $this->params->get('feature_bg_image');
$feature_bg_image_style              = $this->params->get('feature_bg_image_style');
$feature_bg_image_overlay            = $this->params->get('feature_bg_image_overlay');
$feature_bg_color                    = $this->params->get('feature_bg_color');
$feature_color                       = $this->params->get('feature_color');
$feature_title_color                 = $this->params->get('feature_title_color');
$feature_link_color                  = $this->params->get('feature_link_color');
$feature_link_hover_color            = $this->params->get('feature_link_hover_color');

$focus_bg_style                      = $this->params->get('focus_bg_style');
$focus_bg_image                      = $this->params->get('focus_bg_image');
$focus_bg_image_style                = $this->params->get('focus_bg_image_style');
$focus_bg_image_overlay              = $this->params->get('focus_bg_image_overlay');
$focus_bg_color                      = $this->params->get('focus_bg_color');
$focus_color                         = $this->params->get('focus_color');
$focus_title_color                   = $this->params->get('focus_title_color');
$focus_link_color                    = $this->params->get('focus_link_color');
$focus_link_hover_color              = $this->params->get('focus_link_hover_color');

$portfolio_bg_style                  = $this->params->get('portfolio_bg_style');
$portfolio_bg_image                  = $this->params->get('portfolio_bg_image');
$portfolio_bg_image_style            = $this->params->get('portfolio_bg_image_style');
$portfolio_bg_image_overlay          = $this->params->get('portfolio_bg_image_overlay');
$portfolio_bg_color                  = $this->params->get('portfolio_bg_color');
$portfolio_color                     = $this->params->get('portfolio_color');
$portfolio_title_color               = $this->params->get('portfolio_title_color');
$portfolio_link_color                = $this->params->get('portfolio_link_color');
$portfolio_link_hover_color          = $this->params->get('portfolio_link_hover_color');

$screen_bg_style                     = $this->params->get('screen_bg_style');
$screen_bg_image                     = $this->params->get('screen_bg_image');
$screen_bg_image_style               = $this->params->get('screen_bg_image_style');
$screen_bg_image_overlay             = $this->params->get('screen_bg_image_overlay');
$screen_bg_color                     = $this->params->get('screen_bg_color');
$screen_color                        = $this->params->get('screen_color');
$screen_title_color                  = $this->params->get('screen_title_color');
$screen_link_color                   = $this->params->get('screen_link_color');
$screen_link_hover_color             = $this->params->get('screen_link_hover_color');

$top_bg_style                        = $this->params->get('top_bg_style');
$top_bg_image                        = $this->params->get('top_bg_image');
$top_bg_image_style                  = $this->params->get('top_bg_image_style');
$top_bg_image_overlay                = $this->params->get('top_bg_image_overlay');
$top_bg_color                        = $this->params->get('top_bg_color');
$top_color                           = $this->params->get('top_color');
$top_title_color                     = $this->params->get('top_title_color');
$top_link_color                      = $this->params->get('top_link_color');
$top_link_hover_color                = $this->params->get('top_link_hover_color');

$maintop_bg_style                    = $this->params->get('maintop_bg_style');
$maintop_bg_image                    = $this->params->get('maintop_bg_image');
$maintop_bg_image_style              = $this->params->get('maintop_bg_image_style');
$maintop_bg_image_overlay            = $this->params->get('maintop_bg_image_overlay');
$maintop_bg_color                    = $this->params->get('maintop_bg_color');
$maintop_color                       = $this->params->get('maintop_color');
$maintop_title_color                 = $this->params->get('maintop_title_color');
$maintop_link_color                  = $this->params->get('maintop_link_color');
$maintop_link_hover_color            = $this->params->get('maintop_link_hover_color');

$mainbottom_bg_style                 = $this->params->get('mainbottom_bg_style');
$mainbottom_bg_image                 = $this->params->get('mainbottom_bg_image');
$mainbottom_bg_image_style           = $this->params->get('mainbottom_bg_image_style');
$mainbottom_bg_image_overlay         = $this->params->get('mainbottom_bg_image_overlay');
$mainbottom_bg_color                 = $this->params->get('mainbottom_bg_color');
$mainbottom_color                    = $this->params->get('mainbottom_color');
$mainbottom_title_color              = $this->params->get('mainbottom_title_color');
$mainbottom_link_color               = $this->params->get('mainbottom_link_color');
$mainbottom_link_hover_color         = $this->params->get('mainbottom_link_hover_color');

$bottom_bg_style                     = $this->params->get('bottom_bg_style');
$bottom_bg_image                     = $this->params->get('bottom_bg_image');
$bottom_bg_image_style               = $this->params->get('bottom_bg_image_style');
$bottom_bg_image_overlay             = $this->params->get('bottom_bg_image_overlay');
$bottom_bg_color                     = $this->params->get('bottom_bg_color');
$bottom_color                        = $this->params->get('bottom_color');
$bottom_title_color                  = $this->params->get('bottom_title_color');
$bottom_link_color                   = $this->params->get('bottom_link_color');
$bottom_link_hover_color             = $this->params->get('bottom_link_hover_color');

$note_bg_style                       = $this->params->get('note_bg_style');
$note_bg_image                       = $this->params->get('note_bg_image');
$note_bg_image_style                 = $this->params->get('note_bg_image_style');
$note_bg_image_overlay               = $this->params->get('note_bg_image_overlay');
$note_bg_color                       = $this->params->get('note_bg_color');
$note_color                          = $this->params->get('note_color');
$note_title_color                    = $this->params->get('note_title_color');
$note_link_color                     = $this->params->get('note_link_color');
$note_link_hover_color               = $this->params->get('note_link_hover_color');

$base_bg_style                       = $this->params->get('base_bg_style');
$base_bg_image                       = $this->params->get('base_bg_image');
$base_bg_image_style                 = $this->params->get('base_bg_image_style');
$base_bg_image_overlay               = $this->params->get('base_bg_image_overlay');
$base_bg_color                       = $this->params->get('base_bg_color');
$base_color                          = $this->params->get('base_color');
$base_title_color                    = $this->params->get('base_title_color');
$base_link_color                     = $this->params->get('base_link_color');
$base_link_hover_color               = $this->params->get('base_link_hover_color');

$block_bg_style                      = $this->params->get('block_bg_style');
$block_bg_image                      = $this->params->get('block_bg_image');
$block_bg_image_style                = $this->params->get('block_bg_image_style');
$block_bg_image_overlay              = $this->params->get('block_bg_image_overlay');
$block_bg_color                      = $this->params->get('block_bg_color');
$block_color                         = $this->params->get('block_color');
$block_title_color                   = $this->params->get('block_title_color');
$block_link_color                    = $this->params->get('block_link_color');
$block_link_hover_color              = $this->params->get('block_link_hover_color');

$user_bg_style                       = $this->params->get('user_bg_style');
$user_bg_image                       = $this->params->get('user_bg_image');
$user_bg_image_style                 = $this->params->get('user_bg_image_style');
$user_bg_image_overlay               = $this->params->get('user_bg_image_overlay');
$user_bg_color                       = $this->params->get('user_bg_color');
$user_color                          = $this->params->get('user_color');
$user_title_color                    = $this->params->get('user_title_color');
$user_link_color                     = $this->params->get('user_link_color');
$user_link_hover_color               = $this->params->get('user_link_hover_color');

$footer_bg_style                     = $this->params->get('footer_bg_style');
$footer_bg_image                     = $this->params->get('footer_bg_image');
$footer_bg_image_style               = $this->params->get('footer_bg_image_style');
$footer_bg_image_overlay             = $this->params->get('footer_bg_image_overlay');
$footer_bg_color                     = $this->params->get('footer_bg_color');
$footer_color                        = $this->params->get('footer_color');
$footer_title_color                  = $this->params->get('footer_title_color');
$footer_link_color                   = $this->params->get('footer_link_color');
$footer_link_hover_color             = $this->params->get('footer_link_hover_color');


// LOGO

$show_default_logo                   = $this->params->get('show_default_logo');
$default_logo                        = $this->params->get('default_logo');
$default_logo_img_alt                = $this->params->get('default_logo_img_alt');
$default_logo_padding                = $this->params->get('default_logo_padding');
$default_logo_margin                 = $this->params->get('default_logo_margin');
$show_media_logo                     = $this->params->get('show_media_logo');
$media_logo                          = $this->params->get('media_logo');
$media_logo_img_alt                  = $this->params->get('media_logo_img_alt');
$media_logo_padding                  = $this->params->get('media_logo_padding');
$media_logo_margin                   = $this->params->get('media_logo_margin');
$show_text_logo                      = $this->params->get('show_text_logo');
$text_logo                           = $this->params->get('text_logo');
$text_logo_color                     = $this->params->get('text_logo_color');
$text_logo_font_size                 = $this->params->get('text_logo_font_size');
$text_logo_google_font               = $this->params->get('text_logo_google_font');
$text_logo_google_font_weight        = $this->params->get('text_logo_google_font_weight');
$text_logo_google_font_style         = $this->params->get('text_logo_google_font_style');
$text_logo_line_height               = $this->params->get('text_logo_line_height');
$text_logo_padding                   = $this->params->get('text_logo_padding');
$text_logo_margin                    = $this->params->get('text_logo_margin');
$show_slogan                         = $this->params->get('show_slogan');
$slogan                              = $this->params->get('slogan');
$slogan_color                        = $this->params->get('slogan_color');
$slogan_font_size                    = $this->params->get('slogan_font_size');
$slogan_line_height                  = $this->params->get('slogan_line_height');
$slogan_padding                      = $this->params->get('slogan_padding');
$slogan_margin                       = $this->params->get('slogan_margin');
$show_retina_logo                    = $this->params->get('show_retina_logo');
$retina_logo                         = $this->params->get('retina_logo');
$retina_logo_height                  = $this->params->get('retina_logo_height');
$retina_logo_width                   = $this->params->get('retina_logo_width');
$retina_logo_img_alt                 = $this->params->get('retina_logo_img_alt');
$retina_logo_padding                 = $this->params->get('retina_logo_padding');
$retina_logo_margin                  = $this->params->get('retina_logo_margin');


// MOBILE

$mobile_nav_color                    = $this->params->get('mobile_nav_color');
$show_mobile_menu_text               = $this->params->get('show_mobile_menu_text');
$mobile_menu_text                    = $this->params->get('mobile_menu_text');
$mobile_paragraph_font_size          = $this->params->get('mobile_paragraph_font_size');
$mobile_paragraph_line_height        = $this->params->get('mobile_paragraph_line_height');
$mobile_title_font_size              = $this->params->get('mobile_title_font_size');


// ANALYTICS

$analytics_code                      = $this->params->get('analytics_code');

?>


<style type="text/css">

<?php // Custom Style
if ($custom_style) { ?>
  a { color: #<?php echo htmlspecialchars($custom_style); ?>; }
  a:hover, a:focus { color: #111; outline: none; }
  #fav-headerwrap .favnav li.active a,
  #fav-headerwrap .favnav li a:hover,
  #fav-headerwrap .favnav li a:focus,
  #fav-headerwrap .favnav li.active .nav-header,
  #fav-headerwrap .favnav li .nav-header:hover,
  #fav-headerwrap .favnav li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
    background-color: transparent;
  }
  #fav-headerwrap .favnav li a[class^="fa-"]:before,
  #fav-headerwrap .favnav li a[class*=" fa-"]:before,
  #fav-headerwrap .favnav li .nav-header[class^="fa-"]:before,
  #fav-headerwrap .favnav li .nav-header[class*=" fa-"]:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  #fav-headerwrap .favnav .nav-child:before {
    border-right: 7px solid transparent;
    border-bottom: 7px solid #<?php echo htmlspecialchars($custom_style); ?>;
    border-left: 7px solid transparent;
    border-bottom-color: #<?php echo htmlspecialchars($custom_style); ?>;
    content: '';
  }
  #fav-headerwrap .favnav .nav-child:after {
    border-right: 6px solid transparent;
    border-bottom: 6px solid #<?php echo htmlspecialchars($custom_style); ?>;
    border-left: 6px solid transparent;
    content: '';
  }
  #fav-headerwrap .favnav .nav-child li > ul:before {
    border-bottom: 7px solid transparent;
    border-right: 7px solid #<?php echo htmlspecialchars($custom_style); ?>;
    border-top: 7px solid transparent;
  }
  #fav-headerwrap .favnav .nav-child li > ul:after {
    border-top: 6px solid transparent;
    border-right: 6px solid #<?php echo htmlspecialchars($custom_style); ?>;
    border-bottom: 6px solid transparent;
  }
  #fav-headerwrap .favnav .nav-child li a,
  #fav-headerwrap .favnav .nav-child li.active a,
  #fav-headerwrap .favnav .nav-child li a:hover,
  #fav-headerwrap .favnav .nav-child li a:focus,
  #fav-headerwrap .favnav .nav-child li .nav-header,
  #fav-headerwrap .favnav .nav-child li.active .nav-header,
  #fav-headerwrap .favnav .nav-child li .nav-header:hover,
  #fav-headerwrap .favnav .nav-child li .nav-header:focus {
    color: #111;
  }
  #fav-headerwrap .favnav .nav-child li.active > a,
  #fav-headerwrap .favnav .nav-child li a:hover,
  #fav-headerwrap .favnav .nav-child li a:focus,
  #fav-headerwrap .favnav .nav-child li.active .nav-header,
  #fav-headerwrap .favnav .nav-child li .nav-header:hover,
  #fav-headerwrap .favnav .nav-child li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .favnav ul.nav > li.active > a,
  .favnav ul.nav > li > a:hover,
  .favnav ul.nav > li > a:focus,
  .favnav ul.nav > li.active > .nav-header,
  .favnav ul.nav > li > .nav-header:hover,
  .favnav ul.nav > li > .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.menufavth-basic li a:hover,
  ul.menufavth-basic li a:focus,
  ul.menufavth-basic li.current a,
  ul.menufavth-basic li.current ul a:hover,
  ul.menufavth-basic li.current ul a:focus,
  ul.menufavth-basic li .nav-header:hover,
  ul.menufavth-basic li .nav-header:focus,
  ul.menufavth-basic li.current .nav-header,
  ul.menufavth-basic li.current ul .nav-header:hover,
  ul.menufavth-basic li.current ul .nav-header:focus {
    color: #fff;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.menufavth-arrow li a:hover,
  ul.menufavth-arrow li a:focus,
  ul.menufavth-arrow li.current a,
  ul.menufavth-arrow li.current ul a:hover,
  ul.menufavth-arrow li.current ul a:focus,
  ul.menufavth-arrow li .nav-header:hover,
  ul.menufavth-arrow li .nav-header:focus,
  ul.menufavth-arrow li.current .nav-header,
  ul.menufavth-arrow li.current ul .nav-header:hover,
  ul.menufavth-arrow li.current ul .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
    background-color: transparent;
  }
  ul.menufavth-arrow li a:hover:before,
  ul.menufavth-arrow li a:focus:before,
  ul.menufavth-arrow li.current a:before,
  ul.menufavth-arrow li.current ul a:hover:before,
  ul.menufavth-arrow li.current ul a:focus:before,
  ul.menufavth-arrow li .nav-header:hover:before,
  ul.menufavth-arrow li .nav-header:focus:before,
  ul.menufavth-arrow li.current .nav-header:before,
  ul.menufavth-arrow li.current ul .nav-header:hover:before,
  ul.menufavth-arrow li.current ul .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.menufavth-side li a:hover,
  ul.menufavth-side li a:focus,
  ul.menufavth-side li.current a,
  ul.menufavth-side li.current ul a:hover,
  ul.menufavth-side li.current ul a:focus,
  ul.menufavth-side li .nav-header:hover,
  ul.menufavth-side li .nav-header:focus,
  ul.menufavth-side li.current .nav-header,
  ul.menufavth-side li.current ul .nav-header:hover,
  ul.menufavth-side li.current ul .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
    border-left: 5px solid #<?php echo htmlspecialchars($custom_style); ?>;
    background-color: transparent;
  }
  ul.menufavth-line li a:hover,
  ul.menufavth-line li a:focus,
  ul.menufavth-line li.current a,
  ul.menufavth-line li.current ul a:hover,
  ul.menufavth-line li.current ul a:focus,
  ul.menufavth-line li .nav-header:hover,
  ul.menufavth-line li .nav-header:focus,
  ul.menufavth-line li.current .nav-header,
  ul.menufavth-line li.current ul .nav-header:hover,
  ul.menufavth-line li.current ul .nav-header:focus {
    color: #111;
    border-bottom: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
    background-color: transparent;
  }
  ul.menufavth-line li a:hover:before,
  ul.menufavth-line li a:focus:before,
  ul.menufavth-line li.current a:before,
  ul.menufavth-line li.current ul a:hover:before,
  ul.menufavth-line li.current ul a:focus:before,
  ul.menufavth-line li .nav-header:hover:before,
  ul.menufavth-line li .nav-header:focus:before,
  ul.menufavth-line li.current .nav-header:before,
  ul.menufavth-line li.current ul .nav-header:hover:before,
  ul.menufavth-line li.current ul .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.menufavth-horizontal li.active a,
  ul.menufavth-horizontal li a:hover,
  ul.menufavth-horizontal li a:focus,
  ul.menufavth-horizontal li:hover a,
  ul.menufavth-horizontal li:focus a,
  ul.menufavth-horizontal li.active .nav-header,
  ul.menufavth-horizontal li .nav-header:hover,
  ul.menufavth-horizontal li .nav-header:focus,
  ul.menufavth-horizontal li:hover .nav-header,
  ul.menufavth-horizontal li:focus .nav-header,
  ul.menufavth-horizontal li .nav-header:hover,
  ul.menufavth-horizontal li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-clear ul.menufavth-horizontal li.active a,
  .fav-module-block-clear ul.menufavth-horizontal li a:hover,
  .fav-module-block-clear ul.menufavth-horizontal li a:focus,
  .fav-module-block-clear ul.menufavth-horizontal li:hover a,
  .fav-module-block-clear ul.menufavth-horizontal li:focus a,
  .fav-module-block-clear ul.menufavth-horizontal li.active .nav-header,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:hover,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:focus,
  .fav-module-block-clear ul.menufavth-horizontal li:hover .nav-header,
  .fav-module-block-clear ul.menufavth-horizontal li:focus .nav-header,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:hover,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-clear ul.menufavth-horizontal li.active a,
  .moduletable.favth-clear ul.menufavth-horizontal li a:hover,
  .moduletable.favth-clear ul.menufavth-horizontal li a:focus,
  .moduletable.favth-clear ul.menufavth-horizontal li:hover a,
  .moduletable.favth-clear ul.menufavth-horizontal li:focus a,
  .moduletable.favth-clear ul.menufavth-horizontal li.active .nav-header,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:hover,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:focus,
  .moduletable.favth-clear ul.menufavth-horizontal li:hover .nav-header,
  .moduletable.favth-clear ul.menufavth-horizontal li:focus .nav-header,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:hover,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-clear ul.menufavth-horizontal li.active a:before,
  .fav-module-block-clear ul.menufavth-horizontal li a:hover:before,
  .fav-module-block-clear ul.menufavth-horizontal li a:focus:before,
  .fav-module-block-clear ul.menufavth-horizontal li:hover a:before,
  .fav-module-block-clear ul.menufavth-horizontal li:focus a:before,
  .fav-module-block-clear ul.menufavth-horizontal li.active .nav-header:before,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:hover:before,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:focus:before,
  .fav-module-block-clear ul.menufavth-horizontal li:hover .nav-header:before,
  .fav-module-block-clear ul.menufavth-horizontal li:focus .nav-header:before,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:hover:before,
  .fav-module-block-clear ul.menufavth-horizontal li .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-clear ul.menufavth-horizontal li.active a:before,
  .moduletable.favth-clear ul.menufavth-horizontal li a:hover:before,
  .moduletable.favth-clear ul.menufavth-horizontal li a:focus:before,
  .moduletable.favth-clear ul.menufavth-horizontal li:hover a:before,
  .moduletable.favth-clear ul.menufavth-horizontal li:focus a:before,
  .moduletable.favth-clear ul.menufavth-horizontal li.active .nav-header:before,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:hover:before,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:focus:before,
  .moduletable.favth-clear ul.menufavth-horizontal li:hover .nav-header:before,
  .moduletable.favth-clear ul.menufavth-horizontal li:focus .nav-header:before,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:hover:before,
  .moduletable.favth-clear ul.menufavth-horizontal li .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-dark ul.menufavth-horizontal li.active a,
  .fav-module-block-dark ul.menufavth-horizontal li a:hover,
  .fav-module-block-dark ul.menufavth-horizontal li a:focus,
  .fav-module-block-dark ul.menufavth-horizontal li:hover a,
  .fav-module-block-dark ul.menufavth-horizontal li:focus a,
  .fav-module-block-dark ul.menufavth-horizontal li.active .nav-header,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:hover,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:focus,
  .fav-module-block-dark ul.menufavth-horizontal li:hover .nav-header,
  .fav-module-block-dark ul.menufavth-horizontal li:focus .nav-header,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:hover,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-dark ul.menufavth-horizontal li.active a,
  .moduletable.favth-dark ul.menufavth-horizontal li a:hover,
  .moduletable.favth-dark ul.menufavth-horizontal li a:focus,
  .moduletable.favth-dark ul.menufavth-horizontal li:hover a,
  .moduletable.favth-dark ul.menufavth-horizontal li:focus a,
  .moduletable.favth-dark ul.menufavth-horizontal li.active .nav-header,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:hover,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:focus,
  .moduletable.favth-dark ul.menufavth-horizontal li:hover .nav-header,
  .moduletable.favth-dark ul.menufavth-horizontal li:focus .nav-header,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:hover,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-dark ul.menufavth-horizontal li.active a:before,
  .fav-module-block-dark ul.menufavth-horizontal li a:hover:before,
  .fav-module-block-dark ul.menufavth-horizontal li a:focus:before,
  .fav-module-block-dark ul.menufavth-horizontal li:hover a:before,
  .fav-module-block-dark ul.menufavth-horizontal li:focus a:before,
  .fav-module-block-dark ul.menufavth-horizontal li.active .nav-header:before,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:hover:before,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:focus:before,
  .fav-module-block-dark ul.menufavth-horizontal li:hover .nav-header:before,
  .fav-module-block-dark ul.menufavth-horizontal li:focus .nav-header:before,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:hover:before,
  .fav-module-block-dark ul.menufavth-horizontal li .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-dark ul.menufavth-horizontal li.active a:before,
  .moduletable.favth-dark ul.menufavth-horizontal li a:hover:before,
  .moduletable.favth-dark ul.menufavth-horizontal li a:focus:before,
  .moduletable.favth-dark ul.menufavth-horizontal li:hover a:before,
  .moduletable.favth-dark ul.menufavth-horizontal li:focus a:before,
  .moduletable.favth-dark ul.menufavth-horizontal li.active .nav-header:before,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:hover:before,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:focus:before,
  .moduletable.favth-dark ul.menufavth-horizontal li:hover .nav-header:before,
  .moduletable.favth-dark ul.menufavth-horizontal li:focus .nav-header:before,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:hover:before,
  .moduletable.favth-dark ul.menufavth-horizontal li .nav-header:focus:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-clear a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-clear a:hover,
  .fav-module-block-clear a:focus {
    color: #fff;
  }
  .fav-module-block-dark a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-module-block-dark a:hover,
  .fav-module-block-dark a:focus {
    color: #fff;
  }
  .fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  #fav-backtop .btn:hover,
  #fav-backtop .btn:focus {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-container h1 a:hover,
  .fav-container h2 a:hover,
  .fav-container h3 a:hover,
  .fav-container h4 a:hover,
  .fav-container h5 a:hover,
  .fav-container h6 a:hover {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
    text-decoration: none;
  }
  .fav-container h3:first-of-type [class^="fa fa-"],
  .fav-container h3:first-of-type [class*=" fa fa-"] {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  .fav-container .favth-btn,
  .fav-container .btn,
  .fav-container .btn-primary,
  .fav-container .pager .next a,
  .fav-container .pager .previous a,
  .fav-container .hikabtn {
    color: #fff;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-container .favth-btn:hover,
  .fav-container .favth-btn:focus,
  .favth-btn:active,
  .favth-btn.favth-active,
  .fav-container .btn:hover,
  .fav-container .btn:focus,
  .fav-container .btn:active,
  .fav-container .btn.active,
  .fav-container .btn-primary:hover,
  .fav-container .btn-primary:focus,
  .fav-container .btn-primary:active,
  .fav-container .btn-primary.active,
  .fav-container .pager .next a:hover,
  .fav-container .pager .previous a:hover,
  .fav-container .pager .next a:focus,
  .fav-container .pager .previous a:focus,
  .fav-container .hikabtn:hover,
  .fav-container .hikabtn:focus {
    color: #fff;
    background-color: #111;
  }
  .fav-container .pagination ul li span {/* active navigation item */
    cursor: default;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
    border: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-container .pagination ul li a:hover,
  .fav-container .pagination ul li a:focus,
  .fav-container .pagination ul li.pagination-start a:hover,
  .fav-container .pagination ul li.pagination-prev a:hover,
  .fav-container .pagination ul li.pagination-next a:hover,
  .fav-container .pagination ul li.pagination-end a:hover,
  .fav-container .pagination ul li.pagination-start a:focus,
  .fav-container .pagination ul li.pagination-prev a:focus,
  .fav-container .pagination ul li.pagination-next a:focus,
  .fav-container .pagination ul li.pagination-end a:focus {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
    border: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-container .hikashop_products_pagination .list-footer span.pagenav,
  .fav-container .hikashop_subcategories_pagination .list-footer span.pagenav {/* active navigation item */
    cursor: default;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
    border: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .fav-container .hikashop_products_pagination .list-footer a.pagenav:hover,
  .fav-container .hikashop_products_pagination .list-footer a.pagenav:focus {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
    border: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-light a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-dark a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-clear a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-color {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  .moduletable.favth-color > h3:first-of-type [class^="fa-"],
  .moduletable.favth-color > h3:first-of-type [class*=" fa-"] {
    background-color: #fff;
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-title-line > h3:first-of-type:after {
    border-bottom: 3px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-title-border > h3:first-of-type {
    border-bottom: 1px solid #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-title-symbol > h3:first-of-type:after {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-title-plus > h3:first-of-type:after {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .moduletable.favth-icon-light > h3:first-of-type [class^="fa fa-"],
  .moduletable.favth-icon-light > h3:first-of-type [class*=" fa fa-"] {
    background-color: #fff;
    color: #<?php echo htmlspecialchars($custom_style); ?>;
    padding: 9px;
    border: 1px solid #e7e7e7;
  }
  .moduletable.favth-icon-color > h3:first-of-type [class^="fa fa-"],
  .moduletable.favth-icon-color > h3:first-of-type [class*=" fa fa-"] {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  .favnav-styles-demo {
    border: 7px solid #e7e7e7;
    padding-left: 24px;
    padding-right: 24px;
    margin-top: 24px;
  }
  .favnav-styles-demo .favnav {
    float: left;
  }
  .favnav-styles-demo .favnav li a,
  .favnav-styles-demo .favnav li .nav-header {
    color: #111 !important;
  }
  .favnav-styles-demo .favnav li.active a,
  .favnav-styles-demo .favnav li.active .nav-header,
  .favnav-styles-demo .favnav li a:hover,
  .favnav-styles-demo .favnav li a:focus,
  .favnav-styles-demo .favnav li .nav-header:hover,
  .favnav-styles-demo .favnav li .nav-header:focus {
    color: #<?php echo htmlspecialchars($custom_style); ?> !important;
    background-color: transparent;
  }
  .favnav-styles-demo .favnav li a[class^="fa-"]:before,
  .favnav-styles-demo .favnav li a[class*=" fa-"]:before {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  #fav-errorpage .btn {
    color: #fff;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  #fav-errorpage .btn:hover,
  #fav-errorpage .btn:focus,
  #fav-errorpage .btn:active {
    color: #fff;
    background-color: #333;
  }
  blockquote {
    border-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.favth-list-square li:before {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  ol.favth-list-square li:before {
    color: #fff;
    background: none repeat scroll 0% 0% #<?php echo htmlspecialchars($custom_style); ?>;
  }
  ul.favth-list-circle li:before {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  ol.favth-list-circle li:before {
    color: #fff;
    background: none repeat scroll 0% 0% #<?php echo htmlspecialchars($custom_style); ?>;
  }
  div.finder h4.result-title a {
    color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  div.finder h4.result-title a:hover,
  div.finder h4.result-title a:focus {
    color: #333;
  }
  div.profile-edit #member-profile a.btn,
  div.profile-edit #member-profile button.btn.validate {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    color: #fff;
  }
  a.btn.jmodedit {
    color: #fff;
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .badge-info {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .label-primary {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
  }
  .label-primary[href]:hover,
  .label-primary[href]:focus {
    background-color: #<?php echo htmlspecialchars($custom_style); ?>;
    opacity: 0.8;
  }
  .favstyle div[id^="favglyph-box"] i,
  .favstyle div[id*=" favglyph-box"] i {
    color: #<?php echo htmlspecialchars($custom_style); ?> !important;
  }
  .favstyle div[id^="favpromote-box"]:hover,
  .favstyle div[id^="favpromote-box"]:hover,
  .favstyle div[id^="favpromote-box"] h4[id^="favpromote-title"],
  .favstyle div[id^="favpromote-box"] h4[id*=" favpromote-title"] {
    background-color: #<?php echo htmlspecialchars($custom_style); ?> !important;
  }
  .favstyle div[id^="favpromote-box"]:hover h4[id^="favpromote-title"],
  .favstyle div[id^="favpromote-box"]:hover h4[id*=" favpromote-title"],
  .favstyle div[id^="favpromote-box"] h4[id^="favpromote-title"]:hover,
  .favstyle div[id^="favpromote-box"] h4[id*=" favpromote-title"]:hover {
    background-color: #111 !important;
  }
  .favstyle div[id^="favpromote-box"]:hover,
  .favstyle div[id*=" favpromote-box"]:hover {
    background-color: #<?php echo htmlspecialchars($custom_style); ?> !important;
  }
  .favstyle div[id^="favsocial"] a,
  .favstyle div[id*=" favsocial"] a {
    background-color: #<?php echo htmlspecialchars($custom_style); ?> !important;
  }
<?php } ?>
<?php // Maximum Width
if ($max_width) { ?>
  @media (min-width: 1200px) {
    .favth-container,
    #fav-headerwrap.fav-fixed .favth-container-block {
      width: <?php echo htmlspecialchars($max_width); ?>;
    }
  }
<?php } ?>
<?php // Main Navigation Text Transform
if ($nav_text_transform) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header,
  ul.menufavth-horizontal li a,
  ul.menufavth-horizontal li .nav-header {
    text-transform: <?php echo htmlspecialchars($nav_text_transform); ?>;
  }
<?php } ?>
<?php // Main Navigation Font Size
if ($nav_font_size) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header {
    font-size: <?php echo htmlspecialchars($nav_font_size); ?>!important;
  }
<?php } ?>
<?php // Main Navigation Padding
if ($nav_link_padding) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header {
    padding: <?php echo htmlspecialchars($nav_link_padding); ?>!important;
  }
<?php } ?>
<?php // Main Navigation Icon Color
if ($nav_icons_color) { ?>
  .fav-container .favnav li a[class^="fa-"]:before,
  .fav-container .favnav li a[class*=" fa-"]:before,
  .fav-container .favnav li .nav-header[class^="fa-"]:before,
  .fav-container .favnav li .nav-header[class*=" fa-"]:before {
    color: #<?php echo htmlspecialchars($nav_icons_color); ?>!important;
  }
  #fav-headerwrap .favnav .nav-child:before {
    border-right: 7px solid transparent;
    border-bottom: 7px solid #<?php echo htmlspecialchars($nav_icons_color); ?>;
    border-left: 7px solid transparent;
    border-bottom-color: #<?php echo htmlspecialchars($nav_icons_color); ?>;
  }
  #fav-headerwrap .favnav .nav-child:after {
    border-right: 6px solid transparent;
    border-bottom: 6px solid #<?php echo htmlspecialchars($nav_icons_color); ?>;
    border-left: 6px solid transparent;
  }
  #fav-headerwrap .favnav .nav-child li > ul:before {
    border-bottom: 7px solid transparent;
    border-right: 7px solid #<?php echo htmlspecialchars($nav_icons_color); ?>;
    border-top: 7px solid transparent;
  }
  #fav-headerwrap .favnav .nav-child li > ul:after {
    border-top: 6px solid transparent;
    border-right: 6px solid #<?php echo htmlspecialchars($nav_icons_color); ?>;
    border-bottom: 6px solid transparent;
  }
<?php } ?>
<?php // Main Navigation Icon Font Size
if ($nav_icons_font_size) { ?>
  .fav-container .favnav li a[class^="fa-"]:before,
  .fav-container .favnav li a[class*=" fa-"]:before,
  .fav-container .favnav li .nav-header[class^="fa-"]:before,
  .fav-container .favnav li .nav-header[class*=" fa-"]:before {
    font-size: <?php echo htmlspecialchars($nav_icons_font_size); ?>;
  }
<?php } ?>
<?php // Main Navigation Google Font
if ($nav_google_font) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header,
  ul.menufavth-horizontal li a,
  ul.menufavth-horizontal li .nav-header {
    font-family: '<?php echo htmlspecialchars($nav_google_font); ?>', sans-serif;
  }
<?php } ?>
<?php // Main Navigation Google Font Weight
if ($nav_google_font_weight) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header,
  ul.menufavth-horizontal li a,
  ul.menufavth-horizontal li .nav-header {
    font-weight: <?php echo htmlspecialchars($nav_google_font_weight); ?>;
  }
<?php } ?>
<?php // Main Navigation Google Font Style
if ($nav_google_font_style) { ?>
  .favnav ul.nav > li > a,
  .favnav ul.nav > li > .nav-header,
  .favnav ul.nav ul.nav-child a,
  .favnav ul.nav ul.nav-child .nav-header,
  ul.menufavth-horizontal li a,
  ul.menufavth-horizontal li .nav-header {
    font-style: <?php echo htmlspecialchars($nav_google_font_style); ?>;
  }
<?php } ?>
<?php // Titles Font Size
if ($titles_font_size) { ?>
  .fav-container h3:first-of-type,
  .fav-container .page-header h2,
  .fav-container h2.item-title,
  .fav-container .hikashop_product_page h1 {
    font-size: <?php echo htmlspecialchars($titles_font_size); ?>;
  }
<?php } ?>
<?php // Titles Line Height
if ($titles_line_height) { ?>
  .fav-container h3:first-of-type,
  .fav-container .page-header h2,
  .fav-container h2.item-title,
  .fav-container .hikashop_product_page h1 {
    line-height: <?php echo htmlspecialchars($titles_line_height); ?>;
  }
<?php } ?>
<?php // Titles Text Align
if ($titles_text_align) { ?>
  .fav-container h3:first-of-type,
  .fav-container .page-header h2,
  .fav-container h2.item-title,
  .fav-container .hikashop_product_page h1 {
    text-align: <?php echo htmlspecialchars($titles_text_align); ?>;
  }
<?php } ?>
<?php // Titles Text Transform
if ($titles_text_transform) { ?>
  .fav-container h3:first-of-type,
  .fav-container .page-header h2,
  .fav-container h2.item-title,
  .fav-container .hikashop_product_page h1 {
    text-transform: <?php echo htmlspecialchars($titles_text_transform); ?>;
  }
<?php } ?>
<?php // Module Title Icon Font Size
if ($module_title_icon_font_size) { ?>
  .fav-container h3:first-of-type [class^="fa fa-"],
  .fav-container h3:first-of-type [class*=" fa fa-"] {
    font-size: <?php echo htmlspecialchars($module_title_icon_font_size); ?>;
  }
<?php } ?>
<?php // Module Title Icon Padding
if ($module_title_icon_padding) { ?>
  .fav-container h3:first-of-type [class^="fa fa-"],
  .fav-container h3:first-of-type [class*=" fa fa-"] {
    padding: <?php echo htmlspecialchars($module_title_icon_padding); ?>;
  }
<?php } ?>
<?php // Module Title Icon Border Radius
if ($module_title_icon_border_radius) { ?>
  .fav-container h3:first-of-type [class^="fa fa-"],
  .fav-container h3:first-of-type [class*=" fa fa-"] {
    border-radius: <?php echo htmlspecialchars($module_title_icon_border_radius); ?>;
  }
<?php } ?>
<?php // Titles Google Font
if ($titles_google_font) { ?>
  .fav-container h1,
  .fav-container h2,
  .fav-container h3,
  .fav-container h4,
  .fav-container h5,
  .fav-container h6,
  .fav-container legend {
    font-family: '<?php echo htmlspecialchars($titles_google_font); ?>', sans-serif;
  }
<?php } ?>
<?php // Titles Google Font Weight
if ($titles_google_font_weight) { ?>
  .fav-container h1,
  .fav-container h2,
  .fav-container h3,
  .fav-container h4,
  .fav-container h5,
  .fav-container h6,
  .fav-container legend {
    font-weight: <?php echo htmlspecialchars($titles_google_font_weight); ?>;
  }
<?php } ?>
<?php // Titles Google Font Style
if ($titles_google_font_style) { ?>
  .fav-container h1,
  .fav-container h2,
  .fav-container h3,
  .fav-container h4,
  .fav-container h5,
  .fav-container h6,
  .fav-container legend {
    font-style: <?php echo htmlspecialchars($titles_google_font_style); ?>;
  }
<?php } ?>
<?php // Offline Background Image
if ($offline_page_bg_image) { ?>
  #fav-offlinewrap {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($offline_page_bg_image); ?>);
  }
<?php } ?>
<?php // Offline Background Image Style
if ($offline_page_bg_image_style) { ?>
  #fav-offlinewrap {
    background-repeat: <?php echo htmlspecialchars($offline_page_bg_image_style); ?>;
  }
<?php } ?>
<?php // Back to Top Style Color
if ($back_to_top_style_color) { ?>
  #fav-backtop .btn,
  #fav-backtop .btn:hover,
  #fav-backtop .btn:focus {
    background-color: #<?php echo htmlspecialchars($back_to_top_style_color); ?>;
  }
<?php } ?>
<?php // Body Background Image
if ($body_bg_image) { ?>
  body {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($body_bg_image); ?>);
  }
<?php } ?>
<?php // Body Background Image Style
if ($body_bg_image_style) { ?>
  body {
    background-repeat: <?php echo htmlspecialchars($body_bg_image_style); ?>;
  }
<?php } ?>
<?php // Body Background Color
if ($body_bg_color)  { ?>
  body {
    background-color: #<?php echo htmlspecialchars($body_bg_color); ?>;
  }
<?php } ?>
<?php // Body Color
if ($body_color) { ?>
  body p {
    color: #<?php echo htmlspecialchars($body_color); ?>;
  }
<?php } ?>
<?php // Body Title Color
if ($body_title_color) { ?>
  body h3:first-of-type,
  body .page-header h2,
  body h2.item-title {
    color: #<?php echo htmlspecialchars($body_title_color); ?>;
  }
<?php } ?>
<?php // Body Link Color
if ($body_link_color) { ?>
  body a {
    color: #<?php echo htmlspecialchars($body_link_color); ?>;
  }
<?php } ?>
<?php // Body Link Hover Color
if ($body_link_hover_color) { ?>
  body a:hover {
    color: #<?php echo htmlspecialchars($body_link_hover_color); ?>;
  }
<?php } ?>
<?php // Notice Background Color
if ($notice_bg_color)  { ?>
  #fav-noticewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($notice_bg_color); ?>;
  }
<?php } ?>
<?php // Notice Color
if ($notice_color) { ?>
  #fav-noticewrap p {
    color: #<?php echo htmlspecialchars($notice_color); ?>;
  }
<?php } ?>
<?php // Notice Title Color
if ($notice_title_color) { ?>
  #fav-noticewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($notice_title_color); ?>;
  }
<?php } ?>
<?php // Notice Link Color
if ($notice_link_color) { ?>
  #fav-noticewrap a {
    color: #<?php echo htmlspecialchars($notice_link_color); ?>;
  }
<?php } ?>
<?php // Notice Link Hover Color
if ($notice_link_hover_color) { ?>
  #fav-noticewrap a:hover {
    color: #<?php echo htmlspecialchars($notice_link_hover_color); ?>;
  }
<?php } ?>
<?php // Topbar Background Image
if ($topbar_bg_image) { ?>
  #fav-topbarwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($topbar_bg_image); ?>);
  }
<?php } ?>
<?php // Topbar Background Image Style
if ($topbar_bg_image_style) { ?>
  #fav-topbarwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($topbar_bg_image_style); ?>;
  }
<?php } ?>
<?php // Topbar Background Color
if ($topbar_bg_color)  { ?>
  #fav-topbarwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($topbar_bg_color); ?>;
  }
<?php } ?>
<?php // Topbar Color
if ($topbar_color) { ?>
  #fav-topbarwrap p {
    color: #<?php echo htmlspecialchars($topbar_color); ?>;
  }
<?php } ?>
<?php // Topbar Title Color
if ($topbar_title_color) { ?>
  #fav-topbarwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($topbar_title_color); ?>;
  }
<?php } ?>
<?php // Topbar Link Color
if ($topbar_link_color) { ?>
  #fav-topbarwrap a {
    color: #<?php echo htmlspecialchars($topbar_link_color); ?>;
  }
<?php } ?>
<?php // Topbar Link Hover Color
if ($topbar_link_hover_color) { ?>
  #fav-topbarwrap a:hover {
    color: #<?php echo htmlspecialchars($topbar_link_hover_color); ?>;
  }
<?php } ?>
<?php // Slide Width
if ($slide_width) { ?>
  @media (min-width: 1200px) {
    #fav-slidewrap .favth-container {
      width: <?php echo htmlspecialchars($slide_width); ?>;
    }
  }
<?php } ?>
<?php // Slide Full Width
if ($slide_width == '100%') { ?>
  @media (min-width: 1200px) {
    #fav-slidewrap .favth-col-lg-12.favth-col-md-12.favth-col-sm-12.favth-col-xs-12,
    #fav-slidewrap .favth-container {
      padding-right: 0px;
      padding-left: 0px;
    }
    #fav-slidewrap .favth-row {
      margin-right: 0px;
      margin-left: 0px;
    }
    #fav-slidewrap {
      padding-top: 0px;
    }
    #fav-slidewrap .favslider-carousel .favth-carousel-inner {
      margin-top: 0px;
    }
    #fav-slidewrap .favth-left.favth-carousel-control {
      left: 0px;
      right: auto;
    }
    #fav-slidewrap .favth-right.favth-carousel-control {
      right: 0px;
      left: auto;
    }
  }
<?php } ?>
<?php // Slide Background Image
if ($slide_bg_image) { ?>
  #fav-slidewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($slide_bg_image); ?>);
  }
<?php } ?>
<?php // Slide Background Image Style
if ($slide_bg_image_style) { ?>
  #fav-slidewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($slide_bg_image_style); ?>;
  }
<?php } ?>
<?php // Slide Background Color
if ($slide_bg_color)  { ?>
  #fav-slidewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($slide_bg_color); ?>;
  }
<?php } ?>
<?php // Slide Color
if ($slide_color) { ?>
  #fav-slidewrap p {
    color: #<?php echo htmlspecialchars($slide_color); ?>;
  }
<?php } ?>
<?php // Slide Title Color
if ($slide_title_color) { ?>
  #fav-slidewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($slide_title_color); ?>;
  }
<?php } ?>
<?php // Slide Link Color
if ($slide_link_color) { ?>
  #fav-slidewrap a {
    color: #<?php echo htmlspecialchars($slide_link_color); ?>;
  }
<?php } ?>
<?php // Slide Link Hover Color
if ($slide_link_hover_color) { ?>
  #fav-slidewrap a:hover {
    color: #<?php echo htmlspecialchars($slide_link_hover_color); ?>;
  }
<?php } ?>
<?php // Intro Background Image
if ($intro_bg_image) { ?>
  #fav-introwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($intro_bg_image); ?>);
  }
<?php } ?>
<?php // Intro Background Image Style
if ($intro_bg_image_style) { ?>
  #fav-introwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($intro_bg_image_style); ?>;
  }
<?php } ?>
<?php // Intro Background Color
if ($intro_bg_color)  { ?>
  #fav-introwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($intro_bg_color); ?>;
  }
<?php } ?>
<?php // Intro Color
if ($intro_color) { ?>
  #fav-introwrap p {
    color: #<?php echo htmlspecialchars($intro_color); ?>;
  }
<?php } ?>
<?php // Intro Title Color
if ($intro_title_color) { ?>
  #fav-introwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($intro_title_color); ?>;
  }
<?php } ?>
<?php // Intro Link Color
if ($intro_link_color) { ?>
  #fav-introwrap a {
    color: #<?php echo htmlspecialchars($intro_link_color); ?>;
  }
<?php } ?>
<?php // Intro Link Hover Color
if ($intro_link_hover_color) { ?>
  #fav-introwrap a:hover {
    color: #<?php echo htmlspecialchars($intro_link_hover_color); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Background Image
if ($breadcrumbs_bg_image) { ?>
  #fav-breadcrumbswrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($breadcrumbs_bg_image); ?>);
  }
<?php } ?>
<?php // Breadcrumbs Background Image Style
if ($breadcrumbs_bg_image_style) { ?>
  #fav-breadcrumbswrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($breadcrumbs_bg_image_style); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Background Color
if ($breadcrumbs_bg_color)  { ?>
  #fav-breadcrumbswrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($breadcrumbs_bg_color); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Color
if ($breadcrumbs_color) { ?>
  #fav-breadcrumbswrap p {
    color: #<?php echo htmlspecialchars($breadcrumbs_color); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Title Color
if ($breadcrumbs_title_color) { ?>
  #fav-breadcrumbswrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($breadcrumbs_title_color); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Link Color
if ($breadcrumbs_link_color) { ?>
  #fav-breadcrumbswrap a {
    color: #<?php echo htmlspecialchars($breadcrumbs_link_color); ?>;
  }
<?php } ?>
<?php // Breadcrumbs Link Hover Color
if ($breadcrumbs_link_hover_color) { ?>
  #fav-breadcrumbswrap a:hover {
    color: #<?php echo htmlspecialchars($breadcrumbs_link_hover_color); ?>;
  }
<?php } ?>
<?php // Lead Background Image
if ($lead_bg_image) { ?>
  #fav-leadwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($lead_bg_image); ?>);
  }
<?php } ?>
<?php // Lead Background Image Style
if ($lead_bg_image_style) { ?>
  #fav-leadwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($lead_bg_image_style); ?>;
  }
<?php } ?>
<?php // Lead Background Color
if ($lead_bg_color)  { ?>
  #fav-leadwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($lead_bg_color); ?>;
  }
<?php } ?>
<?php // Lead Color
if ($lead_color) { ?>
  #fav-leadwrap p {
    color: #<?php echo htmlspecialchars($lead_color); ?>;
  }
<?php } ?>
<?php // Lead Title Color
if ($lead_title_color) { ?>
  #fav-leadwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($lead_title_color); ?>;
  }
<?php } ?>
<?php // Lead Link Color
if ($lead_link_color) { ?>
  #fav-leadwrap a {
    color: #<?php echo htmlspecialchars($lead_link_color); ?>;
  }
<?php } ?>
<?php // Lead Link Hover Color
if ($lead_link_hover_color) { ?>
  #fav-leadwrap a:hover {
    color: #<?php echo htmlspecialchars($lead_link_hover_color); ?>;
  }
<?php } ?>
<?php // Promo Background Image
if ($promo_bg_image) { ?>
  #fav-promowrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($promo_bg_image); ?>);
  }
<?php } ?>
<?php // Promo Background Image Style
if ($promo_bg_image_style) { ?>
  #fav-promowrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($promo_bg_image_style); ?>;
  }
<?php } ?>
<?php // Promo Background Color
if ($promo_bg_color)  { ?>
  #fav-promowrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($promo_bg_color); ?>;
  }
<?php } ?>
<?php // Promo _color
if ($promo_color) { ?>
  #fav-promowrap p {
    color: #<?php echo htmlspecialchars($promo_color); ?>;
  }
<?php } ?>
<?php // Promo Title Color
if ($promo_title_color) { ?>
  #fav-promowrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($promo_title_color); ?>;
  }
<?php } ?>
<?php // Promo Link Color
if ($promo_link_color) { ?>
  #fav-promowrap a {
    color: #<?php echo htmlspecialchars($promo_link_color); ?>;
  }
<?php } ?>
<?php // Promo Link Hover Color
if ($promo_link_hover_color) { ?>
  #fav-promowrap a:hover {
    color: #<?php echo htmlspecialchars($promo_link_hover_color); ?>;
  }
<?php } ?>
<?php // Prime Background Image
if ($prime_bg_image) { ?>
  #fav-primewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($prime_bg_image); ?>);
  }
<?php } ?>
<?php // Prime Background Image Style
if ($prime_bg_image_style) { ?>
  #fav-primewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($prime_bg_image_style); ?>;
  }
<?php } ?>
<?php // Prime Background Color
if ($prime_bg_color)  { ?>
  #fav-primewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($prime_bg_color); ?>;
  }
<?php } ?>
<?php // Prime Color
if ($prime_color) { ?>
  #fav-primewrap p {
    color: #<?php echo htmlspecialchars($prime_color); ?>;
  }
<?php } ?>
<?php // Prime Title Color
if ($prime_title_color) { ?>
  #fav-primewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($prime_title_color); ?>;
  }
<?php } ?>
<?php // Prime Link Color
if ($prime_link_color) { ?>
  #fav-primewrap a {
    color: #<?php echo htmlspecialchars($prime_link_color); ?>;
  }
<?php } ?>
<?php // Prime Link Hover Color
if ($prime_link_hover_color) { ?>
  #fav-primewrap a:hover {
    color: #<?php echo htmlspecialchars($prime_link_hover_color); ?>;
  }
<?php } ?>
<?php // Showcase Background Image
if ($showcase_bg_image) { ?>
  #fav-showcasewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($showcase_bg_image); ?>);
  }
<?php } ?>
<?php // Showcase Background Image Style
if ($showcase_bg_image_style) { ?>
  #fav-showcasewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($showcase_bg_image_style); ?>;
  }
<?php } ?>
<?php // Showcase Background Color
if ($showcase_bg_color)  { ?>
  #fav-showcasewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($showcase_bg_color); ?>;
  }
<?php } ?>
<?php // Showcase Color
if ($showcase_color) { ?>
  #fav-showcasewrap p {
    color: #<?php echo htmlspecialchars($showcase_color); ?>;
  }
<?php } ?>
<?php // Showcase Title Color
if ($showcase_title_color) { ?>
  #fav-showcasewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($showcase_title_color); ?>;
  }
<?php } ?>
<?php // Showcase Link Color
if ($showcase_link_color) { ?>
  #fav-showcasewrap a {
    color: #<?php echo htmlspecialchars($showcase_link_color); ?>;
  }
<?php } ?>
<?php // Showcase Link Hover Color
if ($showcase_link_hover_color) { ?>
  #fav-showcasewrap a:hover {
    color: #<?php echo htmlspecialchars($showcase_link_hover_color); ?>;
  }
<?php } ?>
<?php // Feature Background Image
if ($feature_bg_image) { ?>
  #fav-featurewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($feature_bg_image); ?>);
  }
<?php } ?>
<?php // Feature Background Image Style
if ($feature_bg_image_style) { ?>
  #fav-featurewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($feature_bg_image_style); ?>;
  }
<?php } ?>
<?php // Feature Background Color
if ($feature_bg_color)  { ?>
  #fav-featurewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($feature_bg_color); ?>;
  }
<?php } ?>
<?php // Feature Color
if ($feature_color) { ?>
  #fav-featurewrap p {
    color: #<?php echo htmlspecialchars($feature_color); ?>;
  }
<?php } ?>
<?php // Feature Title Color
if ($feature_title_color) { ?>
  #fav-featurewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($feature_title_color); ?>;
  }
<?php } ?>
<?php // Feature Link Color
if ($feature_link_color) { ?>
  #fav-featurewrap a {
    color: #<?php echo htmlspecialchars($feature_link_color); ?>;
  }
<?php } ?>
<?php // Feature Link Hover Color
if ($feature_link_hover_color) { ?>
  #fav-featurewrap a:hover {
    color: #<?php echo htmlspecialchars($feature_link_hover_color); ?>;
  }
<?php } ?>
<?php // Focus Background Image
if ($focus_bg_image) { ?>
  #fav-focuswrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($focus_bg_image); ?>);
  }
<?php } ?>
<?php // Focus Background Image Style
if ($focus_bg_image_style) { ?>
  #fav-focuswrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($focus_bg_image_style); ?>;
  }
<?php } ?>
<?php // Focus Background Color
if ($focus_bg_color)  { ?>
  #fav-focuswrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($focus_bg_color); ?>;
  }
<?php } ?>
<?php // Focus Color
if ($focus_color) { ?>
  #fav-focuswrap p {
    color: #<?php echo htmlspecialchars($focus_color); ?>;
  }
<?php } ?>
<?php // Focus Title Color
if ($focus_title_color) { ?>
  #fav-focuswrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($focus_title_color); ?>;
  }
<?php } ?>
<?php // Focus Link Color
if ($focus_link_color) { ?>
  #fav-focuswrap a {
    color: #<?php echo htmlspecialchars($focus_link_color); ?>;
  }
<?php } ?>
<?php // Focus Link Hover Color
if ($focus_link_hover_color) { ?>
  #fav-focuswrap a:hover {
    color: #<?php echo htmlspecialchars($focus_link_hover_color); ?>;
  }
<?php } ?>
<?php // Portfolio Background Image
if ($portfolio_bg_image) { ?>
  #fav-portfoliowrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($portfolio_bg_image); ?>);
  }
<?php } ?>
<?php // Portfolio Background Image Style
if ($portfolio_bg_image_style) { ?>
  #fav-portfoliowrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($portfolio_bg_image_style); ?>;
  }
<?php } ?>
<?php // Portfolio Background Color
if ($portfolio_bg_color)  { ?>
  #fav-portfoliowrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($portfolio_bg_color); ?>;
  }
<?php } ?>
<?php // Portfolio Color
if ($portfolio_color) { ?>
  #fav-portfoliowrap p {
    color: #<?php echo htmlspecialchars($portfolio_color); ?>;
  }
<?php } ?>
<?php // Portfolio Title Color
if ($portfolio_title_color) { ?>
  #fav-portfoliowrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($portfolio_title_color); ?>;
  }
<?php } ?>
<?php // Portfolio Link Color
if ($portfolio_link_color) { ?>
  #fav-portfoliowrap a {
    color: #<?php echo htmlspecialchars($portfolio_link_color); ?>;
  }
<?php } ?>
<?php // Portfolio Link Hover Color
if ($portfolio_link_hover_color) { ?>
  #fav-portfoliowrap a:hover {
    color: #<?php echo htmlspecialchars($portfolio_link_hover_color); ?>;
  }
<?php } ?>
<?php // Screen Background Image
if ($screen_bg_image) { ?>
  #fav-screenwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($screen_bg_image); ?>);
  }
<?php } ?>
<?php // Screen Background Image Style
if ($screen_bg_image_style) { ?>
  #fav-screenwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($screen_bg_image_style); ?>;
  }
<?php } ?>
<?php // Screen Background Color
if ($screen_bg_color)  { ?>
  #fav-screenwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($screen_bg_color); ?>;
  }
<?php } ?>
<?php // Screen Color
if ($screen_color) { ?>
  #fav-screenwrap p {
    color: #<?php echo htmlspecialchars($screen_color); ?>;
  }
<?php } ?>
<?php // Screen Title Color
if ($screen_title_color) { ?>
  #fav-screenwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($screen_title_color); ?>;
  }
<?php } ?>
<?php // Screen Link Color
if ($screen_link_color) { ?>
  #fav-screenwrap a {
    color: #<?php echo htmlspecialchars($screen_link_color); ?>;
  }
<?php } ?>
<?php // Screen Link Hover Color
if ($screen_link_hover_color) { ?>
  #fav-screenwrap a:hover {
    color: #<?php echo htmlspecialchars($screen_link_hover_color); ?>;
  }
<?php } ?>
<?php // Top Background Image
if ($top_bg_image) { ?>
  #fav-topwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($top_bg_image); ?>);
  }
<?php } ?>
<?php // Top Background Image Style
if ($top_bg_image_style) { ?>
  #fav-topwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($top_bg_image_style); ?>;
  }
<?php } ?>
<?php // Top Background Color
if ($top_bg_color)  { ?>
  #fav-topwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($top_bg_color); ?>;
  }
<?php } ?>
<?php // Top Color
if ($top_color) { ?>
  #fav-topwrap p {
    color: #<?php echo htmlspecialchars($top_color); ?>;
  }
<?php } ?>
<?php // Top Title Color
if ($top_title_color) { ?>
  #fav-topwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($top_title_color); ?>;
  }
<?php } ?>
<?php // Top Link Color
if ($top_link_color) { ?>
  #fav-topwrap a {
    color: #<?php echo htmlspecialchars($top_link_color); ?>;
  }
<?php } ?>
<?php // Top Link Hover Color
if ($top_link_hover_color) { ?>
  #fav-topwrap a:hover {
    color: #<?php echo htmlspecialchars($top_link_hover_color); ?>;
  }
<?php } ?>
<?php // Mainmaintop Background Image
if ($maintop_bg_image) { ?>
  #fav-maintopwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($maintop_bg_image); ?>);
  }
<?php } ?>
<?php // Mainmaintop Background Image Style
if ($maintop_bg_image_style) { ?>
  #fav-maintopwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($maintop_bg_image_style); ?>;
  }
<?php } ?>
<?php // Mainmaintop Background Color
if ($maintop_bg_color)  { ?>
  #fav-maintopwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($maintop_bg_color); ?>;
  }
<?php } ?>
<?php // Mainmaintop Color
if ($maintop_color) { ?>
  #fav-maintopwrap p {
    color: #<?php echo htmlspecialchars($maintop_color); ?>;
  }
<?php } ?>
<?php // Mainmaintop Title Color
if ($maintop_title_color) { ?>
  #fav-maintopwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($maintop_title_color); ?>;
  }
<?php } ?>
<?php // Mainmaintop Link Color
if ($maintop_link_color) { ?>
  #fav-maintopwrap a {
    color: #<?php echo htmlspecialchars($maintop_link_color); ?>;
  }
<?php } ?>
<?php // Mainmaintop Link Hover Color
if ($maintop_link_hover_color) { ?>
  #fav-maintopwrap a:hover {
    color: #<?php echo htmlspecialchars($maintop_link_hover_color); ?>;
  }
<?php } ?>
<?php // Mainbottom Background Image
if ($mainbottom_bg_image) { ?>
  #fav-mainbottomwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($mainbottom_bg_image); ?>);
  }
<?php } ?>
<?php // Mainbottom Background Image Style
if ($mainbottom_bg_image_style) { ?>
  #fav-mainbottomwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($mainbottom_bg_image_style); ?>;
  }
<?php } ?>
<?php // Mainbottom Background Color
if ($mainbottom_bg_color)  { ?>
  #fav-mainbottomwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($mainbottom_bg_color); ?>;
  }
<?php } ?>
<?php // Mainbottom Color
if ($mainbottom_color) { ?>
  #fav-mainbottomwrap p {
    color: #<?php echo htmlspecialchars($mainbottom_color); ?>;
  }
<?php } ?>
<?php // Mainbottom Title Color
if ($mainbottom_title_color) { ?>
  #fav-mainbottomwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($mainbottom_title_color); ?>;
  }
<?php } ?>
<?php // Mainbottom Link Color
if ($mainbottom_link_color) { ?>
  #fav-mainbottomwrap a {
    color: #<?php echo htmlspecialchars($mainbottom_link_color); ?>;
  }
<?php } ?>
<?php // Mainbottom Link Hover Color
if ($mainbottom_link_hover_color) { ?>
  #fav-mainbottomwrap a:hover {
    color: #<?php echo htmlspecialchars($mainbottom_link_hover_color); ?>;
  }
<?php } ?>
<?php // Bottom Background Image
if ($bottom_bg_image) { ?>
  #fav-bottomwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($bottom_bg_image); ?>);
  }
<?php } ?>
<?php // Bottom Background Image Style
if ($bottom_bg_image_style) { ?>
  #fav-bottomwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($bottom_bg_image_style); ?>;
  }
<?php } ?>
<?php // Bottom Background Color
if ($bottom_bg_color)  { ?>
  #fav-bottomwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($bottom_bg_color); ?>;
  }
<?php } ?>
<?php // Bottom Color
if ($bottom_color) { ?>
  #fav-bottomwrap p {
    color: #<?php echo htmlspecialchars($bottom_color); ?>;
  }
<?php } ?>
<?php // Bottom Title Color
if ($bottom_title_color) { ?>
  #fav-bottomwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($bottom_title_color); ?>;
  }
<?php } ?>
<?php // Bottom Link Color
if ($bottom_link_color) { ?>
  #fav-bottomwrap a {
    color: #<?php echo htmlspecialchars($bottom_link_color); ?>;
  }
<?php } ?>
<?php // Bottom Link Hover Color
if ($bottom_link_hover_color) { ?>
  #fav-bottomwrap a:hover {
    color: #<?php echo htmlspecialchars($bottom_link_hover_color); ?>;
  }
<?php } ?>
<?php // Note Background Image
if ($note_bg_image) { ?>
  #fav-notewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($note_bg_image); ?>);
  }
<?php } ?>
<?php // Note Background Image Style
if ($note_bg_image_style) { ?>
  #fav-notewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($note_bg_image_style); ?>;
  }
<?php } ?>
<?php // Note Background Color
if ($note_bg_color)  { ?>
  #fav-notewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($note_bg_color); ?>;
  }
<?php } ?>
<?php // Note Color
if ($note_color) { ?>
  #fav-notewrap p {
    color: #<?php echo htmlspecialchars($note_color); ?>;
  }
<?php } ?>
<?php // Note Title Color
if ($note_title_color) { ?>
  #fav-notewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($note_title_color); ?>;
  }
<?php } ?>
<?php // Note Link Color
if ($note_link_color) { ?>
  #fav-notewrap a {
    color: #<?php echo htmlspecialchars($note_link_color); ?>;
  }
<?php } ?>
<?php // Note Link Hover Color
if ($note_link_hover_color) { ?>
  #fav-notewrap a:hover {
    color: #<?php echo htmlspecialchars($note_link_hover_color); ?>;
  }
<?php } ?>
<?php // Base Background Image
if ($base_bg_image) { ?>
  #fav-basewrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($base_bg_image); ?>);
  }
<?php } ?>
<?php // Base Background Image Style
if ($base_bg_image_style) { ?>
  #fav-basewrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($base_bg_image_style); ?>;
  }
<?php } ?>
<?php // Base Background Color
if ($base_bg_color)  { ?>
  #fav-basewrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($base_bg_color); ?>;
  }
<?php } ?>
<?php // Base Color
if ($base_color) { ?>
  #fav-basewrap p {
    color: #<?php echo htmlspecialchars($base_color); ?>;
  }
<?php } ?>
<?php // Base Title Color
if ($base_title_color) { ?>
  #fav-basewrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($base_title_color); ?>;
  }
<?php } ?>
<?php // Base Link Color
if ($base_link_color) { ?>
  #fav-basewrap a {
    color: #<?php echo htmlspecialchars($base_link_color); ?>;
  }
<?php } ?>
<?php // Base Link Hover Color
if ($base_link_hover_color) { ?>
  #fav-basewrap a:hover {
    color: #<?php echo htmlspecialchars($base_link_hover_color); ?>;
  }
<?php } ?>
<?php // Block Background Image
if ($block_bg_image) { ?>
  #fav-blockwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($block_bg_image); ?>);
  }
<?php } ?>
<?php // Block Background Image Style
if ($block_bg_image_style) { ?>
  #fav-blockwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($block_bg_image_style); ?>;
  }
<?php } ?>
<?php // Block Background Color
if ($block_bg_color)  { ?>
  #fav-blockwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($block_bg_color); ?>;
  }
<?php } ?>
<?php // Block Color
if ($block_color) { ?>
  #fav-blockwrap p {
    color: #<?php echo htmlspecialchars($block_color); ?>;
  }
<?php } ?>
<?php // Block Title Color
if ($block_title_color) { ?>
  #fav-blockwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($block_title_color); ?>;
  }
<?php } ?>
<?php // Block Link Color
if ($block_link_color) { ?>
  #fav-blockwrap a {
    color: #<?php echo htmlspecialchars($block_link_color); ?> ;
  }
<?php } ?>
<?php // Block Link Hover Color
if ($block_link_hover_color) { ?>
  #fav-blockwrap a:hover {
    color: #<?php echo htmlspecialchars($block_link_hover_color); ?>;
  }
<?php } ?>
<?php // User Background Image
if ($user_bg_image) { ?>
  #fav-userwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($user_bg_image); ?>);
  }
<?php } ?>
<?php // User Background Image Style
if ($user_bg_image_style) { ?>
  #fav-userwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($user_bg_image_style); ?>;
  }
<?php } ?>
<?php // User Background Color
if ($user_bg_color)  { ?>
  #fav-userwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($user_bg_color); ?>;
  }
<?php } ?>
<?php // User Color
if ($user_color) { ?>
  #fav-userwrap p {
    color: #<?php echo htmlspecialchars($user_color); ?>;
  }
<?php } ?>
<?php // User Title Color
if ($user_title_color) { ?>
  #fav-userwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($user_title_color); ?>;
  }
<?php } ?>
<?php // User Link Color
if ($user_link_color) { ?>
  #fav-userwrap a {
    color: #<?php echo htmlspecialchars($user_link_color); ?>;
  }
<?php } ?>
<?php // User Link Hover Color
if ($user_link_hover_color) { ?>
  #fav-userwrap a:hover {
    color: #<?php echo htmlspecialchars($user_link_hover_color); ?>;
  }
<?php } ?>
<?php // Footer Background Image
if ($footer_bg_image) { ?>
  #fav-footerwrap.fav-module-block-clear {
    background-image: url(<?php echo $this->baseurl."/"; echo htmlspecialchars($footer_bg_image); ?>);
  }
<?php } ?>
<?php // Footer Background Image Style
if ($footer_bg_image_style) { ?>
  #fav-footerwrap.fav-module-block-clear {
    background-repeat: <?php echo htmlspecialchars($footer_bg_image_style); ?>;
  }
<?php } ?>
<?php // Footer Background Color
if ($footer_bg_color)  { ?>
  #fav-footerwrap.fav-module-block-color {
    background-color: #<?php echo htmlspecialchars($footer_bg_color); ?>;
  }
<?php } ?>
<?php // Footer Color
if ($footer_color) { ?>
  #fav-footerwrap p {
    color: #<?php echo htmlspecialchars($footer_color); ?>;
  }
<?php } ?>
<?php // Footer Title Color
if ($footer_title_color) { ?>
  #fav-footerwrap h3:first-of-type {
    color: #<?php echo htmlspecialchars($footer_title_color); ?>;
  }
<?php } ?>
<?php // Footer Link Color
if ($footer_link_color) { ?>
  #fav-footerwrap a {
    color: #<?php echo htmlspecialchars($footer_link_color); ?>;
  }
<?php } ?>
<?php // Footer Link Hover Color
if ($footer_link_hover_color) { ?>
  #fav-footerwrap a:hover {
    color: #<?php echo htmlspecialchars($footer_link_hover_color); ?>;
  }
<?php } ?>
<?php // Logo Padding
if ($default_logo_padding) { ?>
  .default-logo {
    padding: <?php echo htmlspecialchars($default_logo_padding); ?>;
  }
<?php } ?>
<?php // Logo Margin
if ($default_logo_margin) { ?>
  .default-logo {
    margin: <?php echo htmlspecialchars($default_logo_margin); ?>;
  }
<?php } ?>
<?php // Uploaded Logo Padding
if ($media_logo_padding) { ?>
  .media-logo {
    padding: <?php echo htmlspecialchars($media_logo_padding); ?>;
  }
<?php } ?>
<?php // Uploaded Logo Margin
if ($media_logo_margin) { ?>
  .media-logo {
    margin: <?php echo htmlspecialchars($media_logo_margin); ?>;
  }
<?php } ?>
<?php // Text Logo Color
if ($text_logo_color) { ?>
  .fav-container a.text-logo,
  .fav-container a.text-logo:hover,
  .fav-container a.text-logo:focus {
    color: #<?php echo htmlspecialchars($text_logo_color); ?>;
  }
<?php } ?>
<?php // Text Logo Font Size
if ($text_logo_font_size) { ?>
  .fav-container a.text-logo {
    font-size: <?php echo htmlspecialchars($text_logo_font_size); ?>;
  }
<?php } ?>
<?php // Text Logo Google Font
if ($text_logo_google_font) { ?>
  .fav-container a.text-logo,
  #fav-logo h1 {
    font-family: '<?php echo htmlspecialchars($text_logo_google_font); ?>', sans-serif;
  }
<?php } ?>
<?php // Text Logo Google Font Weight
if ($text_logo_google_font_weight) { ?>
  .fav-container a.text-logo,
  #fav-logo h1 {
    font-weight: <?php echo htmlspecialchars($text_logo_google_font_weight); ?>;
  }
<?php } ?>
<?php // Text Logo Google Font Style
if ($text_logo_google_font_style) { ?>
  .fav-container a.text-logo,
  #fav-logo h1 {
    font-style: <?php echo htmlspecialchars($text_logo_google_font_style); ?>;
  }
<?php } ?>
<?php // Text Logo Line Height
if ($text_logo_line_height) { ?>
  .fav-container a.text-logo {
    line-height: <?php echo htmlspecialchars($text_logo_line_height); ?> ;
  }
<?php } ?>
<?php // Text Logo Padding
if ($text_logo_padding) { ?>
  .fav-container a.text-logo {
    padding: <?php echo htmlspecialchars($text_logo_padding); ?>;
  }
<?php } ?>
<?php // Text Logo Margin
if ($text_logo_margin) { ?>
  .fav-container a.text-logo {
    margin: <?php echo htmlspecialchars($text_logo_margin); ?>;
  }
<?php } ?>
<?php // Slogan Logo Color
if ($slogan_color) { ?>
  .slogan {
    color: #<?php echo htmlspecialchars($slogan_color); ?>;
  }
<?php } ?>
<?php // Slogan Logo Font Size
if ($slogan_font_size) { ?>
  .slogan {
    font-size: <?php echo htmlspecialchars($slogan_font_size); ?>;
  }
<?php } ?>
<?php // Slogan Logo Line Height
if ($slogan_line_height) { ?>
  .slogan {
    line-height: <?php echo htmlspecialchars($slogan_line_height); ?>;
  }
<?php } ?>
<?php // Slogan Logo Padding
if ($slogan_padding) { ?>
  .slogan {
    padding: <?php echo htmlspecialchars($slogan_padding); ?>;
  }
<?php } ?>
<?php // Slogan Logo Margin
if ($slogan_margin) { ?>
  .slogan {
    margin: <?php echo htmlspecialchars($slogan_margin); ?>;
  }
<?php } ?>
<?php if (($show_retina_logo) !=0) { // Mobile Retina Logo ?>
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .show_retina_logo { display: block; }
    .default_logo, .media_logo, .text_logo { display: none; }
  }
<?php } ?>
<?php // Retina Logo Height
if ($retina_logo_height) { ?>
  .retina-logo {
    height: <?php echo htmlspecialchars($retina_logo_height); ?>;
  }
<?php } ?>
<?php // Retina Logo Width
if ($retina_logo_width) { ?>
  .retina-logo {
    width: <?php echo htmlspecialchars($retina_logo_width); ?>;
  }
<?php } ?>
<?php // Retina Logo Padding
if ($retina_logo_padding) { ?>
  .retina-logo {
    padding: <?php echo htmlspecialchars($retina_logo_padding); ?>;
  }
<?php } ?>
<?php // Retina Logo Margin
if ($retina_logo_margin) { ?>
  .retina-logo {
    margin: <?php echo htmlspecialchars($retina_logo_margin); ?>;
  }
<?php } ?>
<?php // Paragraph Mobile Font Size
if ($mobile_paragraph_font_size) { ?>
  @media (max-width: 480px) {
    p {
      font-size: <?php echo htmlspecialchars($mobile_paragraph_font_size); ?>;
    }
  }
<?php } ?>
<?php // Paragraph Mobile Font Size
if ($mobile_paragraph_line_height) { ?>
  @media (max-width: 480px) {
    p {
      line-height: <?php echo htmlspecialchars($mobile_paragraph_line_height); ?>;
    }
  }
<?php } ?>
<?php // Module Mobile Title Font Size
if ($mobile_title_font_size) { ?>
  @media (max-width: 480px) {
  .fav-container h3:first-of-type,
  .fav-container .page-header h2,
  .fav-container h2.item-title,
  .fav-container .hikashop_product_page h1 {
      font-size: <?php echo htmlspecialchars($mobile_title_font_size); ?>;
    }
  }
<?php } ?>

</style>
