<?php
defined('_JEXEC') or die;

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'functions.php';

if ('artisteer' == JFactory::getApplication()->getTemplate(true)->params->get('blogLayoutType')) {
    require 'art_blog.php';
    return;
}

Artx::load("Artx_Content");

$view = new ArtxContent($this, $this->params);

echo $view->beginPageContainer('blog');
ob_start();
if ($this->params->get('show_category_title', 1) || strlen($this->params->get('page_subheading'))) {
    echo '<h2>';
    echo $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title') && strlen($this->category->title))
        echo '<span class="subheading-category">' . $this->category->title . '</span>';
    echo '</h2>';
}

if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) {
    echo '<div class="category-desc">';
    if ($this->params->get('show_description_image') && $this->category->getParams()->get('image'))
        echo '<img src="' . $this->category->getParams()->get('image') . '" alt="" />';
    if ($this->params->get('show_description') && $this->category->description)
        echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category');
    echo '</div>';
}
echo artxPost(array('header-text' => $view->pageHeading, 'content' => ob_get_clean()));

?>
<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<div class="items-leading">
    <?php foreach ($this->lead_items as &$item) : ?>
        <div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
        </div>
        <?php $leadingcount++; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>
<?php
    $introcount = (count($this->intro_items));
    $counter = 0;
?>
<?php if (!empty($this->intro_items)) : ?>
    <?php foreach ($this->intro_items as $key => &$item) : ?>
    <?php
        $key= ($key-$leadingcount)+1;
        $rowcount=( ((int)$key-1) % (int) $this->columns) +1;
        $row = $counter / $this->columns ;
        if ($rowcount==1) : ?>
            <div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
       <?php endif; ?>
    <div class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
    <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
    ?>
    </div>
        <?php $counter++; ?>
        <?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
    <span class="row-separator"></span>
</div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php
if (!empty($this->link_items)) {
    ob_start();
    echo '<div class="items-more">' . $this->loadTemplate('links') . '</div>';
    echo artxPost(ob_get_clean());
}
?>
<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
    <?php ob_start(); ?>
    <div class="cat-children">
        <h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
        <?php echo $this->loadTemplate('children'); ?>
    </div>
    <?php echo artxPost(ob_get_clean()); ?>
<?php endif; ?>
<?php

if (($this->params->def('show_pagination', 1) == 1 || $this->params->get('show_pagination') == 2)
    && $this->pagination->get('pages.total') > 1)
{
    ob_start();
    echo '<div class="pagination">';
    if ($this->params->def('show_pagination_results', 1))
        echo '<p class="counter">' . $this->pagination->getPagesCounter() . '</p>';
    echo $this->pagination->getPagesLinks();
    echo '</div>';
    echo ob_get_clean();
}

echo $view->endPageContainer();
