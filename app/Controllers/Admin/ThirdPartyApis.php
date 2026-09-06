<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ThirdPartyApi;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Model;


class ThirdPartyApis extends BaseController
{

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

        if (empty($data['api_token'])) {
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

        // Never erase a saved token merely because the masked token field is blank.
        if (empty($data['api_token'])) {
            unset($data['api_token']);
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

}
