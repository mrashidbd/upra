<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function datatable(Request $request): array
    {
        $search = $request->filled('search') ? $request->search : null;
        $sortField = $request->filled('field') ? $request->field : 'id';
        $sortDirection = $request->filled('direction') ? $request->direction : 'desc';

        $users = User::query()
            ->select([
                'users.id',
                'users.name as user_name',
                'users.email',
                'users.email_verified_at',
                'users.created_at',
                'users.is_banned as ban_status',
                // Add more user table columns here
            ])
            ->with(['personalInformation', 'shareInformation']) // Eager loading relationships
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            })
            ->when($sortField && $sortDirection, function ($query) use ($sortField, $sortDirection) {
                $query->orderBy($sortField, $sortDirection);
            })
            ->paginate(20)
            ->withQueryString();

        return [
            'users' => $users,
            'filters' => [
                'search' => $search,
                'field' => $sortField,
                'direction' => $sortDirection,
            ],
        ];
    }
}
