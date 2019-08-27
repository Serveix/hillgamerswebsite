@extends('layouts.default')
@section('title', 'Conviertete en VIP')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>&iexcl;Conviertete en un Very Important Player!</h1>
                <hr>
                <h2>&iexcl;Obten beneficios geniales ahora!</h2>
                <ul>
                    <li>Elige y cambia tu skin en el server</li>
                    <li>Obten el clan TAG [VIP] en el chat</li>
                    <li>Cambia tu nickname</li>
                    <li>Obten el doble de residencias y rentas</li>
                    <li>Desbloquea kits especiales para modos de juego</li>
                </ul>

                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_CLIENT_ID') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        paypal.Buttons({
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ env('MONTHLY_PRICE') }}'
                        }
                    }]
                })
            },
            onApprove: (data, actions) => {
                debugger;
                return actions.order.capture()
                    .then(details => registeringRequest(data))
                    .catch(details => {
                        swal("Payment connection failed", `There was an error connecting to the payments platform. We are investigating, please, reload the page or try again later.`,
                            "warning")
                        console.log(details)
                    })
            }
        }).render('#paypal-button-container');

        function registeringRequest(data)
        {
            swal({
                title: '¡Grácias!',
                text: 'Tu pago ha sido tomado y estamos convirtiendote en VIP',
                button: {
                    text: '¡Excelente!'
                }
            })

            $.ajax({
                type: 'POST',
                url: '{{ route('vip')  }}',
                data: {
                    orderId: data.orderID,
                }
            }).done((response, status) => {
                if (response.success &&
                    status === 'success' &&
                    response.message === 'COMPLETED') {
                    console.log('success')
                    swal.stopLoading()

                } else {
                    swal.stopLoading()
                    swal.close()
                    swal('Error connecting to server', 'Error while processing payment', 'error')
                }
            }).catch((e) => {
                console.log(e)
            })
        }
    </script>

@endsection