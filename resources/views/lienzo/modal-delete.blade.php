<!-- Basic modal -->
<div id="lienzo{{$item->id}}" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-backdrop="lienzo{{$item->id}}" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                 <p> ¿ Esta seguro de eliminar? </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn bg-primary" data-dismiss="modal" onclick="eliminar('{{$item->id}}');" >Eliminar</button>
            </div>
        </div>
    </div>
</div>
<!-- /basic modal -->