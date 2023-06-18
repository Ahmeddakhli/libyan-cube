@extends('front.layouts.main')

@section('page_name', $single_unit->meta_title ? $single_unit->meta_title : $single_unit->title)
@php
       $page_name ='';
      @endphp
@push('header-scripts')
@endpush
@push('meta')
<meta name="title" content="{{$single_unit->meta_title ? $single_unit->meta_title : $single_unit->title}}" />
<meta name="description" content="{{$single_unit->meta_description ? $single_unit->meta_description : strip_tags(substr($single_unit->description, 0, 150)) }}" />
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{$single_unit->meta_title ? $single_unit->meta_title : $single_unit->title}}" />
<meta itemprop="image" content="{{ URL::asset('/front/images/logo.png') }}">
<meta itemprop="description" content="{{ strip_tags($single_unit->meta_description ? $single_unit->meta_description : substr($single_unit->description, 0, 150)) }}" />
<!-- Twitter Card data -->
<meta name='twitter:app:country' content='EG' />
<meta name="twitter:site" content="@advisors" />
<meta name="twitter:creator" content="@advisors" />
<meta name="twitter:title" content="{{$single_unit->meta_title ? $single_unit->meta_title : $single_unit->title}}">
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:image" content="{{ URL::asset('/front/images/logo.png') }}">
<meta name="twitter:description" content="{{ strip_tags($single_unit->meta_description ? $single_unit->meta_description : substr($single_unit->description, 0, 150)) }}" />
<!-- Open Graph data -->
<meta property="og:type" content="article" />
<meta property="og:site_name" content="Constguide">
<meta property="og:url" content="{{Request::url()}}" />
<meta property="og:title" content="{{$single_unit->meta_title ? $single_unit->meta_title : $single_unit->title}}" />
<meta property="og:image" content="{{$single_unit->attachments?$single_unit->attachments[0]->url: URL::asset('/front/images/logo.png') }}">
<meta property="og:description" content="{{ strip_tags($single_unit->meta_description ? $single_unit->meta_description : substr($single_unit->description, 0, 150)) }}" />
@endpush

@section('content')

@include('front.partials.unit.unit')

@endsection
@push('scripts')
<script>

// ANIMATE BODY ON SHOW COLLAPSE ACCORDION
$('.panel-collapse').on('shown.bs.collapse', function (e) {
  var $panel = $(this).attr("id");
  $('html, body').animate({
    scrollTop: $('#' + $panel).offset().top - 45
  }, 500);
});

$('.refresh-slick').on('click', function () {
  $(this).closest('.card').find('.collapse').resize();
  $(this).closest('.card').find('.slick_slider').slick('refresh');
})

// FANCYBOX
let defaults = {
  buttons: [
    'zoom',
    'share',
    'slideShow',
    'fullScreen',
    'download',
    'thumbs',
    'close',
  ],
  animationEffect: 'zoom-in-out', // false | "zoom" | "fade"
  transitionEffect: 'zoom-in-out', // false  |"fade' | "slide" |"tube' |"circular' | "rotate'
  lang: 'ar',
  i18n: {
    en: {
      CLOSE: 'غلق',
      NEXT: 'التالى',
      PREV: 'السابق',
      ERROR: 'لا يوجد محتوى صور <br/> من فضلك حاول لاحقا.',
      PLAY_START: 'ابدأ عرض الشرائح',
      PLAY_STOP: 'اوقف عرض الشرائح',
      FULL_SCREEN: 'شاشة كاملة',
      THUMBS: 'المصغرات',
      DOWNLOAD: 'تحميل',
      SHARE: 'مشاركه',
      ZOOM: 'تكبير',
    },
  },
};
$('[data-fancybox]').fancybox(defaults);
</script>
@php
  $images = [];
  if($single_unit->attachments){

    foreach($single_unit->attachments as $attch){
      array_push($images,$attch->url);
    }
  }
@endphp
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{$single_unit->title}}",
    "image": @json($images),
    "description": "{{$single_unit->meta_description}}",
    "sku": "{{$single_unit->id}}",
    "mpn": "{{$single_unit->id}}",
    "brand": { "@type": "Brand", "name": "{{$single_unit->project ? $single_unit->project->project : 'advisors Properties'}}" },
    "review": {
      "@type": "Review",
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "4",
        "bestRating": "5"
      },
      "author": { "@type": "Organization", "name": "advisors Properties" }
    },
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.4",
      "reviewCount": "89"
    },
    "offers": {
      "@type": "Offer",
      "url": "{{Request::fullUrl()}}",
      "priceCurrency": "EGP",
      "price": "{{$single_unit->price_for_schema}}",
      "priceValidUntil": "2032-01-01",
      "itemCondition": "https://schema.org/UsedCondition",
      "availability": "https://schema.org/InStock"
    }
  }
</script>
@endpush
