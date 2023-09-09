<?php

namespace App\Services\IssueBook;

use App\Issuedbook;
use App\Book;
use Illuminate\Support\Facades\DB;

class IssuedBookService
{
    public $request;
    public $ib;

    public function getIssuedBooks()
    {
        return Issuedbook::join('books', 'issued_books.book_id', '=', 'books.id')
            ->select('issued_books.*', 'books.title', 'books.type', 'users.name')
            ->join('users', 'issued_books.student_code', '=', 'users.student_code')
            ->where('issued_books.borrowed', '=', 1)
            ->where('issued_books.school_id', '=', auth()->user()->school->id)
            ->get();
    }

    /**
     * Insert each issued book to an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insertEachIssuedBookInAnArray()
    {
        foreach ($this->request->book_id as $bk) {
            $issueBooks = new Issuedbook;
            $issueBooks->student_code = $this->request->student_code;
            $issueBooks->book_id = $bk;
            $issueBooks->quantity = 1;
            $issueBooks->school_id = auth()->user()->school_id;
            $issueBooks->issue_date = $this->request->issue_date;
            $issueBooks->return_date = $this->request->return_date;
            $issueBooks->fine = 0;//$this->request->fine;
            $issueBooks->borrowed = 1;
            $issueBooks->user_id = auth()->user()->id;
            $issueBooks->created_at = now();
            $issueBooks->updated_at = now();
            $this->ib[] = $issueBooks->attributesToArray();
        }
    }

    public function storeIssuedBooks()
    {
        $this->insertEachIssuedBookInAnArray();

        DB::transaction(function () {
            Issuedbook::insert($this->ib);
            Book::whereIn('id', $this->request->book_id)->decrement('quantity', 1);
            /* Book::whereIn('id', $this->request->book_id)->update([
                 'quantity' =>   DB::raw( CONCAT('quantity', '-', 1)) //DB::raw('MAX((quantity - 1), 0)')
             ]);*/
        });
    }
}