<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function top()
    {
        return view('admin.top');
    }

    /**
     * ログイン処理
     * 
     */
    public function login(LoginPostRequest $request)
    {
        // validate済
        // データの取得
        $datum = $request->validated();
        //var_dump($datum); exit;

        // 認証
        if (Auth::attempt($datum) === false) 
        {
            return back()
                   ->withInput() // 入力値の保持
                   ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]) // エラーメッセージの出力
                   ;
        }

        return redirect()->intended('/shopping_list/list');
    }
    
    /**
     * ログアウト処理
     * 
    */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();  // CSRFトークンの再生成
        $request->session()->regenerate();  // セッションIDの再生成
        return redirect(route('front.index'));
    }
}
