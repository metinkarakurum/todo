<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(TaskRepository $taskRepository)
    {
        $tasks     = $taskRepository->getAll();
        
        $developers=[
            [
                'NAME'  =>'DEV5',
                'TIME'  =>45,
                'LEVEL' =>5
            ],
            [
                'NAME'  =>'DEV4',
                'TIME'  =>45,
                'LEVEL' =>4
            ],
            [
                'NAME'  =>'DEV3',
                'TIME'  =>45,
                'LEVEL' =>3
            ],
            [
                'NAME'  =>'DEV2',
                'TIME'  =>45,
                'LEVEL' =>2
            ],
            [
                'NAME'  =>'DEV1',
                'TIME'  =>45,
                'LEVEL' =>1
            ],

        ];

        $toDoList = [];
        
        $taskCount=count($tasks);
        $week=0;
        while($taskCount > 0) {

            $week++;
            foreach($developers as $dev){
                
                    foreach($tasks as $key=>$task){
                        $timeSpent  = $task->getCost()/$dev['LEVEL'];
                        if($task->getCost()!=0 && $dev['TIME']!=0 && $dev['TIME']>$timeSpent){
                            
                            $dev['TIME']-= $timeSpent;
        
                            $toDoList[$week][]=
                            [
                                'DEV'       => $dev['NAME'],
                                'TASK'      => $task->getName(),
                                'DURATION'  => $task->getDuration(),
                                'LEVEL'     => $task->getLevel(),
                                'TIME_SPENT'=> number_format($timeSpent, 1, '.', ',')
                            ];
                            unset($tasks[$key]);
                            $taskCount--;
                        }  
                        
                    }
        
            }
        }   

        return $this->render('home/index.html.twig',['toDoList' => $toDoList]);
    }
}