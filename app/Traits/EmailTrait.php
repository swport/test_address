<?php

namespace App\Traits;

trait EmailTrait
{
    public function notifyViaEmail()
    {
        mail('some.email@email.com', 'address added', '<h1>Address added</h1>');
    }
}