<?php  if ( ! defined('LIB')) exit('Direct script access is not allowed!');
/*
 *
 * @author:  Orlino L. Monares Jr. <anxietylost110987@gmail.com, orlino_monares110987@yahoo.com>
 *
 * @package:
 * @subpackage:
 *
 * @todo: _____________
 *
 */

class innoScaffolding
{
  protected $table_columns = null;
  protected $scaffold_type = create;
  
  public function __construct()
  {
    
  }
  
  public function setType($type)
  {
    $this->scaffold_type = $type;
  }
  
  public function getType()
  {
    return $this->scaffold_type;
  }
  
  public function setColumns($columns)
  {
    $this->table_columns = $columns;
  }
  
  public function getColumns()
  {
    return $this->table_columns;
  }
  
  public function run()
  {
    switch($this->scaffold_type)
    {
      case 'create':
        $this->createScaffold();
        break;
      case 'list':
        $this->listScaffold();
        break;
      case 'delete':
        $this->deleteScaffold();
        break;
    }
  }
  
  protected function createScaffold()
  {
    
  }
  
  protected function listScaffold()
  {
    
  }
  
  protected function deleteScaffold()
  {
    
  }
}
