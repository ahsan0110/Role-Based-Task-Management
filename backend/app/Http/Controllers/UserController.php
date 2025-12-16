<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    // List all users
    public function index()
    {
        return response()->json($this->users->all());
    }

    // Show a single user
    public function show($id)
    {
        $user = $this->users->find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        return response()->json($user);
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $user = $this->users->find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:8|confirmed',
            'role' => 'sometimes|in:admin,user',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $this->users->update($user, $data);

        return response()->json($user);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = $this->users->find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $this->users->delete($user);

        return response()->json(['message' => 'User deleted successfully']);
    }
}
