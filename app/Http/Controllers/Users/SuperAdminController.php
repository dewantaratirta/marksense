<?php

namespace App\Http\Controllers\Users;

use App\DataTables\SuperadminDatatables;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use App\Rules\UsernameRules;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SuperAdminController extends Controller
{
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository,)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(SuperadminDatatables $datatable)
    {
        // return view('users.superadmin.index');
        return $datatable->render('users.superadmin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.superadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => [
                'required',
                'min:3',
                'max:20',
                new UsernameRules(),
                'unique:users,username'
            ],
            'avatar' => 'mimes:png,jpg,jpeg|max:2048',
        ];
        $rules['password'] = 'min:8|confirmed';
        $rules['password_confirmation'] = 'min:8|required';
        $validated = $request->validate($rules);
        $validated['role'] = \Spatie\Permission\Models\Role::where('name','superadmin')->first()->id;

        $result = $this->userRepository->create($validated);
        if (!$result) redirect()->back()->with('error', 'Something went wrong!');
        return redirect()->route('user_management.superadmin.index')->with('success', 'User has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $superadmin)
    {
        $superadmin->load('roles');
        $user = &$superadmin;
        $roles = generateSelectOptions(Role::all(), 'id', 'name');
        return view('users.superadmin.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $superadmin)
    {
        $user = &$superadmin;
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => [
                'required',
                'min:3',
                'max:20',
                new UsernameRules(),
                'unique:users,username,' . $user->id
            ],
            'role' => 'integer|exists:roles,id',
            'avatar' => 'mimes:png,jpg,jpeg,webp|max:2048',
        ];

        if ($request->password || $request->password_confirmation) {
            $rules['password'] = 'min:8|confirmed';
            $rules['password_confirmation'] = 'min:8|required';
        }

        $validated = $request->validate($rules);

        // dd($request->all());

        $result = $this->userRepository->update($user->id, $validated);
        if (!$result) redirect()->back()->with('error', 'Something went wrong!');
        return redirect()->route('user_management.superadmin.index')->with('success', 'User has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $superadmin)
    {
        $this->userRepository->delete($superadmin->id);
        return response()->json('ok');
    }
}
