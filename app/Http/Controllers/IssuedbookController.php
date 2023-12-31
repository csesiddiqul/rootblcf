<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IssueBook\IssuedBookService;

class IssuedbookController extends Controller
{
    protected $issuedBookService;

    public function __construct(IssuedBookService $issuedBookService)
    {
        parent::__construct();
        $this->issuedBookService = $issuedBookService;
    }

    /**
     * Show the issued books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issuedBooks = $this->issuedBookService->getIssuedBooks();
        return view('library.issued-books', ['issued_books' => $issuedBooks]);
    }

    /**
     * Show all available books list so that librarian can issue books to students.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = \App\Book::bySchool(auth()->user()->school_id)
            ->where('quantity', '>', 0)
            ->get();
        return view('library.issuebooks', ['books' => $books]);
    }

    /**
     * Issue books to a student.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $studentExists = \App\User::bySchool(auth()->user()->school_id)->where('student_code', $request->student_code)->first();
        if ($studentExists) {
            $this->issuedBookService->request = $request;
            $this->issuedBookService->storeIssuedBooks();
            toast(transMsg('Save Successfully.'), 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast(transMsg('Student not found!'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        \DB::transaction(function () use ($request) {
            $tb = \App\Issuedbook::find($request->issue_id);
            $tb->borrowed = 0;
            $tb->quantity = 0;
            $tb->save();
            $book = \App\Book::where('id', $request->book_id)->first();
            $book->quantity += 1;
            $book->save();
        }, 5);
        toast(transMsg('Save Successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }
}
