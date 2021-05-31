<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DataTables;
use DB, Session;
use Redirect,Response;
use Illuminate\Support\Facades\Route;
use App\Models\Productcat; 
use Image;
class HomeController extends Controller{
    public function member(){
       	$tblmembers=DB::table('tblmembers')->get();
        return view('welcome',['tblmembers'=>$tblmembers]);
    }   
    public function edit($id){
        $retData=DB::table('tblmembers')->where('id',$id)->first();
        return Response::json($retData);
    }
    public function delete($id){
        $retData=DB::table('tblmembers')->where('id',$id)->delete();
        return redirect(route('member'));
    }
    public function memberstore(Request $request){
        $editid=(null != $request->input('member_id')?$request->input('member_id'):'');
        $dataArr=[];
        $dataArr['first_name'] = $request->first_name;
        $dataArr['last_name'] = $request->last_name;
        $dataArr['phone_number'] = $request->phone_number;
        $dataArr['client_member_id'] = $request->client_member_id;
        $dataArr['account_id'] = $request->account_id;
        $dataArr['modified_at'] = NOW();
        if($editid){
            DB::table('tblmembers')->where('id',$editid)->update($dataArr);
        }else{
            $dataArr['created_at'] = NOW();
            DB::table('tblmembers')->insert($dataArr);
        }
        return redirect(route('member'));
    }

    
}