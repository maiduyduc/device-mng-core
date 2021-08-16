<?php

namespace App\Http\Controllers\apps;

use App\Http\Controllers\Controller;
use App\Models\Models\apps\Category;
use Illuminate\Http\Request;

class CategoryDeviceController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category::all();
        return view("apps.dashboard.category-devices.index", compact('categories'));
    }

    public function create()
    {
        return view("apps.dashboard.category-devices.add");
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name
        ]);
        alert()->success('Thành công', 'Đã thêm mới chủng loại '. "$request->name");
        return redirect()->route('category-device.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        return view("apps.dashboard.category-devices.edit", compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->category->find($id)->update([
            'name' => $request->name
        ]);
        alert()->success('Cập nhật thành công');
        return redirect()->route('category-device.index');
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return $this->successResponse();
    }
}
