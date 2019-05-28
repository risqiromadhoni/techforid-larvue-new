@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Kursus</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Material</a></li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Sertifkat</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="panel panel-bordered">
                                <!-- form start -->
                                <form role="form"
                                        class="form-edit-add"
                                        action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                    <!-- PUT Method if we are editing -->
                                    @if($edit)
                                        {{ method_field("PUT") }}
                                    @endif
            
                                    <!-- CSRF TOKEN -->
                                    {{ csrf_field() }}
            
                                    <div class="panel-body">
            
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
            
                                        <!-- Adding / Editing -->
                                        @php
                                            $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                                        @endphp
            
                                        @foreach($dataTypeRows as $row)
                                            <!-- GET THE DISPLAY OPTIONS -->
                                            @php
                                                $display_options = $row->details->display ?? NULL;
                                                if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                                }
                                            @endphp
                                            @if (isset($row->details->legend) && isset($row->details->legend->text))
                                                <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                            @endif
                                            <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                                {{ $row->slugify }}
                                                <label class="control-label" for="name">{{ $row->display_name }}</label>
                                                @include('voyager::multilingual.input-hidden-bread-edit-add')
                                                @if (isset($row->details->view))
                                                    @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add')])
                                                @elseif ($row->type == 'relationship')
                                                    @include('voyager::formfields.relationship', ['options' => $row->details])
                                                @else
                                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                                @endif
            
                                                @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                    {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                                @endforeach
                                                @if ($errors->has($row->field))
                                                    @foreach ($errors->get($row->field) as $error)
                                                        <span class="help-block">{{ $error }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
            
                                    </div><!-- panel-body -->
            
                                    <div class="panel-footer">
                                        <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                                    </div>
                                </form>
            
                                <iframe id="form_target" name="form_target" style="display:none"></iframe>
                                <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                                        enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                                    <input name="image" id="upload_file" type="file"
                                                onchange="$('#my_form').submit();this.value='';">
                                    <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                                    {{ csrf_field() }}
                                </form>
            
                            </div>
                            <div class="modal fade modal-danger" id="confirm_delete_modal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                        
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                                        </div>
                        
                                        <div class="modal-body">
                                            <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                                        </div>
                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                                            <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Delete File Modal -->
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div id="sections">
                                <index-sections
                                :sections="sections"
                                v-on:deleted-section="deleteSection"
                                v-on:deleted-material="deleteMaterial"
                                ></index-sections>
                                <div class="modal fade modal-info" id="add_section">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                            
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><i class="voyager-list-add"></i> {{ __('Tambah Section') }}</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" id="sectionTitle" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                                                <button type="button" class="btn btn-primary" v-on:click="addSection">{{ __('Save') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade modal-info" id="add_material">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                            
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><i class="voyager-list-add"></i> {{ __('Tambah Section') }}</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div id="wistia_uploader" style="background: rgb(34, 167, 240);">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade modal-info" id="add_material">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                            
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"><i class="voyager-list-add"></i> {{ __('Tambah Section') }}</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <form id="add-excercies">
                                                    <div class="form-group">
                                                        <label for=""></label>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" id="close-modal" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                                                <button type="button" class="btn btn-default">{{ __('Simpan') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages">...</div>
                        <div role="tabpanel" class="tab-pane" id="settings">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
