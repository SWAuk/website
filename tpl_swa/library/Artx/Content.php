<?php
defined('_JEXEC') or die;

/**
 * Contains the article factory method and content component rendering helpers.
 */
Artx::load("Artx_Content_ArchivedArticle");
Artx::load("Artx_Content_SingleArticle");
Artx::load("Artx_Content_CategoryArticle");
Artx::load("Artx_Content_FeaturedArticle");

class ArtxContent
{
    protected $_component;
    protected $_componentParams;

    public $pageClassSfx;

    public $pageHeading;

    public function __construct($component, $params)
    {
        $this->_component = $component;
        $this->_componentParams = $params;

        $this->pageClassSfx = $component->pageclass_sfx;
        $this->pageHeading = $this->_componentParams->get('show_page_heading', 1)
                               ? $this->_componentParams->get('page_heading') : '';
    }

    public function pageHeading($title = null)
    {
        return artxPost(array('header-text' => $this->_component->escape(null == $title ? $this->pageHeading : $title)));
    }

    public function article($view, $article, $params, $properties = array())
    {
        switch ($view) {
            case 'archive':
                return new ArtxContentArchivedArticle($this->_component, $this->_componentParams,
                                                      $article, $params);
            case 'article':
                return new ArtxContentSingleArticle($this->_component, $this->_componentParams,
                                                    $article, $params, $properties);
            case 'category':
                return new ArtxContentCategoryArticle($this->_component, $this->_componentParams,
                                                      $article, $params);
            case 'featured':
                return new ArtxContentFeaturedArticle($this->_component, $this->_componentParams,
                                                      $article, $params);
        }
    }

    public function beginPageContainer($class)
    {
        return '<div class="' . $class . $this->pageClassSfx .'">';
    }

    public function endPageContainer()
    {
        return '</div>';
    }
}
