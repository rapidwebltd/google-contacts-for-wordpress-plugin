<div class="wrap">

<h1>Google Contacts for WordPress</h1>

<h2>Setup Step 2 - Link Google Account</h2>

<p>To link your Google account with this plugin, please click the link below.</p>
<p>You should sign in with the Google account you wish to store the Google Contacts in.</p>

<p><a target="_blank" rel="noopener noreferrer" href="{{ $authUrl }}">{{ $authUrl }}</a></p>

<p>When done, enter the provided auth code below.</p>

<form method="POST" action="/wp-admin/admin-post.php">
    <p>Auth Code: <input name="auth_code" value=""/></p>
    <input type="submit" value="Next >" />
    <input type="hidden" name="action" value="gcfw_update_refresh_token" />
</form>

</div>