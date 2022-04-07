<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-center">Output</h2>
            <div class="row">
                <div class="col-md-6 border mb-2">
                    <table class="table  text-center">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col"><h3>Ganjil</h3></th>
                            </tr>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No.HP</th>
                                <th scope="col">Provider</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jti_outputs['odd'] as $jti_output_odd)
                                <tr>
                                    <th>{{ $loop->index+1 }}</th>
                                    <td>{{ $jti_output_odd['phone_number'] }}</td>
                                    <td>{{ $jti_output_odd['provider'] }}</td>
                                    <th>
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="{{ route('jti.edit', [ $jti_output_odd['id'] ]) }}" role="button" class="btn btn-sm btn-warning">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger delete-jti" data-action="{{ route('api.jti.destroy', [ $jti_output_odd['id'] ]) }}">Hapus</button>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 border mb-2">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th colspan="4" scope="col"><h3>Genap</h3></th>
                            </tr>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No.HP</th>
                                <th scope="col">Provider</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jti_outputs['even'] as $jti_output_even)
                                <tr>
                                    <th>{{ $loop->index+1 }}</th>
                                    <td>{{ $jti_output_even['phone_number'] }}</td>
                                    <td>{{ $jti_output_even['provider'] }}</td>
                                    <th>
                                        <div class="btn-group" role="group" aria-label="Aksi">
                                            <a href="{{ route('jti.edit', [ $jti_output_even['id'] ]) }}" role="button" class="btn btn-sm btn-warning">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger delete-jti" data-action="{{ route('api.jti.destroy', [ $jti_output_even['id'] ]) }}">Hapus</button>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-jti').on('click', function() {
                $.ajax({
                    headers : {
                        "Authorization" : "Bearer " + "{{ session()->get('api_key') }}"
                    },
                    type: "POST",
                    url : $(this).data('action'),
                    data: {
                        _method : "DELETE"
                    }
                }).done(function(result) {
                    window.location = "{{ route('jti') }}";
                })
            })
        })
    </script>
</x-app-layout>