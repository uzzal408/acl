<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Store;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function feedback01()
    {
        $stores = Store::where('status',1)->get();
        return view('livewire.feedback.feed-step01',compact('stores'));
    }

    public function postStep1(Request $request){
        $request->validate([
            'cust_name'=> 'required|string|max:50',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'anniversary' => 'required',
            'cust_email' => 'required|email',
            'cust_landline' => 'required',
            'feasible_time_of_contact' => 'required',
            'cust_address' => 'required',
            'store_id' => 'required',
            'store_address' => 'required',
            'type_of_order' => 'required',
            'kfc_visit_often' => 'required',
            'date_of_visit'   => 'required',
        ]);
        $data = array(
            'cust_name' => $request->cust_name,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
            'anniversary'        => $request->anniversary,
            'cust_email'        => $request->cust_email,
            'cust_landline'        => $request->cust_landline,
            'feasible_time_of_contact'        => $request->feasible_time_of_contact,
            'cust_address'        => $request->cust_address,
            'store_id'        => $request->store_id,
            'store_address'        => $request->store_address,
            'type_of_order'        => $request->type_of_order,
            'kfc_visit_often'        => $request->kfc_visit_often,
            'date_of_visit'        => $request->date_of_visit,
        );
       Session::put('step1Data',$data);
       return redirect(url('/feedback/step02'));
    }

    public function feedback02()
    {
        if(Session::has('step1Data')) {
            return view('livewire.feedback.feed-step02');
        }else{
            return redirect(url('/feedback/step01'));
        }
    }
    public function postStep2(Request $request){
        $request->validate([
            'type_of_feedback'=> 'required',
            'ws_food_to_liking'=> 'required',
            'visit_again'=> 'required',
            'ws_served_speedily'=> 'required',
            'recommend_friends'=> 'required',
            'ws_restaurant_clean'=> 'required',
            'is_val_for_money'=> 'required',
            'ws_hospitable_friendly'=> 'required',
            'receive_wht_ordered'=> 'required',
            'ws_restaurant_maintained'=> 'required',
            'your_feedbck'=> 'required|string|max:1000',
            'scope_for_improvement'=> 'required|string|max:1000',
            'serve_better'=> 'required|string|max:500',
        ]);
        if(Session::has('step1Data')) {
            $data = Session::get('step1Data');
            $cust_name = $data['cust_name'];
            $dob = $data['date_of_birth'];
            $gender = $data['gender'];
            $anniversary = $data['anniversary'];
            $cust_email = $data['cust_email'];
            $mobile = $data['cust_landline'];
            $contact_time = $data['feasible_time_of_contact'];
            $address = $data['cust_address'];
            $store_id = $data['store_id'];
            $st_address = $data['store_address'];
            $tor = $data['type_of_order'];
            $kvo = $data['kfc_visit_often'];
            $dov = $data['date_of_visit'];
            $tof = $request->type_of_feedback;
            $ftl = $request->ws_food_to_liking;
            $va = $request->visit_again;
            $wsp = $request->ws_served_speedily;
            $rf = $request->recommend_friends;
            $rc = $request->ws_restaurant_clean;
            $vfm = $request->is_val_for_money;
            $hf = $request->ws_hospitable_friendly;
            $rwo = $request->receive_wht_ordered;
            $wrm = $request->ws_restaurant_maintained;
            $yf = $request->your_feedbck;
            $sfi = $request->scope_for_improvement;
            $sb = $request->serve_better;

            $feedback = new Feedback();
            $feedback->cust_name = $cust_name;
            $feedback->dob = $dob;
            $feedback->gender = $gender;
            $feedback->anniversary = $anniversary;
            $feedback->cust_email = $cust_name;
            $feedback->cust_email = $cust_email;
            $feedback->mobile = $mobile;
            $feedback->contact_time = $contact_time;
            $feedback->address = $address;
            $feedback->store_id = $store_id;
            $feedback->st_address = $st_address;
            $feedback->tor = $tor;
            $feedback->kvo = $kvo;
            $feedback->dov = $dov;
            $feedback->tof = $tof;
            $feedback->ftl = $ftl;
            $feedback->va = $va;
            $feedback->wsp = $wsp;
            $feedback->rf = $rf;
            $feedback->rc = $rc;
            $feedback->vfm = $vfm;
            $feedback->hf = $hf;
            $feedback->rwo = $rwo;
            $feedback->wrm = $wrm;
            $feedback->yf = $yf;
            $feedback->sfi = $sfi;
            $feedback->sb = $sb;
            $feedback->save();
            Session::forget('step1Data');
            return redirect('/feedback/completed')->with('success', 'Feedback successfully submitted');
        }else{
            return redirect(url('/feedback/step01'))->with('error','Please Try again');
        }
    }

    public function completed(){
        return view('livewire.feedback.thanks');
    }
}
