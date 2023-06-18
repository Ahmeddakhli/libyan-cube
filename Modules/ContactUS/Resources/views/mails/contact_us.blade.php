
<div style="width:100%;display: inline;background-color: #FFF; justify-content: center; text-align: justify;">
    <div style="height: 60px; width:100%; justify-content: center;text-align: center; margin-bottom: 2rem;background-color: gray;">
        <img src="{{URL::asset('front/images/logo.jpg')}}" style="width: 292px;" alt="">
    </div>

    <div style="text-align: left; color:black;">
        Dear all,         
    </div>
    <br>

    @if(isset($content['error_message']))
        <div style="text-align: left; color:black;">
            {{$content['error_message']}}
        </div>
    @endif

    <br>
    
    <div style="text-align: left; color:black;">
        A New message from advisors Website. Here are the details:
    </div>
    
    <br>

    <ul style="text-align: left; color: black; font-weight: 400;">
        @if(isset($content['full_name']))
            <li> Name : {{ $content["full_name"] }}</li>
        @endif
        @if(isset($content['email']))
            <li> Email : {{ $content["email"] }}</li>
        @endif
        @if(isset($content['phone']))
            <li> Mobile : {{ $content["phone"] }}</li>
        @endif
        @if(isset($content['link']))
            <li> Page Link : {{ $content["link"] }}</li>
        @endif
        
        @if(isset($content['best_time_to_call_from']))
            <li> Best Time To Call : {{ $content["best_time_to_call_from"] }}</li>
        @endif
        @if(isset($content['unit_types']))
            <li> Unit types : {{ implode(',',$content["unit_types"]) }}</li>
        @endif
    </ul>

    <div style="text-align: left; color:black; font-size: 1.2rem;">
        Message : 
    </div>
    <br>
    <div style="text-align: left; color:black;">
        @if (isset($content['message']))
                {!! nl2br(e( $content["message"])) !!}
        @endif
    </div>
    <br>
    <br>
    <br>
    <div style="text-align: center;">
        <h5 style="color: green;">Have A Nice Day :)</h5>
    </div>
    <br>
    <br>
    <div style="text-align: center;">
        <h6 style="color:black;">Note: This is automated email generated from <a href="{{route('front.home')}}">advisors</a> website </h6>
    </div>

</div>
