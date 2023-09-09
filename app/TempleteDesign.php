<?php

namespace App;

use App\Model;

class TempleteDesign extends Model
{
    public static function getTemplateById($id)
    {
        $admitTemplete = self::find($id);
        if ($admitTemplete) {
            return $admitTemplete->name;
        }
        return '';
    }
}
