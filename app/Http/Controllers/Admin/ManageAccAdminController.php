<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ManageAccAdminController extends Controller
{
    public function indexAdmin() {
        $admins = Admin::role('admin')->get();
        return view('admin.account-admin.index', compact('admins'));
    }

    public function handleSearchAdmin($type, $content) {
        switch ($type) {
            case 'tên admin':
                $admins = Admin::role('admin')->where('name', 'like', '%' . $content . '%')->get();
                
                break;
            
            default:
                # code...
                break;
        }
        
        return view('admin.account-admin.admin-table', compact('admins'));
    }

    public function indexCreateNewAdmin() {
        return view('admin.account-admin.create');
    }

    public function storeCreateNewAddmin(Request $request) {

        if ($request->input('password_admin') == '' || !Auth::guard('admin')->attempt(['username' => Auth::guard('admin')->user()->username, 'password' => $request->input('password')])) {
            $toast_msg = 'Mật khẩu admin không đúng';
            $toast_modify = 'danger';
    
            return redirect()->back()->with(compact('toast_msg', 'toast_modify'));
        }

        $validated = $request->validate([
            'admin_name' => 'required',
            'user_name' => 'required | unique:table_user,email',
            'admin_phone' => 'required|numeric|digits:10',
            'password' => 'required|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->input('admin_name'),
            'email' => $request->input('user_name'),
            'phone' => $request->input('admin_phone'),
            'password'  => bcrypt($request->input('password')), 
        ])->assignRole('admin');

        $admin->save();
        return redirect('/admin/admin')->with('toast_msg', 'Admin mới đã được thêm thành công');
    }

    public function indexEditAdmin(Request $request) {
        $admin = Admin::role('admin')->where('id', $request->input('admin_id'))->first();

        return view('admin.account-admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request) {
        $admin = Admin::role('admin')->where('id', $request->input('admin_id'))->update(['verify' => $request->input('verify')]);
        
        return redirect('/admin/admin')->with('toast_msg', 'Cập nhật thành công');
    }

    public function deleteAdmin(Request $request) {
        $admin = Admin::role('admin')->where('id', $request->input('admin_id'))->delete();

        return redirect('/admin/admin')->with('toast_msg', 'Admin đã được xóa thành công');
    }   
}
