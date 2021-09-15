<?php
// Classe qui permet de créer des objets résultats
class Result {
  public $idGame;
  public $idCable1;
  public $nameCable1;
  public $idCable2;
  public $nameCable2;
  public $idCable3;
  public $nameCable3;
  public $soluce1;
  public $soluce2;
  public $start;
  public $step1;
  public $step2;
  public $end;
  public $success;
  public $master_up;
  public $sensehat_up;
  public $piface_up;
  public $laby_up;
  public $binary;
  public function __construct($idGame, $idCable1, $nameCable1, $idCable2, $nameCable2, $idCable3, $nameCable3, $soluce1, $soluce2, $binary, $start, $step1, $step2, $end, $success, $master, $sensehat, $piface, $laby)
  {
    $this->idGame = $idGame;
    $this->idCable1 = $idCable1;
    $this->nameCable1 = $nameCable1;
    $this->idCable2 = $idCable2;
    $this->nameCable2 = $nameCable2;
    $this->idCable3 = $idCable3;
    $this->nameCable3 = $nameCable3;
    $this->soluce1 = $soluce1;
    $this->soluce2 = $soluce2;
    $this->binary = $binary;
    $this->start = $start;
    $this->step1 = $step1;
    $this->step2 = $step2;
    $this->end = $end;
    $this->success = $success;
    $this->master_up = $master;
    $this->sensehat_up = $sensehat;
    $this->piface_up = $piface;
    $this->laby_up = $laby;
  }
}
?>
