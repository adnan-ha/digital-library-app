<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SearchRequest;
use App\Models\Book;
use App\Services\BookService;

class BookController
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $books = $this->bookService->getAll(
            $request->input('search'),
            $request->input('category')
        );

        $books = $books->through(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'image' => $book->image_url,
                'file' => route('books.download', $book->id),
                'downloads' => $book->downloads,
                'rating' => $book->average_rating,
                'category' => $book->category->name,
            ];
        });

        return response()->json(['Books' => $books]);
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $book = $this->bookService->show($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $data = [
            'id' => $book->id,
            'title' => $book->title,
            'description' => $book->description,
            'image' => $book->image_url,
            'file' => route('books.download', $id),
            'downloads' => $book->downloads,
            'rating' => $book->average_rating,
            'category' => $book->category->name,
        ];

        return response()->json(['Book' => $data]);
    }

    public function download(Book $book)
    {
        $filePath = $this->bookService->download($book);

        return response()->download($filePath, "{$book->title}.pdf");
    }
}
