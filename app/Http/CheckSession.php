<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http;

use Auth;
use Session;

/**
 * Description of chk_session
 *
 * @author HKCL
 */
class CheckSession {

    static function chk_distuser() {
        if (Session::has('idDistrict') && (Session::has('idSubdivision') == false) && (Session::has('idBlock') == false)) {
            return true;
        } else {
            return false;
        }
    }

    static function chk_subuser() {
        if (Session::has('idSubdivision') && (Session::has('idBlock') == false)) {
            return true;
        } else {
            return false;
        }
    }

    static function chk_blockuser() {
        if (Session::has('idDistrict') && Session::has('idSubdivision') && Session::has('idBlock')) {
            $loggedinuser = \App\User::where('idUser', Auth::guard('authority')->User()->idUser)->first();
            $user_in_block = $loggedinuser->userdesig()
                    ->where('idDesignation', '=', Session::get('idDesignation'))
                    ->where('idDistrict', '=', Session::get('idDistrict'))
                    ->where('idSubdivision', '=', Session::get('idSubdivision'))
                    ->where('idBlock', '=', Session::get('idBlock'))
                    ->whereNotNull('idBlock')
                    ->whereNull('idVillage')
                    ->get();
            if (count($user_in_block) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    static function chk_villageuser() {
        $loggedinuser = \App\User::where('idUser', Auth::guard('authority')->User()->idUser)->first();
        $user_in_village = $loggedinuser->userdesig()
                ->where('idDesignation', '=', Session::get('idDesignation'))
                ->where('idDistrict', '=', Session::get('idDistrict'))
                ->where('idSubdivision', '=', Session::get('idSubdivision'))
                ->where('idBlock', '=', Session::get('idBlock'))
                ->whereNotNull('idVillage')
                ->get();
        // dd(count($user_in_village));
        if (count($user_in_village) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
