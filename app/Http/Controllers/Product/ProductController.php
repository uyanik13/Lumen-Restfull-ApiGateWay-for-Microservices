<?php

namespace App\Http\Controllers\Product;


use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ProductController  extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books micro-service
     * @var ProductService
     */
    public $productService;

    /**
     *  The service to consume the authors micro-service
     * @var $authorService;
     */
    public $authorService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Get Book data
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->successResponse($this->productService->all());
    }


    /**
     * Save an book data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->productService->create($request->all()));
    }


    /**
     * Show a single book details
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($product)
    {
        return $this->successResponse($this->productService->show($product));
    }


    /**
     * Update a single book data
     * @param Request $request
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $product)
    {
        
        return $this->successResponse($this->productService->edit($request->all(),$product));
    }


    /**
     * Delete a single book details
     * @param $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($product)
    {
        return $this->successResponse($this->productService->delete($product));
    }

}
