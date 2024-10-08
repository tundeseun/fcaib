<?php

namespace App\Http\Controllers\Student;

use Stripe;
use App\SmStudent;
use App\YearCheck;
use App\SmAddIncome;
use App\SmFeesAssign;
use App\SmFeesMaster;
use App\SmBankAccount;
use App\SmFeesPayment;
use App\SmNotification;
use App\SmPaymentMethhod;
use App\SmBankPaymentSlip;
use App\SmGeneralSettings;
use App\SmRoomList;
use Illuminate\Http\Request;
use App\SmFeesAssignDiscount;
use App\SmPaymentGatewaySetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Remita\Remita;
use App\SmAcademicYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Paystack;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class SmFeesController extends Controller
{
    public $paystack;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
        $this->paystack = new Paystack();
    }



    public function studentFees()
    {
        try {
            $student = Auth::user()->student;

            $payment_gateway = SmPaymentMethhod::where('active_status', 1)->where('school_id', Auth::user()->school_id)->first();

            $fees_assigneds = SmFeesAssign::where('student_id', $student->id)->where('school_id', Auth::user()->school_id)->get();
            $fees_discounts = SmFeesAssignDiscount::where('student_id', $student->id)->where('school_id', Auth::user()->school_id)->get();

            $applied_discount = [];
            foreach ($fees_discounts as $fees_discount) {
                $fees_payment = SmFeesPayment::select('fees_discount_id')->where('active_status', 1)->where('fees_discount_id', $fees_discount->id)->where('school_id', Auth::user()->school_id)->first();
                if (isset($fees_payment->fees_discount_id)) {
                    $applied_discount[] = $fees_payment->fees_discount_id;
                }
            }

            $paystack_info = DB::table('sm_payment_gateway_settings')->where('gateway_name', 'Paystack')->where('school_id', Auth::user()->school_id)->first();


            $data['bank_info'] = SmPaymentMethhod::where('method', 'Bank')->where('school_id', Auth::user()->school_id)->first();
            $data['cheque_info'] = SmPaymentMethhod::where('method', 'Cheque')->where('school_id', Auth::user()->school_id)->first();

            return view('backEnd.studentPanel.fees_pay', compact('student', 'fees_assigneds', 'fees_discounts', 'applied_discount', 'payment_gateway', 'paystack_info', 'data'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function payFees(Request $request)
    {
       
        try {
            
            $fee = SmFeesAssign::find($request->id);
            $user = Auth::user();

            if(SmFeesPayment::where(['student_id' => $user->student->id, 'assign_id' => $fee->id])->exists()){
                Toastr::error('Fee Already paid', 'Failed');
                return redirect('student-fees');
            }

            return view('backEnd.studentPanel.pay_fees', compact('fee', 'user'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function studentPaidFees($id)
    {
        try {
            $fees_payments = SmFeesPayment::with(['studentInfo','feesType'])->where('student_id', $id)->get();
            return view('backEnd.studentPanel.paid_fees', compact('fees_payments','id'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function FeesReceipt($id,$sid){
        try{
            $receipts = SmFeesPayment::with(['studentInfo','feesType'])->where('id',$id)->where('student_id', $sid)->first();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML(view("parentregistration::generate_receipt", compact('receipts'))->render());
            return $pdf->stream();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }

    }

    public function redirectToGateway(Request $request)
    {
        try {
            $paystack_info = DB::table('sm_payment_gateway_settings')->where('gateway_name', 'Paystack')->first();

            Config::set('paystack.publicKey', $paystack_info->gateway_publisher_key);
            Config::set('paystack.secretKey', $paystack_info->gateway_secret_key);
            Config::set('paystack.merchantEmail', $paystack_info->gateway_username);


            switch ($request->payment_type) {
                    case 'hostel':
                        Session::put('room_id', $request->room_id);
                        Session::put('payment_type', $request->payment_type);
                        break;

                    case 'transcript':
                        Session::put('payment_type', $request->payment_type);
                        Session::put('names', $request->first_name.' '.$request->last_name);
                        Session::put('phone_number', $request->phone_number);
                        Session::put('email', $request->email);
                        Session::put('department', $request->department);
                        Session::put('entry_year', $request->entry_year);
                        Session::put('graduation_year', $request->graduation_year);
                        Session::put('nationality', $request->nationality);
                        Session::put('institution_name', $request->institution_name);
                        Session::put('institution_address', $request->institution_address);
                        Session::put('institution_country', $request->institution_country);
                        Session::put('institution_email', $request->institution_email);
                        Session::put('institution_office', $request->institution_office);

                        if ($request->hasFile('document_file_2')) {
                            if (file_exists(Session::get('ssce'))) {
                            File::delete(Session::get('ssce'));
                            }
                            $file = $request->file('document_file_2');
                            $fileName = 'Transcript-SSCE' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/student/document/', $fileName);
                            $docName = 'public/uploads/student/document/'. $fileName;
                            // $data->ssce =  $imageName;
                            Session::put('ssce', $docName);
                        }


                        if ($request->hasFile('document_file_1')) {
                            if (file_exists(Session::get('statement'))) {
                                File::delete(Session::get('statement'));
                            }
                            $file = $request->file('document_file_1');
                            $fileName = 'Transcript-statement' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/student/document/', $fileName);
                            $docName = 'public/uploads/student/document/'. $fileName;
                            // $data->statement =  $imageName;
                            Session::put('statement', $docName);
                        }

                        break;

                    case 'Statement of Result':
                        Session::put('payment_type', $request->payment_type);
                        Session::put('names', $request->first_name.' '.$request->last_name);
                        Session::put('phone_number', $request->phone_number);
                        Session::put('email', $request->email);
                        Session::put('department', $request->department);
                        Session::put('graduation_year', $request->graduation_year);
                        break;
                    
                    case 'Post UTME Fee':
                        if($request->email == "" || $request->utme_number == ""){
                            Toastr::error('Email & UTME Number Required', 'Failed');
                            return redirect()->back();
                        }
                        Session::put('utme_number', $request->utme_number);
                        Session::put('email', $request->email);
                        Session::put('payment_type', $request->payment_type);
                    break;


                    default:
                        Session::put('fees_type_id', $request->fees_type_id);
                        Session::put('fees_master_id', $request->fees_master_id);
                        Session::put('assign_id',$request->assign_id);
                        Session::put('academic_id',$request->academic_id);
                        break;
            }

            Session::put('student_id', $request->student_id);

            Session::put('amount', $request->amount);
            Session::put('payment_mode', $request->payment_mode);


            $this->paystack = new Paystack();


            return $this->paystack->getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
           
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    /**PSm
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        try {


            // $student = SmStudent::where('user_id', $id)->where('school_id',Auth::user()->school_id)->first();
            $redr = 'student-fees';
            $amount = Session::get('amount');
            $amount = $amount / 100;

            $fees_payment = new SmFeesPayment();
            

            if(null !== Session::get('fees_type_id') && null !== Session::get('assign_id')){
                $fees_payment->fees_type_id = Session::get('fees_type_id');
                $fees_payment->assign_id = Session::get('assign_id');
                $fees_payment->academic_id = Session::get('academic_id');
                $fees_payment->student_id = Session::get('student_id');
                $redr = 'student-fees';
            }else{
                switch (Session::get('payment_type')) {
                    case 'hostel':
                            $fees_payment->fees_type_id = 4;
                            $fees_payment->room_id = Session::get('room_id');
                            $fees_payment->payment_type = Session::get('payment_type');
                            $fees_payment->academic_id = getAcademicId();
                            $fees_payment->student_id = Session::get('student_id');
                            break;

                    case 'transcript':
                            $fees_payment->fees_type_id = 3;
                            $fees_payment->payment_type = Session::get('payment_type');
                            $fees_payment->academic_id = getAcademicId();
                            $fees_payment->student_id = Session::get('student_id');
                            break;

                    case 'Statement of Result':
                            $fees_payment->fees_type_id = 5;
                            $fees_payment->payment_type = Session::get('payment_type');
                            $fees_payment->academic_id = getAcademicId();
                            $fees_payment->student_id = Session::get('student_id');
                            break;
                    
                    default:
                            $fees_payment->fees_type_id = 6;
                            $fees_payment->payment_type = Session::get('payment_type');
                            $fees_payment->email = Session::get('email');
                            $fees_payment->utme_number = Session::get('utme_number');
                            $fees_payment->academic_id = getAcademicId();
                            break;
                }

            }


            $fees_payment->discount_amount = 0;
            $fees_payment->fine = 0;
            $fees_payment->amount = $amount;
            $fees_payment->payment_date = date('Y-m-d', strtotime(date('Y-m-d')));
            $fees_payment->payment_mode = 'Paystack';
            $fees_payment->school_id = 1;
            $result = $fees_payment->save();


            $income_head=generalSetting();
            $add_income = new SmAddIncome();
            $add_income->name = 'Fees Collect';
            $add_income->date = date('Y-m-d', strtotime(date('Y-m-d')));
            $add_income->amount = $amount;
            $add_income->fees_collection_id = $fees_payment->id;
            $add_income->active_status = 1;
            $add_income->income_head_id = $income_head->income_head_id;
            $add_income->payment_method_id = 5;
            $add_income->created_by = 0;
            $add_income->school_id = 1;
            $add_income->academic_id = getAcademicId();
            $add_income->save();


            if(null !== Session::get('fees_type_id') && null !== Session::get('assign_id')){

                $get_master_id=SmFeesMaster::join('sm_fees_assigns','sm_fees_assigns.fees_master_id','=','sm_fees_masters.id')
                ->where('sm_fees_masters.fees_type_id',$fees_payment->fees_type_id)
                ->where('sm_fees_assigns.student_id',$fees_payment->student_id)->first();
                $fees_assign=SmFeesAssign::where('fees_master_id',$get_master_id->fees_master_id)->where('student_id',$fees_payment->student_id)->first();
                $fees_assign->fees_amount-=$amount;
                $fees_assign->save();
                Session::pull('fees_type_id');
                Session::pull('assign_id');
            }else{
                switch (Session::get('payment_type')) {
                    case 'hostel':
                        SmStudent::where('id',Session::get('student_id'))->update(['room_id' => Session::get('room_id')]);
                        SmRoomList::where('id',Session::get('room_id'))->update(['taken' => DB::raw('taken+1')]);
                        $redr = 'student-dormitory';
                        break;

                    case "transcript":

                        $data['student_id'] = Session::get('student_id'); 
                        $data['names'] =  Session::get('names');
                        $data['phone_number'] = Session::get('phone_number');
                        $data['email'] =Session::get('email');
                        $data['department'] =Session::get('department');
                        $data['entry_year'] =Session::get('entry_year');
                        $data['graduation_year'] =Session::get('graduation_year');
                        $data['nationality'] =Session::get('nationality');
                        $data['institution_name'] =Session::get('institution_name');
                        $data['institution_address'] =Session::get('institution_address');
                        $data['institution_country'] =Session::get('institution_country');
                        $data['institution_email'] =Session::get('institution_email');
                        $data['institution_office'] =Session::get('institution_office');
                        $data['ssce'] =Session::get('ssce');
                        $data['statement'] =Session::get('statement');
                        DB::table('sm_transcript_applications')->insert($data);
                        $redr = 'transcript-application';
                        break;

                    case "Statement of Result":

                        $data['student_id'] = Session::get('student_id'); 
                        $data['names'] =  Session::get('names');
                        $data['phone_number'] = Session::get('phone_number');
                        $data['email'] =Session::get('email');
                        $data['department'] =Session::get('department');
                        $data['graduation_year'] =Session::get('graduation_year');
                        DB::table('sm_statement_result_applications')->insert($data);
                        $redr = 'statement-result';
                        break;

                    default:
                        $redr = 'parentregistration/registration/'.Session::get('utme_number');
                        break;
                }
            }
            // $notification=new SmNotification();
            // $notification->date=$fees_payment->created_at;
            // $notification->url=$fees_payment->created_at;

            if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect($redr);

            } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect($redr);
                    // return redirect('student-fees')->with('message-danger', 'Something went wrong, please try again');
            }
        } catch (\Exception $e) {
       
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesPaymentStripe($fees_type, $student_id, $amount,$assign_id)
    {
        $stripe_info = SmPaymentGatewaySetting::where('gateway_name', 'stripe')->where('school_id', Auth::user()->school_id)->first();
        return view('backEnd.studentPanel.stripe_payment', compact('stripe_info', 'fees_type', 'student_id', 'amount','assign_id'));
    }

    public function feesPaymentStripeStore(Request $request)
    {
        $payment_setting = SmPaymentGatewaySetting::where('gateway_name', 'Stripe')->where('school_id', Auth::user()->school_id)->first();

        Stripe\Stripe::setApiKey($payment_setting->gateway_secret_key);

        Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from InfixEdu."
        ]);

        $user = Auth::User();

        // $student = SmStudent::where('user_id', $id)->where('school_id',Auth::user()->school_id)->first();


        $fees_payment = new SmFeesPayment();
        $fees_payment->student_id = $request->student_id;
        $fees_payment->fees_type_id = $request->fees_type;

        $fees_payment->discount_amount = 0;
        $fees_payment->fine = 0;
        $fees_payment->amount = $request->amount;
        $fees_payment->assign_id = $request->assign_id;
        $fees_payment->payment_date = date('Y-m-d', strtotime(date('Y-m-d')));
        $fees_payment->payment_mode = 'ST';
        $fees_payment->school_id = Auth::user()->school_id;
        $result = $fees_payment->save();

        $income_head=generalSetting();

        $add_income = new SmAddIncome();
        $add_income->name = 'Fees Collect';
        $add_income->date = date('Y-m-d', strtotime(date('Y-m-d')));
        $add_income->amount = $request->amount;
        $add_income->fees_collection_id = $fees_payment->id;
        $add_income->active_status = 1;
        $add_income->income_head_id = $income_head->income_head_id;
        $add_income->payment_method_id = 4;
        $add_income->created_by = Auth()->user()->id;
        $add_income->school_id = Auth::user()->school_id;
        $add_income->academic_id = getAcademicId();
        $add_income->save();

        // $notification=new SmNotification();
        // $notification->date=$fees_payment->created_at;
        // $notification->url=$fees_payment->created_at;

        $get_master_id=SmFeesMaster::join('sm_fees_assigns','sm_fees_assigns.fees_master_id','=','sm_fees_masters.id')
            ->where('sm_fees_masters.fees_type_id',$request->fees_type)
            ->where('sm_fees_assigns.student_id',$request->student_id)->first();

        $fees_assign=SmFeesAssign::where('fees_master_id',$get_master_id->fees_master_id)->where('student_id',$fees_payment->student_id)->first();
        $fees_assign->fees_amount-=$request->amount;
        $fees_assign->save();

        if ($result) {
            if ($user->role_id == 2) {
                Toastr::success('Operation successful', 'Success');
                return redirect('student-fees');
                // return redirect('student-fees')->with('message-success', 'Fees payment has been collected  successfully');
            } else {
                Toastr::success('Operation successful', 'Success');
                return redirect('parent-fees/' . $request->student_id);
                // return redirect('parent-fees/'.Session::get('student_id'))->with('message-success', 'Fees payment has been collected  successfully');
            }
        } else {
            if ($user->role_id == 2) {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('student-fees');
                // return redirect('student-fees')->with('message-danger', 'Something went wrong, please try again');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect('parent-fees/' . $request->student_id);
                // return redirect('student-fees')->with('message-danger', 'Something went wrong, please try again');
            }
        }
        // } catch (\Exception $e) {
        //     Toastr::error('Operation Failed', 'Failed');
        //     return redirect()->back();
        // }

    }

    public function feesGenerateModalChild(Request $request, $amount, $student_id, $type,$assign_id)
    {
        try {
            $amount = $amount;
            $fees_type_id = $type;
            $student_id = $student_id;
            $std_info = SmStudent::where('id',$student_id)->select('class_id','section_id')->first();

            $discounts = SmFeesAssignDiscount::where('student_id', $student_id)->where('school_id', Auth::user()->school_id)->get();
            
            $banks = SmBankAccount::where('active_status', '=', 1)
                    ->where('school_id', Auth::user()->school_id)
                    ->get();

                $applied_discount = [];
                foreach ($discounts as $fees_discount) {
                    $fees_payment = SmFeesPayment::where('active_status',1)->select('fees_discount_id')->where('fees_discount_id', $fees_discount->id)->where('school_id', Auth::user()->school_id)->first();
                    if (isset($fees_payment->fees_discount_id)) {
                        $applied_discount[] = $fees_payment->fees_discount_id;
                    }
                }


            $data['bank_info'] = SmPaymentGatewaySetting::where('gateway_name', 'Bank')->where('school_id', Auth::user()->school_id)->first();
            $data['cheque_info'] = SmPaymentGatewaySetting::where('gateway_name', 'Cheque')->where('school_id', Auth::user()->school_id)->first();


            $method['bank_info'] = SmPaymentMethhod::where('method', 'Bank')->where('school_id', Auth::user()->school_id)->first();
            $method['cheque_info'] = SmPaymentMethhod::where('method', 'Cheque')->where('school_id', Auth::user()->school_id)->first();

            return view('backEnd.studentPanel.fees_generate_modal_child', compact('amount','assign_id', 'discounts', 'fees_type_id', 'student_id', 'std_info','applied_discount', 'data', 'method','banks'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function childBankSlipStore(Request $request)
    {
        $request->validate([
            'slip' => "sometimes|nullable|mimes:pdf,doc,docx,jpg,jpeg,png,txt",
            'amount'=> "required",
        ]);


        try {

            if($request->payment_mode=="bank"){
                if($request->bank_id==''){
                    Toastr::error('Bank Field Required', 'Failed');
                    return redirect()->back();
                }
            }

            $fileName = "";
            if ($request->file('slip') != "") {
                $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                $file = $request->file('slip');
                $fileSize =  filesize($file);
                $fileSizeKb = ($fileSize / 1000000);
                if($fileSizeKb >= $maxFileSize){
                    Toastr::error( 'Max upload file size '. $maxFileSize .' Mb is set in system', 'Failed');
                    return redirect()->back();
                }
                $file = $request->file('slip');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/bankSlip/', $fileName);
                $fileName = 'public/uploads/bankSlip/' . $fileName;
            }

            $date = strtotime($request->date);

            $newformat = date('Y-m-d', $date);

            $payment_mode_name=ucwords($request->payment_mode);
            $payment_method=SmPaymentMethhod::where('method',$payment_mode_name)->first();

            $payment = new SmBankPaymentSlip();
            $payment->date = $newformat;
            $payment->amount = $request->amount;
            $payment->note = $request->note;
            $payment->slip = $fileName;
            $payment->fees_type_id = $request->fees_type_id;
            $payment->student_id = $request->student_id;
            $payment->payment_mode = $request->payment_mode;
            if($payment_method->id==3){
                $payment->bank_id = $request->bank_id;
            }
            $payment->assign_id=$request->assign_id;
            $payment->class_id = $request->class_id;
            $payment->section_id = $request->section_id;
            $payment->school_id = Auth::user()->school_id;
            $payment->academic_id = getAcademicId();
            $payment->save();

            Toastr::success('Payment Added, Please Wait for approval', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function feesGenerateModalChildView($id,$type_id)
    {

        $fees_payments = SmBankPaymentSlip::where('student_id',$id)->where('fees_type_id',$id)->get();
        return view('backEnd.studentPanel.view_bank_payment', compact('fees_payments'));
    }

    public function feesGenerateModalBankView($sid,$ft_id)
    {
        $fees_payments = SmBankPaymentSlip::where('student_id',$sid)->where('fees_type_id',$ft_id)->get();
        $amount = SmBankPaymentSlip::where('student_id',$sid)->where('fees_type_id',$ft_id)->sum('amount');
        return view('backEnd.studentPanel.view_bank_payment', compact('fees_payments','amount'));
    }

    public function childBankSlipDelete(Request $request)
    {

        try {
            $visitor = SmBankPaymentSlip::find($request->id);
            if ($visitor->slip != "") {
                $path = url('/') . $visitor->slip;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $result = $visitor->delete();

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}