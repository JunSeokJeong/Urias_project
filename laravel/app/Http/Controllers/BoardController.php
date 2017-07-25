<?php

namespace App\Http\Controllers;

// use Illuminate\Pagination\Paginator;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boardPage = board::orderBy('created_at', 'desc')->paginate(10);
 
        return view('board.boardList', ['boardPage'=>$boardPage]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('board.boardWrite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $board = new board();
        $board->title = $request->input('title');
        $board->content = $request->input('content');
        $board->view = 0;
        $board->save();
        
        return redirect('/board/boardList');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $board = Board::find($id);
        
        return view('board.boardRead', ['board'=>$board] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $board = Board::find($id);
        
        return view('board.boardEdit', ['board'=>$board] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
       $board = Board::find($id);
       $board->title = $request->input('title');
       $board->content= $request->input('content');
       $board->save();
       
        return redirect('/board/boardList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $board = Board::find($id);
        $board->delete();
        
        return redirect('/board/boardList');
    }
    
    public function board_file_upload(Request $request) {
        
        $book_name = $request->input('book_name');
        $content = $request->input('content');
        $book_img = $request->file('img_file');
        $book_main_img = $request->file('main_img');
   
   }
}
