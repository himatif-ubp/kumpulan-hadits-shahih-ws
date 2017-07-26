<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersModel;
use Carbon\Carbon;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;

class UsersCT extends Controller
{
	public function store(Request $request)
	{
		$model = new UsersModel();
		$model->imei = $request->imei;
		$model->token = $request->token;
		$model->android_version = $request->android_version;
		$model->app_version = $request->app_version;
		$model->save();
		return $model;
	}

	public function updateToken(Request $request){
		$model = UsersModel::findOrFail($request->id);
		if($model != null){
			$model->token = $request->token;
			$model->save();
		}
		return $model;
	}

	public function lastSeen(Request $request){

		$model = UsersModel::findOrFail($request->id);
		if($model != null){
			$model->last_activity_at = Carbon::now()->toDateTimeString();
			$model->save();
		}
		return $model;
	}

	public function edit($id)
	{
		$model = UsersModel::findOrFail($id);
		return view('imam.edit', compact('model'));
	}

	public function update(Request $request, $id){
    	// $product = ProductModel::findOrFail($id);
		$model = UsersModel::findOrFail($id);
		$model->nama_imam = $request->nama;
		$model->save();
		return redirect()->route('imam.index')->with('alert-success', 'Data Berhasil Disimpan.');
	}

	public function delete($id)
	{
		$data = UsersModel::findOrFail($id);
		return view('imam.delete', compact('data'));
	}

	public function destroy($id)
	{
		$toko = UsersModel::findOrFail($id);
		$toko->delete();
		return redirect()->route('imam.index')->with('alert-success', 'Data Berhasil Hapus.');
	}

	public function all(){
		$data = new ImamModel();
		$data = $data->all();
		return $data;
	}

}
