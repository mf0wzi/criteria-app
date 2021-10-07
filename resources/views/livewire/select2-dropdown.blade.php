<div>
    <div wire:ignore>
        <select class="select2-dropdown form-control">
            <option value="">Select Option</option>
            @foreach($webseries as $keys => $item)
                <option value="{{ $keys }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>

</div>

@push('scripts')

    <script>
        $(document).ready(function () {
            $('.select2-dropdown').select2();
            $('.select2-dropdown').on('change', function (e) {
                var data = $('.select2-dropdown').select2("val");
            @this.set('ottPlatform', data);
            });
        });

    </script>
@endpush
</div>
