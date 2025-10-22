<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use RickDBCN\FilamentEmail\Models\Email;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Email');
    }

    public function view(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('View:Email');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Email');
    }

    public function update(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('Update:Email');
    }

    public function delete(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('Delete:Email');
    }

    public function restore(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('Restore:Email');
    }

    public function forceDelete(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('ForceDelete:Email');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Email');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Email');
    }

    public function replicate(AuthUser $authUser, Email $email): bool
    {
        return $authUser->can('Replicate:Email');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Email');
    }

}