<?php

namespace App\Http\ViewComposers;

use App\Model\Category\Entity\Category;
use Illuminate\View\View;

class LayoutComposer
{
    public function compose(View $view): void
    {
        $rootsCategories = [
            Category::ONLINE => Category::getOnlineCategory(),
            Category::OFFLINE => Category::getOfflineCategory(),
            Category::MASTER => Category::getMasterCategory(),
        ];
        $view->with('rootsCategories', $rootsCategories);
    }
}
