<?php

namespace App\Service\Task;

use App\Entity\Task;
use Symfony\Component\HttpClient\HttpClient;

class ItTask implements ITask {

    public function create($em) {

        $client     = HttpClient::create();
        $response   = $client->request('GET', 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        $responseArr= $response->toArray();
        
        foreach($responseArr as $data){
            $task = new Task();

            $task->setName($data['id']);
            $task->setLevel($data['zorluk']);
            $task->setDuration($data['sure']);
            $cost=$data['zorluk']*$data['sure'];
            $task->setCost($cost);
            
            $em->persist($task);
            $em->flush($task);
        }
        

    }
    
}