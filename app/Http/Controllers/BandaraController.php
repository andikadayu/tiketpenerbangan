<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bandara;
use DB;

class BandaraController extends Controller
{
    function index()
    {
    	return view('bandara.index',['bandara'=>Bandara::paginate(5)]);
    }

    function save_bandara(Request $request)
    {
    	if (!isAdmin()) {
    		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Access Denied'
            ));
    	}

    	$bandara = new Bandara();
    	$bandara->id_bandara = strtoupper($request->input('id_bandara'));
    	$bandara->nama_bandara = ucfirst($request->input('nama_bandara'));
       	$bandara->lokasi_bandara= ucfirst($request->input('lokasi_bandara'));

       	$insert = $bandara->save();

       	if ($insert) {
       		echo json_encode(array(
                'RESULT' => 'OK',
                'MESSAGE' => 'Success Insert'
            ));
       	} else {
       		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Invalid'
            ));
       	}

    }

    function get_bandara(Request $request)
    {
    	return Bandara::find($request->get('id'));
    }

    function update_bandara(Request $request)
    {
    	if (!isAdmin()) {
    		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Access Denied'
            ));
    	}

    	$checkBandara = Bandara::find($request->input('id_bandara'));

    	$checkBandara->nama_bandara = ucfirst($request->input('nama_bandara'));
    	$checkBandara->lokasi_bandara = ucfirst($request->input('lokasi_bandara'));
    	$update = $checkBandara->save();

    	if ($update) {
       		echo json_encode(array(
                'RESULT' => 'OK',
                'MESSAGE' => 'Success Update'
            ));
       	} else {
       		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Invalid'
            ));
       	}
    }

    function delete_bandara(Request $request)
    {
    	if (!isAdmin()) {
    		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Access Denied'
            ));
    	}

    	

    	$delete = DB::table('bandara')->where('id_bandara',$request->get('id'))->delete();

    	if ($delete < 0) {
       		echo json_encode(array(
                'RESULT' => 'FAILED',
                'MESSAGE' => 'Invalid'
            ));
       	} else {
            echo json_encode(array(
                'RESULT' => 'OK',
                'MESSAGE' => 'Success Delete'
            ));
       	}

    }
}
