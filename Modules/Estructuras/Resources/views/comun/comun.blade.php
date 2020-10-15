<!-- modales -->
<div class="modal fade" id="mas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masTitle"> XXX </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p id="masTexto">Continuar - cancelar</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No </button>
                <button type="button" class="btn btn-primary font-weight-bold" id="masButton">Sí</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalElimina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masTitle"> Eliminar registro </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <p>Estás eliminando un registro, esta acción ya no se podrá revertir ¿Realmente deseas eliminarlo?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No </button>
                <button class="btn btn-primary font-weight-bold" id="btnElimina">Sí, eliminarlo </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="masTitle"> Favor de esperar un momento </h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-2 col-xs-3">
                        <div class="spinner spinner-track spinner-primary spinner-lg mr-15"></div>
                    </div>
                    <div class="col-10 col-xs-9">
                        <h4>Procesando petición</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('script.comun')
    <script>
        function muestra_notificacion (r) {
            notificacion(r.style, {
                titulo: r.titulo,
                mensaje: r.mensaje,
                icon: r.icon
            });
        }


        function notificacion(type, args = {}) {
            var icon = (args.hasOwnProperty('icon')) ? args.icon : "flaticon2-information";

            icon = (icon == 'success') ? 'flaticon2-check-mark' : icon;
            icon = (icon == 'warning') ? 'flaticon2-warning' : icon;
            icon = (icon == 'error') ? 'flaticon2-danger' : icon;
            icon = (icon == 'info') ? 'flaticon2-information' : icon;
            icon += ' icon-md';

            message = (args.hasOwnProperty('mensaje')) ? args.mensaje : "";
            message += (args.hasOwnProperty('existe')) ? '\n' +args.existe : '';
            title = (args.hasOwnProperty('titulo')) ? args.titulo : "";
            delay = (args.hasOwnProperty('delay')) ? args.delay : 3000;
            icon = icon;


            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                onclick: null
            };


            toastr.options.timeOut = delay;

            if (type == 'success')
                var $toast = toastr.success(message, title);
            if (type == 'info')
                var $toast = toastr.info(message, title);
            if (type == 'warning')
                var $toast = toastr.warning(message, title);
            if (type == 'danger')
                var $toast = toastr.error(message, title);

        }




        function notificacion_notify(type, args = {}) {
            var icon = (args.hasOwnProperty('icon')) ? args.icon : "flaticon2-information";

            icon = (icon == 'success') ? 'flaticon2-check-mark' : icon;
            icon = (icon == 'check') ? 'flaticon2-check-mark' : icon;
            icon = (icon == 'warning') ? 'flaticon2-warning' : icon;
            icon = (icon == 'danger') ? 'flaticon2-danger' : icon;
            icon = (icon == 'info') ? 'flaticon2-information' : icon;
            icon += ' icon-md';

            var content = {};

            content.message = (args.hasOwnProperty('mensaje')) ? args.mensaje : "";
            content.message += (args.hasOwnProperty('existe')) ? '\n' +args.existe : '';
            content.title = (args.hasOwnProperty('titulo')) ? args.titulo : "";
            content.icon = icon;

            var notify = $.notify(content, {
                type: type,
                allow_dismiss: true,
                showProgressbar:  true,
                spacing: $('#kt_notify_spacing').val(),
                timer: $('#kt_notify_timer').val(),
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: (args.hasOwnProperty('delay')) ? args.delay : 2000
            });
        }


        function muestra_loading(opcion) {
/*
            if(opcion == 0)
                $('#modalLoading').modal('hide');
            else
                $('#modalLoading').modal('show');
*/
        }
    </script>
@endsection
