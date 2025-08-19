<?php
//BUG:  lllllllll
//HACK: lllllllll
//INFO: lllllllll
//TODO: 111111111
//IDEA: 111111111
//FIXME:111111111

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login function in api
    public function login(LoginRequest $request)
    {
//FIXME:: make validation 2- check email and password
    // dd('sanctum');
        try{
        // $user = User::where('email', $request->email)->first(); //depended on hash >>>
    // dd($user);
//FIXME:: here i check if the password in request === password in database of this user if not equil will return error
        // if (!$user || !Hash::check($request->password, $user->password)) { //>>>
//FIXME:: idea of attemp make check on password and email >>>>>>>>>>>> if true
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return ApiResponse::error('credentials error',[],401);
        }
//FIXME:: if use attempt to get the data of this user after check
        $user = Auth::user();
//FIXME:: to get the token of user login
        $token = $user->createToken("api-token")->plainTextToken; //HasApiTokens

//FIXME:: each login have roles like student or teacher or user or admin
    // $roles = $user->getRoleNames(); // to get roles
    // $permissions = $user->getAllPermissions()->pluck('name'); // to get permission for this user

//FIXME:: i will send token , id , name , role like student or teacher
    return ApiResponse::success(['token' => $token,
                            // 'user' => $user,
                            'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'role' => $user->getRoleNames()->first()],
                            // 'roles' => $roles, 'permissions' => $permissions
                    ],'login successfuly');
        } catch (\Throwable $th) {
            Log::channel("user")->error($th->getMessage() .  $th->getFile() . $th->getLine());
            return ApiResponse::error("login failed  ", [], 500);
        }
    }
 // ************************ logout api *****************************
    public function logout(Request $request){
        try{
        // dd($request->user);
        $request->user()->tokens()->delete();                 //FIXME::delete from all browser
        // $request->user()->currentAccessToken()->delete();  //FIXME:: delete form one browser
        return ApiResponse::success([],"logged out successfully " );
        } catch (\Throwable $th) {
            Log::channel("user")->error($th->getMessage() .  $th->getFile() . $th->getLine());
        return ApiResponse::error("login failed  ", [], 500);
        }
    }

//     public function updata_profile(Request $request){
//         $user =Auth::user();
//         if(!$user){
//             return ApiResponse::error("user not found");
//         }
//         $request->validate([
//             "name"=> "required|string|max:255",
//             "email"=> "required|email|max:255",
//             "role"=> "nullable|in:admin,user,student,teacher",
//             "password"=> "nullable|string|max:6",
//             "current_password"=> "required_with:password",
//         ]);
//         // dd("welcome");
//         if($request->password){
//         if ( !Hash::check($request->current_password, $user->password)) {
//             return ApiResponse::error('current password is wrong');
//         }
//         }
//         $data = [];
//         if($request->filled('name')){
//             $data['name']=$request->name;
//         }
//         if($request->filled('email')){
//             $data['email']=$request->email;;
//         }
//         if($request->filled('role')){
//             $data['role']=$request->role;
//         }
//         if($request->filled('password')){
//             $data['password']=Hash::make($request->password);
//         }
//         if(!empty($data)){
//             $user->update($data);
//         }
//             return ApiResponse::success(['user'=>$user]);
// }








    // public function login(LoginRequest $request)
    // {
    //     // check login if true of not
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return ApiResponse::error('credentials error',[], 401);
    //     }
    //     $user = Auth::user();
    //     // to don't allow any role like admin teacher or stuedent like user
    //     if (!$user->hasAnyRole(['admin', 'teacher', 'student'])) {
    //         return ApiResponse::error('do not have access to login man', null, 403);
    //     }
    //     // create token
    //     $token = $user->createToken('auth_token')->plainTextToken;
    //     return ApiResponse::success([
    //         'user'  => $user,
    //         'token' => $token
    //     ], 'login successfully ');
    // }





















    /**
     * Display a listing of the resource.
     */

    // public function register(){

    // }

}
