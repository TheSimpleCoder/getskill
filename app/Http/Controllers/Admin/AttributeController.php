<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Category\AttributesFormRequest;
use App\Model\Category\Entity\Attribute;
use App\Model\Category\Entity\Category;


class AttributeController extends AdminController
{
    public function __construct()
    {
        $this->middleware('can:manage-categories');
    }

    public function create(Category $category)
    {
        $types = Attribute::typesList();

        return view('admin.categories.attributes.create', compact('category', 'types'));
    }

    public function store(AttributesFormRequest $request, Category $category)
    {
        $data = $this->getAttributeData($request);
        $attribute = $category->attributes()->create($data);

        return redirect()->route('admin.categories.attributes.show', [$category, $attribute]);
    }

    public function show(Category $category, Attribute $attribute)
    {
        return view('admin.categories.attributes.show', compact('category', 'attribute'));
    }

    public function edit(Category $category, Attribute $attribute)
    {
        $types = Attribute::typesList();

        return view('admin.categories.attributes.edit', compact('category', 'attribute', 'types'));
    }

    public function update(AttributesFormRequest $request, Category $category, Attribute $attribute)
    {

        $data = $this->getAttributeData($request);
        $category->attributes()->findOrFail($attribute->id)->update($data);

        return redirect()->route('admin.categories.show', $category);
    }

    public function destroy(Category $category, Attribute $attribute)
    {
//        $category->delete();
        return redirect()->route('admin.categories.show', $category);
    }

    private function getAttributeData(AttributesFormRequest $request): array
    {
        return [
            'name_ru' => $request['name_ru'],
            'name_uk' => $request['name_uk'],
            'type' => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort'],
        ];
    }
}
