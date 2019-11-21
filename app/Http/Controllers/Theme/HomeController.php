<?php

namespace App\Http\Controllers\Theme;
//use Illuminate\Http\Request;
use App\ActiveTheme;
use App\Affiliate;
use App\AffiliateMember;
use App\Category;
use App\Client;
use App\ClientFeedBack;
use App\Discount;
use App\Feature;
use App\FormInput;
use App\HomeConcept;
use App\HomeSlide;
use App\InputOption;
use App\Invoice;
use App\InvoiceItem;
use App\ItemPrice;
use App\MenuItem;
use App\Order;
use App\OrderPrice;
use App\Page;
use App\Portfolio;
use App\PortfolioCategory;
use App\PortfolioImage;
use App\Post;
use App\PriceInput;
use App\Service;
use App\ServiceItem;
use App\Setting;
use App\Slider;
use App\Tag;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use DB;



use Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $settings;
    public function __construct()
    {
        $this->settings = Setting::pluck('value','name')->toArray();
    }

    public function index()
    {
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.index',['title' => 'home','settings'=>$settings,]);
    }

    public function showAffiliate()
    {
        $services = Service::all();
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.affiliate',['title' => 'Affiliate','settings'=>$settings,'services'=>$services,]);
    }

    public function addAffiliate(Request $request)
    {
        $this->validate($request, [
            'f_name' => 'required|min:3|max:50',
            'l_name' => 'required|min:3|max:50',
            'email' => 'email|required_with:c_email|same:c_email',
            'password' => 'required|confirmed|min:6',
            'c_email' => 'required',
            'description' => 'required'
        ]);
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $code = "IV".$randomString;
        $affiliate = new Affiliate();
        $affiliate->f_name = $request->input("f_name");
        $affiliate->l_name = $request->input("l_name");
        $affiliate->email = $request->input("email");
        $affiliate->password =  bcrypt($request->input("password"));
        $affiliate->description = $request->input("description");
        $affiliate->code = $code;
        $affiliate->save();
        Session::flash('success_message', 'Success! Apply has been saved successfully!');
        return redirect()->back();
    }

    public function getBlogSingle($slug)
    {
        $post = Post::where('slug','=',$slug)->first();
        $title = "Blog | ".$post->title;
        $recent_posts = Post::limit(6)->orderBy('created_at', 'desc')->get();
        $all_post = Post::orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $tags = Tag::orderBy('created_at', 'desc')->get();
        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()->toArray();
        $id = 1;
//        $content =  Content::findOrFail($id);
        $settings = Setting::pluck('value','name')->toArray();
        $main_menu = MenuItem::where('menu_id',1)->get();
        $footer_menu = MenuItem::where('menu_id',2)->get();
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.singleBlog',['title'=>$title,'archives'=>$archives,'post'=>$post,'recent_posts'=>$recent_posts,'uri'=>'blog','all_post'=>$all_post,'categories'=>$categories,'tags'=>$tags,'settings'=>$settings,'main_menu'=>$main_menu,'footer_menu'=>$footer_menu,]);
    }

    public function getPage($slug)
    {

        $item = MenuItem::where('slug','=',$slug)->first();
        $page_id = $item->url;
        $page = Page::findOrFail($page_id);
        $title = "Page | ".$page->title;
        $settings = Setting::pluck('value','name')->toArray();


        $main_menu = MenuItem::where('menu_id',1)->get();
        $footer_menu = MenuItem::where('menu_id',2)->get();
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.pages',['title'=>$title,'page'=>$page,'uri'=>'page','main_menu'=>$main_menu,'footer_menu'=>$footer_menu,'settings'=>$settings,]);
    }


    public function getPortfolios(){

        $portfolios = Portfolio::all();
//        dd($total_pages);
        $categories = PortfolioCategory::orderBy('name','asc')->get();
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.portfolio',['title'=>'Our Portfolios','settings'=>$this->settings,'categories'=>$categories,'portfolios'=>$portfolios]);
    }

    public function getSinglePortfolio($id){

        $portfolio = Portfolio::findOrFail($id);
//        dd($total_pages);
        $categories = PortfolioCategory::orderBy('name','asc')->get();
        $images = PortfolioImage::where('portfolio_id',$id)->get();
        $last = Portfolio::orderBy('id', 'desc')->first();
        $last_id = $last->id;
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.portfolio-single',['title'=>'Our Portfolios','settings'=>$this->settings,'categories'=>$categories,'portfolio'=>$portfolio,'images'=>$images,'last_id'=>$last_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactUsForm(){
        $settings = Setting::pluck('value','name')->toArray();

        $main_menu = MenuItem::where('menu_id',1)->get();
        $footer_menu = MenuItem::where('menu_id',2)->get();

        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.contact-us',['settings'=>$settings,'title'=>'Contact Us','main_menu'=>$main_menu,'footer_menu'=>$footer_menu,]);
    }
    public function getBlog(){
        $settings = Setting::pluck('value','name')->toArray();

        $main_menu = MenuItem::where('menu_id',1)->get();
        $footer_menu = MenuItem::where('menu_id',2)->get();

        $posts = Post::all();
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.blog',['settings'=>$settings,'title'=>'Contact Us','main_menu'=>$main_menu,'footer_menu'=>$footer_menu,'posts'=>$posts,]);
    }


    public function getServiceItemDetail(Request $request){

        $service_item = ServiceItem::findOrFail($request->input('id'));
        return view('themes.main-theme.includes.single-item', ['title' => 'ServiceItem Details','service_item'=>$service_item]);

    }

    public function itemOrder($slug)
    {
        $service_item = ServiceItem::where('slug','=',$slug)->first();
        $services =  Service::all();
        $pound_value = $this->GetPoundValue();
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.place-order', ['title' => 'Service Item Place Order','service_item'=>$service_item,'services'=>$services,'pound_value'=>$pound_value,'settings'=>$settings]);
    }

    public function itemShow($slug)
    {
        $service_item = ServiceItem::where('slug','=',$slug)->first();
        $services =  Service::all();
        $pound_value = $this->GetPoundValue();
        return view('themes.main-theme.home.service-item', ['title' => 'Service Item ','service_item'=>$service_item,'services'=>$services,'pound_value'=>$pound_value]);
    }


    public function invoiceStore(Request $request)
    {

        $data = $request->all();



        if (Auth::user()){

            $user = Auth::user();

            $invoice = new Invoice();

//           if(!empty($request->input('saved_logo'))){
//
//               $invoice->pic = $user->logo;
//           }else {
//
//               $file = $request->file('pic');
//               if ($request->hasFile('pic')) {
//
//                   if ($request->file('pic')->isValid()) {
//                       $this->validate($request, [
//                           'pic' => 'required|image|mimes:jpeg,png,jpg'
//                       ]);
//                       $destinationPath = "uploads/logo/";
//                       $extension = $file->getClientOriginalExtension('pic');
//                       $fileName = $file->getClientOriginalName('pic');
//                       $fileName = time() . $fileName;
//                       //renameing image
//                       $request->file('pic')->move($destinationPath, $fileName);
//                       $invoice->pic = $fileName;
////                $delete_old_file="uploads/top-banner/".$top_banner->pic;
////                File::delete($delete_old_file);
//                   }
//               }
//           }

//            $request->validate([
//                'title'=>'required',
//                'from_name'=>'required',
//                'from_email'=>'required|email',
//                'from_address'=>'required',
//                'from_address'=>'required',
//                'from_phone'=>'required',
//                'from_business_num'=>'required',
//                'invoice_num'=>'required',
//                'date'=>'required',
////                'terms'=>'required',
//                'to_name'=>'required',
//                'to_email'=>'required|email',
//                'to_address'=>'required',
//                'to_phone'=>'required',
//                'total'=>'required',
//                'notes'=>'required',
//                'color_code'=>'required',
//                'discount'=>'required',
//                'tax'=>'required',
//
//            ]);

            $invoice->uploadedImages = $request->input('uploadedImages');
            $invoice->title = $request->input('title');
            $invoice->from_name = $request->input('from_name');
            $invoice->from_email = $request->input('from_email');
            $invoice->from_address = $request->input('from_address');
//            $invoice->from_phone = $request->input('from_phone');
//            $invoice->from_business_num = $request->input('from_business_num');
            $invoice->invoice_num = $request->input('invoice_num');
            $invoice->date = $request->input('date');
            $invoice->terms = $request->input('terms');
            $invoice->to_name = $request->input('to_name');
            $invoice->to_email = $request->input('to_email');
            $invoice->to_address = $request->input('to_address');
//            $invoice->to_phone = $request->input('to_phone');
            $invoice->total = $request->input('total');
            $invoice->notes = $request->input('notes');
            $invoice->color_code = $request->input('color_code');
            $invoice->tax_status = $request->input('tax_status');
            $invoice->discount = $request->input('discount');
            $invoice->tax = $request->input('tax');
            $invoice->invoice_currency_option = $request->input('invoice_currency_option');
            $invoice->tax_rate_percent = $request->input('tax_rate_percent');
            $invoice->discount_rate_percent = $request->input('discount_rate_percent');
            $invoice->invoice_email_status = $request->input('invoice_email_status');




            $invoice->user_id = Auth::user()->id;
            $invoice->save();
            $input = $request->all();

            foreach ($request->description as $key => $des){
                $item = new InvoiceItem();
                $item->description = $request->description[$key];
                $item->rate = $request->rate[$key];
                $item->qty = $request->qty[$key];
                $item->detail = $request->detail[$key];
                $item->tax = $request->new_tax_box[$key];
                $item->invoice_id = $invoice->id;
                $item->save();
            }

            $settings = Setting::pluck('value','name')->toArray();



            $data = array(
                'name' => $user->name,
                'invoice' => $invoice,
                'msg' => "New Invoice .Total amount of  ".$invoice->total,
                'user_email' => $invoice->to_email,
                'email' => isset($settings['email']) ? $settings['email']:'wazirk217@gmail.com',
                'uploadedImages' => $invoice->uploadedImages,
                'site_title' => isset($settings['site_title']) ? $settings['site_title']: 'Approved  Invoice',
            );




            Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
                $message->to($data['user_email'],'')
                    ->from($data['email'],$data['site_title'])
                    ->subject('New Invoice');
            });

            Session::flash('success_message', 'Success! Invoice has been sent & saved successfully!');
            return view('themes.main-theme.home.invoice',['title'=>"Invoice Summary",'uri'=>'Invoice Summary',
                'invoice'=>$invoice,'settings'=>$settings]);

        }else{
            $file = $request->file('pic');
            if ($request->hasFile('pic')) {

                if ($request->file('pic')->isValid()) {
                    $this->validate($request, [
                        'pic' => 'required|image|mimes:jpeg,png,jpg'
                    ]);
                    $destinationPath = "uploads/logo/";
                    $extension = $file->getClientOriginalExtension('pic');
                    $fileName = $file->getClientOriginalName('pic');
                    $fileName = time() . $fileName;
                    //renameing image
                    $request->file('pic')->move($destinationPath, $fileName);
                    $data['logo'] = $fileName;
//                $delete_old_file="uploads/top-banner/".$top_banner->pic;
//                File::delete($delete_old_file);
                }
            }
            Session()->put('input',$data);
            return redirect()->route('user-dashboard');
        }
    }


    public function generatePDF($id){


        $invoice = Invoice::findOrFail($id);
        $inv['to_email']   = $invoice->to_email;
        $inv['from_email']   = $invoice->from_email;
        $inv['invoice_num'] =$invoice->invoice_num;
        $inv['invoice_email_status'] =$invoice->invoice_email_status;
        $inv['site_title'] ='Approved  Invoice';

        $pdf = PDF::loadView('myPDF', compact('invoice'));

        if($inv['invoice_email_status']==0)
        {

            Mail::send('themes.emails.invoice_email_status', $inv, function ($message) use ($inv) {

                $message->to($inv['to_email'],'')
                    ->from($inv['from_email'],$inv['site_title'])
                    ->subject("your  invoice". $inv['invoice_num']. " has been view");
            });
//            DB::table('invoices')->where('invoice_email_status',0)->update(['invoice_email_status' => 1]);

            DB::table('invoices')->where( 'id',$id)->update(['invoice_email_status' => 1]);

        }


//        Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
//            $message->to($data['user_email'],'')
//                ->from($data['email'],$data['site_title'])
//                ->subject('New Invoice');
//        });

        return $pdf->download('invoice.pdf');


    }


    public function  logoImage(Request $request){

        $image = $request->file('file');

//$imageName = time() . $image->getClientOriginalName();
        $imageName = $image->getClientOriginalName();

// $imageName = time().$imageName;
        $image->move('uploads/service', $imageName);
//        $id = $this->clean($imageName);

        return response()->json(['imageName' => $imageName]);
    }


    public function create()
    {
        //
    }

    public function invoice()
    {
        $order = Order::findOrFail(2);
        $services =  Service::all();
        return view('themes.main-theme.home.invoice', ['title' => 'Service Item Place Order','order'=>$order,'services'=>$services]);
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
    public function edit($id)
    {
        //
//        return view('themes.main-theme.home.edit');

        $invoice = Invoice::findOrFail($id);
        $settings = Setting::pluck('value','name')->toArray();

        return view('themes.main-theme.home.edit',['title'=>"Invoice Summary",'uri'=>'Invoice Summary','invoice'=>$invoice,'settings'=>$settings]);


    }

    public function processContact(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
            'g-recaptcha-response.required' => 'Check the ReCaptcha',
        ]);


        $settings = Setting::pluck('value','name')->toArray();
        if(isset($settings['enquiry_email'])) {
            $enquiry_email = $settings['enquiry_email'];
        }else {
            $enquiry_email = "support@ideal.org.pk";
        }
        if(isset($settings['secret_key'])) {
            $secret_key = $settings['secret_key'];
        }else {
            $secret_key = "6LdoXpIUAAAAAIxbg_1LcghcCLK4QyQJrg3CtVW0";
        }

        $input = $request->all();
        $input = array_map('strip_tags', $input);
        $captcha = $input['g-recaptcha-response'];
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        $data = array(
            'name' => $input['name'],
            'email' => $input['email'],
            'check_email' => isset($input['emailupdates']) ?"Yes":"No" ,
            'subject' => $input['subject'],
            'msg' => $input['message'],
            'admin_email' => $enquiry_email,
        );
        Mail::send('theme.email.contact', $data, function ($message) use ($data) {
            $message->to($data['admin_email'],'')
                ->subject('Contact');
        });

        Session::flash('success_message', 'Success! We received contact us enquiry successfully!');
//        return redirect()->back('show-invoice-edit');
        return redirect('/show-invoice');


    }

    public function invoiceImage(Request $request)
    {

        $input = $request->all();

        $load_pages = $input['page_id'];
//        $from = $load_pages * 4 - 4;
//        $to = $load_pages * 4;
//        $from++;
//        dd($from ."--" .$to);
        $portfolios = Portfolio::take(4)->where('enabled',1)->where('id','>',$load_pages)->get();
        $categories = Category::orderBy('name','asc')->get();
        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.includes.load-portfolio',['title'=>'Our Portfolios','portfolios'=>$portfolios,'categories'=>$categories]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'from_name'=>'required'
        ]);


        $invoice = Invoice::find($id);

        $invoice->title = $request->get('title');
        $invoice->from_name = $request->get('from_name');
        $invoice->from_email = $request->get('from_email');
        $invoice->from_address = $request->get('from_address');
//        $invoice->from_phone = $request->get('from_phone');
//        $invoice->from_business_num = $request->get('from_business_num');
        $invoice->invoice_num = $request->get('invoice_num');
        $invoice->date = $request->get('date');
        $invoice->terms = $request->get('terms');
        $invoice->to_name = $request->get('to_name');
        $invoice->to_email = $request->get('to_email');
        $invoice->to_address = $request->get('to_address');
//        $invoice->to_phone = $request->get('to_phone');
        $invoice->total = $request->get('total');
        $invoice->notes = $request->get('notes');

        $invoice->color_code = $request->get('color_code');
        $invoice->tax_status = $request->get('tax_status');
        $invoice->discount = $request->get('discount');
        $invoice->tax = $request->get('tax');
        $invoice->uploadedImages = $request->get('uploadedImages');


        $invoice->invoice_currency_option = $request->get('invoice_currency_option');
        $invoice->tax_rate_percent = $request->get('tax_rate_percent');
        $invoice->discount_rate_percent = $request->get('discount_rate_percent');

        $invoice->user_id = Auth::user()->id;
        $invoice->save();



        $invoice->items()->delete();


        foreach ($request->description as $key => $des){

            $item = new InvoiceItem();
            $item->description = $request->description[$key];
            $item->rate = $request->rate[$key];
            $item->qty = $request->qty[$key];
            $item->detail = $request->detail[$key];
            $item->tax = $request->new_tax_box[$key];
            $item->invoice_id = $invoice->id;
            $item->save();
        }


        Session::flash('success_message', 'Great! invoice  successfully updated!');

        return redirect('/show-invoice/'.$invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $invoice = Invoice::find($id);

        $invoice->delete();

        Session::flash('success_message', 'Great! invoice  successfully deleted!');
        return redirect()->route('user-dashboard');


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
}
