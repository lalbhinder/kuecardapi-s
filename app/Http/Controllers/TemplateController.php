<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Support\Facades\DB;
use App\TemplateType;
use App\User;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function Template()
    {
        $template_type=TemplateType::where('parent_id','0')->get();
        return view('add_template',compact('template_type'));
    }

    public function getParentData($id)
    {
        $template_type=TemplateType::where('parent_id',$id)->get();
        return $template_type;
    }

    // public function CalendarTemplate(Request $request)
    // {
    //     $select=$request->get('select');
    //     $value=$request->get('value');
    //     $dependent=$request->get('dependent');
    //     $data=DB::table('template_types')->where($select,$value)
    //             ->groupBy($dependent)->get();
    //     $output='<option value="">Select '.ucfirst($dependent).' </option>';
    //     foreach($data as $row){
    //         $output.='<option value="'.$row->$dependent.'" > '.$row->$dependent.'
    //         </option>';
    //     }
    //     echo $output;
    // }
}
