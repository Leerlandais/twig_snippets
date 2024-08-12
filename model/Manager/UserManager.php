<?php

namespace model\Manager;

use model\Mapping\UserMapping;
use model\MyPDO;

class UserManager {
    private $db;

    public function __construct(MyPDO $db) {
        $this->db = $db;
    }

    public function attemptUserLogin(string $name, string $pwd): bool {
        $name = $this->standardClean($name);

        $sql = 'SELECT * FROM `snippets_users` WHERE `snip_user_login` = :name';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return false;
        }

        $row = $stmt->fetch();


        $user = new UserMapping($row);
        $user->loadFromDbRow($row);

        if (!password_verify($pwd, $user->getSnipUserPass())) {
            return false;
        }
        $_SESSION["id"] = session_id();


        return true;
    }

    private function standardClean(string $input): string {
        return htmlspecialchars(strip_tags(trim($input)));
    }
}
