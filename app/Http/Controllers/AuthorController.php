<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $users = Author::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray()
            ],
            200
        );
    }
    public function show(Request $request, $id)
    {
        $user = Author::find($id);
        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ],
            200
        );
    }
}
