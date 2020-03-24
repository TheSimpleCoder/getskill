<?php

namespace App\Http\Controllers\Admin\Publisher;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Publisher\Category\CategoryFormRequest;
use App\Model\Publisher\Category\Entity\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CategoryController extends AdminController
{
    public function __construct()
    {
        $this->middleware('can:manage-publisher-categories');
    }

    public function index(Request $request)
    {
        $categories = Category::getAll();
        return view('admin.publisher.categories.index', compact('categories'));
    }



    public function create(Category $category)
    {
        $parents = Category::getAll();
        return view('admin.publisher.categories.create', compact('parents'));
    }

    public function store(CategoryFormRequest $request)
    {
        $image = $request['image'];

        $slug = Str::slug($request['name_ru'], '_');
        if (Category::where('slug', $slug)->exists()) {
            $slug = $slug . time();
        }

        $category = Category::create([
            'name_ru' => $request['name_ru'],
            'name_uk' => $request['name_uk'],
            'slug' => $slug,
            'description_ru' => $request['description_ru'],
            'description_uk' => $request['description_uk'],
            'parent_id' => $request['parent'],
            'image' => $image ? $image->store(Category::IMAGE_PATH, 'public') : null,
            'meta_title_ru' => $request['meta_title_ru'],
            'meta_title_uk' => $request['meta_title_uk'],
            'meta_description_ru' => $request['meta_description_ru'],
            'meta_description_uk' => $request['meta_description_uk'],
            'meta_keywords_ru' => $request['meta_keywords_ru'],
            'meta_keywords_uk' => $request['meta_keywords_uk'],
        ]);

        return redirect()->route('admin.publisher.categories.show', $category);
    }

    public function show(Category $category)
    {
        return view('admin.publisher.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parents = Category::getAll();
        return view('admin.publisher.categories.edit', compact('category', 'parents'));
    }

    public function update(CategoryFormRequest $request, Category $category)
    {

        $image = $request['image'];

        $slug = $category->slug;

        if ($request['name_ru'] != $category->name_ru){
            $slug = Str::slug($request['name_ru'], '_');
            if (Category::where('slug', $slug)->exists()) {
                $slug = $slug . time();
            }
        }


        $category->update([
            'name_ru' => $request['name_ru'],
            'name_uk' => $request['name_uk'],
            'slug' => $slug,
            'description_ru' => $request['description_ru'],
            'description_uk' => $request['description_uk'],
            'parent_id' => $request['parent'],
            'meta_title_ru' => $request['meta_title_ru'],
            'meta_title_uk' => $request['meta_title_uk'],
            'meta_description_ru' => $request['meta_description_ru'],
            'meta_description_uk' => $request['meta_description_uk'],
            'meta_keywords_ru' => $request['meta_keywords_ru'],
            'meta_keywords_uk' => $request['meta_keywords_uk'],
        ]);

        if ($image){
            $category->update(['image' => $image->store(Category::IMAGE_PATH, 'public')]);
        }

        return redirect()->route('admin.publisher.categories.show', $category);
    }


    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }
        return back();
    }

    public function up(Category $category)
    {
        $category->up();
        return back();
    }

    public function down(Category $category)
    {
        $category->down();
        return back();
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }

        return back();
    }

    public function deletePhoto(Category $category)
    {
        $this->deleteImageFile($category);
        $category->update(['image' => null]);
        return redirect()->route('admin.publisher.categories.edit', $category);
    }

    public function destroy(Category $category)
    {
        $this->deleteImageFile($category);
        $category->delete();
        return redirect()->route('admin.publisher.categories.index');
    }


    private function deleteImageFile(Category $category): void
    {
        if ($category->image){
            if(Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
        }
    }
}
