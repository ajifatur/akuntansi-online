<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Get image
if(!function_exists('image')){
    function image($file, $category = ''){
        if(config()->has('fpm.images.'.$category))
            return file_exists(public_path($file)) && !is_dir(public_path($file)) ? asset($file) : asset('assets/images/default/'.config('fpm.images.'.$category));
        else
            return '';
    }
}

// Get kategori setting
if(!function_exists('kategori_setting')){
    function kategori_setting($slug){
        if(Schema::hasTable('kategori_setting')){
            $data = DB::table('kategori_setting')->where('slug','=',$slug)->first();
            return $data ? $data->id_ks : null;
        }
    }
}

/**
 *
 * AOL Helpers
 *
 */

// Get akun retained earning
if(!function_exists('get_retained_earning')){
    function get_retained_earning($tanggal, $kantor, $grup){
		// Tahun
		$tahun = date('Y', strtotime($tanggal));
		
		// Akun retained earning
		$akun_re = DB::table('ac_defaccount')->where('groupid','=',$grup)->where('name','=','RETAINED_EARNING')->value('glaccount');
		
		// Balance
		$balance = DB::table('ac_glhist')->selectRaw('COALESCE(SUM(transamount),0) AS balance')->where('glaccount','=',$akun_re)->whereDate('transdate','<=',$tanggal)->where('idkantor','=',$kantor)->value('balance');
		
		// Acbalance
		$acbalance = DB::table('ac_glhist')->join('ac_akun','ac_glhist.glaccount','=','ac_akun.kodeakun')->join('ac_akuntipe','ac_akun.idtipe','=','ac_akuntipe.idtipe')->selectRaw('COALESCE(SUM(transamount),0) AS balance')->whereIn('grup',[4,5])->where('glyear','<=',$tahun)->where('idkantor','=',$kantor)->value('balance');
		
		// Rebalance
		$rebalance = $balance + $acbalance;
		$rebalance = $rebalance == 0 ? $rebalance : $rebalance * -1;
		
		// Return
		return [
			'akun' => $akun_re,
			'balance' => $rebalance,
		];
    }
}

// Get earning
if(!function_exists('get_earning')){
    function get_earning($tanggal, $kantor, $grup){
		// Tahun
		$tahun = date('Y', strtotime($tanggal));
		
		// Balance
		$balance = DB::table('ac_glhist')->join('ac_akun','ac_glhist.glaccount','=','ac_akun.kodeakun')->join('ac_akuntipe','ac_akun.idtipe','=','ac_akuntipe.idtipe')->selectRaw('COALESCE(SUM(transamount),0) AS balance')->whereIn('grup',[4,5])->whereDate('transdate','<=',$tanggal)->where('glyear','=',$tahun)->where('idkantor','=',$kantor)->value('balance');
		
		// Return
		return $balance == 0 ? $balance : $balance * -1;
    }
}

			
			