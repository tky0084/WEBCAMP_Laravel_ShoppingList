<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppinglistRegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_list;

class ShoppingListController extends Controller
{
    /**
     * トップページ を表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        return view('shopping_list.list');
    }
    
    public function register(ShoppinglistRegisterRequest $request)
    {
        $datum = $request->validated();
        //
        //$user = Auth::user();
        //$id = Auth::id();
        //var_dump($datum, $user, $id); exit;
        
        // user_id の追加
        $datum['user_id'] = Auth::id();
        
        // テーブルへのINSERT
        $r = Shopping_list::create($datum);
        var_dump($r); exit;
    }
}