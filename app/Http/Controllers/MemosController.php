<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 作成したモデルを追加
use App\Memo;

class MemosController extends Controller
{
  
  
  public function index()
  {
      // 作成日時を指定（降順）　get メソッドでレコートを取得
      $memos = Memo::orderBy('created_at', 'desc')->get();
       
      // $memosのデータをわたす、view で index.blade.php をレンタリング
      return view ('index', ['memos'=>$memos]);
  }
    
  public function create()
  {
      // コントローラー、ルートを介さず表示している
      return view('create');
  }

  public function store(Request $request)
  {
      // Varidation コンテントの項目を検証して、通過したら $content に代入
      $content = $request->validate(['content' => 'required|max:500']);
      
      // create メソッドでデータを登録
      Memo::create($content);
      
      // Route index を指定して redirect する
      return redirect()->route('index');
  }
    
  public function edit(Request $request)
  {
      // 対象レコードの ID を $memo に代入
      $memo = Memo::find($request->id);
      
      // ['memo' => $memo,] 編集対象のレコードをわたしている
      return view('edit', ['memo' => $memo,]);
  }
  
  public function update(Request $request)
  {
      // ID レコードから find メソッドで対象レコードの検索、$memo に代入。
      $memo = Memo::find($request->id);
      
      // コンテント項目を検証して、通過したら $content に代入 
      $content = $request->validate(['content' => 'required|max500']);
      
      // fill メソッドでコンテントをうめてから、保存
      $memo->fill($content)->save();
      return redirect()->route('index');
  }
  
  public function delete(Request $request)
  {
      $memo = Memo::find($request->id);
      
      // delete メソッドで削除
      $memo->delete();
      return redirect()->route('index');
  }

}
