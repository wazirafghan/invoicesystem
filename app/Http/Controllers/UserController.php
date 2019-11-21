<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\PayPalDetail;
use App\Service;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use File;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(session()->get('input')){
            return redirect()->route('session-order');
        }

        return view('themes.main-theme.home.invoices',['title'=>"User Invoices",'uri'=>'User Invoices',]);
    }
    public  function accountSetting(){
        $user = User::findOrFail(Auth::user()->id);
        return view('themes.main-theme.home.account_setting',['user'=>$user,'title'=>'Edit Account Profile']);
    }
    public  function accountUpdate(Request $request){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$id,
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($request->input('password'))){
            $user->password = bcrypt($request->input('password'));
        }
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $this->validate($request, [
                    'logo' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('logo');
                $destinationPath = "uploads/logo/";
                //$extension = $file->getClientOriginalExtension('logo');
                $logo = $file->getClientOriginalName('logo');
                $logo = time() . $logo;
                //renameing image
                $request->file('logo')->move($destinationPath, $logo);
                if (isset($user->logo)) {
                    if (file_exists('uploads/logo/' . $user->logo)) {
                        $delete_old_file = "uploads/logo/" . $user->logo;
                        File::delete($delete_old_file);
                    }
                }
                $user->logo = $logo;


            }
        }
        $user->save();
        Session::flash('success_message', 'Great! Account successfully updated!');
        return redirect()->back();
    }
    public function getCancelOrder()
    {
        $user = Auth::user();
        $orders = Order::where("status","3")->where("created_by",$user->id)->get();
        return view('user.dashboard.cancel-order',['title'=>"User Cancel Order",'uri'=>'User Cancel Order','orders'=>$orders]);
    }

    public function getSearchOrder(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('keyword');
        $orders = Order::where("status","!=","3")->where("created_by",$user->id)->where('order_no', 'like', "%{$search}%")->orwhere('service_title', 'like', "%{$search}%")->get();
        return view('user.dashboard.index',['title'=>"User Dashboard",'uri'=>'User Dashboard','orders'=>$orders]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.dashboard.edit', ['title' => 'Update User Details'])->withUser($user);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$id,
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $user->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        $user->fill($input)->save();
        Session::flash('success_message', 'Great! user successfully updated!');
        return redirect()->back();
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 3;
        $order->save();
        Session::flash('success_message', 'Your Order successfully Canceled!');
        return redirect()->back();
    }

    public function showInvoice($id)
    {
        // dd("ss");
        $invoice = Invoice::findOrFail($id);
        $settings = Setting::pluck('value','name')->toArray();


        return view('themes.main-theme.home.invoice',['title'=>"Invoice Summary",'uri'=>'Invoice Summary','invoice'=>$invoice,'settings'=>$settings]);
    }

    public function exportPdf($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');
        $settings = Setting::pluck('value','name')->toArray();
        $order = Order::findOrFail($id);
        // Send data to the view using loadView function of PDF facade
//        dd($order);
        if(isset($settings['logo'])) {
            $logo =base_path()."/uploads/".$settings['logo'];
        }else {
            $logo = "placeholder.jpg";
        }
        $pdf = PDF::loadView('themes.main-theme.home.pdf-invoice',['order'=>$order,'logo'=>$logo,'settings'=>$settings]);
        // If you want to store the generated pdf to the server then you can use the store function
//        $pdf->save(storage_path().'_filename.pdf');
        // Finally, you can download the file using download function
        return $pdf->download('invoice.pdf');
    }

    public static function GetPoundValue()
    {
        $daily_exchange_rate = file_get_contents("https://api.exchangeratesapi.io/latest?base=GBP");
        $data = json_decode($daily_exchange_rate,TRUE );

        if (isset($data['rates']['USD'])){
            return $data['rates']['USD'];
        }else{
            return 1.3229869123;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
