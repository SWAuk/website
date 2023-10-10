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

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

$twofactormethods = UsersHelper::getTwoFactorMethods();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />

		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/offline.css" type="text/css" />
		<?php if ($this->direction == 'rtl') : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/offline_rtl.css" type="text/css" />
		<?php endif; ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />

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
    <!-- styles -->
    <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/styles/<?php echo $this->params->get('template_styles'); ?>.css" type="text/css" />
    <!-- custom -->
    <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/custom.css" type="text/css" />

		<?php require("admin/params.php"); ?>

</head>
<body id="fav-offlinewrap" class="fav-container">
<jdoc:include type="message" />

	<div id="fav-offline" class="<?php echo htmlspecialchars($offline_page_style);?>">

		<div id="frame" class="outline">

				<?php if ($app->get('offline_image') && file_exists($app->get('offline_image'))) : ?>

					<img src="<?php echo $app->get('offline_image'); ?>" alt="<?php echo htmlspecialchars($app->get('sitename')); ?>" />

				<?php elseif (($show_default_logo) !=0 || ($show_media_logo) !=0 || ($show_text_logo) !=0) : ?>

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
								<img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($media_logo);?>" style="border:0;" alt="<?php echo htmlspecialchars($media_logo_img_alt );?>" />
							</a>
						</h1>
					<?php endif;?>
					<?php if (($show_text_logo) !=0) : ?>
						<h1>
							<a class="text-logo" href="<?php echo $this->baseurl; ?>/"><?php echo htmlspecialchars($text_logo);?></a>
						</h1>
					<?php endif;?>

		  	<?php else : ?>

					<h1>
						<?php echo htmlspecialchars($app->get('sitename')); ?>
					</h1>

				<?php endif; ?>

				<?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>

					<p class="fav-offline-msg">
						<?php echo $app->get('offline_message'); ?>
					</p>

				<?php elseif ($app->get('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != '') : ?>

					<p class="fav-offline-msg">
						<?php echo JText::_('JOFFLINE_MESSAGE'); ?>
					</p>

				<?php endif; ?>

			<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">

				<fieldset class="input">
					<p id="form-login-username">
						<label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
						<input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="18" />
					</p>
					<p id="form-login-password">
						<label for="passwd"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
						<input type="password" name="password" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" id="passwd" />
					</p>
					<?php if (count($twofactormethods) > 1) : ?>
						<p id="form-login-secretkey">
							<label for="secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY'); ?></label>
							<input type="text" name="secretkey" class="inputbox" size="18" alt="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" id="secretkey" />
						</p>
					<?php endif; ?>
					<p id="submit-buton">
						<label>&nbsp;</label>
						<input type="submit" name="Submit" class="btn btn-primary login" value="<?php echo JText::_('JLOGIN'); ?>" />
					</p>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="user.login" />
					<input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" />
					<?php echo JHtml::_('form.token'); ?>
				</fieldset>
			</form>

		</div>

	</div>

</body>
</html>
