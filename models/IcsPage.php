<?php 

/**
* Input Block Page Model
*/
class IcsPage extends Page {
  
  public function url() {
    
    return url::build(array('scheme' => 'webcal'), parent::url());
    
  }
  
}
