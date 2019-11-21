<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;
use Auth;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(Request $request)
    {
//        dd('working');
        return view('admin.staff.index', ['title' => 'Registered Staff List']);
    }
    public function getStaff(Request $request){
//        dd("working");
        $columns = array(
            0 => 'name',
            1 => 'email',
            2 => 'created_at',
            3 => 'action'
        );

        $totalData = Admin::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value'))){
            $posts = Admin::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = Admin::count();
        }else{
            $search = $request->input('search.value');
            $posts = Admin::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->orWhere('created_at','like',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Admin::where('name', 'like', "%{$search}%")
                ->orWhere('email','like',"%{$search}%")
                ->count();
        }


        $data = array();

        if($posts){
            foreach($posts as $r){
                $edit_url = route('staff.edit',$r->id);
                $nestedData['select'] = '
                                <td style="text-align: center">
                                    <input type="checkbox" class="ace" name="admin_id[]" value="'.$r->id.'">
                                </td>
                            ';
                $nestedData['name'] = $r->name;
                $nestedData['email'] = $r->email;
                $nestedData['created_at'] = date('d-m-Y H:i:s',strtotime($r->created_at));
                $nestedData['action'] = '
                                <div class="text-center">
                                <td>
                                    <a title="Edit User" class="btn mtbutton btn-success btn-circle btn-sm"
                                       href="'.$edit_url.'">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a class="btn mtbutton btn-danger btn-circle btn-sm" onclick="event.preventDefault();del('.$r->id.');" title="Delete User" href="#">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                                </div> 
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"			=> intval($request->input('draw')),
            "recordsTotal"	=> intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"			=> $data
        );

        echo json_encode($json_data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create', ['title' => 'Registere User']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:admins,email',
            'password' => 'required|min:6',
        ]);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = $request->input('role');
        Admin::create($input);
        Session::flash('success_message', 'Great! Staff has been saved successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.staff.profile-setting', ['title' => 'Edit Profile'])->withUser($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.staff.edit', ['title' => 'Update Staff Details'])->withUser($admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
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
        $input['role'] = $request->input('role');
        $admin->fill($input)->save();
        Session::flash('success_message', 'Great! Staff successfully updated!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $admin = Admin::findOrFail($id);
        $admin->delete();
        Session::flash('success_message', 'Staff successfully deleted!');
        return redirect()->route('staff.index');
    }

    public function DeleteSelectedStaff(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'admin_id' => 'required',

        ]);
        foreach ($input['admin_id'] as $key => $val) {
//            dd("working");
            Admin::where('id', $val)->delete();


        }
        Session::flash('success_message', 'Staff successfully deleted!');
        return redirect()->back();

    }
}
