<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\Paginator;
use Modules\Blog\app\Http\Requests\CategoryRequest;
use Modules\Blog\app\Models\Category;
use Modules\Blog\app\Models\NewsCategory;

use Modules\Language\app\Models\Language;

class NewsCategoryController extends Controller
{
    use RedirectHelperTrait;

    public function index()
    {
        checkAdminHasPermissionAndThrowException('blog.category.view');

        Paginator::useBootstrap();

        $categories = Category::paginate(15);

        return view('blog::Category.index', ['categories' => $categories]);
    }

    public function create()
    {
        checkAdminHasPermissionAndThrowException('blog.category.create');

        return view('blog::Category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        checkAdminHasPermissionAndThrowException('blog.category.store');
        $category = Category::create($request->validated());

        return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.news-category.edit', ['news_category' => $category->id]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        checkAdminHasPermissionAndThrowException('blog.category.view');

        return view('blog::Category.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        checkAdminHasPermissionAndThrowException('blog.category.edit');
        $code = request('code') ?? getSessionLanguage();
        if (! Language::where('code', $code)->exists()) {
            abort(404);
        }
        $category = Category::findOrFail($id);
        $languages = allLanguages();

        return view('blog::Category.edit', compact('category', 'code', 'languages'));
    }

    public function update(CategoryRequest $request, Category $news_category)
    {
        checkAdminHasPermissionAndThrowException('blog.category.update');
        $validatedData = $request->validated();

        $news_category->update($validatedData);


        return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.news-category.edit', ['news_category' => $news_category->id,]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $NewsCategory)
    {
        checkAdminHasPermissionAndThrowException('blog.category.delete');
        if ($NewsCategory->news()->count() > 0) {
            return $this->redirectWithMessage(RedirectType::ERROR->value);
        }

        $NewsCategory->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.news-category.index');
    }

    public function statusUpdate($id)
    {
        checkAdminHasPermissionAndThrowException('blog.category.update');
        $NewsCategory = Category::find($id);
        $status = $NewsCategory->status == 1 ? 0 : 1;
        $NewsCategory->update(['status' => $status]);

        $notification = __('Updated Successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }
}
