<!-- footer content -->
<footer>

    <div class="pull-left">
    Powered By <a href="https://codenine.biz.id" target="_blank">Codenine</a>
    </div>
    <div class="pull-right">
    VideoHub v<?= get_config('version') ?>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


<?= $this->include('admin/partials/del_confirm') ?>

<!-- jQuery -->
<script src="<?= site_url('/admin-assets/vendors/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?= site_url('/admin-assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?= site_url('/admin-assets/vendors/fastclick/lib/fastclick.js') ?>"></script>
<!-- NProgress -->
<script src="<?= site_url('/admin-assets/vendors/nprogress/nprogress.js') ?>"></script>
<!-- Select2 -->
<script src="<?= site_url('/admin-assets/vendors/select2/dist/js/select2.full.min.js') ?>"></script>
<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<!-- summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


<!-- Custom Theme Scripts -->
<script src="<?= site_url('/admin-assets/js/template.min.js?v=1.2') ?>"></script>
<script src="<?= site_url('/admin-assets/js/custom.js?v=20260906-7') ?>"></script>


<?php $this->renderSection('scripts'); ?>


<script>

    const SITE_URL = '<?= site_url() ?>';
    const BASE_URL = '<?= site_url('/admin') ?>';
    const EMBED_SLUG = '<?= esc( embed_slug() ) ?>';
    const DOWNLOAD_SLUG = '<?= esc( download_slug() ) ?>';
    const VIEW_SLUG = '<?= esc( view_slug() ) ?>';

</script>

</body>
</html>
