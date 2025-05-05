<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\UserResource;
    use App\Models\User;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Validation\Rule;
    use Inertia\Inertia;

    class UserController extends Controller
    {
        public function index(Request $request)
        {
            $users = $request->has('search_filter') ?
                User::withFilter($request->search_filter, $request->search) :
                User::withoutFilter($request->search);

            return Inertia::render('Users/Index', [
                'users' => $users,
                'filters' => request()->only(['search_filter', 'search', 'column', 'order'])
            ]);
        }

        public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required',
                'email' => ['required', 'email', 'unique:users'],
                'password' => 'required',
            ]);

            User::create($validated);

            return redirect('/users');
        }

        public function create()
        {
            return Inertia::render('Users/Create');
        }

        public function show(User $user)
        {
            $user_resource = new UserResource($user);

            return Inertia::render('Users/Show', [ 'user' => $user_resource ]);
        }

        public function edit(User $user)
        {
            $user_resource = new UserResource($user);

            return Inertia::render('Users/Edit', [ 'user' => $user_resource]);
        }

        public function update(Request $request, User $user)
        {
            $validated = $request->validate([
                'name' => 'required',
                'email' => ['required', 'email', Rule::unique('users')->ignore($request->id)],
            ]);

            $user->update($validated);

            return redirect('/users/' . $request->user_id);
        }

        public function destroy(User $user)
        {
            $user->delete();
            return redirect('/users');
        }
    }
