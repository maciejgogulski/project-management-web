<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view(
            'users.index',
            [
                'users' => User::with('roles')->get()
            ]
        );
    }

    public function async(Request $request) {
        //$this->authorize('viewAny', User::class);
        return User::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query)
                    => $query->where('name', 'like', "%{$request->search}%")
            )->when(
                $request->exists('selected'),
                fn (Builder $query)
                    => $query->whereIn(
                        'id',
                        $request->input('selected', [])
                    ),
                fn (Builder $query) => $query->limit(5)
            )->get();
    }
}
