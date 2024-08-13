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
                                    (`snip_forms_class`, 
                                    `snip_form_type`, 
                                    `snip_form_title`, 
                                    `snip_form_desc`, 
                                    `snip_form_img`, 
                                    `snip_form_code`) VALUES (?, ?, ?, ?, ?, ?)");

        $query->execute([$class, $type, $title, $desc, $image, $code]);

    }

}