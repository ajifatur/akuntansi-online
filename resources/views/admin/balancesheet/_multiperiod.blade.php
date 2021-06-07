<?php
		$bulanString = $bulan1 <= 9 ? '0'.$bulan1 : $bulan1;
		$tanggal = $tahun.'-'.$bulanString.'-01';
		$accre = get_retained_earning($tanggal, $kantor, $grup)['akun']; // Akun laba ditahan
		$rebalance = get_retained_earning($tanggal, $kantor, $grup)['balance']; // Balance laba ditahan
		$delta = $bulan2 - $bulan1;
		$adtotal = array();
		$asubtotal = array(); // Total harta, kewajiban, modal
		$apasiva = array();
		$asdtotal = array();
		$sysakun = "('3000','3001','5000')";

		// Laba ditahan
		$earning = [];
		for($i=$bulan1; $i<=$bulan2; $i++){
			$data = DB::select("SELECT COALESCE(SUM(g.transamount),0) AS earning FROM ac_glhist g INNER JOIN ac_akun a ON a.kodeakun=g.glaccount INNER JOIN ac_akuntipe t ON t.idtipe=a.idtipe WHERE t.grup IN(4,5) AND g.idkantor={$kantor} AND g.glperiod<={$i} AND g.glyear={$tahun}");
			$earning[$i] = $data[0]->earning * -1;
			$adtotal[$i] = 0;
			$asubtotal[$i] = 0;
			$apasiva[$i] = 0;
			$asdtotal[$i] = 0;
		}
        
		// Display table
		echo '<thead class="bg-warning">';
		echo '<tr>';
		echo '<th>Deskripsi</th>';
		foreach(array_indo_month() as $key=>$data){
			if($key+1 >= $bulan1 && $key+1 <= $bulan2){
				echo '<th width="150">'.$data.'</th>';
			}
		}
		echo '</tr>';
		echo '</thead>';
		echo '<tbody>';

		// Loop neraca
		foreach($neraca as $data){
			// Reset pasiva
			if($data->seq == 30){
				for($i=$bulan1; $i<=$bulan2; $i++){
					$apasiva[$i] = 0;
				}
			}

			if($data->linetype == 'ListDetail'){
				$sql = "SELECT kodeakun, namaakun ";
				$j = 1;
				for($i=$bulan1; $i<=$bulan2; $i++){
					$iString = $i <= 9 ? '0'.$i : $i;
					$sql .= ", (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$kantor} AND transdate<'{$tahun}-{$iString}-01') AS b{$j}";
					$j++;
				}
				$sql .= " FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$kantor}$|\\\.{$kantor}\\\.|\\\.{$kantor}$') OR (kode IN ".$sysakun.")) AND a.groupid={$grup} ORDER BY a.kodeakun";
				$rows = DB::select($sql);
				
				// Loop rows
				if(count($rows)>0){
					foreach($rows as $row){
						$row = (array)$row;
						echo '<tr>';
						echo '<td style="text-indent: 1rem;">'.$row['namaakun'].'</td>';
						$j = 1;
						for($i=$bulan1; $i<=$bulan2; $i++){
							$balance = $row['b'.$j];
							if($data->grup > 1 && $balance != 0) $balance = $row['b'.$j] * -1;
							if($row['kodeakun'] == $accre) $balance = $rebalance;
							$adtotal[$i] += $balance; // Total detail
							$asubtotal[$i] += $balance; // Total parent
							$apasiva[$i] += $balance;
							$sbalance = ($balance < 0 ? '('.number_format(abs($balance),0,',','.').')' : number_format($balance,0,',','.'));
							$asdtotal[$i] = ($adtotal[$i] < 0 ? '('.number_format(abs($adtotal[$i]),0,',','.').')' : number_format($adtotal[$i],0,',','.'));
							echo '<td style="text-align: right;">'.$sbalance.'</td>';
							$j++;
						}
						echo '</tr>';
					}
				}
			}
			elseif($data->linetype == 'Detail'){
				echo '<tr>';
				echo '<td style="text-indent: 1rem";>'.$data->lineheading.'</td>';
				for($i=$bulan1; $i<=$bulan2; $i++){
					$searning = ($earning[$i] < 0 ? '('.number_format(abs($earning[$i]),0,',','.').')' : number_format($earning[$i],0,',','.'));
					echo '<td style="text-align: right;">'.$searning.'</td>';
					$apasiva[$i] = $apasiva[$i] + $earning[$i];	
					$adtotal[$i] = $adtotal[$i] + $earning[$i];
					$asubtotal[$i] = $asubtotal[$i] + $earning[$i];
				}
				echo "</tr>";
			}
		}

		echo '</tbody>';