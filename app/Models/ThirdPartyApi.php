<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class ThirdPartyApi
 * @package App\Models
 * @author John Antonio
 */
class ThirdPartyApi extends Model
{
    protected $table            = 'third_party_apis';
    protected $returnType       = 'App\Entities\ThirdPartyApi';
    protected $allowedFields    = ['name', 'provider', 'api_base_url', 'api_token', 'status'];
    protected $useTimestamps = true;

    // Validation
    protected $validationRules      = [
        'name' => 'required|max_length[128]',
        'provider' => 'required|in_list[upnshare,vidhide,earnvids,xvideosharing,custom]',
        'api_base_url' => 'required|valid_url|max_length[255]',
        'api_token' => 'permit_empty|max_length[255]',
        'status' => 'permit_empty|in_list[active,paused]'
    ];


    public function getApi($id)
    {
        return $this->where('id', $id)
                    ->first();
    }

}
