<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http;

use Session;

/**
 * Description of chk_session
 *
 * @author HKCL
 */
class CheckSession {

    static function chk_distuser() {
        if (Session::get('idDistrict') != null) {
            return Session::get('idDistrict');
        } else {
            flash()->warning("You don't have access to this resource!!");
            return redirect('/authority/districts');
        }
    }

    static function chk_subuser() {
        return Session::get('idSubdivision');
    }

    static function chk_blockuser() {
        return Session::get('idBlock');
    }

}
