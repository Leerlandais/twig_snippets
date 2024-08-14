<?php

namespace model\Mapping;

use model\Abstract\AbstractMapping;

class CodeMapping extends AbstractMapping
{
protected ?int $snip_code_id;
protected ?string $snip_code_type;
protected ?string $snip_code_code;

    public function getSnipCodeId(): ?int
    {
        return $this->snip_code_id;
    }

    public function setSnipCodeId(?int $snip_code_id): void
    {
        $this->snip_code_id = $snip_code_id;
    }

    public function getSnipCodeType(): ?string
    {
        return $this->snip_code_type;
    }

    public function setSnipCodeType(?string $snip_code_type): void
    {
        $this->snip_code_type = $snip_code_type;
    }

    public function getSnipCodeCode(): ?string
    {
        return $this->snip_code_code;
    }

    public function setSnipCodeCode(?string $snip_code_code): void
    {
        $this->snip_code_code = $snip_code_code;
    }


} // end Class