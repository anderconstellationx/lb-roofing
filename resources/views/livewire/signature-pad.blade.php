<div class="card-body">
    <div id="signaturePath" hidden>
        <div class="main-content-label mg-b-5">
            {{__('lang.signature.signature')}}
        </div>
        <div id="wrapper-pad" class="wrapper">
            <canvas id="signature-pad" class="signature-pad" width=400 height=200
                    style="border: 1px solid #e8e8f7 !important" wire:model.live="signature"></canvas>
        </div>
        <div class="btn-list text-center">
        <button id="undo" class="btn ripple btn-outline-danger btn-rounded">Undo</button>
        <button id="clear" class="btn ripple btn-outline-warning btn-rounded">Clear</button>
    </div>
    </div>
</div>
