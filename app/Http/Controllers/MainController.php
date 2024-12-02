<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visitor;
use App\Models\User;
use App\Models\CustomerReg;
use App\Models\FreeManReg;
use Illuminate\Support\Facades\Mail;
use App\Mail\job_provider_reg_success_Mail;
use App\Mail\job_seeker_reg_success_Mail;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function __construct()
    {
        //base url
        $base_url = URL::to('/'); 
        Session::put('base_url',$base_url) ;
        
        //default value
        Session::put('registration_success',0) ; 
        

        //language
        if (Session::has('language')) 
        {
            $language = "";
            $language = Session::get('language');
            if($language =="")
            {
                $language = "en";
                Session::put('language',$language) ;
            }
        }
        ///////////////////////////////////////////
        

    }
    public function change_language($lan)
    {
        $pageurl ="";
        if($lan =="en")
        {
            Session::put('language','en') ; 
        }
        else if($lan =="jp"){
            Session::put('language','jp') ;
        }
        //return response()->json('changed');
        return response()->json($lan);
    }
    
    public function get_pageurl($en_url,$jp_url)
    {
        $pageurl ="";
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $language = "en";
            Session::put('language',$language) ; 
            $pageurl  = $en_url;
        }
        else if($language =="jp"){
            $language = "jp";
            Session::put('language',$language) ;
            $pageurl  = $jp_url;
        }

        return $pageurl ;
    }

    public function set_visitor()
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $visitorslist = Visitor::all();
        $previous_visitor = 0;
        if(count($visitorslist)>0)
        {
            for($i=0;$i<count($visitorslist);$i++)
            {
                if($visitor_ip == $visitorslist[$i]->visitor_ip)
                {
                    $previous_visitor = 1;
                    //if exist, time update
                    if(date("Y-m-d") != $visitorslist[$i]->updated_at)
                    {
                        Visitor::find($visitorslist[$i]->id)->update([
                            'updated_at'=> Carbon::now(),
                        ]);
                    }
                    
                }
                else{
                    $previous_visitor = 0;
                }
            }
        }
        //if not exist, new insert
        if($previous_visitor == 0)
        {
            Visitor::insert([
                'visitor_ip'=> $_SERVER['REMOTE_ADDR'],
                'visit_date'=> Carbon::now(),
                'total_visit'=> 1,
                'created_at'=> Carbon::now(),
            ]);
        }
    }

    //welcome page
    public function index()
    {
        $this->set_visitor();

        $page =$this->get_pageurl('fontend.en.welcome','fontend.jp.welcome');   
        $pagelanguage = $this->get_pagelanguage(); 
        
        return view($page,compact('pagelanguage'));
    }



    //language
    public function get_pagelanguage()
    {
        $language = "";
        $language = Session::get('language'); 
        if($language =="" || $language =="en")
        {
            $pagelanguage = array();
            $pagelanguage['LG_Login_ID'] = "Login ID";
            $pagelanguage['LG_Password'] = "Password";
            $pagelanguage['LG_Login'] = "Login";
            
            

            return $pagelanguage;
        }
        else
        {
            $pagelanguage = array();
            $pagelanguage['LG_Login_ID'] = "ログインID";
            $pagelanguage['LG_Password'] = "パスワード";
            $pagelanguage['LG_Login'] = "ログイン";
            


            return $pagelanguage;
        }
    }

    ////job_provider//////////////////////////////////////////////////////////////////
    public function job_provider_registration_form()
    {
        $page =$this->get_pageurl('fontend.en.job_provider_reg','fontend.jp.job_provider_reg');   
        $pagelanguage = $this->get_pagelanguage(); 
        
        return view($page,compact('pagelanguage'));
    }
    public function job_provider_registration_store(Request $request)
    {
        //dd($request->all());
        //validation
        $request->validate([
            's_code' => 'max:255',
            'title' => 'required|max:255',
            'postcode' => 'max:255',
            'address' => 'max:255',
            'email' => 'required|max:255|email|unique:customer_regs',
            'password' => 'min:6|max:12|required_with:confirm_password|same:confirm_password',   
            'confirm_password' => 'required|min:6',
            'phone' => 'required|max:255|unique:customer_regs'
        ]);

        $picname ="";
        $photo_l = "";
        $photo_s = "";
        //product main image upload
        if($request->file('image'))
        {
            $photo = $request->file('image'); 
            $photo_name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,400)->save('uploads/images/photo/job_provider/photo_l/'.$photo_name_gen);
            Image::make($photo)->resize(30,40)->save('uploads/images/photo/job_provider/photo_s/'.$photo_name_gen);
            $photo_l ='uploads/images/photo/job_provider/photo_l/'.$photo_name_gen;
            $photo_s ='uploads/images/photo/job_provider/photo_s/'.$photo_name_gen;
        }

        $s_code = rand(0000,9999);
        $id = CustomerReg::insertGetId([
            's_code' => $s_code,
            'photo_l'=> $photo_l,
            'photo_s'=> $photo_s,
            
            'title'=>$request->title,
            'postcode'=>$request->postcode,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'fax'=>$request->fax,
            'created_at'=>Carbon::now(),
        ]);
        if($id !="")
        {
            //send mail after registration
            $data = array();
            $data['s_code'] = $s_code;
            $data['photo_l'] = $photo_l;
            $data['title'] = $request->title;
            $data['postcode'] = $request->postcode;
            $data['address'] =$request->address;
            $data['email'] = $request->email;
            $data['phone'] =$request->phone;
            $data['fax'] =$request->fax;

            Mail::to($request->email)->send(new job_provider_reg_success_Mail($data));

            //show success message
            Session::put('registration_success',1) ;
            $page =$this->get_pageurl('fontend.en.job_provider_reg_success','fontend.jp.job_provider_reg_success');   
            $pagelanguage = $this->get_pagelanguage(); 
            return view($page,compact('pagelanguage'));
        }
        else
        {
            return Redirect()->back()->with('esuccess','Data save problem, try later'); 
        }
    }

    public function job_provider_login(Request $request)
    {
        //validation
        $request->validate([
            'provider_email' => 'required|max:255|email',
            'provider_password' => 'required',   
        ]);
        $jobproviderinfo = "";
        $jobproviderinfo = CustomerReg::where('email',$request->provider_email)->get(); 
        $dbuserpass = "";
        if($jobproviderinfo != "" && count($jobproviderinfo)>0)
        {
            
            $dbuserpass = $jobproviderinfo[0]->password;  
            if(Hash::check($request->provider_password, $dbuserpass))
            {
                Session::put('logger_provider_id',$jobproviderinfo[0]->id) ;
                Session::put('logger_provider_code',$jobproviderinfo[0]->s_code) ;
                Session::put('logger_provider_title',$jobproviderinfo[0]->title) ;

                return Redirect()->route('job_provider_panel');
            }
            else
            {
                return Redirect()->back()->with('error_provider','Invalid email or password');
            }
        }
        else
        {
            return Redirect()->back()->with('error_provider','Invalid email or password');
        }
    }
    

    
    
    ////job_seeker//////////////////////////////////////////////////////////////////
    public function job_seeker_registration_form()
    {
        $page =$this->get_pageurl('fontend.en.job_seeker_reg','fontend.jp.job_seeker_reg');   
        $pagelanguage = $this->get_pagelanguage(); 
        
        return view($page,compact('pagelanguage'));
    }
    
    public function job_seeker_registration_store(Request $request)
    {
        //dd($request->all());
        //validation
        $request->validate([
            's_code' => 'max:255',
            'title' => 'required|max:255',
            'postcode' => 'max:255',
            'address' => 'max:255',
            'email' => 'required|max:255|email|unique:free_man_regs',
            'password' => 'min:6|max:12|required_with:confirm_password|same:confirm_password',   
            'confirm_password' => 'required|min:6',
            'phone' => 'required|max:255|unique:free_man_regs'
        ]);

        $picname ="";
        $photo_l = "";
        $photo_s = "";
        //product main image upload
        if($request->file('image'))
        {
            $photo = $request->file('image'); 
            $photo_name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,400)->save('uploads/images/photo/job_seeker/photo_l/'.$photo_name_gen);
            Image::make($photo)->resize(30,40)->save('uploads/images/photo/job_seeker/photo_s/'.$photo_name_gen);
            $photo_l ='uploads/images/photo/job_seeker/photo_l/'.$photo_name_gen;
            $photo_s ='uploads/images/photo/job_seeker/photo_s/'.$photo_name_gen;
        }

        $s_code = rand(0000,9999);
        $id = FreeManReg::insertGetId([
            's_code' => $s_code,
            'photo_l'=> $photo_l,
            'photo_s'=> $photo_s,
            
            'title'=>$request->title,
            'postcode'=>$request->postcode,
            'address'=>$request->address,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'phone'=>$request->phone,
            'fax'=>$request->fax,
            'created_at'=>Carbon::now(),
        ]);
        if($id !="")
        {
            //send mail after registration
            $data = array();
            $data['s_code'] = $s_code;
            $data['photo_l'] = $photo_l;
            $data['title'] = $request->title;
            $data['postcode'] = $request->postcode;
            $data['address'] =$request->address;
            $data['email'] = $request->email;
            $data['phone'] =$request->phone;
            $data['fax'] =$request->fax;

            Mail::to($request->email)->send(new job_seeker_reg_success_Mail($data));

            //show success message
            Session::put('registration_success',1) ;
            $page =$this->get_pageurl('fontend.en.job_seeker_reg_success','fontend.jp.job_seeker_reg_success');   
            $pagelanguage = $this->get_pagelanguage(); 
            return view($page,compact('pagelanguage'));
        }
        else
        {
            return Redirect()->back()->with('esuccess','Data save problem, try later'); 
        }
    }
    public function job_seeker_registration_success()
    {
        $page =$this->get_pageurl('fontend.en.job_seeker_reg_success','fontend.jp.job_seeker_reg_success');   
        $pagelanguage = $this->get_pagelanguage(); 
        
        return view($page,compact('pagelanguage'));
    }
    
    public function job_seeker_login(Request $request)
    {
        //validation
        $request->validate([
            'seeker_email' => 'required|max:255|email',
            'seeker_password' => 'required',   
        ]);
        $jobseekerinfo = "";
        $jobseekerinfo = FreeManReg::where('email',$request->seeker_email)->get(); 
        $dbuserpass = "";
        if($jobseekerinfo != "" && count($jobseekerinfo)>0)
        {
            
            $dbuserpass = $jobseekerinfo[0]->password;  
            if(Hash::check($request->seeker_password, $dbuserpass))
            {
                Session::put('logger_seeker_id',$jobseekerinfo[0]->id) ;
                Session::put('logger_seeker_code',$jobseekerinfo[0]->s_code) ;
                Session::put('logger_seeker_title',$jobseekerinfo[0]->title) ;

                return Redirect()->route('job_seeker_panel');
            }
            else
            {
                return Redirect()->back()->with('error_seeker','Invalid email or password');
            }
        }
        else
        {
            return Redirect()->back()->with('error_seeker','Invalid email or password');
        }
    }
    



    




}
