@extends('backend.layout.app')

@section('Content')



    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">



            <!-- Infrastructure Reports Card -->
<div class="col-xxl-3 col-md-6">
    <div class="card info-card">

      <div class="card-body">
        <h5 class="card-title">Infrastructure Reports</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning text-white">
            <i class="bi bi-building"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $issuescount }}</h6>
            <span class="text-muted small pt-2 ps-1">Total Reported</span>
          </div>
        </div>
      </div>

    </div>
  </div>


  <!-- Resolved Issues Card -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card">

      <div class="card-body">
        <h5 class="card-title">Resolved Issues</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white">
            <i class="bi bi-check-circle"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $resolvedissues }}</h6>
            <span class="text-success small pt-1 fw-bold">Resolved</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Unresolved Issues Card -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card">

      <div class="card-body">
        <h5 class="card-title">Unresolved Issues</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white">
            <i class="bi bi-exclamation-triangle"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $unresolvedissues }}</h6>
            <span class="text-danger small pt-1 fw-bold">Pending</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Subscribers Card -->
  <div class="col-xxl-3 col-md-6">
    <div class="card info-card">

      <div class="card-body">
        <h5 class="card-title">Subscribers</h5>
        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white">
            <i class="bi bi-people-fill"></i>
          </div>
          <div class="ps-3">
            <h6>{{ $subscribers }}</h6>
            <span class="text-muted small pt-2 ps-1">Registered Users</span>
          </div>
        </div>
      </div>

    </div>
  </div>







<!-- Reports -->
<div class="col-12">
    <div class="card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>
          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Reported Issues <span>| 2025</span></h5>

        <!-- Line Chart -->
        <div id="reportsChart"></div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
              new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                  name: 'Reported Issues',
                  data: {!! json_encode($monthlyCounts) !!}
                }],
                chart: {
                  height: 350,
                  type: 'line',
                  toolbar: {
                    show: false
                  },
                },
                colors: ['#ff771d'],
                dataLabels: {
                  enabled: true
                },
                stroke: {
                  curve: 'smooth',
                  width: 3
                },
                grid: {
                  row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                  },
                },
                xaxis: {
                  categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                  title: {
                    text: 'Month'
                  }
                },
                yaxis: {
                  title: {
                    text: 'Number of Issues'
                  }
                },
                tooltip: {
                  y: {
                    formatter: function (val) {
                      return val + " issues"
                    }
                  }
                }
              }).render();
            });
          </script>

        <!-- End Line Chart -->

      </div>

    </div>
  </div><!-- End Reports -->







<!-- Consultant Summary -->
<div class="col-12">
    <div class="card overflow-hidden">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>
          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Consultant Summary <span>| All</span></h5>

        <div style="max-height: 400px; overflow-y: auto; overflow-x: auto;">
          <table class="table table-bordered table-striped">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Consultant Name</th>
                <th>Assigned Issues</th>
                <th>Resolved Issues</th>
                <th>Manager Name</th>
                <th>Phone Number</th>
              </tr>
            </thead>
            <tbody>

            @foreach ($consultants as $consultant )
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ strtoupper($consultant->name) }}</td>
                <td>{{ $consultant->incidences->count() }}</td>
                <td>{{ $consultant->incidences->where('resolve_status', 3)->count() }}</td>
                <td>{{ strtoupper(optional($consultant->manager)->first_name . ' ' . optional($consultant->manager)->last_name ?? 'UN-ASSIGNED') }}</td>
                <td>{{ strtoupper(optional($consultant->manager)->phone ?? 'un-asigned') }}</td>
              </tr>
              @endforeach

              <!-- Add more rows as needed -->
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </div>
  <!-- End Consultant Summary -->





          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">






<!-- Issue Status Chart -->
<div class="card">
    <div class="filter">
      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
          <h6>Filter</h6>
        </li>
        <li><a class="dropdown-item" href="#">Today</a></li>
        <li><a class="dropdown-item" href="#">This Month</a></li>
        <li><a class="dropdown-item" href="#">This Year</a></li>
      </ul>
    </div>
    <div class="card-body pb-0">
      <h5 class="card-title">Issue Status <span>| Today</span></h5>
      <div id="issueStatusChart" style="min-height: 400px;" class="echart"></div>
    </div>
  </div><!-- End Issue Status Chart -->





  <!-- Issues vs Consultants Chart -->
<div class="card">
    <div class="filter">
      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
          <h6>Filter</h6>
        </li>
        <li><a class="dropdown-item" href="#">Today</a></li>
        <li><a class="dropdown-item" href="#">This Month</a></li>
        <li><a class="dropdown-item" href="#">This Year</a></li>
      </ul>
    </div>

    <div class="card-body pb-0">
      <h5 class="card-title">Reported Issues vs Consultants <span>| This Month</span></h5>

      <div id="issuesConsultantsChart" style="min-height: 400px;" class="echart"></div>
    </div>
  </div><!-- End Issues vs Consultants Chart -->




        </div><!-- End Right side columns -->

      </div>
    </section>









    <script>
        document.addEventListener("DOMContentLoaded", () => {
          echarts.init(document.querySelector("#issueStatusChart")).setOption({
            tooltip: {
              trigger: 'item'
            },
            legend: {
              top: '5%',
              left: 'center'
            },
            series: [{
              name: 'Issue Status',
              type: 'pie',
              radius: ['40%', '70%'],
              avoidLabelOverlap: false,
              label: {
                show: false,
                position: 'center'
              },
              emphasis: {
                label: {
                  show: true,
                  fontSize: '18',
                  fontWeight: 'bold'
                }
              },
              labelLine: {
                show: false
              },
              data: [
                { value: {{ $resolvedCount }}, name: 'Resolved' },
                { value: {{ $inProgressCount }}, name: 'In Progress' },
                { value: {{ $pendingCount }}, name: 'Pending' }
              ]
            }]
          });
        });





        document.addEventListener("DOMContentLoaded", () => {
    echarts.init(document.querySelector("#issuesConsultantsChart")).setOption({
      tooltip: {
        trigger: 'item'
      },
      legend: {
        top: '5%',
        left: 'center'
      },
      series: [{
        name: 'Comparison',
        type: 'pie',
        radius: '60%',
        data: [
          { value: {{ $reportedIssues }}, name: 'Reported Issues' },
          { value: {{ $availableConsultants }}, name: 'Available Consultants' }
        ],
        emphasis: {
          itemStyle: {
            shadowBlur: 10,
            shadowOffsetX: 0,
            shadowColor: 'rgba(0, 0, 0, 0.5)'
          }
        }
      }]
    });
  });
      </script>

@endsection
