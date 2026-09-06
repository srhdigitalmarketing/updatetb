


<?php
$providerOptions = [
    'upnshare' => 'UPNShare',
    'vidhide' => 'Vidhide',
    'xvideosharing' => 'XVideoSharing compatible',
    'custom' => 'Custom host',
];
$isExisting = ! empty($tpAPI->id);
$tokenAttributes = [
    'id' => 'host-api-token',
    'type' => 'password',
    'name' => 'api_token',
    'class' => 'form-control',
    'value' => '',
    'placeholder' => $isExisting && ! empty($tpAPI->api_token) ? 'Saved — leave blank to keep the current token' : 'Paste the API token supplied by the host',
    'maxlength' => 255,
    'autocomplete' => 'new-password',
];
if (! $isExisting) {
    $tokenAttributes['required'] = 'required';
}
?>

<div class="x_panel host-api-form-panel">
    <div class="x_content">
        <div class="host-api-form-grid">
            <div class="form-group">
                <label class="control-label" for="host-api-name">Display name</label>
                <?= form_input([
                    'id' => 'host-api-name',
                    'name' => 'name',
                    'class' => 'form-control',
                    'value' => old('name', $tpAPI->name),
                    'placeholder' => 'Example: Primary Vidhide',
                    'maxlength' => 128,
                    'required' => 'required',
                ]) ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="host-api-provider">Provider</label>
                <?= form_dropdown([
                    'id' => 'host-api-provider',
                    'name' => 'provider',
                    'class' => 'form-control',
                    'options' => $providerOptions,
                    'selected' => old('provider', $tpAPI->provider ?: 'vidhide'),
                ]) ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label" for="host-api-base-url">API base URL</label>
            <?= form_input([
                'id' => 'host-api-base-url',
                'type' => 'url',
                'name' => 'api_base_url',
                'class' => 'form-control',
                'value' => old('api_base_url', $tpAPI->api_base_url),
                'placeholder' => 'Example: https://vidhideapi.com/api',
                'maxlength' => 255,
                'required' => 'required',
            ]) ?>
            <small>Enter either the host URL or its API root. The system automatically checks the standard <code>/api/file/list</code> title-search endpoint.</small>
        </div>

        <div class="form-group">
            <label class="control-label" for="host-api-token">API token</label>
            <?= form_input($tokenAttributes) ?>
            <small>The token is never displayed after it has been saved.</small>
        </div>

        <div class="host-api-permissions">
            <span class="host-api-permissions__label">Enabled data scopes</span>
            <span><i class="fa fa-check-circle"></i> Video direct link</span>
            <span><i class="fa fa-check-circle"></i> Poster image</span>
            <small>No movie metadata, series metadata, or automatic link templates are used.</small>
        </div>

        <div class="form-group host-api-status">
            <?= form_label('Status', 'host-api-status', ['class' => 'control-label']) ?>
            <?= form_dropdown([
                'id' => 'host-api-status',
                'name' => 'status',
                'options' => ['active' => 'Active', 'paused' => 'Paused'],
                'selected' => old('status', $tpAPI->status ?: 'active'),
                'class' => 'form-control',
            ]) ?>
        </div>
    </div>
</div>

<div class="text-right">
    <button type="submit" class="btn btn-primary d-inline-block px-5">Save API access</button>
</div>
