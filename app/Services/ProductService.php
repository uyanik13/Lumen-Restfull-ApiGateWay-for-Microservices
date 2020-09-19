<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class ProductService
{
    use ConsumeExternalService;

    /**
     * The base uri to consume posts service
     * @var string
     */
    public $baseUri;

    /**
     * Authorization secret to pass to current api
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.products.base_uri');
        $this->secret = config('services.products.secret');
    }


    public function all()
    {
        return $this->performRequest('GET', '/products');
    }

    public function create($data)
    {
        return $this->performRequest('POST', '/products', $data);
    }

    public function show($product)
    {
        return $this->performRequest('GET', "/products/{$product}");
    }

    public function edit($data, $product)
    {
        return $this->performRequest('PUT', "/products/{$product}", $data);
    }

    public function delete($product)
    {
        return $this->performRequest('DELETE', "/products/{$product}");
    }
}