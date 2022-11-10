<x-front-layout title="Show Order">
    @push('styles')
        <link rel='stylesheet' type='text/css'
              href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    @endpush
    <x-slot:breadcrumbs>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Order #{{$order->number}}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{route('home')}}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href=""><i class="lni lni-cart"></i> Orders</a></li>
                            <li>Order #{{$order->number}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumbs>
    <section class="checkout-wrapper section">
        <div id="map-div" style="height: 100vh;"></div>

    </section>
    @push('scripts')
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/services/services-web.min.js"></script>
        <script>
            const API_KEY = '36B8vdOglOTDSvV5K57CpqdLBnRcoMUK';
            const APPLICATION_NAME = 'ZIR STORE';
            const APPLICATION_VERSION = '1.0';
            tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

            const GOLDEN_GATE_BRIDGE = {lng: {{$delivery->lng}}, lat: {{$delivery->lat}}};

            var map = tt.map({
                key: API_KEY,
                container: 'map-div',
                center: GOLDEN_GATE_BRIDGE,
                zoom: 12
            });

            var marker = new tt.Marker()
                .setLngLat([GOLDEN_GATE_BRIDGE.lng, GOLDEN_GATE_BRIDGE.lat])
                .addTo(map);
            marker.color = "blue";
            map.addControl(new tt.FullscreenControl({
                container: document.querySelector('.checkout-wrapper')
            }));
        </script>
            <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
            <script>

                // Enable pusher logging - don't include this in production
                Pusher.logToConsole = true;

                var pusher = new Pusher('31d339496183f28778c3', {
                    cluster: 'ap2'
                });

                var channel = pusher.subscribe('deliveries');
                channel.bind('App\\Events\\DeliveryLocationUpdated', function(data) {
                   var marker = new tt.Marker()
                        .setLngLat([GOLDEN_GATE_BRIDGE.lng, GOLDEN_GATE_BRIDGE.lat])
                        .addTo(map);

                });
            </script>
    @endpush
</x-front-layout>
