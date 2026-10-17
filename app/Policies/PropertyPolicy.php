<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Qualquer usuário logado pode ver seus próprios imóveis
    }

    public function view(User $user, Property $property): bool
    {
        return $user->id === $property->user_id;
    }

    public function create(User $user): bool
    {
        return true; // Qualquer usuário logado pode criar (mas com limite)
    }

    public function update(User $user, Property $property): bool
    {
        return $user->id === $property->user_id;
    }

    public function delete(User $user, Property $property): bool
    {
        return $user->id === $property->user_id;
    }

    public function restore(User $user, Property $property): bool
    {
        return $user->id === $property->user_id;
    }

    public function forceDelete(User $user, Property $property): bool
    {
        return $user->id === $property->user_id;
    }
}