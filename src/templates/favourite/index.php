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

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
// Add current user information
$user = JFactory::getUser();
// Add Joomla!'s Bootstrap 2 Framework
$doc->addStyleSheet($this->baseurl . '/media/jui/css/bootstrap.min.css');
$doc->addStyleSheet($this->baseurl . '/media/jui/css/bootstrap-responsive.css');
// Add FavThemes Bootstrap 3 Framework
JHtml::_('jquery.framework');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/bootstrap/favth-bootstrap.css');
$doc->addScript($this->baseurl. '/templates/' .$this->template. '/bootstrap/favth-bootstrap.js');
// Add page class suffix
//$itemid = JRequest::getVar('Itemid');

$menu = $app->getMenu();

//$active = $menu->getItem($itemid);
$active = $menu->getActive();
if (isset($active)) {
  $params = $menu->getParams( $active->id );
  $pageclass = $params->get( 'pageclass_sfx' );

}
// Column layout
$favcolumns = 6;

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>

	<jdoc:include type="head" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- STYLESHEETS -->
    <!-- icons -->
  	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
    <!-- admin -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/admin/admin.css" type="text/css" />
    <!-- cms -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/cms.css" type="text/css" />
    <!-- theme -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/theme.css" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/style.css" type="text/css" />
    <!-- styles -->
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/styles/<?php echo $this->params->get('template_styles'); ?>.css" type="text/css" />
    <!-- custom -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/custom.css" type="text/css" />

  <!-- GOOGLE FONT -->
    <!-- navigation -->
    <link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+',$this->params->get('nav_google_font'));?>:<?php echo ($this->params->get('nav_google_font_weight')); ?><?php echo str_replace('normal', '',$this->params->get('nav_google_font_style'));?>' rel='stylesheet' type='text/css' />
    <!-- titles -->
    <link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+',$this->params->get('titles_google_font'));?>:<?php echo ($this->params->get('titles_google_font_weight')); ?><?php echo str_replace('normal', '',$this->params->get('titles_google_font_style'));?>' rel='stylesheet' type='text/css' />
    <!-- text logo -->
    <link href='//fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+',$this->params->get('text_logo_google_font'));?>:<?php echo ($this->params->get('text_logo_google_font_weight')); ?><?php echo str_replace('normal', '',$this->params->get('text_logo_google_font_style'));?>' rel='stylesheet' type='text/css' />
    <!-- default -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"

  <!-- PARAMETERS -->
  <?php require("admin/params.php"); ?>

  <!-- GOOGLE ANALYTICS TRACKING CODE -->
  <?php if($analytics_code) { echo '<script type="text/javascript">'.$analytics_code.'</script>';}?>

  <!-- FAVTH SCRIPTS -->
  <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/favth-scripts.js"></script>

</head>

<body<?php echo (isset($pageclass) ? ' class="favbody'.htmlspecialchars($pageclass).'"' : ''); ?>>

  <div id="fav-containerwrap" class="favth-clearfix">
    <div class="<?php echo $body_bg_image_overlay; ?>">

  	  <!-- NAVBAR -->
      <div id="fav-navbarwrap" class="favth-visible-xs">
    		<div class="favth-navbar <?php echo htmlspecialchars($mobile_nav_color);?>">
          <div id="fav-navbar" class="favth-container">

    				<div class="favth-navbar-header">
              <div id="fav-logomobile" class="favth-clearfix">
                <?php if (($show_default_logo) !=0) : ?>
                  <h1>
                    <a class="default-logo" href="<?php echo $this->baseurl; ?>/">
                      <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo/<?php echo htmlspecialchars($default_logo);?>" style="border:0;" alt="<?php echo htmlspecialchars($default_logo_img_alt);?>" />
                    </a>
                  </h1>
                <?php endif;?>
                <?php if (($show_media_logo) !=0) : ?>
                  <h1>
                    <a class="media-logo" href="<?php echo $this->baseurl; ?>/">
                      <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($media_logo);?>" style="border:0;" alt="<?php echo htmlspecialchars($media_logo_img_alt);?>" />
                    </a>
                  </h1>
                <?php endif;?>
                <?php if (($show_text_logo) !=0) : ?>
                  <h1>
                    <a class="text-logo" href="<?php echo $this->baseurl; ?>/"><?php echo htmlspecialchars($text_logo);?></a>
                  </h1>
                <?php endif;?>
                <?php if (($show_retina_logo) !=0) : ?>
                  <h1 class="show-retina-logo">
                    <a class="retina-logo" href="<?php echo $this->baseurl; ?>/">
                      <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($retina_logo);?>" style="border:0; margin:<?php echo htmlspecialchars($retina_logo_margin);?>; padding:<?php echo htmlspecialchars($retina_logo_padding);?>;" width="<?php echo htmlspecialchars($retina_logo_width);?>" alt="<?php echo htmlspecialchars($retina_logo_img_alt);?>" />
                    </a>
                  </h1>
                <?php endif;?>
                <?php if (($show_slogan) !=0) : ?>
                  <div class="slogan"><?php echo htmlspecialchars($slogan);?></div>
                <?php endif;?>
              </div>

              <?php if (($show_mobile_menu_text) !=0) : ?>
                <span id="fav-mobilemenutext">
                  <?php echo htmlspecialchars($mobile_menu_text);?>
                </span>
              <?php endif;?>

              <div id="fav-navbar-btn" class="favth-clearfix">
                <button type="button" class="favth-navbar-toggle favth-collapsed" data-toggle="favth-collapse" data-target=".favth-collapse" aria-expanded="false">

                  <span class="favth-sr-only">Toggle navigation</span>
                  <span class="favth-icon-bar"></span>
                  <span class="favth-icon-bar"></span>
                  <span class="favth-icon-bar"></span>
                </button>
              </div>
            </div>

  					<div class="favth-collapse favth-navbar-collapse">
  						<?php if ($this->countModules('nav') || $this->countModules('navmobile')) { // for mobile ?>
  							<div id="fav-navbar-collapse">
                  <?php $navposition = ($this->countModules('navmobile')) ? 'navmobile' : 'nav'; ?>
  								<jdoc:include type="modules" name="<?php echo $navposition; ?>" style="fav" />
  							</div>
  						<?php } ?>
  					</div>

    			</div>
    	  </div>
      </div>

  		<div id="fav-container" class="fav-container">

  			<!-- NOTICE -->
  			<?php if ($this->countModules('notice')) { ?>

  				<div id="fav-noticewrap" class="favth-alert favth-alert-warning favth-alert-dismissible <?php echo $notice_bg_style; ?>" role="alert" aria-label="Close">
            <div class="favth-container">

              <button type="button" class="favth-close" data-dismiss="favth-alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

    					<div class="favth-row">
    						<div id="fav-notice" class="favth-content-block favth-clearfix">

                  <div class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">

                    <jdoc:include type="modules" name="notice" style="fav" />

                  </div>

                </div>
    					</div>

            </div>
    			</div>

  			<?php } ?>

        <!-- TOPBAR -->
        <?php
        $topbaractive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('topbar'.$i)) { $topbaractive++; } }

        if ($topbaractive > 0) {
          if ($topbaractive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topbaractive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topbaractive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topbaractive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($topbaractive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topbaractive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-topbarwrap" class="<?php echo $topbar_bg_style; ?>">
            <div class="<?php echo $topbar_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-topbar" class="favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('topbar'.$j)): ?>

                          <div id="fav-topbar<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="topbar<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- HEADER -->
        <div id="fav-headerwrap">
          <div class="favth-container">
            <div class="favth-row">

                <div id="fav-header" class="favth-clearfix">

                  <div id="fav-logo" class="favth-col-lg-3 favth-col-md-3 favth-col-sm-12 favth-hidden-xs">
                    <?php if (($show_default_logo) !=0) : ?>
                      <h1>
                        <a class="default-logo" href="<?php echo $this->baseurl; ?>/">
                          <img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo/<?php echo htmlspecialchars($default_logo);?>" style="border:0;" alt="<?php echo htmlspecialchars($default_logo_img_alt);?>" />
                        </a>
                      </h1>
                    <?php endif;?>
                    <?php if (($show_media_logo) !=0) : ?>
                      <h1>
                        <a class="media-logo" href="<?php echo $this->baseurl; ?>/">
                          <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($media_logo);?>" style="border:0;" alt="<?php echo htmlspecialchars($media_logo_img_alt);?>" />
                        </a>
                      </h1>
                    <?php endif;?>
                    <?php if (($show_text_logo) !=0) : ?>
                      <h1>
                        <a class="text-logo" href="<?php echo $this->baseurl; ?>/"><?php echo htmlspecialchars($text_logo);?></a>
                      </h1>
                    <?php endif;?>
                    <?php if (($show_retina_logo) !=0) : ?>
                      <h1 class="show-retina-logo">
                        <a class="retina-logo" href="<?php echo $this->baseurl; ?>/">
                          <img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($retina_logo);?>" style="border:0; margin:<?php echo htmlspecialchars($retina_logo_margin);?>; padding:<?php echo htmlspecialchars($retina_logo_padding);?>;" width="<?php echo htmlspecialchars($retina_logo_width);?>" alt="<?php echo htmlspecialchars($retina_logo_img_alt);?>" />
                        </a>
                      </h1>
                    <?php endif;?>
                    <?php if (($show_slogan) !=0) : ?>
                      <div class="slogan"><?php echo htmlspecialchars($slogan);?></div>
                    <?php endif;?>
                  </div>

                <?php if ($this->countModules('nav')) { ?>
                  <div id="fav-nav" class="favth-col-lg-9 favth-col-md-9 favth-col-sm-12 favth-hidden-xs">
                    <div class="favnav">
                      <div class="favth-clearfix">
                        <jdoc:include type="modules" name="nav" style="fav" />
                      </div>
                    </div>
                  </div>
                <?php } ?>

                </div>

            </div>
          </div>
        </div>

        <!-- SLIDE -->
        <?php if ($this->countModules('slide')) { ?>
          <div id="fav-slidewrap" class="<?php echo $slide_bg_style; ?>">
            <div class="<?php echo $slide_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-slide" class="favth-content-block favth-clearfix">
                    <div class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
                      <jdoc:include type="modules" name="slide" style="fav" />
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        <?php } ?>

  			<!-- INTRO -->
        <?php
        $introactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('intro'.$i)) { $introactive++; } }

        if ($introactive > 0) {
          if ($introactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($introactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($introactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($introactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($introactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($introactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

        <div id="fav-introwrap" class="<?php echo $intro_bg_style; ?>">
          <div class="<?php echo $intro_bg_image_overlay; ?>">
            <div class="favth-container">
              <div class="favth-row">

                <div id="fav-intro" class="favth-content-block favth-clearfix">

                  <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                    <?php if ($this->countModules('intro'.$j)): ?>

                        <div id="fav-intro<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                          <jdoc:include type="modules" name="intro<?php echo $j; ?>" style="fav" />

                        </div>

                    <?php endif; ?>
                  <?php } ?>

                </div>

              </div>
            </div>
          </div>
        </div>

        <?php } ?>

        <?php if ($this->countModules('breadcrumbs')) { ?>
          <div id="fav-breadcrumbswrap" class="<?php echo $breadcrumbs_bg_style; ?>">
            <div class="<?php echo $breadcrumbs_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-breadcrumbs" class="favth-content-block favth-clearfix">
                    <div class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
                      <jdoc:include type="modules" name="breadcrumbs" style="fav" />
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <!-- LEAD -->
        <?php
        $leadactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('lead'.$i)) { $leadactive++; } }

        if ($leadactive > 0) {
          if ($leadactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($leadactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($leadactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($leadactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($leadactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($leadactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-leadwrap" class="<?php echo $lead_bg_style; ?>">
            <div class="<?php echo $lead_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-lead" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('lead'.$j)): ?>

                          <div id="fav-lead<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="lead<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

  			<!-- PROMO -->
        <?php
        $promoactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('promo'.$i)) { $promoactive++; } }

        if ($promoactive > 0) {
          if ($promoactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($promoactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($promoactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($promoactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($promoactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($promoactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-promowrap" class="<?php echo $promo_bg_style; ?>">
            <div class="<?php echo $promo_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-promo" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('promo'.$j)): ?>

                          <div id="fav-promo<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="promo<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- PRIME -->
        <?php
        $primeactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('prime'.$i)) { $primeactive++; } }

        if ($primeactive > 0) {
          if ($primeactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($primeactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($primeactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($primeactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($primeactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($primeactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-primewrap" class="<?php echo $prime_bg_style; ?>">
            <div class="<?php echo $prime_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-prime" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('prime'.$j)): ?>

                          <div id="fav-prime<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="prime<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

  			<!-- SHOWCASE -->
        <?php
        $showcaseactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('showcase'.$i)) { $showcaseactive++; } }

        if ($showcaseactive > 0) {
          if ($showcaseactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($showcaseactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($showcaseactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($showcaseactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($showcaseactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($showcaseactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-showcasewrap" class="<?php echo $showcase_bg_style; ?>">
            <div class="<?php echo $showcase_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-showcase" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('showcase'.$j)): ?>

                          <div id="fav-showcase<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="showcase<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- FEATURE -->
        <?php
        $featureactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('feature'.$i)) { $featureactive++; } }

        if ($featureactive > 0) {
          if ($featureactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($featureactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($featureactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($featureactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($featureactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($featureactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-featurewrap" class="<?php echo $feature_bg_style; ?>">
            <div class="<?php echo $feature_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-feature" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('feature'.$j)): ?>

                          <div id="fav-feature<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="feature<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- FOCUS -->
        <?php
        $focusactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('focus'.$i)) { $focusactive++; } }

        if ($focusactive > 0) {
          if ($focusactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($focusactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($focusactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($focusactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($focusactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($focusactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-focuswrap" class="<?php echo $focus_bg_style; ?>">
            <div class="<?php echo $focus_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-focus" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('focus'.$j)): ?>

                          <div id="fav-focus<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="focus<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- PORTFOLIO -->
        <?php
        $portfolioactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('portfolio'.$i)) { $portfolioactive++; } }

        if ($portfolioactive > 0) {
          if ($portfolioactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($portfolioactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($portfolioactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($portfolioactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($portfolioactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($portfolioactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-portfoliowrap" class="<?php echo $portfolio_bg_style; ?>">
            <div class="<?php echo $portfolio_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-portfolio" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('portfolio'.$j)): ?>

                          <div id="fav-portfolio<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="portfolio<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- SCREEN -->
        <?php
        $screenactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('screen'.$i)) { $screenactive++; } }

        if ($screenactive > 0) {
          if ($screenactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($screenactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($screenactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($screenactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($screenactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($screenactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-screenwrap" class="<?php echo $screen_bg_style; ?>">
            <div class="<?php echo $screen_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-screen" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('screen'.$j)): ?>

                          <div id="fav-screen<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="screen<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

  			<!-- TOP -->
        <?php
        $topactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('top'.$i)) { $topactive++; } }

        if ($topactive > 0) {
          if ($topactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($topactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($topactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-topwrap" class="<?php echo $top_bg_style; ?>">
            <div class="<?php echo $top_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-top" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('top'.$j)): ?>

                          <div id="fav-top<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="top<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

  			<!-- MAINTOP -->
  			<?php if($this->countModules('maintop1') || $this->countModules('maintop2') || $this->countModules('maintop3')) : ?>

          <div id="fav-maintopwrap" class="<?php echo $maintop_bg_style; ?>">
            <div class="<?php echo $maintop_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <?php $maintop=0;
                      if ($this->countModules('maintop1') && $this->countModules('maintop2')) $maintop=1;
                      if ($this->countModules('maintop2') && $this->countModules('maintop3')) $maintop=2;
                      if ($this->countModules('maintop1') && $this->countModules('maintop3')) $maintop=3;
                      if ($this->countModules('maintop1') && $this->countModules('maintop2') && $this->countModules('maintop3')) $maintop=4;
                  ?>

                  <?php if($this->countModules('maintop1') || $this->countModules('maintop2') || $this->countModules('maintop3')) : ?>

                    <div id="fav-maintop" class="favth-content-block favth-clearfix">
                      <?php if ($this->countModules('maintop1')): ?>
                          <div id="fav-maintop1"
                            class="<?php if ( $maintop == 1 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            elseif ( $maintop == 3 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            elseif ( $maintop == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12');
                            endif; ?>">

                            <jdoc:include type="modules" name="maintop1" style="fav" />

                          </div>
                      <?php endif; ?>
                            <?php if ($this->countModules('maintop2')): ?>
                        <div id="fav-maintop2"
                          class="<?php if ( $maintop == 1 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $maintop == 2 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $maintop == 4 ):echo ('favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                          <jdoc:include type="modules" name="maintop2" style="fav" />

                        </div>
                      <?php endif; ?>
                            <?php if ($this->countModules('maintop3')): ?>
                        <div id="fav-maintop3"
                          class="<?php if ( $maintop == 2 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          elseif ( $maintop == 3 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $maintop == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                          <jdoc:include type="modules" name="maintop3" style="fav" />

                        </div>
                       <?php endif; ?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>

        <?php endif; ?>

  			<!-- MAIN -->
        <div id="fav-mainwrap">
          <div class="favth-container">
            <div class="favth-row">

  						<div id="fav-main" class="favth-clearfix">

  							<?php if ($this->countModules('sidebar1') && $this->countModules('sidebar2')): ?>
  								<div id="fav-sidebar1" class="favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12">
  										<jdoc:include type="modules" name="sidebar1" style="fav" />
  									</div>
  								<div id="fav-maincontent" class="favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12">
  									<jdoc:include type="message" />
  									<jdoc:include type="component" />
  								</div>
  								<div id="fav-sidebar2" class="favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12">
  										<jdoc:include type="modules" name="sidebar2" style="fav" />
  									</div>
  							<?php elseif ( $this->countModules('sidebar1')) : ?>
  								<div id="fav-sidebar1" class="favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12">
  										<jdoc:include type="modules" name="sidebar1" style="fav" />
  									</div>
  								<div id="fav-maincontent" class="favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12">
  									<jdoc:include type="message" />
  									<jdoc:include type="component" />
  								</div>
  							<?php elseif ( $this->countModules('sidebar2')): ?>
  								<div id="fav-maincontent" class="favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12">
  									<jdoc:include type="message" />
  									<jdoc:include type="component" />
  								</div>
  								<div id="fav-sidebar2" class="favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12">
  										<jdoc:include type="modules" name="sidebar2" style="fav" />
  									</div>
  							<?php else : ?>
  								<div id="fav-maincontent" class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
  									<jdoc:include type="message" />
  									<jdoc:include type="component" />
  								</div>
  							<?php endif; ?>

  						</div>

            </div>
  				</div>
  			</div>

  			<!-- MAINBOTTOM -->
        <?php if($this->countModules('mainbottom1') || $this->countModules('mainbottom2') || $this->countModules('mainbottom3')) : ?>

          <div id="fav-mainbottomwrap" class="<?php echo $mainbottom_bg_style; ?>">
            <div class="<?php echo $mainbottom_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <?php $mainbottom=0;
                      if ($this->countModules('mainbottom1') && $this->countModules('mainbottom2')) $mainbottom=1;
                      if ($this->countModules('mainbottom2') && $this->countModules('mainbottom3')) $mainbottom=2;
                      if ($this->countModules('mainbottom1') && $this->countModules('mainbottom3')) $mainbottom=3;
                      if ($this->countModules('mainbottom1') && $this->countModules('mainbottom2') && $this->countModules('mainbottom3')) $mainbottom=4;
                  ?>

                  <?php if($this->countModules('mainbottom1') || $this->countModules('mainbottom2') || $this->countModules('mainbottom3')) : ?>

                    <div id="fav-mainbottom" class="favth-content-block favth-clearfix">
                      <?php if ($this->countModules('mainbottom1')): ?>
                          <div id="fav-mainbottom1"
                            class="<?php if ( $mainbottom == 1 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            elseif ( $mainbottom == 3 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            elseif ( $mainbottom == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12');
                            endif; ?>">

                            <jdoc:include type="modules" name="mainbottom1" style="fav" />

                          </div>
                      <?php endif; ?>
                            <?php if ($this->countModules('mainbottom2')): ?>
                        <div id="fav-mainbottom2"
                          class="<?php if ( $mainbottom == 1 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $mainbottom == 2 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $mainbottom == 4 ):echo ('favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                          <jdoc:include type="modules" name="mainbottom2" style="fav" />

                        </div>
                      <?php endif; ?>
                            <?php if ($this->countModules('mainbottom3')): ?>
                        <div id="fav-mainbottom3"
                          class="<?php if ( $mainbottom == 2 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          elseif ( $mainbottom == 3 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $mainbottom == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                          <jdoc:include type="modules" name="mainbottom3" style="fav" />

                        </div>
                       <?php endif; ?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>

        <?php endif; ?>

  			<!-- BOTTOM -->
        <?php
        $bottomactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('bottom'.$i)) { $bottomactive++; } }

        if ($bottomactive > 0) {
          if ($bottomactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($bottomactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($bottomactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($bottomactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($bottomactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($bottomactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-bottomwrap" class="<?php echo $bottom_bg_style; ?>">
            <div class="<?php echo $bottom_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-bottom" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('bottom'.$j)): ?>

                          <div id="fav-bottom<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="bottom<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- NOTE -->
        <?php
        $noteactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('note'.$i)) { $noteactive++; } }

        if ($noteactive > 0) {
          if ($noteactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($noteactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($noteactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($noteactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($noteactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($noteactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-notewrap" class="<?php echo $note_bg_style; ?>">
            <div class="<?php echo $note_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-note" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('note'.$j)): ?>

                          <div id="fav-note<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="note<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- BASE -->
        <?php
        $baseactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('base'.$i)) { $baseactive++; } }

        if ($baseactive > 0) {
          if ($baseactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($baseactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($baseactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($baseactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($baseactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($baseactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-basewrap" class="<?php echo $base_bg_style; ?>">
            <div class="<?php echo $base_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-base" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('base'.$j)): ?>

                          <div id="fav-base<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="base<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- BLOCK -->
        <?php
        $blockactive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('block'.$i)) { $blockactive++; } }

        if ($blockactive > 0) {
          if ($blockactive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($blockactive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($blockactive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($blockactive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($blockactive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($blockactive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-blockwrap" class="<?php echo $block_bg_style; ?>">
            <div class="<?php echo $block_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-block" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('block'.$j)): ?>

                          <div id="fav-block<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="block<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- USER -->
        <?php
        $useractive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('user'.$i)) { $useractive++; } }

        if ($useractive > 0) {
          if ($useractive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($useractive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($useractive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($useractive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($useractive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($useractive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-userwrap" class="<?php echo $user_bg_style; ?>">
            <div class="<?php echo $user_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-user" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('user'.$j)): ?>

                          <div id="fav-user<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="user<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

        <!-- MAP -->
        <?php if ($this->countModules('map')) { ?>
          <div id="fav-mapwrap">
              <div id="fav-map">
                <jdoc:include type="modules" name="map" style="fav" />
              </div>
          </div>
        <?php } ?>

  			<!-- FOOTER -->
        <?php
        $footeractive = 0;
        for ($i=1; $i<=$favcolumns ; $i++) { if ($this->countModules('footer'.$i)) { $footeractive++; } }

        if ($footeractive > 0) {
          if ($footeractive == 6) { $favclass = 'favth-col-lg-2 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($footeractive == 5) { $favclass = 'favth-col-lg-2-4 favth-col-md-4 favth-col-sm-6 favth-col-xs-12'; }
          else if ($footeractive == 4) { $favclass = 'favth-col-lg-3 favth-col-md-3 favth-col-sm-6 favth-col-xs-12'; }
          else if ($footeractive == 3) { $favclass = 'favth-col-lg-4 favth-col-md-4 favth-col-sm-4 favth-col-xs-12'; }
          else if ($footeractive == 2) { $favclass = 'favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12'; }
          else if ($footeractive == 1) { $favclass = 'favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'; }
        ?>

          <div id="fav-footerwrap" class="<?php echo $footer_bg_style; ?>">
            <div class="<?php echo $footer_bg_image_overlay; ?>">
              <div class="favth-container">
                <div class="favth-row">

                  <div id="fav-footer" class="favth-content-block favth-clearfix">

                    <?php for ($j=1;$j<=$favcolumns;$j++) { ?>
                      <?php if ($this->countModules('footer'.$j)): ?>

                          <div id="fav-footer<?php echo $j; ?>" class="<?php echo $favclass; ?>">

                            <jdoc:include type="modules" name="footer<?php echo $j; ?>" style="fav" />

                          </div>

                      <?php endif; ?>
                    <?php } ?>

                  </div>

                </div>
              </div>
            </div>
          </div>

        <?php } ?>

  			<!-- COPYRIGHT -->
  			<?php if($this->countModules('copyright1') || $this->countModules('copyright2') || $show_copyright) : ?>

          <div id="fav-copyrightwrap">
            <div class="favth-container">
              <div class="favth-row">

                  <?php $copyright=0;
                    if ($this->countModules('copyright1') && $this->countModules('copyright2')) $copyright=1;
                    if ($this->countModules('copyright2') && $show_copyright) $copyright=2;
                    if ($this->countModules('copyright1') && $show_copyright) $copyright=3;
                    if ($this->countModules('copyright1') && $this->countModules('copyright2') && $show_copyright) $copyright=4;
                  ?>

                  <?php if($this->countModules('copyright1') || $this->countModules('copyright2') || $show_copyright) : ?>

                    <div id="fav-copyright" class="favth-content-block favth-clearfix">

                      <?php if (($show_copyright) !=0) : ?>
                        <div id="fav-showcopyright"
                          class="<?php
                          if ( $copyright == 2 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          elseif ( $copyright == 3 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          elseif ( $copyright == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">
                            <p>&#0169; <?php echo date('Y'); ?>

                              <a href="http://<?php echo htmlspecialchars($copyright_text_link);?>" target="_blank">
                                <?php echo htmlspecialchars($copyright_text);?>
                              </a>

                            </p>

                        </div>
                      <?php endif; ?>

                      <?php if ($this->countModules('copyright1')): ?>
                          <div id="fav-copyright1"
                            class="<?php
                            if ( $copyright == 1 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                            elseif ( $copyright == 3 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                            elseif ( $copyright == 4 ):echo ('favth-col-lg-6 favth-col-md-6 favth-col-sm-6 favth-col-xs-12');
                            else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                            <jdoc:include type="modules" name="copyright1" style="fav" />

                          </div>
                      <?php endif; ?>

                      <?php if ($this->countModules('copyright2')): ?>
                        <div id="fav-copyright2"
                          class="<?php
                          if ( $copyright == 1 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $copyright == 2 ):echo ('favth-col-lg-9 favth-col-md-9 favth-col-sm-9 favth-col-xs-12');
                          elseif ( $copyright == 4 ):echo ('favth-col-lg-3 favth-col-md-3 favth-col-sm-3 favth-col-xs-12');
                          else: echo ('favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12'); endif; ?>">

                          <jdoc:include type="modules" name="copyright2" style="fav" />

                        </div>
                      <?php endif; ?>

                    </div>
                  <?php endif; ?>

              </div>
            </div>
          </div>

        <?php endif; ?>

  			<!-- DEBUG -->
        <?php if ($this->countModules('debug')) { ?>
          <div id="fav-debugwrap">
            <div class="favth-container">
              <div class="favth-row">

                <div id="fav-debug" class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
                  <jdoc:include type="modules" name="debug" style="fav" />
                </div>

              </div>
            </div>
          </div>
        <?php } ?>

  			<!-- BACKTOP -->
        <div id="fav-backtopwrap">
    			<div class="favth-container">
    				<div class="favth-row">
    					<?php if (($show_back_to_top) !=0) : ?>
    						<div id="fav-backtop" class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
    							<a href="#" class="btn backtop" title="<?php echo htmlspecialchars($back_to_top_text);?>">
                    <i class="fa fa-angle-up"></i>
    							</a>
    						</div>
    					<?php endif; ?>
    				</div>
    			</div>
        </div>

  		</div><!-- /fav-container -->

    </div><!-- /fav-overlay -->
  </div><!-- /fav-containerwrap -->

</body>
</html>
