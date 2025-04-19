@props(['route', 'dark' => false])

<form action="{{ $route }}" method="POST" class="contact-one__form">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>First Name:</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>Last Name:</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>Phone:</label>
                <input type="number" name="phone" pattern="[0-9]*" value="{{ old('phone') }}" required>
            </p>
        </div>
        <div class="col-lg-12">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>Subject:</label>
                <input type="text" name="subject" value="{{ old('subject') }}" required>
            </p>
        </div>
        <div class="col-lg-12">
            <p class="contact-one__field">
                <label @if($dark) style="color:white;" @endif>Message:</label>
                <textarea name="message" required>{{old('message')}}</textarea>
                <button type="submit" class="thm-btn contact-one__btn" @if($dark) style="background-color: #d99578; color: #fff;" @endif>
                    Send Message
                </button>
            </p>
        </div>
    </div>
</form> 