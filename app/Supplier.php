<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // --- Laravel settings ---
	public $timestamps = false;
    public $guarded = ['id'];
    

    // --- Eloquent relationships ---
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot('price');;
    }


    // --- Getters ---
    public function nameLink()
    {
    	return '<a href="'.route('suppliers.show', $this).'" title="Detail dodavatele">'.$this->name.'</a>';
    }
}
