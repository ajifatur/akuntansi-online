<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kas;

class KasController extends Controller
{	
    /**
     * Menampilkan jurnal umum
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Data user
		$user = DB::table('tbl_users')->where('id','=',1673)->first();
		
		if($user){
			// Data kas
			$kas = Kas::where('idkantor','=',$user->idkantor)->get();
			
			return view('admin.kas.index', [
				'kas' => $kas,
				'user' => $user,
			]);
		}
    }
}
