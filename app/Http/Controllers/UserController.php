<?php
declare(strict_types=1);
namespace App\Http\Controllers;

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
        // validate済みのデータの取得
    $datum = $request->validated();
    var_dump($datum); exit;

    }
}