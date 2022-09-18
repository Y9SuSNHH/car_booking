@extends('layout_backend.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.cars.update', $user )}}" method="POST" enctype="multipart/form-data"
                          class="form-group">
                        @method('PUT')
                        @csrf
                        <div id="div-error" class="alert alert-danger d-none"></div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="name">Tên xe</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                            </div>
                            <div class="form-group select-location col-3">
                                <label for="select-address">Tỉnh/TP</label>
                                <select class="form-control select-address" name="address" id='select-address'></select>
                            </div>
                            <div class="form-group select-location col-3">
                                <label for="select-address2">Quận/Huyện</label>
                                <select class="form-control select-address2" name="address2"
                                        id='select-address2'></select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script src="{{asset('js/component.fileupload.js')}}"></script>
    <script src="{{asset('js/image-uploader.min.js')}}"></script>
    <script type="text/javascript">
        async function loadDistrict(parent) {
            $("#select-address2").empty();
            const path = $("#select-address option:selected").data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            const address2 = await response.json();
            const district = "{{$user->address2}}";
            $.each(address2.district, function (index, each) {
                let selected = '';
                let select = each.pre+' '+ each.name;
                if (district === select) {
                    selected = 'selected';
                }
                $("#select-address2").append(`
                        <option ${selected}>
                            ${each.pre} ${each.name}
                        </option>`);
            })
        }

        function generateSlug(name) {
            $.ajax({
                url: '{{ route('api.cars.slug.generate') }}',
                type: 'POST',
                dataType: 'json',
                data: {name},
                success: function (response) {
                    $("#slug").val(response.data);
                    $("#slug").trigger("change");
                },
                error: function (response) {
                }
            });
        }

        function showError(errors) {
            let string = '<ul>';
            if (Array.isArray(errors)) {
                errors.forEach(function (each) {
                    each.forEach(function (error) {
                        string += `<li>${error}</li>`;
                    });
                });
            } else {
                string += `<li>${errors}</li>`;
            }
            string += '</ul>';
            $("#div-error").html(string);
            $("#div-error").removeClass("d-none").show();
            notifyError(string);
        }

        function preview_image() {
            var total_file = document.getElementById("fullphoto").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' style='max-width: 300px; max-height:200px;'>");
            }
        }

        $(document).ready(async function () {
            $("#select-address").select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const address = await response.json();
            const city = "{{$user->address}}";
            $.each(address, function (index, each) {
                let selected = '';
                if (city === index) {
                    selected = 'selected';
                }
                $("#select-address").append(`
                <option value='${index}' data-path='${each.file_path}' ${selected}>
                    ${index}
                </option>`);
            })

            $("#select-address").change(function () {
                loadDistrict();
            });
            $("#select-address2").select2();
            await loadDistrict();

            $(document).on('change', '#name', function () {
                const name = $("#name").val();
                generateSlug(name);
            })

            $("#slug").change(function () {
                $("#btn-submit").attr('disabled', true);
                $.ajax({
                    url: '{{ route('api.cars.slug.check') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {slug: $(this).val()},
                    success: function (response) {
                        if (response.success) {
                            $("#btn-submit").attr('disabled', false);
                        }
                    }
                });
            })
        });
    </script>
@endpush
