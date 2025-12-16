<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    // Get all users
    public function all()
    {
        return User::all();
    }

    // Find a user by ID
    public function find(int $id): ?User
    {
        return User::find($id);
    }

    // Create a new user
    public function create(array $data): User
    {
        return User::create($data);
    }

    // Update an existing user
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    // Delete a user
    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

}
