<?php

namespace Admin\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql;

class UserTable {

    protected $adapter;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->sql = new Sql\Sql($this->adapter);
    }

    public function fetchAll() {
        $query = $this->sql->select()->from(array('u'=>'users'));
        echo $sql->getSqlStringForSqlObject($query);
        die;
    }

    public function xyz() {

        echo "xyz";
    }

    public function fetchData() {
        
    }

}
