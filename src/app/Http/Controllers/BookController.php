<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\BookStoreRequest;
use App\PublishingHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'publishing', 'rating', 'rating.reader'])
                        ->select('books.*')
                        ->get()
                        ->sortByDesc('created_at');
        //$books->Book::paginate(15);

        //dd($books);

        return view('books.books_list', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        $publishingHouses = PublishingHouse::all();
        $authors = Author::all();
        return view('books.add_book', [
            'publishingHouses' => $publishingHouses,
            'authors'          => $authors,
        ]);
    }

    public function store(BookStoreRequest $request)
    {
        $bookName = $request->bookName;
        $year = $request->year;
        $authorId = $request->authorId;
        $publishingHouseId = $request->publishingHouseId;

        $book = new Book();
        $book->name = $bookName;
        $book->years = $year;
        $book->author_id = $authorId;
        $book->publishing_house_id = $publishingHouseId;

        $book->save();

        Session::flash('flash_add_smell', 'Your book has been created!');

        return redirect('/books_list');
    }

    public function show($id = false)
    {
        $book = Book::find($id);

        return view('books.show_book', [
            'book' => $book,
        ]);
    }

    public function edit($id = false)
    {
        $book = Book::find($id);
        $authors = Author::all();
        $publishingHouses = PublishingHouse::all();

        return view('books.edit_book', [
            'book' => $book,
            'authors' => $authors,
            'publishingHouses' => $publishingHouses,
        ]);
    }

    public function update(BookStoreRequest $request, $id = false)
    {
        $bookName = $request->bookName;
        $year = $request->year;
        $authorId = $request->authorId;
        $publishingHouseId = $request->publishingHouseId;

        $book = Book::find($id);
        $book->name = $bookName;
        $book->years = $year;
        $book->author_id = $authorId;
        $book->publishing_house_id = $publishingHouseId;

        $book->update();
        return redirect('/show_book/'. $book->id);
    }

    public function delete($id)
    {
        $book = Book::where('id', $id)->first();
        $book->rating()->delete();
        $book->delete();
        return redirect('/books_list');
    }


    public function search(BookSearchRequest $request)
    {
        $query = $request->input('query');

        $books = Book::with('author', 'publishing')
                        ->select('books.*')
                        ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
                        ->leftJoin('publishing_houses', 'books.publishing_house_id', '=', 'publishing_houses.id')
                        ->where('books.name', 'like', "%$query%")
                        ->orWhere('years', 'like', "%$query%")
                        ->orWhere('authors.first_name', 'like', "%$query%")
                        ->orWhere('authors.second_name', 'like', "%$query%")
                        ->orWhere('publishing_houses.name', 'like', "%$query%")
                        ->get();


        return view('books.search_results', [
            'books' => $books,
        ]);
    }



}
