<?php
 
use Illuminate\Auth\UserInterface;
 
class Credit extends Eloquent
  implements UserInterface
{
  protected $table  = "credit";
  protected $connection = 'mysql';
  
  public function getCredit()
  {
    return $this->amount();
  }
}