<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Contact\Contact;

class ContactController extends Controller
{
    //danh sách liên hệ chưa xử lý
    public function getlistContact(){
    	$contact = Contact::where('status', 1)->get();
    	return view('Backend.Admin.Contact.ListContact',['contact'=>$contact]);    
    }
     public function postlistContact(request $request,  $id){
        $contact = Contact::find($id);
        $contact->status = 2;
        $contact->save();
        return redirect(route('list.processed.contact'));
    }
    //danh sách liên hệ đã xử lý
    public function listprocessed(){
        $contact = Contact::where('status', 2)->get();

        return view('Backend.Admin.Contact.ListProcess',['contact'=>$contact]);
    }

}
