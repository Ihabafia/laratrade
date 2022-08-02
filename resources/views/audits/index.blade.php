<x-admin-backend-layout
    title="{{ __('labels.audit-trail-title') }}"
>
    <x-app.page-title page-title="{{ __('labels.audit-trail-title') }}" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <table class="datatables table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('labels.date-label') }}</th>
                            <th>{{ __('labels.description-label') }}</th>
                            <th>{{ __('labels.model-label') }}</th>
                            <th>{{ __('labels.caused-by') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($audits as $audit)
                        <tr>
                            <td >{{ $audit->created_at->format('Y-m-d') }}</td>
                            <td >{!! $audit->link !!}</td>
                            <td >{{ $audit->modelName($audit->subject_type) }}</td>
                            <td >{{ $audit->causer->full_name ?? 'The System' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-gray size-32 text-center fw-500">There are no trails yet</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('css_after')
        <link rel="stylesheet" href="{{ asset('/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
        <link rel="stylesheet"
              href="{{ asset('/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
    @endpush
    @push('js_after')
        <x-datatables-js />

        <script>
            $(document).ready( function () {
                $('.datatables').DataTable({
                    "bSort": true,
                    "pageLength": 25,
                    "stateSave": false,
                    "order": [ 0, 'desc' ],
                    "columnDefs": [{
                        className: 'control',
                    }],
                });
            });
        </script>
    @endpush
</x-admin-backend-layout>
