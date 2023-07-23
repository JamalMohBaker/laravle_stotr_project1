<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/users/create',[
            'user' => new User(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {



        $data = $request->validated();
        $data['password'] = Hash::make( $data['password']);
        $user = User::create($data);
        return redirect()
            ->route('users.index')
            ->with('success',"User ({$user->name}) created!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $typesOptions = User::typesOptions();
        $status_options = User::statusOptions();

        return view('admin.users.edit' , [
            'user' => $user,
            'typesOptions' => $typesOptions,
            'status_options' => $status_options,

        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        // $data = $request->except(['password', 'editpassword']);
        // $data = $request->except('password');
        $user->update($data);
        return redirect()->route('users.index')
       ->with('success',"User ({$user->name}) Updated!");
    }


    public function editpass(User $user){
        return view('admin.users.edit_pass',[
            'user' => $user,
        ]);
    }

    public function updatepass(Request $request, User $user){
        // $data['password'] = Hash::make( $data['password']);
        $user->password =  Hash::make($request->input('editpassword'));

        // $data = $request->validate([
        //     'editpassword' => 'required|min:8',
        // ]);
        $user->save();
        return redirect()->route('users.index')
       ->with('success',"user ({$user->name}) Updated!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
        ->with('success',"Product ({$user->name}) deleted!");
    }

    public function trashed(){
        $users = User::onlyTrashed()->paginate(8);
        return view('admin.users.trashed',[
            'users' => $users ,
        ]);
    }
    public function restore($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()
               ->route('users.index')
               ->with('success' , "Producted ({$user->name}) restored");

    }
    public function forceDelete( $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()
                ->route('users.index')
               ->with('success' , "Producted ({$user->name}) deleted forever! ");
    }
}
