<x-app-layout>
    <div class="py-12 row">
        <div class="mx-auto sm:px-6 lg:px-8 col-md-6">
            <h2 class="text-center">Update Data</h2>
            <form id="formInputJTI" action="{{ route('api.jti.update', [ $jti_form['id'] ]) }}" method="post">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="phoneNumber">No Handphone</label>
                    <input type="text" 
                        class="form-control"
                        name="phone_number"
                        id="phoneNumber"
                        placeholder="Nomor Handphone"
                        value="{{ $jti_form['phone_number'] }}"
                        maxlength="15"
                        required>
                </div>
                <div class="form-group">
                    <label for="provider"></label>
                    <select class="form-control" name="provider" id="provider" required>
                        <option selected hidden>{{  $jti_form['provider'] }}</option>
                        <option>Telkomsel</option>
                        <option>Indosat Ooreodo</option>
                        <option>XL Axiata</option>
                        <option>Smartfren</option>
                        <option>Lainnya</option>
                    </select>
                </div>
                <div class="my-2 text-end">
                    <button type="submit" class="btn btn-block btn-success">Edit</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready( function() {
            const formInputJTI = document.getElementById('formInputJTI');
            $('#formInputJTI').submit(function(submitEvent) {
                submitEvent.preventDefault();
                let formInputJTIData = new FormData( formInputJTI );
                $.ajax({
                    headers : {
                        "Authorization" : "Bearer " + "{{ session()->get('api_key') }}"
                    },
                    type: $(this).prop('method'),
                    url : $(this).prop('action'),
                    data: formInputJTIData,
                    processData : false,
                    contentType : false
                }).done(function(result) {
                    window.location = "{{ route('jti') }}";
                });
            })
        })
    </script>
</x-app-layout>