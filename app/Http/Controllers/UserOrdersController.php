<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Discount;
use App\FormInput;
use App\InputOption;
use App\Invoice;
use App\InvoiceItem;
use App\ItemPrice;
use App\Order;
use App\OrderPrice;
use App\PriceInput;
use App\Service;
use App\ServiceItem;
use App\Setting;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mail;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use phpDocumentor\Reflection\DocBlock;
use Redirect;
use URL;
use Illuminate\Support\Facades\Input;



class UserOrdersController extends Controller
{

    public function __construct(Request $request)
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
        //
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
        $request->validate([
            'title'=>'required',
            'from_name'=>'required',
            'from_email'=>'required|email',
            'from_address'=>'required',
            'from_address'=>'required',
//            'from_phone'=>'required',
//            'from_business_num'=>'required',
            'invoice_num'=>'required',
            'date'=>'required',
//                'terms'=>'required',
            'to_name'=>'required',
            'to_email'=>'required|email',
            'to_address'=>'required',
//            'to_phone'=>'required',
            'total'=>'required',
            'notes'=>'required',
            'color_code'=>'required',
            'tax_status'=>'required',
            'discount'=>'required',
            'tax'=>'required',
        ]);


        $data = $request->all();
        Session()->put('input',$data);
        $input = session()->get('input');

        $item_id = $request->input('item_id');
        if(array_key_exists('approval', $data)) {
            $approval = $request->input('approval');
        }





        $form_id = $request->input('form_id');
        $total = $request->input('total');
        $pound_value = $this->GetPoundValue();
        $total_usd = $total * $pound_value;
        $service = ServiceItem::findOrFail($item_id);
        $random_no = "FJ".rand();
        $user = Auth::user();
        $order = new Order();
        $order->order_no = $random_no;
        $order->username = $user->name;
        $order->email = $user->email;
        $order->created_by = $user->id;
        $order->service_title = $service->title;
        $order->total = $total;
        $order->total_usd = $total_usd;
        $order->status = 0;
        $order->discount = 0;
        $order->save();

        $settings = Setting::pluck('value', 'name')->all();
        $item_prices = ItemPrice::where('item_id',$item_id)->get();

        foreach ($item_prices as $price){
            $price_qty = "price".$price->id;
//            dd($price_qty);

            $qty = $request->input($price_qty);
            if ($qty > 0){
                $order_price = new OrderPrice();
                $order_price->price_title = $price->title;
                $order_price->qty = $qty;
                $discount = Discount::where("placement","<=",$qty)->where("item_price_id",$price->id)->first();
                if ($discount){
                    $order_price->price = $discount->price;
                }else{
                    $order_price->price = $price->price;
                }
                $order_price->order_id = $order->id;
                $order_price->save();
                $limit = $qty;
                $limit--;
                for ($x = 0; $x <= $limit; $x++) {
                    $form_inputs = FormInput::where('form_id', $form_id)->get();
                    foreach ($form_inputs as $form_input) {


                        $price_input = new PriceInput();
                        $price_input->o_price_id = $order_price->id;
                        $price_input->name = $form_input->name;
                        $value = $data['result'.$form_input->id.$price->id][$x];
                        $extra_price = 0;
                        if ($form_input->status == 4){
                            $option = InputOption::where("value",$value)->where("input_id",$form_input->id)->first();
                            $extra_price = $value;
                            $value = $option->name;

                        }
                        $price_input->value = $value;
                        $price_input->extra_price = $extra_price;
                        $price_input->save();
                    }
                }

            }


        }
        if(array_key_exists('approval', $data)) {
            if ($approval == 1 and $item_id == 1) {
                $order_price = new OrderPrice();
                $order_price->price_title = "Pre Approval";
                $order_price->qty = 1;
                $order_price->price = 50;
                $order_price->order_id = $order->id;
                $order_price->save();
            }
        }
        $data = array(
            'name' => $user->name,
            'invoice' => $invoice,
            'msg' => "Order is placed successfully .Total amount of order is £$invoice->total",
            'email' => isset($settings['email'])? $settings['email']:'james@inetventures.co.uk',
            'user_email' => isset($data['to_email'])? $settings['to_email']:'james@inetventures.co.uk',
            'logo' => isset($settings['logo']) ? $settings['logo']: '',
            'site_title' => isset($settings['site_title']) ? $settings['site_title']: 'iNet Ventures',
        );
        Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
            $message->to($data['user_email'],'')
                ->from($data['email'],$data['site_title'])
                ->subject('Order Placed');
        });
        Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
            $message->to($data['email'],'')
                ->from($data['email'],$data['site_title'])
                ->subject('Order Placed');
        });
        $services =  Service::all();
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.invoice',['title'=>"Order Summary",'uri'=>'Order Summary','order'=>$order,'services'=>$services,'settings'=>$settings]);
    }


    public function sessionStore()
    {

        $data = session()->get('input');


        $invoice = new Invoice();
        if(array_key_exists('uploadedImages', $data)) {
            $invoice->uploadedImages = $data['uploadedImages'];
        }

        $user = Auth::User();

        $invoice->title = $data['title'];
        $invoice->from_name = $data['from_name'];
        $invoice->from_email = $data['from_email'];
        $invoice->from_address = $data['from_address'];
//        $invoice->from_phone = $data['from_phone'];
//        $invoice->from_business_num = $data['from_business_num'];
        $invoice->invoice_num = $data['invoice_num'];
        $invoice->date = $data['date'];
        $invoice->to_name = $data['to_name'];
        $invoice->to_email = $data['to_email'];
        $invoice->to_address = $data['to_address'];
//        $invoice->to_phone = $data['to_phone'];
        $invoice->total = $data['total'];
        $invoice->notes = $data['notes'];
        $invoice->discount = $data['discount'];
//
//        $invoice->uploadedImages =$data['uploadedImages'];
        $invoice->color_code =$data['color_code'];
        $invoice->tax =  $data['tax'];
        $invoice->invoice_currency_option =  $data['invoice_currency_option'];
        $invoice->tax_rate_percent =  $data['tax_rate_percent'];
        $invoice->discount_rate_percent =  $data['discount_rate_percent'];
//

        $invoice->user_id = Auth::user()->id;
        $invoice->save();

        foreach ($data['description'] as $key => $des){
            $item = new InvoiceItem();
            $item->description = $data['description'][$key];
            $item->rate = $data['rate'][$key];
            $item->qty = $data['qty'][$key];
            $item->detail = $data['detail'][$key];
            $item->invoice_id = $invoice->id;
            $item->save();
        }
        $settings = Setting::pluck('value', 'name')->all();

        $data = array(
            'name' => $user->name,
            'invoice' => $invoice,
            'msg' => "New Invoice .Total amount of ".$invoice->invoice_currency_option. "\".$invoice->total",
            'email' => isset($settings['email'])? $settings['email']:'james@inetventures.co.uk',
            'user_email' => $invoice->to_email,
            'uploadedImages' => isset($settings['uploadedImages']) ? $settings['uploadedImages']: '',
            'site_title' => isset($settings['site_title']) ? $settings['site_title']: 'Approved  Invoice',
        );
        Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
            $message->to($data['user_email'],'')
                ->from($data['email'],$data['site_title'])
                ->subject('New Invoice');
        });
        Mail::send('themes.emails.invoice', $data, function ($message) use ($data) {
            $message->to($data['email'],'')
                ->from($data['email'],$data['site_title'])
                ->subject('New Invoice');
        });
        session()->forget('input');
        return view('themes.main-theme.home.invoice',['title'=>"Order Invoice",'uri'=>'Order Invoice','invoice'=>$invoice,'settings'=>$settings]);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function makePayment($id)
    {
        $order = Order::findOrFail($id);
        Session()->put('order_id',$id);
        Session()->put('order_total',$order->total);
//        dd(session()->get('order_total'));
        $services =  Service::all();
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.stripe-payment',['title'=>"Order Payment",'uri'=>'Order Payment','order'=>$order,'services'=>$services,'settings'=>$settings]);
    }

    public function makePaymentPayPal($id)
    {
        $order = Order::findOrFail($id);
        Session()->put('order_id',$id);
        Session()->put('order_total',$order->total);
//        dd(session()->get('order_total'));
        $services =  Service::all();
        $settings = Setting::pluck('value','name')->toArray();

        return view('themes.main-theme.home.paypal-payment',['title'=>"Order Payment",'uri'=>'Order Payment','order'=>$order,'services'=>$services,'settings'=>$settings]);
    }

    public function CheckOut(Request $request){
        $id = session()->get('order_id');
        $order = Order::findorFail($id);
        $coupon_code = $request->input('coupon_code');
        $date = date('Y-m-d');
        if ($coupon_code != ""){
            $found = Coupon::where('coupon_code',$coupon_code)->where('expiry_date',">",$date)->first();
            if ($found){
                $discount = $found->discount;
                $total = $order->total - ($discount/100*$order->total);
            }else{
                Session::flash('danger_message', 'Coupon code is invalid or Expired');
                return redirect()->back();
            }
        }else{
            $discount = 0;
            $total = $order->total;
        }
        $settings = Setting::pluck('value','name')->toArray();
        if(isset($settings['stripe_key'])) {
            $key = $settings['stripe_key'];
        }else {
            $key = "sk_test_1IUO2lMwmjt2FwXFOdsPridh";
        }

        \Stripe\Stripe::setApiKey ($key);
        try {
            \Stripe\Charge::create ( array (
                "amount" => $total * 100,
                "currency" => "GBP",
                "source" => $request->input ('stripeToken' ), // obtained with Stripe.js
                "description" => "payment."
            ) );


//            $data = array(
//                'email'=>Auth::guard('web')->user()->email,
//                'first_name'=>Auth::guard('web')->user()->first_name,
//                'last_name'=>Auth::guard('web')->user()->last_name,
//                'subtotal'=>Cart::instance('default')->subtotal(),
//                'grandTotal'=>Cart::total(),
//            );
//            Mail::send('emails.order-confirmation', $data, function ($message) use ($data) {
//                $message->to($data['email'], $data['first_name'])->subject('Productive family’s store | Order Email');
//            });
//
//            Cart::destroy();
            $order->status=1;
            $order->payment=0;
            $order->discount=$discount;
            $order->save();
            $services =  Service::all();

            $settings = Setting::pluck('value','name')->toArray();
            \Session::flash('success_message', 'Payment Success');
            return view('themes.main-theme.home.invoice',['title'=>"Order Summary",'uri'=>'Order Summary','order'=>$order,'services'=>$services,'settings'=>$settings]);

        } /*catch ( \Exception $e ) {

            Session::flash ( 'fail-message', "Error! Please Try again." );
            return Redirect::back ();
        }*/
        catch (Stripe_ApiConnectionError $e) {
            Session::flash ( 'danger_message', "Error! API connection error." );
            return Redirect::back ();
            // Network problem, perhaps try again.
        } catch (Stripe_InvalidRequestError $e) {
            Session::flash ( 'danger_message', "Error! Invalid Request Error." );
            return Redirect::back ();
        } catch (Stripe_ApiError $e) {
            Session::flash ( 'danger_message', "Error! Stripe server is down." );
            return Redirect::back ();
        } catch (Stripe_CardError $e) {
            Session::flash ( 'danger_message', "Error! Card was declined." );
            return Redirect::back ();
        }
    }

    public function ProcessPayPalCheckout(Request $request){
        $id = session()->get('order_id');
        $order = Order::findorFail($id);
        $coupon_code = $request->input('coupon_code');
        $date = date('Y-m-d');
        if ($coupon_code != ""){
            $found = Coupon::where('coupon_code',$coupon_code)->where('expiry_date',">",$date)->first();
            if ($found){
                $discount = $found->discount;
                $total = $order->total - ($discount/100*$order->total);
                Session()->put('discount',$discount);
            }else{
                Session::flash('fail-message', 'Coupon code is invalid or Expired');
                return redirect()->back();
            }
        }else{
            $discount = 0;
            $total = $order->total;
        }
        $totalAmount = number_format((float)$total,2);

        /** PayPal api context **/
//        $paypal_conf = \Config::get('paypal');

        $settings = Setting::pluck('value','name')->toArray();
        if (isset($settings['p_client_id'])){
            $client_id = $settings['p_client_id'];
        }else{
            $client_id = "";
        }
        if (isset($settings['p_secret'])){
            $secret = $settings['p_secret'];
        }else{
            $secret = "";
        }
        if (isset($settings['p_mode'])){
            $value = $settings['p_mode'];
            if ($value == 0){
                $mode = "live";
            }else{
                $mode = "sandbox";
            }
        }else{
            $mode = "sandbox";
        }
        $paypal_conf=[
            'client_id' => $client_id,
            'secret' => $secret,
            'settings' => array(
                'mode' => $mode,
                'http.ConnectionTimeOut' => 30,
                'log.LogEnabled' => true,
                'log.FileName' => storage_path() . '/logs/paypal.log',
                'log.LogLevel' => 'ERROR'
            ),
        ];

        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $client_id,
                $secret)
        );

        $this->_api_context->setConfig($paypal_conf['settings']);


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order->service_title) /** item name **/
        ->setCurrency('GBP')
            ->setQuantity(1)
            ->setPrice($totalAmount); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('GBP')
            ->setTotal($totalAmount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Payment');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to("status/$order->id")) /** Specify return URL **/
        ->setCancelUrl(URL::to("status/$order->id"));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
            //dd($respose);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
//        $payer = new Payer();
//        $payer->setPaymentMethod('paypal');
//        $items = OrderPrice::where('order_id',$id)->get()->toArray();
//
//        foreach($items as $item){
//            $item_1 = new Item();
//            $item_1->setName($item['price_title']) /** item name **/
//                    ->setCurrency('GBP')
//                    ->setQuantity($item['qty'])
//                    ->setPrice($item['price']); /** unit price **/
//
//
//        }
//
//        $item_list = new ItemList();
//        $item_list->setItems(array($item_1));
//
//        $amount = new Amount();
//        $amount->setCurrency('GBP')
//            ->setTotal($totalAmount);
//
//        $transaction = new Transaction();
//        $transaction->setAmount($amount)
//            ->setItemList(array($item_list))
//            ->setDescription($order->service_title);
//
//        $redirect_urls = new RedirectUrls();
//        $redirect_urls->setReturnUrl(URL::to('user/dashboard')) /** Specify return URL **/
//        ->setCancelUrl(URL::to('user/dashboard'));
//
//        $payment = new Payment();
//        $payment->setIntent('Sale')
//            ->setTransactions(array($transaction))
//            ->setPayer($payer)
//            ->setRedirectUrls($redirect_urls);
//
////dd($payment);
////  dd($payment->create($this->_api_context));
//        try {
//            $response= $payment->create($this->_api_context);
//            dd($response);
//
//        } catch (\PayPal\Exception\PPConnectionException $ex) {
//
//            if (\Config::get('app.debug')) {
//                \Session::put('error', 'Connection timeout');
//                return Redirect::to('/');
//            } else {
//                \Session::put('error', 'Some error occur, sorry for inconvenient');
//                return Redirect::to('/');
//            }
//        }
//        foreach ($payment->getLinks() as $link) {
//            if ($link->getRel() == 'approval_url') {
//                $redirect_url = $link->getHref();
//                break;
//            }
//        }
//        /** add payment ID to session **/
//        Session::put('paypal_payment_id', $payment->getId());
//        if (isset($redirect_url)) {
//            /** redirect to paypal **/
//            return Redirect::away($redirect_url);
//        }
//        \Session::put('error', 'Unknown error occurred');
//        return Redirect::to('/');

    }
    public function getPaymentStatus($id)
    {
        $settings = Setting::pluck('value','name')->toArray();
                if (isset($settings['p_client_id'])){
                    $client_id = $settings['p_client_id'];
                }else{
                    $client_id = "";
                }
                if (isset($settings['p_secret'])){
                    $secret = $settings['p_secret'];
                }else{
                    $secret = "";
                }
                if (isset($settings['p_mode'])){
                    $value = $settings['p_mode'];
                    if ($value == 0){
                        $mode = "live";
                    }else{
                        $mode = "sandbox";
                    }
                }else{
                    $mode = "sandbox";
                }
                $paypal_conf=[
                    'client_id' => $client_id,
                    'secret' => $secret,
                    'settings' => array(
                        'mode' => $mode,
                        'http.ConnectionTimeOut' => 30,
                        'log.LogEnabled' => true,
                        'log.FileName' => storage_path() . '/logs/paypal.log',
                        'log.LogLevel' => 'ERROR'
                    ),
                ];

                $this->_api_context = new ApiContext(new OAuthTokenCredential(
                        $client_id,
                        $secret)
                );

                $this->_api_context->setConfig($paypal_conf['settings']);

        $order = Order::findOrFail($id);
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');

            $services =  Service::all();
            $settings = Setting::pluck('value','name')->toArray();
            return view('themes.main-theme.home.invoice',['title'=>"Order Summary",'uri'=>'Order Summary','order'=>$order,'services'=>$services,'settings'=>$settings]);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::flash('success_message', 'Payment success');

            $order->status = 1;
            $order->payment = 1;
            if(session()->get('discount')){
                $order->discount = session()->get('discount');
            }
            $order->save();
            Session::forget('order_id');
            Session::forget('discount');
            $services =  Service::all();
            $settings = Setting::pluck('value','name')->toArray();
            return view('themes.main-theme.home.invoice',['title'=>"Order Summary",'uri'=>'Order Summary','order'=>$order,'services'=>$services,'settings'=>$settings]);
            //return Redirect::to('/');
        }
        \Session::flash('error_message', 'Payment failed');
         $services =  Service::all();
        Session::forget('discount');
        $settings = Setting::pluck('value','name')->toArray();
            return view('themes.main-theme.home.invoice',['title'=>"Order Summary",'uri'=>'Order Summary','order'=>$order,'services'=>$services,'settings'=>$settings]);
    }
    public function MakeRquest($nvp_string,$settings)
    {


        /*$curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_URL, config('app.API_ENDPOINT'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;*/
        /*ini_set('date.timezone', 'Europe/Brussels');
        $time = date('H', time());*/


        /*$settings = array(
            'USER' => "wdddodirectsandbox_api1.live.com",
            'PWD' => "NDNL22HZR42TG2J9",
            'SIGNATURE' => "AiPC9BjkCyDFQXbSkoZcgqH3hpacA5ns4qpYg6X-HzDkUnWMZf20ZIUv",
            'VERSION' => '85.0',
        );*/
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => config('app.API_ENDPOINT'),
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_ENCODING => '',
            CURLOPT_VERBOSE => '1',
            CURLOPT_POSTFIELDS => http_build_query(array_merge($nvp_string, $settings), '', "&")

        );
        $ch = curl_init();

        curl_setopt_array($ch, $defaults);
        $result = curl_exec($ch);

        //dd(explode('=',$result));

        if( ! $result = curl_exec($ch)) {

            Log::error(array('error' => curl_error($ch), 'errno' => curl_errno($ch)), 'cURL failed');

        }
        Log::info($result);
        curl_close($ch);
        return $this->NVPToArray($result);

    }

    // Function to convert NTP string to an array
    public function NVPToArray($NVPString)
    {
        $proArray = array();
        while (strlen($NVPString)) {
            // name
            $keypos = strpos($NVPString, '=');
            $keyval = substr($NVPString, 0, $keypos);
            // value
            $valuepos = strpos($NVPString, '&') ? strpos($NVPString, '&') : strlen($NVPString);
            $valval = substr($NVPString, $keypos + 1, $valuepos - $keypos - 1);
            // decoding the respose
            $proArray[$keyval] = urldecode($valval);
            $NVPString = substr($NVPString, $valuepos + 1, strlen($NVPString));
        }
        return $proArray;
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
        //
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
    }
}
