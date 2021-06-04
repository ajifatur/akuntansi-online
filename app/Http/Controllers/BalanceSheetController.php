<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kas;

class BalanceSheetController extends Controller
{	
    /**
     * Menampilkan neraca standard
     * 
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function standard(Request $request)
    {
		// Tanggal
		$tanggal = $request->query('tanggal') != null ? generate_date_format($request->query('tanggal'), 'y-m-d') : date('Y-m-d');
		
		// Data user
		// 13: CDM
		// 1673: PT. Uji Coba
		$user = DB::table('tbl_users')->where('id','=',1673)->first();
		
		if($user){
			$neraca = DB::select('SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC');
			
			// get_retained_earning($tanggal, $user->idkantor, $user->groupid);
			// get_earning($tanggal, $user->idkantor, $user->groupid);
			
			return view('admin.balancesheet.standard', [
				'tanggal' => $tanggal,
				'user' => $user,
				'neraca' => $neraca,
			]);
		}
    }
}
