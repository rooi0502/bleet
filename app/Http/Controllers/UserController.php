<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUser;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(User $user)
     {
         return view('users.show', ['user' => $user]);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(User $user)
     {
         return view('users.edit', ['user' => $user]);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(StoreUser $request, User $user)
     {
         $user->name = $request->name;
         if($request->hasFile('image')) {
            $filename = $request->image->storeAs('public', Auth::id() . '.jpg');
            $user->image = basename($filename); 
         }
         $user->save();
         return redirect('users/'.$user->id.'/edit')->with('success', 'プロフィールを変更しました');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 各アクションの前に実行させるミドルウェア
     */
     public function __construct()
     {
        $this->middleware('auth');
     }
}