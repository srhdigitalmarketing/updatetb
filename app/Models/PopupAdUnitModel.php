<?php

namespace App\Models;

use CodeIgniter\Model;

class PopupAdUnitModel extends Model
{
    protected $table = 'popup_ad_units';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'page',
        'provider',
        'name',
        'ad_code',
        'weight',
        'status',
    ];

    public function activeForEmbed(): array
    {
        return $this->where('page', 'embed')
            ->where('status', 'active')
            ->orderBy('weight', 'DESC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
