@props(['token'])
<form action="{{ route('imentet.memberships.handle-upload') }}" method="POST" class="contact-one__form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="row">
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>First Name:</label>
                <input type="text" name="first_name" value="{{ auth()->user()->first_name ?? old('first_name')}}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Last Name:</label>
                <input type="text" name="last_name"  value="{{ auth()->user()->last_name ?? old('last_name')}}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Email:</label>
                <input type="email" name="email" value="{{ auth()->user()->email ?? old('email')}}" required>
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Phone:</label>
                <input type="number" name="phone" pattern="[0-9]*" value="{{ auth()->user()->phone ?? old('phone')}}" required>
            </p>
        </div>
        <div class="col-lg-6 mb-4">
            <p class="contact-one__field custom-file">
                <label>Personal Photo:</label>
            </p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="personal_photo"  id="personal_photo" aria-describedby="personal_photo">
                <label class="custom-file-label" for="personal_photo">Upload Personal Photo</label>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div>
                <p class="subject-picker contact-one__field custom-file">
                    <label>Are you Egyptian?</label>
               
                <select class="selectpicker" name="is_egyptian" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </p>
            </div>
        </div>
        <div class="col-lg-6 mb-4" id="personal-id-group">
            <p class="contact-one__field custom-file">
                <label>Pesronal ID:</label>
            </p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="personal_id"  id="personal_id" aria-describedby="personal_id">
                <label class="custom-file-label" for="personal_id">Upload Pesronal ID</label>
            </div>
        </div>
        <div class="col-lg-6 mb-4" id="passport-group">
            <p class="contact-one__field custom-file">
                <label>Passport:</label>
            </p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="passport"  id="passport" aria-describedby="passport">
                <label class="custom-file-label" for="passport">Upload your passport</label>
            </div>
        </div>
        <div class="col-lg-12">
            <p class="contact-one__field">
                <label>Address:</label>
                <textarea name="address" required>{{ auth()->user()->address ?? old('address')}}</textarea>
                <button type="submit" class="thm-btn contact-one__btn">Submit</button>
            </p>
        </div>
    </div>
</form>