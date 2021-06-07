<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kas;
use App\Kantor;

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
		$user = DB::table('tbl_users')->where('id','=',13)->first();

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
		$tanggal = $request->query('tanggal') != null ? generate_date_format($request->query('tanggal'), 'y-m-d') : date('Y-m-d');
		$kantor = $request->query('kantor');
		$grup = $request->query('grup');
		$html = '';
		$dtotal = 0; // Total detail
		$subtotal = 0; // Total harta, kewajiban, modal
		$pasiva = 0; // Total pasiva
		$sysakun = "('3000','3001','5000')";
		$accre = get_retained_earning($tanggal, $kantor, $grup)['akun']; // Akun laba ditahan
		$rebalance = get_retained_earning($tanggal, $kantor, $grup)['balance']; // Balance laba ditahan
		$earning = get_earning($tanggal, $kantor, $grup);
		
		// Data neraca
		$neraca = DB::select('SELECT a.*, (SELECT grup FROM ac_akuntipe WHERE idtipe=a.akuntipe) AS grup, (SELECT COUNT(kodeakun) FROM ac_akun WHERE idtipe=a.akuntipe) AS cnt FROM ac_fstmtlin a WHERE tipe=1 ORDER BY seq ASC');
		
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
							$html .= '<tr>';
							$html .= '<td style="text-indent: 2rem;">'.$data2->namaakun.'</td>';
							$html .= '<td></td>';
							$html .= '<td></td>';
							$html .= '</tr>';
						}
						else{
							$html .= '<tr>';
							$html .= '<td style="text-indent: 2rem;">'.$data2->namaakun.'</td>';
							$html .= '<td align="right">'.$sbalance.'</td>';
							$html .= '<td></td>';
							$html .= '</tr>';
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
									$html .= '<tr>';
									$html .= '<td style="text-indent: 3rem;">'.$row->namaakun.'</td>';
									$html .= '<td align="right">'.$sbalance.'</td>';
									$html .= '<td></td>';
									$html .= '</tr>';
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
					$html .= '<tr>';
					$html .= '<td style="text-indent: 2rem;">'.$data->lineheading.' '.$data->idtipe.'</td>';
					$html .= '<td align="right">'.$searning.'</td>';
					$html .= '<td></td>';
					$html .= '</tr>';
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
						$html .= '<tr class="font-weight-bold">';
						$html .= '<td style="text-indent: 1rem;">'.$data->lineheading.'</td>';
						$html .= '<td></td>';
						$html .= '<td align="right">'.$sdtotal.'</td>';
						$html .= '</tr>';
					}
					// Yang punya child saja
					elseif($data->cnt > 0){
						$html .= '<tr class="font-weight-bold">';
						$html .= '<td colspan="3" style="text-indent: 1rem;">'.$data->lineheading.'</td>';
						$html .= '</tr>';
					}
				}
				else{
					$ssubtotal = $subtotal >= 0 ? number_format($subtotal,0,',',',') : '('.number_format(abs($subtotal),0,',',',').')'; // String sub total
					$spasiva = $pasiva >= 0 ? number_format($pasiva,0,',',',') : '('.number_format(abs($pasiva),0,',',',').')'; // String pasiva
					if($data->linetype == 'Heading'){
						$html .= '<tr class="font-weight-bold" style="background-color: #efefef;">';
						$html .= '<td colspan="3">'.$data->lineheading.'</td>';
						$html .= '</tr>';
					}
					else{
						// Total kewajiban dan modal
						if($data->seq == 53){
							$html .='<tr class="font-weight-bold" style="background-color: #ddd;">';
							$html .='<td colspan="2" align="center">'.$data->lineheading.'</td>';
							$html .='<td align="right">'.$spasiva.'</td>';
							$html .='</tr>';
						}
						// Total harta
						elseif($data->seq == 29){
							$html .= '<tr class="font-weight-bold" style="background-color: #ddd;">';
							$html .= '<td colspan="2" align="center">'.$data->lineheading.'</td>';
							$html .= '<td align="right">'.$ssubtotal.'</td>';
							$html .= '</tr>';
							$subtotal = 0;
						}
						else{
							$html .= '<tr class="font-weight-bold" style="background-color: #e5e5e5;">';
							$html .= '<td colspan="2">'.$data->lineheading.'</td>';
							$html .= '<td align="right">'.$ssubtotal.'</td>';
							$html .= '</tr>';
							$subtotal = 0;
						}
					}
				}
				$dtotal = 0;
			}
		}

		echo $html;
    }
}
