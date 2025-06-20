@extends('backend.layout.app')

@section('Content')

<style>
    .image-container:hover .image-count {
      opacity: 1;
    }
  </style>

<div class="pagetitle">
  <h1>Reported Issues</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item">Reports</li>
      <li class="breadcrumb-item active">Reported Issues</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">List of Reported Issues</h5>

          <table class="table table-striped w-100">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Consultancy</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($incidences as $index => $incidence)
              <tr>
                <th scope="row">{{ $index + 1 }}</th>

                {{-- Image Column --}}
                <td>
                  @php
                    $attachments = $incidence['attachments'] ?? [];
                    $imageCount = count($attachments);
                    $firstImage = isset($attachments[0]['attachement']) ? $attachments[0]['attachement'] : null;
                  @endphp

                  @if ($firstImage)
                    <div class="image-container" style="position: relative; width: 60px; height: 60px;">
                      <img src="{{ asset($firstImage) }}" alt="Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                      <div class="image-count" style="
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        right: 0;
                        background: rgba(0, 0, 0, 0.6);
                        color: white;
                        font-size: 10px;
                        text-align: center;
                        padding: 1px;
                        opacity: 0;
                        transition: opacity 0.3s;
                        border-radius: 0 0 4px 4px;
                      ">
                        {{ $imageCount }} {{ Str::plural('image', $imageCount) }}
                      </div>
                    </div>
                  @else
                    <span>No Image</span>
                  @endif
                </td>

                {{-- Title --}}
                <td>{{ $incidence['tittle'] ?? 'N/A' }}</td>

                {{-- Description --}}
                <td>{{ $incidence['description'] ?? 'N/A' }}</td>
                <td>
                    @if(!empty($incidence->consultant->name))
                        {{ strtoupper($incidence->consultant->name) }}
                    @else
                        <span class="text-muted fst-italic">
                            <i class="bi bi-exclamation-circle-fill text-warning" title="Unassigned"></i> Unassigned
                        </span>
                    @endif
                </td>


                {{-- Status --}}
                <td>
                  @php
                    // $statusName = $incidence['status']['name'] ?? 'Unknown';
                    $statusName = $incidence->statuses->name?? "Unknown";
                    $badgeClass = match(strtolower($statusName)) {
                      'resolved' => 'bg-success',
                      'pending' => 'bg-warning text-dark',
                      'in action' => 'bg-primary',
                      default => 'bg-secondary'
                    };
                  @endphp
                  <span class="badge {{ $badgeClass }}">{{ ucfirst($statusName) }}</span>
                </td>

                {{-- Actions --}}
                <td>
                <!-- Trigger Link -->
                <a href="#" class="text-primary me-2 open-update-modal" data-id="{{ $incidence->id }}" title="Change Action">
                    <i class="bi bi-arrow-repeat"></i>
                </a>

                  <a href="#" title="Edit" class="text-primary me-2 edit-button" data-bs-toggle="modal" data-bs-target="#editActionsModal">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <input type="hidden" class="incident-id" value="{{ $incidence->id }}">

                  {{-- <a href="#" title="Edit" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#editActionsModal">
                    <i class="bi bi-pencil-square"></i>
                  </a> --}}

                  <a href="{{ route('incidencepreview', $incidence->id) }}" title="View in Map" class="text-success">
                    <i class="bi bi-geo-alt"></i>
                </a>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</section>


<div class="modal fade draggable" id="editActionsModal" tabindex="-1" aria-labelledby="editActionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editActionsModalLabel">Edit Actions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="list-group">
            <li class="list-group-item d-flex align-items-center">
              <i class="bi bi-arrow-repeat me-2"></i>
              <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#changeStatusModal">Change Status</button>
            </li>
            {{-- <li class="list-group-item d-flex align-items-center">
              <i class="bi bi-person-plus me-2"></i>
              <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#assignConsultantModal">Assign Consultant</button>
            </li>
            <li class="list-group-item d-flex align-items-center">
              <i class="bi bi-person-dash me-2"></i>
              <button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#removeConsultantModal">Remove Consultant</button>
            </li> --}}
          </ul>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade draggable" id="changeStatusModal" tabindex="-1" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Consultant List -->
          <ul class="list-group" id="incidence_status_id">
            @foreach ($inc_statuses as $status)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ strtoupper($status->name) }}
                <button type="button" class="btn btn-sm btn-outline-primary pick-status" data-id="{{ $status->id }}">
                  Pick
                </button>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>


<!-- Assign Consultant Modal -->
<div class="modal fade draggable" id="assignConsultantModal" tabindex="-1" aria-labelledby="assignConsultantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignConsultantModalLabel">Assign Consultant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
          <!-- Hidden input to store incident ID -->
          <input type="hidden" id="incidentId" value="">

          <!-- Search Input -->
          <input type="text" id="consultantSearch" class="form-control mb-3" placeholder="Search consultants...">

          <!-- Consultant List -->
          <ul class="list-group" id="consultantList">
            @foreach ($consultants as $consultant)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ strtoupper($consultant->name) }}
                <button type="button" class="btn btn-sm btn-outline-primary pick-consultant" data-id="{{ $consultant->id }}">
                  Pick
                </button>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>


<!-- Remove Consultant Modal -->
<div class="modal fade" id="removeConsultantModal" tabindex="-1" aria-labelledby="removeConsultantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeConsultantModalLabel">Confirm Removal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to remove the consultant from this incident?
          <input type="hidden" id="incidentId" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmRemoveConsultant">Confirm</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Incidence Images</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form id="updateIncidenceForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="incidence_id" id="incidence_id">

            <div class="mb-3">
              <label for="images" class="form-label">Select Images</label>
              <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*">
              <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-2"></div>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" id="submitImages" class="btn btn-primary">Update Images</button>
        </div>

      </div>
    </div>
  </div>


@endsection

<!-- jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>


<script>
    // Set CSRF token for all AJAX requests
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    let currentIncidentId = null;

    // When "Edit" button is clicked
    $(document).on('click', '.edit-button', function () {
      currentIncidentId = $(this).closest('tr').find('.incident-id').val();
      $('#incidentId').val(currentIncidentId); // Used for hidden inputs in modals
      $('#editActionsModal').modal('show');
    });

    // Set incident ID in Assign Consultant modal
    $('#editActionsModal').on('click', '[data-bs-target="#assignConsultantModal"]', function () {
      $('#assignConsultantModal #incidentId').val(currentIncidentId);
    });

    // Set incident ID in Change Status modal
    $('#editActionsModal').on('click', '[data-bs-target="#changeStatusModal"]', function () {
      $('#changeStatusModal #incidentId').val(currentIncidentId);
    });

    // Set incident ID in Remove Consultant modal
    $('#editActionsModal').on('click', '[data-bs-target="#removeConsultantModal"]', function () {
      $('#removeConsultantModal #incidentId').val(currentIncidentId);
    });

    // Assign consultant to incident via AJAX
    $(document).on('click', '.pick-consultant', function () {
      var consultantId = $(this).data('id');
      var incidentId = $('#assignConsultantModal #incidentId').val(); // Pull from modal hidden input

      if (!incidentId || !consultantId) {
        alert('Incident ID or Consultant ID is missing.');
        return;
      }

      console.log('Assigning Consultant ID:', consultantId, 'to Incident ID:', incidentId);

      $.ajax({
        url: '{{ route("assignconsultanttoincidence") }}',
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // Optional if ajaxSetup is used
          incident_id: incidentId,
          consultant_id: consultantId
        },
        success: function (response) {
          if (response.success) {
            alert(response.message);
            $('#assignConsultantModal').modal('hide');
            window.location.reload();
            // You may want to refresh the table or update the row here
          } else {
            alert('Failed to assign consultant: ' + response.message);
          }
        },
        error: function (xhr) {
          alert('An error occurred: ' + xhr.responseText);
        }
      });
    });


      // updating incidence status
      $(document).on('click', '.pick-status', function () {
      var statusID = $(this).data('id');
      var incidentId = $('#assignConsultantModal #incidentId').val(); // Pull from modal hidden input

      if (!incidentId || !statusID) {
        alert('Incident ID or Consultant ID is missing.');
        return;
      }

      console.log('Assigning Consultant ID:', statusID, 'to Incident ID:', incidentId);

      $.ajax({
        url: '{{ route("updateincidencestatus") }}',
        type: 'POST',
        data: {
          _token: '{{ csrf_token() }}', // Optional if ajaxSetup is used
          incident_id: incidentId,
          statusID: statusID
        },
        success: function (response) {
          if (response.success) {
            alert(response.message);
            $('#assignConsultantModal').modal('hide');
            window.location.reload();
            // You may want to refresh the table or update the row here
          } else {
            alert('Failed to update incident statu: ' + response.message);
          }
        },
        error: function (xhr) {
          alert('An error occurred: ' + xhr.responseText);
        }
      });
    });



        // Remove consultant from incident via AJAX
        $(document).on('click', '#confirmRemoveConsultant', function () {
            var incidentId = $('#assignConsultantModal #incidentId').val(); // Pull from modal hidden input

        if (!incidentId) {
            alert('Incident ID is missing.');
            return;
        }

        console.log('Removing consultant from Incident ID:', incidentId);

        $.ajax({
            url: '{{ route("reassignincidenceconsultant") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Optional if ajaxSetup is used

            incident_id: incidentId
            // No consultant_id provided; backend should handle setting consultant_id to null
            },
            success: function (response) {
            if (response.success) {
                alert(response.message);
                $('#removeConsultantModal').modal('hide');
                window.location.reload();
                // Optionally, refresh the incidents table or update the UI accordingly
            } else {
                alert('Failed to remove consultant: ' + response.message);
            }
            },
            error: function (xhr) {
            alert('An error occurred: ' + xhr.responseText);
            }
        });
        });



        $(document).ready(function() {
        let selectedFiles = [];

        $('.open-update-modal').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('#incidence_id').val(id);
            selectedFiles = [];
            $('#imagePreview').html('');
            $('#images').val('');
            $('#updateModal').modal('show');
        });

        // Preview images and store in selectedFiles
        $('#images').on('change', function(e) {
            $('#imagePreview').html('');
            selectedFiles = Array.from(e.target.files);

            selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgHtml = `
                <div class="position-relative" style="width:100px;">
                    <img src="${event.target.result}" class="img-thumbnail" style="height:80px; object-fit:cover;">
                    <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 remove-preview" data-index="${index}" title="Remove"></button>
                </div>
                `;
                $('#imagePreview').append(imgHtml);
            };
            reader.readAsDataURL(file);
            });
        });

        // Remove image from selectedFiles array
        $('#imagePreview').on('click', '.remove-preview', function() {
            const index = $(this).data('index');
            selectedFiles.splice(index, 1);
            $('#images')[0].value = '';
            $('#imagePreview').html('');
            selectedFiles.forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imgHtml = `
                <div class="position-relative" style="width:100px;">
                    <img src="${event.target.result}" class="img-thumbnail" style="height:80px; object-fit:cover;">
                    <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 remove-preview" data-index="${idx}" title="Remove"></button>
                </div>
                `;
                $('#imagePreview').append(imgHtml);
            };
            reader.readAsDataURL(file);
            });
        });

        // Handle form submit via AJAX
        $('#submitImages').on('click', function() {
            const formData = new FormData();
            const incidenceId = $('#incidence_id').val();
            formData.append('incidence_id', incidenceId);

            selectedFiles.forEach(file => {
            formData.append('images[]', file);
            });

            $.ajax({
            url: '{{ route("updateincidenceimages") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success: function(response) {
                if (response.status === 'success') {
                showFlashMessage('success', response.message || 'Incidence updated succesfully');
                $('#updateModal').modal('hide');
                } else {
                    showFlashMessage('error', response.message || 'An error occured, please try again');
                }
            },
            error: function(xhr) {
                const msg = xhr.responseJSON?.message || 'An error occurred.';
                showFlashMessage('error', msg || 'Error updating incidence');

            }
            });
        });
        });
  </script>
