<script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.querySelector('[name="is_egyptian"]');
            const personalIdGroup = document.getElementById('personal-id-group');
            const passportGroup = document.getElementById('passport-group');
        
            function toggleFields() {
                const isEgyptian = select.value === "1";
        
                if (isEgyptian) {
                    personalIdGroup.style.display = 'block';
                    passportGroup.style.display = 'none';
                    document.getElementById('personal_id').setAttribute('required', 'required');
                    document.getElementById('passport').removeAttribute('required');
                } else {
                    passportGroup.style.display = 'block';
                    personalIdGroup.style.display = 'none';
                    document.getElementById('passport').setAttribute('required', 'required');
                    document.getElementById('personal_id').removeAttribute('required');
                }
            }
        
            select.addEventListener('change', toggleFields);
            toggleFields(); // run on page load
        });
    </script>