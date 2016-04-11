<?php namespace course\Http\Controllers\Admin;

use course\Http\Requests;
use course\Http\Controllers\Controller;
use course\User;
use Illuminate\Http\Request; 

class UserController extends Controller {

	public function __construct () {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		
		$usuarios=User::name($request->get('name'))->paginate(10);
		return view('admin.index',compact('usuarios'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$reglas=array('name'=>'required',
					  'email'=>'required|unique:users',
					  'type'=>'required|in:user,admin');
		$this->validate($request,$reglas);
		$nuevo= new User($request->all());
		$nuevo->password = bcrypt($request->get('password'));
		$nuevo->save();
		return \Redirect::route('Admin.user.index');
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user=User::FindOrFail($id);
		return view('admin.edit',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$user=User::FindOrFail($id);
		$reglas=array('name'=>'required',
					  'email'=>"required|unique:users,email,".$id,
					  'type'=>'required|in:user,admin');
		$this->validate($request,$reglas);
		
		$user->fill(\Request::all());
		$user->password = bcrypt($request->get('password'));
		$user->save();
		return \Redirect::route('Admin.user.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user=User::FindOrFail($id);
		$user->delete();
		\Session::Flash('message','El Usuario: '.$user->name.' fue Eliminado');
		return redirect()->route('Admin.user.index');
	}

}
