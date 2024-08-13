<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\FormMapping;
use model\MyPDO;
use MongoDB\Driver\Manager;

class FormManager extends AbstractManager
{

    public function __construct(MyPDO $db) {
        $this->db = $db;
    }

}