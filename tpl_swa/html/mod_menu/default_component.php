<?php
defined('_JEXEC') or die;

// Note: it is important to remove spaces between elements.
$attributes = array(
    'class' => array($item->params->get('menu-anchor_css', '')),
    'title' => $item->params->get('menu-anchor_title', ''));
switch ($item->browserNav) {
    default:
    case 0:
        $attributes['href'] = $item->flink;
        break;
    case 1:
        // _blank
        $attributes['href'] = $item->flink;
        $attributes['target'] = '_blank';
        break;
    case 2:
        // window.open
        $attributes['href'] = $item->flink;
        $attributes['onclick'] = 'window.open(this.href,\'targetWindow\','
            . '\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes\');return false;';
        break;
}

$linktype = $item->menu_image
    ? ('<img class="art-menu-image" src="' . $item->menu_image . '" alt="' . $item->title . '" />'
        . ($item->params->get('menu_text', 1) ? $item->title : ''))
    : $item->title;

if (('horizontal' == $menutype || 'vertical' == $menutype)
    && ('alias' == $item->type && in_array($item->params->get('aliasoptions'), $path) || in_array($item->id, $path)))
{
    $attributes['class'][] = 'active';
}

echo artxTagBuilder('a', $attributes, $linktype);
