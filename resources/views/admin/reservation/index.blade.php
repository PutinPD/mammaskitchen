@extends('layouts.app')

@section('title','Reservation')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('backend/css/color.css')}}">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">

              @include('layouts.partial.msg')
              
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Reservations</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table" style="width:100%" cellspacing="0">
                      <thead class=" text-primary">
                        <th>
                          ID
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Time and Date
                        </th>
                        <th>
                          Message
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          Created At
                        </th>
                        <th>
                          Updated At
                        </th>
                        <th>
                          Action
                        </th>
                      </thead>
                      <tbody>
                          @foreach ($reservations as $key=>$reservation)
                              <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->phone }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>{{ $reservation->date_and_time }}</td>
                                <td><p class="myColor"><strong>{{ $reservation->message }}</strong></p></td>
                                <td>
                                  @if ($reservation->status==true)
                                      <span class="badge badge-info">Confirmed</span>
                                  @else
                                      <span class="badge badge-danger">Not confirmed yet</span>
                                  @endif
                                </td>
                                <td>{{ $reservation->created_at }}</td>
                                <td>{{ $reservation->updated_at }}</td>
                                <td>
                    
                                  @if ($reservation->status==false)
                                      
                                    <form id="status-form-{{ $reservation->id }}" action="{{route('reservation.status',$reservation->id)}}" style="display:none;" method="POST">
                                      @csrf

                                    </form>

                                    <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('Are you verify this request by phone?')){
                                      event.preventDefault();
                                      document.getElementById('status-form-{{ $reservation->id }}').submit();
                                    }else{
                                      event.preventDefault();
                                    }"> <i class="material-icons"> done </i> 
                                    </button>
                                  @endif
                                  <form id="delete-form-{{ $reservation->id }}" action="{{route('reservation.destroy',$reservation->id)}}" style="display:none;" method="POST">
                                    @csrf
                                    @method('DELETE')

                                  </form>

                                  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $reservation->id }}').submit();
                                  }else{
                                    event.preventDefault();
                                  }"> <i class="material-icons"> delete </i> 
                                  </button>
                                </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     {{--    @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error('{{ $error }}');
                </script>
            @endforeach --}}

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

{!! Toastr::message() !!}
@endpush