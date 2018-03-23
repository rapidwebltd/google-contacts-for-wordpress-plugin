<div class="wrap">

<h1>{{ __('Google Contacts for WordPress', $td) }}</h1>

<h2>{{ __('Setup Step 3 - Create Google Contacts for existing WordPress Users', $td) }}</h2>

<p>{{ __('The final step is to bulk create Google Contacts from all your existing WordPress users.', $td) }}</p>

<p>{{ __('You can click the button below to do so. Please be aware, this may take some time if you have many users.', $td) }}</p>

<form method="POST" action="/wp-admin/admin-post.php">
    <input type="submit" value="{{ __('Finish', $td) }}" />
    <input type="hidden" name="action" value="gcfw_bulk_create_contacts" />
</form>

</div>