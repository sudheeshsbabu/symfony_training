<?php
namespace EmployeeBundle\Service;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageGenerator
 *
 * @author reizend333
 */
class MessageGenerator {
    /**
     * Set random messages.
     * @return string
     */
    public function getHappyMessage()
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];
        $index = array_rand($messages);
        return $messages[$index];
    }
    
    public function maxSalary() {
        
    }
}
