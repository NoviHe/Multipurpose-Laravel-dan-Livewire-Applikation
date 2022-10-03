<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $field = [];

    public function createAppointment()
    {
        dd($this->field);
        //validate
        $this->field['status'] = 'open';
        Appointment::create($this->field);
        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment Created Successfully']);
    }
    public function render()
    {
        $clients = Client::latest()->get();
        return view('livewire.admin.appointments.create-appointment-form', ['clients' => $clients]);
    }
}
