<?php
require_once 'models/StoreModel.php';

class StoreController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new StoreModel($db);
    }

    // Generalized method to view store with optional filters
    private function renderStore($filterType = null, $filterId = null)
    {
        // Fetch products based on filter type and ID
        $products_data = [];
        if ($filterType === 'category') {
            $products_data = $this->model->getProductsByCategory($filterId);
        } elseif ($filterType === 'brand') {
            $products_data = $this->model->getProductsByBrand($filterId);
        } else {
            $products_data = $this->model->getAllProducts();
        }

        // Prepare data for view
        $products = [];
        foreach ($products_data as $item) {
            array_push($products, $item);
        }

        $top_products_data = $this->model->getTopProducts();
        $top_products = [];
        foreach ($top_products_data as $item) {
            array_push($top_products, $item);
        }

        $brands = $this->model->getBrands();
        $categories = $this->model->getCategories();

        // Include view
        include 'views/store.php';
    }

    public function view()
    {
        $this->renderStore(); // No filters
    }

    public function view_category($cid)
    {
        $this->renderStore('category', $cid);
    }

    public function view_brand($bid)
    {
        $this->renderStore('brand', $bid);
    }
}
