<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\City;
use App\Country;
use App\Http\Requests\BookSearchRequest;
use App\Http\Requests\BookStoreRequest;
use App\Owner;
use App\PublishingHouse;
use Illuminate\Database\Eloquent\Builder;
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

    public function searchWithSelection(Request $request/*, Owner $owner*/)
    {

        $publishingHouses = PublishingHouse::all();
        $owners = Owner::all();


        $books = Book::select('books.id', 'books.name', 'years', 'books.author_id', 'publishing_house_id');

        if ($request->get('book_name')) {
            $books->where("books.name", "like", "%$request->book_name%");
        }

        if ($request->get('publishing_house')) {
            $books = $books->leftJoin('publishing_houses', 'books.publishing_house_id', '=', 'publishing_houses.id');
            $books = $books->where('books.publishing_house_id', '=', "$request->publishing_house");
        }

        if ($request->get('owner') && $request->get('publishing_house')) {
            //$books = $books->leftJoin('publishing_houses', 'books.publishing_house_id', '=', 'publishing_houses.id');
            $books = $books->where('publishing_houses.owner_id', '=', "$request->owner");
        } elseif ($request->get('owner') && !$request->get('publishing_house')) {
            $books = $books->leftJoin('publishing_houses', 'books.publishing_house_id', '=', 'publishing_houses.id');
            $books = $books->where('publishing_houses.owner_id', '=', "$request->owner");
        }

        if ($request->get('book_author')) {
            $books = $books->leftJoin('authors', 'books.author_id', '=', "authors.id");
            $books = $books->where("authors.first_name", "like", "%$request->book_author%");
            $books = $books->orWhere("authors.second_name", "like", "%$request->book_author%");
        }

        $books = $books->get();
        //dd($books);

        //$books = Book::with('author', 'publishing', 'owners');

       /* if ($request->get('book_name')) {
            $books->where("name", "like", "%$request->book_name%");
        }

        if ($request->get('book_author')) {
            $books->whereHas("author", function (Builder $query) use ($request) {
                $query->where('first_name', 'like', "%$request->book_author%");
                $query->orWhere('second_name', 'like', "%$request->book_author%");
            });
        }

        if ($request->get('publishing_house')) {
            $books->whereHas("publishing", function (Builder $query) use ($request) {
                $query->where('id', '=', "$request->publishing_house");
            });
        }

       if ($request->get('publishing_house')) {
            $books->whereHas("publishing", function (Builder $query) use ($request) {
                $query->whereHas("owner", function (Builder $query) use ($request) {
                $query->where('owners.id', '=', "$request->owner");
            });
            });
        }

        if ($request->get('owner')) {
            $books->whereHas("ownerSelect", function (Builder $query) use ($request) {
                $query->where('owners.id', '=', "$request->owner");
            });
        }
       $books = $books->get();


       */




/*        if ($request->get('owner')) {
            $books = $books->owner->publishing->books;
        }*/
        //dd($books);
/*        if ($request->get('owner')) {
            $ownerSelect = Owner::where('id', '=', "$request->owner")->get();
            //dd($ownerSelect);
           //$books = $books->leftJoin('publishing_houses', 'books.publishing_house_id', '=', 'publishing_houses.id');
           $books = $books->where('owners.id', "=", "$ownerSelect");

        }*/


        //





/*        if ($request->get('owner')) {
            $books->whereHas("owner", function (Builder $query) use ($request) {
                $query->where('id', '=', "$request->owner");
            });
        }*/





        return view('books.search_with_selection', compact('books', 'publishingHouses', 'request' , 'owners'));
    }



}
