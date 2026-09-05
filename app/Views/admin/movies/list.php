<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<div class="x_content">
    <div>
        <div class="group-selection  d-none ve-results--filter" >
            <label class="control-label" for="first-name">Filter:
            </label>
            <?= form_dropdown([
                    'class' => 'form-control',
                    'onchange' => 'filter_movie_results(this.value)',
                    'options' => [
                            'all' => 'All',
                            'with_st_links' => 'Have Stream Links',
                            'without_st_links' => 'Haven\'t Stream Links',
                            'with_dl_links' => 'Have Download Links',
                            'without_dl_links' => 'Haven\'t Download Links'
                    ],
                    'selected' => $filter ?? ''
            ]) ?>
        </div>

    </div>

</div>

<div class="x_panel">
    <div class="card-box table-responsive">

        <table id="movies-list-datatable" class="table text-center table-striped table-bordered data-list-table " style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Name</th>
                <th>IMDB Id</th>
                <th>TMDB Id</th>
                <th>Year</th>
                <th>Imdb Rate</th>
                <th>Views</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>


            <tbody>

            <?php foreach ($movies as $movie) : ?>
                <tr>
                    <td> <?= $movie->id ?> </td>
                    <td style="width: 75px">
                        <a href="<?= $movie->getViewLink(true) ?>" target="_blank">
                            <img src=" <?= poster_uri( $movie->poster ) ?> " height="75" alt="poster">
                        </a>
                    </td>
                    <td class="text-left"> <b> <?= esc( $movie->title ) ?> </b> </td>
                    <td>
                        <a href="https://www.imdb.com/title/<?=$movie->imdb_id?>" target="_blank">
                            <?= esc( $movie->imdb_id ) ?>
                        </a>
                    </td>
                    <td> <a href="javascript:void(0)"> <?= esc( $movie->tmdb_id ) ?> </a> </td>
                    <td> <?= $movie->year ?> </td>
                    <td> <?= $movie->imdb_rate ?> </td>
                    <td> <?= number_format( $movie->views ) ?> </td>
                    <td> <?= format_date_time( $movie->created_at ) ?> </td>
                    <td> <?= format_date_time( $movie->updated_at ) ?> </td>
                    <td>
                        <a href="<?= admin_url("/movies/edit/{$movie->id}") ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="javascript:void(0)" data-url="<?= admin_url("/movies/delete/{$movie->id}") ?>" class="btn btn-sm btn-danger del-item">Del</a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>



<?php $this->section('scripts'); ?>

<!-- Datatables -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<?php $this->endSection(); ?>
