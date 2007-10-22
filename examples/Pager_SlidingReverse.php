<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Contains the Pager_SlidingReverse class
 *
 * PHP versions 4 and 5
 *
 * LICENSE: Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 * 3. The name of the author may not be used to endorse or promote products
 *    derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR "AS IS" AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE FREEBSD PROJECT OR CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  HTML
 * @package   Pager
 * @author    Lorenzo Alberton <l.alberton@quipo.it>
 * @copyright 2003-2007 Lorenzo Alberton
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   CVS: $Id$
 * @link      http://pear.php.net/package/Pager
 */

/**
 * require PEAR::Pager_Sliding base class
 */
require_once 'Pager/Sliding.php';

/**
 * Pager_SlidingReverse - Generic data paging class  ("sliding window" style)
 * Usage examples can be found in the PEAR manual
 *
 * @category  HTML
 * @package   Pager
 * @author    Lorenzo Alberton <l.alberton@quipo.it>
 * @copyright 2003-2007 Lorenzo Alberton
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://pear.php.net/package/Pager
 */
class Pager_SlidingReverse extends Pager_Sliding
{
    // {{{ build()

    /**
     * Generate or refresh the links and paged data after a call to setOptions()
     *
     * @return void
     * @access public
     */
    function build()
    {
        //reset
        $this->_pageData = array();
        $this->links = '';

        $this->_generatePageData();
        $this->_setFirstLastText();

        if ($this->_totalPages > (2 * $this->_delta + 1)) {
            $this->links .= $this->_printLastPage();
        }

        $this->links .= $this->_getNextLink();
        $this->links .= $this->_getPageLinks();
        $this->links .= $this->_getBackLink();

        $this->linkTags .= $this->_getFirstLinkTag();
        $this->linkTags .= $this->_getPrevLinkTag();
        $this->linkTags .= $this->_getNextLinkTag();
        $this->linkTags .= $this->_getLastLinkTag();

        if ($this->_totalPages > (2 * $this->_delta + 1)) {
            $this->links .= $this->_printFirstPage();
        }
    }

    // }}}
    // {{{ _getBackLink()

    /**
     * Returns back link
     *
     * @param string $url  URL to use in the link  [deprecated: use the factory instead]
     * @param string $link HTML to use as the link [deprecated: use the factory instead]
     * @return string The link
     * @access private
     */
    function _getBackLink($url='', $link='')
    {
        //legacy settings... the preferred way to set an option
        //now is passing it to the factory
        if (!empty($url)) {
            $this->_path = $url;
        }
        if (!empty($link)) {
            $this->_nextImg = $link;
        }
        $next = '';
        if ($this->_currentPage > 1) {
            $this->_linkData[$this->_urlVar] = $this->getNextPageID();
            $next = $this->_renderLink($this->_altNext, $this->_nextImg)
                  . $this->_spacesBefore . $this->_spacesAfter;
        }
        return $next;
    }

    // }}}
    // {{{ _getNextLink()

    /**
     * Returns next link
     *
     * @param string $url  URL to use in the link  [deprecated: use the factory instead]
     * @param string $link HTML to use as the link [deprecated: use the factory instead]
     * @return string The link
     * @access private
     */
    function _getNextLink($url='', $link='')
    {
        //legacy settings... the preferred way to set an option
        //now is passing it to the factory
        if (!empty($url)) {
            $this->_path = $url;
        }
        if (!empty($link)) {
            $this->_prevImg = $link;
        }
        $back = '';
        if ($this->_currentPage < $this->_totalPages) {
            $this->_linkData[$this->_urlVar] = $this->getPreviousPageID();
            $back = $this->_spacesBefore . $this->_spacesAfter
                  . $this->_renderLink($this->_altPrev, $this->_prevImg)
                  . $this->_spacesAfter;
        }
        return $back;
    }

    // }}}
    // {{{ getNextPageID()

    /**
     * Returns next page ID. If current page is last page
	 * this function returns FALSE
	 *
	 * @return mixed Next page ID
     */
	function getNextPageID()
	{
		return parent::getPreviousPageID();
	}

	// }}}
    // {{{ getPreviousPageID()

    /**
     * Returns previous page ID. If current page is first page
	 * this function returns FALSE
	 *
	 * @return mixed Previous pages' ID
     */
	function getPreviousPageID()
	{
		return parent::getNextPageID();
	}

    // }}}
    // {{{ _generatePageData()

    /**
     * Calculates all page data
     *
     * @return void
     * @access private
     */

    function _generatePageData()
    {
        // Been supplied an array of data?
        if (!is_null($this->_itemData)) {
            $this->_totalItems = count($this->_itemData);
        }
        $this->_totalPages = ceil((float)$this->_totalItems / (float)$this->_perPage);
        $i = 1;
        if (!empty($this->_itemData)) {
            foreach ($this->_itemData as $key => $value) {
                $this->_pageData[$i][$key] = $value;
                if (count($this->_pageData[$i]) >= $this->_perPage) {
                    ++$i;
                }
            }
        } else {
            $this->_pageData = array();
        }

        //start from last page
        if (!isset($_REQUEST[$this->_urlVar]) && empty($options['currentPage'])) {
            $this->_currentPage = $this->_totalPages;
        }
        //prevent URL modification
        $this->_currentPage = min($this->_currentPage, $this->_totalPages);
    }

    // }}}
    // {{{ _getPageLinks()

    /**
     * Returns pages link
     *
     * @param string $url URL to use in the link
     *                    [deprecated: use the constructor instead]
     * @return string Links
     * @access private
     */
    function _getPageLinks($url = '')
    {
        //legacy setting... the preferred way to set an option now
        //is adding it to the constuctor
        if (!empty($url)) {
            $this->_path = $url;
        }
        
        //If there's only one page, don't display links
        if ($this->_clearIfVoid && ($this->_totalPages < 2)) {
            return '';
        }
        $links = '';
        if ($this->_totalPages > (2 * $this->_delta + 1)) {
            if ($this->_currentPage <= $this->_delta) {
                $expansion_before = $this->_delta - $this->_currentPage + 1;
            } else {
                $expansion_before = 0;
            }
            if (($this->_totalPages - $this->_currentPage) <= $this->_delta) {
                $expansion_after = $this->_currentPage - ($this->_totalPages - $this->_delta);
            } else {
                $expansion_after = 0;
            }
            
            if ($this->_expanded && $expansion_before) {
                for ($i = $this->_currentPage + $expansion_before + $this->_delta; $expansion_before; $expansion_before--, $i--) {
                    //$print_separator_flag = ($i != $this->_currentPage + $this->_delta); // && ($i != $this->_totalPages - 1)
                    $print_separator_flag = true;

                    $this->range[$i] = false;
                    $this->_linkData[$this->_urlVar] = $i;
                    $links .= $this->_renderLink($this->_altPage.' '.$i, $i)
                           . $this->_spacesBefore
                           . ($print_separator_flag ? $this->_separator.$this->_spacesAfter : '');
                }
            }
            
            for ($i = min($this->_totalPages, $this->_currentPage + $this->_delta); ($i >= $this->_currentPage - $this->_delta) && $i; $i--) {
                // check when to print separator
                $print_separator_flag = (
                       ($i < ($this->_currentPage + $this->_delta + 1))
                    && ($i > ($this->_currentPage - $this->_delta ))
                    //&& ($i != $this->_totalPages)
                    && ($i != 1)
                );

                if ($i == $this->_currentPage) {
                    $this->range[$i] = true;
                    $links .= $this->_curPageSpanPre . $i . $this->_curPageSpanPost;
                } else {
                    $this->range[$i] = false;
                    $this->_linkData[$this->_urlVar] = $i;
                    $links .= $this->_renderLink($this->_altPage.' '.$i, $i);
                }
                $links .= $this->_spacesBefore
                        . ($print_separator_flag ? $this->_separator.$this->_spacesAfter : '');
            }
            
            if ($this->_expanded && $expansion_after) {
                for ($i = $this->_currentPage - $this->_delta - 1; $expansion_after; $expansion_after--, $i--) {
                    $print_separator_flag = ($i != $this->_currentPage - $this->_delta); // && ($i != $this->_totalPages - 1)
                    $print_separator_flag = true;

                    $this->range[$i] = false;
                    $this->_linkData[$this->_urlVar] = $i;
                    $links .= ($print_separator_flag ? $this->_separator.$this->_spacesAfter : '')
                           . $this->_renderLink($this->_altPage.' '.$i, $i)
                           . $this->_spacesBefore;
                }
            }
        } else {
            //if $this->_totalPages <= (2*Delta+1) show them all
            for ($i=$this->_totalPages; $i; --$i) {
                if ($i != $this->_currentPage) {
                    $this->range[$i] = false;
                    $this->_linkData[$this->_urlVar] = $i;
                    $links .= $this->_renderLink($this->_altPage.' '.$i, $i);
                } else {
                    $this->range[$i] = true;
                    $links .= $this->_curPageSpanPre . $i . $this->_curPageSpanPost;
                }
                $links .= $this->_spacesBefore
                       . (($i != $this->_totalPages) ? $this->_separator.$this->_spacesAfter : '');
            }
        }
        return $links;
    }

    // }}}
}
?>