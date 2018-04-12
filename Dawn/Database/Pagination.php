<?php

namespace Dawn\Database;

class Pagination
{
    protected $items;
    protected $itemsPerPage;
    protected $pages;
    protected $currentPage = 1;
    protected $limit;
    protected $offset;

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }
}