<form action="{{ route('imentet.events.feedback', $event->id) }}" method="POST" class="contact-one__form">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Your Name </label>
                <input type="text" name="fullName" value="{{ auth()->user()->fullName ?? old('fullName')}}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email ?? old('email')}}" required>
            </p>
        </div>
        <div class="col-lg-12">
            <p class="contact-one__field">
                <label>Your Feedback</label>
                <textarea name="review" required>{{ old('review') }}</textarea>
                <button type="submit" class="thm-btn contact-one__btn"> Submit </button>
            </p>
        </div>
    </div>
</form>