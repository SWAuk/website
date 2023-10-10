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
$templateparams = $app->getTemplate(true)->params;

$current_url = JURI::current();

// Get 404 article or redirect to default error page if article is not published
if ($this->error->getCode() == '404') {
	$redirect = true;
	if ((isset($_GET['view']) && isset($_GET['id']) && $_GET['view'] == 'article' && $_GET['id'] == $templateparams->get('error_page_article_id')) || strstr($current_url,'.css') !== FALSE || strstr($current_url,'.js') !== FALSE) { $redirect = false; }
	if ($redirect) {

		$db = JFactory::getDBO();
		$query = "SELECT state FROM #__content WHERE id =".(int)$templateparams->get('error_page_article_id');
    $db->setQuery($query);
    $ispub = $db->LoadResult();

    if ($ispub) {
			$errorurl = $this->baseurl.'/index.php?option=com_content&view=article&id='.$templateparams->get('error_page_article_id');
	    header('Location: '.$errorurl); exit;
  	}

  }
}

if (!isset($this->error))
{
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

// Get language and direction
$doc             = JFactory::getDocument();
$app             = JFactory::getApplication();
$this->language  = $doc->language;
$this->direction = $doc->direction;
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

  <head>

    <title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- STYLESHEETS -->
    <!-- icons -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/bootstrap/bootstrap.css" type="text/css" />
    <!-- cms -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/cms.css" type="text/css" />
    <!-- theme -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/theme.css" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/style.css" type="text/css" />

  </head>

  <body id="fav-errorpage">

    <div class="favth-container">
      <div class="favth-row">
        <div class="favth-col-lg-12 favth-col-md-12 favth-col-sm-12 favth-col-xs-12">
          <h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
          <div class="favth-well">

              <p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>

              <p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
              <ol class=list-square>
                <li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
                <li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
                <li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
                <li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
              </ol>

              <?php if (JModuleHelper::getModule('search')) : ?>
                <p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
                <p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
                <?php echo $doc->getBuffer('module', 'search'); ?>
              <?php endif; ?>

							<br>
							<a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><span class="icon-home"></span> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>

          </div>

          <hr />
          <p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
          <p><span class="favth-label favth-label-default"><?php echo $this->error->getCode(); ?></span> <?php echo $this->error->getMessage();?></p>
        </div>
      </div>
    </div>

  </body>
</html>