<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Gate::denies('categories.view')) {
            abort(403);
        }
        // SELECT a.*, b.name as parent_name
        // FROM categories as a
        // LEFT JOIN categories as b ON b.id = a.parent_id
        $request = request();
//        $categories = Category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
//            ->select([
//                'categories.*',
//                'parents.name as parent_name'
//            ])
//            ->filter($request->query())
//            ->orderBy('categories.name')
//            ->paginate();
        $categories = Category::with('parent')->withCount([
            'products as count' => function ($query) {
                $query->where('status', 'active');
            }
        ])->filter($request->query())
            ->orderBy('categories.name')
            ->paginate();
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('categories.create')) {
            abort(403);
        }
        $parents = Category::all();
        $category = new Category();
        return view('admin.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('categories.create');
//        $clean_data = $request->validate(Category::rules(), [
//            'name.unique' => 'This is name already exists!',
//            'name.required' => 'This field (:attribute) is required'
//        ]);
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);//merge don't use with input exist in request
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        //Mass assignment
        $category = Category::create($data);
        //PRG:POST REDIRECT GET
        return Redirect::route('admin.categories.index')->with('success', 'Category Created');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Gate::denies('categories.view')) {
            abort(403);
        }
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('categories.update');
        $category = Category::find($id);
        if (!$category) {
            return Redirect::route('admin.categories.index')->with('info', 'Category not found!');
        }
        //SELECT * FROM categories WHERE id<>$id AND (parent_id IS NULL OR  parent_id <> $id)
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->orWhere('parent_id', '<>', $id);
            })->get();
        return view('admin.categories.edit', compact('category', 'parents'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
        //$category->fill($request->all())->save();
        return Redirect::route('admin.categories.index')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        Gate::authorize('categories.delete');

        $category = Category::findOrFail($id);
        $category->delete();
//        if ($category->image) {
//            Storage::disk('public')->delete($category->image);
//        }
//        Category::destroy($id);
        return Redirect::route('admin.categories.index')->with('deleted', 'Category Delete');

    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image'); // UploadedFile Object
        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->orderBy('name')->paginate();
        return view('admin.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.categories.trash')->with(['success' => 'Category restored']);
    }


    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image)
            Storage::disk('public')->delete($category->image);
        return redirect()->route('admin.categories.trash')->with(['success' => 'Category deleted for ever']);
    }
}
