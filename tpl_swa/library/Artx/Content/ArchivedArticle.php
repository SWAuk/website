<?php
defined('_JEXEC') or die;

Artx::load("Artx_Content_ArticleBase");

class ArtxContentArchivedArticle extends ArtxContentArticleBase
{
    public $intro;

    public function __construct($component, $componentParams, $article, $articleParams)
    {
        parent::__construct($component, $componentParams, $article, $articleParams);
        $this->titleLink = $this->_articleParams->get('link_titles')
                             ? JRoute::_(ContentHelperRoute::getArticleRoute($this->_article->slug, $this->_article->catslug))
                             : '';
        $this->category = $this->_articleParams->get('show_category') ? $this->_article->category_title : '';
        $this->categoryLink = $this->_articleParams->get('link_category') && $this->_article->catslug
                                ? JRoute::_(ContentHelperRoute::getCategoryRoute($this->_article->catslug))
                                : '';
        $this->parentCategoryLink = $this->_articleParams->get('link_parent_category') && $this->_article->parent_slug
                                      ? JRoute::_(ContentHelperRoute::getCategoryRoute($this->_article->parent_slug))
                                      : '';
        $this->intro = $this->_articleParams->get('show_intro') ? $this->_article->introtext : '';
    }

    public function intro($intro)
    {
        return '<div class="art-article">'
                 . JHtml::_('string.truncate', $intro,
                            $this->_articleParams->get('introtext_limit'))
                . '</div>';
    }
}
