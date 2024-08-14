<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\CodeMapping;

class CodeManager extends AbstractManager
{

    public function addNewCode(CodeMapping $codeMapping): void {

        $type = $codeMapping->getSnipCodeType();
        $desc = $codeMapping->getSnipCodeDesc();
        $code = $codeMapping->getSnipCodeCode();


        $query = $this->db->prepare("INSERT INTO `snippets_code`
                                    (`snip_code_type`,
                                     `snip_code_desc`,
                                     `snip_code_code`) VALUES (?, ?, ?)");

        $query->execute([$type, $desc, $code]);

    }

}