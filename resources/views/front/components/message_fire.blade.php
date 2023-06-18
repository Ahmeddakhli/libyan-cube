
<script>
    var store_fired_message_url = "{{route('front.fire_messages_store')}}"
    @foreach($welcome_messages as $welcome_message)
        @if(!(\Illuminate\Support\Facades\DB::table('fired_messages')->where('session',request()->session()->get('_token'))->where('welcome_message_id',$welcome_message->id)->first()))
        
            setTimeout(function () {
                $(".welcome_message_{{$welcome_message->id}}").addClass('show');
            }, {{$welcome_message->time}}*1000);
            
            $('.close-popup-{{$welcome_message->id}}').click(function () {
            $(".welcome_message_{{$welcome_message->id}}").removeClass('show');
            });
            var store_fired_message_data ={
                '_token' : "{{csrf_token()}}",
                'welcome_message_id':{{$welcome_message->id}}
            }
            $.post(store_fired_message_url,store_fired_message_data).done((response)=>{
                console.log(response);
            }).fail((error)=>{
                console.log(error);
            });
        @endif

    @endforeach
</script>