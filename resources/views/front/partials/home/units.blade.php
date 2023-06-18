 @if (count($units))
     <!-- units-holder -->
     <section class="section units-holder">
         <div class="container">
             <div class="section-title" data-aos="fade">
                 <h2 class="title">{{__('main.featured_units')}}</h2>
             </div>
             <div class="swiper units-slider">
                 <div class="swiper-pagination" data-aos="fade" data-aos-delay="100"></div>

                 <div class="swiper-wrapper py-3 mt-5">
                     @foreach ($units as $unit)
                         <div class='swiper-slide'>
                             <div class="h-100" data-aos="fade" data-aos-delay="0">
                                 @include('front.components.unit', ['unit' => $unit])
                             </div>
                         </div>
                     @endforeach
                 </div>

                 <div class="swiper-button-next units-next-btn"></div>
                 <div class="swiper-button-prev units-prev-btn"></div>
             </div>
         </div>
     </section>

 @endif
 @push('scripts')
 @endpush
