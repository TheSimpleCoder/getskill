<?php

namespace App\Model\Publisher\Category\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Kalnoy\Nestedset\NodeTrait;
use Course;

/**
 * @property int $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $slug
 * @property string $description_uk
 * @property string $description_ru
 * @property string $image
 * @property string $meta_title_ru
 * @property string $meta_title_uk
 * @property string $meta_description_ru
 * @property string $meta_description_uk
 * @property string $meta_keywords_ru
 * @property string $meta_keywords_uk
 * @property int|null $parent_id
 * @property int $_lft
 * @property int $_rgh
 *
 * @property int $depth
 * @property Category $parent
 * @property Category[] $children
 */
class Category extends Model
{
    use NodeTrait;

    const IMAGE_PATH = 'publisher_categories';

    protected $table = 'publisher_categories';

    public $timestamps = false;

    protected $fillable = ['name_uk', 'name_ru', 'slug', 'description_uk', 'description_ru', 'image', 'parent_id', 'meta_title_ru', 'meta_title_uk', 'meta_description_ru', 'meta_description_uk', 'meta_keywords_ru', 'meta_keywords_uk'];



    public static function getAll(): Collection
    {
        return self::defaultOrder()->withDepth()->get();
    }

    public function getAllChildren(): Collection
    {
        return $this->descendants()->withDepth()->orderBy('_lft')->get();
    }


    public function getAllChildrenWithSelf(): ?Collection
    {
        $categories = $this->descendants()->withDepth()->orderBy('_lft')->get();
        return $categories ? $categories->prepend($this) : null;
    }


    public function getRoot(): ?self
    {
        $categories = $this->getAncestors();
        /** @var self $category */
        foreach ($categories as $category){
            if ($category->getDepth() === 0){
                return $category;
            }
        }
        return null;
    }


    public function getCategoriesForEdit(): ?Collection
    {
        $rootCategory = $this->getRoot();

        if (!$rootCategory){
            return null;
        }

        $children = $rootCategory->getAllChildren();
        $filtered = $children->filter(function (Category $item) {
            return $item->id !== $this->id;
        });

        return $filtered->prepend($rootCategory);
    }



    public function getDepth(): int
    {
        $result = Category::withDepth()->find($this->id);
        return $depth = $result->depth;
    }


    public function getImageUrl(): ?string
    {
        if ($this->image){
            return Storage::disk('public')->url($this->image);
        }
        return  null;
    }

    public function getPerrentCat($id){

        $result = self::where('parent_id', $id)->first();
        if($result == null){
            return "true";
        }
    }

    public function getChildCat($id, $type){
        $count = 0;
        $stack = array();
        

        $return = ['course' => $stack, 'count' => $count];

        return $return;
    }

    public function checkCatCourse($id){
        $cat = Self::where('id', $id)->first();
        if($cat){
            return $cat->parent_id;
        }else{
            return 'null';
        }
    }


}
