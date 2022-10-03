@props(['id'])
<input type="text" {{ $attributes }} class="form-control datetimepicker-input" id="{{ $id }}"
    data-toggle="datetimepicker" data-target="#{{ $id }}"
    onchange="this.dispatchEvent(new InputEvent('input'))" />

@push('script')
    <script>
        $(function() {
            $('#{{ $id }}').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endpush
