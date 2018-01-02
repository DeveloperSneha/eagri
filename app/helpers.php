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
    $genders = ['' => '---- Select ----', 'Male' => 'Male / पुरुष', 'Female' => 'Female / महिला', 'Others' => 'Others / अन्य लोग'];
    return $genders;
}

function getCasteCategory() {
    $cat = ['' => '---- Select ----',
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
    $status = ['' => '---- Select ----',
        'Married' => 'Married / विवाहित',
        'Unmarried' => 'SC - Schedule Caste / अनुसूचित जाति',
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
  if (strlen($redirect) > 0)
    return redirect($redirect);
//  abort(403);
  flash()->warning("You don't have access to this resource!!");
  return redirect('/authority');
}