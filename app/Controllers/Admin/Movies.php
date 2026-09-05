<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Movie;
use App\Models\GenreModel;
use App\Models\LinkModel;
use App\Models\Translations\MovieTranslationsModel;
use CodeIgniter\Model;


class Movies extends BaseController
{

    protected $model;
    protected $translation;

    public function __construct()
    {
        $this->model = new \App\Models\MovieModel();

        if(get_config('is_multi_lang')) {
            $this->translation = new MovieTranslationsModel();
        }

    }

    public function index()
    {

        $type = class_basename($this) != 'Episodes' ? 'movie' : 'episode';
        $isMovie = $type == 'movie';

        $title = $isMovie ? 'Videos' : 'Episodes';

        $filter = $this->request->getGet('filter');
        $allowedFilters = [
            'with_st_links',
            'without_st_links',
            'with_dl_links',
            'without_dl_links'
        ];

        if(in_array($filter, $allowedFilters)){

            $linkType = '';

            if($filter == 'with_st_links' || $filter == 'without_st_links')
                $linkType = 'stream';

            if($filter == 'with_dl_links' || $filter == 'without_dl_links')
                $linkType = 'download';

            if($filter == 'with_st_links' || $filter == 'with_dl_links')
                $this->model->notEmptyLinks( $linkType );

            if($filter == 'without_st_links' || $filter == 'without_dl_links')
                $this->model->emptyLinks( $linkType );

        }

        $movies = $this->model->where('type', $type)
                              ->orderBy('id', 'desc')
                              ->findAll();



        if( $isMovie ){

            $topBtnGroup = create_top_btn_group([
                'admin/movies/new' => 'Add Video'
            ]);

        }else{

            $topBtnGroup = create_top_btn_group([
                'admin/episodes/new' => 'Add Episode'
            ]);

        }

        $title .= ' - ( ' . count( $movies ) . ' )';

        $data = [
            'title' => $title,
            'movies' => $movies,
            'filter' => $filter,
            'topBtnGroup' => $topBtnGroup
        ];
        return view('admin/movies/list', $data);
    }

    public function new()
    {
        $title = 'New Video';
        $translations = null;

        $topBtnGroup = create_top_btn_group([
            'admin/movies' => 'Back to videos'
        ]);

        $genreModel = new GenreModel();
        $genres = $genreModel->asArray()->findAll();

        $movie = new Movie();
        $movie->imdb_id = $this->request->getGet('imdb');
        $movie->tmdb_id = $this->request->getGet('tmdb');
        $movie->type = 'movie';

        if( is_multi_languages_enabled() ){

            //Translations
            $translations = $this->translation->getDummyList();

        }

        $data = compact('title', 'movie', 'genres', 'translations', 'topBtnGroup');
        return view('admin/movies/new', $data);
    }

    public function edit($id)
    {
        $title = 'Edit Video';
        $movie = $this->getMovie($id);
        $translations = null;

        if($movie->isEpisode()) {
            return redirect()->to("/admin/episodes/edit/{$id}");
        }

        $nextMovie = $this->model->getNextMovie( $id );


        $genreModel = new GenreModel();
        $genres = $genreModel->asArray()->findAll();

        $linkModel = new LinkModel();
        $directDownloadLinks = $linkModel->findByMovieId( $id, 'direct_download');
        $torrentDownloadLinks = $linkModel->findByMovieId( $id, 'torrent_download');
        $streamLinks = $linkModel->findByMovieId( $id, 'stream' );

       if( is_multi_languages_enabled() ){

           //Translations
           $translations = $this->translation->findByMovieId( $id );

       }


        $topBtnGroup = create_top_btn_group([
            'admin/movies/new' => 'New Video',
            'admin/movies' => 'Back to Videos'
        ]);

        $data = compact('title', 'movie', 'nextMovie', 'genres', 'directDownloadLinks', 'torrentDownloadLinks',
            'streamLinks', 'translations', 'topBtnGroup');

        return view('admin/movies/edit', $data);
    }

    public function create()
    {
        $warningAlerts = [];

        if($this->request->getMethod() == 'post'){
            //create movie entity
            $movie = new Movie( $this->request->getPost() );

            if(! is_media_download_to_server()){
                $movie->banner = $movie->banner_url;
            }


            //attempt to save data
            if($this->model->saveMovie( $movie )) {
                $movie = $this->getMovie( $this->model->getInsertID() );

                //add genres
                $this->model->addGenres(
                    $movie->id,
                    $this->request->getPost( 'genres' )
                );

                //add translations
                if( is_multi_languages_enabled() ){

                    $this->model->addTranslations(
                        $movie->id,
                        $this->request->getPost( 'translations' )
                    );

                }

                //save media files
                if( is_media_download_to_server() ){
                    $this->saveMediaFiles( $movie );
                }

                //save links
                $this->saveLinks( $movie );

                if($this->validator !== null) {
                    $warningAlerts = $this->validator->getErrors();
                }

                return redirect()->to('/admin/movies/edit/' . $movie->id)
                                 ->with('warning', $warningAlerts)
                                 ->with('success', 'movie saved successfully');

            }else{
                return redirect()->back()
                                 ->with('errors', $this->model->errors())
                                 ->withInput();
            }
        }
    }

    public function update( $id )
    {
        if($this->request->getMethod() == 'post') {
            $movie = $this->getMovie($id);
            $updatedData = $this->request->getPost([
                'title',
                'description',
                'imdb_id',
                'tmdb_id',
                'duration',
                'series_id',
                'season',
                'imdb_rate',
                'quality',
                'episode',
                'released_at',
                'trailer',
                'country',
                'language',
                'meta_keywords',
                'meta_description',
                'status'
            ]);

            if(! is_media_download_to_server()){
                if(! empty( $this->request->getPost('banner_url') )){
                    $movie->banner = $this->request->getPost('banner_url');
                }
            }

            $movie->fill( $updatedData );

            //attempt to save movie
            if(! $this->model->saveMovie($movie)) {
                return redirect()->back()
                    ->with('errors', $this->model->errors())
                    ->withInput();
            }

            //add or update genres
            $this->model->addGenres(
                $movie->id,
                $this->request->getPost( 'genres' )
            );

            // save translations
            if( is_multi_languages_enabled() ){

                $this->model->addTranslations(
                    $movie->id,
                    $this->request->getPost( 'translations' )
                );

            }

            // save media files
            if(is_media_download_to_server()){
                $this->saveMediaFiles( $movie );
            }

            // save links
            $this->saveLinks( $movie );

            $warningAlerts = $this->validator !== null ? $this->validator->getErrors() : [];

            return redirect()->back()
                             ->with('warning', $warningAlerts)
                             ->with('success', 'Movie updated successfully.');
        }
    }

    public function delete( $id )
    {
        $movie = $this->getMovie( $id );

        if($this->model->delete( $movie->id )) {

            $redirect = $movie->isEpisode() ? '/episodes' : '/movies';

            return redirect()->to("/admin/{$redirect}")
                             ->with('success', "{$movie->title} movie deleted successfully" );
        }else{
            return redirect()->back()
                ->with('errors', "{$movie->title} movie unable to deleted" );
        }

    }


    protected function saveMediaFiles(\App\Entities\Movie $movie)
    {
        $imageValidationRules = [];

        $bannerFile = $this->request->getFile('banner_file');

        $bannerUrl = $this->request->getPost('banner_url');

        if(! $bannerFile->isValid()) $bannerFile = null;

        if($bannerFile !== null) {
            $imageValidationRules['banner_file'] =[
                'label' => 'banner image',
                'rules' => 'uploaded[banner_file]'
                    . '|is_image[banner_file]'
                    . '|mime_in[banner_file,image/jpg,image/jpeg,image/png]'
                    . '|max_size[banner_file,4096]'
            ];
        }

        if(! empty($imageValidationRules) ) {

            $this->validate( $imageValidationRules );

            if($this->validator->hasError('banner_file'))
                $bannerFile = null;

        }



        if(! empty($bannerUrl)){
            helper('remote_download');
            if($filepath =  download_image( $bannerUrl )){
                $bannerFile = new \CodeIgniter\Files\File( $filepath );
            }
        }


        if($bannerFile !== null){
            //remote old banner file if exist
            $movie->addBanner( $bannerFile );
        }


        if($movie->hasChanged()) {
            $this->model->save($movie);
        }



    }

    protected function saveLinks(\App\Entities\Movie $movie)
    {
        $linkGroups = [
            'st_links' => 'stream',
            'direct_dl_links' => 'direct_download',
            'torrent_dl_links' => 'torrent_download',
        ];

        foreach ($linkGroups as $inputName => $type) {
            $links = $this->request->getPost($inputName);
            if (is_array($links)) {
                $this->model->addLinks($movie->id, $links, $type);
            }
        }

    }



    protected function getMovie($id) : \App\Entities\Movie
    {
        $movie = $this->model->getMovie($id);
        if($movie == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid movie Id ' . $id);
        }
        return $movie;
    }



}
