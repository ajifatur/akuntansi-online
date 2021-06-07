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
			// Data neraca
			$neraca = DB::select('SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC');
			
			return view('admin.balancesheet.standard', [
				'tanggal' => $tanggal,
				'user' => $user,
				'neraca' => $neraca,
			]);
		}
    }

    /**
     * Menampilkan data neraca standard
     * 
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function standardData(Request $request)
    {
		$html = '';
		$tanggal = $request->query('tanggal') != null ? generate_date_format($request->query('tanggal'), 'y-m-d') : date('Y-m-d'); // Tanggal
		$kantor = $request->query('kantor');
		$grup = $request->query('grup');
		$dtotal = 0; // Total detail
		$subtotal = 0; // Total harta, kewajiban, modal
		$pasiva = 0; // Total pasiva
		$sysakun = "('3000','3001','5000')";

		// Data neraca
		$neraca = DB::select("SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC");

		// Loop neraca
		if(count($neraca)>0){
			foreach($neraca as $data){
				if($data->seq == 30) $pasiva = 0;
				if($data->linetype == 'ListDetail'){
					// Data akun
					$akun = DB::select("SELECT a.*, (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$kantor} AND transdate<='{$tanggal}') AS saldo, (SELECT COUNT(*) FROM ac_akun WHERE parentaccount=a.kodeakun) AS parent FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$kantor}$|\\\.{$kantor}\\\.|\\\.{$kantor}$') OR (kode IN {$sysakun})) AND a.groupid={$grup} AND subaccount=0 ORDER BY a.kodeakun");

					// Loop akun
					if(count($akun)>0){
						foreach($akun as $data2){
							$balance = abs($data2->saldo);
							if($data2->kodeakun == get_retained_earning($tanggal, $kantor, $grup)['akun']) $balance = get_retained_earning($tanggal, $kantor, $grup)['balance']; // Laba ditahan
							$dtotal += $balance; // Total detail
							$subtotal += $balance; // Total parent
							$pasiva += $balance; // Total pasiva
							$sbalance = $balance >= 0 ? number_format($balance,0,',',',') : '('.number_format(abs($balance),0,',',',').')'; // String balance
							$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String  total detail
							$parent = false; // Parent

							if($data2->parent > 0){
								$parentamount = $balance;
								$parent = true;
								$html .= '<tr>';
								$html .= '<td style="text-indent: 2rem;">'.$data2->namaakun.'</td>';
								$html .= '<td></td>';
								$html .= '<td></td>';
								$html .= '</tr>';
							}
						}
					}
				}
			}
		}

		echo $html;
    }
}
