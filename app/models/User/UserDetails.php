<?php

class UserDetails extends Eloquent {
    protected $connection = 'mysql';
     protected $fillable = array('field','value');
    public function theme() {
        return $this->hasMany('User')->select(array('id', 'username'));
    }

}