<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', '');

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('apaterno', 'like', "%$q%")
                      ->orWhere('amaterno', 'like', "%$q%")
                      ->orWhere('matricula', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%");
            })
            ->orderBy('name')
            ->paginate(12)
            ->appends($request->query());

        return view('perfiles.index', compact('users', 'q'));
    }

    public function show(User $user)
    {
        return view('perfiles.show', compact('user'));
    }
}
