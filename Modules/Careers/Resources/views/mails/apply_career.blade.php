<div style="display: inline">
    @if (isset($content['career_name']))
        <Strong>{{$content['career_name']}} </Strong>
    @endif
    @if (isset($content['full_name']))
        <div style="text-align: left;">
            {{ $content["full_name"] }}
        </div>
    @endif
    @if (isset($content['email']))
        <div style="text-align: right;">
            {{ $content["email"] }}
        </div>
    @endif
    @if (isset($content['phone']))
        <div style="text-align: right;">
            {{ $content["phone"] }}
        </div>
    @endif
    @if (isset($content['message']))
        <div style="text-align: right;">
            {{ $content["message"] }}
        </div>
    @endif
</div>