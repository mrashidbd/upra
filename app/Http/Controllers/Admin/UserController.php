<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request): Response
    {

        $users = $this->userService->datatable($request);

        //        return response()->json($data);
        return Inertia::render('Admin/Users/Index', $users);

    }

    //    public function index(): Response
    //    {
    //        $users = User::query()
    //            ->select('users.id as user_id', 'users.name as user_name', 'email', 'email_verified_at', 'users.is_banned as ban_status', 'users.created_at', 'pi.date_of_birth as dob',
    //                'pi.phone_number as phone', 'pi.contact_address as address', 'pi.country_of_residence as residence',
    //                'pi.citizenship_country as citizenship', 'pi.identity_document_path as identity_file_url',
    //                'pi.phone_verified_at as phone_v_date')
    //            ->join('personal_information as pi', 'users.id', '=', 'pi.user_id')->paginate(20);
    //
    //        // Format the created_at date using Carbon
    //        $users->getCollection()->transform(function ($user) {
    //            $user->created_at_humanized = Carbon::parse($user->created_at)->diffForHumans();
    //
    //            return $user;
    //        });
    //
    //        // Pass the modified collection to the paginator
    //        $users->setCollection($users->getCollection());
    //
    //        return Inertia::render('Admin/Users/Index', ['users' => $users]);
    //    }

    //    public function show(User $user): Response
    //    {
    //        return Inertia::render('Admin/Users/Show', ['user' => $user->load('personalInformation', 'shareInformation')]);
    //    }
}
