<?php
namespace App\Service\Task;

use App\Entity\Task;
use Symfony\Component\HttpClient\HttpClient;

class BusinessTask implements ITask {

    public function create($em) {

        $client     = HttpClient::create();
        $response   = $client->request('GET', 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7');
        $responseArr= $response->toArray();

        foreach($responseArr as $arr){
            
            $task = new Task();
            $taskName=array_keys($arr)[0] ?? '';
            $task->setName($taskName);

            foreach($arr as $data){             
                $task->setLevel($data['level']);
                $task->setDuration($data['estimated_duration']);
                $cost=$data['level']*$data['estimated_duration'];
                $task->setCost($cost);
                
                $em->persist($task);
                $em->flush($task);
            }
            
        }
    }
    
}