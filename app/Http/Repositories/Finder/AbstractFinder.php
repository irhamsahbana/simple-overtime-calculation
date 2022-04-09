<?php

namespace App\Http\Repositories\Finder;

use Illuminate\Http\Request;

abstract class AbstractFinder
{
    protected $query;
    protected $isUsePagination = true;
    protected $order_type = 'ASC';

    private $page = 1;
    private $per_page = 10;

    public function setPage($page)
    {
        $this->page = $page;
    }

    protected function getPage()
    {
        return $this->page;
    }

    public function setPerPage($perPage)
    {
        $this->per_page = $perPage;
    }

    protected function getPerPage()
    {
        return $this->per_page;
    }

    public function setOrderType($orderType)
    {
        $orderType = strtoupper($orderType);

        if ($orderType == 'ASC' || $orderType == 'DESC')
            $this->order_type = $orderType;
    }

    public function setIsUsePagination($isUsePagination)
    {
        $this->isUsePagination = $isUsePagination;
    }

    public function get()
    {
        $query = $this->query;

        if ($this->isUsePagination)
            return $query->paginate($this->getPerPage())->withQueryString();
        else
            return $query->get();
    }
}