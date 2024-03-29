<?php

namespace App\Http\Controllers;

use App\Author;
use App\Books;
use App\Categories;
use App\Comments;
use App\Regulamin;
use App\Roles;
use App\Upvote;
use App\User;
use App\DownVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class MainController extends Controller
{


    public function index() {
        $books = Books::paginate(6);
        return view('books.welcome', compact('books'));
    }

    public function regulamin()
    {
        $regulamin = Regulamin::take(1)->get();
        return view('books.regulamin.regulamin', compact('regulamin'));
    }

    public function regulamin_edit(Regulamin $regulamin) {
        $content = DB::table('regulamins')->where('id', $regulamin->id)->take(1)->get();

        return view('books.regulamin.edit_regulamin', compact('content'));
    }

    public function authors() {
        $authors = DB::table('authors')->orderBy('name','asc')->paginate(10);

        return view('books.authors_all', compact('authors'));
    }

    public function authors_find(Request $request) {
        $query = $request->get('query');
        $wynik = DB::table('authors')->where('name', 'like', '%' . $query . '%')->get();
        return view('books.authors_find', compact('query', 'wynik'));
    }

    public function cats() {
        $cats = DB::table('categories')->orderBy('name','asc')->paginate(10);

        return view('books.categories_all', compact('cats'));
    }

    public function cats_find(Request $request) {
        $query = $request->get('query');
        $wynik = DB::table('categories')->where('name', 'like', '%' . $query . '%')->get();
        return view('books.cats_find', compact('query', 'wynik'));
    }

    public function single(Books $book) {
        $upvote = DB::table('upvotes')->where('books_id', $book->id)->get();
        $downvote = DB::table('down_votes')->where('books_id', $book->id)->get();
        $comments = Comments::where('books_id', '=', $book->id)->orderBy('id', 'desc')->paginate(5);
        $roles = Roles::all();
        $l_uvotes = 0;
        foreach ($upvote as $vote) {
            $l_uvotes += $vote->vote;
        }
        $l_dvotes = 0;
        foreach ($downvote as $vote) {
            $l_dvotes += $vote->vote;
        }
       
        $u_votes = 0;
        $d_votes = 0;
        $ok_up = false;
        $ok_d = false;
        if (!Auth::guest()) {
            foreach ($upvote as $vote) {
                $u_votes += $vote->vote;
                $users = $vote->users_id;
                $u_id = $vote->id;
                if ($users === Auth::user()->id) {
                    $ok_up = true;
                } else {
                    $ok_up = false;
                }
            }
            foreach ($downvote as $vote) {
                $d_votes += $vote->vote;
                $users = $vote->users_id;
                $d_id = $vote->id;
                if ($users === Auth::user()->id) {
                    $ok_d = true;
                } else {
                    $ok_d = false;
                }
            }

        }
        return view('books.book', compact('book', 'roles','comments','u_votes', 'ok_up', 'ok_d', 'd_votes', 'l_uvotes', 'l_dvotes'));
    }

    public function category($category) {
        $books = Books::where('categories_id', $category)->get();
        $cat = DB::table('categories')->where('id', $category)->get();
        return view('books.categories', compact('books', 'cat'));
    }

    public function sauthor($author) {
        $books = Books::where('author_id', $author)->get();
        $cat = DB::table('authors')->where('id', $author)->get();
        return view('books.author', compact('books', 'cat'));
    }

    public function panel() {
        $glosy = 0;
        $up = Upvote::all();
        $down = DownVote::all();
        $books = Books::all();
        $categories = Categories::paginate(10);
        $author = Author::paginate(10);
        $comments = Comments::paginate(10);
        return view('books.panel', compact('books', 'categories', 'author', 'comments','up','down', 'glosy'));
    }

    public function all_books() {
        return view('books.panel_all');
    }

    public function destroy_comment(Comments $comment)
    {
        $comment->delete();
        return redirect()->route('books.panel_admina');
    }

    public function panel_books() {
        $books = Books::paginate(10);   
        return view('books.panel_books', compact('books'));
    }

}
