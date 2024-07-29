<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    function productList($data, $paginate = false)
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 10;
        
        $search = $data['search'] ?? "";
        $sortColumn = $data['column'] ?? "id";
        $sortDir = $data['sortdir'] ?? "desc";
        $offset = ($page - 1) * $perPage;
        
        $products = $this->product
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%');
                });
            })
            ->limit($perPage)->offset($offset)
            ->orderBy($sortColumn, $sortDir);

        if($paginate) {
            return $products->paginate($perPage, ['*'], 'page', $page);
        }
        return $products->get(); 
    }

    public function getProduct($id)
    {
        return $this->product->find($id);
    }
}
