@extends('4-layout.frantend')
@section('content')
@php
    use Carbon\Carbon;
@endphp

  <div id="Home">

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
                                   <h3 class="description">{{ $conference->description }}</h3>
                                   <span class="title">({{ $conference->title }})</span>
                                     <div class="mt-3">
                                         <div class="call-action "><i class="fa-solid text-bg p-1 fa-calendar-days"></i>  {{ $conference->start_date }}</div>
                                         <div class="call-action mt-1"><a href="{{ route('conference.show' , $conference->id) }}"> <i class="fa-solid p-1 text-bg fa-arrow-right"></i>  Read More</a></div>
                                     </div>
                               </div>
                           </div>
                           @endif
                      @endforeach

                  </div>
              </div>
         </section>

           {{--Recent Conferences --}}
         <section class="section">
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
  </div>

@endsection

<style>

/* conferences css start */
    #Home {
        padding-top: 70px;
    }

   #Home .left-top-circle:after {
     content: "";
     position: absolute;
     width: 900px;
     height: 800px;
     border: 120px solid transparent;
     border-bottom-color: rgba(239, 125, 0, 0.08);
     border-right-color: rgba(239, 125, 0, 0.08);
     border-radius: 100%;
     top: -330px;
     left: -330px;
     z-index: 0;
   }

   #Home .main-head h1{
   font-size: 24px;
   padding: 10px 0;
   }

   #Home .conferences .con-cell {
     border: 1px solid rgba(0, 0, 0, 0.1);
   }

   #Home .conferences .news-cell {
     padding: 20px;
   }

   #Home .conferences .news-cell .event-img.white {
     border-bottom: 1px solid rgba(255, 255, 255, 0.4);
   }

   #Home .conferences .news-cell .event-img {
     border-bottom: 1px solid rgba(8, 7, 8, 0.4);
     padding-bottom: 20px;
     margin-bottom: 20px;
   }

   #Home .conferences .news-cell .event-img img {
     width: 100%;
   }

   #Home .conferences .call-action {
    font-size: 14px;

   }

   #Home .conferences .description {
    font-size: 14px;
    font-weight: 350;
   }

   #Home .conferences .title {
    font-size: 14px;
    font-weight: 600;
     display: block;
     color: #000;
   }
</style>
