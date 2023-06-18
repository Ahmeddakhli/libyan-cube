
<nav id="breadcrumb" class='mb-3'>
    <ul>
        <li><a href="{{route('front.home')}}">
                <ion-icon name="home-outline"></ion-icon>
            </a></li>
        <li><a href="{{route('front.careers')}}">{{__('careers::career.careers')}}</a></li>
        <li class="active"><a>{{$career->title}}</a></li>
    </ul>
</nav> <!-- #/ breadcrumb-->

<div class="form">
    <div class="text-center">
        <h1 class="career-title mt-3 text-capitalize">{{$career->title}}</h1>
    </div>
    <div class="career-form mt-4">
        <form action="#" enctype="multipart/form-data" id="apply-form" data-parsley-validate>
            @csrf
            <div class="row">
                <input type="hidden" class="form-control" name="career_id" value="{{$career->id}}" placeholder="Job Title">
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="full_name" placeholder="{{__('users.full_name')}}" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_name')}}">
                    </div>
                </div>
                {{--
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="{{__('main.subject')}}">
                    </div>
                </div>
                --}}
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="{{__('users.email')}}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="{{__('users.mobile_number')}}" data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_enter_your_mobile_number')}}">
                    </div>
                </div>
                {{--
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <label for="" class='gender mb-0 mr-3'>{{__('users.gender')}} : </label>
                        <div class='radiobutton d-inline-block mr-3'>
                            <input id='male' type="radio" name='gender'>
                            <label for="male">{{__('users.male')}}</label>
                        </div>
                        <div class='radiobutton d-inline-block'>
                            <input id='female' type="radio" name='gender'>
                            <label for="female">{{__('users.female')}}</label>
                        </div>
                    </div>
                </div>
                --}}
                <div class="col-12">
                    <textarea name="message" id="" rows="5" class="form-control" placeholder="{{__('contactus::contact_us.message')}}"></textarea>
                </div>
                <div class="col-12">
                    <div class="form-group mt-3">
                        <label for="custom-file" class='attachment'>{{__('main.cv_upload')}}</label>
                        <input type="file" name="attachment" id='custom-file' data-parsley-trigger="change focusout" required data-parsley-required data-parsley-required-message="{{__('main.please_upload_your_cv')}}">
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class='submit apply-from'>{{__('careers::career.apply')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

