<div class="container-fluid">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-uppercase">🗂️Gestionnaire des patients</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">📈Dashboard</a></li>
                    <li class="breadcrumb-item active">📂List Patientt</li>
                </ol>
            </div>
        </div>
    </div>
    @livewire('patient.new-patient')
    @include('livewire.patient.modals.edit-patient-modal')
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                @foreach ($listSheetTypePatient as $type)
                    <li class="nav-item"><a
                            class="nav-link {{ $selectedIndex == $type->id ? 'active' : '' }} "href="#prive"
                            wire:click.prevent='changeIndex({{ $type }})' data-toggle="tab">
                            📂 {{ $type->name }}</a></li>
                @endforeach

            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="prive">
                    <div class="w-25">
                        <div class="form-group">
                            <x-form.input type="text" placeholder="Rechercher ici..." wire:model='keyToSearch' />
                        </div>
                    </div>
                    <table class="table table-stripped table-sm">
                        <thead class="bg-sidebar text-white">
                            <tr class="text-uppercase">
                                <th>N° Fiche</th>
                                <th>Nom patient</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Genre</th>
                                <th class="text-center">Groupe sanguin</th>
                                <th class="text-left">Type</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listSheets as $sheet)
                                <tr>
                                    <td>{{ $sheet->sheet_number }}</td>
                                    <td>{{ $sheet->patient->full_name }}</td>
                                    <td class="text-center">{{ $sheet->patient->getAge() }}</td>
                                    <td class="text-center">{{ $sheet->patient->gender }}</td>
                                    <td class="text-center">{{ $sheet->patient->bloodGroup->name }}</td>
                                    <td class="text-left">{{ $sheet->getTypeSheet() }}</td>
                                    <td class="text-center">
                                        <x-form.button type="button" class="btn-sm text-primary" data-toggle="modal"
                                            data-target="#showEditPatienModal">
                                            <i class="fas fa-edit"></i>
                                        </x-form.button>
                                        <x-form.button type="button" class="btn-sm text-primary">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </x-form.button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
