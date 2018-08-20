<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventOnline;
use App\Mail\SendMail;
use DB, Mail;
use App\Libs\Functions\HTTP;

class FranchiseController extends Controller
{
	private $api_url;
    private $http;
	
	public function __construct(HTTP $http)
	{
		$this->api_url = HTTP::API_URL;
        $this->http = $http;
	}

    public function index() {

    	$url = $this->api_url.'franchise_category/all';
        // return $url;
    	$data = $this->http->_send($this->http::HTTP_METHOD_GET, $url, []);
    	$data = json_decode($data);

    	return view('Frontend.Contents.franchise.index', array('categories' => $data));
    }

    public function detail($id) {
    	$url = $this->api_url.'franchise/detail/'.$id;

    	$data = $this->http->_send($this->http::HTTP_METHOD_GET, $url, []);
    	$data = json_decode($data);

    	return view('Frontend.Contents.franchise.detail', array('franchise'=> $data) );
    }

    private function _send($method, $url, $header = [], $params = []){
        //khoi tao curl
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        
        // neu la post and put se them data
        if(in_array(strtolower($method), [strtolower(self::HTTP_METHOD_POST), strtolower(self::HTTP_METHOD_PUT)]))
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params)); // $params = array
        }
        // neu co auth
        // if(!empty($this->user) && !empty($this->password))
        // {
        //     curl_setopt($ch, CURLOPT_USERPWD, $this->user.':'.$this->password); 
        // }

        //them header
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // $header = "key: value"
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        return $result;
        $info = curl_getinfo($ch);
        curl_close($ch);
    }

    public function registerEvent () {
    	return view('Frontend.Contents.franchise.register_event');
    }


    public function addEvent (EventOnline $eventModel, Request $request) {
        if (!$request->check_rule) {
            return redirect()->back();
        }
        $request->flash();
        $this->validateInsert($request);

        DB::beginTransaction();
        try {
            $eventModel->name             = $request->name;
            $eventModel->number_of_people = $request->number;
            $eventModel->phone            = $request->phone;
            $eventModel->email            = $request->email;
            $eventModel->franchise_id     = $request->franchise_id;
            $eventModel->franchise_name   = $request->franchise_name;
            $eventModel->save();
            
            $params = [
                'name'           => $request->name,
                'phone'          => $request->phone,
                'number'         => $request->number,
                'email'          => $request->email, 
                'nature'         => $request->industry, 
                'franchise_id'   => $request->franchise_id,
                'franchise_name' => $request->franchise_name,
                'type'           => 'Sell business',
            ]; 
            Mail::to(config('mail.toMail'))
                    ->send(new SendMail('buy_business',  $params, 'Transoft', 'Buy Business Tradeasy') );
            DB::commit();
            return redirect()->back()->with('event', 'success');
        } catch (Exception $e) {
            return redirect()->back();
        }
        
    }

    public function hotFranchise() 
    {
        $url = $this->api_url.'franchise_category/all';

        $data = $this->_send(self::HTTP_METHOD_GET, $url, []);

        $data = json_decode($data, true);
        $val = array_rand($data['data']);
        $ran_m = array_rand($data['data'][$val]['franchises'], 2);
        $hotF[] = $data['data'][$val]['franchises'][0];
        $hotF[] = $data['data'][$val]['franchises'][1];
        return $hotF;
    }


    public function validateInsert($request) {
        $this->validate($request, [
            'name'             => 'between: 1, 100',
            'number_of_people' => 'between: 1, 100',
            'phone'            => 'between: 1, 100',
            'email'            => 'between: 1, 250|email',
            'franchise_id'     => 'requied',
            'franchise_name'   => 'between: 1, 100',
        ], []);
    }
}
