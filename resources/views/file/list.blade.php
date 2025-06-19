@extends('layout.master_layout')

@section('body')
    <style>
        .table td {
            padding: 0.25rem;
            vertical-align: center;
            border-top: 1px solid #dee2e6;
        }
    </style>
    <div class="row">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="page-header" style="border-bottom: 1px solid #04401f;">
                            <h4>Menu</h4>
                        </div>
                        @include('control.side_menu')
                    </div>
                </div>
            </div>
        </div>
        @include('file.modal')
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-right">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadFileModal"><i
                            class="fas fa-plus"></i> ADD </button>
                </div>
                <div class="card-header">
                    <h2 class="card-title">NAME: <b>{{ strtoupper($patient->lname) }} {{ strtoupper($patient->fname) }}
                            {{ isset($patient->ext_name) ? strtoupper($patient->ext_name) : '' }}
                            {{ strtoupper($patient->mname) }}</b></h2>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-0" style="height: 400px;">
                    <table class="table table-head-fixed text-nowrap">
                        @foreach ($files as $file)
                            <tr id="tr-file-{{ $file->id }}">
                                <td>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="file-thumbnail text-center">
                                            <i class="fas fa-file-pdf text-danger ml-2 fa-1x"></i>
                                        </div>
                                        <p class="file-name ml-2 mb-0">{{ $file->file }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="mt-2">
                                        @php
                                            $dateString = $file->created_at;
                                            $dateTime = new DateTime($dateString);
                                            $formattedDate = $dateTime->format('F j, Y g:i A');
                                            echo $formattedDate;
                                        @endphp
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn" type="button" id="fileOptions-{{ $file->id }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="fileOptions-{{ $file->id }}">
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#editFileModal" onclick="editFile()">
                                                <i class="fas fa-edit"></i> Rename
                                            </a>
                                            <a class="dropdown-item" href="{{ asset('storage/Uploads/' . $file->file) }}"
                                                target="_blank">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button class="dropdown-item btn btn-danger file-delete"
                                                data-id="{{ $file->id }}" type="button">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
