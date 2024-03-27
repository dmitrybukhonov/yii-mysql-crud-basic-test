<?php

namespace app\modules\bookcatalog\components;

use app\modules\bookcatalog\repositories\AuthorRepository;

final class AuthorDropdown
{
    public function getList(): array
    {
        $repository = new AuthorRepository();

        return $repository->getAuthorsForDropdown();
    }
}
