<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view articles', only: ['index']),
            new Middleware('permission:edit articles', only: ['edit']),
            new Middleware('permission:create articles', only: ['create']),
            new Middleware('permission:delete articles', only: ['destroy']),
        ];
    }

  // In your ArticleController
public function index()
{
    // Use paginate() instead of all()
    $articles = Article::paginate(10); // Adjust the number (10) as needed for pagination

    return view('articles.list', ['articles' => $articles]);
}
public function create()
{
    return view('articles.create');
}
  
    public function store(Request $request)
    {

        
        // Validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            // Redirect back with validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Using Eloquent's create method for cleaner code
            Article::create([
                'title' => $request->title,
                'author' => $request->author,
                'content' => $request->content,
            ]);

            // Redirect to the list page with a success message
            return redirect()->route('articles.index')->with('success', 'Article created successfully!');
        }
    }
       public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', ['article' => $article]);
    }   

    public function update(Request $request, $id)   
    {
        $article = Article::findOrFail($id);

        // Validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            // Redirect back with validation errors and old input
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Using Eloquent's update method for cleaner code
            $article->update([
                'title' => $request->title,
                'author' => $request->author,
                'content' => $request->content,
            ]); 

            // Redirect to the list page with a success message 
            return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
        }
    
}
            public function destroy($id)
            {
                $article = Article::findOrFail($id);
                $article->delete();
                return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
            }

}