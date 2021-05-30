<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $apikey = 'a97d681eac458ea566383e312d6f0fe342b210ae';
	public $successStatus = 200;
	public function __construct(Request $request){
		$header_key =  $request->header('authorization');
		if ($request->isMethod('post'))			{				
			if($header_key !=  $this->apikey){					
				echo 'Access Denied!';					
				exit;					
			}				
		}
		if($header_key !=  $this->apikey){				
			return view('500');				
		}		
	}

	public function getmembers(Request $request){
		$RetData = DB::table('tblmembers');
		if($request->account_id) $RetData=$RetData->where('account_id', $request->account_id);
		if($request->id) $RetData=$RetData->where('id', $request->id);
		if($request->phone_number) $RetData=$RetData->where('phone_number', $request->phone_number);
		if($request->client_member_id) $RetData=$RetData->where('client_member_id', $request->client_member_id);
		$RetData=$RetData->get();

		return response()->json(['success' => $RetData], 200); 
	}

	public function addmember(Request $request){
		$InsArr=array();
		$InsArr['first_name'] = $request->first_name;
		$InsArr['last_name'] = $request->last_name;
		$InsArr['phone_number'] = $request->phone_number;
		$InsArr['client_member_id'] = $request->client_member_id;
		$InsArr['account_id'] = $request->account_id;
		$InsArr['created_at'] = NOW();
		$MemberID = DB::table('tblmembers')->insertGetId($InsArr);;

		return response()->json(['success' => $MemberID], 200); 
	}

	public function editmember(Request $request){
		$id = $request->id;

		$InsArr=array();
		$InsArr['first_name'] = $request->first_name;
		$InsArr['last_name'] = $request->last_name;
		$InsArr['phone_number'] = $request->phone_number;
		$InsArr['client_member_id'] = $request->client_member_id;
		$InsArr['account_id'] = $request->account_id;
		$InsArr['modified_at'] = NOW();
		$MemberID = DB::table('tblmembers')->where('id', $id)->update($InsArr);;

		return response()->json(['success' => $id], 200); 
	}
}
