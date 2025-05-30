@extends('backend.layout.app')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-o9N1j7kGStpHtjt7FUF2KpzKzFfKzB8QL6T+JTVRZms=" crossorigin="" />
<style>
    #map {
        height: 600px;
        width: 100%;
    }

    .attachment-section {
        padding: 20px;
    }

    .attachment-section h5 {
        margin-bottom: 10px;
    }

    .attachment-images img {
        width: 100px;
        height: auto;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #loadingIndicator {
        position: fixed;
        top: 0;
        left: 0;
        height: 4px;
        background-color: #007bff;
        z-index: 9999;
        display: none;
        transition: width 0.3s ease;
    }
</style>
@endpush

@section('Content')
<div id="loadingIndicator"></div>

<div class="pagetitle">
    <h1>Incident Live Map</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Live Map</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-3">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- NEW ATTACHMENT PREVIEW SECTION -->
<section class="section attachment-section">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Incident Attachments</h4>


            <div class="row">
                <div class="col-md-6">

                    <div class="attachment-images">
                        <h5>Before Resolution</h5>
                        @foreach ($beforeAttachments as $img)
                        <img src="{{ asset($img->attachement) }}" alt="Before Image"
                            class="img-fluid rounded shadow-sm mb-2 zoomable"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal"
                            data-img="{{ asset($img->attachement) }}" />
                    @endforeach
                    </div>


                </div>
                <div class="attachment-images mt-4">
                    <h5>After Resolution</h5>
                    @foreach ($afterAttachments as $img)
                    <img src="{{ asset($img->attachement) }}" alt="After Image"
                        class="img-fluid rounded shadow-sm mb-2 zoomable"
                        data-bs-toggle="modal"
                        data-bs-target="#imageModal"
                        data-img="{{ asset($img->attachement) }}" />
                @endforeach
                </div>
            </div>

        </div>
    </div>
</section>



<!-- Image Zoom Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Zoomed Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <img id="zoomedImage" src="" alt="Zoomed" class="img-fluid rounded" />
        </div>
      </div>
    </div>
  </div>









<!-- NEW INFORMATION SECTION -->
<section class="section info-section mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Incident Details</h4>
            <dl class="row">
                <dt class="col-sm-3">Title</dt>
                <dd class="col-sm-9">{{ $incidence->tittle }}</dd>

                <dt class="col-sm-3">Description</dt>
                <dd class="col-sm-9">{{ $incidence->description }}</dd>

                <dt class="col-sm-3">Contact Name</dt>
                <dd class="col-sm-9">{{ $incidence->user_name }}</dd>

                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $incidence->phone }}</dd>

                <dt class="col-sm-3">Region</dt>
                <dd class="col-sm-9">{{ $incidence->region }}</dd>

                <dt class="col-sm-3">District / Ward</dt>
                <dd class="col-sm-9">{{ $incidence->district }} / {{ $incidence->ward }}</dd>

                <dt class="col-sm-3">Assigned Company</dt>
                <dd class="col-sm-9">{{ $incidence->consultant->name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Resolve Status</dt>
                <dd class="col-sm-9">{{ $incidence->statuses->name ?? 'Unknown' }}</dd>

                <dt class="col-sm-3">Travel</dt>
                <dd class="col-sm-9" id="distanceKm">Calculating...</dd>


                {{-- Optional: Distance from current location --}}
                {{-- <dt class="col-sm-3">Distance</dt>
                <dd class="col-sm-9">XX km (to be calculated in JS or controller)</dd> --}}
            </dl>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-vm0xG2IekpIqK0leqHhCPtqYZBlK8pFQ91bT9ZjjTk8=" crossorigin=""></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            startLoading();

            try {
                const data = @json($incidence);
                const item = Array.isArray(data) ? data[0] : data;

                if (!item || !item.latitude || !item.longitude) {
                    console.warn("WARNING: Missing latitude or longitude.");
                    return stopLoading();
                }

                const incidentLat = parseFloat(item.latitude);
                const incidentLng = parseFloat(item.longitude);

                // Init map
                const map = L.map('map').setView([incidentLat, incidentLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([incidentLat, incidentLng])
                    .addTo(map)
                    .bindPopup(item.title || 'Incident Location')
                    .openPopup();

                // Get current location and calculate distance
                if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            const distance = calculateDistance(incidentLat, incidentLng, userLat, userLng);
                            console.log("Distance:", distance.toFixed(2), "km");

                            const distanceElement = document.getElementById('distanceKm');
                            if (distanceElement) {
                                distanceElement.textContent = `${distance.toFixed(2)} km`;
                            }
                        },
                        function (error) {
                            console.error("ERROR: Cannot access location", error);
                            const distanceElement = document.getElementById('distanceKm');
                            if (distanceElement) {
                                distanceElement.textContent = 'Unable to access location';
                            }
                        }
                    );
                } else {
                    console.warn("Geolocation not available");
                }

            } catch (error) {
                console.error("ERROR: Map rendering failed", error);
            } finally {
                stopLoading();
            }

            // Image zoom modal
            const imageModal = document.getElementById('imageModal');
            const zoomedImage = document.getElementById('zoomedImage');

            imageModal.addEventListener('show.bs.modal', function (event) {
                const triggerImg = event.relatedTarget;
                if (triggerImg) {
                    const imgUrl = triggerImg.getAttribute('data-img');
                    zoomedImage.src = imgUrl;
                }
            });

            imageModal.addEventListener('hidden.bs.modal', function () {
                zoomedImage.src = '';
            });
        });

        function startLoading() {
            const loader = document.getElementById('loadingIndicator');
            loader.style.width = '0%';
            loader.style.display = 'block';
            setTimeout(() => loader.style.width = '100%', 50);
        }

        function stopLoading() {
            const loader = document.getElementById('loadingIndicator');
            setTimeout(() => {
                loader.style.width = '100%';
                setTimeout(() => {
                    loader.style.display = 'none';
                    loader.style.width = '0%';
                }, 300);
            }, 300);
        }

        // Haversine formula to calculate distance
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of Earth in km
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }

        function toRad(degrees) {
            return degrees * Math.PI / 180;
        }
    </script>

@endpush
