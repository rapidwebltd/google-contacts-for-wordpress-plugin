<div class="wrap">

<h1>{{ __('Google Contacts for WordPress', $td) }}</h1>

<h2>{{ __('Setup Step 1 - Register application', $td) }}</h2>

<p>{{ __('Go to the following URL to setup a new or existing project. When asked about credentials, you should setup OAuth credentials.', $td) }}</p>

<p>
    <a target="_blank" rel="noopener noreferrer" href="https://console.developers.google.com/start/api?id=people.googleapis.com&credential=client_key">
        https://console.developers.google.com/start/api?id=people.googleapis.com&credential=client_key
    </a>
</p>

<p>{{ __('When done, enter the Client ID and Client Secret below.', $td) }}</p>

<form method="POST" action="/wp-admin/admin-post.php">
	<table>
		<tr>
			<td>{{ __('Client ID:', $td) }} </td>
			<td><input name="client_id" class="regular-text" value="{{ $clientId }}"/></td>
		</tr>
		<tr>
			<td>{{ __('Client Secret:', $td) }}</td>
			<td><input name="client_secret" class="regular-text" value="{{ $clientSecret }}"/></td>
		</tr>
	</table>
	<br>
    <input type="submit" class="button-secondary" value="{{ __('Next step', $td) }}" />
    <input type="hidden" name="action" value="gcfw_update_client_id_and_secret" />
</form>

</div>
