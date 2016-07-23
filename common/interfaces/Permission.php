<?php

namespace common\interfaces;

interface Permission
{
    const TYPE_DENIED = -1;
    const TYPE_VIEW = 1;
    const TYPE_READ = 2;
    const TYPE_EDIT = 3;
    const TYPE_ADMIN = 4;

    public static function findType($entity, $document);
}