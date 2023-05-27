<?php

namespace app\controllers;

use app\controllers\Controller;

class DashboardController
{
  public function home()
  {
    return DashboardTemplateController::view("home");
  }
  public function login()
  {
    return DashboardTemplateController::view("login");
  }
  public function adm()
  {
    return DashboardTemplateController::view("usersAdm");
  }
  public function team()
  {
    return DashboardTemplateController::view("team");
  }
  public function teamDetails()
  {
    return DashboardTemplateController::view("teamDetails");
  }
  public function university()
  {
    return DashboardTemplateController::view("university");
  }
  public function faculty()
  {
    return DashboardTemplateController::view("faculty");
  }
  public function course()
  {
    return DashboardTemplateController::view("course");
  }
}
