<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class MenuService
{   
    public function getParent($parent_id = 0)
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::OrderByDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            $menu = Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' => (string)$request->input('content'),
                'active' => (int)$request->input('active'),
            ]);

            // Đặt thông báo thành công trước khi return
            Session::flash('success', 'Tạo Danh Mục Thành Công');
            return $menu;
        } catch (\Exception $err) {
            // Đặt thông báo lỗi
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function update($request, $menu)
    {   
        if($request->input('parent_id') != $menu->id)
        {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string) $request->input('name');
        $menu->parent_id = (string)$request->input('parent_id');
        $menu->description = (int)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công danh mục');
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();

        if($menu)
        {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}
