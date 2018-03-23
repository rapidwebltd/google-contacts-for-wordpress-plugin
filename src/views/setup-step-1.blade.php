<div class="wrap">

<h1>Google Contacts for WordPress</h1>

<h2>Setup Step 1 - Register application</h2>

<p>Go to the following URL to setup a new or existing project. When asked about credentials, you should setup OAuth credentials.</p>

<p>
    <a target="_blank" rel="noopener noreferrer" href="https://console.developers.google.com/start/api?id=people.googleapis.com&credential=client_key">
        https://console.developers.google.com/start/api?id=people.googleapis.com&credential=client_key
    </a>
</p>

<p>When done, enter the Client ID and Client Secret below.</p>

<form method="POST" action="/wp-admin/admin-post.php">
    <p>Client ID: <input name="client_id" value="{{ $clientId }}"/></p>
    <p>Client Secret: <input name="client_secret" value="{{ $clientSecret }}"/></p>
    <input type="submit" value="Next >" />
    <input type="hidden" name="action" value="gcfw_update_client_id_and_secret" />
</form>

</div>