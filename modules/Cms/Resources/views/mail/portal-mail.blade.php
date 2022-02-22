<!DOCTYPE html>
<html>
<body>
@php
    $user = \Modules\Ums\Entities\User::find($data['user_id']);
@endphp
<div style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">
    <table width="100%" cellpadding="0" cellspacing="0"
           style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;margin:0;padding:0;width:100%">
        <tbody>
        <tr>
            <td align="center"
                style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                <table width="100%" cellpadding="0" cellspacing="0"
                       style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:0;padding:0;width:100%">
                    <tbody>
                    <tr>
                        <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding:25px 0;text-align:center">
                            <a href="{{ url('/') }}"
                               style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:19px;font-weight:bold;text-decoration:none;display:inline-block"
                               target="_blank">
                                {{ env('APP_NAME') }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td width="100%" cellpadding="0" cellspacing="0"
                            style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                            <table align="center" width="800" cellpadding="0" cellspacing="0"
                                   style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:800px">
                                <tbody>
                                <tr>
                                    <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
                                        <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                            <b>Hallo {{ $user->basicInfo->first_name }} {{ $user->basicInfo->last_name }},</b><br>
                                        {!! $mailContent->body !!}
                                        <hr>
                                        <h3 style="text-align: center; line-height: 0">Bijbehorende informatie</h3>
                                        <hr>

                                        @if($data['mail_category_id'] == 1)
                                            @php
                                                $project = \Modules\Cms\Entities\Project::find($data['project_id']);
                                            @endphp
                                            <ul>
                                                <li>E-mail: {{ $data['email'] }}</li>
                                                <li>Wachtwoord: {{ $data['password'] }}</li>
                                                <li>Project ID #{{ $project->project_id }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 2)
                                            <ul>
                                                <li>E-mail: {{ $data['email'] }}</li>
                                                <li>Wachtwoord: {{ $data['password'] }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 3)
                                            <ul>
                                                <li>E-mail: {{ $data['email'] }}</li>
                                                <li>Wachtwoord: {{ $data['password'] }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 4)
                                            @php
                                                $project = \Modules\Cms\Entities\Project::find($data['project_id']);
                                            @endphp
                                            <ul>
                                                <li>Project ID #{{ $project->project_id }}</li>
                                            </ul>
                                            <h5>Geselecteerde bedrijven:</h5>
                                            <ol>
                                                @foreach($project->company_id as $company_id)
                                                    @php
                                                        $company = \Modules\Ums\Entities\User::find($company_id);
                                                    @endphp
                                                    <li>
                                                        {{ $company->basicInfo->first_name }}
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                        @if($data['mail_category_id'] == 5)
                                            @php
                                                $project = \Modules\Cms\Entities\Project::find($data['project_id']);
                                                $client = \Modules\Ums\Entities\User::find($project->author_id);
                                            @endphp
                                            <ul>
                                                <li>klantnaam: {{ $client->basicInfo->first_name }} {{ $client->basicInfo->last_name }}</li>
                                                <li>Project ID #{{ $project->project_id }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 6)
                                            @php
                                                $project = \Modules\Cms\Entities\Project::find($data['project_id']);
                                                $client = \Modules\Ums\Entities\User::find($project->author_id);
                                            @endphp
                                            <ul>
                                                <li>klantnaam: {{ $client->basicInfo->first_name }} {{ $client->basicInfo->last_name }}</li>
                                                <li>Project ID #{{ $project->project_id }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 7)
                                            <ul>
                                                <li>E-mail: {{ $data['email'] }}</li>
                                                <li>Wachtwoord: {{ $data['password'] }}</li>
                                            </ul>
                                        @endif
                                        @if($data['mail_category_id'] == 8)
                                            <ul>
                                                <li>E-mail: {{ $data['email'] }}</li>
                                                <li>Nieuw wachtwoord: {{ $data['password'] }}</li>
                                            </ul>
                                        @endif
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                            <table align="center" width="570" cellpadding="0" cellspacing="0"
                                   style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:0 auto;padding:0;text-align:center;width:570px">
                                <tbody>
                                <tr>
                                    <td align="center"
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
                                        <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">
                                            © {{ date('Y') }} {{ env('APP_NAME') }}. Alle rechten voorbehouden</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="yj6qo"></div>
    <div class="adL">
    </div>
</div>

</body>
</html>
