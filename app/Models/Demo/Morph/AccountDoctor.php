<?php

namespace App\Models\Demo\Morph;

class AccountDoctor extends Model
{
	public function locations()
	{
		return $this->morphToMany(
			Location::class,
			'locationable',     //name for the morphable
			'locationables',    //pivot table
			'locationable_id',  //foreign key on the pivot table to identify this model record
			'location_id',      //foreign key on the pivot table to identify related model record
			'account_id',       //primary key column name for this model's table
			'id'                //primary key column name for related model's table
		);
	}
}
