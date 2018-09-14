<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $proxy = 'ptx.proxy.corp.sopra';
        $url = "http://worldcup.sfg.io/matches/today";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 80);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        $location = $response_a[0]['location'];*/

        $matchs_end = DB::table('matchs')
            ->where('resultat1', '<>', NULL)
            ->orderBy('date_match', 'DESC')
            ->limit(6)
            ->get();

        $matchs_a_venir = DB::table('matchs')
            ->where('resultat1', '=', NULL)
            ->orderBy('date_match', 'ASC')
            ->limit(6)
            ->get();


        $messages = Message::orderBy('created_at','desc')->limit(15)->get();

        $retardataires = DB::table('retardataire') ->where('isActif', '=', 1)->orderBy('TYPE', 'ASC')->orderBy('prenom', 'ASC')->get();

        $message = new Message;
        $message->text = '';

        return view('home')
            ->with('matchs_end', $matchs_end)
            ->with('matchs_prono', $matchs_a_venir)
            ->with('retardataires', $retardataires)
            ->with('messages', $messages)
            ->with('message', $message);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); 
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tchat(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|max:100'
        ]);

        $userId = auth()->user()->id;

        $message = new Message;
        $message->text = $request->input('message');
        $message->user_id = $userId;
        $message->save();

        return redirect('/');
    }
}
