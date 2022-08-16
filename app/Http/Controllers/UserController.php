<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('newuser');
    }
    
    public function register(UserRegisterRequest $request)
    {
    // データの取得
    $datum = $request->validated();
    //var_dump($datum); exit;
    
    // パスワードのハッシュ化
    $datum['password'] = Hash::make($datum['password']);
       
    // テーブルへのINSERT
    try {
        User::create($datum);
    } catch(\Throwable $e) {
        echo $e->getMessage();
        exit;
    }

    $request->session()->flash('front.user_register_success', true);

    return redirect('/');
    }
}