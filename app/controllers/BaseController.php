<?php

namespace app\controllers;

use app\controllers\BaseTemplateController;

class BaseController
{
  public function home()
  {
    return BaseTemplateController::view("home");
  }
  public function formStudent()
  {
    return BaseTemplateController::view("form_student");
  }
  public function formCompanies()
  {
    return BaseTemplateController::view("form_companies");
  }
  public function formMixed()
  {
    return BaseTemplateController::view("form_mixed");
  }
  public function notFound()
  {
    return BaseTemplateController::view("404");
  }
}