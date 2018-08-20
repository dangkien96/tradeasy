<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellBusiness;
use App\Models\BusinessNature;
use DB, Mail;
use Carbon\Carbon;
use App\Jobs\EmailJob;

class SellController extends Controller
{
    private $sellBusinessModel;

    public function __construct(SellBusiness $sellBusiness)
    {
        $this->sellBusinessModel = $sellBusiness;    
    }

    public function sell (){
        return view('Frontend.Contents.sell-business.sell');
    }

    public function process (){
    	return view('Frontend.Contents.sell-business.process');
    }

    public function qa (){
    	return view('Frontend.Contents.sell-business.qa');
    }

    public function criteria (){
    	return view('Frontend.Contents.sell-business.criteria');
    }

    public function valuation (){
    	return view('Frontend.Contents.sell-business.valuation');
    }

    public function sellBusiness(Request $request) {

        $request->flash();
        $this->_validateSell($request);
        $nature_name = @BusinessNature::find($request->industry)->name_2;
        DB::beginTransaction();
        try {
            $this->sellBusinessModel->name       = $request->name;
            $this->sellBusinessModel->phone      = $request->phone;
            $this->sellBusinessModel->email      = $request->email;
            $this->sellBusinessModel->profit     = $request->profit;
            $this->sellBusinessModel->nature     = $request->industry;
            $this->sellBusinessModel->imvestment = $request->investment;
            $this->sellBusinessModel->message    = $request->message;
            $this->sellBusinessModel->save();

            $t_uuid=uniqid("",true);

            $s_source="Email Enquiry";

            DB::connection('mysql2')
                ->table('tbl_business_transfer')
                ->insert(array(
                    't_uuid'             => $t_uuid,
                    'post_date'          => Carbon::now(),
                    'type_id'            => 2,
                    'opportunities_id'   => 0,
                    'first_name'         => $request->name,
                    'phone_1'            => $request->phone,
                    'email'              => $request->email,
                    'business_nature_id' => $request->industry,
                    'investment'         => $request->investment,
                    'profit'             => $request->profit,
                    'desc_2'             => $request->message,
                    'source'             => $s_source,

                    'member_create_date' => '0000-00-00 00:00:00',
                    'member_create_by'   => '0',
                    'member_modify_date' => '0000-00-00 00:00:00',
                    'member_modify_by'   => '0',
                    'modify_date'        => '0000-00-00 00:00:00',
                    'create_date'        => '0000-00-00 00:00:00',
                    'create_by'          => '0',
                    'modify_by'          => '0',
                    'deleted'            => '0',
                    'inactive'           => '0',
                    'status'             => '0',
                    ));
            $company = $request->input('company', 'TRADEASY');

            $params = [
                'name'                 => $request->name,
                'phone'                => $request->phone,
                'email'                => $request->email, 
                'business_nature_name' => $nature_name, 
                'investment'           => $request->investment,
                'profit'               => $request->profit,
                'message'              => $request->message,
                'come_to'              => $s_source,
                'company'              => $company,
                ]; 
            // Mail::to(config('mail.toMail'))
            //         ->send(new SendMail('buy_business',  $params, 'Transoft', 'Buy Business Tradeasy') );
            EmailJob::dispatch($request->email, 'sell_business_customer', $params, $params['company'], $params['company']." - Contact us");

            EmailJob::dispatch(config('mail.toMail'), 'sell_business_ad', $params, $params['company'], $params['company']." - Contact us");
            
            DB::commit();
            $request->session()->flush();
            return redirect()->back()->with('sell-business', 'success');

        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function _validateSell($request) {
        $this->validate($request, [
            'name'       => 'between: 1, 150',
            'phone'      => 'between: 1, 20',
            'email'      => 'email| between: 1, 150',
            'profit'     => 'between: 1, 150',
            'industry'   => 'between: 1, 150',
            'investment' => 'between: 1, 150',
            'captcha'    => 'between: 1, 150|captcha'
        ]);
    }
}
