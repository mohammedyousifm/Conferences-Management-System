@extends('4-layout.frantend')
@section('content')

    <div id="Conference-Details" class="container pt-5">

        <!-- Conference Details Section -->
        <div class="row align-items-center g-5 left-top-circle h-100">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold  mb-4">Conference Details</h1>
                <h2 class="display-4 fw-bold  mb-2">{{ $Conference->title }}</h2>
                <p class="lead text-muted">{{ $Conference->description }}</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="bi text-bg bi-calendar-event"></i> Date: 15th October
                        {{ $Conference->registration_deadline }}
                    </li>
                    <li><i class="bi text-bg bi-geo-alt"></i> Location: {{ $Conference->location }}</li>
                    <li><i class="bi text-bg bi-people "></i> Speakers: Industry Experts & Leaders</li>
                </ul>

                <!-- Apply Now Button -->
                <a href="{{ route('conference.indexApply', $Conference->title) }}" class="btn bg text mt-3 shadow-sm">
                    Apply Now
                </a>

            </div>


            <!-- Conference Image -->
            <div class="col-lg-6 text-center">
                <div class="conference-img-wrapper">
                    <img src="{{ asset('3-images/scso-sgi.webp') }}" alt="Conference Image"
                        class="img-fluid rounded shadow-lg zoom-effect">
                </div>
            </div>

        </div>

        <!-- Application Form -->
        <div id="formContainer" class="mt-2 container pt-2 pb-2 border rounded shadow-sm bg-light">
            <form action="{{ route('conference.apply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Author Information -->
                <div id="step1">
                    <div class="heading p-2 bg text-center">
                        <h4>Step 1: Author Information</h4>
                        <p class="mt-1">Please provide your personal details, including your name and email, so we can
                            identify you as the author of the paper.</p>
                    </div>
                    <input type="hidden" value="{{ $Conference->id }}" name="conference_id">
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
                        <input type="number" name="number_of_authors" id="number_of_authors" class="form-control" required
                            min="1" placeholder="Enter Number of Authors">
                    </div>

                    <button type="button" class="btn bg text btn-sm" id="nextStep">Next</button>
                    <button type="button" class="btn btn-danger btn-sm" id="closeForm">Close</button>
                </div>

                <!-- Step 2: Paper Details (Hidden initially) -->
                <div id="step2" style="display: none;">
                    <div class="heading p-2 bg text-center">
                        <h4>Step 2: Paper Details</h4>
                        <p class="mt-1">Please provide Details about the papers , including paper title and paper file, so
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

        <!-- JavaScript -->
        <script>

            document.addEventListener("DOMContentLoaded", function () {
                // Buttons
                const applyBtn = document.getElementById("applyBtn");
                const closeForm = document.getElementById("closeForm");
                const nextStep = document.getElementById("nextStep");
                const backStep = document.getElementById("backStep");
                const submitForm = document.getElementById("submitForm");

                // Form elements
                const formContainer = document.getElementById("formContainer");
                const step1 = document.getElementById("step1");
                const step2 = document.getElementById("step2");

                // Input fields
                const authorName = document.getElementById("authorName");
                const authorEmail = document.getElementById("authorEmail");
                const authorPhone = document.getElementById("authorphone");
                const paperTitle = document.getElementById("paperTitle");
                const paperAbstract = document.getElementById("paperAbstract");

                // Show form with animation
                applyBtn.addEventListener("click", function () {
                    formContainer.classList.add("show");
                });

                // Close form and reset fields
                closeForm.addEventListener("click", function () {
                    resetForm();
                    formContainer.classList.remove("show");
                });

                // Navigate to Step 2
                nextStep.addEventListener("click", function () {
                    if (validateStep(step1)) {
                        step1.style.display = "none";
                        step2.style.display = "block";
                    }
                });

                // Navigate back to Step 1
                backStep.addEventListener("click", function () {
                    step2.style.display = "none";
                    step1.style.display = "block";
                });

                // Submit the form
                submitForm.addEventListener("click", function () {
                    if (validateStep(step2)) {
                        alert("✅ Form submitted successfully!");
                        resetForm();
                        formContainer.classList.remove("show");
                    }
                });

                // Validate all fields in a step
                function validateStep(stepElement) {
                    const inputs = stepElement.querySelectorAll("input, textarea");

                    for (let input of inputs) {
                        if (input.value.trim() === "") {
                            alert("⚠ Please fill in all fields before proceeding.");
                            return false;
                        }
                    }
                    return true;
                }

                // Reset form fields
                function resetForm() {
                    step1.style.display = "block";
                    step2.style.display = "none";
                    step3.style.display = "none";
                    authorName.value = "";
                    authorEmail.value = "";
                    authorPhone.value = "";
                    paperTitle.value = "";
                    paperAbstract.value = "";
                }
            });


        </script>

        {{-- keywords --}}
        <script>
            let keywords = [];
            const maxKeywords = 5;
            const suggestedKeywords = [
                "Cybersecurity Summit", "AI Conference", "Tech Expo", "Developer Meetup",
                "Blockchain Forum", "Data Science Summit", "Hacking Conference",
                "Cloud Computing Event", "Machine Learning Workshop", "IoT Innovations"
            ];

            function renderKeywords() {
                const container = document.getElementById("keyword-container");
                container.innerHTML = '';

                keywords.forEach((keyword, index) => {
                    const badge = document.createElement("span");
                    badge.classList.add("keyword-badge");
                    badge.textContent = keyword;
                    badge.onclick = () => removeKeyword(index);
                    container.appendChild(badge);
                });

                const input = document.createElement("input");
                input.type = "text";
                input.id = "papekeywords";
                input.className = "form-control";
                input.placeholder = keywords.length >= maxKeywords ? "" : "Enter conference keywords...";
                input.onkeydown = handleKeyDown;
                container.appendChild(input);

                document.getElementById("selected_keywords").value = keywords.join(", ");
            }

            function handleKeyDown(event) {
                if (event.key === "Enter" || event.key === ",") {
                    event.preventDefault();
                    let input = event.target.value.trim().replace(/,/g, "");
                    if (input && !keywords.includes(input) && keywords.length < maxKeywords) {
                        keywords.push(input);
                        event.target.value = "";
                        renderKeywords();
                    }
                }
            }

            function removeKeyword(index) {
                keywords.splice(index, 1);
                renderKeywords();
            }

            function showSuggestedKeywords() {
                const suggestionContainer = document.getElementById("suggested-keywords");
                suggestionContainer.innerHTML = "";
                suggestedKeywords.forEach(keyword => {
                    const button = document.createElement("button");
                    button.classList.add("btn", "btn-sm", "btn-outline-primary", "m-1");
                    button.textContent = keyword;
                    button.onclick = (e) => {
                        e.preventDefault();
                        addKeyword(keyword);
                    };
                    suggestionContainer.appendChild(button);
                });
            }

            function addKeyword(keyword) {
                if (!keywords.includes(keyword) && keywords.length < maxKeywords) {
                    keywords.push(keyword);
                    renderKeywords();
                }
            }

            document.getElementById("papekeywords").addEventListener("focus", showSuggestedKeywords);
        </script>
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
        padding-top: 50px;
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