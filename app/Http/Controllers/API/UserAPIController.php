<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAddressAPIRequest;
use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Response;
use JWTAuth;


/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     * GET|HEAD /users
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * Store a newly created User in storage.
     * POST /users
     *
     * @param CreateUserAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * Display the specified User.
     * GET|HEAD /users/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse(new UserResource($user), 'User retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     * PUT/PATCH /users/{id}
     *
     * @param int $id
     * @param UpdateUserAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * Remove the specified User from storage.
     * DELETE /users/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendSuccess('User deleted successfully');
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
           'email' => 'required',
           'password' => 'required'
            ]);

        if($validator->fails())
        {
            return $this->sendError($validator->errors());
        }
        $credentials = $request->only('email', 'password');

        try
        {
            if (! $token = JWTAuth::attempt($credentials))
            {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        }
        catch (JWTException $e)
        {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = User::where('email',$request->email)->first();
        $data = [$user,['token'=>$token]];
        return $this->sendResponse($data, 'User crossed successfully');

    } // End of login


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $request->seller ? $seller = 'seller' : $seller = 'user';
        $user = \App\User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $seller
        ]);

        $token = JWTAuth::fromUser($user);
        $data = ['user_data'=>$user,'token'=>$token];
        return $this->sendResponse($data, 'User crossed successfully');

    } // End of register


    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
        ]);

        if($validator->fails())
        {
            return $this->sendError($validator->errors());
        }

        $user = User::where('email','=',$request->email)->first();

        if($user)
        {
            $random = rand(1000,9999); // random code also send it to mail
            $user->update(['verified_code'=> $random]);

            /* send code to email*/
//            $to_name = 'Ahmed';
//            $to_email = 'a9a19bc1b1-df74a6@inbox.mailtrap.io';
//            $data = array($random);
//            Mail::send( 'vendor.mail.html.test',$data, function($message) use ($to_name, $to_email) {
//            $message->to($to_email, $to_name)->subject('test');
//                $message->from('FROM_EMAIL_ADDRESS','Artisans Web');
//             });

            /* / send code to email*/

            return $this->sendResponse($random,'success');
        } else{
            return $this->sendError('User not found');

        }

    } // End of forget password

    public function verifyCode(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'email' => 'required|email',
            'code' => 'required|min:4'
        ]);

        if($valid->fails())
        {
            return $this->sendError($valid->errors());
        }

        $user = User::where('email',$request->email)->first();

        if(!$user)
        {
            return $this->sendError('Email not match anything!');
        }

        if($user->verified_code == $request->code)
        {
            return $this->sendSuccess('Success');

        }else{
            return $this->sendError('Code not match anything!');
        }

    } // End of verifyCode


    public function setPassword(Request $request)
    {

        $valid = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        if($valid->fails())
        {
            return $this->sendError($valid->errors());
        }

        $user = User::where('email',$request->email)->first();
        if(!$user)
        {
            return $this->sendError('Email not match anything!');
        }

        $user->update(['password'=>bcrypt($request->password)]);

        return $this->sendSuccess('user Updated Success');
    } // End of set password


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
        }

        $user = JWTAuth::parseToken()->authenticate();

        if(!$user)
        {
            return $this->sendError('something wrong!');
        }
        $update = $user->update(['password' => bcrypt($request->password)]);

        if(!$update)
        {
            return $this->sendError('something wrong!');
        }

        return $this->sendResponse($update,'password updated successfully');

    } // End of update password


}
