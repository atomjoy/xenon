<?php

namespace App\Models\Demo\Morph;

class Location extends Model
{
	public function account_doctors()
	{
		return $this->morphedByMany(
			AccountDoctor::class,
			'locationable',     //name for the morphable
			'locationables',    //pivot table
			'location_id',      //foreign key on the pivot table to identify this model record
			'locationable_id',  //foreign key on the pivot table to identify related model record
			'id',               //primary key column name for this model's table
			'account_id'        //primary key column name for related model's
		);
	}
}
