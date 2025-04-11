<?php

declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

class Exercise extends Model
{
    public $id;
    public $name;
    public $muscle_group;
    public $created_at;
    public $updated_at;

    public function initialize()
    {
        $this->setSource('exercises');
    }
}
