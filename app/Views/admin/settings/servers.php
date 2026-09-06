<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<div class="row">
    <div class="col-xl-10">

        <?= form_open('/admin/settings/servers/update', ['method'=>'post']) ?>

        <div class="x_panel server-settings-panel">
            <div class="x_title">
                <h2>Server directory <small>Display names and playback priority</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <?php if(! empty($servers)): ?>

                <p class="server-settings-intro">Manage the display name used for each video host. Deleting a display name never removes its existing movie links.</p>

                <div class="server-settings-default">
                    <div>
                        <span class="server-settings-eyebrow">Playback preference</span>
                        <h3>Default server</h3>
                        <p>Choose the preferred server shown first when multiple links are available.</p>
                    </div>
                    <div class="server-settings-default__field">

                       <?= form_dropdown([
                               'name' => 'default_server',
                                'class' => 'form-control',
                                'options' => $serverOptions,
                                'selected' => get_config('default_server')
                       ]) ?>

                    </div>
                </div>

                <div class="server-table-wrap">
                    <table class="table server-settings-table">
                        <thead>
                            <tr>
                                <th>Host</th>
                                <th>Display name</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($servers as $key => $val) : ?>
                        <?php $serverName = $val !== '' ? $val : $key; ?>
                        <tr data-server-row>
                            <td>
                                <strong><?= esc($key) ?></strong>
                                <?php if (get_config('default_server') === $serverName): ?>
                                    <span class="server-default-badge"><i class="fa fa-star"></i> Default</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= form_input([
                                    'name' => "renamed_servers[$key]",
                                    'class' => 'form-control server-alias-input',
                                    'data-server-alias' => 'true',
                                    'placeholder' => 'Use host name',
                                    'readonly' => 'readonly',
                                    'value' => $val
                                ]) ?>
                            </td>
                            <td class="text-right server-row-actions">
                                <button class="btn btn-sm btn-outline-primary" type="button" data-server-edit><i class="fa fa-pencil"></i> Edit</button>
                                <button class="btn btn-sm btn-outline-danger" type="button" data-server-delete><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-right server-settings-actions">
                    <?= form_button([
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], 'Save changes') ?>
                </div>

                <?php else: ?>
                     servers not found yet
                <?php endif; ?>



            </div>
        </div>

        <?= form_close() ?>

    </div>
</div>

<?php $this->endSection() ?>

<?php $this->section('scripts') ?>
<script>
document.addEventListener('click', function (event) {
    var editButton = event.target.closest('[data-server-edit]');
    var deleteButton = event.target.closest('[data-server-delete]');
    var button = editButton || deleteButton;

    if (!button) {
        return;
    }

    var row = button.closest('[data-server-row]');
    var input = row.querySelector('[data-server-alias]');

    if (editButton) {
        input.removeAttribute('readonly');
        input.focus();
        input.select();
        row.classList.add('is-editing');
        return;
    }

    if (window.confirm('Delete this display name? Existing video links will remain available.')) {
        input.removeAttribute('readonly');
        input.value = '';
        row.classList.add('is-cleared');
        input.focus();
    }
});
</script>
<?php $this->endSection() ?>
