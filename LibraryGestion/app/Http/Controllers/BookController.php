<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['categories', 'authors'])->get();

        return view('librarygestion.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $count=Category::count();
        return view('librarygestion.book.create',compact('categories','count'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();

        $authors=explode(',',$request->authors);

        $auteursManquants=[];
        foreach($authors as $auth){
            $nomComplet=trim($auth);

            if($nomComplet=== "") continue;
            $parts=explode(' ',$nomComplet);
            $firstName=array_shift($parts);
            $lastName=implode(' ',$parts);

            $existe = Author::where('first_name', $firstName)
                        ->where('last_name', $lastName)
                        ->first();

            if(!$existe){
                $auteursManquants[] = [
                'first_name' => $firstName,
                'last_name'  => $lastName,
            ];
            }
        }

            if (!empty($auteursManquants)) {
                session([
                    'book' => $request->all(),
                    'missing_authors' => $auteursManquants
                ]);

                return redirect()->route('author.create-missing');
            }

            return $this->createBookWithAuthors($request);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book=Book::with(['categories', 'authors'])->findOrFail($id);

        return view('librarygestion.book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book=Book::with(['categories','authors'])->findOrFail($id);
        $categories=Category::all();

        return view('librarygestion.book.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);
        return redirect()->route('book.index');
    }

    public function storeMissing(Request $request){
        $data = $request->validate([
        'authors'                       => ['required', 'array', 'min:1'],
        'authors.*.first_name'          => ['required', 'string', 'max:255'],
        'authors.*.last_name'           => ['required', 'string', 'max:255'],
        'authors.*.bio'                 => ['required', 'string'],
        'authors.*.birth_date'          => ['required', 'date'],
        'authors.*.death_date'          => ['required', 'date', 'after:authors.*.birth_date'],
        'authors.*.nationalite'         => ['required', 'string', 'max:255'],
        'authors.*.photo_path'          => ['required', 'string', 'max:255'],
    ]);

    foreach($data['authors'] as $authorData){
        
    Author::firstOrCreate(
            [
                'first_name' => $authorData['first_name'],
                'last_name'  => $authorData['last_name'],
            ],
            [
                'bio'         => $authorData['bio'] ,
                'birth_date'  => $authorData['birth_date'] ,
                'death_date'  => $authorData['death_date'] ,
                'nationalite' => $authorData['nationalite'] ,
                'photo_path'  => $authorData['photo_path'] ,
            ]
        );



    }
    $book=session('book');
    session()->forget(['book','missing_authors']);
    $request->merge($book);

    return $this->createBookWithAuthors($request);

    }


    public function createBookWithAuthors(Request $request)
    {
        $book = Book::create($request->except(['authors', 'categories', '_token', '_method']));

        $auteursId = [];
        foreach (explode(',', $request->authors) as $a) {
            $nomComplet = trim($a);
            if ($nomComplet === '') continue;

            $parts     = explode(' ', $nomComplet);
            $firstName = array_shift($parts);
            $lastName  = implode(' ', $parts);

            $auteur = Author::firstOrCreate([
                'first_name' => $firstName,
                'last_name'  => $lastName,
            ]);

            $auteursId[] = $auteur->id;
        }

        $book->authors()->sync($auteursId);
        $book->categories()->sync($request->categories ?? []);

        return redirect()->route('book.index');
    }

    public function search(Request $request){

        $books = Book::with('authors')
        ->with('categories')
        ->where('titre', 'like', "%{$request->search}%")
        ->orWhereHas('authors', function($query) use ($request) {
            $query->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%");
        })
        ->orWhereHas('categories', function($query) use ($request){
            $query->where('name', 'like', "%{$request->search}%");
        })
        ->get();
        return view('librarygestion.book.index',compact('books'));
    }

    public function borrow($id)
    {
        $books=Book::with('categories')->with('authors');
        $book=$books->findOrFail($id);

        session(['book'=>$book]);
        return redirect()->route('borrow.index');
    }

}
