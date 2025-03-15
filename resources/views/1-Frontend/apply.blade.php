@extends('4-layout.frantend')
@section('content')

    <div id="Conference-apply" class="container pb-5">

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
                            <!-- Hidden Author & Paper Details -->
                            <div class="d-none" id="authorDetails">
                                <div>
                                    <ul>
                                        <h1 class="display-4 fw-bold  mb-3">Author Details</h1>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Name: <span
                                                id="authorNameText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Email: <span
                                                id="authorEmailText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Phone: <span
                                                id="authorPhoneText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Author Address: <span
                                                id="authorAddressText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Number of Authors: <span
                                                id="authorNumberText"></span></li>
                                    </ul>
                                </div>
                            </div>


                            <div class="d-none" id="paperDetails">
                                <div>
                                    <ul>
                                        <h1 class="display-4 fw-bold  mb-3">Paper Details</h1>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Paper Title: <span
                                                id="paperTitleText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Abstract: <span
                                                id="paperAbstractText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Conference Keywords: <span
                                                id="paperKeywordsText"></span></li>
                                        <li><i class="fa-solid text-bg fa-arrow-right"></i> Paper File: <span
                                                id="paperFileText"></span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-6 mt-5">
                <!-- Application Form -->
                <div class="mt-2 container pt-2 pb-2 border rounded shadow-sm bg-light">
                    <!-- Form -->
                    <form action="{{ route('conference.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1 -->
                        <div id="step1">
                            <div class="heading text p-1 bg text-center">
                                <h4 class="text">Step 1: Author Information</h4>
                                <p class="mt-1 ">Please provide your personal details, including your name and email, so
                                    we
                                </p>
                            </div>

                            <input type="hidden" value="{{ $conferenceid }}" name="conference_id">
                            <div class="mt-3 mb-3">
                                <label class="form-label">Author Name</label>
                                <input type="text" class="form-control" name="author_name" id="authorName"
                                    placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="authorEmail"
                                    placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="authorPhone"
                                    placeholder="Enter your Phone Number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="authorAddress"
                                    placeholder="Enter your Address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Number of Authors</label>
                                <input type="number" class="form-control" name="number_of_authors" id="authorNumber"
                                    required min="1" placeholder="Enter Number of Authors">
                            </div>
                            <button type="button" class="btn bg text" id="nextStep1">Next</button>
                        </div>

                        <!-- Step 2 -->
                        <div id="step2" class="d-none">
                            <div class="heading p-2 bg text-center">
                                <h4 class="text">Step 2: Paper Details</h4>
                                <p class="mt-1 text">Provide paper details.</p>
                            </div>
                            <div class="mt-3 mb-3">
                                <label class="form-label">Paper Title</label>
                                <input type="text" class="form-control" name="paper_title" id="paperTitle"
                                    placeholder="Enter paper title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Abstract</label>
                                <textarea class="form-control" name="abstract" id="paperAbstract" rows="2"
                                    placeholder="Enter abstract"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Conference Keywords</label>
                                <input type="text" class="form-control" name="keywords" id="paperKeywords"
                                    placeholder="Enter conference keywords">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Paper</label>
                                <input type="file" class="form-control" name="paper_file" id="paperFile">
                            </div>
                            <button type="button" class="btn bg text" id="nextStep2">Next</button>
                        </div>

                        <!-- Submit Button -->
                        <div id="submitSection" class="d-none mt-3">
                            <div class="heading p-2 bg text-center">
                                <h4 class="text">Step 3: Submit Details</h4>
                                <p class="mt-1 text">pleac make sure of your Details.</p>
                            </div>
                            <button type="submit" class="btn bg mt-3 text" id="submitBtn">Submit</button>
                            <div class="loading" id="loadingText">Loading...</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
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

        document.getElementById("nextStep1").addEventListener("click", function () {
            const step1 = document.getElementById("step1");
            if (!validateStep(step1)) return;

            // Transfer Author Details
            document.getElementById("authorNameText").innerText = document.getElementById("authorName").value;
            document.getElementById("authorEmailText").innerText = document.getElementById("authorEmail").value;
            document.getElementById("authorPhoneText").innerText = document.getElementById("authorPhone").value;
            document.getElementById("authorAddressText").innerText = document.getElementById("authorAddress").value;
            document.getElementById("authorNumberText").innerText = document.getElementById("authorNumber").value;

            // Show Step 2 and Hide Step 1
            document.getElementById("authorDetails").classList.remove("d-none");
            step1.classList.add("d-none");
            document.getElementById("step2").classList.remove("d-none");
        });

        document.getElementById("nextStep2").addEventListener("click", function () {
            const step2 = document.getElementById("step2");
            if (!validateStep(step2)) return;

            // Transfer Paper Details
            document.getElementById("paperTitleText").innerText = document.getElementById("paperTitle").value;
            document.getElementById("paperAbstractText").innerText = document.getElementById("paperAbstract").value;
            document.getElementById("paperKeywordsText").innerText = document.getElementById("paperKeywords").value;

            // Show Submission Section and Hide Step 2
            document.getElementById("paperDetails").classList.remove("d-none");
            step2.classList.add("d-none");
            document.getElementById("submitSection").classList.remove("d-none");
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
@endsection

<style>
    .loading {
        display: none;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        background: #007bff;
        padding: 10px;
        border-radius: 5px;
        animation: blink 1s infinite alternate;
    }

    @keyframes blink {
        from {
            opacity: 1;
        }

        to {
            opacity: 0.5;
        }
    }

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