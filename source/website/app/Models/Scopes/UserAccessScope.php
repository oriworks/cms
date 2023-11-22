<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserAccessScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (!Auth::hasUser()) {
            return;
        }

        /** @var User $user */
        $user = Auth::user();
        $resource = $model->getTable();
        if (!$user->hasPermissionTo($resource . '.viewAny')) {
            $builder->where('id', $user->id);
        }
    }
}
