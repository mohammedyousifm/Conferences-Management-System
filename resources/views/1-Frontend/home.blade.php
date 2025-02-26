@extends('4-layout.frantend')
@section('content')
@php
    use Carbon\Carbon;
@endphp

    {{-- Upcoming conferences --}}
    <section class="section left-top-circle section-bg-color-gray">
        <div class="container">
            <div class="heading-wraper">
                <div class="main-head">
                    <h1> Upcoming conferences</h1>
                </div>
            </div>
            <div class="grid conferences">

                @foreach ($conferences as $conference )
                 @if (Carbon::parse($conference->end_date)->isFuture() || Carbon::parse($conference->end_date)->isToday())
                     <div class="g-col-md-4 con-cell">
                         <div class="news-cell">
                             <div class="event-img">
                                 <img width="auto" height="auto" src="{{ asset('3-images/scso-sgi.webp') }}" alt="Empowering Women Artisans for Vision Viksit Bharat">
                             </div>
                             <h3>{{ $conference->description }} <span>({{ $conference->title }})</span></h3>
                             <div class="news-calender">{{ $conference->start_date }}</div>
                             <div class="call-action"><a href="{{ route('conference.show' , $conference->id) }}" class="link-btn"> <i class="fa-solid text-bg p-2 fa-arrow-right"></i>  Read More</a></div>
                         </div>
                     </div>
                     @endif
                @endforeach

            </div>
        </div>
   </section>

     {{--Recent Conferences --}}
   <section class="section ">
        <div class="container">
            <div class="heading-wraper">
                <div class="main-head">
                    <h2> Recent Conferences</h2>
                </div>
            </div>
            <div class="grid conferences">

                @foreach ($conferences as $conference )
                @if (Carbon::parse($conference->end_date)->isPast())
                     <div class="g-col-md-4 con-cell">
                         <div class="news-cell">
                             <div class="event-img">
                                 <img width="auto" height="auto" src="{{ asset('1-Frontend/image/scso-sgi.webp') }}" alt="Empowering Women Artisans for Vision Viksit Bharat">
                             </div>
                             <h3>Empowering Women Artisans for Vision Viksit Bharat <span>(ICEWA 2025)</span></h3>
                             <div class="news-calender">7th February, 2025</div>
                             <div class="call-action"><a href="{{ route('conference.show' , 1) }}" class="link-btn"><img src="" width="24" height="24" loading="lazy"> Read More</a></div>
                         </div>
                     </div>
                     @endif
                @endforeach

            </div>
        </div>
  </section>

@endsection

