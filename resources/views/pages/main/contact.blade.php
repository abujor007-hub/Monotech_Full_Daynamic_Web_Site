
@include('common.nav')

<main class="overflow-hidden">

    <!-- Page Hero -->
    <section class="page-hero py-5">
        <div class="container py-3">

            <div class="eyebrow mb-3">Get in touch</div>

            <h1 class="display-4 fw-bold text-break">
                LET'S TALK TECH.
            </h1>

            <p class="text-secondary mt-3 mb-0">
                Questions about a component or building a new setup? Send us a
                message.
            </p>

        </div>
    </section>


    <!-- Contact Section -->
    <section class="section-pad py-5">

        <div class="container">

            <div class="row g-4 g-lg-5 align-items-start">

                <!-- Contact Information -->
                <div class="col-12 col-lg-5">

                    <h2 class="section-title mb-3">
                        How can we help?
                    </h2>

                    <p class="text-secondary lh-lg">
                        Reach out with product questions, compatibility checks or order
                        support. Send us a message and our team will get back to you.
                    </p>


                    <!-- Email -->
                    <div class="d-flex gap-3 align-items-center mt-4">

                        <i class="bi bi-envelope fs-4 flex-shrink-0"></i>

                        <div class="min-w-0">
                            <strong class="d-block">Email</strong>

                            <span class="text-secondary small text-break">
                                hello@monotech.example
                            </span>
                        </div>

                    </div>


                    <!-- Support Hours -->
                    <div class="d-flex gap-3 align-items-center mt-3">

                        <i class="bi bi-clock fs-4 flex-shrink-0"></i>

                        <div class="min-w-0">
                            <strong class="d-block">Support hours</strong>

                            <span class="text-secondary small">
                                Saturday–Thursday · 10 AM–7 PM
                            </span>
                        </div>

                    </div>

                </div>


                <!-- Contact Form -->
                <div class="col-12 col-lg-7">

                    <div class="contact-panel w-100">



                        <form action="{{ route('contact.store') }}"
                              method="POST"
                              id="contactForm"
                              class="row g-3">

                            @csrf


                            <!-- Name -->
                            <div class="col-12 col-md-6">

                                <label class="form-label small fw-bold"
                                    for="contactName">
                                    Your name
                                </label>

                                <input
                                    class="form-control w-100"
                                    type="text"
                                    name="name"
                                    id="contactName"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Full name"
                                />

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>


                            <!-- Email -->
                            <div class="col-12 col-md-6">

                                <label class="form-label small fw-bold"
                                    for="contactEmail">
                                    Email address
                                </label>

                                <input
                                    class="form-control w-100"
                                    type="email"
                                    name="email"
                                    id="contactEmail"
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="you@example.com"
                                />

                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>


                            <!-- Subject -->
                            <div class="col-12">

                                <label class="form-label small fw-bold"
                                    for="contactSubject">
                                    Subject
                                </label>

                                <select
                                    class="form-select w-100"
                                    name="subject"
                                    id="contactSubject"
                                    required>

                                    <option value="Product enquiry"
                                        {{ old('subject') == 'Product enquiry' ? 'selected' : '' }}>
                                        Product enquiry
                                    </option>

                                    <option value="Order support"
                                        {{ old('subject') == 'Order support' ? 'selected' : '' }}>
                                        Order support
                                    </option>

                                    <option value="Compatibility help"
                                        {{ old('subject') == 'Compatibility help' ? 'selected' : '' }}>
                                        Compatibility help
                                    </option>

                                    <option value="Other"
                                        {{ old('subject') == 'Other' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>

                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>


                            <!-- Message -->
                            <div class="col-12">

                                <label class="form-label small fw-bold"
                                    for="contactMessage">
                                    Message
                                </label>

                                <textarea
                                    class="form-control w-100"
                                    name="message"
                                    id="contactMessage"
                                    rows="5"
                                    required
                                    placeholder="How can we help?"
                                >{{ old('message') }}</textarea>

                                @error('message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>


                            <!-- Submit Button -->
                            <div class="col-12">

                                <button class="btn-mono" type="submit">
                                    Send message
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>

                                <p class="form-note mt-3 mb-0">
                                    Your information is submitted securely.
                                    We will get back to you soon.
                                </p>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</main>

@include('common.footer')
