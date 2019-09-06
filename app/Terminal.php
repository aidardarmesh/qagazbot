<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    
	public $incrementing = false;

	public function charge()
	{

		return $this->addr . " \nЗаряд: " . $this->pages . " стр\n";

	}

	public function about()
	{

		return "Листы: " . $this->pages . " \nТрафик: " . $this->traffic . " \nТонер: " . $this->toner . " \n";

	}

}
