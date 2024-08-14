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


    public  function selectAllCodeForLink() : array|bool {
        $query = $this->db->query("SELECT snip_code_id,
                                         snip_code_desc
                                         FROM `snippets_code`");
        if($query->rowCount() === 0) return false;
        $codeMapping = $query->fetchAll();

        $query->closeCursor();
        $codeObject = [];

        foreach ($codeMapping as $code) {
            $codeObject[] = new CodeMapping($code);
        }

        return $codeObject;
    }

    public function linkCodeToData($html, $code) : void {
        $stmt = $this->db->prepare("INSERT INTO `snippets_form_has_code`
                                         (`snip_form_has_id`, `snip_code_has_id`)
                                         VALUES (?,?)");
        $stmt->execute([$html, $code]);

    }

}