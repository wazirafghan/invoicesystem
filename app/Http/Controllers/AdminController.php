<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Affiliate;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.index',['title'=>'Admin Dashboard',]);
    }
    public function edit($id){
        $admin = Admin::findOrFail($id);
        return view('admin.admin.edit', ['title' => 'Edit Admin'])->withAdmin($admin);
    }
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:admins,email,'.$id,
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $admin->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        $admin->fill($input)->save();
        Session::flash('success_message', 'Great! admin successfully updated!');
        return redirect()->back();
    }
}
