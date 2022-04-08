<x-app-layout>
    <div class="py-12 row justify-content-center">
        <div class="mx-auto sm:px-6 lg:px-8 col-md-6">
            <h2 class="text-center">Data No Handphone</h2>
            <form id="formInputJTI" action="{{ route('api.jti.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phoneNumber">No Handphone</label>
                    <input type="text" 
                        class="form-control" 
                        name="phone_number" 
                        id="phoneNumber" 
                        placeholder="Nomor Handphone" 
                        value="{{ old('phone_number') }}"
                        maxlength="15"
                        required>
                </div>
                <div class="form-group">
                    <label for="provider">Provider</label>
                    <select class="form-control" name="provider" id="provider" required>
                        @if( old('provider') )
                            <option selected>{{  old('provider') }}</option>
                        @else
                            <option disabled selected hidden value="">Pilih provider</option>
                        @endif
                        @foreach ( $providers as $provider )
                            <option>{{ $provider }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="my-2 text-end">
                    <button id="jtiSave" type="submit" class="btn btn-lg btn-success">Save</button>
                    <button id="jtiAuto" type="button" class="btn btn-lg btn-primary">Auto</button>
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

            $('#jtiAuto').click(function() {
                $(this).prop('disabled', true);
                $('#jtiSave').prop('disabled', true);
                $(this).after(`<div id="febriSpinner" class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>`)
                $.ajax({
                    headers : {
                        "Authorization" : "Bearer " + "{{ session()->get('api_key') }}"
                    },
                    type: "POST",
                    url : "{{ route('api.jti.auto') }}"
                }).done(function(result) {
                    window.location = "{{ route('jti') }}";
                }).always(function() {
                    $('#febriSpinner').remove();
                    $('#jtiSave').prop('disabled', false);
                    $(this).prop('disabled', false);
                })
            })
        })
    </script>
</x-app-layout>