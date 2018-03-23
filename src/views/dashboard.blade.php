<div class="wrap">

<h1>Google Contacts for WordPress</h1>

<h2>Dashboard</h2>

@if(!$setupComplete)
    <p>Google contact for WordPress is not yet setup.</p>
    <p><a href="{{ admin_url('options-general.php?page=gcfw_setup_step_1') }}">Setup</a></p>
@else

    <h3>WordPress users</h3>

    <table class="wp-list-table widefat fixed striped">
        <tr>
            <th>Username</th>
            <th>Email address</th>
            <th>Status</th>
            <th>Google Contacts Resource Name</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>
                    <a href="{{ admin_url('user-edit.php?user_id='.$user->ID) }}">
                        {{ $user->data->user_login }}
                    </a>
                </td>
                <td>{{ $user->data->user_email }}</td>
                <td>
                    @if(get_user_meta($user->ID, $USER_META_GOOGLE_CONTACT_RESOURCE_NAME, true))
                        ✅ Synced
                    @else
                        ❌ Not synced
                    @endif
                </td>
                <td>{{ get_user_meta($user->ID, $USER_META_GOOGLE_CONTACT_RESOURCE_NAME, true) }}</td>
            </tr>
        @endforeach
    </table>
    
@endif
</div>