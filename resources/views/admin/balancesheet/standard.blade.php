@extends('template.admin.main')

@section('title', 'Neraca Standard')

@section('content')

<!-- Main -->
<main class="app-content">
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Body -->
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="bg-info">
                                <tr>
                                    <th>Deskripsi</th>
                                    <th width="150">Balance</th>
                                    <th width="150">Total Balance</th>
                                </tr>
                            </thead>
                            <tbody>
								@php
									$dtotal = 0; // Total detail
									$subtotal = 0; // Total harta, kewajiban, modal
									$pasiva = 0;
									$sysakun = "('3000','3001','5000')";
								@endphp
                                @foreach($neraca as $data)
									@php if($data->seq == 30) $pasiva = 0; @endphp
									@if($data->linetype == 'ListDetail')
										@php
											$akun = \DB::select("SELECT a.*, (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$user->idkantor} AND transdate<='{$tanggal}') AS saldo, (SELECT COUNT(*) FROM ac_akun WHERE parentaccount=a.kodeakun) AS parent FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$user->idkantor}$|\\\.{$user->idkantor}\\\.|\\\.{$user->idkantor}$') OR (kode IN {$sysakun})) AND a.groupid={$user->groupid} AND subaccount=0 ORDER BY a.kodeakun");
										@endphp
								
										@if(count($akun)>0)
											@foreach($akun as $data2)
												@php
													$balance = abs($data2->saldo);
													if($data2->kodeakun == get_retained_earning($tanggal, $user->idkantor, $user->groupid)['akun']) $balance = get_retained_earning($tanggal, $user->idkantor, $user->groupid)['balance']; // Laba Ditahan
													$dtotal += $balance; // Total Detail
													$subtotal += $balance; // Total Parent
													$pasiva += $balance;
													$sbalance = $balance >= 0 ? number_format($balance,0,',',',') : '('.number_format(abs($balance),0,',',',').')'; // String Balance
													$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String Total Detail
													$parent = false; // Parent
												@endphp
								
												@if($data2->parent > 0)
													@php
														$parentamount = $balance;
														$parent = true;
													@endphp
													<tr>
														<td style="text-indent: 2rem;">{{ $data2->namaakun }}</td>
														<td></td>
														<td></td>
													</tr>
												@else
													<tr>
														<td style="text-indent: 2rem;">{{ $data2->namaakun }}</td>
														<td align="right">{{ $sbalance }}</td>
														<td></td>
													</tr>
												@endif
								
												@if($parent == true)
													@php
														$rows = \DB::select("SELECT kodeakun, namaakun, (SELECT COALESCE(SUM(transamount),0) FROM ac_glhist WHERE glaccount=a.kodeakun AND idkantor={$user->idkantor} AND transdate<='{$tanggal}') AS saldo FROM ac_akun a WHERE a.idtipe={$data->akuntipe} AND (a.kantorlist REGEXP('^\\\.{$user->idkantor}$|\\\.{$user->idkantor}\\\.|\\\.{$user->idkantor}$') 
	 				OR (kode IN {$sysakun})) AND a.groupid={$user->groupid} AND subaccount=1 AND parentaccount='{$data2->kodeakun}'
					ORDER BY a.kodeakun");
													@endphp
								
													@if(count($rows)>0)
														@foreach($rows as $row)
															@php
																$balance = $row->saldo;
																if($data->grup > 1 && $row->saldo != 0) $balance = $row->saldo * -1;
																$parentamount += $balance;
																$dtotal += $balance;
																$subtotal += $balance;
																$pasiva += $balance;
																$sbalance = $balance >= 0 ? number_format($balance,0,',',',') : '('.number_format(abs($balance),0,',',',').')'; // String Balance
																$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String Total Detail
															@endphp
															<tr>
																<td style="text-indent: 3rem;">{{ $row->namaakun }}</td>
																<td align="right">{{ $sbalance }}</td>
																<td></td>
															</tr>
														@endforeach
													@endif
												@endif
											@endforeach
										@endif
								
									@elseif($data->linetype == 'Detail')
										@if($data->stmtlinid != 50)
											<!-- Bukan Laba Tahun Berjalan -->
											@php
												$earning = get_earning($tanggal, $user->idkantor, $user->groupid);
												$searning = $earning >= 0 ? number_format($earning,0,',',',') : '('.number_format(abs($earning),0,',',',').')'; // String Earning
											@endphp
											<tr>
												<td style="text-indent: 2rem;">{{ $data->lineheading }} {{ $data->idtipe }}</td>
												<td align="right">{{ $searning }}</td>
												<td></td>
											</tr>
											@php
												$dtotal += $earning; // Total Detail
												$subtotal += $earning; // Total Parent
												$pasiva += $earning;
											@endphp
										@endif
								
									@else
										@php
											$sdtotal = $dtotal >= 0 ? number_format($dtotal,0,',',',') : '('.number_format(abs($dtotal),0,',',',').')'; // String Total Detail
										@endphp
								
										@if($data->akuntipe > 0)
											<!-- Akun -->
											@if($data->linetype == 'Total')
												<tr class="font-weight-bold">
													<td style="text-indent: 1rem;">{{ $data->lineheading }}</td>
													<td></td>
													<td align="right">{{ $sdtotal }}</td>
												</tr>
											<!-- Yang Punya Child Saja -->
											@elseif($data->cnt > 0)
												<tr class="font-weight-bold">
													<td colspan="3" style="text-indent: 1rem;">{{ $data->lineheading }}</td>
												</tr>
											@endif
										@else
											@php
												$ssubtotal = $subtotal >= 0 ? number_format($subtotal,0,',',',') : '('.number_format(abs($subtotal),0,',',',').')'; // String Sub Total
												$spasiva = $pasiva >= 0 ? number_format($pasiva,0,',',',') : '('.number_format(abs($pasiva),0,',',',').')'; // String Pasiva
											@endphp
								
											@if($data->linetype == 'Heading')
												<tr class="font-weight-bold" style="background-color: #efefef;">
													<td colspan="3">{{ $data->lineheading }}</td>
												</tr>
											@else
												<!-- Total Kewajiban dan Modal -->
												@if($data->seq == 53)
													<tr class="font-weight-bold" style="background-color: #ddd;">
														<td colspan="2" align="center">{{ $data->lineheading }}</td>
														<td align="right">{{ $spasiva }}</td>
													</tr>
												<!-- Total Harta -->
												@elseif($data->seq == 29)
													<tr class="font-weight-bold" style="background-color: #ddd;">
														<td colspan="2" align="center">{{ $data->lineheading }}</td>
														<td align="right">{{ $ssubtotal }}</td>
													</tr>
													@php $subtotal = 0; @endphp
												@else
													<tr class="font-weight-bold" style="background-color: #e5e5e5;">
														<td colspan="2">{{ $data->lineheading }}</td>
														<td align="right">{{ $ssubtotal }}</td>
													</tr>
													@php $subtotal = 0; @endphp
												@endif
											@endif
										@endif
										@php $dtotal = 0; @endphp
									@endif
								
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /Tile Body -->
            </div>
            <!-- /Tile -->
        </div>
        <!-- /Column -->
    </div>
    <!-- /Row -->
</main>
<!-- /Main -->

@endsection

@section('css-extra')

<style type="text/css">
	.table {font-size: .75rem;}
	.table tr th {text-align: center; padding: .25rem .5rem;}
	.table tr td {padding: 0rem .5rem;}
</style>

@endsection