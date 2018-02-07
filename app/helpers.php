<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function checkActive($path, $active = 'active') {
    if (is_string($path)) {
        return request()->is($path) ? $active : '';
    }
    foreach ($path as $str) {
        if (checkActive($str) == $active)
            return $active;
    }
}

function getGender() {
    $genders = ['' => '---- Select /लिंग चुने ----', 'Male' => 'Male / पुरुष', 'Female' => 'Female / महिला', 'Others' => 'Others / अन्य लोग'];
    return $genders;
}

function getCasteCategory() {
    $cat = ['' => '---- Select / जाति श्रेणी ----',
        'General' => 'General / सामान्य',
        'SC' => 'SC - Schedule Caste / अनुसूचित जाति',
        'BC' => 'BC - BC / पिछड़े वर्ग',
        //'OBC' => 'OBC - Other Backward Class/ अन्य पिछड़ा वर्ग',
        'ST' => 'ST - Schedule tribe / अनुसूचित जनजाति'];
    return $cat;
}

function getFarmerCategory() {
    $cat = ['' => '---- Select ----',
        'Small Farmer' => 'Small Farmer / लघु किसान',
        'Marginal Farmer' => 'Marginal Farmer / सीमांत किसान',
        'Others' => 'Others / अन्य लोग',
    ];
    return $cat;
}

function getMaritalStatus() {
    $status = ['' => '---- Select /वैवाहिक स्थिति ----',
        'Married' => 'Married / विवाहित',
        'Unmarried' => 'Unmarried / अविवाहित',
        'Others' => 'Others / अन्य लोग',
    ];
    return $status;
}

function getMainScheme() {
    $schemes = ['' => 'Select Main Scheme'] + \App\MainScheme::orderBy('name')->pluck('name', 'id')->toArray();
    return $schemes;
}

function getSubScheme() {
    $subschemes = ['' => 'Select SubScheme'] + \App\SubScheme::orderBy('name')->pluck('name', 'id')->toArray();
    return $subschemes;
}

function deny($redirect = '') {
    if (strlen($redirect) > 0) {
        return redirect($redirect);
    } else {
//  abort(403);
        flash()->warning("You don't have access to this resource!!");
    }
    return redirect()->back();
}

function today_date() {
    return Carbon\Carbon::today()->format('d-m-Y');
}

function yesterday_date() {
    return Carbon\Carbon::yesterday()->format('d-m-Y');
}

function tomorrow_date() {
    return Carbon\Carbon::tomorrow()->format('d-m-Y');
}
