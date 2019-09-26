@extends('layouts.default')
@section('title', 'Conviertete en VIP')
@section('content')
<section class="section-vip-background">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1 class="text-poppins  font-weight-bold">&iexcl;Conviertete en un Very Important Player!</h1>
            </div>
        </div>
    </div>
</section><br>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h2>&iexcl;Obtén beneficios geniales ahora!</h2><br>
            <div class="row">
                <div class="col-6 col-md-4 mb-2">
                    <div class="card card-no-shadow">
                        <div class="card-body">
                            <i class="fas fa-sliders-h fa-3x mb-2 text-secondary"></i>
                            <h3>Elige y cambia tu skin en el server</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-2">
                    <div class="card card-no-shadow">
                        <div class="card-body">
                            <i class="fas fa-tag fa-3x mb-2 text-secondary"></i>
                            <h3>Obtén el clan TAG [VIP] en el chat</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-2">
                    <div class="card card-no-shadow">
                        <div class="card-body">
                            <i class="fas fa-user fa-3x mb-2 text-secondary"></i>
                            <h3>Cambia tu nickname</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-2">
                    <div class="card card-no-shadow">
                        <div class="card-body">
                            <i class="fas fa-home fa-3x mb-2 text-secondary"></i>
                            <h3>Obtén el doble de residencias y rentas</h3>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 mb-2">
                    <div class="card card-no-shadow">
                        <div class="card-body">
                            <i class="fas fa-unlock fa-3x mb-2 text-secondary"></i>
                            <h3>Desbloquea kits especiales para modos de juego</h3>
                        </div>
                    </div>
                </div>
            </div>

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