<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recursive;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        dd($request->session()->all());
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $htmlOptions = $this->getCategory($parentId = '');
        return view('admin.category.add', compact('htmlOptions'));
    }

    public function store(CategoryRequest $categoryRequest)
    {
        $this->category->create([
            'name' => $categoryRequest->name,
            'parent_id' => $categoryRequest->parent_id,
            'slug' => Str::slug($categoryRequest->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOptions = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('htmlOptions', 'category'));
    }

    public function update(CategoryRequest $categoryRequest, $id)
    {
        $this->category->find($id)->update([
            'name' => $categoryRequest->name,
            'parent_id' => $categoryRequest->parent_id,
            'slug' => Str::slug($categoryRequest->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $this->category->findOrFail($id)->delete();
        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $key_word_search = $request->key_word_search;
        $category = $this->category
            ->where('name', 'like', '%' . $key_word_search . '%');
        if ($category->exists()) {
            $categories = $category->latest()->paginate(5);
            return view('admin.category.search', compact('categories'));
        } else {
            return view('admin.category.notfound');
        }


    }

    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->categoryRecursive($parentId);
    }
}


