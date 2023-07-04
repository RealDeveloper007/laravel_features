<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Events\ErrorHistory;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->listAll();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        //
        try {

            $User = new User();
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);

            $SaveUser = $User->save();

            if ($SaveUser) {

                session()->flash('success', 'New User has been Added successfully.');
                return redirect()->route('users.index');
            } else {

                // Error History Maintained

                $Data = ['error' => 'User Data is not saved.', 'table' => 'users'];
                event(new ErrorHistory($Data));

                session()->flash('error', 'User Data is not saved.');
                return redirect()->route('users.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            $Data = ['error' => $exception->errorInfo[2], 'table' => 'users'];
            event(new ErrorHistory($Data));

            session()->flash('error', $exception->errorInfo[2]);
            return redirect()->route('users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try {
            $User = User::where('id', $id)->firstOrFail();

            return view('users.show')->with(['user' => $User]);
        } catch (\Illuminate\Database\QueryException $exception) {

            session()->flash('error', $exception->errorInfo[2]);
            return redirect()->route('users.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $User = User::where('id', $id)->firstOrFail();

            return view('users.update')->with(['user' => $User]);
        } catch (\Illuminate\Database\QueryException $exception) {

            session()->flash('error', $exception->errorInfo[2]);
            return redirect()->route('users.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $id)
    {
        try {

            $User = User::find($id);
            $User->name = $request->name;
            $User->email = $request->email;

            if (isset($request->password) && $request->password != '') {
                $User->password = Hash::make($request->password);
            }

            $SaveUser = $User->save();

            if ($SaveUser) {

                session()->flash('success', 'User details has been Updated successfully.');
                return redirect()->route('users.index');
            } else {
                session()->flash('error', 'User Data is not updated.');
                return redirect()->route('users.index');
            }
        } catch (\Illuminate\Database\QueryException $exception) {

            print_r($exception->errorInfo[2]);
            die;

            // return back()->withError($exception->errorInfo)->withInput();
            session()->flash('error', $exception->errorInfo[2]);
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {

            $user = User::where('id', $id)->firstorfail()->delete();
            session()->flash('success', 'User Record deleted successfully.');
            return redirect()->route('users.index');
        } catch (\Illuminate\Database\QueryException $exception) {

            session()->flash('error', $exception->errorInfo[2]);
            return redirect()->route('users.index');
        }
    }
}
