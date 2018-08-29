<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuyBusiness;
use App\Models\BusinessDB2;
use App\Models\BusinessNature;
use App\Models\Location;
use App\Libs\Functions\HTTP;
use App\Jobs\EmailJob;
use App\Models\Franchises;

use Carbon\Carbon;
use DB, Mail;

class FranchiseCtrl extends Controller
{
    private $buyBusinessModel, $businessModel, $http, $base_url, $mail_check_arr = array(), $franchiseModel;
    public function __construct(BuyBusiness $buyBusiness, BusinessDB2 $business, HTTP $http) {
            $this->buyBusinessModel = $buyBusiness; 
            $this->businessModel    = $business;
            $this->http             = $http;
            $this->base_url         = "http://transoft.tk/";
            $this->franchiseModel = new Franchises();
    }   
    /**
     * Insert and send mail buy business
     * @param $request
     *
     * @return \Illuminate\Http\Response
     */

    public function addEvent (Request $request) {
        DB::beginTransaction();
        try {
            $s_source="Email Enquiry";
            $t_uuid=uniqid("", true);

            $franchiseItem = $this->franchiseModel::find($request->franchise_id);

            DB::connection('mysql2')
                ->table('tbl_business_transfer')
                ->insert(array(
                    't_uuid'             => $t_uuid,
                    'post_date'          => Carbon::now(),
                    'type_id'            => 2,
                    'opportunities_id'   => $request->input('franchise_id', 0),
                    'first_name'         => $request->name,
                    'phone_1'            => $request->phone,
                    'email'              => $request->email,
                    'business_nature_id' => 0,
                    'desc_2'             => "[".$request->input('company', "TRADEASY")."] ".$request->message,
                    'source'             => $s_source,
                    'character_1'        => "",

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
                'name'           => $request->name,
                'phone'          => $request->phone,
                'number'         => $request->number,
                'email'          => $request->email, 
                'franchise_id'   => $request->input('franchise_id', 0),
                'franchise_name' => $request->input('franchise_name', ""),
                'message'        => $request->number,
                'intro'          => @$franchiseItem->intro_2,
                'code'           => @$franchiseItem->code,
                'transfer'       => @$request->number,
                'type'           => '講座/課程',
                 
                'come_to'        => $s_source, 
                'company'        => $company,
            ]; 
            $opp_id = $request->input('franchise_id', -1);
            $url    = $this->base_url."follow_franchise.php?t_uuid=".$t_uuid."&ref1=".$opp_id; 

            EmailJob::dispatch($request->email, 'franchise_customer', $params, $params['company'], $params['company']." - Acquired Business");
            EmailJob::dispatch($request->company_email, 'franchise_ad', $params, $params['company'], $params['company']." - Acquired Business");
            $this->_sendMailAd($opp_id, $t_uuid, $params, $url);
            $this->_sendExclusive($opp_id,  $request->phone, $t_uuid, $params, $url);

            DB::commit();

            return response()->json(['status' => true], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }    
    }

    public function _sendMailAd ($opp_id, $uuid, $params, $url) {
        $data = DB::connection('mysql2')->table('sys_user_group')
                                        ->join('sys_user', 'sys_user_group.id', '=', 'sys_user.sys_user_group_id')
                                        ->select('sys_user.id', 'sys_user.user', 'sys_user.email')
                                        ->where(array(
                                                array('sys_user.active', 1),
                                                array('sys_user.deleted', 0),
                                                array('sys_user.email', '<>', ''),
                                            ))
                                        ->whereIn('sys_user_group.name_2', ['System Administrator', 'CSO'])
                                        ->get();
        $params['start_time'] = Carbon::now();
        foreach ($data as $key => $value) {
            if (!in_array(@$value->email, $this->mail_check_arr)) {
                $this->mail_check_arr[] = @$value->email;

                DB::connection('mysql2')
                    ->table('tbl_opportunities_mail_user_franchise')
                    ->insert(array(array(
                            'opp_id'     => $opp_id, 
                            'user_id'    => $value->id, 
                            'start_time' => Carbon::now(), 
                            't_uuid'     => $uuid), 
                ));
                $params['user']  = @$value->user;
                $params['link']  = $url."&ref2=".@$value->id;

                EmailJob::dispatch(@$value->email, 'franchise', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
        return $data;
    }

    public function _sendExclusive($opp_id, $phone, $uuid, $params, $url) {
        $exclusive_business = DB::connection('mysql2')
                            ->table('tbl_customer_exclusive_salesman')
                            ->join('sys_user', 'tbl_customer_exclusive_salesman.user_id', '=', 'sys_user.id')
                            ->select('sys_user.id' , 'sys_user.user', 'sys_user.email', 'tbl_customer_exclusive_salesman.overdue_time')
                            ->where(array(
                                array('tbl_customer_exclusive_salesman.overdue_time', '>=', Carbon::now()),
                                array('tbl_customer_exclusive_salesman.customer_tel', $phone),
                            ))
                            ->first();
        if (!empty($exclusive_business)) {
            $email_user = DB::connection('mysql2')
                            ->table('tbl_opportunities_mail_user')
                            ->select(DB::raw('count(0) as count'))
                            ->where(array(
                                array('user_id', $exclusive_business->id),
                                array('t_uuid', $t_uuid),
                            ))
                            ->first();
            if ($email_user->count == 0) {
                DB::connection('mysql2')
                                ->table('tbl_opportunities_mail_user')
                                ->insert(array(
                                    'opp_id'     => $opp_id,
                                    'user_id'    => $exclusive_business->id,
                                    'start_time' => Carbon::now(),
                                    't_uuid'     => $uuid,
                                ));
                $params['user']       = @$value->user;
                $params['link']       = $url."&ref2=".@$value->id;
                $params['start_time'] = Carbon::now();

                EmailJob::dispatch(@$value->email, 'franchise', $params, $params['company'], $params['company']." Acquired Business");
            }
        }
    }

}
