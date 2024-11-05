<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select('users.*', 'departments.name as department', 'users_status.name as status')
            ->get();

        return response()->json($users);
    }

    public function create()
    {
        $users_status = DB::table("users_status")
        ->select(
            "id as value",
            "name as label"
        )
        ->get();
        $departments = DB::table("departments")
        ->select(
            "id as value",
            "name as label"
        )
        ->get();
        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "status_id" => "required",
                "username" => "required | unique:users,username",
                "name" => "required",
                "email" => "required | email",
                "department_id" => "required",
                "password" => "required | confirmed"
            ],
            [
                "status_id.required" => "Chưa Chọn Tình Trạng",

                "username.required" => "Chưa Điền Tài Khoản",
                "username.unique" => "Tài khoản Đã Tồn Tại",

                "name.required" => "Chưa Điền Tên",

                "email.required" => "Chưa Điền Email",
                "email.email" => "Email Không Hợp Lệ",

                "department_id.required" => "Chưa Chọn Phòng Ban",

                "password.required" => "Chưa Điền Mật Khẩu",
                "password.confirmed" => "Mật Khẩu Không Khớp"
            ]
        );

        //Eloquent ORM: tương tác với model
        // User::create([
        //     "status_id" => $request["status_id"],
        //     "username" => $request["username"],
        //     "name" => $request["name"],
        //     "email" => $request["email"],
        //     "department_id" => $request["department_id"],
        //     "password" => \Hash::make($request["password"])
        // ]);

        $user = $request -> except(["password", "password_confirmation"]);
        $user["password"] = \Hash::make($request["password"]);
        User::create($user);

        //Query Builder: tương tác thẳng vào bảng
        // DB::table('users')->insert([
        //     'name' => 'Hanoi'
        // ]);
    }

    public function edit($id)
    {

        $users = User::find($id);
        $users_status = DB::table("users_status")
        ->select(
            "id as value",
            "name as label"
        )
        ->get();
        $departments = DB::table("departments")
        ->select(
            "id as value",
            "name as label"
        )
        ->get();
        return response()->json([
            "users" => $users,
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(
            [
                "status_id" => "required",
                "username" => "required | unique:users,username,".$id,
                "name" => "required",
                "email" => "required | email",
                "department_id" => "required",
            ],
            [
                "status_id.required" => "Chưa Chọn Tình Trạng",

                "username.required" => "Chưa Điền Tài Khoản",
                "username.unique" => "Tài khoản Đã Tồn Tại",

                "name.required" => "Chưa Điền Tên",

                "email.required" => "Chưa Điền Email",
                "email.email" => "Email Không Hợp Lệ",

                "department_id.required" => "Chưa Chọn Phòng Ban",
            ]
        );
        if($request["change_password"] == true)
        {
            $validated = $request->validate(
                [
                    "password" => "required | confirmed"
                ],
                [
                    "password.required" => "Chưa Điền Mật Khẩu",
                    "password.confirmed" => "Mật Khẩu Không Khớp"
                ]
            );
        }
    }
}
