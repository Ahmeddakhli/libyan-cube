<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('inventory::inventory.compound')}}</th>
            <th scope="col">{{__('inventory::inventory.unit_name')}}</th>
            <th scope="col">{{__('inventory::inventory.purpose_type')}}</th>
            <th scope="col">{{__('inventory::inventory.name')}}</th>
            <th scope="col">{{__('inventory::inventory.email')}}</th>
            <th scope="col">{{__('inventory::inventory.phone')}}</th>
            <th scope="col">{{__('inventory::inventory.comments')}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{$i_sell_request->id}}</th>
            <td>{{$i_sell_request->compound}}</td>
            <td>{{$i_sell_request->unit_name}}</td>
            <td>{{$i_sell_request->purpose_type}}</td>
            <td>{{$i_sell_request->name}}</td>
            <td>{{$i_sell_request->email}}</td>
            <td>{{$i_sell_request->phone}}</td>
            <td>{{$i_sell_request->comments}}</td>
        </tr>

    </tbody>
</table>
<h3>{{__('inventory::inventory.attachments')}}</h3>
<div class="d-flex">
    @foreach ($i_sell_request->attachments as $attachment)
    @if($attachment->is_deleted == null)
    @if (in_array($attachment->mime_type, ['tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png']))
    <div style="max-width: 200px;" class="ml-2">
        <img src="{{asset('storage/'.$attachment->id.'/'.$attachment->file_name)}}" class="d-block w-100" alt="{{$attachment->file_name}}">
    </div>
    @endif
    @endif
    @endforeach
</div>