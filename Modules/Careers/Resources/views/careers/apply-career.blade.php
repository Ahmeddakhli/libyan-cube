@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('careers.apply')}}" method="post"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="career_id" value="1">
<input type="text" name="full_name">
<input type="text" name="subject" id="">
<input type="email" name="email" id="">
<input type="number" name="phone" id="">
<textarea name="message" id="" cols="30" rows="10"></textarea>
<input type="file" name="attachment" id="">
<input type="submit" value="Send">
</form>