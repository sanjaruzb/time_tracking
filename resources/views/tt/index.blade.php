@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header" id="kt_profile_details_view">
            <h3 class="card-title">Time Tracking Management</h3>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('tt.create') }}">Create</a>
            </div>
        </div>
        <div class="card-body mb-12 mb-xl-12" id="kt_profile_details_view" style="margin: 10px; padding: 10px">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif


            <table class="table table-bordered table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Auth Date</th>
                    <th>Auth Time</th>
                    <th>Track</th>
                    <th></th>
                </tr>
                @foreach ($tts as $key => $tt)
                    <tr>
                        <td>{{ $tt->number }}</td>
                        <td>{{ $tt->name }}</td>
                        <td>{{ $tt->auth_date }}</td>
                        <td>{{ $tt->auth_time }}</td>
                        <td>{{ \App\Helpers\TrackHelper::getTrack($tt->track) }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="" style="margin-right: 10px" href="{{ route('tt.show',$tt->id) }}">
                                    <span class="fa fa-eye"></span>
                                </a>
                                <a class="" style="margin-right: 2px" href="{{ route('tt.edit',$tt->id) }}">
                                    <span class="fa fa-edit" style="color: #562bb0"></span>
                                </a>

                                <form action="{{ route("tt.destroy", $tt->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="button" style='display:inline; border:none; background: none' onclick="if (confirm('Вы уверены?')) { this.form.submit() } "><span class="fa fa-trash"></span></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            <tfooter>
                <tr>
                    <td colspan="9">
                        {{ $tts->links() }}
                    </td>
                </tr>
            </tfooter>
        </div>
    </div>

@endsection
