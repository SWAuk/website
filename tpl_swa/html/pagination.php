<?php

defined('_JEXEC') or die;

function pagination_list_render($list)
{
	// Initialise variables.
	$lang = JFactory::getLanguage();
	$html = "<div class=\"art-pager\">";

	$html .= str_replace("pagenav", $list['start']['active'] ? "" : "active", $list['start']['data']);

	$html .= str_replace("pagenav", $list['previous']['active'] ? "" : "active", $list['previous']['data']);

	foreach($list['pages'] as $page) {
		$html .= str_replace("pagenav", !$page['active'] ? "active" : "", $page['data']);
 	}

	$html .= str_replace("pagenav", $list['next']['active'] ? "" : "active", $list['next']['data']);

	$html .= str_replace("pagenav", $list['end']['active'] ? "" : "active", $list['end']['data']);

	$html .= "</div>";
	return $html;
}