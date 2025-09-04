

<?php
class FilterBLL {
    private $dal;

    public function __construct($conn) {
        $this->dal = new FilterDAL($conn);
    }

    public function getSalesWithFilters($filters) {
        return $this->dal->getFilteredSales($filters);
    }
}
