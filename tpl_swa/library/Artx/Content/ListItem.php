<?php
defined('_JEXEC') or die;

Artx::load("Artx_Content_Item");

abstract class ArtxContentListItem extends ArtxContentItem
{
    public $intro;

    protected function __construct($component, $componentParams, $article, $articleParams)
    {
        parent::__construct($component, $componentParams, $article, $articleParams);
        $this->isPublished = 0 != $this->_article->state;
        $this->titleLink = $this->_articleParams->get('link_titles') && $this->_articleParams->get('access-view')
                             ? JRoute::_(ContentHelperRoute::getArticleRoute($this->_article->slug, $this->_article->catid))
                             : '';
        $this->intro = $this->_article->introtext;
        if ($this->_articleParams->get('show_readmore') && $this->_article->readmore) {
            if (!$this->_articleParams->get('access-view'))
                $this->readmore = JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
            elseif ($this->readmore = $this->_article->alternative_readmore) {
                if ($this->_articleParams->get('show_readmore_title', 0) != 0)
                    $this->readmore .= JHtml::_('string.truncate', ($this->_article->title), $this->_articleParams->get('readmore_limit'));
            } elseif ($this->_articleParams->get('show_readmore_title', 0) == 0)
                $this->readmore = JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
            else
                $this->readmore = JText::_('COM_CONTENT_READ_MORE')
                                    . JHtml::_('string.truncate', $this->_article->title,
                                               $this->_articleParams->get('readmore_limit'));
            if ($this->_articleParams->get('access-view')){
                $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->_article->slug, $this->_article->catid));
                $this->readmoreLink = $link;
            } else {
                $menu = JFactory::getApplication()->getMenu();
                $active = $menu->getActive();
                $itemId = $active->id;
                $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
                $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->_article->slug, $this->_article->catid));
                $link = new JURI($link1);
                $link->setVar('return', base64_encode($returnURL));
                $this->readmoreLink = $link->__toString();
            }
        } else {
            $this->readmore = '';
            $this->readmoreLink = '';
        }
    }

    public function intro($intro)
    {
        return "<div class=\"art-article\">" . $intro . "</div>";
    }
}
