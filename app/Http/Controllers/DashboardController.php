<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Treatment;
use App\Models\Veterinarian;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard.index', [
            'counts' => [
                'Pets' => [Pet::count(), 'pets.index', 'bi-emoji-smile'],
                'Owners' => [Owner::count(), 'owners.index', 'bi-people'],
                'Veterinarians' => [Veterinarian::count(), 'veterinarians.index', 'bi-person-badge'],
                'Appointments' => [Appointment::count(), 'appointments.index', 'bi-calendar-check'],
                'Treatments' => [Treatment::count(), 'treatments.index', 'bi-bandaid'],
            ],
            'upcoming' => Appointment::with(['pet.owner', 'veterinarian'])
                ->where('status', 'Scheduled')->where('appointment_date', '>=', now())
                ->orderBy('appointment_date')->take(6)->get(),
            'recentTreatments' => Treatment::with('appointment.pet')->latest()->take(5)->get(),
            'vets' => Veterinarian::withCount('appointments')->orderByDesc('appointments_count')->take(5)->get(),
            'revenue' => Treatment::sum('cost'),
        ]);
    }
}
