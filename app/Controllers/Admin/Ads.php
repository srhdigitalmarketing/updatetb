<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdsModel;
use App\Models\PopupAdUnitModel;

class Ads extends BaseController
{

    protected $model;
    protected $popupAdModel;

    public function __construct()
    {
        $this->model = new AdsModel();
        $this->popupAdModel = new PopupAdUnitModel();
    }

    public function index()
    {
        //
    }

    public function home_page()
    {
        $title = 'Ads - Home Page ';

        $ads = $this->model->where('page', 'home')
                           ->findAll();

        $topAd = $ads['home.banner.top'] ?? '';
        $playerRightAd = $ads['home.banner.player-right'] ?? '';
        $playerBottomAd = $ads['home.banner.player-bottom'] ?? '';
        $popAds = $ads['home.popad'] ?? '';


        $data = compact('title', 'topAd', 'playerRightAd', 'playerBottomAd', 'popAds');

        return view('admin/ads/home', $data);
    }

    public function embed_page()
    {
        $title = 'Ads - Embed Page ';

        $ads = $this->model->where('page', 'embed')
            ->findAll();

        $popAds = $ads['embed.popad'] ?? '';

        $popupAdUnits = [];
        $popupAdUnitsUnavailable = false;
        try {
            $popupAdUnits = $this->popupAdModel
                ->where('page', 'embed')
                ->orderBy('id', 'ASC')
                ->findAll();
        } catch (\Throwable $exception) {
            $popupAdUnitsUnavailable = true;
        }

        $data = compact('title', 'popAds', 'popupAdUnits', 'popupAdUnitsUnavailable');

        return view('admin/ads/embed', $data);
    }

    public function view_page()
    {
        $title = 'Ads - View Page ';

        $ads = $this->model->where('page', 'view')
            ->findAll();

        $playerTopAd = $ads['view.banner.player-top'] ?? '';
        $playerBottomAd = $ads['view.banner.player-bottom'] ?? '';
        $playerSidebarAd = $ads['view.banner.sidebar'] ?? '';
        $popAds = $ads['view.popad'] ?? '';

        $data = compact('title', 'playerTopAd',  'playerBottomAd','playerSidebarAd', 'popAds');

        return view('admin/ads/view', $data);
    }

    public function download_page()
    {
        $title = 'Ads - Download Page ';

        $ads = $this->model->where('page', 'download')
                           ->findAll();

        $playerTopAd = $ads['download.banner.title-bottom'] ?? '';
        $playerBottomAd = $ads['download.banner.links-group-middle'] ?? '';
        $popAds = $ads['download.popad'] ?? '';

        $data = compact('title', 'playerTopAd',  'playerBottomAd', 'popAds');

        return view('admin/ads/download', $data);
    }


    public function link_page()
    {
        $title = 'Ads - Link Page ';

        $ads = $this->model->where('page', 'link')
            ->findAll();

        $counterTop = $ads['link.banner.counter-top'] ?? '';
        $counterBottom = $ads['link.banner.counter-bottom'] ?? '';
        $popAds = $ads['link.popad'] ?? '';

        $data = compact('title', 'counterTop',  'counterBottom', 'popAds');

        return view('admin/ads/link', $data);
    }

    public function update()
    {
        $data = $this->request->getPost();
        $ads = $data['ads'] ?? [];

        if(! empty($ads)) {
            foreach ($ads as $key => $val) {

                if(empty($val['id']))
                    continue;

                $ad = $this->model->where('id', $val['id'])
                                  ->first();

                if($ad !== null){

                    $val['ad_code'] = base64_encode( $val['ad_code'] );
                    $ad->fill( $val );


                    if($ad->hasChanged()){

                        $this->model->save( $ad);

                    }

                }

            }
        }


        return redirect()->back()
                         ->with('success', 'data updated successfully');


    }

    public function save_popup_units()
    {
        $providers = ['adsterra', 'clickadu', 'clickadilla', 'evadav', 'custom'];
        $units = $this->request->getPost('popup_units') ?? [];
        $removeIds = $this->request->getPost('remove_popup_units') ?? [];

        if (! is_array($units) || count($units) > 20) {
            return redirect()->back()
                ->with('errors', ['You can save a maximum of 20 popup ad units at once.'])
                ->withInput();
        }

        try {
            foreach ((array) $removeIds as $id) {
                $id = (int) $id;
                if ($id < 1) {
                    continue;
                }

                $unit = $this->popupAdModel
                    ->where('page', 'embed')
                    ->find($id);

                if ($unit !== null) {
                    $this->popupAdModel->delete($id);
                }
            }

            foreach ($units as $unitData) {
                if (! is_array($unitData)) {
                    continue;
                }

                $id = (int) ($unitData['id'] ?? 0);
                $provider = strtolower(trim((string) ($unitData['provider'] ?? 'custom')));
                $name = trim((string) ($unitData['name'] ?? ''));
                $code = trim((string) ($unitData['ad_code'] ?? ''));

                if ($id < 1 && $code === '') {
                    continue;
                }

                if (! in_array($provider, $providers, true) || $code === '') {
                    return redirect()->back()
                        ->with('errors', ['Every popup ad needs a supported network and its ad code.'])
                        ->withInput();
                }

                $data = [
                    'page' => 'embed',
                    'provider' => $provider,
                    'name' => $name !== '' ? substr($name, 0, 100) : ucfirst($provider),
                    'ad_code' => $code,
                    'weight' => max(1, min(100, (int) ($unitData['weight'] ?? 1))),
                    'status' => ($unitData['status'] ?? 'paused') === 'active' ? 'active' : 'paused',
                ];

                if ($id > 0) {
                    $existing = $this->popupAdModel
                        ->where('page', 'embed')
                        ->find($id);

                    if ($existing === null) {
                        continue;
                    }

                    $data['id'] = $id;
                }

                $this->popupAdModel->save($data);
            }
        } catch (\Throwable $exception) {
            return redirect()->back()
                ->with('errors', ['Popup ad units could not be saved. Run the database migration first.'])
                ->withInput();
        }

        return redirect()->back()
            ->with('success', 'Popup ad units updated successfully.');
    }



}
