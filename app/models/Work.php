<?php

class Worker
  {
    public $id;
    public $task_id;
    public $team_id;
    public $start;
    public $stop;
    public $hours;
    public $completion_estimate;

public function __construct($row){
  $this->id = $row['id'];

  $this->task_id = $row['task_id'];
  $this->team_id = $row['team_id'];

  $this->start = $row['start_date'];
  $this->hours = floatval($row['hours']);

  //Calculate stop date-
  $hours = floor($this->hours);
  $mins = intval(($this->hours - $hours) * 60);
  $interval = 'PT'. ($hours ? $hours.'H' : '') . ($mins ? $mins . 'M' : '');

  $date = new DateTime($this->start);
  $date->add(new DateInterval($interval));
  $this->stop = $date->format('Y-m-d H:i:s');

  $this->completion_estimate = intval($row['completion_estimate']);

  $this->stop = $row['end_date'];

  // TODO
}

public static function getWorkByTaskId( int $taskId) {
  //1. Get db fann_get_total_connections
  $db = new PDO(DB_SERVER, DB_USER, DB_PW);

  $sql = 'SELECT * FROM Work WHERE task_id = ?';

  $statement = $db->prepare($sql);

  $success = $statement->execute(
      [$taskId]
    );

    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {

      $workItem = new Work($row);

      array_push($arr, $workItem);
    }

var_dump($arr);
die;

  return $arr;

}
  }
