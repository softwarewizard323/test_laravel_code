@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="msgView_page">
        <br>
        <div class="row-fluid">
            <div class="widget widget-padding span12">
                <div class="widget-header">
                    <i class="icon-inbox"></i>
                    <h5>All Signarures</h5>
                    @if ($data->allSignatures->count() != 0)
                        <div class="widget-buttons">
                            <a href="{{ url('admin/signature/create') }}" class="btn btn-info"
                               style="margin:-5px 0 0 0; color: #FFF;"><i class="icon-pencil"></i> Create Signature</a>
                        </div>
                    @endif
                </div>
                <div class="widget-body">
                    <form id="signature" method="post"
                          action="{{ url('admin/signature/delete') }}">{{ csrf_field() }}</form>
                    @foreach($data->allSignatures as $signature)
                        <table class="table table-hover" data-provides="rowlink">
                            <tbody>
                            <tr @if ($signature->news_status == 1 ) class="success" @endif >
                                <td width="30">
                                    <input form="signature" type="checkbox" name="checkbox[]" id="checkbox[]"
                                           value="{{ $signature->signature_id }}">
                                </td>
                                <td width="150">Signature #{{ $signature->signature_id }}</td>
                                <td width="200">{{  date('d-m-Y', strtotime($signature->signature_date)) }}</td>
                                <td>{!! $signature->signature_content !!}</td>
                                <td width="100">
                                    <a href="{{ url('admin/signature/delete', ['id' => $signature->signature_id ] )}}"
                                       class="btn btn-mini btn-danger"
                                       onclick="return confirm('Are you sure want to delete this signature?');">
                                        <i class="icon-lock"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach

                            @if ($data->allSignatures->count() == 0)
                                <div style="margin: 50px auto 20px auto; font-size: 19px; color: #999; text-align: center;">
                                    No signatures created yet.
                                </div>
                                <div style="margin: 5px auto 50px auto; text-align: center;">
                                    <a href="{{ url('admin/signature/create') }}" class="btn btn-info">
                                        <i class="icon-pencil"></i> Create Signature</a>
                                </div>
                            @endif
                            </tbody>
                        </table>
                </div>

                <div class="widget-footer">
                    <div class="pull-left">
                        <p class="muted" style="margin: 5px">Showing {{ $data->allSignatures->count()}}
                            of {{ $data->allSignatures->count() }}</p>
                    </div>
                    <div class="pull-right">
                        @if ($data->allSignatures->count() != 0)
                            <button class="btn" id="delete" form="signature" type="submit" name="delete"
                                    value="Delete Selected Signatures"
                                    onclick="return confirm('Are you sure you want to delete these signatures?');">
                                <i class="icon-trash"></i> Delete
                            </button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection