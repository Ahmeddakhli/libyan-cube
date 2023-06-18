<div style="display: inline">
    @if (isset($content['unit_name']))
        <Strong>{{$content['unit_name']}} </Strong>
    @endif
    @if (isset($content['compound']))
        <div style="text-align: left;">
            {{ $content["compound"] }}
        </div>
    @endif
    @if (isset($content['purpose']))
        <div style="text-align: right;">
            {{ $content["purpose"] }}
        </div>
    @endif
    @if (isset($content['purpose_type']))
        <div style="text-align: right;">
            {{ $content["purpose_type"] }}
        </div>
    @endif
    @if (isset($content['comments']))
        <div style="text-align: right;">
            {{ $content["comments"] }}
        </div>
    @endif
    @if (isset($content['name']))
        <div style="text-align: right;">
            {{ $content["name"] }}
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
</div>