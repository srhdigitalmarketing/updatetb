<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ThirdPartyApi;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Model;


class ThirdPartyApis extends BaseController
{
    private const EARNVIDS_API_ROOT = 'https://earnvidsapi.com/api';
    private const UPNSHARE_API_ROOT = 'https://upnshare.com/api/v1';
    private const CLOUDFLARE_R2_ROOT = 'https://r2.cloudflarestorage.com';

    protected $model;

    public function __construct()
    {
        $this->model = new ThirdPartyApi();
    }

    public function index()
    {
        $title = 'API Access';

        $apis = $this->model->findAll();

        $topBtnGroup = create_top_btn_group([
            'admin/third-party-apis/new' => 'Add API Access'
        ]);

        return view('admin/third_party_apis/list', compact('title', 'apis', 'topBtnGroup'));
    }



    public function new()
    {

        $title = 'Add API Access';
        $tpAPI = new \App\Entities\ThirdPartyApi();

        $topBtnGroup = create_top_btn_group([
            'admin/third-party-apis' => 'Back to API Access'
        ]);

        return view('admin/third_party_apis/new', compact('title', 'tpAPI', 'topBtnGroup'));

    }

    public function edit()
    {
        $title = 'Edit API Access';
        $tpAPI = $this->getApi( $this->request->getGet('id') );
        $topBtnGroup = create_top_btn_group([
            'admin/third-party-apis' => 'Back to API Access'
        ]);
        return view('admin/third_party_apis/edit', compact('title', 'tpAPI', 'topBtnGroup'));

    }

    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $data = $this->request->getPost();
        $data['api_base_url'] = $this->normaliseApiBaseUrl($data['api_base_url'] ?? '', $data['provider'] ?? '');

        if (($data['provider'] ?? '') === 'cloudflare_r2') {
            $errors = $this->r2Errors($data);
            if (! empty($errors)) {
                return redirect()->back()->with('errors', $errors)->withInput();
            }
        } elseif (empty($data['api_token'])) {
            return redirect()->back()
                ->with('errors', ['An API token is required to add a video host.'])
                ->withInput();
        }

        $tpAPI = new \App\Entities\ThirdPartyApi($data);

        if($this->model->insert( $tpAPI )){

            return redirect()->to(admin_url( '/third-party-apis' ))
                            ->with('success', 'Video host API access added successfully');

        }

        return redirect()->back()
                         ->with('errors', $this->model->errors())
                         ->withInput();
    }

    public function update()
    {
        $tpAPI = $this->getApi( $this->request->getGet('id') );
        $data = $this->request->getPost();
        $data['api_base_url'] = $this->normaliseApiBaseUrl($data['api_base_url'] ?? '', $data['provider'] ?? '');

        // Never erase a saved token merely because the masked token field is blank.
        if (empty($data['api_token'])) {
            unset($data['api_token']);
        }
        if (($data['provider'] ?? '') === 'cloudflare_r2') {
            foreach (['r2_access_key_id', 'r2_secret_access_key'] as $field) {
                if (empty($data[$field])) {
                    unset($data[$field]);
                }
            }
            $errors = $this->r2Errors(array_merge($tpAPI->toRawArray(), $data));
            if (! empty($errors)) {
                return redirect()->back()->with('errors', $errors)->withInput();
            }
        }

        $tpAPI->fill($data);

        if($tpAPI->hasChanged()){
            if($this->model->save( $tpAPI )){

                return redirect()->to(admin_url( '/third-party-apis' ))
                                  ->with('success', $tpAPI->name . ' API access updated successfully');
            }else{
                return redirect()->back()
                                 ->with('errors', $this->model->errors())
                                 ->withInput();
            }
        }

        return redirect()->to(admin_url( '/third-party-apis' ));

    }

    public function delete()
    {
        $tpAPI = $this->getApi( $this->request->getGet('id') );

        // Old template-based APIs may still be attached to links. Detach them
        // before deletion so changing API Access never deletes those links.
        db_connect()->table('links')
            ->where('api_id', $tpAPI->id)
            ->update(['api_id' => null]);

        if($this->model->delete( $tpAPI->id )){
            return redirect()->back()
                             ->with('success', $tpAPI->name . ' deleted successfully');
        }

        return redirect()->back()
                         ->with('errors', $this->model->errors())
                         ->withInput();
    }


    protected function getApi($id)
    {
        $api = $this->model->where('id', $id)->first();

        if($api === null){
            throw new PageNotFoundException('Third party API not found');
        }

        return $api;
    }

    /**
     * EarnVids has a fixed API root; only its credential is configurable.
     * Other existing providers retain their stored root for compatibility.
     */
    private function normaliseApiBaseUrl($url, $provider): string
    {
        $url = rtrim(trim((string) $url), '/');

        if ($provider === 'earnvids') {
            return self::EARNVIDS_API_ROOT;
        }

        if ($provider === 'upnshare') {
            return self::UPNSHARE_API_ROOT;
        }

        if ($provider === 'cloudflare_r2') {
            return self::CLOUDFLARE_R2_ROOT;
        }

        return preg_replace('#/file/(?:info|list)$#i', '', $url) ?: $url;
    }

    /** @return array<int, string> */
    private function r2Errors(array $data): array
    {
        $labels = [
            'r2_account_id' => 'Cloudflare account ID',
            'r2_access_key_id' => 'R2 access key ID',
            'r2_secret_access_key' => 'R2 secret access key',
            'r2_bucket' => 'R2 bucket name',
            'r2_public_url' => 'Public bucket URL',
        ];
        $errors = [];
        foreach ($labels as $field => $label) {
            if (empty($data[$field])) {
                $errors[] = $label . ' is required for Cloudflare R2.';
            }
        }
        if (! empty($data['r2_public_url']) && (filter_var($data['r2_public_url'], FILTER_VALIDATE_URL) === false || strpos($data['r2_public_url'], 'https://') !== 0)) {
            $errors[] = 'Public bucket URL must be a valid HTTPS URL.';
        }

        return $errors;
    }

}
