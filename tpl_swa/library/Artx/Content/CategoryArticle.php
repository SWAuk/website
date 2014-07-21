<?php
defined('_JEXEC') or die;

Artx::load("Artx_Content_ListItem");

class ArtxContentCategoryArticle extends ArtxContentListItem
{
    function __construct($component, $componentParams, $article, $articleParams)
    {
        parent::__construct($component, $componentParams, $article, $articleParams);
        $this->category = $this->_articleParams->get('show_category') ? $this->_article->category_title : '';
        $this->categoryLink = $this->_articleParams->get('link_category')
                                ? JRoute::_(ContentHelperRoute::getCategoryRoute($this->_article->catid))
                                : '';
        $this->parentCategory = $this->_articleParams->get('show_parent_category') && $this->_article->parent_id != 1
                                  ? $this->_article->parent_title : '';
        $this->parentCategoryLink = $this->_articleParams->get('link_parent_category')
                                      ? JRoute::_(ContentHelperRoute::getCategoryRoute($this->_article->parent_id))
                                      : '';
    }
}
