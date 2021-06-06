<?php

defined('_JEXEC') or die;

$ARTICLE_ID = 726;

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_swa', JPATH_ADMINISTRATOR);

// Load the article model
JLoader::import('joomla.application.component.model');
JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');
$model = JModelItem::getInstance('Article', 'ContentModel');

// Get everything from the database
$article = JTable::getInstance('content');
$article->load($ARTICLE_ID);

if (!$article->title) {
	$article = (object) ["title" => "Article does not exist", "introtext" => "There are no terms in the current database", "fulltext" => ""];
}

$app      = JFactory::getApplication();
$ticketId = $app->input->getString('ticketId');
?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
	jQuery(document).ready(function() {
		jQuery('#agree').change(function(event) {
			if (jQuery(this).prop('checked')) {
				jQuery('a#submit').removeClass('disabled');
			} else {
				jQuery('a#submit').addClass('disabled');
			}
		});
	});
</script>

<h1><?php echo $article->title ?></h1>
<div class="pre-scrollable"><?php echo $article->introtext . $article->fulltext ?></div>
<div>
	<div class="checkbox" style="padding: 20px 0 5px">
		<input id="agree" type="checkbox" />
		<label>I have read and agree to the terms and conditions</label>
	</div>
	<a href="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase&layout=summary&ticketId=' . $ticketId, false) ?>" id="submit" class="btn btn-primary disabled">Submit</a>
	<a href="<?php echo JRoute::_('index.php?option=com_swa&task=ticketpurchase') ?>" class="btn">Cancel</a>
</div>
