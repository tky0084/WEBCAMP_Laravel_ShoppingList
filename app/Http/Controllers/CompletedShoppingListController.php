<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShoppinglistRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Completed_shopping_list;


class CompletedShoppingListController extends Controller
{
    public function list()
    {
        // 1Page辺りの表示アイテム数を設定
        $per_page = 3;
        
        $list = Completed_shopping_list::where('user_id', Auth::id())
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('name')
                            ->paginate($per_page);
                            // ->get();
        //
 return view('completed', ['list' => $list]);
    }
}