<div>
    @push('style')
    @endpush
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Appointments</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form wire:submit.prevent='createAppointment' autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Appointment</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="client">Client:</label>
                                            <select id="client" class="form-control" name="client_id"
                                                wire:model.defer='field.client_id'>
                                                <option value="">Select Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentStartTime">Appointment Start Time</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-timepicker wire:model.defer='field.appointment_start_time'
                                                    id="appointmentStartTime" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentEndTime">Appointment End Time</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-timepicker wire:model.defer='field.appointment_end_time'
                                                    id="appointmentEndTime" />
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentDate">Appointment Date</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-datepicker wire:model.defer='field.date' id="appointmentDate" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="appointmentEndTime">Appointment End Time</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                </div>
                                                <x-timepicker wire:model.defer='field.appointment_end_time'
                                                    id="appointmentEndTime" />
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <div class="input-group date" id="appointmentDate"
                                                data-target-input="nearest" data-appointmentdate="@this" wire:ignore>
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#appointmentDate" id="appointmentDateInput">
                                                <div class="input-group-append" data-target="#appointmentDate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Appointment Time:</label>
                                            <div class="input-group date" id="appointmentTime"
                                                data-target-input="nearest" data-appointmenttime="@this" wire:ignore>
                                                <input wire:model.defer='field.time' type="text"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#appointmentTime" id="appointmentTimeInput">
                                                <div class="input-group-append" data-target="#appointmentTime"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text">
                                                        <i class="far fa-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" wire:ignore>
                                            <label for="note">Note:</label>
                                            <textarea wire:model.defer='field.note' data-note="@this" id="note" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i>
                                    Cancel</button>
                                <button id="submit" type="submit" class="btn btn-primary"><i
                                        class="fa fa-save mr-1"></i>
                                    Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#appointmentDate').datetimepicker({
                    format: 'L'
                })

                $('#appointmentDate').on('change.datetimepicker', function(e) {
                    let date = $(this).data('appointmentdate');
                    eval(date).set('field.date', $('#appointmentDateInput').val());
                })

                $('#appointmentTime').datetimepicker({
                    format: 'LT'
                })

                $('#appointmentTime').on('change.datetimepicker', function(e) {
                    let time = $(this).data('appointmenttime');
                    eval(time).set('field.time', $('#appointmentTimeInput').val());
                })
            })
        </script>

        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#note'))
                .then(editor => {
                    document.querySelector('#submit').addEventListener('click', () => {
                        let note = $('#note').data('note');
                        eval(note).set('field.note', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</div>
