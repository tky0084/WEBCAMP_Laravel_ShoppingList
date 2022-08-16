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
        // 1Page辺りの表示アイテム数を設定
        $per_page = 3;
        
        $list = Shopping_list::where('user_id', Auth::id())
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('name')
                            ->paginate($per_page);
                            // ->get();
$sql = Shopping_list::where('user_id', Auth::id())
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('name')->toSql();
//echo "<pre>\n"; var_dump($sql, $list); exit;
//var_dump($sql);
        //
        return view('shopping_list.list', ['list' => $list]);
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
        try {
            $r = Shopping_list::create($datum);
        } catch(\Throwable $e) {
            // XXX 本当はログに書く等の処理をする。今回は一端「出力する」だけ
            echo $e->getMessage();
            exit;
        }
                // タスク登録成功
        $request->session()->flash('front.shopping_list_register_success', true);

        //
        return redirect('/shopping_list/list');
    }
    /**
     * 削除処理
     */
    public function delete(Request $request, $task_id)
    {
        // task_idのレコードを取得する
        $task = $this->getTaskModel($task_id);

        // タスクを削除する
        if ($task !== null) {
            $task->delete();
            $request->session()->flash('front.task_delete_success', true);
        }

        // 一覧に遷移する
        return redirect('/shopping_list/list');
    }
}