<div style="width:100%;display: inline;background-color: #FFF; justify-content: center; text-align: justify;">
    <div
        style="height: 60px; width:100%; justify-content: center;text-align: center; margin-bottom: 2rem;background-color: gray;">
        <img src="{{ URL::asset('front/images/logo.jpg') }}" style="width: 292px;" alt="">
    </div>
    <div style="color: black; width: 90%;">
        @if (isset($content['full_name']))
            <div style="text-align: left; color:black;">
                Thank you, {{ $content['full_name'] }}
            </div>

        @endif
        <br>
        <div style="text-align: left; color: black;">
            @if (isset($content['message']))
                {{ $content['message'] }}
            @else
                @if (App::getLocale() == 'en')
                    @if ($setting->auto_reply_message_en)
                        @if (isset($content['item_link']))
                            @php
                                $new_text = str_replace('$model_name', $content['item_link'], $setting->auto_reply_message_en);
                            @endphp
                            {!! $new_text !!}
                        @else
                            {!! nl2br(e(str_replace('$model_name', '', $setting->auto_reply_message_en))) !!}
                        @endif
                    @endif
                @else
                    @if ($setting->auto_reply_message_ar)
                        @if (isset($content['item_link']))
                            @php
                                $new_text = str_replace('$model_name', $content['item_link'], $setting->auto_reply_message_ar);
                            @endphp
                            {!! $new_text !!}
                        @else
                            {!! nl2br(e(str_replace('$model_name', '', $setting->auto_reply_message_ar))) !!}
                        @endif
                    @endif
                @endif
            @endif
        </div>
        @if (isset($content['urls']) && count($content['urls']))
            <h4 style="color: black;">Related Urls</h4>
            @foreach ($content['urls'] as $key => $url)
                <div style="text-align: left;">
                    <a href="{{ $url }}">{{ $key }}</a>
                </div>
            @endforeach
        @endif
        <br>
        <br>
        <br>
        <div style="text-align: center;">
            <h5 style="color: green;">Have A Nice Day :)</h5>
        </div>
        <br>
        <br>
        <div style="text-align: center;">
            <h6 style="color:black;">Note: This is automated email generated from <a
                    href="{{ route('front.home') }}">advisors</a> website </h6>
        </div>

    </div>
</div>
