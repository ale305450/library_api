<?php

namespace App\Http\Services;

use App\Http\DTOs\Category\CategoryDto;
use App\Models\Category;

class CategoryService
{
    public function storeCategorySevice(CategoryDto $categoryDto): Category
    {
        return Category::create(['name' => $categoryDto->name]);
    }

    public function updateCategorySevice(CategoryDto $categoryDto, Category $category)
    {
        $category->update([
            'name' => $categoryDto->name
        ]);
    }

    public function deleteCategorySevice(Category $category)
    {
        $category->delete();
    }
}
