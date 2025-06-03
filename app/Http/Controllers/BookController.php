<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Services\BookService;
use App\Services\CategoryService;

class BookController
{
    protected CategoryService $categoryService;
    protected BookService $bookService;

    public function __construct(CategoryService $categoryService, BookService $bookService)
    {
        $this->categoryService = $categoryService;
        $this->bookService = $bookService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $books = $this->bookService->getAll($search, $categoryId);
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $this->bookService->create($request->validated());

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('dashboard.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = $this->categoryService->getAll();

        return view('dashboard.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->bookService->update($book, $request->validated());

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->bookService->delete($book);

        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
