<?php

namespace App\Http\Controllers;

use App\Models\BookStatus;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller {

    use ApiResponse;

    public function getAll(Request $req) {
        $books = Book::all();
        return $this->sendResponse($books, 'OK', 200);
    }

    public function get($id, Request $req) {
        $book = Book::find($id);
        if($book == null)
            return $this->sendError('Not found', 404);
        return $this->sendResponse($book, 'OK', 200);
    }

    public function create(Request $req) {
        $book = new Book();
        $book->name = $req->input('name');
        $book->contents = $req->input('contents');

        $book->save();

        return $this->sendResponse($book, 'OK', 200);
    }

    public function delete($id, Request $req) {
        $book = Book::find($id);
        if($book == null)
            return $this->sendError('Not found', 404);
        $book->delete();
        return $this->sendEmptyResponse('OK', 200);
    }

    public function edit($id, Request $req) {
        $book = Book::find($id);
        if($book == null)
            return $this->sendError('Not found', 404);
        if($book->name != $req->input('name') and $req->input('name') != null)
            $book->name = $req->input('name');
        if($book->contents != $req->input('contents') and $req->input('contents') != null)
            $book->contents = $req->input('contents');
        if($req->input('status') != null) {
            $status = BookStatus::find($req->input('status'));
            if($status == null)
                return $this->sendError('Bad request', 400, ['Status invalid']);
            if ($book->status_id != $status->id)
                $book->status_id = $status->id;
        }
        $book->save();
        return $this->sendResponse($book, 'OK', 200);
    }

}
