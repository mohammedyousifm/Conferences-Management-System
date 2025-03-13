@extends('4-layout.frantend')
@section('content')

    <div id="Conference-apply" class="container">

        <div class="row">

            <div class="col-6 mt-5">
                <div class="mt-2 container pt-2 pb-2 border rounded shadow-sm bg-light ">
                    <div class="heading-Details">
                        <h1 class="display-4 fw-bold  mb-3">Conference Details</h1>
                        <ul>
                            <li><i class="fa-solid text-bg fa-arrow-right"></i> Conference Name: <span>Aliquam
                                    doloremque</span>
                            </li>
                            <li><i class="fa-solid text-bg fa-arrow-right"></i> Conference Date: <span>2025-03-29</span>
                            </li>
                            <li><i class="fa-solid text-bg fa-arrow-right"></i> Conference Location: <span>LPU</span></li>
                            <div class="divider">
                        </ul>


                        <div class="d-flex justify-content-between">
                            <ul>
                                <h1 class="display-4 fw-bold  mb-3">Author Details</h1>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Name: <span>Aliquam
                                        doloremque</span>
                                </li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Email: <span>2025-03-29</span>
                                </li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Phone: <span>LPU</span></li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Address: <span>LPU</span></li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Number of Authors: <span>LPU</span></li>
                            </ul>
                            <ul>
                                <h1 class="display-4 fw-bold  mb-3">Paper Details</h1>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Paper Title: <span>Aliquam
                                        doloremque</span>
                                </li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Abstract: <span>2025-03-29</span>
                                </li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Conference Keywords: <span>LPU</span>
                                </li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Paper File: <span>LPU</span></li>
                                <li><i class="fa-solid text-bg fa-arrow-right"></i> Number of Authors: <span>LPU</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 mt-5">
                <!-- Application Form -->
                <div id="formContainer" class="mt-2 container pt-2 pb-2 border rounded shadow-sm bg-light">
                    <form action="{{ route('conference.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1: Author Information -->
                        <div id="step1">
                            <div class="heading p-1 bg text-center">
                                <h4>Step 1: Author Information</h4>
                                <p class="mt-1">Please provide your personal details, including your name and email, so we
                                    can
                                    identify you as the author of the paper.</p>
                            </div>
                            <input type="hidden" value="1" name="conference_id">
                            <div class="mb-3 mt-3">
                                <label for="author_name" class="form-label">Author Name</label>
                                <input type="text" class="form-control" name="author_name" id="authorName"
                                    placeholder="Enter your name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="authorEmail"
                                    placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" name="phone" id="authorphone" class="form-control"
                                    placeholder="Enter your Phone Number">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="authoraddress" class="form-control"
                                    placeholder="Enter your Address">
                            </div>

                            <div class="mb-3">
                                <label for="number_of_authors" class="form-label">Number of Authors</label>
                                <input type="number" name="number_of_authors" id="number_of_authors" class="form-control"
                                    required min="1" placeholder="Enter Number of Authors">
                            </div>

                            <button type="button" class="btn bg text btn-sm" id="nextStep">Next</button>
                        </div>

                        <!-- Step 2: Paper Details (Hidden initially) -->
                        <div id="step2" style="display: none;">
                            <div class="heading p-2 bg text-center">
                                <h4>Step 2: Paper Details</h4>
                                <p class="mt-1">Please provide Details about the papers , including paper title and paper
                                    file, so
                                    we can
                                    identify the paper.</p>
                            </div>

                            <div class="mt-3">
                                <label for="paper_title" class="form-label">Paper Title</label>
                                <input type="text" class="form-control" name="paper_title" id="paperTitle"
                                    placeholder="Enter paper title">
                            </div>

                            <div class="mt-3">
                                <label for="abstract" class="form-label">Abstract</label>
                                <textarea class="form-control" name="abstract" id="paperAbstract" rows="2"
                                    placeholder="Enter abstract"></textarea>
                            </div>

                            <div class="mt-3">
                                <label for="keywords" class="form-label">Conference Keywords</label>
                                <div id="keyword-container">
                                    <input type="text" id="papekeywords" class="form-control"
                                        placeholder="Enter conference keywords..." onkeydown="handleKeyDown(event)">
                                </div>
                                <div id="suggested-keywords" class="mt-2"></div>
                            </div>

                            <div class="mt-3">
                                <label for="paper_file" class="form-label">Upload Paper</label>
                                <input type="file" name="paper_file" id="paper_file" class="form-control">
                            </div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-secondary btn-sm me-2" id="backStep">Back</button>
                                <button class="btn btn-success btn-sm" id="submitForm">Submit</button>
                                <button type="button" class="btn btn-danger btn-sm" id="closeForm">Close</button>
                            </div>
                        </div>


                        <div id="step3" style="display: none;">

                        </div>

                        <!-- Close Button -->

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

<style>
    #Conference-apply {
        padding-top: 90px
    }

    #Conference-apply .left-top-circle::after {
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

    .heading-Details h1 {
        font-size: 20px;
    }

    #Conference-apply #formContainer {
        height: 100vh;
        margin: 0 auto;
        overflow: auto;
        padding: 5px 10px 0px;
        border-radius: 10px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
        top: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }


    #Conference-apply #formContainer label {
        font-size: 11px;
    }

    #Conference-apply #formContainer input {
        font-size: 11px;
    }

    #Conference-apply #formContainer .heading {
        border-radius: 5px;
    }

    #Conference-apply #formContainer .heading h4 {
        font-size: 18px;
        color: white;
    }

    #Conference-apply #formContainer .heading p {
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