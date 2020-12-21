<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\About;
use App\Http\Requests\Backend\AboutRequest;
class AboutController extends Controller
{
    function getAbout(){
        $data['about'] = About::all();

        return view('Backend.Admin.About.List',$data);
      // echo 'dsfawef';
    }
    function getedit($id){
        $data['about'] = About::find($id);
        return view('Backend.Admin.About.Edit',$data);
      // echo 'dsfawef';
    }
    function postedit(AboutRequest $r ,$id){
        $about = About::find($id);
        $about->name= $r->name;
        $about->content= $r->content;
        $about->save();

        return redirect('admin/about')->with('danger','Sửa thành công');


    }
}
