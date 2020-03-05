@extends('layouts.default')
@section('title', 'Conviertete en VIP')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-center my-4">
        <div class="col-md-6">
            <h3 class="text-center font-weight-bold">&iexcl;Únete ahora!</h3>

            <div class="card card-outline mb-3">
                <div class="card-body text-center">
                    <h6 class="text-primary font-weight-bold">1 Mes: $59MXN/mes</h6>
                </div>
            </div>

            <div class="card card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label for="card-holder-name">Nombre asociado a la tarjeta</label>
                        <input id="card-holder-name" class="form form-control" type="text" required>
                    </div>
                    <div class="form-group">
                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element"></div>
                    </div>

                    <div id="errors-box" class="text-danger font-weight-bold display-none"></div>

                    <button id="card-button" class="btn btn-primary" data-secret="{{ $intent->client_secret }}">
                        ¡Suscribirme!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-md-12 my-3">
            <h3 class="text-center font-weight-bold">Beneficios</h3>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card bg-primary card-no-shadow">
                <div class="card-body">
                    <i class="fas fa-sliders-h fa-3x mb-2 text-secondary"></i>
                    <h6 class="text-white">Elige y cambia tu skin en el server</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card bg-primary card-no-shadow">
                <div class="card-body">
                    <i class="fas fa-tag fa-3x mb-2 text-secondary"></i>
                    <h6 class="text-white">Obtén el clan TAG [VIP] en el chat</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card bg-primary card-no-shadow">
                <div class="card-body">
                    <i class="fas fa-user fa-3x mb-2 text-secondary"></i>
                    <h6 class="text-white">Cambia tu nickname</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="card bg-primary card-no-shadow">
                <div class="card-body">
                    <i class="fas fa-home fa-3x mb-2 text-secondary"></i>
                    <h6 class="text-white">Obtén el doble de residencias y rentas</h6>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="card bg-primary card-no-shadow">
                <div class="card-body">
                    <i class="fas fa-unlock fa-3x mb-2 text-secondary"></i>
                    <h6 class="text-white">Desbloquea kits especiales para modos de juego</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://js.stripe.com/v3"></script>
    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;
        const errorsBox = document.getElementById('errors-box');

        cardButton.addEventListener('click', async (e) => {
            errorsBox.innerHTML = '';
            errorsBox.classList.add('display-none');
            loading(true, "Verificando método de pago...");

            if (!cardHolderName.value) {
                errorsBox.innerHTML = 'El nombre es requerido.';
                errorsBox.classList.remove('display-none');
                loading(false);

                return;
            }

            //todo: only run this if paymentMethodId is not available, otherwise on server error the intentId will fail
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                console.log('error message to user', error.message);
                errorsBox.innerHTML = error.message;
                errorsBox.classList.remove('display-none');
                loading(false);
            } else {
                console.log('card verified successfully');
                loading(true, "Creando suscripción...");

                axios.post('{{ route('vip') }}', {
                    paymentMethodId: setupIntent.payment_method
                })
                    .then(res => {
                        window.location = '{{ route('success') }}'
                    })
                    .catch(error => {
                        errorsBox.innerHTML = error;
                        errorsBox.classList.remove('display-none');
                        loading(false);
                    });
            }
        });

        function loading(isInProgress, message = "Cargando...") {
            cardButton.innerHTML = isInProgress ? message : '¡Suscribirse!';
            cardButton.disabled = isInProgress;
        }
    </script>
@endsection