@extends('layout')

@section('content')

  <div class="text-right">
    <a href="{{ route('create') }}" class="btn btn-outline-secondary btn-sm mt-4">メモを作成</a>
  </div>

  <div class="container">
    <div class="row">

      <!--
      MemoController.php
      public function index()
      {
          // 作成日時を指定（降順）　get メソッドでレコートを取得
          $memos = Memo::orderBy('created_at', 'desc')->get();
           
          // $memosのデータをわたす、view で index.blade.php をレンタリング
          return view ('index', ['memos'=>$memos]);
      }
      -->
      
      <!-- MemoController.php の ['memos' => $memos] で指定したデータを foreach 配列で一ずつ取り出しながら
            content 項目を取り出している-->
        @foreach ($memos as $memo)
        
        <div class="col-md-4 text-left mt-4">

          <div class="card">

            <div class="card-body">
              <p class="text-black-50"> {{ $memo->content }} </p>
            </div>

            <div class="card-footer text-right">
              <a href="{{ route('edit', ['id'=>$memo->id])}}" class="text-info">編集</a>
              <a href="{{ route('delete', ['id'=>$memo->id])}}" class="text-info">削除</a>
            </div>

          </div>

        </div>
        @endforeach