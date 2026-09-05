<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class LinkModel
 * @package App\Models
 * @author John Antonio
 */
class LinkModel extends Model
{
    protected $table = 'links';
    protected $allowedFields = [
        'movie_id', 'api_id', 'link', 'resolution', 'quality', 'size_val', 'size_lbl', 'type',
        'host_priority', 'failure_count', 'last_checked_at', 'last_success_at', 'last_failure_at',
        'last_error', 'last_served_at', 'upnshare_video_id'
    ];
    protected $validationRules = [
        'movie_id' => 'required|is_natural_no_zero|exist[movies.id]',
        'api_id' => 'permit_empty|is_natural_no_zero|exist[third_party_apis.id]',
        'link' => 'required|valid_url',
        'type' => 'permit_empty|in_list[stream,direct_download,torrent_download]',
        'host_priority' => 'permit_empty|integer',
        'size_val' => 'permit_empty|numeric',
        'size_lbl' => 'permit_empty|in_list[MB,GB]',
    ];
    protected $returnType = 'App\Entities\Link';
    protected $useTimestamps = true;


    /**
     * Find links by movie (or episode) id
     * @param int $movieId
     * @param string|null $type stream, direct_download, torrent_download
     * @param bool $withBroken
     * @return array|object|null
     */
    public function findByMovieId(int $movieId, ?string $type = null, bool $withBroken = true)
    {
        if(empty( $movieId ))
            return null;

        if(! empty($type)) {
            $this->where('type', $type);
        }

        if(! $withBroken){
            $this->where('is_broken', 0);
        }

        // A link that has not been served recently gets the next turn. This keeps
        // traffic distributed across healthy streaming hosts instead of always
        // favouring the most recently-added link.
        $this->orderBy('host_priority', 'desc')
             ->orderBy('last_served_at', 'asc')
             ->orderBy('id', 'asc');
        return $this->where('movie_id', $movieId)
                    ->find();
    }

    /**
     * Clean empty links by movie id and links ids
     * @param int $movieId
     * @param array $skipIds
     */
    public function clean(int $movieId, array $skipIds = [])
    {
        if(!empty( $skipIds )) {
            $this->whereNotIn('id', $skipIds);
        }
        $this->where('movie_id', $movieId)
             ->delete();
    }

    /**
     * Update link requests
     * @param $linkId
     */
    public function updateRequests( $linkId )
    {
        try{
            $this->set('requests', 'requests + 1', FALSE)
                 ->protect(false)
                 ->update($linkId);
        }catch (\ReflectionException $e) {}
    }

    /**
     * report link
     * @param int $linkId
     * @param bool $notWorking
     */
    public function report(int $linkId, bool $notWorking = true )
    {
        try{

            if($notWorking){
                $this->set('reports_not_working', 'reports_not_working + 1', FALSE);
            }else{
                $this->set('reports_wrong_link', 'reports_wrong_link + 1', FALSE);
            }

            $this->protect(false)
                 ->update( $linkId );

        }catch (\ReflectionException $e) {}
    }

    /**
     * Reset link reports
     * @param int $linkId
     * @return bool
     */
    public function resetReports(int $linkId ): bool
    {
        try{
            return $this->set('reports_not_working', 0)
                        ->set('reports_wrong_link', 0)
                        ->protect(false)
                        ->update( $linkId );
        }catch (\ReflectionException $e) {}
        return false;
    }

    /**
     * Select broken links
     * @param bool $st
     * @return $this
     */
    public function broken(bool $st = true): LinkModel
    {
        $st = (int) $st;
        $this->where('is_broken', $st);
        return $this;
    }



    /**
     * Link reported
     * @return $this
     */
    public function reported(): LinkModel
    {
        $this->where('reports_wrong_link > ', 0);
        $this->orWhere('reports_not_working > ', 0);
        return $this;
    }

    /**
     * Get link by ID
     * @param int $id
     * @return array|object|null
     */
    public function getLink(int $id )
    {
        return $this->where('id', $id)
                    ->first();
    }

    public function movies()
    {
        $this->join('movies', 'movies.id = links.movie_id', 'LEFT')
             ->where('movies.type', 'movie');

        return $this;
    }

    public function episodes()
    {
        $this->join('movies', 'movies.id = links.movie_id', 'LEFT')
             ->where('movies.type', 'episode');

        return $this;
    }




}
