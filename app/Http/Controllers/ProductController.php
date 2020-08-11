<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use StorageImageTrait;

    public function index()
    {
        $products = Product::orderby('user_id', 'desc')->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOptions = $this->getCategory($parentId = '');
        return view('admin.product.add', compact('htmlOptions'));
    }

    public function store(ProductRequest $request)
    {
        $dataProductCreate = $this->insertDataProduct($request);
        Product::create($dataProductCreate);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $htmlOptions = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOptions', 'product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $dataProductCreate = $this->insertDataProduct($request);
        Product::find($id)->update($dataProductCreate);
        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        $keyWordSearch = $request->key_word_search;
        $product = Product::where('name', 'like', '%' . $keyWordSearch . '%')
            ->orWhere('name_author', 'like', '%' . $keyWordSearch . '%');
        if ($product->exists()) {
            $products = $product->orderby('user_id', 'asc')->paginate(5);
            return view('admin.product.search', compact('products'));
        } else {
            return view('admin.product.notfound');
        }
    }

    public function insertDataProduct($request)
    {
        try {
            $dataProductCreate = [
                'name' => $request->name,
                'name_author' => $request->name_author,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadImage = $this->storageUploadFile($request, 'feature_image_path', 'product');
            if (!empty($dataUploadImage)) {
                $dataProductCreate['image_path'] = $dataUploadImage['file_path'];
                $dataProductCreate['image_name'] = $dataUploadImage['file_name'];
            }
            return $dataProductCreate;
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line: ' . $exception->getLine());
        }

    }

    public function getCategory($parentId)
    {
        $data = Category::all();
        $recursive = new Recursive($data);
        return $recursive->categoryRecursive($parentId);
    }
}
