<?php $this->extend('admin/__layout/default') ?>

<?php $this->section('content') ?>

<?php
$providerOptions = [
    'adsterra' => 'Adsterra',
    'clickadu' => 'Clickadu',
    'clickadilla' => 'Clickadilla',
    'evadav' => 'Evadav',
    'custom' => 'Custom',
];
?>

<?= form_open('/admin/ads/zode-settings/save', ['method' => 'post', 'class' => 'zode-settings-form']) ?>
<section class="zode-settings-card">
    <div class="zode-settings-card__heading">
        <div>
            <span class="popup-ads-intro__eyebrow">Revenue integration</span>
            <h4>Zode Analytics</h4>
            <p>Save the credentials that will be used to sync today's ad revenue to the dashboard.</p>
        </div>
        <span class="zode-settings-card__state <?= $zodeApiTokenConfigured ? 'is-configured' : '' ?>">
            <i class="fa fa-<?= $zodeApiTokenConfigured ? 'check-circle' : 'plug' ?>"></i>
            <?= $zodeApiTokenConfigured ? 'Credentials saved' : 'Not connected' ?>
        </span>
    </div>
    <div class="zode-settings-card__fields">
        <div class="form-group">
            <label for="zode-id">Zode ID</label>
            <?= form_input([
                'id' => 'zode-id',
                'name' => 'zode_id',
                'class' => 'form-control',
                'value' => $zodeId,
                'maxlength' => 100,
                'placeholder' => 'Enter your Zode ID',
                'autocomplete' => 'off',
            ]) ?>
        </div>
        <div class="form-group">
            <label for="zode-api-token">API token</label>
            <?= form_input([
                'id' => 'zode-api-token',
                'name' => 'zode_api_token',
                'type' => 'password',
                'class' => 'form-control',
                'maxlength' => 255,
                'placeholder' => $zodeApiTokenConfigured ? 'Saved — leave blank to keep it' : 'Paste your API token',
                'autocomplete' => 'new-password',
            ]) ?>
            <small>Your token is never shown again. Leave it blank to keep the saved token.</small>
        </div>
    </div>
    <div class="zode-settings-card__footer">
        <span><i class="fa fa-lock"></i> Used only for the future Zode revenue sync.</span>
        <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Save Zode settings') ?>
    </div>
</section>
<?= form_close() ?>

<?php if ($popupAdUnitsUnavailable): ?>
    <div class="alert alert-warning">
        The Popup Ads table is not visible in this site's active database. Verify <code>php spark migrate</code> was run in the same site directory and with the same database configuration.
    </div>
<?php else: ?>
    <?php if ($popupAdUnitsLoadError): ?>
        <div class="alert alert-warning">
            The Popup Ads table exists, but its saved units could not be loaded. The detailed database error is recorded in <code>writable/logs</code>; you can still add a new unit below.
        </div>
    <?php endif; ?>
    <?= form_open('/admin/ads/popup-units/save', ['method' => 'post', 'id' => 'popup-ad-units-form']) ?>

    <div class="popup-ads-intro">
        <div>
            <span class="popup-ads-intro__eyebrow">Embed page monetization</span>
            <h4>Popup Ad Networks</h4>
            <p>Add each network separately. Only one active network script is selected for a visitor, based on its rotation weight.</p>
        </div>
        <div class="popup-ads-intro__limit">
            <i class="fa fa-shield"></i>
            <span>One popup per visitor per day</span>
        </div>
    </div>

    <?php if (! empty($popAds)): ?>
        <div class="alert alert-info popup-legacy-note">
            Your legacy Pop Ads code remains as a fallback. It stops loading automatically when at least one managed popup unit is active.
        </div>
    <?php endif; ?>

    <div id="popup-ad-units" class="popup-ad-units">
        <?php foreach ($popupAdUnits as $unit): ?>
            <?php $key = 'unit_' . $unit['id']; ?>
            <article class="popup-ad-unit" data-popup-unit>
                <div class="popup-ad-unit__header">
                    <div class="popup-ad-unit__title">
                        <span class="popup-ad-unit__provider"><?= esc($providerOptions[$unit['provider']] ?? 'Custom') ?></span>
                        <strong><?= esc($unit['name']) ?></strong>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger popup-ad-unit__remove" data-remove-popup-unit>
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>

                <?= form_hidden("popup_units[{$key}][id]", $unit['id']) ?>
                <div class="popup-ad-unit__fields">
                    <div class="form-group">
                        <label>Network</label>
                        <?= form_dropdown([
                            'name' => "popup_units[{$key}][provider]",
                            'class' => 'form-control popup-ad-provider',
                            'options' => $providerOptions,
                            'selected' => $unit['provider'],
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label>Display name</label>
                        <?= form_input([
                            'name' => "popup_units[{$key}][name]",
                            'class' => 'form-control popup-ad-name',
                            'value' => $unit['name'],
                            'maxlength' => 100,
                            'placeholder' => 'Example: Adsterra Popunder',
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label>Rotation weight</label>
                        <?= form_input([
                            'name' => "popup_units[{$key}][weight]",
                            'type' => 'number',
                            'class' => 'form-control',
                            'value' => $unit['weight'],
                            'min' => 1,
                            'max' => 100,
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <?= form_dropdown([
                            'name' => "popup_units[{$key}][status]",
                            'class' => 'form-control',
                            'options' => ['active' => 'Active', 'paused' => 'Paused'],
                            'selected' => $unit['status'],
                        ]) ?>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label>Network ad code</label>
                    <?= form_textarea([
                        'name' => "popup_units[{$key}][ad_code]",
                        'class' => 'form-control popup-ad-code',
                        'rows' => 7,
                        'placeholder' => 'Paste the code supplied by this ad network',
                    ], $unit['ad_code']) ?>
                    <small>Paste only one network code per unit. The loader chooses one active unit and keeps the other scripts from competing.</small>
                </div>
            </article>
        <?php endforeach; ?>
    </div>

    <div id="popup-ad-removals"></div>

    <div class="popup-ad-actions">
        <button type="button" class="btn btn-light" id="add-popup-ad-unit">
            <i class="fa fa-plus"></i> Add ad network
        </button>
        <?= form_button([
            'type' => 'submit',
            'class' => 'btn btn-primary',
        ], 'Save popup ads') ?>
    </div>

    <?= form_close() ?>

    <template id="popup-ad-unit-template">
        <article class="popup-ad-unit" data-popup-unit>
            <div class="popup-ad-unit__header">
                <div class="popup-ad-unit__title">
                    <span class="popup-ad-unit__provider">New network</span>
                    <strong>New popup ad</strong>
                </div>
                <button type="button" class="btn btn-sm btn-danger popup-ad-unit__remove" data-remove-popup-unit>
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
            <div class="popup-ad-unit__fields">
                <div class="form-group">
                    <label>Network</label>
                    <select name="popup_units[__KEY__][provider]" class="form-control popup-ad-provider">
                        <option value="adsterra">Adsterra</option>
                        <option value="clickadu">Clickadu</option>
                        <option value="clickadilla">Clickadilla</option>
                        <option value="evadav">Evadav</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Display name</label>
                    <input type="text" name="popup_units[__KEY__][name]" class="form-control popup-ad-name" maxlength="100" placeholder="Example: Adsterra Popunder">
                </div>
                <div class="form-group">
                    <label>Rotation weight</label>
                    <input type="number" name="popup_units[__KEY__][weight]" class="form-control" value="1" min="1" max="100">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="popup_units[__KEY__][status]" class="form-control">
                        <option value="active">Active</option>
                        <option value="paused">Paused</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Network ad code</label>
                <textarea name="popup_units[__KEY__][ad_code]" class="form-control popup-ad-code" rows="7" placeholder="Paste the code supplied by this ad network"></textarea>
                <small>Paste only one network code per unit. The loader chooses one active unit and keeps the other scripts from competing.</small>
            </div>
        </article>
    </template>

    <script>
    (function () {
        var list = document.getElementById('popup-ad-units');
        var template = document.getElementById('popup-ad-unit-template');
        var removals = document.getElementById('popup-ad-removals');
        var counter = <?= count($popupAdUnits) ?>;

        document.getElementById('add-popup-ad-unit').addEventListener('click', function () {
            counter += 1;
            list.insertAdjacentHTML('beforeend', template.innerHTML.replace(/__KEY__/g, 'new_' + counter));
        });

        document.addEventListener('click', function (event) {
            var removeButton = event.target.closest('[data-remove-popup-unit]');
            if (! removeButton) return;

            var unit = removeButton.closest('[data-popup-unit]');
            var id = unit.querySelector('input[name$="[id]"]');
            if (id && id.value) {
                var removed = document.createElement('input');
                removed.type = 'hidden';
                removed.name = 'remove_popup_units[]';
                removed.value = id.value;
                removals.appendChild(removed);
            }
            unit.remove();
        });

        document.addEventListener('input', function (event) {
            if (! event.target.matches('.popup-ad-name')) return;
            event.target.closest('[data-popup-unit]').querySelector('.popup-ad-unit__title strong').textContent = event.target.value || 'New popup ad';
        });

        document.addEventListener('change', function (event) {
            if (! event.target.matches('.popup-ad-provider')) return;
            event.target.closest('[data-popup-unit]').querySelector('.popup-ad-unit__provider').textContent = event.target.options[event.target.selectedIndex].text;
        });
    })();
    </script>
<?php endif; ?>

<?php $this->endSection() ?>
