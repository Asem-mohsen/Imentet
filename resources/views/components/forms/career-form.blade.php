<form action="{{route('imentet.careers.store')}}" method="POST" enctype="multipart/form-data" class="contact-one__form">
    @csrf
    <div class="row">
        <div class="col-md-6">
        <p class="contact-one__field">
            <label>First Name:</label>
            <input type="text" name="first_name"  value="{{old('first_name')}}" required>
        </p>
        </div>
        <div class="col-md-6">
            <p class="contact-one__field">
                <label>Last Name:</label>
                <input type="text" name="last_name"  value="{{old('last_name')}}" required>
            </p>
        </div>
        <div class="col-md-12">
            <p class="contact-one__field">
                <label>Email:</label>
                <input type="email" name="email" value="{{old('email')}}" required>
            </p>
        </div>
        <div class="col-md-6">
            <p class="contact-one__field">
                <label>Phone:</label>
                <input type="number" name="phone" pattern="[0-9]*" value="{{old('phone')}}" required>
            </p>
        </div>
        <div class="col-md-6">
        <p class="subject-picker contact-one__field">
            <label>Career:</label>
            <select class="selectpicker" name="career_id">
                <option hidden disabled selected>Select a career</option>
                @foreach ($careers as $career)
                    <option value="{{$career->id}}" >{{$career->title}}</option>
                @endforeach
            </select>
        </p>
        </div>
        <div class="col-lg-12">
            <p class="contact-one__field">
                <label>Upload your CV:</label>
                <input type="file" name="cv" accept=".pdf,.doc,.docx" required>
            </p>
        </div>
        <div class="col-md-12">
            <p class="contact-one__field">
                <label>What Makes You the Ideal Candidate for this Position :</label>
                <textarea name="cover_letter" rows="5" required>{{old('cover_letter')}}</textarea>
            </p>
        </div>

        <div class="col-md-12">
            <p class="contact-one__field" style="text-align: center;">
                @if (auth()->user())
                    <button type="submit" class="thm-btn contact-one__btn">
                        Submit
                    </button>
                @else
                    <a href="{{route('auth.login.index')}}" class="thm-btn contact-one__btn">
                        Sign In To Continue
                    </a>  
                @endif
            </p>
        </div>
    </div>
</form>