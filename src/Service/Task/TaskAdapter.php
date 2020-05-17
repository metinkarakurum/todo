<?php
namespace App\Service\Task;

class TaskAdapter {
 
    private $strategy = null;
    private $em = null;
 
    public function __construct($strategy,$em) {
        $this->em = $em;
        if ($strategy == "it") {
            return $this->strategy = new ItTask();
        } else if ($strategy == "business") {
            return $this->strategy = new BusinessTask();
        }
        throw new \InvalidArgumentException('Type not found');
    }
 
    public function createTask() {
        return $this->strategy->create($this->em);
    }
}