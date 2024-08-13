<?php

namespace model\Manager;

use model\Abstract\AbstractManager;
use model\Mapping\FormMapping;



class FormManager extends AbstractManager
{

    public function addNewForm(FormMapping $formMapping): void {
        $class = $formMapping->getSnipFormClass();
        $type = $formMapping->getSnipFormType();
        $title = $formMapping->getSnipFormTitle();
        $desc = $formMapping->getSnipFormDesc();
        $image = $formMapping->getSnipFormImg();
        $code = $formMapping->getSnipFormCode();


        $query = $this->db->prepare("INSERT INTO `snippets_forms`
                                    (`snip_form_class`, 
                                    `snip_form_type`, 
                                    `snip_form_title`, 
                                    `snip_form_desc`, 
                                    `snip_form_img`, 
                                    `snip_form_code`) VALUES (?, ?, ?, ?, ?, ?)");

        $query->execute([$class, $type, $title, $desc, $image, $code]);

    }

    public function getDataByType($class, $type) : array|bool  {
        $stmt = $this->db->prepare("SELECT snip_form_id AS id,
                                                 snip_form_class AS class,
                                                 snip_form_title AS title,
                                                 snip_form_desc AS descp,
                                                 snip_form_img AS img,
                                                 snip_form_code AS code
                                          FROM `snippets_forms`
                                          WHERE snip_form_class = ?
                                          AND snip_form_type = ?");
        $stmt->execute([$class, $type]);
        if ($stmt->rowCount() === 0) return false;

        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }

}