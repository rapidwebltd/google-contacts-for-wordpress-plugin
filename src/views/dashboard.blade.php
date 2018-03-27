<div class="wrap">

<h1>{{ __('Google Contacts for WordPress', $td) }}</h1>

<h2>{{ __('Dashboard', $td) }}</h2>

@if(!$setupComplete)
    <p>{{ __('Google Contacts for WordPress is not yet setup.', $td) }}</p>
    <p><a class="button-primary" href="{{ admin_url('options-general.php?page=gcfw_setup_step_1') }}">{{ __('Setup', $td) }}</a></p>
@else

    <h3>{{ __('Options', $td) }}</h3>

    <p>
        <a href="{{ admin_url('options-general.php?page=gcfw_setup_step_1') }}">{{ __('Re-run Setup', $td) }}</a>
        | 
        <a href="{{ admin_url('options-general.php?page=gcfw_setup_step_2') }}">{{ __('Change linked Google Account', $td) }}</a>
    </p>

    <h3>{{ __('WordPress users', $td) }}</h3>

    <table class="wp-list-table widefat fixed striped">
        <tr>
            <th>{{ __('Username', $td) }}</th>
            <th>{{ __('Email address') }}</th>
            <th>{{ __('Status', $td) }}</th>
            <th>{{ __('Last synced at', $td) }}</th>
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
                    @if($user->googleContactResourceName)
                        <span title="Google Contact resource name: {{ $user->googleContactResourceName }}">{{ __('✅ Synced', $td) }}</span>
                    @else
                        {{ __('❌ Not synced', $td) }}
                    @endif
                </td>
                <td>{{ date(get_option('time_format').', '.get_option('date_format'), $user->googleContactSyncedAt) }}</td>
            </tr>
        @endforeach
    </table>
    
@endif
</div>
