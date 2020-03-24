<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Category\RegionFormRequest;
use App\Model\Region\Entity\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegionController extends AdminController
{

    public function __construct()
    {
        $this->middleware('can:manage-regions');
    }

    public function index(Request $request)
    {
        $query = Region::orderBy('name_ru');

        if (!empty($value = $request->get('name'))) {
            $query->where('name_ru', 'like', '%' . $value . '%');
        }

        $regions = $query->paginate(25);

        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }


    public function store(RegionFormRequest $request)
    {
        $slug = Str::slug($request['name_ru'], '_');

        if (Region::where('slug', $slug)->exists()) {
            $slug = $slug . time();
        }

        $region = Region::create([
            'name_ru' => $request['name_ru'],
            'name_uk' => $request['name_uk'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.regions.show', $region);
    }

    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(RegionFormRequest $request, Region $region)
    {
        $slug = Str::slug($request['name_ru'], '_');

        if ($request['name_ru'] != $region->name_ru){
            $slug = Str::slug($request['name_ru'], '_');
            if (Region::where('slug', $slug)->exists()) {
                $slug = $slug . time();
            }
        }

        $region->update([
            'name_ru' => $request['name_ru'],
            'name_uk' => $request['name_uk'],
            'slug' => $slug,
        ]);

        return redirect()->route('admin.regions.show', $region);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index');
    }
}
