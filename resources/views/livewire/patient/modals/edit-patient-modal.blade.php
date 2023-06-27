<div wire:ignore.self class="modal fade" id="showEditPatienModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    µaria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><strong>DETAIL DE LA FACTURE</strong></h5>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                @if ($patient != null)
                    @livewire('patient.edit-patient', ['patient' => $patient])
                @endif

            </div>
        </div>
    </div>
</div>
