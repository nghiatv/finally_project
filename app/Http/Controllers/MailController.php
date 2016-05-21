<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Http\Request;
use App\Store;
use App\Http\Requests;
use App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $stores = Store::all();
        $users = User::all();
        return view('emails.editor')->with('stores', $stores)->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $req = array(
            'to' => $request->input('to'),
            'cc' => $request->input('cc'),
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
            'attachment' => $request->file('attachment')
        );
        $rules = array(
            'to' => 'required',
            'subject' => 'required',
            'content' => 'required',
        );
        $v = Validator::make($req, $rules);
        if ($v->fails()) {
            return Redirect::to('admin/mail')->withInput()->withErrors($v);
        } else {

            $files = $request->file('attachment');

            // Neu co file dinh kem
            if ($files[0] != null) {
                $this->multiple_upload($request);
            }
            $success = Mail::send(['html' => 'emails.default'], array(
                'body' => $request->input('content')
            ), function ($m) use ($files, $request) {
                $m->to(request()->input('to')); // them nguoi nha
                if ($request->input('cc')) {
                    $m->cc(request()->input('cc'));
                } // them cc
                $m->subject(request()->input('subject')); // them subject


                if ($files[0] != null) {
                    $size = sizeof($files);
                    for ($i = 0; $i < $size; $i++) {
                        $m->attach(public_path() . "/uploads/" . $files[$i]->getClientOriginalName()); // them attachment
                    }
                }
            });
            return Redirect::to('admin/mail')->with('messages', $success . ' Email đã được gửi thành công!');
        }

    }

    public function multiple_upload(Request $request)
    {
        // getting all of the post data
        $files = $request->file('attachment');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if (!$validator->fails()) {
                $destinationPath = public_path() . '/uploads/';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount++;
            }
        }
        if ($file_count == $uploadcount) {
            return true;
        } else {
            return Redirect::to('admin/mail')->withErrors($validator)->withInput();
        }
    }


}
