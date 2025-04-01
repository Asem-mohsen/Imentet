@extends('layout.template.gem-template')

@section('title' , 'Complete your Membership')

@section('content')

<section>
    <div class="container">
        <h2 class="text-center mt-5">Complete your Membership Registration</h2>
    </div>
</section>

<section class="contact-one pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('gem.memberships.handle-upload') }}" method="POST" class="contact-one__form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>First Name:</label>
                                <input type="text" name="first_name" value="" required>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Last Name:</label>
                                <input type="text" name="last_name"  value="" required>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Email:</label>
                                <input type="email" name="email" value="" required>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Phone:</label>
                                <input type="number" name="phone" pattern="[0-9]*" value="" required>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Pesronal ID:</label>
                                <input type="file" name="personal_id" value="" required>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Personal Photo:</label>
                                <input type="file" name="personal_photo" value="" required>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label>Are you Egyptian?</label>
                            <select class="selectpicker" name="is_egyptian" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <p class="contact-one__field">
                                <label>Passport:</label>
                                <input type="file" name="passport" value="">
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <p class="contact-one__field">
                                <label>Address:</label>
                                <textarea name="address" required></textarea>
                                <button type="submit" class="thm-btn contact-one__btn">Submit</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection