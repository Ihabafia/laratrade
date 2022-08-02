<x-admin-backend-layout
    title="{{ __('custom-messages.list-of-__model__', ['model' => 'Communications']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.list-of-__model__', ['model' => 'Communications']) }}">
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-between">
                    <h4 class="mb-0">
                        {{ __('custom-messages.list-of-__model__', ['model' => 'Emails']) }}
                    </h4>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-unlock-alt"></i>  {{ __('buttons.create') }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            @foreach(\App\Enums\Communication::cases() as $type)
                                <li><a class="dropdown-item" href="{{ route('communications.create', ['type' => $type->value]) }}">{{ $type->label() }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-vcenter js-dataTable-communications">
                            <thead>
                                <tr>
                                    <th style="width: 23%">Title</th>
                                    <th style="width: 8%">Type</th>
                                    <th style="width: 23%">Subject</th>
                                    <th style="width: 40%">Body</th>
                                    <th style="width: 6%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse(isset($communications['Email']) ? $communications['Email'] : [] as $id => $item)
                                <tr>
                                    <td style="width: 23%"><a href="{{ route('communications.edit', [$item->slug, 'type' => $item->type]) }}">{{ $item->title }}</a></td>
                                    <td style="width: 8%">{!! pill(\App\Enums\Communication::from($item->type)->label(), \App\Enums\Communication::from($item->type)->color()) !!}</td>
                                    <td style="width: 23%" class="fs-">{{ $item->subject }}</td>
                                    <td style="width: 40%" class="fs-sm"><code>{!! str($item->bodyBr)->limit(200) !!}</code></td>
                                    <td style="width: 6%" class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('communications.edit', [$item->slug, 'type' => $item->type]) }}">
                                                    <i data-feather="edit-2" class="me-50"></i>
                                                    <span>{{ __('custom-messages.edit-type', ['type' =>  "Email"]) }}</span>
                                                </a>
                                                <a class="dropdown-item" target="_blank" href="{{ route('communication.preview', $item) }}">
                                                    <i data-feather="eye" class="me-50"></i>
                                                    <span>{{ __('custom-messages.preview-type', ['type' =>  "Email"]) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-gray size-24 text-center fw-500">There are no email at this time</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-between">
                    <h4 class="mb-0">
                        {{ __('custom-messages.list-of-__model__', ['model' => "SMS's"]) }}
                    </h4>
                    {{--<div class="btn-group" role="group">
                        <a href="{{ route('communications.create', ['type' => 'SMS']) }}" class="btn btn-info">
                            <i class="fa fa-unlock-alt"></i> Create
                        </a>
                    </div>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-vcenter js-dataTable-communications">
                            <thead>
                                <tr>
                                    <th style="width: 23%">Name</th>
                                    <th style="width: 7%">Type</th>
                                    <th style="width: 23%">Subject <small class="fw-normal" style="text-transform: initial">{{ __('messages.sms-subject-warning') }}</small></th>
                                    <th style="width: 41%">Body</th>
                                    <th style="width: 6%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse(isset($communications['SMS']) ? $communications['SMS'] : [] as $id => $item)
                                <tr>
                                    <td style="width: 23%">{{ $item->title }}</td>
                                    <td style="width: 7%">{!! pill(\App\Enums\Communication::from($item->type)->label(), \App\Enums\Communication::from($item->type)->color()) !!}</td>
                                    <td style="width: 23%" class="fs-">{{ $item->subject }}</td>
                                    <td style="width: 41%" class="fs-sm"><code class="">{!! nl2br($item->body) !!}</code></td>
                                    <td style="width: 6%" class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('communications.edit', [$item->slug, 'SMS']) }}">
                                                    <i data-feather="edit-2" class="me-50"></i>
                                                    <span>{{ __('custom-messages.edit-type', ['type' =>  "SMS"]) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-gray size-24 text-center fw-500">There are no SMSs at this time</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @once
        @push('css_after')
            <link rel="stylesheet" href="{{ asset('/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
            <link rel="stylesheet" href="{{ asset('/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
            <link rel="stylesheet"
                  href="{{ asset('/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
        @endpush
        @push('js_after')
        <!-- Page JS Plugins -->
            <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
            <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
            <!-- Page JS Code -->
            <script src="{{ asset('js/pages/be_tables_datatables.js') }}"></script>
        @endpush
    @endonce
</x-admin-backend-layout>
