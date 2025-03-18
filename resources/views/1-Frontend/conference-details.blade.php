@extends('4-layout.frantend')
@section('content')

    <div id="Conference-Details">

        <div class="container pt-5">
            <section class="slider-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 img-overlap">
                            <img src="{{ asset('3-images/silder.jpg') }}" alt="herrrrrrr" style="border-radius:0.3rem" />
                        </div>
                        <div class="col-lg-5">
                            <img src="{{ asset('3-images/scso-sgi.webp') }}" alt="noooooooo">
                            <hr>
                            <div>2nd International Conference on </div>
                            <h3 class="mb10">{{ $Conference->title }} <span>(ICAAE - 2025) </span></h3>
                            <hr>
                            <h4 class="mb-3">{{ $Conference->registration_deadline }} <span>Hybrid Mode</span></h4>
                            <a href="{{ route('conference.create', $Conference->id) }}"
                                class="m-0 button button-small button-border button-rounded">Online
                                Registration</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section light-bg">
                <div class="container">
                    <div class="heading-wraper">
                        <div class="main-head">
                            <h1>About ICAAE - 2025</h1>
                        </div>
                    </div>
                    <p>
                        {{ $Conference->description }}
                    </p>
                    <h4 class="mb10 font-primary">Objectives</h4>
                    <p class="mb-2">{{ $Conference->description }}</p>
                    <p class="mb-2">The specific goals of the conference include:</p>
                    <ul class="lpu-list">
                        <li>Showcasing cutting-edge research and advancements in aerospace and aeronautical engineering,
                            covering
                            areas such as aerodynamics, propulsion, materials and structures, space systems, and more. </li>
                        <li>Offering a forum for researchers, engineers, and industry leaders to present their work and
                            exchange
                            ideas on state-of-the-art technologies and methodologies. </li>
                        <li>Promoting interdisciplinary research and partnerships by bringing together experts from various
                            fields
                            related to aerospace and aeronautical engineering. </li>
                        <li>Exploring the latest industry developments, including innovative products, services, and
                            business
                            models, and analyzing their implications for the future of aerospace and aeronautical
                            engineering.
                        </li>
                        <li>Supporting the education and professional growth of students and early-career researchers
                            through
                            workshops, mentorship opportunities, and networking events.</li>
                    </ul>
                    <p class="mb-0">In essence, the 2nd International Conference on Advancements in Aerospace Engineering
                        2025
                        aims
                        to serve as a premier gathering for researchers and professionals in aerospace and aeronautical
                        engineering,
                        offering a dynamic platform to share insights, exchange ideas, and shape the future of the industry.
                    </p>
                </div>
            </section>

            <section class="section">
                <div class="container clearfix">
                    <div class="row">
                        <div class="col-md-6 patron">
                            <div class="heading-wraper">
                                <div class="main-head">
                                    <h3>Chief Patron</h3>
                                </div>
                            </div>
                            <img src="{{ asset('3-images/ChiefPatron.jpg') }}" />
                            <div class="patron-div">
                                <h4 class="font-primary">Dr. Ashok Kumar Mittal</h4>
                                <!-- <span>Chief Patron</span> -->
                                <p>Chancellor, <br>Lovely Professional University, Punjab, India</p>
                            </div>
                        </div>
                        <div class="col-md-6 patron">
                            <div class="heading-wraper">
                                <div class="main-head">
                                    <h3>Patron</h3>
                                </div>
                            </div>
                            <img src="{{ asset('3-images/Patron.jpg') }}" />
                            <div class="patron-div">
                                <h4 class="font-primary">Smt Rashmi Mittal</h4>
                                <!-- <span>Patron</span> -->
                                <p>Pro Chancellor, <br>Lovely Professional University, Punjab, India</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section section-gray">
                <div class="container clearfix">
                    <div class="row  align-items-center">
                        <div class="col-md-6">
                            <img src="{{ asset('3-images/about-lpu.png') }}" />
                        </div>
                        <div class="col-md-6">
                            <div class="heading-wraper">
                                <div class="main-head">
                                    <h2 class="">About LPU</h2>
                                </div>
                            </div>
                            <p>
                                Lovely Professional University (LPU), renowned for its academic excellence, boasts a modern
                                campus
                                and offers over 150 professional programs. With a diverse community from across India and
                                over
                                40
                                countries, LPU is a global melting pot. Highlighting its commitment to quality, LPU has been
                                awarded
                                the prestigious NAAC A++ grade with an impressive score of 3.68/4 by the UGC's National
                                Assessment &
                                Accreditation Council, setting it apart as a leading institution in India.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>
@endsection

<style>
    #Conference-Details .left-top-circle::after {
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

    #Conference-Details {
        margin-top: 100px;
    }

    #Conference-Details h1 {
        font-size: 25px;
        color: #000;
    }

    #Conference-Details h2 {
        font-size: 20px;
    }

    #Conference-Details p {
        font-size: 18px;
    }

    #Conference-Details ul i {
        font-size: 17px;
    }

    #Conference-Details ul li {
        font-size: 15px;
    }

    #Conference-Details a {
        font-size: 15px;
    }

    #Conference-Details #formContainer {
        width: 50%;
        margin: 0 auto;
        overflow: auto;
        padding: 5px 10px 0px;
        border-radius: 10px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
        position: fixed;
        top: 0;
        right: 50;
        left: 50;
        z-index: 100000;
        display: flex;
        opacity: 0;
        visibility: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    #Conference-Details #formContainer.show {
        opacity: 1;
        visibility: visible;
    }

    #Conference-Details #formContainer label {
        font-size: 11px;
    }

    #Conference-Details #formContainer input {
        font-size: 11px;
    }

    #Conference-Details #formContainer .heading {
        border-radius: 5px;
        width: 100%;
    }

    #Conference-Details #formContainer .heading h4 {
        font-size: 18px;
        color: white;
    }

    #Conference-Details #formContainer .heading p {
        font-size: 11px;
        color: white;
        font-weight: bold;
    }

    .bg-light {
        background: linear-gradient(to right, #f8f9fa, #e3e6ea);
        padding: 60px 0;
    }

    .conference-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .zoom-effect {
        transition: transform 0.4s ease-in-out;
    }

    .zoom-effect:hover {
        transform: scale(1.05);
    }

    .keyword-badge {
        display: inline-block;
        background-color: #007bff;
        color: white;
        padding: 5px 10px;
        margin: 3px;
        border-radius: 15px;
        cursor: pointer;
    }

    .keyword-badge:hover {
        background-color: #0056b3;
    }

    #keyword-container {
        display: flex;
        flex-wrap: wrap;
        padding: 5px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        min-height: 40px;
        align-items: center;
    }

    #papekeywords {
        border: none;
        outline: none;
        flex-grow: 1;
        padding: 5px;
    }
</style>