@extends('admin.layouts.app')

@section('content')
    <!-- Main window -->
    <div class="main_container" id="campaign_page">
        <br>
        <div class="widget-body">
            <div class="row-fluid">
                <div class="widget widget-padding span12">
                    <div class="widget-header">
                        <i class="icon-question-sign"></i>
                        <h5>Manage all FAQs</h5>
                        <div class="widget-buttons">
                            <a href="{{ url('admin/faq/add') }}" class="btn btn-payment" style="margin:-5px 0 0 0; color: #FFF;">
                                <i class="icon-play-circle"></i> Add New FAQ</a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <table id="balance" class="table table-striped table-bordered dataTable">
                            <thead>
                            <tr>
                                <th style="text-align:center;">FAQ ID</th>
                                <th style="text-align:center;">FAQ Question</th>
                                <th style="text-align:center;">Date Created</th>
                                <th style="text-align:center;">Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data->allFAQs as $faq)
                            <tr>
                                <td style="text-align:center;">{{ $faq->faq_id }}</td>
                                <td>{{ $faq->faq_question }}</td>
                                <td style="text-align:center;">{{ $faq->faq_date }}</td>
                                <td style="text-align:center;">
                                    @if ($faq->faq_status == '1')
                                        <span class="label label-success">Live</span>
                                    @else
                                        <span class="label label-important">Not Live</span>
                                        @endif
                                </td>
                                <td style="text-align:right;">
                                    <a href="{{ url('admin/faq/delete', ['id' => $faq->faq_id ]) }}" class="btn btn-mini btn-danger"
                                       onclick="return confirm('Are you sure want to delete this FAQ?');"><i class="icon-trash"></i> Delete</a>
                                    <a href="{{ url('admin/faq/edit', ['id' => $faq->faq_id ]) }}" class="btn btn-mini btn-info"><i class="icon-edit"></i> Edit Balance</a>
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
@endsection