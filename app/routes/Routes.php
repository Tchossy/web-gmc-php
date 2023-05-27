<?php

namespace app\routes;

class Routes
{
  public static function get()
  {
    return [
      "get" => [
        "/" => 'BaseController@home',
        "/form_student" => 'BaseController@formStudent',
        "/form_companies" => 'BaseController@formCompanies',
        "/form_mixed" => 'BaseController@formMixed',

        "/painel" => 'DashboardController@login',
        "/painel/adm" => 'DashboardController@adm',
        "/painel/home" => 'DashboardController@home',
        "/painel/team" => 'DashboardController@team',
        "/painel/team/details/[0-9]+" => 'DashboardController@teamDetails',
        "/painel/university" => 'DashboardController@university',
        "/painel/faculty" => 'DashboardController@faculty',
        "/painel/course" => 'DashboardController@course',
      ],
    ];
  }
};