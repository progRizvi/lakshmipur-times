<?php

namespace Modules\Blog\app\Http\Controllers;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Blog\app\Http\Requests\PostRequest;
use Modules\Blog\app\Models\Category;
use Modules\Blog\app\Models\News;
use Modules\Blog\app\Models\NewsCategory;
use Modules\Language\app\Enums\TranslationModels;
use Modules\Language\app\Models\Language;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class NewsController extends Controller
{
    use GenerateTranslationTrait, RedirectHelperTrait;

    public function index(Request $request)
    {
        checkAdminHasPermissionAndThrowException('blog.view');
        $query = News::query();

        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->keyword . '%');
            $q->orWhere('description', 'like', '%' . $request->keyword . '%');
        });

        $query->when($request->filled('is_popular'), function ($q) use ($request) {
            $q->where('is_popular', $request->is_popular);
        });

        $query->when($request->filled('show_homepage'), function ($q) use ($request) {
            $q->where('show_homepage', $request->show_homepage);
        });

        $query->when($request->filled('status'), function ($q) use ($request) {
            $q->where('status', $request->status);
        });

        $orderBy = $request->filled('order_by') && $request->order_by == 1 ? 'asc' : 'desc';

        if ($request->filled('par-page')) {
            $posts = $request->get('par-page') == 'all' ? $query->orderBy('id', $orderBy)->get() : $query->orderBy('id', $orderBy)->paginate($request->get('par-page'))->withQueryString();
        } else {
            $posts = $query->orderBy('id', $orderBy)->paginate()->withQueryString();
        }

        return view('blog::Post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        checkAdminHasPermissionAndThrowException('blog.create');
        $categories = Category::where('status', 1)->get();
        $states = State::all();
        $cities = City::all();


        return view('blog::Post.create', ['categories' => $categories, 'states' => $states, 'cities' => $cities]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        checkAdminHasPermissionAndThrowException('blog.store');
        $news = News::create(array_merge(['admin_id' => Auth::guard('admin')->user()->id], $request->validated()));

        if ($news && $request->hasFile('image')) {
            $file_name = file_upload($request->image, 'uploads/custom-images/', $news->image);
            $news->image = $file_name;
            $news->save();
        }

        // store categories
        if ($request->category_id) {
            foreach ($request->category_id as $category_id) {
                NewsCategory::create([
                    'news_id' => $news->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        return $this->redirectWithMessage(
            RedirectType::CREATE->value,
            'admin.news.edit',
            [
                'news' => $news->id,
                'code' => allLanguages()->first()->code,
            ]
        );
    }

    public function edit($id)
    {
        checkAdminHasPermissionAndThrowException('blog.edit');
        $news = News::findOrFail($id);
        $categories = Category::where('status', 1)->get();
        $states = State::all();
        $cities = City::all();

        $selectedCategories = $news->categories()->pluck('category_id')->toArray();

        return view('blog::Post.edit', compact('news', 'categories', 'states', 'cities', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, $id)
    {
        checkAdminHasPermissionAndThrowException('blog.update');
        $validatedData = $request->validated();

        $news = News::findOrFail($id);

        if ($news && ! empty($request->image)) {
            $file_name = file_upload($request->image, 'uploads/custom-images/', $news->image);
            $news->image = $file_name;
            $news->save();
        }
        $news->update($validatedData);


        // update categories
        if ($request->category_id) {
            NewsCategory::where('news_id', $news->id)->delete();
            foreach ($request->category_id as $category_id) {
                NewsCategory::create([
                    'news_id' => $news->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        return $this->redirectWithMessage(
            RedirectType::UPDATE->value,
            'admin.news.edit',
            ['news' => $news->id]
        );
    }

    public function destroy($id)
    {
        checkAdminHasPermissionAndThrowException('blog.delete');

        $news = News::findOrFail($id);

        if ($news->image) {
            if (File::exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }
        }

        // delete categories
        $news->categories()->delete();

        $news->delete();

        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.news.index');
    }

    public function statusUpdate($id)
    {
        checkAdminHasPermissionAndThrowException('blog.update');

        $news = News::find($id);
        $status = $news->status == 1 ? 0 : 1;
        $news->update(['status' => $status]);

        $notification = __('Updated Successfully');

        return response()->json([
            'success' => true,
            'message' => $notification,
        ]);
    }
}
