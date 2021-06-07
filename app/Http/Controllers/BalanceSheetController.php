<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kas;
use App\Kantor;

class BalanceSheetController extends Controller
{
	// 13: CDM
	// 1673: PT. Uji Coba

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
		$user = DB::table('tbl_users')->where('id','=',1673)->first();

		if($user){
			// Data kantor
			$kantor = Kantor::where('groupid','=',$user->groupid)->get();

			// View
			return view('admin.balancesheet.standard', [
				'tanggal' => $tanggal,
				'user' => $user,
				'kantor' => $kantor,
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
    	ini_set('max_execution_time', 300);
		ini_set('memory_limit','1000M');

		// Variabel
		$grup = $request->query('grup');
		$tanggal = $request->query('tanggal') != null ? generate_date_format($request->query('tanggal'), 'y-m-d') : date('Y-m-d');
		$kantor = $request->query('kantor');
		$dtotal = 0; // Total detail
		$subtotal = 0; // Total harta, kewajiban, modal
		$pasiva = 0; // Total pasiva
		$sysakun = "('3000','3001','5000')";
		$accre = get_retained_earning($tanggal, $kantor, $grup)['akun']; // Akun laba ditahan
		$rebalance = get_retained_earning($tanggal, $kantor, $grup)['balance']; // Balance laba ditahan
		$earning = get_earning($tanggal, $kantor, $grup);
		
		// Data neraca
		$neraca = DB::select("SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC");
		
		// Loop neraca
		foreach($neraca as $data){
			if($data->seq == 30) $pasiva = 0;
			if($data->linetype == 'ListDetail'){
				// Data akun
				$akun = DB::select("SELECT a.*, (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$kantor} AND transdate<='{$tanggal}') AS saldo, (SELECT COUNT(*) FROM ac_akun WHERE parentaccount=a.kodeakun) AS parent FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$kantor}$|\\\.{$kantor}\\\.|\\\.{$kantor}$') OR (kode IN {$sysakun})) AND a.groupid={$grup} AND subaccount=0 ORDER BY a.kodeakun");

				// Loop akun
				if(count($akun)>0){
					foreach($akun as $data2){
						$balance = abs($data2->saldo);
						if($data2->kodeakun == $accre) $balance = $rebalance; // Laba ditahan
						$dtotal += $balance; // Total detail
						$subtotal += $balance; // Total parent
						$pasiva += $balance;
						$sbalance = $balance >= 0 ? number_format($balance,0,',',',') : '('.number_format(abs($balance),0,',',',').')'; // String balance
						$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String total detail
						$parent = false; // parent

						if($data2->parent > 0){
							$parentamount = $balance;
							$parent = true;
							echo '<tr>';
							echo '<td style="text-indent: 2rem;">'.$data2->namaakun.'</td>';
							echo '<td></td>';
							echo '<td></td>';
							echo '</tr>';
						}
						else{
							echo '<tr>';
							echo '<td style="text-indent: 2rem;">'.$data2->namaakun.'</td>';
							echo '<td align="right">'.$sbalance.'</td>';
							echo '<td></td>';
							echo '</tr>';
						}

						if($parent == true){
							// Data rows
							$rows = DB::select("SELECT kodeakun, namaakun, (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$kantor} AND transdate<='{$tanggal}') AS saldo FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$kantor}$|\\\.{$kantor}\\\.|\\\.{$kantor}$') OR (kode IN {$sysakun})) AND a.groupid={$grup} AND subaccount=1 AND parentaccount='{$data2->kodeakun}' ORDER BY a.kodeakun");

							// Loop rows
							if(count($rows)>0){
								foreach($rows as $row){
									$balance = $row->saldo;
									if($data->grup > 1 && $row->saldo != 0) $balance = $row->saldo * -1;
									$parentamount += $balance;
									$dtotal += $balance;
									$subtotal += $balance;
									$pasiva += $balance;
									$sbalance = $balance >= 0 ? number_format($balance,0,',',',') : '('.number_format(abs($balance),0,',',',').')'; // String balance
									$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String total detail
									echo '<tr>';
									echo '<td style="text-indent: 3rem;">'.$row->namaakun.'</td>';
									echo '<td align="right">'.$sbalance.'</td>';
									echo '<td></td>';
									echo '</tr>';
								}
							}
						}
					}
				}
			}
			elseif($data->linetype == 'Detail'){
				// Jika bukan laba tahun berjalan
				if($data->stmtlinid != 50){
					// $earning = get_earning($tanggal, $kantor, $grup);
					$searning = $earning >= 0 ? number_format($earning,0,',',',') : '('.number_format(abs($earning),0,',',',').')'; // String earning
					echo '<tr>';
					echo '<td style="text-indent: 2rem;">'.$data->lineheading.' '.$data->idtipe.'</td>';
					echo '<td align="right">'.$searning.'</td>';
					echo '<td></td>';
					echo '</tr>';
					$dtotal += $earning; // Total detail
					$subtotal += $earning; // Total parent
					$pasiva += $earning;
				}
			}
			else{
				$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String total detail
				if($data->akuntipe > 0){
					// Akun
					if($data->linetype == 'Total'){
						echo '<tr class="font-weight-bold">';
						echo '<td style="text-indent: 1rem;">'.$data->lineheading.'</td>';
						echo '<td></td>';
						echo '<td align="right">'.$sdtotal.'</td>';
						echo '</tr>';
					}
					// Yang punya child saja
					elseif($data->cnt > 0){
						echo '<tr class="font-weight-bold">';
						echo '<td colspan="3" style="text-indent: 1rem;">'.$data->lineheading.'</td>';
						echo '</tr>';
					}
				}
				else{
					$ssubtotal = $subtotal >= 0 ? number_format($subtotal,0,',',',') : '('.number_format(abs($subtotal),0,',',',').')'; // String sub total
					$spasiva = $pasiva >= 0 ? number_format($pasiva,0,',',',') : '('.number_format(abs($pasiva),0,',',',').')'; // String pasiva
					if($data->linetype == 'Heading'){
						echo '<tr class="font-weight-bold" style="background-color: #efefef;">';
						echo '<td colspan="3">'.$data->lineheading.'</td>';
						echo '</tr>';
					}
					else{
						// Total kewajiban dan modal
						if($data->seq == 53){
							echo'<tr class="font-weight-bold" style="background-color: #ddd;">';
							echo'<td colspan="2" align="center">'.$data->lineheading.'</td>';
							echo'<td align="right">'.$spasiva.'</td>';
							echo'</tr>';
						}
						// Total harta
						elseif($data->seq == 29){
							echo '<tr class="font-weight-bold" style="background-color: #ddd;">';
							echo '<td colspan="2" align="center">'.$data->lineheading.'</td>';
							echo '<td align="right">'.$ssubtotal.'</td>';
							echo '</tr>';
							$subtotal = 0;
						}
						else{
							echo '<tr class="font-weight-bold" style="background-color: #e5e5e5;">';
							echo '<td colspan="2">'.$data->lineheading.'</td>';
							echo '<td align="right">'.$ssubtotal.'</td>';
							echo '</tr>';
							$subtotal = 0;
						}
					}
				}
				$dtotal = 0;
			}
		}
    }

    /**
     * Menampilkan neraca multiperiod
     * 
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function multiperiod(Request $request)
    {
    	ini_set('max_execution_time', 300);
		ini_set('memory_limit','1000M');

		// Bulan dan tahun
		$bulan1 = date('n') - 3;
		$bulan1 = $bulan1 < 1 ? 1 : $bulan1;
		$bulan2 = date('n');
		$tahun = date('Y');
		
		// Data user
		$user = DB::table('tbl_users')->where('id','=',1673)->first();

		if($user){
			// Data kantor
			$kantor = Kantor::where('groupid','=',$user->groupid)->get();
		
			// Data neraca
			$neraca = DB::select("SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC");

			if($request->ajax()){
				// Response
				return response()->json([
					'html' => view('admin.balancesheet._multiperiod', [
						'neraca' => $neraca,
						'grup' => $request->query('grup'),
						'kantor' => $request->query('kantor'),
						'bulan1' => $request->query('bulan1'),
						'bulan2' => $request->query('bulan2'),
						'tahun' => $request->query('tahun'),
					])->render()
				]);
			}
			else{
				// View
				return view('admin.balancesheet.multiperiod', [
					'bulan1' => $bulan1,
					'bulan2' => $bulan2,
					'tahun' => $tahun,
					'user' => $user,
					'kantor' => $kantor,
					'content' => view('admin.balancesheet._multiperiod', [
						'neraca' => $neraca,
						'grup' => $user->groupid,
						'kantor' => $user->idkantor,
						'bulan1' => $bulan1,
						'bulan2' => $bulan2,
						'tahun' => $tahun,
					])->render()
				]);
			}
		}
    }

    /**
     * Menampilkan data neraca multiperiod
     * 
     * @return \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function multiperiodData(Request $request)
    {
    	ini_set('max_execution_time', 300);
		ini_set('memory_limit','1000M');

		// Variabel
		$grup = $request->query('grup');
		$kantor = $request->query('kantor');
		$bulan1 = $request->query('bulan1');
		$bulan2 = $request->query('bulan2');
		$tahun = $request->query('tahun');
	}
}
