<?php

class Paging
    {
        function showPaging($totalItems, $activePage = 1, $contentName = 'Scraps', $method = 'get')
        {
            $url = $_SERVER['SCRIPT_NAME'];
            $arguments = '?';
            foreach ($_GET as $getKey => $getValue) {
                if ($getKey != 'page') {
                    if ($arguments != '?')
                        $arguments .= '&' . $getKey . '=' .  $getValue;
                    else
                        $arguments .= $getKey . '=' .  $getValue;
                }
            }
            if ($arguments != '?')
                $arguments .= '&';
            if ($totalItems == 0)
                return array('startItem' => 0, 'pagingHtml' => '');
            $totalPages = ceil($totalItems / ITEMS_PER_PAGE);
            $startPage = (floor(($activePage-1) / PAGES_PER_BLOCK) * PAGES_PER_BLOCK) + 1;
            $endPage = $startPage + PAGES_PER_BLOCK - 1;
            if ($endPage > $totalPages)
                $endPage = $totalPages;
            $startItem = ($activePage - 1) * ITEMS_PER_PAGE;
            $endItemOfPage = $startItem + ITEMS_PER_PAGE;
            if ($endItemOfPage > $totalItems)
                $endItemOfPage = $totalItems;
            $pagingHtml = "<div id='paging'>Showing " . ($startItem + 1) . " to " .$endItemOfPage
                        . " of " . $totalItems . " " . $contentName . "<br /><ul>";
            if ($activePage > PAGES_PER_BLOCK) {
            	if ($method == 'get')
                	$pagingHtml .= "<li><a href='" . $url . $arguments . "page=" . ($startPage - PAGES_PER_BLOCK) . "'><<</a></li>";
                else
            		$pagingHtml .= "<li><a href='#' onclick=\"goToPage('" . ($startPage - PAGES_PER_BLOCK) . "')\"><<</a></li>";
            }
            if ($activePage > 1) {
            	if ($method == 'get')
                	$pagingHtml .= "<li><a href='" . $url . $arguments . "page=" . ($activePage - 1) . "'>Prev</a></li>";
                else
            		$pagingHtml .= "<li><a href='#' onclick=\"goToPage('" . ($activePage - 1) . "')\">Prev</a></li>";
            }
            for ($count = $startPage; $count <= $endPage; $count++) {
                if ($count != $activePage) {
	            	if ($method == 'get')
	                	$pagingHtml .= "<li><a href='" . $url . $arguments . "page=" . ($count) . "'>" . $count . "</a></li>";
	                else
	                    $pagingHtml .= "<li><a href='#' onclick=\"goToPage('" . $count . "')\">" . $count . "</a></li>";
                } else
                    $pagingHtml .= "<li>" . $count . "</li>";
            }
            if ($activePage < $totalPages) {
            	if ($method == 'get')
                	$pagingHtml .= "<li><a href='" . $url . $arguments . "page=" . ($activePage + 1) . "'>Next</a></li>";
                else
	                $pagingHtml .= "<li><a href='#' onclick=\"goToPage('" . ($activePage + 1) . "')\">Next</a></li>";
            }
            if (($startPage + PAGES_PER_BLOCK) <=  $totalPages) {
            	if ($method == 'get')
                	$pagingHtml .= "<li><a href='" . $url . $arguments . "page=" . ($startPage + PAGES_PER_BLOCK) . "'>>></a></li>";
                else
                    $pagingHtml .= "<li><a href='#' onclick=\"goToPage('" . ($startPage + PAGES_PER_BLOCK) . "')\">>></a></li>";
            }
            $pagingHtml .= "</ul></div>";
            $pagingReturn = array('startItem' => $startItem, 'pagingHtml' => $pagingHtml);
            return $pagingReturn;
        }
    }